import { SettingsForm } from "@/components/dashboard/settings/settings-form"
import { fetchApi } from "@/lib/api-service"
import { SiteSetting } from "@/types"

export default async function SettingsPage() {
    const session = await (await import("@/auth")).auth()
    // @ts-ignore
    const token = session?.accessToken as string | undefined

    const response = await fetchApi<{ data: SiteSetting[] }>("/admin/settings", {
        token
    }).catch(() => ({ data: [] }))

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <SettingsForm initialData={response.data} />
            </div>
        </div>
    )
}
