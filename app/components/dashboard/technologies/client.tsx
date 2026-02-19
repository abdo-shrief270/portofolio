"use client"

import { DataTable } from "@/components/ui/data-table"
import { Technology } from "@/types"
import { columns } from "./columns"
import { Button } from "@/components/ui/button"
import { Plus } from "lucide-react"
import { useRouter } from "next/navigation"
import { Heading } from "@/components/ui/heading"
import { Separator } from "@/components/ui/separator"

interface TechnologyClientProps {
    data: Technology[]
}

export const TechnologyClient: React.FC<TechnologyClientProps> = ({
    data
}) => {
    const router = useRouter()

    return (
        <>
            <div className="flex items-center justify-between">
                <Heading
                    title={`Technologies (${data.length})`}
                    description="Manage technologies for your projects"
                />
                <Button onClick={() => router.push(`/dashboard/technologies/new`)}>
                    <Plus className="mr-2 h-4 w-4" />
                    Add New
                </Button>
            </div>
            <Separator />
            <DataTable searchKey="name" columns={columns} data={data} />
        </>
    )
}
