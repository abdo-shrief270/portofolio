import { fetchApi } from "@/lib/api-service"
import { ProjectForm } from "@/components/dashboard/projects/project-form"
import { Project, Category, Technology, PaginatedResponse, ApiResponse } from "@/types"
import { auth } from "@/auth"
import { notFound } from "next/navigation"

interface EditProjectPageProps {
    params: Promise<{
        projectId: string
    }>
}

export default async function EditProjectPage({
    params
}: EditProjectPageProps) {
    const session = await auth()
    // @ts-ignore
    const token = session?.accessToken
    const { projectId } = await params

    let project: Project | null = null
    let categories: Category[] = []
    let technologies: Technology[] = []

    try {
        // Fetch project, categories, and technologies in parallel
        const [projectRes, categoriesRes, technologiesRes] = await Promise.all([
            fetchApi<{ data: Project }>(`/admin/projects/${projectId}`, { token }),
            fetchApi<PaginatedResponse<Category>>("/admin/categories", { token }),
            fetchApi<PaginatedResponse<Technology>>("/admin/technologies", { token }),
        ])

        project = projectRes.data
        categories = categoriesRes.data
        technologies = technologiesRes.data

    } catch (error) {
        console.error("Failed to fetch project data:", error)
        // If project fetch failed, likely 404 or prohibited
        // We can't distinguish easily without better error handling in generic fetchApi
        // But usually checking if project is null is enough to show 404
    }

    if (!project) {
        notFound()
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <ProjectForm
                    initialData={project}
                    categories={categories}
                    technologies={technologies}
                />
            </div>
        </div>
    )
}
