"use client"

import { useState, useEffect } from "react"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button"
import { Badge } from "@/components/ui/badge"
import { Input } from "@/components/ui/input"
import { Textarea } from "@/components/ui/textarea"
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog"
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table"
import { fetchApi } from "@/lib/api-service"
import { Testimonial } from "@/types"
import { Plus, Pencil, Trash2, Star, Quote } from "lucide-react"

export default function TestimonialsPage() {
    const [testimonials, setTestimonials] = useState<Testimonial[]>([])
    const [loading, setLoading] = useState(true)
    const [dialogOpen, setDialogOpen] = useState(false)
    const [editingId, setEditingId] = useState<string | null>(null)
    const [form, setForm] = useState({
        name: "",
        position: "",
        company: "",
        content: "",
        rating: 5,
        is_featured: false,
        sort_order: 0,
    })

    const loadData = async () => {
        try {
            const res = await fetchApi<{ data: Testimonial[] }>("/admin/testimonials")
            setTestimonials(res.data)
        } catch (e) {
            console.error(e)
        } finally {
            setLoading(false)
        }
    }

    useEffect(() => { loadData() }, [])

    const resetForm = () => {
        setForm({ name: "", position: "", company: "", content: "", rating: 5, is_featured: false, sort_order: 0 })
        setEditingId(null)
    }

    const handleEdit = (t: Testimonial) => {
        setForm({
            name: t.name,
            position: t.position || "",
            company: t.company || "",
            content: t.content,
            rating: t.rating,
            is_featured: t.is_featured,
            sort_order: t.sort_order,
        })
        setEditingId(t.id)
        setDialogOpen(true)
    }

    const handleSubmit = async () => {
        try {
            if (editingId) {
                await fetchApi(`/admin/testimonials/${editingId}`, {
                    method: "PUT",
                    body: JSON.stringify(form),
                })
            } else {
                await fetchApi("/admin/testimonials", {
                    method: "POST",
                    body: JSON.stringify(form),
                })
            }
            setDialogOpen(false)
            resetForm()
            loadData()
        } catch (e) {
            console.error(e)
        }
    }

    const handleDelete = async (id: string) => {
        if (!confirm("Delete this testimonial?")) return
        try {
            await fetchApi(`/admin/testimonials/${id}`, { method: "DELETE" })
            loadData()
        } catch (e) {
            console.error(e)
        }
    }

    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <h2 className="text-3xl font-bold tracking-tight text-primary">Testimonials</h2>
                <Dialog open={dialogOpen} onOpenChange={(v) => { setDialogOpen(v); if (!v) resetForm() }}>
                    <DialogTrigger asChild>
                        <Button><Plus className="h-4 w-4 mr-2" /> Add Testimonial</Button>
                    </DialogTrigger>
                    <DialogContent className="sm:max-w-lg">
                        <DialogHeader>
                            <DialogTitle>{editingId ? "Edit" : "Add"} Testimonial</DialogTitle>
                        </DialogHeader>
                        <div className="space-y-4 mt-4">
                            <Input placeholder="Name" value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} />
                            <Input placeholder="Position" value={form.position} onChange={(e) => setForm({ ...form, position: e.target.value })} />
                            <Input placeholder="Company" value={form.company} onChange={(e) => setForm({ ...form, company: e.target.value })} />
                            <Textarea placeholder="Testimonial content..." rows={4} value={form.content} onChange={(e) => setForm({ ...form, content: e.target.value })} />
                            <div className="flex items-center gap-4">
                                <label className="text-sm font-medium">Rating</label>
                                <div className="flex gap-1">
                                    {[1, 2, 3, 4, 5].map((n) => (
                                        <button key={n} onClick={() => setForm({ ...form, rating: n })} className="focus:outline-none">
                                            <Star className={`h-5 w-5 ${n <= form.rating ? "fill-amber-400 text-amber-400" : "text-muted-foreground"}`} />
                                        </button>
                                    ))}
                                </div>
                            </div>
                            <div className="flex items-center gap-2">
                                <input type="checkbox" id="featured" checked={form.is_featured} onChange={(e) => setForm({ ...form, is_featured: e.target.checked })} />
                                <label htmlFor="featured" className="text-sm">Featured</label>
                            </div>
                            <Input type="number" placeholder="Sort Order" value={form.sort_order} onChange={(e) => setForm({ ...form, sort_order: parseInt(e.target.value) || 0 })} />
                            <Button onClick={handleSubmit} className="w-full">
                                {editingId ? "Update" : "Create"} Testimonial
                            </Button>
                        </div>
                    </DialogContent>
                </Dialog>
            </div>

            <Card>
                <CardContent className="p-0">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Company</TableHead>
                                <TableHead>Rating</TableHead>
                                <TableHead>Featured</TableHead>
                                <TableHead className="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {loading ? (
                                <TableRow><TableCell colSpan={5} className="text-center py-8 text-muted-foreground">Loading...</TableCell></TableRow>
                            ) : testimonials.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={5} className="text-center py-12">
                                        <Quote className="h-10 w-10 mx-auto text-muted-foreground mb-2" />
                                        <p className="text-muted-foreground">No testimonials yet</p>
                                    </TableCell>
                                </TableRow>
                            ) : (
                                testimonials.map((t) => (
                                    <TableRow key={t.id}>
                                        <TableCell>
                                            <div>
                                                <p className="font-medium">{t.name}</p>
                                                {t.position && <p className="text-xs text-muted-foreground">{t.position}</p>}
                                            </div>
                                        </TableCell>
                                        <TableCell>{t.company || "—"}</TableCell>
                                        <TableCell>
                                            <div className="flex gap-0.5">
                                                {Array.from({ length: 5 }).map((_, i) => (
                                                    <Star key={i} className={`h-3 w-3 ${i < t.rating ? "fill-amber-400 text-amber-400" : "text-muted-foreground"}`} />
                                                ))}
                                            </div>
                                        </TableCell>
                                        <TableCell>
                                            <Badge variant={t.is_featured ? "default" : "secondary"}>
                                                {t.is_featured ? "Featured" : "Hidden"}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <Button variant="ghost" size="icon" onClick={() => handleEdit(t)}>
                                                <Pencil className="h-4 w-4" />
                                            </Button>
                                            <Button variant="ghost" size="icon" onClick={() => handleDelete(t.id)} className="text-destructive">
                                                <Trash2 className="h-4 w-4" />
                                            </Button>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )}
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    )
}
