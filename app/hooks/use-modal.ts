"use client"

import { useCallback, useState } from "react"

interface ModalState {
    isOpen: boolean
    data: any
}

export function useModal() {
    const [state, setState] = useState<ModalState>({ isOpen: false, data: null })

    const open = useCallback((data?: any) => {
        setState({ isOpen: true, data: data ?? null })
    }, [])

    const close = useCallback(() => {
        setState({ isOpen: false, data: null })
    }, [])

    return {
        isOpen: state.isOpen,
        data: state.data,
        open,
        close,
    }
}
