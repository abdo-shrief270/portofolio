import { CategoryForm } from "@/components/dashboard/categories/category-form"
import { fetchApi } from "@/lib/api-service"
import { Category } from "@/types"

export default async function CategoryPage({
    params
}: {
    params: Promise<{ categoryId: string }>
}) {
    const { categoryId } = await params

    let category: Category | null = null

    if (categoryId !== "new") {
        try {
            const session = await (await import("@/auth")).auth()
            // @ts-ignore
            const token = session?.accessToken as string | undefined

            const response = await fetchApi<{ data: Category }>(`/admin/categories/${categoryId}`, {
                token
            })
            category = response.data
        } catch (error) {
            category = null
        }
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <CategoryForm initialData={category} />
            </div>
        </div>
    )
}
