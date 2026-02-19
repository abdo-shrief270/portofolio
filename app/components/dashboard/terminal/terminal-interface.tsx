"use client"

import { useState, useRef, useEffect } from "react"
import { fetchApi } from "@/lib/api-service"
import { ScrollArea } from "@/components/ui/scroll-area"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Loader2, TerminalSquare, Trash2 } from "lucide-react"
import { toast } from "sonner"

interface CommandHistory {
    command: string
    output: string
    timestamp: number
}

export const TerminalInterface = () => {
    const [input, setInput] = useState("")
    const [history, setHistory] = useState<CommandHistory[]>([])
    const [loading, setLoading] = useState(false)
    const [commandIndex, setCommandIndex] = useState(-1)
    const scrollRef = useRef<HTMLDivElement>(null)
    const inputRef = useRef<HTMLInputElement>(null)

    // Auto-scroll to bottom
    useEffect(() => {
        if (scrollRef.current) {
            scrollRef.current.scrollIntoView({ behavior: "smooth" })
        }
    }, [history])

    const handleExecute = async (e?: React.FormEvent) => {
        if (e) e.preventDefault()

        const cmd = input.trim()
        if (!cmd) return

        if (cmd === "clear") {
            setHistory([])
            setInput("")
            return
        }

        setLoading(true)
        setInput("")
        setCommandIndex(-1)

        // Optimistic update
        const tempId = Date.now()
        setHistory(prev => [...prev, { command: cmd, output: "...", timestamp: tempId }])

        try {
            const res = await fetchApi<{ output: string }>("/admin/terminal/execute", {
                method: "POST",
                body: JSON.stringify({ command: cmd }),
            })

            setHistory(prev => prev.map(item =>
                item.timestamp === tempId
                    ? { ...item, output: res.output }
                    : item
            ))
        } catch (error: any) {
            setHistory(prev => prev.map(item =>
                item.timestamp === tempId
                    ? { ...item, output: error.message || "Failed to execute command" }
                    : item
            ))
        } finally {
            setLoading(false)
            // Keep focus
            setTimeout(() => inputRef.current?.focus(), 10)
        }
    }

    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === "ArrowUp") {
            e.preventDefault()
            if (history.length > 0) {
                const newIndex = commandIndex + 1
                if (newIndex < history.length) {
                    setCommandIndex(newIndex)
                    setInput(history[history.length - 1 - newIndex].command)
                }
            }
        } else if (e.key === "ArrowDown") {
            e.preventDefault()
            if (commandIndex > 0) {
                const newIndex = commandIndex - 1
                setCommandIndex(newIndex)
                setInput(history[history.length - 1 - newIndex].command)
            } else if (commandIndex === 0) {
                setCommandIndex(-1)
                setInput("")
            }
        }
    }

    return (
        <div className="flex flex-col h-[600px] border rounded-lg bg-black text-green-500 font-mono text-sm shadow-xl overflow-hidden">
            {/* Terminal Header */}
            <div className="flex items-center justify-between px-4 py-2 bg-zinc-900 border-b border-zinc-800">
                <div className="flex items-center gap-2">
                    <TerminalSquare className="h-4 w-4" />
                    <span>System Terminal</span>
                </div>
                <Button
                    variant="ghost"
                    size="icon"
                    onClick={() => setHistory([])}
                    className="h-6 w-6 text-zinc-400 hover:text-white"
                    title="Clear Console"
                >
                    <Trash2 className="h-4 w-4" />
                </Button>
            </div>

            {/* Terminal Output */}
            <ScrollArea className="flex-1 p-4 min-h-0" data-terminal-output>
                <div className="flex flex-col gap-4">
                    <div className="opacity-50">
                        Welcome to the Portfolio Admin Terminal. Type 'help' for available commands.
                    </div>

                    {history.map((entry, i) => (
                        <div key={i} className="flex flex-col gap-1">
                            <div className="flex items-center gap-2 font-bold text-white">
                                <span className="text-green-500">➜</span>
                                <span>~</span>
                                <span>{entry.command}</span>
                            </div>
                            <pre className="whitespace-pre-wrap pl-5 text-zinc-300 font-mono">
                                {entry.output}
                            </pre>
                        </div>
                    ))}
                    <div ref={scrollRef} className="h-px w-px" />
                </div>
            </ScrollArea>

            {/* Input Area */}
            <div className="p-4 bg-zinc-900 border-t border-zinc-800">
                <form onSubmit={handleExecute} className="flex items-center gap-2">
                    <span className="text-green-500 font-bold">➜</span>
                    <Input
                        ref={inputRef}
                        type="text"
                        value={input}
                        onChange={(e) => setInput(e.target.value)}
                        onKeyDown={handleKeyDown}
                        className="flex-1 bg-transparent border-none focus-visible:ring-0 text-white font-mono placeholder:text-zinc-600 h-auto p-0"
                        placeholder="Type a command..."
                        autoComplete="off"
                        autoFocus
                    />
                    {loading && <Loader2 className="h-4 w-4 animate-spin text-zinc-400" />}
                </form>
            </div>
        </div>
    )
}
