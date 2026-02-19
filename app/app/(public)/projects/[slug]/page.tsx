import { fetchApi } from "@/lib/api-service"
import { Project } from "@/types"
import { notFound } from "next/navigation"
import Image from "next/image"
import Link from "next/link"
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import { ArrowLeft, ArrowUpRight, Github, Calendar } from "lucide-react"

interface ProjectDetailsPageProps {
    params: Promise<{
        slug: string
    }>
}

async function getProject(slug: string) {
    try {
        const res = await fetchApi<{ data: Project }>(`/projects/${slug}`)
        return res.data
    } catch (e) {
        console.error(`Failed to fetch project ${slug}:`, e)
        return null
    }
}

export default async function ProjectDetailsPage({ params }: ProjectDetailsPageProps) {
    const { slug } = await params
    const project = await getProject(slug)

    if (!project) {
        notFound()
    }

    return (
        <div className="min-h-screen pb-20">
            {/* Hero Section */}
            <div className="relative h-[40vh] md:h-[60vh] w-full bg-muted">
                {project.thumbnail ? (
                    <Image
                        src={project.thumbnail}
                        alt={project.title}
                        fill
                        className="object-cover brightness-50"
                        priority
                    />
                ) : (
                    <div className="absolute inset-0 bg-gradient-to-br from-primary/20 to-secondary/20" />
                )}
                <div className="absolute inset-0 flex flex-col justify-end p-6 md:p-12 lg:p-20">
                    <div className="container mx-auto">
                        <Link href="/projects" className="inline-flex items-center text-white/80 hover:text-white mb-6 transition-colors">
                            <ArrowLeft className="mr-2 h-4 w-4" />
                            Back to Projects
                        </Link>
                        <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                            {project.title}
                        </h1>
                        {project.subtitle && (
                            <p className="text-xl md:text-2xl text-white/90 max-w-2xl">
                                {project.subtitle}
                            </p>
                        )}
                        <div className="flex flex-wrap gap-4 mt-8">
                            {project.demo_url && (
                                <a href={project.demo_url} target="_blank" rel="noopener noreferrer">
                                    <Button size="lg" className="gap-2">
                                        View Live Demo
                                        <ArrowUpRight className="h-4 w-4" />
                                    </Button>
                                </a>
                            )}
                            {project.github_url && (
                                <a href={project.github_url} target="_blank" rel="noopener noreferrer">
                                    <Button size="lg" variant="secondary" className="gap-2">
                                        Source Code
                                        <Github className="h-4 w-4" />
                                    </Button>
                                </a>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            <div className="container mx-auto px-4 md:px-6 py-12 lg:py-16">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {/* Main Content */}
                    <div className="lg:col-span-2 space-y-12">
                        {/* Description */}
                        <section>
                            <h2 className="text-2xl font-bold mb-4">Overview</h2>
                            <div className="prose dark:prose-invert max-w-none">
                                <p className="text-lg leading-relaxed text-muted-foreground whitespace-pre-wrap">
                                    {project.description}
                                </p>
                            </div>
                        </section>

                        {/* Gallery */}
                        {project.gallery && project.gallery.length > 0 && (
                            <section>
                                <h2 className="text-2xl font-bold mb-6">Gallery</h2>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {project.gallery.map((image, index) => (
                                        <div key={index} className="relative aspect-video rounded-lg overflow-hidden border bg-muted">
                                            <Image
                                                src={image}
                                                alt={`${project.title} screenshot ${index + 1}`}
                                                fill
                                                className="object-cover transition-transform hover:scale-105 duration-300"
                                            />
                                        </div>
                                    ))}
                                </div>
                            </section>
                        )}

                        {/* Features (if any) - Assuming description covers it or we add a features array later */}
                    </div>

                    {/* Sidebar */}
                    <div className="space-y-8">
                        {/* Project Info */}
                        <div className="rounded-lg border bg-card text-card-foreground shadow-sm p-6 space-y-6">
                            <h3 className="font-semibold text-lg">Project Info</h3>

                            {project.category && (
                                <div>
                                    <p className="text-sm font-medium text-muted-foreground mb-1">Category</p>
                                    <div className="flex items-center gap-2">
                                        <span className="font-medium">{project.category.name}</span>
                                    </div>
                                </div>
                            )}

                            {project.published_at && (
                                <div>
                                    <p className="text-sm font-medium text-muted-foreground mb-1">Published Date</p>
                                    <div className="flex items-center gap-2">
                                        <Calendar className="h-4 w-4 text-muted-foreground" />
                                        <span className="font-medium">
                                            {new Date(project.published_at).toLocaleDateString(undefined, {
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            })}
                                        </span>
                                    </div>
                                </div>
                            )}

                            {project.status && (
                                <div>
                                    <p className="text-sm font-medium text-muted-foreground mb-1">Status</p>
                                    <Badge variant="outline" className="capitalize">
                                        {project.status.replace('_', ' ')}
                                    </Badge>
                                </div>
                            )}
                        </div>

                        {/* Tech Stack */}
                        <div className="rounded-lg border bg-card text-card-foreground shadow-sm p-6 space-y-4">
                            <h3 className="font-semibold text-lg">Technologies</h3>
                            <div className="flex flex-wrap gap-2">
                                {project.technologies?.map((tech) => (
                                    <Badge key={tech.id} variant="secondary">
                                        {tech.name}
                                    </Badge>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
