<?php

use App\Http\Controllers\AboutController;
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
        });

        require __DIR__ . '/auth.php';
    });
