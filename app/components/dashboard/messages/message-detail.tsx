"use client"

import { useState } from "react"
import { ContactSubmission } from "@/types"
import { useRouter } from "next/navigation"
import { Button } from "@/components/ui/button"
import { ArrowLeft, Loader2, Mail, Trash } from "lucide-react"
import { Heading } from "@/components/ui/heading"
import { Separator } from "@/components/ui/separator"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { Textarea } from "@/components/ui/textarea"
import { toast } from "sonner"
import { fetchApi } from "@/lib/api-service"

interface MessageDetailProps {
    initialData: ContactSubmission
}

export const MessageDetail: React.FC<MessageDetailProps> = ({
    initialData
}) => {
    const router = useRouter()
    const [loading, setLoading] = useState(false)
    const [replyMessage, setReplyMessage] = useState("")

    const onReply = async () => {
        try {
            setLoading(true)
            await fetchApi(`/admin/contacts/${initialData.id}/reply`, {
                method: "POST",
                body: JSON.stringify({ message: replyMessage }),
            })
            router.refresh()
            toast.success("Reply sent.")
            setReplyMessage("")
        } catch (error) {
            toast.error("Something went wrong.")
        } finally {
            setLoading(false)
        }
    }

    const onStatusChange = async (status: string) => {
        try {
            setLoading(true)
            await fetchApi(`/admin/contacts/${initialData.id}/status`, {
                method: "PUT",
                body: JSON.stringify({ status }),
            })
            router.refresh()
            toast.success("Status updated.")
        } catch (error) {
            toast.error("Something went wrong.")
        } finally {
            setLoading(false)
        }
    }

    return (
        <div className="flex-col">
            <div className="flex-1 space-y-4 p-8 pt-6">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <Button variant="ghost" size="icon" onClick={() => router.back()}>
                            <ArrowLeft className="h-4 w-4" />
                        </Button>
                        <Heading
                            title="Message Details"
                            description={`From ${initialData.name}`}
                        />
                    </div>
                </div>
                <Separator />

                <div className="grid gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Contact Information</CardTitle>
                        </CardHeader>
                        <CardContent className="space-y-2">
                            <div className="grid grid-cols-3 gap-1">
                                <span className="font-semibold">Name:</span>
                                <span className="col-span-2">{initialData.name}</span>
                            </div>
                            <div className="grid grid-cols-3 gap-1">
                                <span className="font-semibold">Email:</span>
                                <span className="col-span-2">{initialData.email}</span>
                            </div>
                            {initialData.phone && (
                                <div className="grid grid-cols-3 gap-1">
                                    <span className="font-semibold">Phone:</span>
                                    <span className="col-span-2">{initialData.phone}</span>
                                </div>
                            )}
                            <div className="grid grid-cols-3 gap-1">
                                <span className="font-semibold">Date:</span>
                                <span className="col-span-2">
                                    {new Date(initialData.created_at).toLocaleString()}
                                </span>
                            </div>
                            <div className="grid grid-cols-3 gap-1 mt-4">
                                <span className="font-semibold">Status:</span>
                                <div className="col-span-2 flex items-center gap-2">
                                    <Badge variant={initialData.status === 'new' ? 'destructive' : 'secondary'}>
                                        {initialData.status}
                                    </Badge>
                                    {initialData.status === 'new' && (
                                        <Button
                                            variant="outline"
                                            size="sm"
                                            onClick={() => onStatusChange('read')}
                                            disabled={loading}
                                        >
                                            Mark as Read
                                        </Button>
                                    )}
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>Subject: {initialData.subject}</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div className="bg-muted p-4 rounded-md whitespace-pre-wrap min-h-[150px]">
                                {initialData.message}
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Reply</CardTitle>
                    </CardHeader>
                    <CardContent>
                        {initialData.status === 'replied' ? (
                            <div className="bg-green-50 dark:bg-green-900/20 p-4 rounded-md border border-green-200 dark:border-green-800">
                                <p className="font-semibold text-green-800 dark:text-green-300">
                                    Replied on {new Date(initialData.replied_at!).toLocaleString()}
                                </p>
                                <p className="mt-2 text-green-700 dark:text-green-400">
                                    {initialData.reply_message}
                                </p>
                            </div>
                        ) : (
                            <div className="space-y-4">
                                <Textarea
                                    disabled={loading}
                                    placeholder="Type your reply here..."
                                    value={replyMessage}
                                    onChange={(e) => setReplyMessage(e.target.value)}
                                    rows={5}
                                />
                                <Button
                                    disabled={loading || !replyMessage.trim()}
                                    onClick={onReply}
                                >
                                    {loading && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
                                    <Mail className="mr-2 h-4 w-4" />
                                    Send Reply
                                </Button>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </div>
    )
}
