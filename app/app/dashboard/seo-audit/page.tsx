"use client"

import { useState, useEffect } from "react"
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { fetchApi } from "@/lib/api-service"
import {
    ShieldCheck,
    ShieldAlert,
    CheckCircle2,
    XCircle,
    AlertTriangle,
    Image as ImageIcon,
    FileText,
    Tag,
} from "lucide-react"

interface SeoResult {
    id: string
    title: string
    slug: string
    status: string
    checks: {
        has_seo_title: boolean
        has_seo_description: boolean
        has_seo_keywords: boolean
        has_og_image: boolean
        has_thumbnail: boolean
        has_description: boolean
    }
    score: number
}

export default function SeoAuditPage() {
    const [results, setResults] = useState<SeoResult[]>([])
    const [loading, setLoading] = useState(true)

    useEffect(() => {
        async function load() {
            try {
                // Use the projects endpoint and compute SEO score client-side
                const res = await fetchApi<{ data: any[] }>("/admin/projects")
                const audited: SeoResult[] = res.data.map((p) => {
                    const seo = p.seo || {}
                    const checks = {
                        has_seo_title: !!seo.title,
                        has_seo_description: !!seo.description,
                        has_seo_keywords: !!(seo.keywords && seo.keywords.length > 0),
                        has_og_image: !!seo.og_image,
                        has_thumbnail: !!p.thumbnail,
                        has_description: !!p.description,
                    }
                    const total = Object.values(checks).filter(Boolean).length
                    return {
                        id: p.id,
                        title: p.title,
                        slug: p.slug,
                        status: p.status,
                        checks,
                        score: Math.round((total / 6) * 100),
                    }
                })
                setResults(audited)
            } catch (e) {
                console.error(e)
            } finally {
                setLoading(false)
            }
        }
        load()
    }, [])

    const avgScore = results.length > 0
        ? Math.round(results.reduce((s, r) => s + r.score, 0) / results.length)
        : 0

    const perfect = results.filter((r) => r.score === 100).length
    const needsWork = results.filter((r) => r.score < 50).length

    const CheckIcon = ({ ok }: { ok: boolean }) =>
        ok ? <CheckCircle2 className="h-4 w-4 text-emerald-500" /> : <XCircle className="h-4 w-4 text-destructive" />

    return (
        <div className="space-y-6">
            <h2 className="text-3xl font-bold tracking-tight text-primary">SEO Audit</h2>

            <div className="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Average Score</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="text-3xl font-bold">{avgScore}%</div>
                        <div className="w-full bg-muted rounded-full h-2 mt-2">
                            <div
                                className={`h-2 rounded-full ${avgScore >= 80 ? "bg-emerald-500" : avgScore >= 50 ? "bg-amber-500" : "bg-destructive"}`}
                                style={{ width: `${avgScore}%` }}
                            />
                        </div>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Perfect Score</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="text-3xl font-bold text-emerald-500">{perfect}</div>
                        <p className="text-xs text-muted-foreground">projects with 100% SEO</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Needs Attention</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="text-3xl font-bold text-destructive">{needsWork}</div>
                        <p className="text-xs text-muted-foreground">projects below 50%</p>
                    </CardContent>
                </Card>
            </div>

            <div className="space-y-4">
                {loading ? (
                    <Card><CardContent className="py-8 text-center text-muted-foreground">Analyzing projects...</CardContent></Card>
                ) : results.length === 0 ? (
                    <Card><CardContent className="py-12 text-center">
                        <ShieldCheck className="h-10 w-10 mx-auto text-muted-foreground mb-2" />
                        <p className="text-muted-foreground">No projects to audit</p>
                    </CardContent></Card>
                ) : (
                    results.map((r) => (
                        <Card key={r.id}>
                            <CardHeader className="pb-3">
                                <div className="flex items-center justify-between">
                                    <div className="flex items-center gap-3">
                                        {r.score === 100 ? (
                                            <ShieldCheck className="h-5 w-5 text-emerald-500" />
                                        ) : r.score >= 50 ? (
                                            <AlertTriangle className="h-5 w-5 text-amber-500" />
                                        ) : (
                                            <ShieldAlert className="h-5 w-5 text-destructive" />
                                        )}
                                        <CardTitle className="text-base">{r.title}</CardTitle>
                                        <Badge variant="secondary" className="text-xs">/{r.slug}</Badge>
                                    </div>
                                    <Badge variant={r.score >= 80 ? "default" : r.score >= 50 ? "secondary" : "destructive"}>
                                        {r.score}%
                                    </Badge>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_seo_title} />
                                        <span>SEO Title</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_seo_description} />
                                        <span>Meta Description</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_seo_keywords} />
                                        <span>Keywords</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_og_image} />
                                        <span>OG Image</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_thumbnail} />
                                        <span>Thumbnail</span>
                                    </div>
                                    <div className="flex items-center gap-2 text-sm">
                                        <CheckIcon ok={r.checks.has_description} />
                                        <span>Description</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))
                )}
            </div>
        </div>
    )
}
