"use client"

import { useState, useMemo } from "react"
import { Project, Category, Technology } from "@/types"
import { ProjectCard } from "@/components/public/project-card"
import { Input } from "@/components/ui/input"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import { Search, X } from "lucide-react"

interface ProjectsClientProps {
    initialProjects: Project[]
    categories: Category[]
    technologies: Technology[]
}

export const ProjectsClient: React.FC<ProjectsClientProps> = ({
    initialProjects,
    categories,
    technologies,
}) => {
    const [searchQuery, setSearchQuery] = useState("")
    const [selectedCategory, setSelectedCategory] = useState<string | null>(null)
    const [selectedTech, setSelectedTech] = useState<string | null>(null)

    const filteredProjects = useMemo(() => {
        return initialProjects.filter((project) => {
            // Search filter
            const matchesSearch =
                project.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
                project.description?.toLowerCase().includes(searchQuery.toLowerCase()) ||
                project.technologies?.some((t) => t.name.toLowerCase().includes(searchQuery.toLowerCase()))

            // Category filter
            const matchesCategory = selectedCategory
                ? project.category?.id === selectedCategory
                : true

            // Tech filter
            const matchesTech = selectedTech
                ? project.technologies?.some((t) => t.id === selectedTech)
                : true

            return matchesSearch && matchesCategory && matchesTech
        })
    }, [initialProjects, searchQuery, selectedCategory, selectedTech])

    const clearFilters = () => {
        setSearchQuery("")
        setSelectedCategory(null)
        setSelectedTech(null)
    }

    return (
        <div>
            {/* Filters Section */}
            <div className="mb-8 space-y-4">
                <div className="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div className="relative w-full md:w-96">
                        <Search className="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
                        <Input
                            placeholder="Search projects..."
                            className="pl-9"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                        />
                    </div>
                    {(selectedCategory || selectedTech || searchQuery) && (
                        <Button variant="ghost" onClick={clearFilters} className="h-8 px-2 lg:px-3">
                            Reset Filters
                            <X className="ml-2 h-4 w-4" />
                        </Button>
                    )}
                </div>

                <div className="space-y-4">
                    <div className="flex flex-wrap gap-2">
                        <span className="text-sm font-medium self-center mr-2">Categories:</span>
                        {categories.map((category) => (
                            <Badge
                                key={category.id}
                                variant={selectedCategory === category.id ? "default" : "outline"}
                                className="cursor-pointer hover:bg-primary/90 hover:text-primary-foreground"
                                onClick={() => setSelectedCategory(selectedCategory === category.id ? null : category.id)}
                            >
                                {category.name}
                            </Badge>
                        ))}
                    </div>
                </div>
            </div>

            {/* Results Section */}
            {filteredProjects.length > 0 ? (
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {filteredProjects.map((project) => (
                        <ProjectCard key={project.id} project={project} />
                    ))}
                </div>
            ) : (
                <div className="text-center py-24 text-muted-foreground">
                    <p className="text-lg">No projects found matching your criteria.</p>
                    <Button variant="link" onClick={clearFilters} className="mt-2">
                        Clear all filters
                    </Button>
                </div>
            )}
        </div>
    )
}
