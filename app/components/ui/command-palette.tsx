"use client"

import { useCallback, useEffect, useState } from "react"
import { useRouter } from "next/navigation"
import { Command } from "cmdk"
import {
    LayoutDashboard,
    FolderOpen,
    Layers,
    FileCode,
    MessageSquare,
    Settings,
    Quote,
    ShieldCheck,
    Database,
    Activity,
    Search,
    User,
    Home,
} from "lucide-react"

const pages = [
    { name: "Home", href: "/", icon: Home, group: "Public" },
    { name: "Projects", href: "/projects", icon: FolderOpen, group: "Public" },
    { name: "About", href: "/about", icon: User, group: "Public" },
    { name: "Dashboard", href: "/dashboard", icon: LayoutDashboard, group: "Dashboard" },
    { name: "Manage Projects", href: "/dashboard/projects", icon: FolderOpen, group: "Dashboard" },
    { name: "Categories", href: "/dashboard/categories", icon: Layers, group: "Dashboard" },
    { name: "Technologies", href: "/dashboard/technologies", icon: FileCode, group: "Dashboard" },
    { name: "Testimonials", href: "/dashboard/testimonials", icon: Quote, group: "Dashboard" },
    { name: "Messages", href: "/dashboard/messages", icon: MessageSquare, group: "Dashboard" },
    { name: "SEO Audit", href: "/dashboard/seo-audit", icon: ShieldCheck, group: "Dashboard" },
    { name: "Backups", href: "/dashboard/backups", icon: Database, group: "Dashboard" },
    { name: "Activity Log", href: "/dashboard/activity", icon: Activity, group: "Dashboard" },
    { name: "Settings", href: "/dashboard/settings", icon: Settings, group: "Dashboard" },
]

export function CommandPalette() {
    const [open, setOpen] = useState(false)
    const router = useRouter()

    useEffect(() => {
        const down = (e: KeyboardEvent) => {
            if (e.key === "k" && (e.metaKey || e.ctrlKey)) {
                e.preventDefault()
                setOpen((prev) => !prev)
            }
        }
        document.addEventListener("keydown", down)
        return () => document.removeEventListener("keydown", down)
    }, [])

    const runCommand = useCallback((command: () => void) => {
        setOpen(false)
        command()
    }, [])

    if (!open) return null

    return (
        <div className="fixed inset-0 z-50">
            {/* Backdrop */}
            <div
                className="absolute inset-0 bg-black/50 backdrop-blur-sm"
                onClick={() => setOpen(false)}
            />

            {/* Command Dialog */}
            <div className="absolute left-1/2 top-[20%] -translate-x-1/2 w-full max-w-lg">
                <Command
                    className="rounded-xl border bg-card shadow-2xl overflow-hidden"
                    loop
                >
                    <div className="flex items-center gap-2 border-b px-4">
                        <Search className="h-4 w-4 shrink-0 text-muted-foreground" />
                        <Command.Input
                            placeholder="Type a command or search..."
                            className="flex h-12 w-full rounded-md bg-transparent text-sm outline-none placeholder:text-muted-foreground"
                            autoFocus
                        />
                    </div>

                    <Command.List className="max-h-[300px] overflow-y-auto p-2">
                        <Command.Empty className="py-6 text-center text-sm text-muted-foreground">
                            No results found.
                        </Command.Empty>

                        {["Public", "Dashboard"].map((group) => (
                            <Command.Group key={group} heading={group} className="text-xs font-medium text-muted-foreground px-2 py-1.5">
                                {pages
                                    .filter((p) => p.group === group)
                                    .map((page) => (
                                        <Command.Item
                                            key={page.href}
                                            value={page.name}
                                            onSelect={() => runCommand(() => router.push(page.href))}
                                            className="flex items-center gap-3 rounded-lg px-3 py-2 text-sm cursor-pointer aria-selected:bg-accent aria-selected:text-accent-foreground"
                                        >
                                            <page.icon className="h-4 w-4 text-muted-foreground" />
                                            <span>{page.name}</span>
                                        </Command.Item>
                                    ))}
                            </Command.Group>
                        ))}
                    </Command.List>

                    <div className="border-t px-4 py-2">
                        <p className="text-xs text-muted-foreground">
                            <kbd className="pointer-events-none inline-flex h-5 select-none items-center gap-1 rounded border bg-muted px-1.5 font-mono text-[10px] font-medium text-muted-foreground">
                                <span className="text-xs">⌘</span>K
                            </kbd>
                            {" "}to toggle • <kbd className="pointer-events-none inline-flex h-5 select-none items-center gap-1 rounded border bg-muted px-1.5 font-mono text-[10px] font-medium text-muted-foreground">
                                ↵
                            </kbd>
                            {" "}to select
                        </p>
                    </div>
                </Command>
            </div>
        </div>
    )
}
