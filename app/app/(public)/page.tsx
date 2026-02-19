import { Hero } from "@/components/public/hero"
import { FeaturedProjects } from "@/components/public/featured-projects"
import { SkillsMarquee } from "@/components/public/skills-marquee"
import { TestimonialsSection } from "@/components/public/testimonials-section"
import { ContactCta } from "@/components/public/contact-cta"
import { fetchApi } from "@/lib/api-service"
import { Project, Technology, Testimonial } from "@/types"
import { Metadata } from "next"

export const metadata: Metadata = {
    title: "Portfolio | Full-Stack Developer",
    description: "Explore my projects, skills, and experience as a full-stack developer specializing in Laravel, React, and modern web technologies.",
    openGraph: {
        title: "Portfolio | Full-Stack Developer",
        description: "Explore my projects, skills, and experience.",
        type: "website",
    },
}

async function getFeaturedProjects() {
    try {
        const res = await fetchApi<{ data: Project[] }>("/projects/featured")
        return res.data
    } catch (e) {
        console.error("Failed to fetch featured projects:", e)
        return []
    }
}

async function getSkills() {
    try {
        const res = await fetchApi<{ data: Technology[] }>("/technologies")
        return res.data
    } catch (e) {
        console.error("Failed to fetch skills:", e)
        return []
    }
}

async function getTestimonials() {
    try {
        const res = await fetchApi<{ data: Testimonial[] }>("/testimonials")
        return res.data
    } catch (e) {
        console.error("Failed to fetch testimonials:", e)
        return []
    }
}

export default async function LandingPage() {
    const [projects, skills, testimonials] = await Promise.all([
        getFeaturedProjects(),
        getSkills(),
        getTestimonials(),
    ])

    return (
        <>
            <Hero />
            <SkillsMarquee skills={skills} />
            <FeaturedProjects projects={projects} />
            <TestimonialsSection testimonials={testimonials} />
            <ContactCta />
        </>
    )
}
