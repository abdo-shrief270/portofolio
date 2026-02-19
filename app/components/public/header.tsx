"use client"

import Link from "next/link"
import { usePathname } from "next/navigation"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { ModeToggle } from "@/components/ui/mode-toggle"
import { KeyRound } from "lucide-react"

const routes = [
    {
        href: "/",
        label: "Home",
    },
    {
        href: "/projects",
        label: "Projects",
    },
    {
        href: "/about",
        label: "About",
    },
    {
        href: "/contact",
        label: "Contact",
    },
]

export const Header = () => {
    const pathname = usePathname()

    return (
        <header className="sm:flex sm:justify-between py-3 px-4 border-b">
            <div className="relative px-4 sm:px-6 lg:px-8 flex h-16 items-center justify-between w-full max-w-7xl mx-auto">
                <div className="flex items-center">
                    <Link href="/" className="ml-4 lg:ml-0 gap-x-2 flex items-center">
                        <p className="font-bold text-xl">PORTFOLIO</p>
                    </Link>
                </div>
                <nav className="mx-6 flex items-center space-x-4 lg:space-x-6 hidden md:block">
                    {routes.map((route) => (
                        <Link
                            key={route.href}
                            href={route.href}
                            className={cn(
                                "text-sm font-medium transition-colors hover:text-black dark:hover:text-white",
                                pathname === route.href ? "text-black dark:text-white" : "text-muted-foreground"
                            )}
                        >
                            {route.label}
                        </Link>
                    ))}
                </nav>
                <div className="flex items-center space-x-4">
                    <ModeToggle />
                    <Link href="/login">
                        <Button variant="ghost" size="icon">
                            <KeyRound className="h-5 w-5" />
                        </Button>
                    </Link>
                </div>
            </div>
        </header>
    )
}
