<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TechnologyController;
use App\Http\Controllers\Api\V1\TestimonialController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\SearchController;
use App\Http\Controllers\Api\V1\ExperienceController;
use App\Http\Controllers\Api\V1\EducationController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Api\V1\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\V1\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\Api\V1\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Api\V1\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Api\V1\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\V1\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\V1\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Api\V1\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Api\V1\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Api\V1\Admin\ActivityLogController;
use App\Http\Controllers\Api\V1\Admin\CacheController;
use App\Http\Controllers\Api\V1\Admin\SitemapController;
use App\Http\Controllers\Api\V1\Admin\BackupController;
use App\Http\Controllers\Api\V1\Admin\SeoAuditController;
use App\Http\Controllers\Api\V1\Admin\MediaController;
use App\Http\Controllers\Api\V1\Admin\DnsController;
use App\Http\Controllers\Api\V1\Admin\NginxController;

Route::prefix('v1')->group(function () {
    // Auth
    Route::post('auth/login', [LoginController::class, 'login']);
    Route::post('auth/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('auth/me', [LoginController::class, 'me'])->middleware('auth:sanctum');
    Route::put('auth/profile', [LoginController::class, 'updateProfile'])->middleware('auth:sanctum');

    // Public API
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/featured', [ProjectController::class, 'featured']);
    Route::get('projects/{project:slug}', [ProjectController::class, 'show']);
    Route::get('projects/{project:slug}/og-image', [ProjectController::class, 'ogImage']);
    Route::post('projects/{project:slug}/track', [ProjectController::class, 'track']);
    
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('technologies', [TechnologyController::class, 'index']);
    Route::get('testimonials', [TestimonialController::class, 'index']);
    Route::post('contact', [ContactController::class, 'store']);
    Route::get('settings/public', [SettingController::class, 'public']);
    Route::get('search', [SearchController::class, 'index']);

    // Public CV API
    Route::get('experiences', [ExperienceController::class, 'index']);
    Route::get('educations', [EducationController::class, 'index']);
    Route::get('courses', [CourseController::class, 'index']);

    // Dashboard API (Admin)
    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
        Route::get('dashboard/stats', [AdminDashboardController::class, 'stats']);
        Route::get('dashboard/views-chart', [AdminDashboardController::class, 'viewsChart']);
        Route::get('dashboard/popular-projects', [AdminDashboardController::class, 'popularProjects']);
        Route::get('dashboard/recent-contacts', [AdminDashboardController::class, 'recentContacts']);
        
        Route::apiResource('projects', AdminProjectController::class);
        Route::post('projects/{id}/duplicate', [AdminProjectController::class, 'duplicate']);
        Route::post('projects/{id}/provision', [AdminProjectController::class, 'provision']);
        Route::post('projects/{id}/deprovision', [AdminProjectController::class, 'deprovision']);
        Route::post('projects/{id}/credentials', [AdminProjectController::class, 'credentials']);
        Route::post('projects/{id}/start', [AdminProjectController::class, 'start']);
        Route::post('projects/{id}/stop', [AdminProjectController::class, 'stop']);
        
        Route::apiResource('categories', AdminCategoryController::class);
        Route::put('categories/reorder', [AdminCategoryController::class, 'reorder']);
        
        Route::apiResource('technologies', AdminTechnologyController::class);
        Route::apiResource('testimonials', AdminTestimonialController::class);
        
        Route::get('contacts', [AdminContactController::class, 'index']);
        Route::get('contacts/{id}', [AdminContactController::class, 'show']);
        Route::put('contacts/{id}/status', [AdminContactController::class, 'updateStatus']);
        Route::post('contacts/{id}/reply', [AdminContactController::class, 'reply']);
        
        Route::get('settings', [AdminSettingController::class, 'index']);
        Route::put('settings', [AdminSettingController::class, 'update']);

        // CV Management
        Route::apiResource('experiences', AdminExperienceController::class);
        Route::apiResource('educations', AdminEducationController::class);
        Route::apiResource('courses', AdminCourseController::class);

        // Terminal
        Route::post('terminal/execute', [\App\Http\Controllers\Api\V1\Admin\TerminalController::class, 'execute']);

        // Activity Log
        Route::get('activity-log', [ActivityLogController::class, 'index']);

        // Cache Management
        Route::post('cache/clear', [CacheController::class, 'clear']);

        // Infrastructure
        Route::get('dns/records', [DnsController::class, 'index']);
        Route::get('nginx/configs', [NginxController::class, 'index']);
        Route::get('nginx/configs/{name}', [NginxController::class, 'show']);

        // Sitemap
        Route::post('sitemap/generate', [SitemapController::class, 'generate']);

        // Backups
        Route::post('backup/create', [BackupController::class, 'create']);
        Route::get('backup/list', [BackupController::class, 'list']);
        Route::get('backup/{name}/download', [BackupController::class, 'download']);

        // SEO Audit
        Route::get('seo-audit', [SeoAuditController::class, 'index']);

        // Media Upload
        Route::post('media/upload', [MediaController::class, 'upload']);
        Route::delete('media/{path}', [MediaController::class, 'destroy'])->where('path', '.*');
    });
});

