import { fetchApi } from "@/lib/api-service"
import { ProjectForm } from "@/components/dashboard/projects/project-form"
import { Category, Technology, PaginatedResponse } from "@/types"
import { auth } from "@/auth"

export default async function CreateProjectPage() {
    const session = await auth()
    // @ts-ignore
    const token = session?.accessToken

    let categories: Category[] = []
    let technologies: Technology[] = []

    try {
        const [categoriesRes, technologiesRes] = await Promise.all([
            fetchApi<PaginatedResponse<Category>>("/admin/categories", { token }),
            fetchApi<PaginatedResponse<Technology>>("/admin/technologies", { token }),
        ])
        categories = categoriesRes.data
        technologies = technologiesRes.data
    } catch (error) {
        console.error("Failed to fetch dependencies:", error)
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <ProjectForm
                    initialData={null}
                    categories={categories}
                    technologies={technologies}
                />
            </div>
        </div>
    )
}
