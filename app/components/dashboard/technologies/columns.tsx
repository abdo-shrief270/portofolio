"use client"

import { ColumnDef } from "@tanstack/react-table"
import { Technology } from "@/types"
import { ArrowUpDown, MoreHorizontal, Pencil, Trash } from "lucide-react"
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
import { toast } from "sonner"
import { fetchApi } from "@/lib/api-service"
import { CellAction } from "./cell-action"

export const columns: ColumnDef<Technology>[] = [
    {
        accessorKey: "name",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Name
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            )
        },
    },
    {
        accessorKey: "slug",
        header: "Slug",
    },
    {
        accessorKey: "icon",
        header: "Icon",
    },
    {
        accessorKey: "color",
        header: "Color",
        cell: ({ row }) => (
            <div className="flex items-center gap-2">
                {row.original.color && (
                    <div
                        className="h-4 w-4 rounded-full border"
                        style={{ backgroundColor: row.original.color }}
                    />
                )}
                {row.original.color}
            </div>
        ),
    },
    {
        id: "actions",
        cell: ({ row }) => <CellAction data={row.original} />,
    },
]
