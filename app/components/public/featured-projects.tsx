"use client"

import { Project } from "@/types"
import { ProjectCard } from "./project-card"
import { Button } from "@/components/ui/button"
import Link from "next/link"
import { ArrowRight } from "lucide-react"

interface FeaturedProjectsProps {
    projects: Project[]
}

export const FeaturedProjects: React.FC<FeaturedProjectsProps> = ({ projects }) => {
    if (!projects || projects.length === 0) {
        return null
    }

    return (
        <section className="py-24 sm:py-32">
            <div className="mx-auto max-w-7xl px-6 lg:px-8">
                <div className="mx-auto max-w-2xl text-center">
                    <h2 className="text-3xl font-bold tracking-tight sm:text-4xl">Featured Projects</h2>
                    <p className="mt-2 text-lg leading-8 text-muted-foreground">
                        A selection of my recent work and open source contributions.
                    </p>
                </div>
                <div className="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    {projects.map((project) => (
                        <ProjectCard key={project.id} project={project} />
                    ))}
                </div>
                <div className="mt-10 flex justify-center">
                    <Link href="/projects">
                        <Button variant="ghost" className="gap-2">
                            View all projects <ArrowRight className="h-4 w-4" />
                        </Button>
                    </Link>
                </div>
            </div>
        </section>
    )
}
