import { MessagesClient } from "@/components/dashboard/messages/client"
import { fetchApi } from "@/lib/api-service"
import { ContactSubmission } from "@/types"

export default async function MessagesPage() {
    const session = await (await import("@/auth")).auth()
    // @ts-ignore
    const token = session?.accessToken as string | undefined

    const response = await fetchApi<{ data: ContactSubmission[] }>("/admin/contacts", {
        token
    }).catch(() => ({ data: [] }))

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <MessagesClient data={response.data} />
            </div>
        </div>
    )
}
