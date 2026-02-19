"use client"

import * as React from "react"
import { usePathname } from "next/navigation"
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { ModeToggle } from "@/components/ui/mode-toggle"
import { UserNav } from "@/components/dashboard/UserNav"

export function TopBar() {
    const pathname = usePathname()
    const segments = pathname.split("/").filter(Boolean)

    return (
        <header className="sticky top-0 z-40 flex h-20 items-center justify-between gap-4 glass border-b border-sidebar-border px-8 transition-all duration-300">
            <div className="flex items-center gap-4">
                <Breadcrumb>
                    <BreadcrumbList className="flex items-center text-xs font-semibold uppercase tracking-widest text-muted-foreground/60">
                        <BreadcrumbItem>
                            <BreadcrumbLink href="/dashboard" className="hover:text-primary transition-colors">Admin</BreadcrumbLink>
                        </BreadcrumbItem>
                        {segments.length > 1 && <BreadcrumbSeparator className="opacity-20 translate-y-px" />}
                        {segments.slice(1).map((segment: string, index: number) => {
                            const isLast = index === segments.length - 2
                            const href = `/dashboard/${segments.slice(1, index + 2).join("/")}`
                            return (
                                <React.Fragment key={href}>
                                    <BreadcrumbItem>
                                        {isLast ? (
                                            <BreadcrumbPage className="text-foreground font-bold tracking-tight">{segment}</BreadcrumbPage>
                                        ) : (
                                            <BreadcrumbLink href={href} className="hover:text-primary transition-colors">{segment}</BreadcrumbLink>
                                        )}
                                    </BreadcrumbItem>
                                    {!isLast && <BreadcrumbSeparator className="opacity-20 translate-y-px" />}
                                </React.Fragment>
                            )
                        })}
                    </BreadcrumbList>
                </Breadcrumb>
            </div>

            <div className="flex items-center gap-4">
                <div className="flex items-center gap-2 px-3 py-1.5 rounded-full bg-sidebar-accent border border-sidebar-border mr-2">
                    <div className="h-2 w-2 rounded-full bg-green-500 animate-pulse" />
                    <span className="text-[10px] font-bold text-muted-foreground uppercase tracking-tighter">System Live</span>
                </div>
                <div className="h-8 w-[1px] bg-sidebar-border mx-2" />
                <ModeToggle />
                <UserNav />
            </div>
        </header>
    )
}
