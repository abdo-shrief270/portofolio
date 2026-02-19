import { TechnologyClient } from "@/components/dashboard/technologies/client"
import { fetchApi } from "@/lib/api-service"
import { Technology } from "@/types"

export default async function TechnologiesPage() {
    const session = await (await import("@/auth")).auth()
    // @ts-ignore
    const token = session?.accessToken as string | undefined

    const response = await fetchApi<{ data: Technology[] }>("/admin/technologies", {
        token
    }).catch(() => ({ data: [] }))

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <TechnologyClient data={response.data} />
            </div>
        </div>
    )
}
