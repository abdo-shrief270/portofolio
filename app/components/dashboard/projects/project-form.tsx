"use client"

import * as React from "react"
import { useForm, useFieldArray } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import * as z from "zod"
import { Trash } from "lucide-react"
import { useRouter } from "next/navigation"
import { toast } from "sonner"

import { Button } from "@/components/ui/button"
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import { Textarea } from "@/components/ui/textarea"
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select"
import { Separator } from "@/components/ui/separator"
import { Heading } from "@/components/ui/heading"
import { Project, Category, Technology } from "@/types"
import { fetchApi } from "@/lib/api-service"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Checkbox } from "@/components/ui/checkbox"
import { AlertModal } from "@/components/modals/alert-modal"

const projectSchema = z.object({
    title: z.string().min(2),
    slug: z.string().min(2),
    subtitle: z.string().nullable().optional(),
    description: z.string().min(10),
    short_description: z.string().min(10),
    category_id: z.string().min(1, "Category is required"),
    status: z.enum(["draft", "live", "in_progress", "completed", "archived"]),
    is_featured: z.boolean(),
    is_active: z.boolean(),
    demo_url: z.string().url().optional().or(z.literal("")).or(z.null()),
    github_url: z.string().url().optional().or(z.literal("")).or(z.null()),
    thumbnail: z.string().url().optional().or(z.literal("")).or(z.null()),
    technologies: z.array(z.string()).optional(),
    features: z.array(z.object({
        title: z.string().min(1, "Title is required"),
        description: z.string().optional(),
        icon: z.string().optional(),
    })).optional(),
})

type ProjectFormValues = z.infer<typeof projectSchema>

interface ProjectFormProps {
    initialData: Project | null
    categories: Category[]
    technologies: Technology[]
}

export const ProjectForm: React.FC<ProjectFormProps> = ({
    initialData,
    categories,
    technologies,
}) => {
    const router = useRouter()
    const [loading, setLoading] = React.useState(false)
    const [open, setOpen] = React.useState(false)

    const title = initialData ? "Edit project" : "Create project"
    const description = initialData ? "Edit a project." : "Add a new project"
    const toastMessage = initialData ? "Project updated." : "Project created."
    const action = initialData ? "Save changes" : "Create"

    const onDelete = async () => {
        try {
            setLoading(true)
            await fetchApi(`/admin/projects/${initialData?.id}`, {
                method: "DELETE",
            })
            router.refresh()
            router.push(`/dashboard/projects`)
            toast.success("Project deleted.")
        } catch (error: any) {
            toast.error(error.message || "Something went wrong.")
        } finally {
            setLoading(false)
            setOpen(false)
        }
    }

    const defaultValues: Partial<ProjectFormValues> = initialData ? {
        title: initialData.title,
        slug: initialData.slug,
        subtitle: initialData.subtitle || "",
        description: initialData.description,
        short_description: initialData.short_description,
        category_id: initialData.category?.id ? String(initialData.category.id) : "",
        status: initialData.status,
        is_featured: initialData.is_featured,
        is_active: initialData.is_active,
        demo_url: initialData.demo_url || "",
        github_url: initialData.github_url || "",
        thumbnail: initialData.thumbnail || "",
        technologies: initialData.technologies ? initialData.technologies.map(t => String(t.id)) : [],
        features: initialData.features ? initialData.features.map(f => ({
            title: f.title,
            description: f.description || "",
            icon: f.icon || "lucide-star",
        })) : [],
    } : {
        title: "",
        slug: "",
        subtitle: "",
        description: "",
        short_description: "",
        category_id: "",
        status: "in_progress",
        is_featured: false,
        is_active: true,
        demo_url: "",
        github_url: "",
        thumbnail: "",
        technologies: [],
        features: [],
    }

    const form = useForm<ProjectFormValues>({
        resolver: zodResolver(projectSchema),
        defaultValues,
    })

    // Dynamic Features List
    const { fields, append, remove } = useFieldArray({
        name: "features",
        control: form.control,
    })

    const onSubmit = async (data: ProjectFormValues) => {
        try {
            setLoading(true)

            // Transform features from object array to simple string array if API expects that
            // But validation above expects object. Let's align with API.
            // API validation says 'features' => 'nullable|array'. 
            // Assuming simple array of strings for API based on resource?
            // Project model casts to array.
            // Let's send basic array of strings.

            const { technologies, ...rest } = data
            const payload = {
                ...rest,
                technology_ids: technologies,
            }

            if (initialData) {
                await fetchApi(`/admin/projects/${initialData.id}`, {
                    method: "PUT",
                    body: JSON.stringify(payload),
                })
            } else {
                await fetchApi(`/admin/projects`, {
                    method: "POST",
                    body: JSON.stringify(payload),
                })
            }
            router.refresh()
            router.push(`/dashboard/projects`)
            toast.success(toastMessage)
        } catch (error: any) {
            toast.error(error.message || "Something went wrong.")
            console.error(error)
        } finally {
            setLoading(false)
        }
    }

    return (
        <>
            <AlertModal
                isOpen={open}
                onClose={() => setOpen(false)}
                onConfirm={onDelete}
                loading={loading}
            />
            <div className="flex items-center justify-between">
                <Heading title={title} description={description} />
                {initialData && (
                    <Button
                        disabled={loading}
                        variant="destructive"
                        size="sm"
                        onClick={() => setOpen(true)}
                    >
                        <Trash className="h-4 w-4" />
                    </Button>
                )}
            </div>
            <Separator />
            <Form {...form}>
                <form
                    onSubmit={form.handleSubmit(onSubmit, (errors) => {
                        console.error("Validation Errors:", errors)
                        toast.error("Please check the form for errors.")
                    })}
                    className="space-y-8 w-full"
                >
                    <div className="grid grid-cols-3 gap-8">
                        <div className="col-span-2 space-y-8">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Basic Details</CardTitle>
                                </CardHeader>
                                <CardContent className="grid gap-4">
                                    <FormField
                                        control={form.control}
                                        name="title"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Title</FormLabel>
                                                <FormControl>
                                                    <Input disabled={loading} placeholder="Project title" {...field} />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                    <div className="grid grid-cols-2 gap-4">
                                        <FormField
                                            control={form.control}
                                            name="slug"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>Slug</FormLabel>
                                                    <FormControl>
                                                        <Input disabled={loading} placeholder="project-slug" {...field} />
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />
                                        <FormField
                                            control={form.control}
                                            name="subtitle"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>Subtitle</FormLabel>
                                                    <FormControl>
                                                        <Input disabled={loading} placeholder="Short tagline" {...field} value={field.value || ""} />
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />
                                    </div>
                                    <FormField
                                        control={form.control}
                                        name="short_description"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Short Description</FormLabel>
                                                <FormControl>
                                                    <Textarea disabled={loading} placeholder="Summary for cards" {...field} />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                    <FormField
                                        control={form.control}
                                        name="description"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Full Description</FormLabel>
                                                <FormControl>
                                                    <Textarea className="min-h-[150px]" disabled={loading} placeholder="Detailed content" {...field} />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>Media & Links</CardTitle>
                                </CardHeader>
                                <CardContent className="grid gap-4">
                                    <FormField
                                        control={form.control}
                                        name="thumbnail"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Thumbnail URL</FormLabel>
                                                <FormControl>
                                                    <Input disabled={loading} placeholder="https://..." {...field} value={field.value || ""} />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                    <div className="grid grid-cols-2 gap-4">
                                        <FormField
                                            control={form.control}
                                            name="github_url"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>GitHub URL</FormLabel>
                                                    <FormControl>
                                                        <Input disabled={loading} placeholder="https://github.com/..." {...field} value={field.value || ""} />
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />
                                        <FormField
                                            control={form.control}
                                            name="demo_url"
                                            render={({ field }) => (
                                                <FormItem>
                                                    <FormLabel>Demo URL</FormLabel>
                                                    <FormControl>
                                                        <Input disabled={loading} placeholder="https://demo..." {...field} value={field.value || ""} />
                                                    </FormControl>
                                                    <FormMessage />
                                                </FormItem>
                                            )}
                                        />
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        <div className="space-y-8">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Settings</CardTitle>
                                </CardHeader>
                                <CardContent className="grid gap-4">
                                    <FormField
                                        control={form.control}
                                        name="status"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Status</FormLabel>
                                                <Select disabled={loading} onValueChange={field.onChange} value={field.value} defaultValue={field.value}>
                                                    <FormControl>
                                                        <SelectTrigger>
                                                            <SelectValue defaultValue={field.value} placeholder="Select status" />
                                                        </SelectTrigger>
                                                    </FormControl>
                                                    <SelectContent>
                                                        <SelectItem value="draft">Draft</SelectItem>
                                                        <SelectItem value="in_progress">In Progress</SelectItem>
                                                        <SelectItem value="live">Live</SelectItem>
                                                        <SelectItem value="completed">Completed</SelectItem>
                                                        <SelectItem value="archived">Archived</SelectItem>
                                                    </SelectContent>
                                                </Select>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />
                                    <FormField
                                        control={form.control}
                                        name="category_id"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Category</FormLabel>
                                                <Select disabled={loading} onValueChange={field.onChange} value={field.value ? String(field.value) : undefined} defaultValue={field.value ? String(field.value) : undefined}>
                                                    <FormControl>
                                                        <SelectTrigger>
                                                            <SelectValue defaultValue={field.value} placeholder="Select category" />
                                                        </SelectTrigger>
                                                    </FormControl>
                                                    <SelectContent>
                                                        {categories.map((category) => (
                                                            <SelectItem key={category.id} value={String(category.id)}>
                                                                {category.name}
                                                            </SelectItem>
                                                        ))}
                                                    </SelectContent>
                                                </Select>
                                                <FormMessage />
                                            </FormItem>
                                        )}
                                    />

                                    <div className="flex flex-col gap-4 pt-4 border-t">
                                        <FormField
                                            control={form.control}
                                            name="is_featured"
                                            render={({ field }) => (
                                                <FormItem className="flex flex-row items-start space-x-3 space-y-0 rounded-md border p-4">
                                                    <FormControl>
                                                        <Checkbox
                                                            checked={field.value}
                                                            onCheckedChange={field.onChange}
                                                        />
                                                    </FormControl>
                                                    <div className="space-y-1 leading-none">
                                                        <FormLabel>
                                                            Featured
                                                        </FormLabel>
                                                        <FormDescription>
                                                            This project will appear on the home page
                                                        </FormDescription>
                                                    </div>
                                                </FormItem>
                                            )}
                                        />
                                        <FormField
                                            control={form.control}
                                            name="is_active"
                                            render={({ field }) => (
                                                <FormItem className="flex flex-row items-start space-x-3 space-y-0 rounded-md border p-4">
                                                    <FormControl>
                                                        <Checkbox
                                                            checked={field.value}
                                                            onCheckedChange={field.onChange}
                                                        />
                                                    </FormControl>
                                                    <div className="space-y-1 leading-none">
                                                        <FormLabel>
                                                            Active
                                                        </FormLabel>
                                                        <FormDescription>
                                                            Project is visible to public
                                                        </FormDescription>
                                                    </div>
                                                </FormItem>
                                            )}
                                        />
                                    </div>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader>
                                    <CardTitle>Technologies</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="grid grid-cols-2 gap-2">
                                        {/* Simplified Multi-select - Just Checkboxes for now */}
                                        {technologies.map((tech) => (
                                            <FormField
                                                key={tech.id}
                                                control={form.control}
                                                name="technologies"
                                                render={({ field }) => {
                                                    return (
                                                        <FormItem
                                                            key={tech.id}
                                                            className="flex flex-row items-start space-x-3 space-y-0"
                                                        >
                                                            <FormControl>
                                                                <Checkbox
                                                                    checked={field.value?.includes(String(tech.id))}
                                                                    onCheckedChange={(checked) => {
                                                                        return checked
                                                                            ? field.onChange([...(field.value || []), String(tech.id)])
                                                                            : field.onChange(
                                                                                field.value?.filter(
                                                                                    (value) => value !== String(tech.id)
                                                                                )
                                                                            )
                                                                    }}
                                                                />
                                                            </FormControl>
                                                            <FormLabel className="text-sm font-normal">
                                                                {tech.name}
                                                            </FormLabel>
                                                        </FormItem>
                                                    )
                                                }}
                                            />
                                        ))}
                                    </div>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between space-y-0">
                                    <CardTitle>Features</CardTitle>
                                    <Button
                                        type="button"
                                        variant="outline"
                                        size="sm"
                                        onClick={() => append({ title: "", description: "", icon: "lucide-star" })}
                                    >
                                        Add Feature
                                    </Button>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    {fields.map((field, index) => (
                                        <div key={field.id} className="space-y-4 p-4 border rounded-lg relative">
                                            <Button
                                                type="button"
                                                variant="ghost"
                                                size="sm"
                                                className="absolute right-2 top-2 text-destructive hover:text-destructive hover:bg-destructive/10"
                                                onClick={() => remove(index)}
                                            >
                                                <Trash className="h-4 w-4" />
                                            </Button>
                                            <div className="grid grid-cols-2 gap-4">
                                                <FormField
                                                    control={form.control}
                                                    name={`features.${index}.title`}
                                                    render={({ field }) => (
                                                        <FormItem>
                                                            <FormLabel>Title</FormLabel>
                                                            <FormControl>
                                                                <Input {...field} placeholder="Fast Loading" />
                                                            </FormControl>
                                                            <FormMessage />
                                                        </FormItem>
                                                    )}
                                                />
                                                <FormField
                                                    control={form.control}
                                                    name={`features.${index}.icon`}
                                                    render={({ field }) => (
                                                        <FormItem>
                                                            <FormLabel>Icon</FormLabel>
                                                            <FormControl>
                                                                <Input {...field} placeholder="lucide-zap" />
                                                            </FormControl>
                                                            <FormMessage />
                                                        </FormItem>
                                                    )}
                                                />
                                            </div>
                                            <FormField
                                                control={form.control}
                                                name={`features.${index}.description`}
                                                render={({ field }) => (
                                                    <FormItem>
                                                        <FormLabel>Description</FormLabel>
                                                        <FormControl>
                                                            <Textarea {...field} placeholder="Brief detail about this feature" />
                                                        </FormControl>
                                                        <FormMessage />
                                                    </FormItem>
                                                )}
                                            />
                                        </div>
                                    ))}
                                    {fields.length === 0 && (
                                        <p className="text-sm text-muted-foreground text-center py-4">
                                            No features added yet.
                                        </p>
                                    )}
                                </CardContent>
                            </Card>
                        </div>
                    </div>

                    <Button disabled={loading} className="ml-auto" type="submit">
                        {action}
                    </Button>
                </form>
            </Form>
        </>
    )
}
