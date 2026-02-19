"use client"

import Link from "next/link"
import Image from "next/image"
import { Project } from "@/types"
import { Badge } from "@/components/ui/badge"
import { motion } from "framer-motion"
import { ArrowUpRight, Github, ExternalLink } from "lucide-react"

interface ProjectCardProps {
    project: Project
}

export const ProjectCard: React.FC<ProjectCardProps> = ({ project }) => {
    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            whileHover={{ y: -8 }}
            transition={{ duration: 0.5 }}
            className="flex flex-col overflow-hidden h-full glass-card group relative"
        >
            {/* Project Thumbnail with Overlay */}
            <div className="relative aspect-video overflow-hidden">
                {project.thumbnail ? (
                    <Image
                        src={project.thumbnail}
                        alt={project.title}
                        fill
                        className="object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                ) : (
                    <div className="flex h-full w-full items-center justify-center bg-zinc-900 text-muted-foreground italic">
                        No Preview Available
                    </div>
                )}
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-300" />

                {/* External Links Overlay (Visible on Hover) */}
                <div className="absolute top-4 right-4 flex gap-2 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                    {project.demo_url && (
                        <a href={project.demo_url} target="_blank" rel="noopener noreferrer" className="p-2 rounded-full glass hover:bg-primary transition-colors">
                            <ExternalLink className="h-4 w-4 text-white" />
                        </a>
                    )}
                    {project.github_url && (
                        <a href={project.github_url} target="_blank" rel="noopener noreferrer" className="p-2 rounded-full glass hover:bg-primary transition-colors">
                            <Github className="h-4 w-4 text-white" />
                        </a>
                    )}
                </div>
            </div>

            {/* Project Info */}
            <div className="p-6 flex-1 flex flex-col">
                <div className="mb-4">
                    <h3 className="font-outfit text-xl font-bold text-foreground group-hover:text-primary transition-colors line-clamp-1">
                        {project.title}
                    </h3>
                    {project.subtitle && (
                        <p className="text-xs text-primary font-medium mt-1 uppercase tracking-wider">{project.subtitle}</p>
                    )}
                </div>

                <p className="text-sm text-muted-foreground line-clamp-3 mb-6 leading-relaxed">
                    {project.short_description || project.description}
                </p>

                <div className="mt-auto flex flex-wrap gap-2">
                    {project.technologies?.slice(0, 3).map((tech) => (
                        <Badge key={tech.id} variant="secondary" className="bg-secondary/50 border-border text-muted-foreground text-[10px] hover:bg-primary/20 transition-colors px-2 py-0">
                            {tech.name}
                        </Badge>
                    ))}
                    {(project.technologies?.length || 0) > 3 && (
                        <span className="text-[10px] text-muted-foreground self-center">
                            +{(project.technologies?.length || 0) - 3} more
                        </span>
                    )}
                </div>
            </div>

            {/* View Details Button */}
            <div className="px-6 pb-6 pt-0">
                <Link href={`/projects/${project.slug}`}>
                    <div className="group/btn flex items-center justify-between w-full p-2 bg-secondary/30 hover:bg-primary/20 rounded-xl border border-border hover:border-primary/30 transition-all duration-300">
                        <span className="text-sm font-medium text-muted-foreground group-hover/btn:text-foreground px-2">View Case Study</span>
                        <div className="p-2 rounded-lg bg-muted group-hover/btn:bg-primary transition-colors">
                            <ArrowUpRight className="h-4 w-4 text-primary group-hover/btn:text-white" />
                        </div>
                    </div>
                </Link>
            </div>
        </motion.div>
    )
}
