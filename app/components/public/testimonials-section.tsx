"use client"

import { Testimonial } from "@/types"
import { Star, Quote } from "lucide-react"
import { useEffect, useRef, useState } from "react"
import { motion } from "framer-motion"

interface Props {
    testimonials: Testimonial[]
}

export function TestimonialsSection({ testimonials }: Props) {
    const scrollRef = useRef<HTMLDivElement>(null)
    const [isPaused, setIsPaused] = useState(false)

    useEffect(() => {
        const el = scrollRef.current
        if (!el || testimonials.length < 2) return

        const scroll = () => {
            if (isPaused) return
            el.scrollLeft += 0.5 // Slower, smoother scroll
            if (el.scrollLeft >= el.scrollWidth / 2) {
                el.scrollLeft = 0
            }
        }

        const interval = setInterval(scroll, 20)
        return () => clearInterval(interval)
    }, [isPaused, testimonials.length])

    if (testimonials.length === 0) return null

    return (
        <section className="py-32 relative overflow-hidden">
            <div className="container mx-auto px-4 relative">
                <div className="text-center mb-20">
                    <h2 className="text-4xl font-bold font-outfit text-gradient mb-4">Industrial Praise</h2>
                    <p className="text-muted-foreground max-w-2xl mx-auto">
                        Trusted by innovators and industry leaders.
                    </p>
                </div>

                <div
                    ref={scrollRef}
                    className="flex gap-8 overflow-x-hidden pb-12 cursor-grab active:cursor-grabbing"
                    onMouseEnter={() => setIsPaused(true)}
                    onMouseLeave={() => setIsPaused(false)}
                >
                    {[...testimonials, ...testimonials, ...testimonials].map((t, i) => (
                        <div
                            key={`${t.id}-${i}`}
                            className="flex-shrink-0 w-[400px] glass-card rounded-3xl p-8 group hover:border-primary/40 transition-all duration-500"
                        >
                            <div className="flex items-center gap-1 mb-6">
                                {Array.from({ length: 5 }).map((_, j) => (
                                    <Star
                                        key={j}
                                        className={`h-4 w-4 ${j < t.rating ? "fill-primary text-primary" : "text-muted-foreground/20"}`}
                                    />
                                ))}
                            </div>

                            <Quote className="h-10 w-10 text-primary/10 mb-6 group-hover:text-primary/20 transition-colors" />

                            <p className="text-muted-foreground leading-relaxed mb-8 italic font-outfit text-lg">
                                "{t.content}"
                            </p>

                            <div className="flex items-center gap-4 mt-auto border-t border-border pt-6">
                                <div className="h-12 w-12 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xl uppercase">
                                    {(t.name || "?").charAt(0)}
                                </div>
                                <div>
                                    <p className="font-bold text-foreground font-outfit">{t.name || "Anonymous"}</p>
                                    <p className="text-sm text-primary/60">
                                        {[t.position, t.company].filter(Boolean).join(" @ ")}
                                    </p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    )
}
