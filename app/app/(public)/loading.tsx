import { Skeleton } from "@/components/ui/skeleton"

export default function PublicLoading() {
    return (
        <div className="min-h-screen">
            <Skeleton className="h-[70vh] w-full" />
            <div className="container mx-auto px-4 py-12 space-y-6">
                <Skeleton className="h-8 w-64 mx-auto" />
                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {Array.from({ length: 3 }).map((_, i) => (
                        <Skeleton key={i} className="h-64 rounded-xl" />
                    ))}
                </div>
            </div>
        </div>
    )
}
