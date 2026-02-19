import { MessageDetail } from "@/components/dashboard/messages/message-detail"
import { fetchApi } from "@/lib/api-service"
import { ContactSubmission } from "@/types"
import { Heading } from "@/components/ui/heading"

export default async function MessagePage({
    params
}: {
    params: Promise<{ messageId: string }>
}) {
    const { messageId } = await params

    let message: ContactSubmission | null = null

    try {
        const session = await (await import("@/auth")).auth()
        // @ts-ignore
        const token = session?.accessToken as string | undefined

        const response = await fetchApi<{ data: ContactSubmission }>(`/admin/contacts/${messageId}`, {
            token
        })
        message = response.data
    } catch (error) {
        message = null
    }

    if (!message) {
        return (
            <div className="flex-col">
                <div className="flex-1 space-y-4 p-8 pt-6">
                    <Heading title="Not Found" description="The message you are looking for does not exist." />
                </div>
            </div>
        )
    }

    return <MessageDetail initialData={message} />
}
