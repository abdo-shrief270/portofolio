"use client"

import { Technology } from "@/types"
import { motion } from "framer-motion"

interface SkillsMarqueeProps {
    skills: Technology[]
}

export const SkillsMarquee: React.FC<SkillsMarqueeProps> = ({ skills }) => {
    if (!skills || skills.length === 0) return null

    return (
        <section className="py-24 relative overflow-hidden">
            <div className="absolute inset-0 bg-primary/5 -skew-y-3 transform origin-right" />

            <div className="mx-auto max-w-7xl px-6 lg:px-8 relative">
                <div className="mx-auto max-w-2xl text-center mb-16">
                    <h2 className="text-3xl font-bold tracking-tight sm:text-4xl font-outfit text-gradient">Expertise & Tech Stack</h2>
                    <p className="mt-4 text-muted-foreground italic">Tools I use to bring ideas to life</p>
                </div>

                <div className="flex flex-wrap justify-center gap-6 max-w-5xl mx-auto">
                    {skills.map((skill, index) => (
                        <motion.div
                            key={skill.id}
                            initial={{ opacity: 0, scale: 0.9 }}
                            whileInView={{ opacity: 1, scale: 1 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.4, delay: index * 0.05 }}
                            whileHover={{ y: -5, scale: 1.05 }}
                            className="flex items-center gap-3 px-6 py-3 glass-card rounded-2xl hover:border-primary/50 transition-all duration-300 group"
                        >
                            <div className="h-2 w-2 rounded-full bg-primary/30 group-hover:bg-primary transition-colors" />
                            <span className="font-semibold text-muted-foreground group-hover:text-primary transition-colors">{skill.name}</span>
                        </motion.div>
                    ))}
                </div>
            </div>
        </section>
    )
}
