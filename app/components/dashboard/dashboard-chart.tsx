"use client"

import {
    AreaChart,
    Area,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
    ResponsiveContainer,
} from "recharts"

interface ChartDataPoint {
    name: string
    views: number
    contacts?: number
}

interface DashboardChartProps {
    data: ChartDataPoint[]
    title?: string
}

export function DashboardChart({ data, title = "Overview" }: DashboardChartProps) {
    return (
        <div className="glass-card rounded-[2.5rem] p-8">
            <div className="flex items-center justify-between mb-8">
                <h3 className="text-xl font-bold font-outfit text-white tracking-tight">{title}</h3>
                <div className="flex items-center gap-4">
                    <div className="flex items-center gap-2">
                        <div className="h-2 w-2 rounded-full bg-primary" />
                        <span className="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">Views</span>
                    </div>
                </div>
            </div>

            <div className="h-[350px] w-full">
                <ResponsiveContainer width="100%" height="100%">
                    <AreaChart data={data} margin={{ top: 10, right: 10, left: -20, bottom: 0 }}>
                        <defs>
                            <linearGradient id="viewsGradient" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="5%" stopColor="oklch(var(--primary))" stopOpacity={0.3} />
                                <stop offset="95%" stopColor="oklch(var(--primary))" stopOpacity={0} />
                            </linearGradient>
                        </defs>
                        <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="rgba(255,255,255,0.03)" />
                        <XAxis
                            dataKey="name"
                            className="text-[10px] font-bold uppercase tracking-tighter"
                            tick={{ fill: "rgba(255,255,255,0.3)", fontSize: 10 }}
                            tickLine={false}
                            axisLine={false}
                            dy={10}
                        />
                        <YAxis
                            className="text-[10px] font-bold"
                            tick={{ fill: "rgba(255,255,255,0.3)", fontSize: 10 }}
                            tickLine={false}
                            axisLine={false}
                        />
                        <Tooltip
                            contentStyle={{
                                backgroundColor: "rgba(0,0,0,0.8)",
                                backdropFilter: "blur(12px)",
                                borderColor: "rgba(255,255,255,0.1)",
                                borderRadius: "16px",
                                fontSize: "12px",
                                border: "1px solid rgba(255,255,255,0.1)",
                                boxShadow: "0 20px 25px -5px rgba(0,0,0,0.5)",
                            }}
                            itemStyle={{ color: "oklch(var(--primary))", fontWeight: "bold" }}
                            labelStyle={{ color: "rgba(255,255,255,0.5)", marginBottom: "4px", fontWeight: "bold", fontSize: "10px", textTransform: "uppercase" }}
                        />
                        <Area
                            type="monotone"
                            dataKey="views"
                            stroke="oklch(var(--primary))"
                            fillOpacity={1}
                            fill="url(#viewsGradient)"
                            strokeWidth={3}
                            animationDuration={2000}
                        />
                    </AreaChart>
                </ResponsiveContainer>
            </div>
        </div>
    )
}
