import Link from "next/link"
import { ArrowRight, Mail } from "lucide-react"

export function ContactCta() {
    return (
        <section className="py-24 px-4">
            <div className="container mx-auto max-w-4xl text-center">
                <div className="bg-gradient-to-br from-primary/10 via-primary/5 to-transparent rounded-2xl p-12 border border-primary/20">
                    <Mail className="h-10 w-10 text-primary mx-auto mb-4" />
                    <h2 className="text-3xl font-bold mb-4">Let&apos;s Work Together</h2>
                    <p className="text-muted-foreground max-w-lg mx-auto mb-8">
                        Have a project in mind or want to collaborate? I&apos;m always
                        open to discussing new opportunities and ideas.
                    </p>
                    <Link
                        href="/contact"
                        className="inline-flex items-center gap-2 bg-primary text-primary-foreground px-6 py-3 rounded-lg font-medium hover:bg-primary/90 transition"
                    >
                        Get In Touch <ArrowRight className="h-4 w-4" />
                    </Link>
                </div>
            </div>
        </section>
    )
}
