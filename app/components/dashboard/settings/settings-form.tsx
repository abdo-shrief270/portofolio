"use client"

import { useState } from "react"
import { useForm, useFieldArray } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import * as z from "zod"
import { Loader2, Save } from "lucide-react"
import { useRouter } from "next/navigation"
import { toast } from "sonner"

import { Button } from "@/components/ui/button"
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import { Separator } from "@/components/ui/separator"
import { Heading } from "@/components/ui/heading"
import { SiteSetting } from "@/types"
import { fetchApi } from "@/lib/api-service"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Textarea } from "@/components/ui/textarea"

const formSchema = z.object({
    settings: z.array(z.object({
        key: z.string(),
        value: z.string(),
        group: z.string(),
        type: z.string().optional(),
    }))
})

type SettingsFormValues = z.infer<typeof formSchema>

interface SettingsFormProps {
    initialData: SiteSetting[]
}

export const SettingsForm: React.FC<SettingsFormProps> = ({
    initialData
}) => {
    const router = useRouter()
    const [loading, setLoading] = useState(false)

    // Group settings for display (not for form structure, to keep it simple)
    const groupedSettings = initialData.reduce((acc, setting) => {
        if (!acc[setting.group]) acc[setting.group] = []
        acc[setting.group].push(setting)
        return acc
    }, {} as Record<string, SiteSetting[]>)

    const form = useForm<SettingsFormValues>({
        resolver: zodResolver(formSchema),
        defaultValues: {
            settings: initialData
        },
    })

    // We need to keep track of index mapping if we display by group
    // A simple way is to map the flat array to grouping in the UI
    // but bind to the correct index in the form array.

    const onSubmit = async (data: SettingsFormValues) => {
        try {
            setLoading(true)
            await fetchApi(`/admin/settings`, {
                method: "PUT",
                body: JSON.stringify({ settings: data.settings }),
            })
            router.refresh()
            toast.success("Settings updated.")
        } catch (error: any) {
            toast.error("Something went wrong.")
        } finally {
            setLoading(false)
        }
    }

    return (
        <>
            <div className="flex items-center justify-between">
                <Heading title="Settings" description="Manage site configurations" />
                <Button disabled={loading} onClick={form.handleSubmit(onSubmit)}>
                    {loading && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
                    <Save className="mr-2 h-4 w-4" />
                    Save Changes
                </Button>
            </div>
            <Separator />
            <Form {...form}>
                <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8 w-full">
                    {Object.entries(groupedSettings).map(([group, settings]) => (
                        <Card key={group}>
                            <CardHeader>
                                <CardTitle className="capitalize">{group}</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                {settings.map((setting) => {
                                    // Find the index in the original array
                                    const index = initialData.findIndex(s => s.key === setting.key)
                                    if (index === -1) return null

                                    return (
                                        <FormField
                                            key={setting.key}
                                            control={form.control}
                                            name={`settings.${index}.value`}
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel className="capitalize">{setting.key.replace(/_/g, ' ')}</FormLabel>
                                                    <FormControl>
                                                        {setting.type === 'textarea' || setting.value.length > 50 ? (
                                                            <Textarea disabled={loading} {...field} />
                                                        ) : (
                                                            <Input disabled={loading} {...field} />
                                                        )}
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />
                                    )
                                })}
                            </CardContent>
                        </Card>
                    ))}
                </form>
            </Form>
        </>
    )
}
