import { TechnologyForm } from "@/components/dashboard/technologies/technology-form"
import { fetchApi } from "@/lib/api-service"
import { Technology } from "@/types"

export default async function TechnologyPage({
    params
}: {
    params: Promise<{ technologyId: string }>
}) {
    const { technologyId } = await params

    let technology: Technology | null = null

    if (technologyId !== "new") {
        try {
            const session = await (await import("@/auth")).auth()
            // @ts-ignore
            const token = session?.accessToken as string | undefined

            const response = await fetchApi<{ data: Technology }>(`/admin/technologies/${technologyId}`, {
                token
            })
            technology = response.data
        } catch (error) {
            technology = null
        }
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <TechnologyForm initialData={technology} />
            </div>
        </div>
    )
}
