import { fetchApi } from "@/lib/api-service"
import { ProjectClient } from "@/components/dashboard/projects/client"
import { Project, PaginatedResponse } from "@/types"
import { auth } from "@/auth"

export default async function ProjectsPage() {
    const session = await auth()
    let projects: Project[] = []

    try {
        // @ts-ignore
        const token = session?.accessToken
        const response = await fetchApi<PaginatedResponse<Project>>("/admin/projects", {
            token,
            cache: 'no-store'
        })
        projects = response.data
    } catch (error) {
        console.error("Failed to fetch projects:", error)
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <ProjectClient data={projects} />
            </div>
        </div>
    )
}
