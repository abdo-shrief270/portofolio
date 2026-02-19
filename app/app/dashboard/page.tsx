"use client"

import { useEffect, useState } from "react"
import Link from "next/link"
import { Badge } from "@/components/ui/badge"
import { fetchApi } from "@/lib/api-service"
import { DashboardChart } from "@/components/dashboard/dashboard-chart"
import { motion } from "framer-motion"
import {
    FolderKanban,
    Eye,
    Mail,
    TrendingUp,
    TrendingDown,
    Minus,
    MailOpen,
    ArrowUpRight,
    Users,
} from "lucide-react"

interface DashboardStats {
    total_projects: number
    total_views: number
    total_contacts: number
    new_contacts: number
    recent_views: number
    views_trend: number
    contacts_trend: number
    active_projects: number
}

interface PopularProject {
    id: string
    title: string
    slug: string
    status: string
    views: number
}

interface RecentContact {
    id: string
    name: string
    email: string
    subject: string
    status: string
    created_at: string
}

function TrendBadge({ value }: { value: number }) {
    const isPositive = value > 0
    const isNegative = value < 0

    return (
        <div className={cn(
            "flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider transition-all",
            isPositive ? "bg-emerald-500/10 text-emerald-500 border border-emerald-500/20" :
                isNegative ? "bg-destructive/10 text-destructive border border-destructive/20" :
                    "bg-muted/10 text-muted-foreground border border-muted/20"
        )}>
            {isPositive ? <TrendingUp className="h-3 w-3" /> : isNegative ? <TrendingDown className="h-3 w-3" /> : <Minus className="h-3 w-3" />}
            {Math.abs(value)}%
        </div>
    )
}

function StatusDot({ status }: { status: string }) {
    const colors: Record<string, string> = {
        live: "bg-emerald-500",
        in_progress: "bg-amber-500",
        completed: "bg-blue-500 shadow-blue-500/50",
        archived: "bg-zinc-600",
        new: "bg-primary shadow-primary/50",
        read: "bg-zinc-500",
        replied: "bg-emerald-500 shadow-emerald-500/50",
    }
    return (
        <div className="relative flex h-2 w-2">
            <span className={cn("animate-ping absolute inline-flex h-full w-full rounded-full opacity-75", colors[status] || "bg-zinc-500")} />
            <span className={cn("relative inline-flex rounded-full h-2 w-2 shadow-[0_0_8px_rgba(0,0,0,0.2)]", colors[status] || "bg-zinc-500")} />
        </div>
    )
}

import { cn } from "@/lib/utils"

export default function DashboardPage() {
    const [stats, setStats] = useState<DashboardStats | null>(null)
    const [popular, setPopular] = useState<PopularProject[]>([])
    const [contacts, setContacts] = useState<RecentContact[]>([])
    const [chartData, setChartData] = useState<{ name: string; views: number }[]>([])
    const [loading, setLoading] = useState(true)

    useEffect(() => {
        async function loadData() {
            try {
                const [statsData, popularData, contactsData, chartRes] = await Promise.all([
                    fetchApi<DashboardStats>("/admin/dashboard/stats"),
                    fetchApi<PopularProject[]>("/admin/dashboard/popular-projects"),
                    fetchApi<RecentContact[]>("/admin/dashboard/recent-contacts"),
                    fetchApi<{ name: string; views: number }[]>("/admin/dashboard/views-chart").catch(() => []),
                ])
                setStats(statsData)
                setPopular(popularData)
                setContacts(contactsData)
                setChartData(chartRes as { name: string; views: number }[])
            } catch (error) {
                console.error("Failed to load dashboard data:", error)
            } finally {
                setLoading(false)
            }
        }
        loadData()
    }, [])

    if (loading || !stats) {
        return (
            <div className="space-y-8 animate-pulse">
                <div className="h-8 w-48 bg-muted rounded-xl" />
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    {Array.from({ length: 4 }).map((_, i) => (
                        <div key={i} className="h-32 glass-card rounded-3xl" />
                    ))}
                </div>
            </div>
        )
    }

    const statCards = [
        {
            title: "Performance",
            value: stats.total_views.toLocaleString(),
            subtitle: "Lifetime views",
            icon: Eye,
            trend: stats.views_trend,
            color: "text-blue-500"
        },
        {
            title: "Network",
            value: stats.total_contacts,
            subtitle: "Connected people",
            icon: Users,
            trend: stats.contacts_trend,
            color: "text-primary"
        },
        {
            title: "Deliverables",
            value: stats.total_projects,
            subtitle: `${stats.active_projects} active now`,
            icon: FolderKanban,
            trend: null,
            color: "text-emerald-500"
        },
        {
            title: "Unread",
            value: stats.new_contacts,
            subtitle: "Awaiting response",
            icon: MailOpen,
            trend: null,
            color: "text-amber-500"
        },
    ]

    return (
        <div className="space-y-10 pb-10">
            <header className="flex flex-col gap-2">
                <h2 className="text-4xl font-bold font-outfit tracking-tight text-gradient">Executive Summary</h2>
                <p className="text-muted-foreground text-sm uppercase font-bold tracking-widest leading-none">Real-time portfolio metrics</p>
            </header>

            {/* Stats Cards */}
            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                {statCards.map((card, idx) => (
                    <motion.div
                        key={card.title}
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: idx * 0.1 }}
                        className="glass-card rounded-[2rem] p-8 group hover:border-primary/40 transition-all duration-300"
                    >
                        <div className="flex items-center justify-between mb-6">
                            <div className={cn("p-3 rounded-2xl bg-sidebar-accent transition-colors group-hover:bg-primary/20", card.color)}>
                                <card.icon className="h-6 w-6" />
                            </div>
                            {card.trend !== null && <TrendBadge value={card.trend} />}
                        </div>
                        <div className="space-y-1">
                            <p className="text-[10px] font-bold uppercase tracking-[0.2em] text-muted-foreground/60">{card.title}</p>
                            <div className="text-3xl font-bold font-outfit text-foreground tracking-tight">{card.value}</div>
                            <p className="text-xs font-medium text-muted-foreground pt-1">{card.subtitle}</p>
                        </div>
                    </motion.div>
                ))}
            </div>

            {/* Views Chart */}
            {chartData.length > 0 && (
                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.5 }}
                >
                    <DashboardChart data={chartData} title="Audience Engagement" />
                </motion.div>
            )}

            {/* Popular Projects + Recent Contacts */}
            <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-7">
                <motion.div
                    initial={{ opacity: 0, x: -20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.6 }}
                    className="col-span-4 glass-card rounded-[2.5rem] p-8"
                >
                    <div className="flex items-center justify-between mb-8">
                        <h3 className="text-xl font-bold font-outfit text-white">Project Velocity</h3>
                        <Badge variant="outline" className="glass border-white/5 uppercase text-[10px] tracking-widest px-3">Top Performing</Badge>
                    </div>
                    {popular.length === 0 ? (
                        <p className="text-muted-foreground text-sm py-10 text-center">No project views yet.</p>
                    ) : (
                        <div className="space-y-6">
                            {popular.map((project) => (
                                <Link
                                    key={project.id}
                                    href={`/dashboard/projects/${project.id}`}
                                    className="flex items-center justify-between group cursor-pointer p-2 rounded-2xl hover:bg-white/5 transition-colors"
                                >
                                    <div className="flex items-center gap-4">
                                        <StatusDot status={project.status} />
                                        <div>
                                            <p className="text-sm font-bold text-zinc-200 group-hover:text-primary transition-colors">{project.title}</p>
                                            <p className="text-xs text-zinc-500 mt-1">/{project.slug}</p>
                                        </div>
                                    </div>
                                    <div className="flex items-center gap-4">
                                        <div className="flex flex-col items-end">
                                            <span className="text-sm font-bold text-white">{project.views}</span>
                                            <span className="text-[10px] uppercase font-bold text-zinc-600 tracking-tighter">Views</span>
                                        </div>
                                        <div className="p-2 rounded-lg bg-zinc-800 group-hover:bg-primary transition-colors">
                                            <ArrowUpRight className="h-3 w-3 text-white" />
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    )}
                </motion.div>

                <motion.div
                    initial={{ opacity: 0, x: 20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ delay: 0.7 }}
                    className="col-span-3 glass-card rounded-[2.5rem] p-8 flex flex-col"
                >
                    <div className="flex items-center justify-between mb-8">
                        <h3 className="text-xl font-bold font-outfit text-white">Inbound Messages</h3>
                        <div className="h-2 w-2 rounded-full bg-primary animate-pulse" />
                    </div>
                    {contacts.length === 0 ? (
                        <p className="text-muted-foreground text-sm py-10 text-center">No messages yet.</p>
                    ) : (
                        <div className="space-y-6 flex-1">
                            {contacts.slice(0, 5).map((contact) => (
                                <Link
                                    key={contact.id}
                                    href={`/dashboard/messages/${contact.id}`}
                                    className="flex items-start justify-between gap-4 p-3 rounded-2xl hover:bg-white/5 transition-colors group cursor-pointer"
                                >
                                    <div className="min-w-0 flex-1">
                                        <div className="flex items-center gap-2 mb-1">
                                            <StatusDot status={contact.status} />
                                            <p className="text-sm font-bold text-zinc-200 truncate group-hover:text-primary transition-colors">{contact.name}</p>
                                        </div>
                                        <p className="text-xs text-zinc-500 truncate">{contact.subject}</p>
                                    </div>
                                    <span className="text-[10px] font-bold text-zinc-600 uppercase tracking-tighter pt-1">{contact.created_at}</span>
                                </Link>
                            ))}
                        </div>
                    )}
                </motion.div>
            </div>
        </div>
    )
}
