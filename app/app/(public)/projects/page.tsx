import { fetchApi } from "@/lib/api-service"
import { Project, Category, Technology } from "@/types"
import { ProjectsClient } from "@/components/public/projects-client"

async function getProjects() {
    try {
        const res = await fetchApi<{ data: Project[] }>("/projects")
        return res.data
    } catch (e) {
        console.error("Failed to fetch projects:", e)
        return []
    }
}

async function getCategories() {
    try {
        const res = await fetchApi<{ data: Category[] }>("/categories")
        return res.data
    } catch (e) {
        console.error("Failed to fetch categories:", e)
        return []
    }
}

async function getTechnologies() {
    try {
        const res = await fetchApi<{ data: Technology[] }>("/technologies")
        return res.data
    } catch (e) {
        console.error("Failed to fetch technologies:", e)
        return []
    }
}

export default async function ProjectsPage() {
    const [projects, categories, technologies] = await Promise.all([
        getProjects(),
        getCategories(),
        getTechnologies(),
    ])

    return (
        <div className="container py-10 mx-auto px-4 md:px-6">
            <div className="flex flex-col items-start gap-4 md:flex-row md:justify-between md:gap-8 mb-10">
                <div className="grid gap-1">
                    <h1 className="text-3xl font-bold tracking-tight">Projects</h1>
                    <p className="text-muted-foreground">
                        Explore my latest work, side projects, and open source contributions.
                    </p>
                </div>
            </div>
            <ProjectsClient
                initialProjects={projects}
                categories={categories}
                technologies={technologies}
            />
        </div>
    )
}
