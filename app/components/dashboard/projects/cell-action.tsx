"use client"

import { useState } from "react"
import { Copy, Edit, MoreHorizontal, Trash, Play, Pause } from "lucide-react"
import { toast } from "sonner"
import { useRouter } from "next/navigation"

import { Button } from "@/components/ui/button"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Project } from "@/types"
import { fetchApi } from "@/lib/api-service"
import { AlertModal } from "@/components/modals/alert-modal"

interface CellActionProps {
    data: Project
}

export const CellAction: React.FC<CellActionProps> = ({ data }) => {
    const router = useRouter()
    const [loading, setLoading] = useState(false)
    const [open, setOpen] = useState(false)

    const onConfirm = async () => {
        try {
            setLoading(true)
            await fetchApi(`/admin/projects/${data.id}`, {
                method: "DELETE",
            })
            toast.success("Project deleted.")
            router.refresh()
        } catch (error: any) {
            toast.error(error.message || "Something went wrong.")
        } finally {
            setLoading(false)
            setOpen(false)
        }
    }

    const onCopy = (id: string) => {
        navigator.clipboard.writeText(id)
        toast.success("Project ID copied to clipboard.")
    }

    const onToggleActive = async (status: boolean) => {
        try {
            setLoading(true)
            const endpoint = status ? `/admin/projects/${data.id}/start` : `/admin/projects/${data.id}/stop`
            await fetchApi(endpoint, { method: "POST" })
            toast.success(status ? "Project started." : "Project stopped.")
            router.refresh()
        } catch (error) {
            toast.error("Something went wrong.")
        } finally {
            setLoading(false)
        }
    }

    return (
        <>
            <AlertModal
                isOpen={open}
                onClose={() => setOpen(false)}
                onConfirm={onConfirm}
                loading={loading}
            />
            <DropdownMenu>
                <DropdownMenuTrigger asChild>
                    <Button variant="ghost" className="h-8 w-8 p-0">
                        <span className="sr-only">Open menu</span>
                        <MoreHorizontal className="h-4 w-4" />
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent align="end">
                    <DropdownMenuLabel>Actions</DropdownMenuLabel>
                    <DropdownMenuItem onClick={() => onCopy(data.id)}>
                        <Copy className="mr-2 h-4 w-4" /> Copy ID
                    </DropdownMenuItem>
                    <DropdownMenuItem onClick={() => router.push(`/dashboard/projects/${data.id}`)}>
                        <Edit className="mr-2 h-4 w-4" /> Update
                    </DropdownMenuItem>
                    {data.is_active ? (
                        <DropdownMenuItem onClick={() => onToggleActive(false)}>
                            <Pause className="mr-2 h-4 w-4" /> Stop Project
                        </DropdownMenuItem>
                    ) : (
                        <DropdownMenuItem onClick={() => onToggleActive(true)}>
                            <Play className="mr-2 h-4 w-4" /> Start Project
                        </DropdownMenuItem>
                    )}
                    <DropdownMenuSeparator />
                    <DropdownMenuItem onClick={() => setOpen(true)} className="text-destructive focus:text-destructive">
                        <Trash className="mr-2 h-4 w-4" /> Delete
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </>
    )
}
