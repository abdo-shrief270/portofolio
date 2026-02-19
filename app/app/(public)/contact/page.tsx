import { ContactForm } from "@/components/public/contact-form"
import { Mail, MapPin, Phone } from "lucide-react"

export default function ContactPage() {
    return (
        <div className="container py-10 mx-auto px-4 md:px-6">
            <div className="mx-auto max-w-2xl text-center mb-16">
                <h1 className="text-3xl font-bold tracking-tight sm:text-4xl">Get in touch</h1>
                <p className="mt-2 text-lg text-muted-foreground">
                    Have a project in mind or just want to say hi? I'd love to hear from you.
                </p>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <div>
                    <div className="space-y-8">
                        <div className="flex items-start gap-4">
                            <div className="bg-primary/10 p-3 rounded-lg">
                                <Mail className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 className="font-semibold text-lg">Email</h3>
                                <p className="text-muted-foreground">hello@example.com</p>
                            </div>
                        </div>
                        <div className="flex items-start gap-4">
                            <div className="bg-primary/10 p-3 rounded-lg">
                                <Phone className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 className="font-semibold text-lg">Phone</h3>
                                <p className="text-muted-foreground">+1 (555) 000-0000</p>
                            </div>
                        </div>
                        <div className="flex items-start gap-4">
                            <div className="bg-primary/10 p-3 rounded-lg">
                                <MapPin className="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 className="font-semibold text-lg">Location</h3>
                                <p className="text-muted-foreground">San Francisco, CA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="bg-card p-6 rounded-lg border shadow-sm">
                    <ContactForm />
                </div>
            </div>
        </div>
    )
}
