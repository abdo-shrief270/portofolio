<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'building-scalable-apis-with-laravel',
                'title' => [
                    'en' => 'Building Scalable APIs with Laravel: A Complete Guide',
                    'ar' => 'بناء واجهات برمجة قابلة للتطوير مع Laravel: دليل شامل',
                ],
                'excerpt' => [
                    'en' => 'Learn how to design and implement robust, scalable RESTful APIs using Laravel. This guide covers authentication, rate limiting, caching, and best practices.',
                    'ar' => 'تعلم كيفية تصميم وتنفيذ واجهات برمجة RESTful قوية وقابلة للتطوير باستخدام Laravel. يغطي هذا الدليل المصادقة وتحديد المعدل والتخزين المؤقت وأفضل الممارسات.',
                ],
                'content' => [
                    'en' => '<h2>Introduction</h2>
<p>APIs are the backbone of modern web applications. In this comprehensive guide, we\'ll explore how to build scalable, maintainable APIs using Laravel.</p>

<h2>Setting Up Your API</h2>
<p>First, let\'s set up the foundation for our API. Laravel provides excellent tools out of the box for API development.</p>

<pre><code class="language-bash">php artisan install:api</code></pre>

<h2>Authentication with Sanctum</h2>
<p>Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs. Here\'s how to implement it:</p>

<pre><code class="language-php">&lt;?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        \'name\',
        \'email\',
        \'password\',
    ];

    protected $hidden = [
        \'password\',
        \'remember_token\',
    ];
}</code></pre>

<h2>Creating API Resources</h2>
<p>API Resources transform your models into JSON responses. They give you granular control over the JSON structure:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            \'id\' => $this->id,
            \'name\' => $this->name,
            \'email\' => $this->email,
            \'avatar\' => $this->avatar_url,
            \'created_at\' => $this->created_at->toISOString(),
            \'posts_count\' => $this->whenCounted(\'posts\'),
            \'posts\' => PostResource::collection($this->whenLoaded(\'posts\')),
        ];
    }
}</code></pre>

<h2>Rate Limiting</h2>
<p>Protect your API from abuse with Laravel\'s built-in rate limiting:</p>

<pre><code class="language-php">&lt;?php

// In App\Providers\AppServiceProvider

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

public function boot(): void
{
    RateLimiter::for(\'api\', function (Request $request) {
        return Limit::perMinute(60)->by(
            $request->user()?->id ?: $request->ip()
        );
    });

    // Custom rate limiter for sensitive endpoints
    RateLimiter::for(\'uploads\', function (Request $request) {
        return Limit::perMinute(10)->by($request->user()->id);
    });
}</code></pre>

<h2>Caching Responses</h2>
<p>Implement response caching to dramatically improve performance for read-heavy endpoints:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::remember(\'posts.published\', 3600, function () {
            return Post::query()
                ->published()
                ->with([\'author\', \'category\'])
                ->latest()
                ->paginate(15);
        });

        return PostResource::collection($posts);
    }
}</code></pre>

<h2>Conclusion</h2>
<p>By following these practices, you\'ll have a solid foundation for building scalable Laravel APIs. Remember to always validate input, use API resources for consistent responses, and implement proper error handling.</p>',
                    'ar' => '<h2>مقدمة</h2>
<p>واجهات البرمجة هي العمود الفقري لتطبيقات الويب الحديثة. في هذا الدليل الشامل، سنستكشف كيفية بناء واجهات برمجة قابلة للتطوير والصيانة باستخدام Laravel.</p>',
                ],
                'category_slug' => 'api-development',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'slug' => 'mastering-eloquent-relationships',
                'title' => [
                    'en' => 'Mastering Eloquent Relationships in Laravel',
                    'ar' => 'إتقان علاقات Eloquent في Laravel',
                ],
                'excerpt' => [
                    'en' => 'Deep dive into Eloquent relationships - from basic one-to-many to complex polymorphic relations. Learn optimization techniques and common pitfalls to avoid.',
                    'ar' => 'الغوص العميق في علاقات Eloquent - من العلاقات الأساسية واحد إلى متعدد إلى العلاقات متعددة الأشكال المعقدة. تعلم تقنيات التحسين والأخطاء الشائعة التي يجب تجنبها.',
                ],
                'content' => [
                    'en' => '<h2>Understanding Relationships</h2>
<p>Eloquent makes working with database relationships elegant and intuitive. Let\'s explore the different types of relationships available.</p>

<h2>One-to-Many Relationships</h2>
<p>The most common relationship type. A user has many posts, a post belongs to a user.</p>

<pre><code class="language-php">&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

class Post extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, \'user_id\');
    }
}</code></pre>

<h2>Many-to-Many with Pivot Data</h2>
<p>When you need additional data on the pivot table:</p>

<pre><code class="language-php">&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->withPivot([\'assigned_at\', \'assigned_by\'])
            ->withTimestamps()
            ->using(RoleUser::class);
    }

    public function assignRole(Role $role, User $assigner): void
    {
        $this->roles()->attach($role->id, [
            \'assigned_at\' => now(),
            \'assigned_by\' => $assigner->id,
        ]);
    }
}</code></pre>

<h2>Polymorphic Relationships</h2>
<p>When multiple models can have the same relationship:</p>

<pre><code class="language-php">&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}

class Post extends Model
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, \'commentable\');
    }
}

class Video extends Model
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, \'commentable\');
    }
}</code></pre>

<h2>Eager Loading</h2>
<p>Avoid the N+1 query problem with eager loading:</p>

<pre><code class="language-php">&lt;?php

// Bad - N+1 problem (101 queries for 100 posts)
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->author->name;
}

// Good - Eager loading (2 queries)
$posts = Post::with(\'author\')->get();
foreach ($posts as $post) {
    echo $post->author->name;
}

// Nested eager loading
$posts = Post::with([
    \'author\',
    \'comments.user\',
    \'tags\',
])->get();

// Constrained eager loading
$posts = Post::with([
    \'comments\' => function ($query) {
        $query->where(\'approved\', true)
              ->latest()
              ->limit(5);
    },
])->get();</code></pre>

<h2>Conclusion</h2>
<p>Understanding relationships deeply will make you a more effective Laravel developer. Always use eager loading to prevent N+1 queries, and leverage pivot tables for complex many-to-many relationships.</p>',
                    'ar' => '<h2>فهم العلاقات</h2>
<p>يجعل Eloquent العمل مع علاقات قاعدة البيانات أنيقاً وبديهياً. دعنا نستكشف الأنواع المختلفة من العلاقات المتاحة.</p>',
                ],
                'category_slug' => 'laravel',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'slug' => 'php-8-features-you-should-use',
                'title' => [
                    'en' => 'PHP 8 Features Every Developer Should Be Using',
                    'ar' => 'ميزات PHP 8 التي يجب على كل مطور استخدامها',
                ],
                'excerpt' => [
                    'en' => 'Explore the most impactful PHP 8 features including named arguments, attributes, match expressions, and constructor property promotion.',
                    'ar' => 'استكشف أكثر ميزات PHP 8 تأثيراً بما في ذلك الوسائط المسماة والسمات وتعبيرات المطابقة وترويج خصائص المُنشئ.',
                ],
                'content' => [
                    'en' => '<h2>Named Arguments</h2>
<p>Pass arguments by name instead of position for clearer code:</p>

<pre><code class="language-php">&lt;?php

function createUser(
    string $name,
    string $email,
    string $role = \'user\',
    bool $sendWelcomeEmail = true,
    ?string $avatar = null
): User {
    // Implementation
}

// Old way - hard to read
createUser(\'John\', \'john@example.com\', \'admin\', true, null);

// With named arguments - crystal clear
createUser(
    name: \'John\',
    email: \'john@example.com\',
    role: \'admin\',
    sendWelcomeEmail: true,
);

// Skip optional arguments
createUser(
    name: \'Jane\',
    email: \'jane@example.com\',
    avatar: \'https://example.com/avatar.jpg\',
);</code></pre>

<h2>Constructor Property Promotion</h2>
<p>Reduce boilerplate in your classes:</p>

<pre><code class="language-php">&lt;?php

// Before PHP 8
class Point
{
    public float $x;
    public float $y;
    public float $z;

    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
}

// PHP 8 - Constructor Property Promotion
class Point
{
    public function __construct(
        public float $x,
        public float $y,
        public float $z,
    ) {}
}

// With readonly (PHP 8.1+)
class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public string $email,
    ) {}
}</code></pre>

<h2>Match Expression</h2>
<p>A more powerful alternative to switch statements:</p>

<pre><code class="language-php">&lt;?php

// Old switch statement
switch ($status) {
    case \'draft\':
        $label = \'Document is in draft\';
        break;
    case \'published\':
        $label = \'Document is live\';
        break;
    case \'archived\':
        $label = \'Document is archived\';
        break;
    default:
        $label = \'Unknown status\';
}

// PHP 8 match expression
$label = match($status) {
    \'draft\' => \'Document is in draft\',
    \'published\' => \'Document is live\',
    \'archived\' => \'Document is archived\',
    default => \'Unknown status\',
};

// Match with multiple conditions
$emoji = match($status) {
    \'draft\', \'pending\' => \'📝\',
    \'published\', \'active\' => \'✅\',
    \'archived\', \'deleted\' => \'📦\',
    default => \'❓\',
};</code></pre>

<h2>Nullsafe Operator</h2>
<p>Safely access nested nullable properties:</p>

<pre><code class="language-php">&lt;?php

// Before PHP 8 - verbose null checks
$country = null;
if ($user !== null) {
    $address = $user->getAddress();
    if ($address !== null) {
        $country = $address->country;
    }
}

// PHP 8 - Nullsafe operator
$country = $user?->getAddress()?->country;

// Combining with null coalescing
$countryName = $user?->address?->country?->name ?? \'Unknown\';</code></pre>

<h2>Attributes</h2>
<p>Native metadata annotations in PHP:</p>

<pre><code class="language-php">&lt;?php

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $path,
        public string $method = \'GET\',
    ) {}
}

class UserController
{
    #[Route(\'/users\', method: \'GET\')]
    public function index(): array
    {
        return User::all()->toArray();
    }

    #[Route(\'/users/{id}\', method: \'GET\')]
    public function show(int $id): array
    {
        return User::findOrFail($id)->toArray();
    }

    #[Route(\'/users\', method: \'POST\')]
    public function store(): array
    {
        // Create user
    }
}</code></pre>

<h2>Conclusion</h2>
<p>PHP 8 brings significant improvements to the language. Start using these features today to write cleaner, more maintainable code.</p>',
                    'ar' => '<h2>الوسائط المسماة</h2>
<p>مرر الوسائط بالاسم بدلاً من الموضع للحصول على كود أوضح.</p>',
                ],
                'category_slug' => 'php',
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'slug' => 'database-optimization-techniques',
                'title' => [
                    'en' => 'Database Optimization Techniques for Laravel Applications',
                    'ar' => 'تقنيات تحسين قواعد البيانات لتطبيقات Laravel',
                ],
                'excerpt' => [
                    'en' => 'Practical techniques to optimize your database queries, from indexing strategies to query optimization and efficient use of Redis caching.',
                    'ar' => 'تقنيات عملية لتحسين استعلامات قاعدة البيانات الخاصة بك، من استراتيجيات الفهرسة إلى تحسين الاستعلامات والاستخدام الفعال للتخزين المؤقت Redis.',
                ],
                'content' => [
                    'en' => '<h2>Indexing Strategies</h2>
<p>Proper indexing is the foundation of database performance. Here\'s how to identify what to index:</p>

<pre><code class="language-php">&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(\'orders\', function (Blueprint $table) {
            // Single column index for frequent lookups
            $table->index(\'status\');

            // Composite index for queries that filter by multiple columns
            $table->index([\'user_id\', \'status\', \'created_at\']);

            // Unique index for constraints
            $table->unique([\'user_id\', \'order_number\']);
        });
    }
};</code></pre>

<h2>Query Optimization</h2>
<p>Use Laravel Debugbar or Telescope to identify slow queries. Common optimizations include:</p>

<ul>
<li>Select only needed columns</li>
<li>Use chunking for large datasets</li>
<li>Avoid N+1 queries with eager loading</li>
</ul>

<pre><code class="language-php">&lt;?php

// Bad - Selects all columns
$users = User::all();

// Good - Select only what you need
$users = User::select([\'id\', \'name\', \'email\'])->get();

// Bad - Memory issues with large datasets
$users = User::all();
foreach ($users as $user) {
    $this->processUser($user);
}

// Good - Chunking for large datasets
User::chunk(1000, function ($users) {
    foreach ($users as $user) {
        $this->processUser($user);
    }
});

// Even better - Lazy collections (no memory issues)
User::lazy()->each(function ($user) {
    $this->processUser($user);
});</code></pre>

<h2>Redis Caching</h2>
<p>Cache frequently accessed data:</p>

<pre><code class="language-php">&lt;?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function getActiveUsers()
    {
        return Cache::remember(\'users.active\', 3600, function () {
            return User::where(\'active\', true)
                ->with(\'roles\')
                ->get();
        });
    }

    public function getUser(int $id): User
    {
        return Cache::remember("user.{$id}", 3600, function () use ($id) {
            return User::with([\'roles\', \'permissions\'])->findOrFail($id);
        });
    }

    public function updateUser(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);

        // Invalidate cache
        Cache::forget("user.{$id}");
        Cache::forget(\'users.active\');

        return $user->fresh();
    }
}</code></pre>

<h2>Database Query Caching</h2>
<p>Cache expensive query results at the query level:</p>

<pre><code class="language-php">&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    public static function getPopular(int $limit = 10)
    {
        return Cache::tags([\'posts\'])->remember(
            "posts.popular.{$limit}",
            now()->addHour(),
            fn () => static::query()
                ->withCount(\'views\')
                ->orderByDesc(\'views_count\')
                ->limit($limit)
                ->get()
        );
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::tags([\'posts\'])->flush());
        static::deleted(fn () => Cache::tags([\'posts\'])->flush());
    }
}</code></pre>

<h2>Conclusion</h2>
<p>Database optimization is crucial for application performance. Always profile your queries, use appropriate indexes, and implement caching strategies for frequently accessed data.</p>',
                    'ar' => '<h2>استراتيجيات الفهرسة</h2>
<p>الفهرسة الصحيحة هي أساس أداء قاعدة البيانات.</p>',
                ],
                'category_slug' => 'database',
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'slug' => 'docker-for-laravel-developers',
                'title' => [
                    'en' => 'Docker for Laravel Developers: From Development to Production',
                    'ar' => 'Docker لمطوري Laravel: من التطوير إلى الإنتاج',
                ],
                'excerpt' => [
                    'en' => 'A comprehensive guide to containerizing your Laravel applications with Docker. Learn to create development environments and production-ready containers.',
                    'ar' => 'دليل شامل لوضع تطبيقات Laravel الخاصة بك في حاويات مع Docker. تعلم إنشاء بيئات التطوير والحاويات الجاهزة للإنتاج.',
                ],
                'content' => [
                    'en' => '<h2>Why Docker?</h2>
<p>Docker ensures consistency across development, staging, and production environments. No more "it works on my machine" issues.</p>

<h2>Development Setup with Laravel Sail</h2>
<p>Laravel Sail provides a Docker-based development environment:</p>

<pre><code class="language-bash"># Install Sail in existing project
composer require laravel/sail --dev

# Publish Sail configuration
php artisan sail:install

# Start the containers
./vendor/bin/sail up -d

# Run artisan commands
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan test

# Stop containers
./vendor/bin/sail down</code></pre>

<h2>Production Dockerfile</h2>
<p>For production, you\'ll want an optimized multi-stage build:</p>

<pre><code class="language-dockerfile"># Build stage
FROM composer:2 as build

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist

COPY . .
RUN composer dump-autoload --optimize

# Production stage
FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache \\
    nginx \\
    supervisor \\
    && docker-php-ext-install pdo pdo_mysql opcache

# Copy application
WORKDIR /var/www/html
COPY --from=build /app /var/www/html

# Configure PHP
COPY docker/php.ini /usr/local/etc/php/conf.d/app.ini

# Configure Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configure Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]</code></pre>

<h2>Docker Compose for Services</h2>
<p>Orchestrate your application stack with docker-compose:</p>

<pre><code class="language-yaml">version: \'3.8\'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8080:80"
    environment:
      - APP_ENV=production
      - DB_HOST=mysql
      - REDIS_HOST=redis
    depends_on:
      - mysql
      - redis
    networks:
      - app-network

  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: laravel
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - app-network

  redis:
    image: redis:alpine
    networks:
      - app-network

  queue:
    build:
      context: .
      dockerfile: Dockerfile
    command: php artisan queue:work --sleep=3 --tries=3
    depends_on:
      - mysql
      - redis
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql-data:</code></pre>

<h2>Conclusion</h2>
<p>Docker simplifies deployment and ensures consistency across all environments. Start with Laravel Sail for development, then create optimized production images.</p>',
                    'ar' => '<h2>لماذا Docker؟</h2>
<p>يضمن Docker الاتساق عبر بيئات التطوير والتجهيز والإنتاج.</p>',
                ],
                'category_slug' => 'devops',
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'slug' => 'writing-clean-maintainable-code',
                'title' => [
                    'en' => 'Writing Clean, Maintainable Laravel Code',
                    'ar' => 'كتابة كود Laravel نظيف وقابل للصيانة',
                ],
                'excerpt' => [
                    'en' => 'Best practices for writing clean Laravel code. Learn about SOLID principles, design patterns, and how to structure your applications for long-term maintainability.',
                    'ar' => 'أفضل الممارسات لكتابة كود Laravel نظيف. تعرف على مبادئ SOLID وأنماط التصميم وكيفية هيكلة تطبيقاتك للصيانة طويلة المدى.',
                ],
                'content' => [
                    'en' => '<h2>Single Responsibility Principle</h2>
<p>Each class should have one reason to change. Keep your controllers thin:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function __construct(
        private CreateOrderAction $createOrder,
    ) {}

    public function store(StoreOrderRequest $request): OrderResource
    {
        $order = $this->createOrder->execute(
            user: $request->user(),
            items: $request->validated(\'items\'),
            shippingAddress: $request->validated(\'shipping_address\'),
        );

        return new OrderResource($order);
    }
}</code></pre>

<h2>Action Classes</h2>
<p>Extract complex logic into dedicated action classes:</p>

<pre><code class="language-php">&lt;?php

namespace App\Actions;

use App\Models\Order;
use App\Models\User;
use App\Services\PaymentService;
use App\Services\InventoryService;
use App\Notifications\OrderConfirmation;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public function __construct(
        private PaymentService $paymentService,
        private InventoryService $inventoryService,
    ) {}

    public function execute(User $user, array $items, array $shippingAddress): Order
    {
        return DB::transaction(function () use ($user, $items, $shippingAddress) {
            // Reserve inventory
            $this->inventoryService->reserve($items);

            // Create order
            $order = Order::create([
                \'user_id\' => $user->id,
                \'status\' => \'pending\',
                \'shipping_address\' => $shippingAddress,
            ]);

            // Attach items
            foreach ($items as $item) {
                $order->items()->create($item);
            }

            // Calculate totals
            $order->calculateTotals();

            // Send notification
            $user->notify(new OrderConfirmation($order));

            return $order;
        });
    }
}</code></pre>

<h2>Repository Pattern</h2>
<p>Abstract your data access layer for flexibility:</p>

<pre><code class="language-php">&lt;?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function getActive(): LengthAwarePaginator;
    public function create(array $data): User;
    public function update(User $user, array $data): User;
}

class UserRepository implements UserRepositoryInterface
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where(\'email\', $email)->first();
    }

    public function getActive(): LengthAwarePaginator
    {
        return User::query()
            ->where(\'active\', true)
            ->orderBy(\'name\')
            ->paginate(15);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }
}</code></pre>

<h2>Service Classes</h2>
<p>Handle business logic in dedicated service classes:</p>

<pre><code class="language-php">&lt;?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $users,
    ) {}

    public function register(array $data): User
    {
        $user = $this->users->create([
            \'name\' => $data[\'name\'],
            \'email\' => $data[\'email\'],
            \'password\' => Hash::make($data[\'password\']),
        ]);

        $user->notify(new WelcomeNotification());

        return $user;
    }
}</code></pre>

<h2>Conclusion</h2>
<p>Clean code is maintainable code. Follow SOLID principles, extract logic into dedicated classes, and always think about the next developer who will read your code.</p>',
                    'ar' => '<h2>مبدأ المسؤولية الواحدة</h2>
<p>يجب أن يكون لكل فئة سبب واحد للتغيير.</p>',
                ],
                'category_slug' => 'best-practices',
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
            [
                'slug' => 'laravel-performance-optimization',
                'title' => [
                    'en' => 'Laravel Performance Optimization: A Deep Dive',
                    'ar' => 'تحسين أداء Laravel: نظرة عميقة',
                ],
                'excerpt' => [
                    'en' => 'Comprehensive performance optimization strategies for Laravel applications. From configuration caching to queue optimization and beyond.',
                    'ar' => 'استراتيجيات شاملة لتحسين الأداء لتطبيقات Laravel. من التخزين المؤقت للتكوين إلى تحسين الصفوف وما بعدها.',
                ],
                'content' => [
                    'en' => '<h2>Configuration Caching</h2>
<p>In production, always cache your configuration:</p>

<pre><code class="language-bash"># Cache configuration files
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events
php artisan event:cache

# All at once
php artisan optimize</code></pre>

<h2>OPcache Configuration</h2>
<p>Properly configured OPcache can dramatically improve performance. Add to your php.ini:</p>

<pre><code class="language-ini">opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=64
opcache.max_accelerated_files=30000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.enable_file_override=1</code></pre>

<h2>Queue Workers</h2>
<p>Offload heavy tasks to background queues:</p>

<pre><code class="language-php">&lt;?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public Order $order,
    ) {}

    public function handle(InvoiceService $invoiceService): void
    {
        $invoiceService->generate($this->order);
    }

    public function failed(\Throwable $exception): void
    {
        // Handle failure - notify admin, log error, etc.
    }
}

// Dispatch the job
GenerateInvoice::dispatch($order)->onQueue(\'invoices\');</code></pre>

<h2>Lazy Collections</h2>
<p>Process large datasets without running out of memory:</p>

<pre><code class="language-php">&lt;?php

// Bad - loads all users into memory
$users = User::all();
foreach ($users as $user) {
    $this->sendNewsletter($user);
}

// Good - processes one at a time
User::lazy()->each(function (User $user) {
    $this->sendNewsletter($user);
});

// With cursor for even better memory usage
User::cursor()->each(function (User $user) {
    $this->sendNewsletter($user);
});

// Chunk with lazy for batch processing
User::lazy(1000)->each(function (User $user) {
    $this->sendNewsletter($user);
});</code></pre>

<h2>Database Connection Pooling</h2>
<p>Configure persistent connections for better performance:</p>

<pre><code class="language-php">&lt;?php

// config/database.php
\'mysql\' => [
    \'driver\' => \'mysql\',
    \'host\' => env(\'DB_HOST\', \'127.0.0.1\'),
    \'database\' => env(\'DB_DATABASE\', \'laravel\'),
    \'username\' => env(\'DB_USERNAME\', \'root\'),
    \'password\' => env(\'DB_PASSWORD\', \'\'),
    \'options\' => [
        PDO::ATTR_PERSISTENT => true,
    ],
],</code></pre>

<h2>Conclusion</h2>
<p>Performance optimization is an ongoing process. Profile your application regularly, cache aggressively, and use queues for heavy operations.</p>',
                    'ar' => '<h2>التخزين المؤقت للتكوين</h2>
<p>في الإنتاج، قم دائماً بتخزين التكوين الخاص بك مؤقتاً.</p>',
                ],
                'category_slug' => 'performance',
                'is_published' => true,
                'published_at' => now()->subDays(35),
            ],
            [
                'slug' => 'securing-laravel-applications',
                'title' => [
                    'en' => 'Securing Your Laravel Application: Essential Practices',
                    'ar' => 'تأمين تطبيق Laravel الخاص بك: الممارسات الأساسية',
                ],
                'excerpt' => [
                    'en' => 'Essential security practices for Laravel applications. Learn about authentication, authorization, input validation, and protecting against common vulnerabilities.',
                    'ar' => 'ممارسات الأمان الأساسية لتطبيقات Laravel. تعرف على المصادقة والتفويض والتحقق من المدخلات والحماية من الثغرات الشائعة.',
                ],
                'content' => [
                    'en' => '<h2>Input Validation</h2>
<p>Always validate user input using Form Requests:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            \'name\' => [\'required\', \'string\', \'max:255\'],
            \'email\' => [
                \'required\',
                \'string\',
                \'email:rfc,dns\',
                \'max:255\',
                \'unique:users\',
            ],
            \'password\' => [
                \'required\',
                \'confirmed\',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}</code></pre>

<h2>SQL Injection Prevention</h2>
<p>Eloquent and Query Builder protect against SQL injection by default, but be careful with raw queries:</p>

<pre><code class="language-php">&lt;?php

// DANGEROUS - SQL Injection vulnerability
$users = DB::select("SELECT * FROM users WHERE name = \'" . $name . "\'");

// SAFE - Using parameter binding
$users = DB::select("SELECT * FROM users WHERE name = ?", [$name]);

// SAFE - Using Eloquent
$users = User::where(\'name\', $name)->get();

// SAFE - Using whereRaw with bindings
$users = User::whereRaw(\'LOWER(name) = ?\', [strtolower($name)])->get();</code></pre>

<h2>XSS Prevention</h2>
<p>Blade automatically escapes output. Use {!! !!} sparingly and only with trusted content:</p>

<pre><code class="language-php">&lt;?php

// In your Blade template:

// SAFE - Escaped output
{{ $user->name }}
{{ $user->bio }}

// DANGEROUS - Unescaped output (only use with trusted content)
{!! $post->content !!}

// If you must render HTML, sanitize it first:
{!! clean($post->content) !!}  // Using a sanitizer package</code></pre>

<h2>Authorization with Policies</h2>
<p>Use policies to control access to resources:</p>

<pre><code class="language-php">&lt;?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function view(User $user, Post $post): bool
    {
        return $post->is_published || $user->id === $post->user_id;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->isAdmin();
    }
}

// In controller:
public function update(UpdatePostRequest $request, Post $post)
{
    $this->authorize(\'update\', $post);
    // ...
}</code></pre>

<h2>Rate Limiting</h2>
<p>Protect against brute force attacks:</p>

<pre><code class="language-php">&lt;?php

// In routes/api.php
Route::middleware([\'throttle:api\'])->group(function () {
    Route::post(\'/login\', [AuthController::class, \'login\']);
});

// Custom rate limiter in AppServiceProvider
RateLimiter::for(\'login\', function (Request $request) {
    return [
        Limit::perMinute(5)->by($request->ip()),
        Limit::perMinute(10)->by($request->input(\'email\')),
    ];
});</code></pre>

<h2>Conclusion</h2>
<p>Security should be built into your application from the start. Validate all input, use Laravel\'s built-in protections, and always follow the principle of least privilege.</p>',
                    'ar' => '<h2>التحقق من المدخلات</h2>
<p>قم دائماً بالتحقق من مدخلات المستخدم باستخدام Form Requests.</p>',
                ],
                'category_slug' => 'security',
                'is_published' => true,
                'published_at' => now()->subDays(40),
            ],
        ];

        foreach ($posts as $postData) {
            $categorySlug = $postData['category_slug'];
            unset($postData['category_slug']);

            $category = BlogCategory::where('slug', $categorySlug)->first();

            $postData['blog_category_id'] = $category?->id;

            BlogPost::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );
        }
    }
}
