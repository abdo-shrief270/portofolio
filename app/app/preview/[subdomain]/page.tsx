import { fetchApi } from "@/lib/api-service"
import { Project } from "@/types"
import { notFound } from "next/navigation"
import { Button } from "@/components/ui/button"
import Link from "next/link"
import { ArrowLeft, ExternalLink } from "lucide-react"

interface PreviewPageProps {
    params: {
        subdomain: string
    }
}

// In a real scenario, you'd fetch by subdomain directly. 
// For now, we'll assume the subdomain maps to a project slug for simplicity, 
// or fetch the project that has this subdomain configured.

async function getProjectBySubdomain(subdomain: string) {
    try {
        // We'll search for the project where slug matches subdomain 
        // OR implement a specific endpoint /projects/by-subdomain/{subdomain}
        // Utilizing the existing slug endpoint for now as a fallback
        const res = await fetchApi<{ data: Project }>(`/projects/${subdomain}`)
        return res.data
    } catch (e) {
        // If exact slug match fails, we might want to search or return null
        console.error(`Failed to fetch project for subdomain ${subdomain}:`, e)
        return null
    }
}

export default async function PreviewPage({ params }: PreviewPageProps) {
    const project = await getProjectBySubdomain(params.subdomain)

    if (!project) {
        return (
            <div className="flex h-screen flex-col items-center justify-center gap-4">
                <h1 className="text-4xl font-bold">404</h1>
                <p className="text-muted-foreground">Project not found for subdomain: {params.subdomain}</p>
                <Link href="/">
                    <Button variant="outline">
                        <ArrowLeft className="mr-2 h-4 w-4" />
                        Go Home
                    </Button>
                </Link>
            </div>
        )
    }

    return (
        <div className="flex h-screen flex-col">
            {/* Preview Banner */}
            <div className="bg-primary text-primary-foreground px-4 py-2 flex items-center justify-between text-sm">
                <div className="flex items-center gap-2">
                    <span className="font-semibold">Project Preview:</span>
                    {project.title}
                </div>
                <div className="flex items-center gap-4">
                    <Link href={`/projects/${project.slug}`} className="hover:underline">
                        View Details
                    </Link>
                    <Link href="/" className="hover:underline">
                        Return to Portfolio
                    </Link>
                </div>
            </div>

            {/* Preview Content (Iframe or Placeholder) */}
            <div className="flex-1 bg-muted/20 flex flex-col items-center justify-center p-8 text-center space-y-6">
                <div className="max-w-2xl space-y-4">
                    <h1 className="text-3xl font-bold">This is a preview deployment</h1>
                    <p className="text-muted-foreground">
                        The project <strong>{project.title}</strong> is hosted on this subdomain.
                    </p>
                    {project.demo_url ? (
                        <div className="p-6 border rounded-lg bg-background shadow-sm">
                            <p className="mb-4">
                                This project is actually deployed at:
                            </p>
                            <a href={project.demo_url} target="_blank" rel="noopener noreferrer" className="text-primary hover:underline flex items-center justify-center gap-2 text-lg font-medium">
                                {project.demo_url}
                                <ExternalLink className="h-5 w-5" />
                            </a>
                        </div>
                    ) : (
                        <div className="p-6 border rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-200">
                            This project does not have a live demo URL configured yet.
                        </div>
                    )}
                </div>
            </div>
        </div>
    )
}
