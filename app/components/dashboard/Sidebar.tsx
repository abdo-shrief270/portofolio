"use client"

import * as React from "react"
import Link from "next/link"
import { usePathname } from "next/navigation"
import { motion } from "framer-motion"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import {
    LayoutDashboard,
    FolderOpen,
    Layers,
    FileCode,
    MessageSquare,
    Settings,
    LogOut,
    Menu,
    Quote,
    ShieldCheck,
    Database,
    Activity,
    Terminal,
    Sparkles,
} from "lucide-react"
import { Sheet, SheetContent, SheetTrigger } from "@/components/ui/sheet"

interface SidebarProps extends React.HTMLAttributes<HTMLDivElement> { }

export function Sidebar({ className }: SidebarProps) {
    const pathname = usePathname()
    const [isOpen, setIsOpen] = React.useState(false)

    const routes = [
        { label: "Overview", icon: LayoutDashboard, href: "/dashboard" },
        { label: "Projects", icon: FolderOpen, href: "/dashboard/projects" },
        { label: "Categories", icon: Layers, href: "/dashboard/categories" },
        { label: "Technologies", icon: FileCode, href: "/dashboard/technologies" },
        { label: "Testimonials", icon: Quote, href: "/dashboard/testimonials" },
        { label: "Messages", icon: MessageSquare, href: "/dashboard/messages" },
        { label: "SEO Audit", icon: ShieldCheck, href: "/dashboard/seo-audit" },
        { label: "Backups", icon: Database, href: "/dashboard/backups" },
        { label: "Activity", icon: Activity, href: "/dashboard/activity" },
        { label: "Terminal", icon: Terminal, href: "/dashboard/terminal" },
        { label: "Settings", icon: Settings, href: "/dashboard/settings" },
    ]

    const SidebarContent = () => (
        <div className="flex flex-col h-full bg-sidebar border-r border-sidebar-border shadow-2xl overflow-hidden">
            {/* Logo Section */}
            <div className="px-8 py-10">
                <Link href="/dashboard" className="flex items-center gap-3 group">
                    <div className="h-10 w-10 rounded-2xl bg-primary flex items-center justify-center shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform duration-300">
                        <Sparkles className="h-6 w-6 text-primary-foreground" />
                    </div>
                    <div className="flex flex-col">
                        <span className="text-xl font-bold font-outfit tracking-tighter text-foreground">AG_PORTFOLIO</span>
                        <span className="text-[10px] text-primary font-bold uppercase tracking-widest leading-none">Management UI</span>
                    </div>
                </Link>
            </div>

            {/* Navigation */}
            <div className="flex-1 px-4 overflow-y-auto custom-scrollbar pt-2">
                <nav className="space-y-1.5">
                    {routes.map((route) => {
                        const isActive = pathname === route.href || (route.href !== "/dashboard" && pathname.startsWith(route.href))
                        return (
                            <Link
                                key={route.href}
                                href={route.href}
                                onClick={() => setIsOpen(false)}
                                className={cn(
                                    "group relative flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-300",
                                    isActive
                                        ? "bg-primary text-primary-foreground shadow-lg shadow-primary/25"
                                        : "text-sidebar-foreground/60 hover:text-foreground hover:bg-sidebar-accent"
                                )}
                            >
                                <route.icon className={cn("h-5 w-5 transition-transform duration-300 group-hover:scale-110", isActive ? "text-primary-foreground" : "text-sidebar-foreground/40 group-hover:text-primary")} />
                                <span className="font-outfit">{route.label}</span>
                                {isActive && (
                                    <motion.div
                                        layoutId="sidebar-active-pill"
                                        className="absolute left-0 w-1 h-6 bg-white rounded-r-full"
                                    />
                                )}
                            </Link>
                        )
                    })}
                </nav>
            </div>

            {/* Sticky Bottom Actions */}
            <div className="p-4 bg-sidebar/80 backdrop-blur-md border-t border-sidebar-border mt-auto">
                <Button
                    variant="ghost"
                    className="w-full justify-start gap-3 rounded-2xl h-12 text-sidebar-foreground/60 hover:text-destructive hover:bg-destructive/10 group transition-all"
                >
                    <div className="p-2 rounded-xl group-hover:bg-destructive/20 bg-sidebar-accent transition-colors">
                        <LogOut className="h-4 w-4" />
                    </div>
                    <span className="font-bold font-outfit uppercase tracking-wider text-xs">Terminate Session</span>
                </Button>
            </div>
        </div>
    )

    return (
        <>
            {/* Desktop Sidebar */}
            <aside className={cn("hidden md:flex h-full w-72 flex-col fixed inset-y-0 z-50", className)}>
                <SidebarContent />
            </aside>

            {/* Mobile Navigation */}
            <Sheet open={isOpen} onOpenChange={setIsOpen}>
                <SheetTrigger asChild>
                    <Button variant="ghost" size="icon" className="md:hidden fixed top-4 left-4 z-[60] glass shadow-md">
                        <Menu className="h-5 w-5" />
                    </Button>
                </SheetTrigger>
                <SheetContent side="left" className="p-0 bg-sidebar w-80 border-r-0">
                    <SidebarContent />
                </SheetContent>
            </Sheet>
        </>
    )
}
