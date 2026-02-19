"use client"

import { Plus } from "lucide-react"
import { useRouter } from "next/navigation"

import { Button } from "@/components/ui/button"
import { DataTable } from "@/components/ui/data-table"
import { Heading } from "@/components/ui/heading"
import { Separator } from "@/components/ui/separator"
import { Project } from "@/types"
import { columns } from "./columns"

interface ProjectClientProps {
    data: Project[]
}

export const ProjectClient: React.FC<ProjectClientProps> = ({ data }) => {
    const router = useRouter()

    return (
        <>
            <div className="flex items-center justify-between">
                <Heading
                    title={`Projects (${data.length})`}
                    description="Manage projects for your portfolio"
                />
                <Button onClick={() => router.push(`/dashboard/projects/new`)}>
                    <Plus className="mr-2 h-4 w-4" /> Add New
                </Button>
            </div>
            <Separator />
            <DataTable searchKey="title" columns={columns} data={data} />
        </>
    )
}
