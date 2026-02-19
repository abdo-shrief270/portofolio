import type { MetadataRoute } from "next"

const BASE_URL = process.env.NEXT_PUBLIC_SITE_URL || "https://portfolio.com"

export default function robots(): MetadataRoute.Robots {
    return {
        rules: [
            {
                userAgent: "*",
                allow: "/",
                disallow: ["/dashboard/", "/api/", "/login", "/preview/"],
            },
        ],
        sitemap: `${BASE_URL}/sitemap.xml`,
    }
}
