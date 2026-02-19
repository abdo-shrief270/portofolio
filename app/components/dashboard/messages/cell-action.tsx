"use client"

import { useState } from "react"
import { Copy, Eye, MoreHorizontal, Trash } from "lucide-react"
import { toast } from "sonner"
import { useRouter } from "next/navigation"

import { Button } from "@/components/ui/button"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { AlertModal } from "@/components/modals/alert-modal"
import { ContactSubmission } from "@/types"
import { fetchApi } from "@/lib/api-service"

interface CellActionProps {
    data: ContactSubmission
}

export const CellAction: React.FC<CellActionProps> = ({ data }) => {
    const router = useRouter()
    const [open, setOpen] = useState(false)
    const [loading, setLoading] = useState(false)

    const onConfirm = async () => {
        try {
            setLoading(true)
            await fetchApi(`/admin/contacts/${data.id}`, {
                method: "DELETE",
            })
            toast.success("Message deleted.")
            router.refresh()
        } catch (error) {
            toast.error("Something went wrong.")
        } finally {
            setOpen(false)
            setLoading(false)
        }
    }

    const onStatusChange = async (status: 'read' | 'archived') => {
        try {
            await fetchApi(`/admin/contacts/${data.id}/status`, {
                method: "PUT",
                body: JSON.stringify({ status }),
            })
            toast.success(`Marked as ${status}.`)
            router.refresh()
        } catch (error) {
            toast.error("Something went wrong.")
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
                    <DropdownMenuItem onClick={() => router.push(`/dashboard/messages/${data.id}`)}>
                        <Eye className="mr-2 h-4 w-4" />
                        View
                    </DropdownMenuItem>
                    {data.status === 'new' && (
                        <DropdownMenuItem onClick={() => onStatusChange('read')}>
                            Mark as Read
                        </DropdownMenuItem>
                    )}
                    <DropdownMenuItem onClick={() => setOpen(true)}>
                        <Trash className="mr-2 h-4 w-4" />
                        Delete
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </>
    )
}
