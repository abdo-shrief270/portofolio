import NextAuth from "next-auth"
import Credentials from "next-auth/providers/credentials"
import type { NextAuthConfig } from "next-auth"

export const config = {
    theme: {
        logo: "https://next-auth.js.org/img/logo/logo-sm.png",
    },
    providers: [
        Credentials({
            name: "Credentials",
            credentials: {
                email: { label: "Email", type: "email" },
                password: { label: "Password", type: "password" },
            },
            authorize: async (credentials) => {
                try {
                    console.log("Attempting login to:", `${process.env.NEXT_PUBLIC_API_URL}/api/v1/auth/login`);
                    const res = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/v1/auth/login`, {
                        method: "POST",
                        body: JSON.stringify(credentials),
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                        },
                    })

                    console.log("Login response status:", res.status);
                    const data = await res.json()
                    console.log("Login response data:", data);

                    if (!res.ok) {
                        throw new Error(data.message || "Authentication failed")
                    }

                    if (res.ok && data.token) {
                        return {
                            id: data.user.id,
                            name: data.user.name,
                            email: data.user.email,
                            image: data.user.avatar,
                            token: data.token,
                        }
                    }
                    return null

                } catch (error) {
                    console.error("Login error details:", error)
                    return null
                }
            },
        }),
    ],
    callbacks: {
        async jwt({ token, user, trigger, session }) {
            if (user) {
                token.user = user
                // @ts-ignore
                token.accessToken = user.token
            }
            return token
        },
        async session({ session, token }) {
            // @ts-ignore
            session.user = token.user
            // @ts-ignore
            session.accessToken = token.accessToken
            return session
        },
    },
    pages: {
        signIn: "/login",
    },
} satisfies NextAuthConfig

export const { handlers, auth, signIn, signOut } = NextAuth(config)
