import type { MetadataRoute } from "next"

const BASE_URL = process.env.NEXT_PUBLIC_SITE_URL || "https://portfolio.com"

export default async function sitemap(): Promise<MetadataRoute.Sitemap> {
    const staticPages: MetadataRoute.Sitemap = [
        {
            url: BASE_URL,
            lastModified: new Date(),
            changeFrequency: "weekly",
            priority: 1,
        },
        {
            url: `${BASE_URL}/projects`,
            lastModified: new Date(),
            changeFrequency: "weekly",
            priority: 0.9,
        },
        {
            url: `${BASE_URL}/about`,
            lastModified: new Date(),
            changeFrequency: "monthly",
            priority: 0.8,
        },
        {
            url: `${BASE_URL}/contact`,
            lastModified: new Date(),
            changeFrequency: "yearly",
            priority: 0.7,
        },
    ]

    // Fetch dynamic project slugs
    try {
        const API_URL = process.env.NEXT_PUBLIC_API_URL + "/api/v1"
        const res = await fetch(`${API_URL}/projects`, { next: { revalidate: 3600 } })
        const json = await res.json()
        const projects = json.data || []

        const projectPages: MetadataRoute.Sitemap = projects.map((p: any) => ({
            url: `${BASE_URL}/projects/${p.slug}`,
            lastModified: new Date(p.updated_at || p.created_at),
            changeFrequency: "monthly" as const,
            priority: 0.6,
        }))

        return [...staticPages, ...projectPages]
    } catch {
        return staticPages
    }
}
