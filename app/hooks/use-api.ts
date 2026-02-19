"use client"

import { useCallback, useState } from "react"
import { fetchApi } from "@/lib/api-service"

interface UseFetchOptions {
    immediate?: boolean
}

interface UseFetchReturn<T> {
    data: T | null
    loading: boolean
    error: string | null
    execute: () => Promise<void>
}

export function useFetch<T>(path: string, options?: UseFetchOptions): UseFetchReturn<T> {
    const [data, setData] = useState<T | null>(null)
    const [loading, setLoading] = useState(false)
    const [error, setError] = useState<string | null>(null)

    const execute = useCallback(async () => {
        setLoading(true)
        setError(null)
        try {
            const result = await fetchApi<T>(path)
            setData(result)
        } catch (e: any) {
            setError(e.message || "An error occurred")
        } finally {
            setLoading(false)
        }
    }, [path])

    return { data, loading, error, execute }
}

export function useMutation<TData = any, TVariables = any>(
    path: string,
    method: "POST" | "PUT" | "DELETE" = "POST"
) {
    const [loading, setLoading] = useState(false)
    const [error, setError] = useState<string | null>(null)

    const mutate = useCallback(async (variables?: TVariables): Promise<TData | null> => {
        setLoading(true)
        setError(null)
        try {
            const result = await fetchApi<TData>(path, {
                method,
                body: variables ? JSON.stringify(variables) : undefined,
            })
            return result
        } catch (e: any) {
            setError(e.message || "An error occurred")
            return null
        } finally {
            setLoading(false)
        }
    }, [path, method])

    return { mutate, loading, error }
}
