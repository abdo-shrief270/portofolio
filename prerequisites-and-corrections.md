# DevPortfolio — Plan v2: Prerequisites & Corrections

> **Read this BEFORE starting any module. This document patches the main plan (portfolio-plan-v2.md) with critical updates discovered during final audit.**

---

## 🔴 CRITICAL CORRECTIONS TO PLAN v2

### 1. Next.js 16: `middleware.ts` is now `proxy.ts`

Next.js 16 renamed `middleware.ts` to `proxy.ts`. Any AI module implementing auth protection or route guards must use this new filename.

**In the plan, wherever middleware is referenced, use:**
```typescript
// src/app/proxy.ts (NOT middleware.ts)
import { auth } from "@/lib/auth"
import { NextResponse } from "next/server"

export async function proxy(request) {
  const session = await auth() // Auth.js v5 syntax
  
  if (request.nextUrl.pathname.startsWith("/dashboard") && !session) {
    return NextResponse.redirect(new URL("/login", request.url))
  }
  return NextResponse.next()
}

export const config = {
  matcher: ["/dashboard/:path*"]
}
```

### 2. Auth.js v5 — Installation Fix for Next.js 16

Auth.js v5 has a **peer dependency conflict** with Next.js 16. The install command in the plan must be:

```bash
# ⚠️ REQUIRED: use --legacy-peer-deps flag
npm install next-auth@beta --legacy-peer-deps
```

Also note: **Auth.js is now part of the Better Auth ecosystem** (as of 2026). The API is the same, but documentation has moved. Use:
- Docs: https://authjs.dev (still valid)
- Migration guide: https://authjs.dev/getting-started/migrating-to-v5

**Alternative: If the peer dep issue persists at build time, consider using `better-auth` directly:**
```bash
npm install better-auth
```
Better Auth is fully compatible with Next.js 16 and has native `proxy.ts` support with both cookie-based and full session validation patterns.

### 3. Hostinger API — Correct Endpoints & Auth

The plan references the Hostinger API but didn't specify the exact endpoint format. Here is the confirmed API:

**Base URL:** `https://developers.hostinger.com`

**Authentication:** Bearer token in Authorization header
```
Authorization: Bearer {your_api_token}
```

**DNS Endpoints (confirmed available):**
```
GET    /api/dns/v1/zones/{domain}              → Get all DNS records
PUT    /api/dns/v1/zones/{domain}              → Update/add DNS records
DELETE /api/dns/v1/zones/{domain}              → Delete DNS records by filter
POST   /api/dns/v1/zones/{domain}/reset        → Reset to defaults
POST   /api/dns/v1/zones/{domain}/validate     → Validate records before applying
GET    /api/dns/v1/zones/{domain}/snapshots     → List DNS snapshots
POST   /api/dns/v1/zones/{domain}/snapshots/{id}/restore → Restore snapshot
```

**Update zone (add A record) example:**
```json
PUT /api/dns/v1/zones/portfolio.dev
{
  "overwrite": false,
  "zone": [
    {
      "name": "ecommerce",
      "type": "A",
      "ttl": 3600,
      "content": "YOUR_VPS_IP"
    }
  ]
}
```
- `overwrite: false` → appends new records and updates existing ones matching name+type
- `overwrite: true` → replaces all records matching name+type

**Delete specific record:**
```json
DELETE /api/dns/v1/zones/portfolio.dev
{
  "filters": [
    { "name": "ecommerce", "type": "A" }
  ]
}
```

### 4. Hostinger API — CLI & MCP Server Bonus

Hostinger also provides:
- **CLI tool (`hapi`)**: `npm install -g hostinger-api-mcp` — useful for testing DNS changes from terminal
- **MCP Server**: Can be connected to AI agents (Claude, Cursor, etc.) for direct hosting management

This is relevant for Module 6 (Terminal) — you could integrate `hapi` commands into the dashboard terminal for DNS management shortcuts.

### 5. `next/font` — Geist Font Clarification

The plan says "Geist or Inter". **Use Geist** — it ships built-in with `create-next-app` in Next.js 16 and is optimized for the framework:
```typescript
// src/app/layout.tsx
import { Geist, Geist_Mono } from "next/font/google"

const geistSans = Geist({ subsets: ["latin"], variable: "--font-sans" })
const geistMono = Geist_Mono({ subsets: ["latin"], variable: "--font-mono" })
```

### 6. Async Request APIs — Breaking Change

Next.js 16 **fully removes synchronous access** to request APIs. All `params`, `searchParams`, `cookies()`, and `headers()` must be awaited:

```typescript
// ❌ WRONG (worked in Next.js 15 with deprecation warning)
export default function Page({ params }: { params: { slug: string } }) {
  return <div>{params.slug}</div>
}

// ✅ CORRECT (Next.js 16)
export default async function Page({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params
  return <div>{slug}</div>
}
```

**This affects every dynamic page in Modules 2 and 3.** AI modules must use `async` for all page/layout components that access params or searchParams.

---

## 🟡 PREREQUISITES (Must Complete Before Starting)

### For ALL Modules

| # | Prerequisite | Action | Who |
|---|-------------|--------|-----|
| 1 | **Domain purchased** | Buy `yourdomain.dev` (or your chosen domain) on Hostinger | You |
| 2 | **VPS provisioned** | Hostinger VPS (Ubuntu 24.04 LTS, min 4GB RAM, 2 vCPU) | You |
| 3 | **Domain pointed to Hostinger NS** | Domain nameservers must point to Hostinger (`ns1.dns-parking.com`, `ns2.dns-parking.com`) for API DNS management to work | You |
| 4 | **SSH access to VPS** | Have SSH key pair ready, root or sudo user configured | You |
| 5 | **Git repo created** | Create a private GitHub repo (or GitLab) with two directories: `api/` and `frontend/` | You |
| 6 | **Hostinger API token** | Generate from hPanel → Profile → Account Information → API → New Token. **Save it immediately** — it won't be shown again | You |

### For Module 1 (Laravel API)

| # | Prerequisite | Action |
|---|-------------|--------|
| 7 | **PHP 8.4 installed** on VPS | `sudo add-apt-repository ppa:ondrej/php && sudo apt install php8.4 php8.4-fpm php8.4-mbstring php8.4-xml php8.4-curl php8.4-mysql php8.4-redis php8.4-zip php8.4-gd php8.4-intl php8.4-bcmath php8.4-ssh2` |
| 8 | **Composer installed** | `curl -sS https://getcomposer.org/installer \| php && sudo mv composer.phar /usr/local/bin/composer` |
| 9 | **MySQL 8.4 installed** | `sudo apt install mysql-server` → create database `portfolio` and a dedicated DB user |
| 10 | **Redis 7 installed** | `sudo apt install redis-server` → verify with `redis-cli ping` |
| 11 | **Meilisearch installed** | Follow https://www.meilisearch.com/docs/learn/getting_started/installation — set a master key in `.env` |

### For Module 2 & 3 (Next.js Frontend)

| # | Prerequisite | Action |
|---|-------------|--------|
| 12 | **Node.js 22 LTS** on VPS | `curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh \| bash && nvm install 22` |
| 13 | **PM2 installed** | `npm install -g pm2` — for running Next.js in production |
| 14 | **Decide on Figma or template** | If you have a Figma file, provide it before Module 4 starts. Otherwise, Module 4 will use shadcn/ui defaults. |

### For Module 5 (Subdomain Provisioning)

| # | Prerequisite | Action |
|---|-------------|--------|
| 15 | **Nginx installed** | `sudo apt install nginx` on VPS |
| 16 | **Certbot installed** | `sudo apt install certbot python3-certbot-nginx` |
| 17 | **Base SSL certificate** | Run `sudo certbot --nginx -d yourdomain.dev -d api.yourdomain.dev` to get initial cert |
| 18 | **Test Hostinger API** | Run: `curl -H "Authorization: Bearer YOUR_TOKEN" https://developers.hostinger.com/api/dns/v1/zones/yourdomain.dev` — should return DNS records |
| 19 | **Wildcard DNS note** | Hostinger supports wildcard A records (`*`) but the plan uses **per-subdomain A records** via API for fine-grained control. Do NOT add a wildcard A record manually. |

### For Module 6 (Terminal)

| # | Prerequisite | Action |
|---|-------------|--------|
| 20 | **phpseclib3** or **Docker** | Either: `composer require phpseclib/phpseclib:~3.0` for SSH from PHP, OR install Docker for the ttyd approach |
| 21 | **SSH key for terminal service** | Generate a dedicated SSH keypair for the terminal service (NOT your personal key): `ssh-keygen -t ed25519 -f /var/www/portfolio-api/storage/app/terminal_key -N ""` |

---

## 🟡 ENVIRONMENT VARIABLES TEMPLATE

### Laravel `.env` (Module 1)
```env
APP_NAME=Portfolio
APP_ENV=production
APP_KEY=  # php artisan key:generate
APP_DEBUG=false
APP_URL=https://api.yourdomain.dev

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=portfolio_user
DB_PASSWORD=STRONG_PASSWORD_HERE

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Queue
QUEUE_CONNECTION=redis

# Sanctum
SANCTUM_STATEFUL_DOMAINS=yourdomain.dev
SESSION_DOMAIN=.yourdomain.dev

# Meilisearch
SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY=YOUR_MEILISEARCH_MASTER_KEY

# Hostinger API (Module 5)
HOSTINGER_API_TOKEN=YOUR_HOSTINGER_API_TOKEN
HOSTINGER_DOMAIN=yourdomain.dev
VPS_IP_ADDRESS=YOUR_VPS_IP

# Mail (for contact replies)
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourmailprovider.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@yourdomain.dev
MAIL_FROM_NAME="${APP_NAME}"

# Reverb (WebSocket - Module 6)
REVERB_APP_ID=portfolio
REVERB_APP_KEY=YOUR_REVERB_KEY
REVERB_APP_SECRET=YOUR_REVERB_SECRET
REVERB_HOST=127.0.0.1
REVERB_PORT=8080

# Terminal SSH (Module 6)
TERMINAL_SSH_HOST=127.0.0.1
TERMINAL_SSH_PORT=22
TERMINAL_SSH_USERNAME=terminal_user
TERMINAL_SSH_KEY_PATH=/var/www/portfolio-api/storage/app/terminal_key
TERMINAL_SESSION_TIMEOUT=1800  # 30 minutes

# CORS
CORS_ALLOWED_ORIGINS=https://yourdomain.dev
```

### Next.js `.env.local` (Modules 2 & 3)
```env
# API
NEXT_PUBLIC_API_URL=https://api.yourdomain.dev
NEXT_PUBLIC_SITE_URL=https://yourdomain.dev

# Auth.js v5
AUTH_SECRET=GENERATE_WITH_openssl_rand_base64_32
AUTH_URL=https://yourdomain.dev

# Auth - Laravel Sanctum integration (Credentials provider)
AUTH_LARAVEL_API_URL=https://api.yourdomain.dev

# WebSocket (Module 6)
NEXT_PUBLIC_REVERB_HOST=api.yourdomain.dev
NEXT_PUBLIC_REVERB_PORT=8080
NEXT_PUBLIC_REVERB_KEY=YOUR_REVERB_KEY

# Analytics (optional)
NEXT_PUBLIC_GA_ID=G-XXXXXXXXXX
# OR
NEXT_PUBLIC_PLAUSIBLE_DOMAIN=yourdomain.dev
```

---

## 🟡 HANDOFF ARTIFACTS (Create After Module 1)

Before any AI module starts on Module 2 or 3, Module 1 must produce these artifacts:

| Artifact | Format | Purpose |
|----------|--------|---------|
| **OpenAPI Spec** | `openapi.yaml` | Full API contract for all endpoints — AI modules use this to generate API client code |
| **Postman Collection** | `portfolio-api.postman_collection.json` | For manual testing and as reference |
| **Seed Data** | `database/seeders/DemoSeeder.php` | At least 6 projects, 4 categories, 10 technologies, 3 testimonials, 5 contacts — so frontend modules have real data to work with |
| **TypeScript Types** | `types/api.ts` | Export all response types as TypeScript interfaces — use `laravel-typescript-transformer` or manually define |

**How to generate OpenAPI spec from Laravel:**
```bash
composer require dedoc/scramble
# Scramble auto-generates OpenAPI from your routes + Form Requests
# Access at: https://api.yourdomain.dev/docs/api
```

---

## 🟡 MODULE EXECUTION ORDER — CLARIFIED

```
 ┌─────────────────────────────────────────────────────────────┐
 │  PHASE 0: PREREQUISITES (this document)                      │
 │  Complete items 1–21 above before ANY module starts          │
 │  Estimated: 1 day                                            │
 └──────────────────────────┬──────────────────────────────────┘
                            ▼
 ┌─────────────────────────────────────────────────────────────┐
 │  PHASE 1: MODULE 1 — Laravel API                             │
 │  Must complete FIRST. Produces OpenAPI spec + seed data      │
 │  Output: Working API + Postman collection + TypeScript types  │
 │  Estimated: 3–4 days                                         │
 └──────────────────────────┬──────────────────────────────────┘
                            ▼
 ┌─────────────────────────┬───────────────────────────────────┐
 │  PHASE 2A: MODULE 4     │  PHASE 2B: MODULE 2               │
 │  Design System           │  Dashboard (CRUD pages)           │
 │  (can run parallel)      │  (can run parallel with 4)        │
 │  1–2 days                │  3–4 days                         │
 └─────────────────────────┴───────────────────────────────────┘
                            ▼
 ┌─────────────────────────┬───────────────────────────────────┐
 │  PHASE 3A: MODULE 3     │  PHASE 3B: MODULE 2 (continued)   │
 │  Public Frontend         │  Dashboard (remaining pages)      │
 │  (can run parallel)      │  (can run parallel with 3)        │
 │  4–5 days                │  2–3 days                         │
 └─────────────────────────┴───────────────────────────────────┘
                            ▼
 ┌─────────────────────────┬───────────────────────────────────┐
 │  PHASE 4A: MODULE 5     │  PHASE 4B: MODULE 6               │
 │  Subdomain Provisioning  │  VPS Terminal                     │
 │  (can run parallel)      │  (can run parallel with 5)        │
 │  3–4 days                │  2–3 days                         │
 └─────────────────────────┴───────────────────────────────────┘
                            ▼
 ┌─────────────────────────────────────────────────────────────┐
 │  PHASE 5: MODULE 7 — Demo Projects + SEO Audit + Launch      │
 │  Ongoing                                                     │
 └─────────────────────────────────────────────────────────────┘
```

**Parallel execution rules:**
- Modules 2 & 3 can ONLY start after Module 1 delivers the OpenAPI spec + seed data
- Modules 2 & 4 can run in parallel (design system informs dashboard components)
- Modules 3 & 2 (remaining) can run in parallel
- Modules 5 & 6 can run in parallel but both need VPS access
- Module 7 can only start after Modules 1–5 are deployed to production

---

## 🟡 AI MODULE INSTRUCTIONS

When passing modules to AI agents, include these instructions with each:

### For EVERY module:
```
CONTEXT:
- This is part of a portfolio project. Read portfolio-plan-v2.md for full architecture.
- Tech stack: Laravel 12 (API) + Next.js 16.1 (frontend) + shadcn/ui (dashboard UI)
- Next.js 16 uses proxy.ts (NOT middleware.ts)
- All Next.js dynamic page params/searchParams must be awaited (async)
- Use TypeScript strict mode everywhere
- Follow the .env templates from prerequisites-and-corrections.md

QUALITY REQUIREMENTS:
- Zero TypeScript errors (strict mode)
- All API calls must have error handling (try/catch + user-facing error states)
- All forms must have Zod validation schemas
- All pages must have loading.tsx and error.tsx files
- Mobile-responsive (test 320px, 768px, 1024px, 1440px)
- Dark mode must work on every component
```

### Module-specific context to include:
- **Module 1**: Include the full database schema + API endpoints section from the plan
- **Module 2**: Include the dashboard pages table + OpenAPI spec from Module 1 output
- **Module 3**: Include the public pages section + SEO checklist + performance targets
- **Module 4**: Include the design tokens + component inventory sections
- **Module 5**: Include the subdomain flow + Hostinger API corrections from this document
- **Module 6**: Include the terminal architecture section + security requirements
- **Module 7**: Include the project ideas table + temp credentials system

---

## 🟢 OPTIONAL IMPROVEMENTS (Not Blocking)

These are nice-to-haves that could be added during or after implementation:

1. **Wayfinder** (Laravel package, now in beta) — auto-generates TypeScript types from Laravel routes, models, form requests. Would replace manual TypeScript type definitions and keep types perfectly in sync.

2. **Laravel MCP** — Laravel now supports MCP servers natively. Could expose portfolio API as an MCP server for AI agents to manage your projects.

3. **Hostinger MCP Server** — Install `npm install -g hostinger-api-mcp` on VPS. This allows AI agents (including Claude) to directly manage DNS, VPS, and domains via MCP protocol. Useful for the terminal module.

4. **Plausible Analytics** over Google Analytics — self-hostable, privacy-friendly, lighter script (< 1KB), better Core Web Vitals score. Consider for Module 3.

5. **`dedoc/scramble`** for auto-generating OpenAPI docs — install in Module 1, saves hours vs manual spec writing.

6. **Backup strategy** — Add `spatie/laravel-backup` in Module 1 for automated daily database + files backup to S3 or local storage.

7. **Image optimization pipeline** — Consider adding `spatie/image` or `intervention/image` in Module 1 for server-side thumbnail generation (small, medium, large, og-image sizes) on upload.
