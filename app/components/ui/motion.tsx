"use client"

import { motion } from "framer-motion"

const pageVariants = {
    hidden: { opacity: 0, y: 12 },
    enter: { opacity: 1, y: 0 },
    exit: { opacity: 0, y: -12 },
}

const pageTransition = {
    type: "tween" as const,
    ease: "easeInOut" as const,
    duration: 0.25,
}

interface PageTransitionProps {
    children: React.ReactNode
    className?: string
}

export function PageTransition({ children, className }: PageTransitionProps) {
    return (
        <motion.div
            variants={pageVariants}
            initial="hidden"
            animate="enter"
            exit="exit"
            transition={pageTransition}
            className={className}
        >
            {children}
        </motion.div>
    )
}

// Staggered list items
const containerVariants = {
    hidden: { opacity: 0 },
    show: {
        opacity: 1,
        transition: { staggerChildren: 0.05 },
    },
}

const itemVariants = {
    hidden: { opacity: 0, y: 10 },
    show: { opacity: 1, y: 0 },
}

interface StaggerListProps {
    children: React.ReactNode
    className?: string
}

export function StaggerList({ children, className }: StaggerListProps) {
    return (
        <motion.div
            variants={containerVariants}
            initial="hidden"
            animate="show"
            className={className}
        >
            {children}
        </motion.div>
    )
}

export function StaggerItem({ children, className }: { children: React.ReactNode; className?: string }) {
    return (
        <motion.div variants={itemVariants} className={className}>
            {children}
        </motion.div>
    )
}

// Fade in on scroll
interface FadeInProps {
    children: React.ReactNode
    className?: string
    delay?: number
}

export function FadeIn({ children, className, delay = 0 }: FadeInProps) {
    return (
        <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, margin: "-50px" }}
            transition={{ duration: 0.5, delay, ease: "easeOut" }}
            className={className}
        >
            {children}
        </motion.div>
    )
}

// Scale on hover
export function ScaleOnHover({ children, className }: { children: React.ReactNode; className?: string }) {
    return (
        <motion.div
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
            transition={{ type: "spring", stiffness: 400, damping: 17 }}
            className={className}
        >
            {children}
        </motion.div>
    )
}
