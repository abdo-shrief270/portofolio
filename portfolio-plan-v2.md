# DevPortfolio — Full Working Plan v2

## Project Overview

A high-performance, SEO-optimized personal portfolio platform for a Laravel backend developer. The platform showcases projects with live demos (auto-provisioned subdomains), temporary credentials, and includes a full admin dashboard — all built as a **single Next.js monorepo** consuming a **headless Laravel API**.

---

## Tech Stack Decision

### Backend (Headless API)
| Layer | Technology | Version | Why |
|-------|-----------|---------|-----|
| Framework | **Laravel 12** | 12.x (2025) | Latest stable, LTS |
| PHP | **PHP 8.4** | 8.4.x | JIT, property hooks, asymmetric visibility |
| Auth | **Laravel Sanctum** | latest | SPA token auth for dashboard |
| API | **Laravel API Resources + Spatie Query Builder** | latest | Structured, filterable responses |
| Queue | **Laravel Horizon + Redis** | latest | Subdomain provisioning jobs |
| Realtime | **Laravel Reverb** | latest | WebSocket for terminal + live notifications |
| DNS | **Hostinger API** | v1 | Auto DNS record creation |
| SSL | **Certbot (Let's Encrypt)** | latest | Free auto-renewed SSL |
| Server | **Nginx** | latest | Reverse proxy + auto vhost generation |
| Cache | **Redis 7** | 7.x | Page cache, session, queue |
| Search | **Laravel Scout + Meilisearch** | latest | Fast full-text project search |
| DB | **MySQL 8.4** or **PostgreSQL 16** | latest | Reliable, performant |
| Media | **Spatie Media Library** | latest | Image uploads, conversions |
| Monitoring | **Laravel Pulse** | latest | Server/app health metrics |

### Frontend (Next.js Monorepo — Public Site + Dashboard)
| Layer | Technology | Version | Why |
|-------|-----------|---------|-----|
| Framework | **Next.js 16** | 16.1.x (Dec 2025) | Latest stable — Turbopack, Cache Components, React Compiler, PPR |
| React | **React 19** | 19.x | Server Components, use() hook, Actions |
| Language | **TypeScript 5** | 5.7+ | Strict type safety end-to-end |
| Styling | **Tailwind CSS 4** | 4.x | Lightning CSS engine, zero-config |
| UI Components | **shadcn/ui** | latest | See recommendation below |
| Data Tables | **TanStack Table v8** | 8.x | Headless, server-side sort/filter/paginate |
| Charts | **Recharts** | latest | Composable React charts |
| Forms | **React Hook Form + Zod** | latest | Performant forms + schema validation |
| State | **Zustand** or **TanStack Query v5** | latest | Server state caching + client state |
| Animation | **Framer Motion** | latest | Smooth page transitions, scroll effects |
| Terminal | **xterm.js** | latest | Browser SSH in dashboard |
| Auth Client | **NextAuth.js v5** (Auth.js) | 5.x | Session management, Sanctum integration |
| SEO | **Next.js Metadata API + JSON-LD** | built-in | No extra lib needed in Next.js 16 |
| Icons | **Lucide React** | latest | Lightweight, tree-shakable |
| URL State | **nuqs** | latest | Type-safe search params (for filters/tables) |
| Theme | **next-themes** | latest | Dark/light mode toggle |
| Font | **next/font** (Geist or Inter) | built-in | Zero layout shift, self-hosted |

---

## Dashboard UI Recommendation: shadcn/ui

### Why shadcn/ui wins for your dashboard:

**1. You own the code.** Unlike Material UI or Chakra, shadcn/ui copies components directly into your project. No dependency lock-in, no breaking updates, full control to customize anything.

**2. Built on Radix UI + Tailwind CSS.** Radix provides bulletproof accessibility (keyboard nav, ARIA, focus management) while Tailwind handles styling — the same stack your public site uses, so zero context switching.

**3. The ecosystem is massive in 2025–2026.** The community has built complete admin dashboards, data tables, charts, forms, and every component you'd need. Open-source starters like `shadcn/admin` and `next-shadcn-dashboard-starter` give you a production-ready foundation with sidebar layouts, data tables, chart widgets, auth pages, and theme presets out of the box.

**4. It pairs perfectly with TanStack Table + Recharts + React Hook Form + Zod** — which together give you powerful data grids, analytics charts, and validated forms without any extra UI framework overhead.

**5. Multi-theme support.** Built-in dark/light mode + customizable color presets (via CSS variables). Your dashboard and public site can share the same design tokens.

**6. Performance.** No runtime CSS-in-JS. Components compile to static Tailwind utility classes — zero overhead.

### Recommended shadcn/ui components to install:
```bash
# Layout
npx shadcn@latest add sidebar sheet navigation-menu breadcrumb

# Data Display
npx shadcn@latest add table card badge avatar separator skeleton

# Forms
npx shadcn@latest add form input textarea select checkbox switch label

# Feedback
npx shadcn@latest add alert dialog toast sonner progress

# Overlay
npx shadcn@latest add dropdown-menu command popover tooltip tabs

# Charts (shadcn/ui has built-in Recharts wrappers since 2024)
npx shadcn@latest add chart
```

---

## Architecture Overview

```
┌──────────────────────────────────────────────────────┐
│                      INTERNET                         │
├───────────────┬──────────────────┬───────────────────┤
│ portfolio.dev │ portfolio.dev    │ *.portfolio.dev    │
│ (Public Site) │ /dashboard/*     │ (Project Demos)    │
│ Next.js SSR   │ Next.js CSR+SSR  │ (Auto-provisioned) │
├───────────────┴──────────────────┴───────────────────┤
│                      NGINX                            │
│          (Reverse Proxy + Auto-generated vhosts)      │
├───────────────┬──────────────────┬───────────────────┤
│  Next.js App  │  Laravel API     │  Demo Apps         │
│  (Port 3000)  │  (PHP-FPM)       │  (Per-project)     │
│  PM2 managed  │  api.portfolio.dev│                    │
├───────────────┴──────────────────┴───────────────────┤
│     Redis 7  │  MySQL 8.4 / PG 16  │  Meilisearch     │
└──────────────────────────────────────────────────────┘
```

### Monorepo Structure — Single Next.js App
The public site and dashboard live in the **same Next.js project** using route groups:

```
src/app/
├── (public)/              ← Public portfolio (SSR/ISR, SEO optimized)
│   ├── page.tsx           ← Homepage
│   ├── projects/
│   ├── about/
│   ├── contact/
│   └── layout.tsx         ← Public layout (nav, footer)
│
├── (dashboard)/           ← Admin dashboard (auth-protected)
│   ├── dashboard/
│   │   ├── page.tsx       ← Dashboard home (stats, charts)
│   │   ├── projects/
│   │   ├── categories/
│   │   ├── technologies/
│   │   ├── testimonials/
│   │   ├── contacts/
│   │   ├── settings/
│   │   ├── terminal/
│   │   ├── dns/
│   │   ├── nginx/
│   │   ├── backups/
│   │   └── seo-audit/
│   └── layout.tsx         ← Dashboard layout (sidebar, topbar)
│
├── (auth)/                ← Auth pages
│   ├── login/
│   └── layout.tsx
│
├── api/                   ← Next.js API routes (proxy or BFF)
└── layout.tsx             ← Root layout (providers, fonts, theme)
```

---

## Module Breakdown

The project is split into **7 independent modules**.

---

## MODULE 1: Backend Core (Laravel Headless API)

**Estimated Time: 3–4 days**

### 1.1 Project Setup
```bash
laravel new portfolio-api
cd portfolio-api

# Core packages
composer require laravel/sanctum
composer require laravel/horizon
composer require laravel/reverb
composer require laravel/scout
composer require laravel/pulse
composer require meilisearch/meilisearch-php
composer require spatie/laravel-medialibrary
composer require spatie/laravel-tags
composer require spatie/laravel-sitemap
composer require spatie/laravel-query-builder
composer require spatie/laravel-data
composer require spatie/laravel-permission
composer require spatie/laravel-activitylog
```

### 1.2 Database Schema

#### `projects` table
| Column | Type | Description |
|--------|------|-------------|
| id | ULID | Primary key |
| title | string | Project name |
| slug | string(unique) | URL-friendly name |
| subtitle | string(nullable) | Short tagline |
| description | longText | Full project description (markdown) |
| short_description | text | Card preview text |
| category_id | foreignId | FK → categories |
| status | enum | `live`, `in_progress`, `completed`, `archived` |
| is_featured | boolean | Show on homepage |
| demo_url | string(nullable) | Live demo link |
| subdomain | string(nullable) | Auto-created subdomain |
| subdomain_status | enum | `pending`, `provisioning`, `active`, `failed`, `deprovisioned` |
| github_url | string(nullable) | Source code link |
| thumbnail | string | Main image path |
| gallery | json(nullable) | Array of image paths |
| tech_stack | json | Array of technologies used |
| features | json | Array of feature objects `{title, description, icon}` |
| temp_credentials | json(encrypted) | `{admin: {email, password}, user: {email, password}, expires_at}` |
| seo_title | string(nullable) | Custom SEO title |
| seo_description | text(nullable) | Custom meta description |
| seo_keywords | json(nullable) | Array of keywords |
| og_image | string(nullable) | Open Graph image path |
| sort_order | integer | Display ordering |
| published_at | timestamp(nullable) | When to make visible |
| created_at | timestamp | — |
| updated_at | timestamp | — |

#### `categories` table
| Column | Type |
|--------|------|
| id | ULID |
| name | string |
| slug | string(unique) |
| description | text(nullable) |
| icon | string(nullable) |
| sort_order | integer |

#### `technologies` table
| Column | Type |
|--------|------|
| id | ULID |
| name | string |
| slug | string(unique) |
| icon | string | SVG or icon class |
| color | string(nullable) | Brand color hex |
| category | enum | `frontend`, `backend`, `database`, `devops`, `other` |
| url | string(nullable) | Official website |

#### `project_technology` pivot
| Column | Type |
|--------|------|
| project_id | foreignId |
| technology_id | foreignId |
| is_primary | boolean |

#### `testimonials` table
| Column | Type |
|--------|------|
| id | ULID |
| project_id | foreignId(nullable) |
| client_name | string |
| client_role | string(nullable) |
| client_company | string(nullable) |
| client_avatar | string(nullable) |
| content | text |
| rating | tinyInteger(nullable) |
| is_featured | boolean |

#### `contact_submissions` table
| Column | Type |
|--------|------|
| id | ULID |
| name | string |
| email | string |
| phone | string(nullable) |
| subject | string |
| message | text |
| project_id | foreignId(nullable) |
| status | enum | `new`, `read`, `replied`, `archived` |
| reply_message | text(nullable) |
| replied_at | timestamp(nullable) |
| ip_address | string |
| user_agent | text |

#### `site_settings` table (key-value)
| Column | Type |
|--------|------|
| key | string(unique) |
| value | json |
| group | string | `general`, `seo`, `social`, `smtp`, `analytics` |

#### `page_views` table (analytics)
| Column | Type |
|--------|------|
| id | bigIncrements |
| page | string |
| project_id | foreignId(nullable) |
| ip_hash | string |
| referrer | string(nullable) |
| user_agent | string(nullable) |
| country | string(nullable) |
| created_at | timestamp |

### 1.3 API Endpoints

#### Public API (no auth, cached)
```
GET    /api/v1/projects                     → Paginated list (filterable by category, tech, status)
GET    /api/v1/projects/{slug}              → Single project with full relations
GET    /api/v1/projects/featured            → Featured projects only
GET    /api/v1/categories                   → All categories with project count
GET    /api/v1/technologies                 → All technologies
GET    /api/v1/testimonials                 → All/featured testimonials
POST   /api/v1/contact                      → Submit contact form (rate limited, honeypot)
GET    /api/v1/settings/public              → Public settings (name, bio, avatar, social links)
GET    /api/v1/search?q=                    → Meilisearch powered search
POST   /api/v1/projects/{slug}/track        → Track page view (fire-and-forget)
GET    /api/v1/sitemap-data                 → Data for sitemap generation
GET    /api/v1/projects/{slug}/og-image     → Dynamic OG image (generated via Intervention Image)
```

#### Dashboard API (Sanctum auth required)
```
# Auth
POST   /api/v1/auth/login                  → Login, return token
POST   /api/v1/auth/logout                 → Revoke token
GET    /api/v1/auth/me                     → Current user profile

# Dashboard Stats
GET    /api/v1/dashboard/stats              → Total projects, views, contacts, uptime
GET    /api/v1/dashboard/views-chart        → Daily views (last 30 days)
GET    /api/v1/dashboard/popular-projects   → Top 5 by views
GET    /api/v1/dashboard/recent-contacts    → Last 10 submissions
GET    /api/v1/dashboard/server-health      → CPU, RAM, Disk (via Laravel Pulse)

# CRUD Resources
GET|POST          /api/v1/admin/projects           → List / Create
GET|PUT|DELETE    /api/v1/admin/projects/{id}      → Show / Update / Delete
POST              /api/v1/admin/projects/{id}/duplicate  → Clone as draft
POST              /api/v1/admin/projects/{id}/provision   → Trigger subdomain provisioning
POST              /api/v1/admin/projects/{id}/deprovision → Remove subdomain
POST              /api/v1/admin/projects/{id}/credentials → Generate temp credentials

GET|POST          /api/v1/admin/categories         → List / Create
GET|PUT|DELETE    /api/v1/admin/categories/{id}    → Show / Update / Delete
PUT               /api/v1/admin/categories/reorder → Drag-sort order

GET|POST          /api/v1/admin/technologies       → List / Create
GET|PUT|DELETE    /api/v1/admin/technologies/{id}  → Show / Update / Delete

GET|POST          /api/v1/admin/testimonials       → List / Create
GET|PUT|DELETE    /api/v1/admin/testimonials/{id}  → Show / Update / Delete

GET               /api/v1/admin/contacts            → List (filterable by status)
GET               /api/v1/admin/contacts/{id}       → Show detail
PUT               /api/v1/admin/contacts/{id}/status → Update status
POST              /api/v1/admin/contacts/{id}/reply  → Send reply email

GET|PUT           /api/v1/admin/settings            → Get / Update site settings
GET               /api/v1/admin/activity-log        → Recent actions

# Infrastructure
GET               /api/v1/admin/dns/records         → List Hostinger DNS records
GET               /api/v1/admin/nginx/configs       → List Nginx vhost files
GET               /api/v1/admin/nginx/configs/{name}→ View specific config
POST              /api/v1/admin/cache/clear          → Clear all caches
POST              /api/v1/admin/sitemap/generate     → Regenerate sitemap
POST              /api/v1/admin/backup/create        → Trigger DB backup
GET               /api/v1/admin/backup/list          → List available backups
GET               /api/v1/admin/backup/{name}/download → Download backup

# SEO Audit
GET               /api/v1/admin/seo-audit           → Check all projects for missing meta

# Media Upload
POST              /api/v1/admin/media/upload         → Upload image (returns path + thumbnails)
DELETE            /api/v1/admin/media/{id}           → Delete uploaded media

# Terminal (WebSocket via Reverb)
# WS: /api/v1/admin/terminal/connect → SSH session channel
```

### 1.4 Performance Requirements
- All public API responses cached in Redis (TTL: 1 hour, invalidated on admin write)
- Eager load all relationships (`with()`) — zero N+1 queries
- API response time target: < 50ms (cached), < 200ms (uncached)
- `spatie/laravel-query-builder` for filtering, sorting, includes
- `spatie/laravel-data` for typed DTOs (request/response)
- API rate limiting: 60 req/min public, 120 req/min authenticated
- Gzip compression on all JSON responses
- ETag headers for conditional requests

### 1.5 SEO Backend Tasks
- Auto-generate `sitemap.xml` on project create/update/delete
- `robots.txt` endpoint
- Dynamic OG image generation per project (Intervention Image or Browsershot)
- JSON-LD structured data endpoint per project
- Canonical URL logic in API response

---

## MODULE 2: Next.js Dashboard (shadcn/ui)

**Estimated Time: 5–7 days**

### 2.1 Setup
```bash
# Inside the Next.js monorepo
npx shadcn@latest init

# Install all needed components
npx shadcn@latest add sidebar sheet navigation-menu breadcrumb \
  table card badge avatar separator skeleton \
  form input textarea select checkbox switch label radio-group calendar date-picker \
  alert dialog toast sonner progress \
  dropdown-menu command popover tooltip tabs collapsible \
  chart scroll-area aspect-ratio

# Additional dependencies
npm install @tanstack/react-table @tanstack/react-query nuqs \
  react-hook-form @hookform/resolvers zod \
  recharts xterm @xterm/addon-fit @xterm/addon-web-links \
  next-auth@beta lucide-react next-themes \
  zustand framer-motion
```

### 2.2 Dashboard Layout
```
┌──────────────────────────────────────────────────┐
│  Topbar: Search (Cmd+K) | Theme Toggle | Profile │
├────────┬─────────────────────────────────────────┤
│        │                                         │
│  Side  │   Content Area                          │
│  bar   │                                         │
│        │   Breadcrumbs: Dashboard > Projects     │
│  Logo  │                                         │
│  ─────  │   [Page Content]                       │
│  Nav    │                                         │
│  Items  │                                         │
│        │                                         │
│  ─────  │                                         │
│  Infra  │                                         │
│  Items  │                                         │
│        │                                         │
│  ─────  │                                         │
│  User  │                                         │
│  Menu  │                                         │
└────────┴─────────────────────────────────────────┘
```

### 2.3 Dashboard Pages

| Page | Route | Components Used |
|------|-------|----------------|
| **Overview** | `/dashboard` | StatsCards (4), ViewsChart (Recharts area), PopularProjects (table), RecentContacts (table), ServerHealth (progress bars), QuickActions (button group) |
| **Projects List** | `/dashboard/projects` | DataTable (TanStack) with search, category filter, status filter, tech filter, bulk actions, row actions (edit, duplicate, preview, provision) |
| **Project Create/Edit** | `/dashboard/projects/new` & `/dashboard/projects/[id]/edit` | Multi-tab form: General (title, slug, description markdown editor, category, status) → Media (thumbnail upload, gallery drag-sort) → Tech & Features (multi-select tech, repeater for features) → Credentials (generate/edit temp logins) → SEO (title, description, keywords, OG image) → Subdomain (provision/deprovision controls, status indicator) |
| **Categories** | `/dashboard/categories` | DataTable with inline edit, drag-sort reorder, icon picker |
| **Technologies** | `/dashboard/technologies` | DataTable + Create/Edit dialog, icon upload, color picker, category select |
| **Testimonials** | `/dashboard/testimonials` | DataTable + Create/Edit form, avatar upload, project link, featured toggle |
| **Contact Inbox** | `/dashboard/contacts` | DataTable with status tabs (New / Read / Replied / Archived), detail slide-over panel, reply action (opens email compose), bulk archive |
| **Site Settings** | `/dashboard/settings` | Tabbed form: General (name, bio, avatar, resume upload) → SEO Defaults (meta title template, description, keywords) → Social Links (GitHub, LinkedIn, Twitter, etc.) → Analytics (GA4 ID, Plausible domain) |
| **SEO Audit** | `/dashboard/seo-audit` | Table showing all projects with ✅/❌ for: title, description, keywords, OG image, alt texts — with "Fix" link to edit |
| **Server Terminal** | `/dashboard/terminal` | Full-screen xterm.js embed (Module 6) |
| **DNS Manager** | `/dashboard/dns` | Read-only table of Hostinger DNS A records, with status indicators |
| **Nginx Manager** | `/dashboard/nginx` | List of generated vhost configs, click to view (code block), test/reload buttons |
| **Backup Manager** | `/dashboard/backups` | Create backup button, list of backups with download + delete, auto-backup schedule toggle |
| **Activity Log** | `/dashboard/activity` | Timeline of all admin actions with filters |

### 2.4 Key Dashboard Components (Custom)

| Component | Description |
|-----------|-------------|
| `StatsCard` | Icon + label + number + trend percentage (up/down arrow) |
| `DataTable` | Wrapper around TanStack Table with: column visibility toggle, global search, per-column filter, pagination controls, row selection, bulk actions bar, loading skeleton, empty state |
| `MediaUploader` | Drag-and-drop zone, preview thumbnails, crop modal, gallery reorder |
| `MarkdownEditor` | Textarea with preview toggle (use `react-markdown` for preview) |
| `FeatureRepeater` | Add/remove/reorder feature items (icon picker + title + description) |
| `CredentialGenerator` | Auto-generate email/password, copy button, expiry date picker |
| `SubdomainStatus` | Badge showing provisioning state + action button (provision/deprovision) |
| `CommandPalette` | shadcn `Command` component — Cmd+K to search pages, projects, actions |
| `ServerHealthWidget` | CPU, RAM, Disk bars from Laravel Pulse data |

### 2.5 Quick Actions
- **New Project** → opens create form
- **Clear Cache** → calls `/api/v1/admin/cache/clear`
- **Generate Sitemap** → calls `/api/v1/admin/sitemap/generate`
- **Backup DB** → calls `/api/v1/admin/backup/create`
- **Export Projects CSV** → client-side download

---

## MODULE 3: Public Portfolio Frontend

**Estimated Time: 4–6 days**

### 3.1 Pages & Routes

| Route | Page | Rendering | Cache |
|-------|------|-----------|-------|
| `/` | Homepage | ISR | revalidate: 60 |
| `/projects` | All Projects (filterable grid) | ISR | revalidate: 60 |
| `/projects/[slug]` | Single Project Detail | ISR | revalidate: 60 |
| `/about` | About Me | ISR | revalidate: 3600 |
| `/contact` | Contact Form | SSR | no cache (form) |
| `/sitemap.xml` | Auto-generated | SSG at build | — |
| `/robots.txt` | Generated | SSG | — |

### 3.2 Homepage Sections
1. **Hero** — Name, role, tagline, animated text (typewriter or morphing), CTA buttons ("View My Work" / "Get in Touch"), subtle background pattern or gradient animation
2. **Featured Projects** — 3–4 cards in a grid, hover: scale + overlay with tech badges, click → project detail
3. **Tech Stack** — Animated icon grid grouped by category (Frontend / Backend / Database / DevOps), hover: tooltip with name + experience level
4. **About Preview** — Photo + 2–3 sentence bio + "Read More" link, optional stats: years experience, projects completed, technologies
5. **Testimonials** — Auto-scrolling carousel with fade transitions, client avatar + quote + name + company
6. **Contact CTA** — Simple CTA section with "Let's Work Together" heading + button
7. **Footer** — Social icon links, quick navigation, "Built with ❤️ and Next.js + Laravel"

### 3.3 Projects Page
- **Filter Bar:** Category pills (horizontal scroll on mobile) + Tech dropdown + Status filter + Search input
- **Grid:** Responsive — 3 columns desktop, 2 tablet, 1 mobile
- **Card:** Thumbnail with aspect-ratio, title, subtitle, category badge, tech badges (max 3 + "+N"), status dot
- **Animation:** Staggered fade-in on scroll using Framer Motion
- **URL State:** Filters persist in URL via `nuqs` (shareable filtered views, good for SEO)

### 3.4 Project Detail Page
```
┌─────────────────────────────────────────────┐
│  Breadcrumbs: Home > Projects > [Name]      │
├─────────────────────────────────────────────┤
│  Hero Image/Video (full-width, 16:9 ratio)  │
├─────────────────────────────────────────────┤
│  Title + Subtitle + Status Badge            │
│  Category + Published Date                  │
├──────────────────────┬──────────────────────┤
│                      │  Sticky Sidebar:     │
│  Description         │  ┌────────────────┐  │
│  (rendered markdown) │  │ Tech Stack     │  │
│                      │  │  • Laravel 12   │  │
│  ─────────────────── │  │  • React 19     │  │
│                      │  │  • MySQL 8      │  │
│  Features Grid       │  ├────────────────┤  │
│  ┌──────┬──────┐    │  │ 🔗 Live Demo   │  │
│  │ 📦   │ 🔒   │    │  │ 📂 GitHub      │  │
│  │Feat1 │Feat2 │    │  ├────────────────┤  │
│  ├──────┼──────┤    │  │ 🔑 Demo Login  │  │
│  │ 📊   │ 🌐   │    │  │ [Click to      │  │
│  │Feat3 │Feat4 │    │  │  reveal]       │  │
│  └──────┴──────┘    │  │ Admin: ***      │  │
│                      │  │ User:  ***      │  │
│  ─────────────────── │  │ [Copy] [Copy]  │  │
│                      │  ├────────────────┤  │
│  Image Gallery       │  │ Status: Live ● │  │
│  (lightbox on click) │  │ Category: SaaS │  │
│                      │  └────────────────┘  │
├──────────────────────┴──────────────────────┤
│  Related Projects (same category, max 3)    │
├─────────────────────────────────────────────┤
│  CTA: "Interested in a similar project?     │
│         Let's discuss → Contact Me"         │
└─────────────────────────────────────────────┘
```

### 3.5 SEO Implementation Checklist
- [ ] Next.js 16 Metadata API in each `page.tsx` (`generateMetadata()`)
- [ ] Dynamic `<title>` per page: "Project Name | Your Name — Laravel Developer"
- [ ] `<meta name="description">` unique per page (150–160 chars)
- [ ] Open Graph tags: title, description, image (dynamic OG from API), url, type
- [ ] Twitter Card: `summary_large_image`
- [ ] JSON-LD structured data:
  - Homepage: `Person` + `WebSite`
  - Project: `SoftwareApplication` or `CreativeWork`
  - About: `Person` with `sameAs` social links
- [ ] Canonical URLs via `alternates.canonical` in metadata
- [ ] `sitemap.xml` generated at build via `generateSitemaps()` in Next.js 16
- [ ] `robots.txt` via `robots.ts` metadata file
- [ ] Semantic HTML (`<article>`, `<nav>`, `<main>`, `<section>`, `<header>`, `<footer>`, `<figure>`)
- [ ] Image `alt` text from API data
- [ ] Lazy loading images with `next/image` (blur placeholder from Spatie thumbnails)
- [ ] `<link rel="preconnect">` to API domain
- [ ] Heading hierarchy: exactly one `<h1>` per page, proper H2/H3 nesting

### 3.6 Performance Targets
| Metric | Target |
|--------|--------|
| Lighthouse Performance | ≥ 95 |
| LCP (Largest Contentful Paint) | < 1.5s |
| INP (Interaction to Next Paint) | < 100ms |
| CLS (Cumulative Layout Shift) | < 0.05 |
| Total JS bundle (gzipped) | < 120kb first load |
| TTFB (Time to First Byte) | < 200ms |
| Turbopack dev cold start | < 3s |

### 3.7 Performance Techniques
- **ISR** with 60s revalidation → static speed, fresh data
- **Cache Components** (Next.js 16 `"use cache"`) → cache expensive API calls at component level
- **PPR (Partial Prerendering)** → static shell + streaming dynamic content
- **`next/image`** with WebP/AVIF auto-format, responsive `sizes`
- **`next/font`** (Geist Sans) → self-hosted, zero CLS
- **Dynamic imports** (`next/dynamic`) for below-fold components (gallery, testimonials carousel)
- **Prefetch links** on hover (default in Next.js 16, now optimized with dedup)
- **Redis-cached API** on backend → API responses < 50ms
- **CDN** for static assets (Cloudflare or Vercel)
- **React Compiler** (stable in Next.js 16) → automatic memoization, no manual `useMemo`/`useCallback`

---

## MODULE 4: UI/UX Design System

**Estimated Time: 2–3 days**

> **ACTION REQUIRED:** Before starting this module:
> 1. Ask client for Figma file (if they have one)
> 2. If no Figma, choose a reference template or build from the design tokens below

### 4.1 Design Tokens (Tailwind CSS v4 + shadcn/ui)

```css
/* src/app/globals.css — extends shadcn/ui theme variables */
@theme {
  --font-heading: 'Geist Sans', sans-serif;
  --font-body: 'Geist Sans', sans-serif;
  --font-mono: 'Geist Mono', monospace;

  /* Primary brand — customize these */
  --color-primary-50: #eff6ff;
  --color-primary-500: #3b82f6;
  --color-primary-900: #1e3a5f;

  /* Surface colors */
  --color-surface-light: #fafafa;
  --color-surface-dark: #0a0a0a;
}

/* shadcn/ui CSS variables for theming — adjust hue values */
@layer base {
  :root {
    --background: 0 0% 100%;
    --foreground: 240 10% 3.9%;
    --primary: 221.2 83.2% 53.3%;
    --primary-foreground: 210 40% 98%;
    /* ... rest of shadcn theme variables */
  }
  .dark {
    --background: 240 10% 3.9%;
    --foreground: 0 0% 98%;
    --primary: 217.2 91.2% 59.8%;
    /* ... dark mode overrides */
  }
}
```

### 4.2 Component Inventory (To Build)

#### Public Site Components
| Component | Purpose |
|-----------|---------|
| `ProjectCard` | Thumbnail, title, tech badges, status dot, hover scale effect |
| `TechBadge` | Colored pill: icon + name, grouped by category |
| `FeatureCard` | Icon (Lucide) + title + description in a bordered card |
| `TestimonialCard` | Avatar + quote (italic) + name + company + star rating |
| `StatusBadge` | Colored dot + label: Live (green), In Progress (amber), Completed (blue) |
| `CredentialReveal` | Click-to-reveal masked credentials + individual Copy buttons |
| `ContactForm` | Name, email, subject, message + honeypot field, loading state, success toast |
| `ImageGallery` | Grid thumbnails → lightbox on click (use `yet-another-react-lightbox`) |
| `SectionHeading` | H2 + optional subtitle + decorative line/accent |
| `AnimatedCounter` | Number counting up animation for stats (Framer Motion) |
| `TypewriterText` | Rotating text animation for hero tagline |
| `ScrollReveal` | Wrapper component for staggered fade-in-up on scroll |

#### Dashboard Components (beyond shadcn/ui)
| Component | Purpose |
|-----------|---------|
| `DataTable` | Wraps TanStack Table with shadcn Table, includes search/filter/pagination |
| `MediaUploader` | Dropzone with preview thumbnails, crop, drag-sort for gallery |
| `MarkdownEditor` | Textarea + live preview pane (toggle) |
| `FeatureRepeater` | Dynamic add/remove/reorder form fields |
| `CommandPalette` | Cmd+K global search across pages, projects, actions |
| `ServerHealth` | CPU/RAM/Disk progress bars with color thresholds |
| `SubdomainStatus` | Provisioning status badge + action button |
| `TerminalEmbed` | xterm.js container with fit addon |

---

## MODULE 5: Auto Subdomain Provisioning System

**Estimated Time: 3–4 days**

### 5.1 Flow
```
Admin clicks "Provision Subdomain" in dashboard
        │
        ▼
Next.js calls POST /api/v1/admin/projects/{id}/provision
        │
        ▼
Laravel dispatches ProvisionSubdomainJob (queued via Horizon)
        │
        ├── Step 1: Validate slug (alphanumeric + hyphens only)
        │
        ├── Step 2: Create DNS A Record (Hostinger API)
        │     POST https://api.hostinger.com/v1/dns/{domain}/records
        │     { type: "A", name: "{slug}", target: "{vps_ip}", ttl: 3600 }
        │
        ├── Step 3: Wait for DNS propagation (poll every 30s, max 5 min)
        │     dns_get_record("{slug}.portfolio.dev", DNS_A)
        │
        ├── Step 4: Generate Nginx Config from Blade template
        │     Write to /etc/nginx/sites-available/{slug}.conf
        │     Symlink to /etc/nginx/sites-enabled/
        │     Run: nginx -t && nginx -s reload
        │
        ├── Step 5: Provision SSL via Certbot
        │     certbot certonly --nginx -d {slug}.portfolio.dev --non-interactive --agree-tos
        │     Update Nginx config with SSL paths
        │     Run: nginx -s reload
        │
        ├── Step 6: Update Project Record
        │     subdomain = "{slug}.portfolio.dev"
        │     demo_url = "https://{slug}.portfolio.dev"
        │     subdomain_status = "active"
        │
        └── Step 7: Notify Admin
              → Broadcast via Reverb → Dashboard shows toast notification
              → Optional: email notification
```

### 5.2 Key Files

| File | Purpose |
|------|---------|
| `app/Jobs/ProvisionSubdomainJob.php` | Queued job, retries 3x with exponential backoff, each step is idempotent |
| `app/Jobs/DeprovisionSubdomainJob.php` | Reverse process: delete DNS → delete Nginx → revoke SSL |
| `app/Services/HostingerDnsService.php` | Wraps Hostinger API: `createARecord()`, `deleteRecord()`, `listRecords()`, `waitForPropagation()` |
| `app/Services/NginxConfigService.php` | `generateConfig()`, `enableSite()`, `disableSite()`, `testConfig()`, `reload()` |
| `app/Services/SslService.php` | `provision()`, `renew()`, `revoke()`, `checkExpiry()` |
| `resources/nginx/project-vhost.conf.blade.php` | Nginx vhost template |

### 5.3 Nginx Template
```nginx
server {
    listen 80;
    server_name {{ $subdomain }};
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name {{ $subdomain }};

    ssl_certificate /etc/letsencrypt/live/{{ $subdomain }}/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/{{ $subdomain }}/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;

    root {{ $project_root }}/public;
    index index.php index.html;

    # Performance
    gzip on;
    gzip_types text/css application/javascript application/json image/svg+xml;
    gzip_min_length 256;

    # Cache static assets
    location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header Permissions-Policy "camera=(), microphone=(), geolocation=()" always;
}
```

### 5.4 Deprovisioning (project delete/archive)
- Remove DNS A record via Hostinger API
- Delete Nginx config + symlink
- Revoke SSL certificate via Certbot
- `nginx -s reload`
- Update project: `subdomain_status = "deprovisioned"`

### 5.5 Security
- Slug validation: `/^[a-z0-9][a-z0-9-]*[a-z0-9]$/` (2–63 chars)
- All shell commands use `Process::run()` with escaped arguments (never raw input)
- Certbot runs as non-root with sudo for specific commands only
- Hostinger API key in `.env`, encrypted at rest
- Rate limit provisioning: max 5 per hour

---

## MODULE 6: VPS Terminal (Browser SSH)

**Estimated Time: 2–3 days**

### 6.1 Architecture
```
Browser (xterm.js)  ←WebSocket→  Laravel Reverb  ←SSH2→  VPS Shell
      ↑                              ↑
  Dashboard page              Auth guard (admin only)
```

### 6.2 Implementation

#### Frontend: `src/app/(dashboard)/dashboard/terminal/page.tsx`
```
- Full-height xterm.js terminal (dark theme)
- Fit addon (auto-resize to container)
- Web links addon (clickable URLs)
- Connect via WebSocket to Laravel Reverb channel
- Reconnect on disconnect with backoff
- "Session active" / "Disconnected" status indicator
```

#### Backend: `app/Services/TerminalService.php`
```
- Opens SSH connection to localhost via phpseclib3
- Authenticated Reverb private channel: `private-terminal.{userId}`
- Streams stdout/stderr → broadcasts to WebSocket
- Receives keystrokes from WebSocket → writes to SSH stdin
- Session timeout: 30 min idle auto-disconnect
- Audit log: session start/end + commands executed
```

#### Security
- **Auth:** Only admin users (checked via Sanctum + gate)
- **Session limit:** One terminal session per user
- **Idle timeout:** 30 minutes → auto-disconnect
- **Audit:** Every session logged with start/end time
- **SSH key auth:** Private key stored server-side, no password in code
- **Optional:** Command whitelist/blacklist regex filter

### 6.3 Simpler Alternative (Phase 1)
If WebSocket SSH is too complex for initial launch, use **ttyd** in a Docker container:
```bash
docker run -d --name terminal -p 127.0.0.1:7681:7681 \
  tsl0922/ttyd -W -t fontSize=14 -t theme={"background":"#1a1a2e"} bash
```
Then proxy through an authenticated Next.js API route to iframe it in the dashboard. This gets you 80% of the value with 20% of the effort.

---

## MODULE 7: Common Project Ideas (Pre-built Demos)

**Estimated Time: Ongoing**

These are the most commonly requested website types. Each demo should have screenshots, a feature list, tech stack badges, and working temp credentials.

### 7.1 Project Ideas — Ranked by Client Demand

| # | Project Type | Key Features to Showcase | Priority |
|---|-------------|--------------------------|----------|
| 1 | **E-Commerce Store** | Product catalog, cart, checkout, Stripe payments, order management, inventory, wishlist | 🔴 P1 |
| 2 | **CRM (Customer Relationship)** | Contacts, deals pipeline (Kanban), tasks, email integration, activity timeline, reports | 🔴 P1 |
| 3 | **Clinic / Doctor Booking** | Appointment scheduling, doctor profiles, patient portal, calendar, SMS reminders | 🔴 P1 |
| 4 | **Blog / News CMS** | WYSIWYG editor, categories, tags, comments, author profiles, newsletter, RSS | 🔴 P1 |
| 5 | **Restaurant / Food Ordering** | Menu builder, online ordering, table reservation, delivery zone, order tracking | 🟡 P2 |
| 6 | **Real Estate Listing** | Property search + filters (price, beds, location), map integration, agent profiles | 🟡 P2 |
| 7 | **SaaS Dashboard** | Multi-tenant, subscription billing (Cashier + Stripe), usage analytics, team management | 🟡 P2 |
| 8 | **HR / Employee Portal** | Employee directory, leave requests, payroll summary, attendance, announcements | 🟡 P2 |
| 9 | **School / LMS** | Course management, student dashboard, assignments, grades, attendance, video lessons | 🟢 P3 |
| 10 | **Hotel / Booking System** | Room availability calendar, reservations, guest management, payment, check-in/out | 🟢 P3 |
| 11 | **Inventory / Warehouse** | Stock tracking, barcode, purchase orders, suppliers, low-stock alerts, reports | 🟢 P3 |
| 12 | **Multi-Vendor Marketplace** | Vendor registration, product listings, commission management, vendor dashboard | 🟢 P3 |
| 13 | **Invoice / Billing** | Client management, invoice PDF generation, payment tracking, recurring invoices, tax | 🟢 P3 |
| 14 | **Gym / Fitness Club** | Membership plans, class schedule, trainer profiles, attendance, payment | 🟢 P3 |
| 15 | **Portfolio for Creatives** | Image gallery, project showcase, contact form — sell this to designers/photographers | 🟢 P3 |

### 7.2 Implementation Strategy
- **Phase 1 (Week 5–6):** Build #1, #2, #3, #4 — highest demand, prove range
- **Phase 2 (Week 7–8):** Build #5, #6, #7, #8 — expand categories
- **Phase 3 (Ongoing):** Build remaining based on actual client interest
- Each project: use a template or build minimal MVP + expand when client requests

### 7.3 Temp Credentials System
```json
{
  "admin": {
    "email": "admin@demo.portfolio.dev",
    "password": "demo-admin-2025",
    "role": "Super Admin"
  },
  "user": {
    "email": "user@demo.portfolio.dev",
    "password": "demo-user-2025",
    "role": "Regular User"
  },
  "expires_at": "2026-12-31T00:00:00Z"
}
```

**Automation:**
- Credentials auto-rotate monthly (Laravel scheduled command)
- Demo databases reset weekly via seeder (scheduled `php artisan db:seed --class=DemoResetSeeder`)
- Read-only mode toggle per project (middleware that blocks destructive HTTP methods for demo users)
- Credential display: masked by default, click to reveal, individual copy buttons

---

## Deployment Plan

### Server Requirements (VPS)
| Resource | Minimum | Recommended |
|----------|---------|-------------|
| CPU | 2 vCPU | 4 vCPU |
| RAM | 4 GB | 8 GB |
| Storage | 80 GB SSD | 160 GB NVMe |
| OS | Ubuntu 24.04 LTS | Ubuntu 24.04 LTS |

### Services Stack
```bash
# System
nginx, php8.4-fpm, mysql-server (8.4), redis-server (7.x), supervisor, certbot

# Node.js
nvm → Node 22 LTS, PM2 (process manager for Next.js)

# PHP
composer, php-extensions: mbstring, xml, curl, mysql, redis, zip, gd, ssh2, intl, bcmath

# Search Engine
meilisearch (latest)

# Monitoring
Laravel Pulse (app health), Laravel Horizon (queue monitoring)
PM2 (Next.js process health)

# Optional
Docker (for ttyd terminal alternative)
```

### Nginx Main Config (portfolio.dev)
```nginx
# Next.js (public site + dashboard)
server {
    listen 443 ssl http2;
    server_name portfolio.dev;

    ssl_certificate /etc/letsencrypt/live/portfolio.dev/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/portfolio.dev/privkey.pem;

    location / {
        proxy_pass http://127.0.0.1:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}

# Laravel API
server {
    listen 443 ssl http2;
    server_name api.portfolio.dev;

    ssl_certificate /etc/letsencrypt/live/api.portfolio.dev/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/api.portfolio.dev/privkey.pem;

    root /var/www/portfolio-api/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### CI/CD (GitHub Actions)
```yaml
# .github/workflows/deploy.yml
# On push to main:
# 1. Run tests (PHPUnit + Jest/Vitest)
# 2. Build Next.js
# 3. SSH to VPS:
#    - git pull
#    - composer install --no-dev
#    - php artisan migrate --force
#    - php artisan cache:clear
#    - npm ci && npm run build
#    - pm2 restart portfolio-frontend
#    - sudo supervisorctl restart horizon
```

---

## Implementation Timeline

```
Week 1:  MODULE 1 (Laravel API + DB)
         → Foundation. All other modules depend on the API contract.
         → Deliverable: Working API with all endpoints, seeded data, Postman collection.

Week 2:  MODULE 4 (Design System) + MODULE 2 (Dashboard — structure + CRUD)
         → Design tokens + component library first.
         → Dashboard: layout, auth, projects CRUD, categories, technologies.
         → Deliverable: Working dashboard with core CRUD operations.

Week 3:  MODULE 2 (Dashboard — remaining pages) + MODULE 3 (Public Frontend)
         → Dashboard: contacts, settings, SEO audit, activity log, widgets.
         → Public: homepage, projects list, project detail, about, contact.
         → Deliverable: Full dashboard + full public site connected to API.

Week 4:  MODULE 5 (Subdomain System) + MODULE 6 (Terminal)
         → Auto-provisioning pipeline.
         → Browser terminal in dashboard.
         → Deliverable: Can provision subdomain from dashboard, terminal works.

Week 5:  MODULE 7 (First 2–3 demo projects) + SEO Audit + Performance Tuning
         → Build initial project demos.
         → Run Lighthouse, fix issues, optimize Core Web Vitals.
         → Submit sitemap to Google Search Console.
         → Deliverable: Live portfolio with demo projects, all SEO green.

Week 6+: MODULE 7 (Remaining demo projects) + Polish + Launch
         → Continue building project demos.
         → Monitor analytics, iterate on design.
```

---

## File Structure (Final)

```
portfolio/
├── api/                              # Laravel 12 Backend
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/Api/V1/   # API controllers
│   │   │   ├── Middleware/            # CORS, RateLimit, DemoReadOnly
│   │   │   └── Requests/             # Form requests with validation
│   │   ├── Jobs/                      # ProvisionSubdomainJob, etc.
│   │   ├── Models/                    # Eloquent models
│   │   ├── Services/                  # HostingerDns, NginxConfig, Ssl, Terminal
│   │   ├── Data/                      # Spatie Data DTOs
│   │   └── Policies/                  # Authorization policies
│   ├── config/
│   ├── database/
│   │   ├── migrations/
│   │   ├── seeders/
│   │   │   └── DemoResetSeeder.php
│   │   └── factories/
│   ├── resources/
│   │   └── nginx/                     # Vhost Blade templates
│   ├── routes/
│   │   ├── api.php                    # All API routes
│   │   └── channels.php              # WebSocket channels
│   ├── tests/
│   └── .env
│
├── frontend/                          # Next.js 16 Monorepo
│   ├── src/
│   │   ├── app/
│   │   │   ├── (public)/             # Public portfolio pages
│   │   │   │   ├── page.tsx          # Homepage
│   │   │   │   ├── projects/
│   │   │   │   ├── about/
│   │   │   │   ├── contact/
│   │   │   │   └── layout.tsx        # Public layout
│   │   │   ├── (dashboard)/          # Admin dashboard
│   │   │   │   ├── dashboard/
│   │   │   │   │   ├── page.tsx      # Overview
│   │   │   │   │   ├── projects/
│   │   │   │   │   ├── categories/
│   │   │   │   │   ├── technologies/
│   │   │   │   │   ├── testimonials/
│   │   │   │   │   ├── contacts/
│   │   │   │   │   ├── settings/
│   │   │   │   │   ├── terminal/
│   │   │   │   │   ├── dns/
│   │   │   │   │   ├── nginx/
│   │   │   │   │   ├── backups/
│   │   │   │   │   ├── seo-audit/
│   │   │   │   │   └── activity/
│   │   │   │   └── layout.tsx        # Dashboard layout (sidebar)
│   │   │   ├── (auth)/
│   │   │   │   └── login/
│   │   │   ├── api/                   # Next.js API routes (auth, proxy)
│   │   │   ├── sitemap.ts            # Dynamic sitemap
│   │   │   ├── robots.ts
│   │   │   └── layout.tsx            # Root layout
│   │   ├── components/
│   │   │   ├── ui/                    # shadcn/ui components
│   │   │   ├── public/               # Public site components
│   │   │   ├── dashboard/            # Dashboard components
│   │   │   └── shared/               # Shared components
│   │   ├── lib/
│   │   │   ├── api.ts                # API client (fetch wrapper)
│   │   │   ├── auth.ts               # NextAuth config
│   │   │   ├── utils.ts              # shadcn cn() + helpers
│   │   │   └── validations.ts        # Zod schemas
│   │   ├── hooks/                     # Custom React hooks
│   │   ├── stores/                    # Zustand stores
│   │   └── types/                     # TypeScript types/interfaces
│   ├── public/                        # Static assets (favicon, etc.)
│   ├── next.config.ts
│   ├── tailwind.config.ts
│   ├── tsconfig.json
│   └── package.json
│
├── .github/
│   └── workflows/
│       └── deploy.yml                 # CI/CD pipeline
├── docker-compose.yml                 # Local dev (MySQL, Redis, Meilisearch)
└── README.md
```

---

## SEO Master Checklist

### Technical SEO
- [ ] SSR/ISR via Next.js 16 (pre-rendered HTML for all public pages)
- [ ] `<title>` unique per page (50–60 chars)
- [ ] `<meta name="description">` unique per page (150–160 chars)
- [ ] Clean URL structure (`/projects/ecommerce-store`)
- [ ] XML Sitemap via `generateSitemaps()` → submitted to Google Search Console
- [ ] `robots.txt` via `robots.ts`
- [ ] Canonical URLs via `alternates.canonical`
- [ ] 301 redirects for any slug changes
- [ ] JSON-LD: `Person`, `WebSite`, `SoftwareApplication`
- [ ] Open Graph + Twitter Card tags on every page
- [ ] Core Web Vitals all green (LCP < 1.5s, INP < 100ms, CLS < 0.05)
- [ ] Mobile responsive (320px → 1440px+)
- [ ] HTTPS everywhere (HSTS header)
- [ ] Fast TTFB < 200ms
- [ ] No broken links (validate with Screaming Frog or `next-sitemap`)

### Content SEO
- [ ] One `<h1>` per page, proper heading hierarchy
- [ ] Semantic HTML elements
- [ ] Alt text on all images
- [ ] Internal linking between related projects
- [ ] Blog section for organic traffic (optional but recommended)
- [ ] Breadcrumb schema markup

### Monitoring
- [ ] Google Search Console connected
- [ ] Google Analytics 4 or Plausible Analytics
- [ ] Lighthouse CI in GitHub Actions
- [ ] Uptime monitoring (BetterUptime or UptimeRobot)

---

## Notes for Developers

1. **Start with Module 1** — the API contract is the foundation. Export a Postman collection or OpenAPI spec before starting frontend work.
2. **Module 2 and 3 can run in parallel** once API endpoints are defined — one dev on dashboard, another on public site.
3. **Module 5 requires VPS access** — test locally with mock services first, then deploy to staging VPS.
4. **Module 6 (Terminal)** — start with the ttyd Docker approach for v1, upgrade to full WebSocket SSH later.
5. **Module 7 is ongoing** — start with 2–3 high-priority demos, add more based on client feedback.
6. **Figma file:** If the client provides a Figma file, Module 4 becomes a pixel-perfect implementation task. If not, use the design tokens + shadcn/ui defaults for a clean, professional look.

---

*This plan is split-ready. Each module has clear inputs, outputs, and interfaces. The API contract (Module 1) must be finalized first. Modules 2–4 can run in parallel. Modules 5–6 are infrastructure-dependent. Module 7 is continuous.*
