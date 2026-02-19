"use client"

import { TerminalInterface } from "@/components/dashboard/terminal/terminal-interface"

export default function TerminalPage() {
    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <div>
                    <h2 className="text-3xl font-bold tracking-tight">Terminal</h2>
                    <p className="text-muted-foreground">
                        Execute system maintenance commands and checks.
                    </p>
                </div>
            </div>

            <div className="max-w-4xl mx-auto">
                <TerminalInterface />

                <div className="mt-8 p-4 rounded-lg border bg-muted/50">
                    <h3 className="font-semibold mb-2">Available Commands</h3>
                    <ul className="text-sm space-y-1 text-muted-foreground list-disc list-inside">
                        <li><code>php artisan [command]</code> - Run Laravel Artisan commands (e.g., <code>optimize:clear</code>)</li>
                        <li><code>git status</code> - Check repository status</li>
                        <li><code>system:stats</code> - View server resource usage</li>
                        <li><code>help</code> - Show full help menu</li>
                    </ul>
                    <p className="mt-4 text-xs text-muted-foreground border-t pt-2">
                        <strong>Note:</strong> Sensitive commands (e.g., migrate:fresh) are blocked for security.
                    </p>
                </div>
            </div>
        </div>
    )
}
