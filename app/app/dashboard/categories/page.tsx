import { CategoryClient } from "@/components/dashboard/categories/client"
import { fetchApi } from "@/lib/api-service"
import { Category } from "@/types"

export default async function CategoriesPage() {
    const session = await (await import("@/auth")).auth()
    // @ts-ignore
    const token = session?.accessToken as string | undefined

    const response = await fetchApi<{ data: Category[] }>("/admin/categories", {
        token
    }).catch(() => ({ data: [] }))

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <CategoryClient data={response.data} />
            </div>
        </div>
    )
}
