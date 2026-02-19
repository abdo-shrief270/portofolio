import { fetchApi } from "@/lib/api-service"
import { Experience, Education, Course, Technology } from "@/types"
import { Briefcase, GraduationCap, BookOpen, Code2, MapPin, Calendar } from "lucide-react"
import { Metadata } from "next"

export const metadata: Metadata = {
    title: "About | Portfolio",
    description: "Learn about my background, experience, education, and skills.",
}

async function getData() {
    try {
        const [experiences, educations, courses, technologies] = await Promise.all([
            fetchApi<{ data: Experience[] }>("/experiences").then((r) => r.data).catch(() => []),
            fetchApi<{ data: Education[] }>("/educations").then((r) => r.data).catch(() => []),
            fetchApi<{ data: Course[] }>("/courses").then((r) => r.data).catch(() => []),
            fetchApi<{ data: Technology[] }>("/technologies").then((r) => r.data).catch(() => []),
        ])
        return { experiences, educations, courses, technologies }
    } catch {
        return { experiences: [], educations: [], courses: [], technologies: [] }
    }
}

export default async function AboutPage() {
    const { experiences, educations, courses, technologies } = await getData()

    return (
        <div className="min-h-screen">
            {/* Hero Section */}
            <section className="py-20 px-4">
                <div className="container mx-auto max-w-4xl text-center">
                    <h1 className="text-4xl md:text-5xl font-bold mb-6">About Me</h1>
                    <p className="text-lg text-muted-foreground max-w-2xl mx-auto">
                        A passionate full-stack developer with a love for building modern,
                        scalable web applications. Here&apos;s my journey so far.
                    </p>
                </div>
            </section>

            {/* Experience */}
            <section className="py-16 px-4 bg-muted/30">
                <div className="container mx-auto max-w-4xl">
                    <div className="flex items-center gap-3 mb-8">
                        <Briefcase className="h-6 w-6 text-primary" />
                        <h2 className="text-2xl font-bold">Work Experience</h2>
                    </div>
                    {experiences.length === 0 ? (
                        <p className="text-muted-foreground">Experience data coming soon.</p>
                    ) : (
                        <div className="space-y-8">
                            {experiences.map((exp) => (
                                <div key={exp.id} className="relative pl-8 border-l-2 border-primary/20">
                                    <div className="absolute left-[-9px] top-0 w-4 h-4 rounded-full bg-primary" />
                                    <div className="bg-card rounded-lg p-6 shadow-sm border">
                                        <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                                            <h3 className="text-lg font-semibold">{exp.position}</h3>
                                            <span className="text-sm text-muted-foreground flex items-center gap-1">
                                                <Calendar className="h-3 w-3" />
                                                {exp.start_date} — {exp.is_current ? "Present" : exp.end_date}
                                            </span>
                                        </div>
                                        <div className="flex items-center gap-2 text-sm text-muted-foreground mb-3">
                                            <span className="font-medium text-foreground">{exp.company}</span>
                                            {exp.location && (
                                                <>
                                                    <span>•</span>
                                                    <MapPin className="h-3 w-3" />
                                                    <span>{exp.location}</span>
                                                </>
                                            )}
                                        </div>
                                        {exp.description && <p className="text-sm text-muted-foreground mb-3">{exp.description}</p>}
                                        {exp.technologies_used && exp.technologies_used.length > 0 && (
                                            <div className="flex flex-wrap gap-2">
                                                {exp.technologies_used.map((t) => (
                                                    <span key={t} className="px-2 py-1 text-xs bg-primary/10 text-primary rounded-full">{t}</span>
                                                ))}
                                            </div>
                                        )}
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </section>

            {/* Education */}
            <section className="py-16 px-4">
                <div className="container mx-auto max-w-4xl">
                    <div className="flex items-center gap-3 mb-8">
                        <GraduationCap className="h-6 w-6 text-primary" />
                        <h2 className="text-2xl font-bold">Education</h2>
                    </div>
                    {educations.length === 0 ? (
                        <p className="text-muted-foreground">Education data coming soon.</p>
                    ) : (
                        <div className="space-y-6">
                            {educations.map((edu) => (
                                <div key={edu.id} className="bg-card rounded-lg p-6 shadow-sm border">
                                    <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                                        <h3 className="text-lg font-semibold">{edu.degree}</h3>
                                        <span className="text-sm text-muted-foreground">
                                            {edu.start_date} — {edu.is_current ? "Present" : edu.end_date}
                                        </span>
                                    </div>
                                    <p className="text-sm font-medium">{edu.institution}</p>
                                    {edu.field_of_study && <p className="text-sm text-muted-foreground mt-1">{edu.field_of_study}</p>}
                                    {edu.grade && <p className="text-sm text-muted-foreground mt-1">Grade: {edu.grade}</p>}
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </section>

            {/* Courses */}
            <section className="py-16 px-4 bg-muted/30">
                <div className="container mx-auto max-w-4xl">
                    <div className="flex items-center gap-3 mb-8">
                        <BookOpen className="h-6 w-6 text-primary" />
                        <h2 className="text-2xl font-bold">Courses & Certifications</h2>
                    </div>
                    {courses.length === 0 ? (
                        <p className="text-muted-foreground">Course data coming soon.</p>
                    ) : (
                        <div className="grid gap-4 md:grid-cols-2">
                            {courses.map((c) => (
                                <div key={c.id} className="bg-card rounded-lg p-6 shadow-sm border">
                                    <h3 className="font-semibold mb-1">{c.title}</h3>
                                    <p className="text-sm text-muted-foreground">{c.provider}{c.instructor ? ` • ${c.instructor}` : ""}</p>
                                    {c.duration_hours && (
                                        <p className="text-xs text-muted-foreground mt-2">{c.duration_hours} hours</p>
                                    )}
                                    {c.skills_learned && c.skills_learned.length > 0 && (
                                        <div className="flex flex-wrap gap-1.5 mt-3">
                                            {c.skills_learned.map((s) => (
                                                <span key={s} className="px-2 py-0.5 text-xs bg-primary/10 text-primary rounded-full">{s}</span>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </section>

            {/* Tech Stack */}
            <section className="py-16 px-4">
                <div className="container mx-auto max-w-4xl">
                    <div className="flex items-center gap-3 mb-8">
                        <Code2 className="h-6 w-6 text-primary" />
                        <h2 className="text-2xl font-bold">Tech Stack</h2>
                    </div>
                    {technologies.length === 0 ? (
                        <p className="text-muted-foreground">Tech stack data coming soon.</p>
                    ) : (
                        <div className="flex flex-wrap gap-3">
                            {technologies.map((t) => (
                                <span key={t.id} className="px-4 py-2 bg-card border rounded-lg text-sm font-medium shadow-sm hover:border-primary/50 transition">
                                    {t.icon && <span className="mr-2">{t.icon}</span>}
                                    {t.name}
                                </span>
                            ))}
                        </div>
                    )}
                </div>
            </section>
        </div>
    )
}
