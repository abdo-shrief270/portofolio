"use client"

import Link from "next/link"
import { Button } from "@/components/ui/button"
import { ArrowRight, Github, Linkedin, Mail } from "lucide-react"
import { motion } from "framer-motion"

export const Hero = () => {
    return (
        <div className="relative isolate min-h-[90vh] flex items-center justify-center overflow-hidden">
            {/* Animated Background Elements */}
            <div className="absolute inset-0 -z-10">
                <div className="absolute top-0 left-1/4 w-96 h-96 bg-primary/20 rounded-full blur-[128px] animate-pulse" />
                <div className="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-[128px] animate-pulse delay-700" />
                <div className="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 pointer-events-none" />
            </div>

            <div className="mx-auto max-w-4xl px-6 py-32 sm:py-48 lg:py-56 text-center">
                <motion.div
                    initial={{ opacity: 0, scale: 0.9 }}
                    animate={{ opacity: 1, scale: 1 }}
                    transition={{ duration: 0.8, ease: "easeOut" }}
                    className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass border-white/10 text-xs font-medium text-primary mb-8 animate-in fade-in slide-in-from-bottom-4"
                >
                    <span className="relative flex h-2 w-2">
                        <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span className="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Available for new projects
                </motion.div>

                <motion.h1
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.2 }}
                    className="text-5xl font-bold tracking-tight text-foreground sm:text-7xl font-outfit"
                >
                    <span className="text-gradient">Crafting Digital</span>
                    <br />
                    <span className="text-primary">Masterpieces</span>
                </motion.h1>

                <motion.p
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.4 }}
                    className="mt-8 text-xl leading-8 text-muted-foreground max-w-2xl mx-auto"
                >
                    Full Stack Engineer specializing in high-performance web applications.
                    Merging technical excellence with creative design.
                </motion.p>

                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.6 }}
                    className="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4"
                >
                    <Link href="/projects">
                        <Button size="lg" className="rounded-full px-8 h-12 text-md shadow-lg shadow-primary/20 hover:shadow-primary/40 transition-all hover:scale-105 active:scale-95 group">
                            Explore Work
                            <ArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" />
                        </Button>
                    </Link>
                    <Link href="/contact">
                        <Button variant="outline" size="lg" className="rounded-full px-8 h-12 text-md glass hover:bg-accent/50 transition-all active:scale-95">
                            Let's Talk
                        </Button>
                    </Link>
                </motion.div>

                <motion.div
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ duration: 1, delay: 1 }}
                    className="mt-16 flex items-center justify-center gap-8 text-muted-foreground/50"
                >
                    <Link href="#" className="hover:text-primary transition-colors"><Github className="h-6 w-6" /></Link>
                    <Link href="#" className="hover:text-primary transition-colors"><Linkedin className="h-6 w-6" /></Link>
                    <Link href="#" className="hover:text-primary transition-colors"><Mail className="h-6 w-6" /></Link>
                </motion.div>
            </div>
        </div>
    )
}
