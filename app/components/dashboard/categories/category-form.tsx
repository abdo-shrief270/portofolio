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
import { Textarea } from "@/components/ui/textarea"
import { Category } from "@/types"
import { fetchApi } from "@/lib/api-service"

const formSchema = z.object({
    name: z.string().min(2, {
        message: "Name must be at least 2 characters.",
    }),
    slug: z.string().min(2, {
        message: "Slug must be at least 2 characters.",
    }),
    description: z.string().optional(),
    icon: z.string().optional(),
    sort_order: z.number().default(0),
})

type CategoryFormValues = z.infer<typeof formSchema>

interface CategoryFormProps {
    initialData: Category | null
}

export const CategoryForm: React.FC<CategoryFormProps> = ({
    initialData
}) => {
    const router = useRouter()
    const [loading, setLoading] = useState(false)

    const title = initialData ? "Edit category" : "Create category"
    const description = initialData ? "Edit a category." : "Add a new category"
    const toastMessage = initialData ? "Category updated." : "Category created."
    const action = initialData ? "Save changes" : "Create"

    const defaultValues: CategoryFormValues = initialData ? {
        name: initialData.name,
        slug: initialData.slug,
        description: initialData.description || "",
        icon: initialData.icon || "",
        sort_order: initialData.sort_order || 0,
    } : {
        name: "",
        slug: "",
        description: "",
        icon: "",
        sort_order: 0,
    }

    const form = useForm<CategoryFormValues, any, CategoryFormValues>({
        resolver: zodResolver(formSchema) as any,
        defaultValues,
    })

    const onSubmit = async (data: CategoryFormValues) => {
        try {
            setLoading(true)
            if (initialData) {
                await fetchApi(`/admin/categories/${initialData.id}`, {
                    method: "PUT",
                    body: JSON.stringify(data),
                })
            } else {
                await fetchApi(`/admin/categories`, {
                    method: "POST",
                    body: JSON.stringify(data),
                })
            }
            router.refresh()
            router.push(`/dashboard/categories`)
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
            await fetchApi(`/admin/categories/${initialData?.id}`, {
                method: "DELETE",
            })
            router.refresh()
            router.push(`/dashboard/categories`)
            toast.success("Category deleted.")
        } catch (error: any) {
            toast.error("Make sure you removed all projects using this category first.")
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
                                        <Input disabled={loading} placeholder="Category name" {...field} />
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
                                        <Input disabled={loading} placeholder="category-slug" {...field} />
                                    </FormControl>
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
                            name="sort_order"
                            render={({ field }) => (
                                <FormItem>
                                    <FormLabel>Sort Order</FormLabel>
                                    <FormControl>
                                        <Input
                                            type="number"
                                            disabled={loading}
                                            placeholder="0"
                                            {...field}
                                            onChange={(e) => field.onChange(parseInt(e.target.value))}
                                        />
                                    </FormControl>
                                    <FormMessage />
                                </FormItem>
                            )}
                        />
                        <div className="col-span-1 md:col-span-2">
                            <FormField
                                control={form.control}
                                name="description"
                                render={({ field }) => (
                                    <FormItem>
                                        <FormLabel>Description</FormLabel>
                                        <FormControl>
                                            <Textarea disabled={loading} placeholder="Category description" {...field} />
                                        </FormControl>
                                        <FormMessage />
                                    </FormItem>
                                )}
                            />
                        </div>
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
