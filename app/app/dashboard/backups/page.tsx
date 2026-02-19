"use client"

import { useState } from "react"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import { fetchApi } from "@/lib/api-service"
import {
    Database,
    Download,
    Plus,
    RefreshCw,
    CheckCircle2,
    Clock,
    HardDrive,
    AlertTriangle,
} from "lucide-react"

interface Backup {
    name: string
    size: string
    created_at: string
    status: "completed" | "in_progress" | "failed"
}

export default function BackupsPage() {
    const [backups, setBackups] = useState<Backup[]>([])
    const [loading, setLoading] = useState(false)
    const [creating, setCreating] = useState(false)
    const [message, setMessage] = useState("")

    const loadBackups = async () => {
        setLoading(true)
        try {
            const response = await fetchApi<{ data: Backup[] }>("/admin/backup/list")
            setBackups(response.data)
        } catch (e) {
            // Backups endpoint may not exist yet; show empty state
            setBackups([])
        } finally {
            setLoading(false)
        }
    }

    const createBackup = async () => {
        setCreating(true)
        setMessage("")
        try {
            await fetchApi("/admin/backup/create", { method: "POST" })
            setMessage("Backup created successfully!")
            loadBackups()
        } catch (e: any) {
            setMessage(e.message || "Failed to create backup.")
        } finally {
            setCreating(false)
        }
    }

    const downloadBackup = async (name: string) => {
        try {
            // We need to bypass fetchApi's JSON parsing
            const session = await import("next-auth/react").then(mod => mod.getSession())
            const headers: HeadersInit = {}

            // @ts-expect-error - accessToken exists on session
            if (session?.accessToken) {
                // @ts-expect-error
                headers["Authorization"] = `Bearer ${session.accessToken}`
            }

            const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/v1/admin/backup/${name}/download`, {
                headers,
            })

            if (!response.ok) throw new Error("Download failed")

            const blob = await response.blob()
            const url = window.URL.createObjectURL(blob)
            const a = document.createElement('a')
            a.href = url
            a.download = name
            document.body.appendChild(a)
            a.click()
            window.URL.revokeObjectURL(url)
            document.body.removeChild(a)
        } catch (e) {
            console.error(e)
            setMessage("Failed to download backup.")
        }
    }

    const StatusIcon = ({ status }: { status: string }) => {
        switch (status) {
            case "completed": return <CheckCircle2 className="h-4 w-4 text-emerald-500" />
            case "in_progress": return <RefreshCw className="h-4 w-4 text-amber-500 animate-spin" />
            case "failed": return <AlertTriangle className="h-4 w-4 text-destructive" />
            default: return <Clock className="h-4 w-4 text-muted-foreground" />
        }
    }

    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <h2 className="text-3xl font-bold tracking-tight text-primary">Backups</h2>
                <div className="flex gap-2">
                    <Button variant="outline" onClick={loadBackups} disabled={loading}>
                        <RefreshCw className={`h-4 w-4 mr-2 ${loading ? "animate-spin" : ""}`} /> Refresh
                    </Button>
                    <Button onClick={createBackup} disabled={creating}>
                        <Plus className="h-4 w-4 mr-2" /> {creating ? "Creating..." : "New Backup"}
                    </Button>
                </div>
            </div>

            {message && (
                <Card>
                    <CardContent className="py-3 text-sm">
                        {message}
                    </CardContent>
                </Card>
            )}

            <div className="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Total Backups</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="text-3xl font-bold">{backups.length}</div>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Latest Backup</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="text-sm font-medium">{backups.length > 0 ? backups[0].created_at : "None"}</div>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader className="pb-2">
                        <CardTitle className="text-sm font-medium">Storage Used</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="flex items-center gap-2">
                            <HardDrive className="h-4 w-4 text-muted-foreground" />
                            <span className="text-sm">{backups.length > 0 ? (backups.reduce((a, b) => a + parseFloat(b.size || "0"), 0) / (1024 * 1024)).toFixed(2) + " MB" : "0 MB"}</span>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <Card>
                <CardContent className="p-0">
                    {backups.length === 0 ? (
                        <div className="py-12 text-center">
                            <Database className="h-10 w-10 mx-auto text-muted-foreground mb-3" />
                            <p className="text-muted-foreground">No backups yet</p>
                            <p className="text-xs text-muted-foreground mt-1">Click "New Backup" to create your first backup</p>
                        </div>
                    ) : (
                        <div className="divide-y">
                            {backups.map((b, i) => (
                                <div key={i} className="flex items-center justify-between px-6 py-4">
                                    <div className="flex items-center gap-3">
                                        <StatusIcon status={b.status} />
                                        <div>
                                            <p className="text-sm font-medium">{b.name}</p>
                                            <p className="text-xs text-muted-foreground">{b.created_at}</p>
                                        </div>
                                    </div>
                                    <div className="flex items-center gap-3">
                                        <Badge variant="secondary">{b.size}</Badge>
                                        <Button variant="ghost" size="icon" onClick={() => downloadBackup(b.name)}>
                                            <Download className="h-4 w-4" />
                                        </Button>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </CardContent>
            </Card>
        </div>
    )
}
