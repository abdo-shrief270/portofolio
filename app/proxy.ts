import { auth } from "@/auth"
import { NextRequest, NextResponse } from "next/server"

export const config = {
    matcher: ["/((?!api/|_next/|_static/|_vercel|[\\w-]+\\.\\w+).*)"],
}

export default async function proxy(request: NextRequest) {
    const url = request.nextUrl
    const hostname = request.headers.get("host") || "portfolio.test"

    // ── Auth Protection ─────────────────────────────────
    if (url.pathname.startsWith("/dashboard")) {
        const session = await auth()
        if (!session) {
            return NextResponse.redirect(new URL("/login", request.url))
        }
    }

    // ── Subdomain Routing ────────────────────────────────
    let subdomain: string | null = null

    if (process.env.NODE_ENV === "development") {
        if (hostname.includes(".localhost")) {
            const parts = hostname.split(".localhost")
            if (parts.length > 0 && parts[0] !== "www") {
                subdomain = parts[0]
            }
        } else if (hostname.endsWith(".portfolio.test")) {
            const parts = hostname.replace(".portfolio.test", "").split(".")
            if (parts.length > 0 && parts[0] !== "www") {
                subdomain = parts[0]
            }
        }
    } else {
        const rootDomain = process.env.NEXT_PUBLIC_ROOT_DOMAIN || "portfolio.com"
        if (hostname.endsWith(`.${rootDomain}`)) {
            const parts = hostname.replace(`.${rootDomain}`, "").split(".")
            if (parts.length > 0 && parts[0] !== "www") {
                subdomain = parts[0]
            }
        }
    }

    if (subdomain) {
        return NextResponse.rewrite(
            new URL(`/preview/${subdomain}${url.pathname}`, request.url)
        )
    }

    return NextResponse.next()
}
