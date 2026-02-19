"use client"

import { DataTable } from "@/components/ui/data-table"
import { ContactSubmission } from "@/types"
import { columns } from "./columns"
import { Heading } from "@/components/ui/heading"
import { Separator } from "@/components/ui/separator"

interface MessagesClientProps {
    data: ContactSubmission[]
}

export const MessagesClient: React.FC<MessagesClientProps> = ({
    data
}) => {
    return (
        <>
            <div className="flex items-center justify-between">
                <Heading
                    title={`Messages (${data.length})`}
                    description="View and manage contact form submissions"
                />
            </div>
            <Separator />
            <DataTable searchKey="name" columns={columns} data={data} />
        </>
    )
}
