export interface ApiResponse<T> {
    data: T
    message?: string
}

export interface PaginatedResponse<T> {
    data: T[]
    links: {
        first: string
        last: string
        prev: string | null
        next: string | null
    }
    meta: {
        current_page: number
        from: number
        last_page: number
        links: {
            url: string | null
            label: string
            active: boolean
        }[]
        path: string
        per_page: number
        to: number
        total: number
    }
}

export interface Category {
    id: string
    name: string
    slug: string
    description?: string
    icon?: string
    sort_order: number
    projects_count?: number
}

export interface Technology {
    id: string
    name: string
    slug: string
    icon?: string
    color?: string
    category: 'frontend' | 'backend' | 'database' | 'devops' | 'other'
    url?: string
    is_primary?: boolean
}

export interface ContactSubmission {
    id: string
    name: string
    email: string
    phone?: string
    subject: string
    message: string
    status: 'new' | 'read' | 'replied' | 'archived'
    created_at: string
    replied_at?: string
    reply_message?: string
    project?: Project
}

export interface SiteSetting {
    key: string
    value: string
    group: string
    type?: string
}

export interface Project {
    id: string
    title: string
    slug: string
    subtitle?: string
    description?: string
    short_description?: string
    status: 'live' | 'in_progress' | 'completed' | 'archived'
    is_featured: boolean
    is_active: boolean
    demo_url?: string
    subdomain?: string
    subdomain_status?: string
    github_url?: string
    thumbnail?: string
    gallery?: string[]
    tech_stack?: string[]
    features?: {
        title: string
        description?: string
        icon?: string
    }[]
    seo?: {
        title?: string
        description?: string
        keywords?: string[]
        og_image?: string
    }
    category?: Category
    technologies?: Technology[]
    sort_order: number
    published_at?: string
    created_at: string
    updated_at: string
}

export interface Testimonial {
    id: string
    name: string
    position?: string
    company?: string
    avatar?: string
    content: string
    rating: number
    is_featured: boolean
    sort_order: number
    created_at: string
}

export interface Experience {
    id: string
    company: string
    position: string
    location?: string
    type: 'full_time' | 'part_time' | 'contract' | 'freelance' | 'internship'
    start_date: string
    end_date?: string
    is_current: boolean
    description?: string
    responsibilities?: string[]
    technologies_used?: string[]
    sort_order: number
}

export interface Education {
    id: string
    institution: string
    degree: string
    field_of_study?: string
    start_date: string
    end_date?: string
    is_current: boolean
    description?: string
    grade?: string
    sort_order: number
}

export interface Course {
    id: string
    title: string
    provider: string
    instructor?: string
    description?: string
    course_url?: string
    certificate_url?: string
    completed_at?: string
    duration_hours?: number
    skills_learned?: string[]
    sort_order: number
}
