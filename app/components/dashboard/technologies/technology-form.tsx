"use client"

import { useState } from "react"
import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import * as z from "zod"
import { ArrowLeft, Loader2, Trash } from "lucide-react"
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
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select"
import { Technology } from "@/types"
import { fetchApi } from "@/lib/api-service"

const formSchema = z.object({
    name: z.string().min(2, {
        message: "Name must be at least 2 characters.",
    }),
    slug: z.string().min(2, {
        message: "Slug must be at least 2 characters.",
    }),
    icon: z.string().min(1, {
        message: "Icon is required.",
    }),
    color: z.string().optional(),
    category: z.enum(["frontend", "backend", "database", "devops", "other"]),
    url: z.string().url().optional().or(z.literal("")),
})

type TechnologyFormValues = z.infer<typeof formSchema>

interface TechnologyFormProps {
    initialData: Technology | null
}

export const TechnologyForm: React.FC<TechnologyFormProps> = ({
    initialData
}) => {
    const router = useRouter()
    const [loading, setLoading] = useState(false)

    const title = initialData ? "Edit technology" : "Create technology"
    const description = initialData ? "Edit a technology." : "Add a new technology"
    const toastMessage = initialData ? "Technology updated." : "Technology created."
    const action = initialData ? "Save changes" : "Create"

    const defaultValues: TechnologyFormValues = initialData ? {
        name: initialData.name,
        slug: initialData.slug,
        icon: initialData.icon || "",
        color: initialData.color || "",
        category: initialData.category,
        url: initialData.url || "",
    } : {
        name: "",
        slug: "",
        icon: "",
        color: "",
        category: "frontend",
        url: "",
    }

    const form = useForm<TechnologyFormValues>({
        resolver: zodResolver(formSchema),
        defaultValues,
    })

    const onSubmit = async (data: TechnologyFormValues) => {
        try {
            setLoading(true)
            if (initialData) {
                await fetchApi(`/admin/technologies/${initialData.id}`, {
                    method: "PUT",
                    body: JSON.stringify(data),
                })
            } else {
                await fetchApi(`/admin/technologies`, {
                    method: "POST",
                    body: JSON.stringify(data),
                })
            }
            router.refresh()
            router.push(`/dashboard/technologies`)
            toast.success(toastMessage)
        } catch (error: any) {
            toast.error("Something went wrong.")
        } finally {
            setLoading(false)
        }
    }

    const onDelete = async () => {
        try {
            setLoading(true)
            await fetchApi(`/admin/technologies/${initialData?.id}`, {
                method: "DELETE",
            })
            router.refresh()
            router.push(`/dashboard/technologies`)
            toast.success("Technology deleted.")
        } catch (error: any) {
            toast.error("Make sure you removed all projects using this technology first.")
        } finally {
            setLoading(false)
        }
    }

    return (
        <>
            <div className="flex items-center justify-between">
                <div className="flex items-center gap-4">
                    <Button variant="ghost" size="icon" onClick={() => router.back()}>
                        <ArrowLeft className="h-4 w-4" />
                    </Button>
                    <Heading title={title} description={description} />
                </div>
                {initialData && (
                    <Button
                        disabled={loading}
                        variant="destructive"
                        size="sm"
                        onClick={onDelete}
                    >
                        <Trash className="h-4 w-4 mr-2" />
                        Delete
                    </Button>
                )}
            </div>
            <Separator />
            <Form {...form}>
                <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8 w-full">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <FormField
                            control={form.control}
                            name="name"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Name</FormLabel>
                                    <FormControl>
                                        <Input disabled={loading} placeholder="Technology name" {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="slug"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Slug</FormLabel>
                                    <FormControl>
                                        <Input disabled={loading} placeholder="technology-slug" {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="category"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Category</FormLabel>
                                    <Select
                                        disabled={loading}
                                        onValueChange={field.onChange}
                                        value={field.value}
                                        defaultValue={field.value}
                                    >
                                        <FormControl>
                                            <SelectTrigger>
                                                <SelectValue defaultValue={field.value} placeholder="Select a category" />
                                            </SelectTrigger>
                                        </FormControl>
                                        <SelectContent>
                                            <SelectItem value="frontend">Frontend</SelectItem>
                                            <SelectItem value="backend">Backend</SelectItem>
                                            <SelectItem value="database">Database</SelectItem>
                                            <SelectItem value="devops">DevOps</SelectItem>
                                            <SelectItem value="other">Other</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="icon"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Icon (Lucide Name)</FormLabel>
                                    <FormControl>
                                        <Input disabled={loading} placeholder="Layout, Code, etc." {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="color"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Color (Hex)</FormLabel>
                                    <FormControl>
                                        <div className="flex gap-2">
                                            <Input disabled={loading} placeholder="#000000" {...field} />
                                            <div
                                                className="h-10 w-10 rounded-md border"
                                                style={{ backgroundColor: field.value || 'transparent' }}
                                            />
                                        </div>
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <FormField
                            control={form.control}
                            name="url"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Docs URL</FormLabel>
                                    <FormControl>
                                        <Input disabled={loading} placeholder="https://..." {...field} />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                    </div>
                    <Button disabled={loading} className="ml-auto" type="submit">
                        {loading && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
                        {action}
                    </Button>
                </form>
            </Form>
        </>
    )
}
