import { auth } from "@/auth"
import { getSession } from "next-auth/react"

const API_URL = process.env.NEXT_PUBLIC_API_URL + "/api/v1"

interface FetchOptions extends RequestInit {
    token?: string
}

export async function fetchApi<T>(path: string, options: FetchOptions = {}): Promise<T> {
    const headers = new Headers(options.headers)

    // Client-side: get token from session
    if (typeof window !== "undefined") {
        const session = await getSession()
        // @ts-expect-error
        if (session?.accessToken) {
            // @ts-expect-error
            headers.set("Authorization", `Bearer ${session.accessToken}`)
        }
    }
    // Server-side: token should be passed or we need a way to get it (handled via wrapper usually)
    else if (options.token) {
        headers.set("Authorization", `Bearer ${options.token}`)
    }

    headers.set("Content-Type", "application/json")
    headers.set("Accept", "application/json")

    const response = await fetch(`${API_URL}${path}`, {
        ...options,
        headers,
    })

    // Handle 401 Unauthorized by potentially redirecting or throwing specific error
    if (response.status === 401) {
        if (typeof window !== "undefined") {
            // Optional: Trigger signout or redirect
            window.location.href = "/login"
        }
    }

    const data = await response.json()

    if (!response.ok) {
        throw new Error(data.message || "An error occurred while fetching data")
    }

    return data
}
