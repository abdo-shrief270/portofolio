"use client"

import { ColumnDef } from "@tanstack/react-table"
import { ContactSubmission } from "@/types"
import { ArrowUpDown, Eye, Mail, MoreHorizontal } from "lucide-react"
import { Button } from "@/components/ui/button"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { useRouter } from "next/navigation"
import { Badge } from "@/components/ui/badge"
import { CellAction } from "./cell-action"

export const columns: ColumnDef<ContactSubmission>[] = [
    {
        accessorKey: "created_at",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Date
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            )
        },
        cell: ({ row }) => new Date(row.original.created_at).toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        }),
    },
    {
        accessorKey: "name",
        header: "Name",
    },
    {
        accessorKey: "subject",
        header: "Subject",
    },
    {
        accessorKey: "status",
        header: "Status",
        cell: ({ row }) => {
            const status = row.original.status
            let variant: "default" | "secondary" | "destructive" | "outline" = "default"

            if (status === 'new') variant = "destructive"
            if (status === 'read') variant = "secondary"
            if (status === 'replied') variant = "outline" // green? outline for now
            if (status === 'archived') variant = "outline"

            return <Badge variant={variant}>{status}</Badge>
        },
    },
    {
        id: "actions",
        cell: ({ row }) => <CellAction data={row.original} />,
    },
]
