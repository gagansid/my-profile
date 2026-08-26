<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProfileInfoController as AdminProfileInfoController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\SocialLinkController as AdminSocialLinkController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site (APP_DOMAIN)
|--------------------------------------------------------------------------
*/

Route::domain(env('APP_DOMAIN', 'my-profile.test'))
    ->middleware(['set.locale', 'site.visibility'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/about', [AboutController::class, 'index'])
            ->middleware('page.visibility:about')
            ->name('about');

        Route::get('/projects', [ProjectController::class, 'index'])
            ->middleware('page.visibility:projects')
            ->name('projects.index');
        Route::get('/projects/{slug}', [ProjectController::class, 'show'])
            ->middleware('page.visibility:projects')
            ->name('projects.show');

        Route::get('/blog', [PostController::class, 'index'])
            ->middleware('page.visibility:blog')
            ->name('blog.index');
        Route::get('/blog/{slug}', [PostController::class, 'show'])
            ->middleware('page.visibility:blog')
            ->name('blog.show');

        Route::get('/contact', [ContactController::class, 'index'])
            ->middleware('page.visibility:contact')
            ->name('contact.index');
        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware(['page.visibility:contact', 'throttle:5,1'])
            ->name('contact.store');

        Route::get('/locale/{locale}', function (string $locale) {
            abort_unless(in_array($locale, ['id', 'en'], true), 404);
            session(['locale' => $locale]);

            return back();
        })->name('locale.switch');

        Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
    });

/*
|--------------------------------------------------------------------------
| Admin panel (ADMIN_DOMAIN)
|--------------------------------------------------------------------------
*/
Route::domain(env('ADMIN_DOMAIN', 'admin.my-profile.test'))
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::get('/profile-info', [AdminProfileInfoController::class, 'edit'])->name('admin.profile-info.edit');
            Route::put('/profile-info', [AdminProfileInfoController::class, 'update'])->name('admin.profile-info.update');

            Route::resource('experiences', AdminExperienceController::class)->except('show')->names('admin.experiences');
            Route::resource('educations', AdminEducationController::class)->except('show')->names('admin.educations');
            Route::resource('skills', AdminSkillController::class)->except('show')->names('admin.skills');
            Route::resource('technologies', AdminTechnologyController::class)->except('show')->names('admin.technologies');
            Route::resource('categories', AdminCategoryController::class)->except('show')->names('admin.categories');
            Route::resource('tags', AdminTagController::class)->except('show')->names('admin.tags');
            Route::resource('projects', AdminProjectController::class)->except('show')->names('admin.projects');
            Route::resource('posts', AdminPostController::class)->except('show')->names('admin.posts');
            Route::resource('social-links', AdminSocialLinkController::class)
                ->parameters(['social-links' => 'socialLink'])
                ->except('show')
                ->names('admin.social-links');

            Route::get('/site-settings', [AdminSiteSettingController::class, 'edit'])->name('admin.site-settings.edit');
            Route::put('/site-settings', [AdminSiteSettingController::class, 'update'])->name('admin.site-settings.update');

            Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.messages.index');
            Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('admin.messages.show');
            Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('admin.messages.destroy');
        });

        require __DIR__.'/auth.php';
    });
