# Portfolio - Abdelrahman Shrief

A modern, dynamic portfolio website built with Laravel 12, Filament 3.3, Livewire 3, and Tailwind CSS.

## Tech Stack

- **Backend:** Laravel 12 + PHP 8.2+
- **Admin Panel:** Filament 3.3
- **Frontend:** Livewire 3 + Blade + Tailwind CSS
- **Database:** MySQL / PostgreSQL
- **Media:** Spatie Media Library
- **Translations:** Spatie Laravel Translatable (EN/AR with RTL support)

## Features

- Dynamic content management via Filament admin panel
- Project portfolio with filtering and categories
- Blog with syntax-highlighted code blocks
- Services showcase
- Skills & expertise display
- Testimonials management
- Quote/Contact form with Livewire
- Responsive design with dark mode
- Multi-language support (English & Arabic)
- SEO optimized

## Installation

1. Clone the repository:
```bash
git clone https://github.com/abdo-shrief270/portofolio.git
cd portofolio/backend
```

2. Install dependencies:
```bash
composer install
npm install && npm run build
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database and run migrations:
```bash
php artisan migrate --seed
```

5. Create admin user:
```bash
php artisan make:filament-user
```

6. Start the development server:
```bash
php artisan serve
```

## Project Structure

```
backend/
├── app/
│   ├── Filament/Resources/    # Admin panel resources
│   ├── Helpers/               # Settings helper
│   ├── Livewire/              # Livewire components
│   ├── Models/                # Eloquent models
│   └── Providers/             # Service providers
├── resources/views/
│   ├── components/            # Blade components
│   ├── layouts/               # Layout templates
│   ├── livewire/              # Livewire views
│   └── pages/                 # Page templates
└── database/
    ├── migrations/            # Database migrations
    └── seeders/               # Data seeders
```

## Admin Panel

Access the admin panel at `/admin` to manage:
- Projects & Tech Stacks
- Blog Posts & Categories
- Services & Skills
- Testimonials
- Quote Requests
- Site Settings

## License

MIT License

## Author

**Abdelrahman Shrief** - Senior Backend Developer

- GitHub: [@abdo-shrief270](https://github.com/abdo-shrief270)
- LinkedIn: [abdo-shrief](https://linkedin.com/in/abdo-shrief)
