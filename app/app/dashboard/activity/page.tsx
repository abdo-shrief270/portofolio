"use client"

import { useState, useEffect } from "react"
import { Card, CardContent } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import { Separator } from "@/components/ui/separator"
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetDescription,
} from "@/components/ui/sheet"
import { fetchApi } from "@/lib/api-service"
import {
    Activity as ActivityIcon,
    RefreshCw,
    User,
    FolderOpen,
    MessageSquare,
    Settings,
    Layers,
    Clock,
    Hash,
    FileText,
    ChevronRight,
    GraduationCap,
    Briefcase,
    Code,
    Star,
} from "lucide-react"

interface ActivityEntry {
    id: string
    action: string
    model: string
    model_type?: string
    model_id?: string
    description: string
    created_at: string
    user?: { name: string }
    properties?: {
        old?: Record<string, unknown>
        attributes?: Record<string, unknown>
    }
}

const modelIcons: Record<string, typeof FolderOpen> = {
    Project: FolderOpen,
    Category: Layers,
    Contact: MessageSquare,
    ContactSubmission: MessageSquare,
    SiteSetting: Settings,
    Technology: Code,
    Testimonial: Star,
    Experience: Briefcase,
    Education: GraduationCap,
    Course: GraduationCap,
}

export default function ActivityPage() {
    const [activities, setActivities] = useState<ActivityEntry[]>([])
    const [loading, setLoading] = useState(true)
    const [selected, setSelected] = useState<ActivityEntry | null>(null)

    const loadActivities = async () => {
        setLoading(true)
        try {
            const res = await fetchApi<{ data: ActivityEntry[] } | ActivityEntry[]>("/admin/activity-log")
            const items = Array.isArray(res) ? res : (res as { data: ActivityEntry[] }).data ?? []
            setActivities(items)
        } catch {
            setActivities([])
        } finally {
            setLoading(false)
        }
    }

    useEffect(() => {
        loadActivities()
    }, [])

    const getActionColor = (action: string) => {
        switch (action) {
            case "created": return "bg-emerald-500"
            case "updated": return "bg-blue-500"
            case "deleted": return "bg-destructive"
            default: return "bg-muted-foreground"
        }
    }

    const getActionBadgeVariant = (action: string): "default" | "secondary" | "destructive" | "outline" => {
        switch (action) {
            case "created": return "default"
            case "deleted": return "destructive"
            default: return "secondary"
        }
    }

    const formatValue = (value: unknown): string => {
        if (value === null || value === undefined) return "—"
        if (typeof value === "boolean") return value ? "Yes" : "No"
        if (typeof value === "object") return JSON.stringify(value, null, 2)
        return String(value)
    }

    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <h2 className="text-3xl font-bold tracking-tight text-primary">Activity Log</h2>
                <Button variant="outline" onClick={loadActivities} disabled={loading}>
                    <RefreshCw className={`h-4 w-4 mr-2 ${loading ? "animate-spin" : ""}`} /> Refresh
                </Button>
            </div>

            <Card>
                <CardContent className="p-0">
                    {loading ? (
                        <div className="divide-y">
                            {Array.from({ length: 5 }).map((_, i) => (
                                <div key={i} className="flex items-start gap-4 px-6 py-4">
                                    <div className="h-5 w-5 bg-muted animate-pulse rounded" />
                                    <div className="flex-1 space-y-2">
                                        <div className="h-4 w-48 bg-muted animate-pulse rounded" />
                                        <div className="h-3 w-32 bg-muted animate-pulse rounded" />
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : activities.length === 0 ? (
                        <div className="py-12 text-center">
                            <ActivityIcon className="h-10 w-10 mx-auto text-muted-foreground mb-3" />
                            <p className="text-muted-foreground">No activity recorded yet</p>
                            <p className="text-xs text-muted-foreground mt-1">
                                Install <code className="bg-muted px-1 rounded">spatie/laravel-activitylog</code> to enable tracking
                            </p>
                        </div>
                    ) : (
                        <div className="divide-y">
                            {activities.map((a) => {
                                const modelName = a.model || a.model_type || "Unknown"
                                const Icon = modelIcons[modelName] || ActivityIcon
                                return (
                                    <div
                                        key={a.id}
                                        className="flex items-start gap-4 px-6 py-4 hover:bg-muted/50 cursor-pointer transition-colors group"
                                        onClick={() => setSelected(a)}
                                    >
                                        <div className="mt-1 rounded-lg bg-muted p-2 group-hover:bg-background transition-colors">
                                            <Icon className="h-4 w-4 text-muted-foreground" />
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <div className="flex items-center gap-2">
                                                <p className="text-sm font-medium">{a.description}</p>
                                                <Badge variant={getActionBadgeVariant(a.action)} className="text-xs capitalize">
                                                    <span className={`inline-block h-1.5 w-1.5 rounded-full mr-1 ${getActionColor(a.action)}`} />
                                                    {a.action}
                                                </Badge>
                                            </div>
                                            <div className="flex items-center gap-2 mt-1 text-xs text-muted-foreground">
                                                {a.user && (
                                                    <>
                                                        <User className="h-3 w-3" />
                                                        <span>{a.user.name}</span>
                                                        <span>•</span>
                                                    </>
                                                )}
                                                <Clock className="h-3 w-3" />
                                                <span>{a.created_at}</span>
                                                {modelName && (
                                                    <>
                                                        <span>•</span>
                                                        <span className="capitalize">{modelName}</span>
                                                    </>
                                                )}
                                            </div>
                                        </div>
                                        <ChevronRight className="h-4 w-4 text-muted-foreground mt-2 opacity-0 group-hover:opacity-100 transition-opacity" />
                                    </div>
                                )
                            })}
                        </div>
                    )}
                </CardContent>
            </Card>

            {/* Detail Sheet */}
            <Sheet open={!!selected} onOpenChange={(open) => !open && setSelected(null)}>
                <SheetContent className="sm:max-w-lg overflow-y-auto">
                    {selected && (
                        <>
                            <SheetHeader>
                                <SheetTitle className="flex items-center gap-2">
                                    <Badge variant={getActionBadgeVariant(selected.action)} className="capitalize">
                                        {selected.action}
                                    </Badge>
                                    {selected.model || selected.model_type || "Activity"}
                                </SheetTitle>
                                <SheetDescription>{selected.description}</SheetDescription>
                            </SheetHeader>

                            <div className="mt-6 space-y-6">
                                {/* Metadata */}
                                <div className="space-y-3">
                                    <h4 className="text-sm font-semibold text-muted-foreground uppercase tracking-wider">Details</h4>
                                    <div className="rounded-lg border divide-y">
                                        <DetailRow icon={Hash} label="ID" value={selected.id} />
                                        <DetailRow icon={FileText} label="Action" value={selected.action} />
                                        <DetailRow
                                            icon={modelIcons[selected.model || selected.model_type || ""] || ActivityIcon}
                                            label="Model"
                                            value={selected.model || selected.model_type || "—"}
                                        />
                                        {selected.model_id && (
                                            <DetailRow icon={Hash} label="Record ID" value={selected.model_id} />
                                        )}
                                        <DetailRow icon={Clock} label="Date" value={selected.created_at} />
                                        {selected.user && (
                                            <DetailRow icon={User} label="User" value={selected.user.name} />
                                        )}
                                    </div>
                                </div>

                                {/* Changed attributes */}
                                {selected.properties?.attributes && Object.keys(selected.properties.attributes).length > 0 && (
                                    <div className="space-y-3">
                                        <h4 className="text-sm font-semibold text-muted-foreground uppercase tracking-wider">
                                            {selected.action === "created" ? "Created With" : "New Values"}
                                        </h4>
                                        <div className="rounded-lg border bg-muted/30 p-4 space-y-2">
                                            {Object.entries(selected.properties.attributes).map(([key, val]) => (
                                                <div key={key} className="flex justify-between text-sm">
                                                    <span className="text-muted-foreground font-mono text-xs">{key}</span>
                                                    <span className="text-right max-w-[60%] truncate font-medium">{formatValue(val)}</span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {/* Old values (for updates) */}
                                {selected.properties?.old && Object.keys(selected.properties.old).length > 0 && (
                                    <div className="space-y-3">
                                        <h4 className="text-sm font-semibold text-muted-foreground uppercase tracking-wider">Previous Values</h4>
                                        <div className="rounded-lg border bg-destructive/5 p-4 space-y-2">
                                            {Object.entries(selected.properties.old).map(([key, val]) => (
                                                <div key={key} className="flex justify-between text-sm">
                                                    <span className="text-muted-foreground font-mono text-xs">{key}</span>
                                                    <span className="text-right max-w-[60%] truncate line-through opacity-60">{formatValue(val)}</span>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}

                                {/* Raw JSON fallback */}
                                {!selected.properties?.attributes && !selected.properties?.old && (
                                    <div className="space-y-3">
                                        <h4 className="text-sm font-semibold text-muted-foreground uppercase tracking-wider">Raw Data</h4>
                                        <pre className="rounded-lg border bg-muted/30 p-4 text-xs font-mono overflow-x-auto whitespace-pre-wrap">
                                            {JSON.stringify(selected, null, 2)}
                                        </pre>
                                    </div>
                                )}
                            </div>
                        </>
                    )}
                </SheetContent>
            </Sheet>
        </div>
    )
}

function DetailRow({ icon: Icon, label, value }: { icon: typeof Clock; label: string; value: string }) {
    return (
        <div className="flex items-center gap-3 px-4 py-3">
            <Icon className="h-4 w-4 text-muted-foreground shrink-0" />
            <span className="text-sm text-muted-foreground w-24 shrink-0">{label}</span>
            <span className="text-sm font-medium truncate">{value}</span>
        </div>
    )
}
