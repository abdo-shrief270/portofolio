"use client"

import { ColumnDef } from "@tanstack/react-table"
import { CellAction } from "./cell-action"
import { Project } from "@/types"
import { Badge } from "@/components/ui/badge"
import { Checkbox } from "@/components/ui/checkbox"

export const columns: ColumnDef<Project>[] = [
    {
        id: "select",
        header: ({ table }) => (
            <Checkbox
                checked={table.getIsAllPageRowsSelected()}
                onCheckedChange={(value: boolean | "indeterminate") => table.toggleAllPageRowsSelected(!!value)}
                aria-label="Select all"
            />
        ),
        cell: ({ row }) => (
            <Checkbox
                checked={row.getIsSelected()}
                onCheckedChange={(value: boolean | "indeterminate") => row.toggleSelected(!!value)}
                aria-label="Select row"
            />
        ),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: "title",
        header: "Title",
    },
    {
        accessorKey: "category.name",
        header: "Category",
        cell: ({ row }) => row.original.category?.name || "Uncategorized",
    },
    {
        accessorKey: "status",
        header: "Status",
        cell: ({ row }) => (
            <Badge variant={row.original.status === 'live' ? 'default' : 'secondary'}>
                {row.original.status}
            </Badge>
        )
    },
    {
        accessorKey: "is_active",
        header: "Active",
        cell: ({ row }) => (
            <Badge variant={row.original.is_active ? 'default' : 'destructive'}>
                {row.original.is_active ? 'Active' : 'Inactive'}
            </Badge>
        )
    },
    {
        accessorKey: "is_featured",
        header: "Featured",
        cell: ({ row }) => (
            row.original.is_featured ? <Badge variant="outline">Featured</Badge> : null
        )
    },
    {
        accessorKey: "created_at",
        header: "Date",
    },
    {
        id: "actions",
        cell: ({ row }) => <CellAction data={row.original} />,
    },
]
