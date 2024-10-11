<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
//use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserPermissionController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


Route::get('/', function () {
    return redirect(route('login'));
 });

//  Route::middleware(['auth:web', 'verified'])->group(function () {
//     // Route::get('/dashboard', function () {
//     //     return view('dashboard');
//     // })->name('dashboard');
//     // Route::get('/backend/dashboard', function () {
//     //     return view('backend.dashboard');
//     // })->name('backend_dashboard');
//     //backend dashboard route
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// Route::get('/dashboard/posts/{timePeriod?}', [DashboardController::class, 'posts'])->name('dashboard.posts');

// //category routes
// Route::get('/backend/category/index', [CategoryController::class, 'index'])->name('category.index');
// Route::post('/backend/category/store', [CategoryController::class, 'store'])->name('category.store');
// Route::get('/backend/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
// Route::post('/backend/category/update', [CategoryController::class, 'update'])->name('category.update');
// Route::delete('/backend/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
// Route::get('/backend/category/status/{id}', [CategoryController::class, 'status'])->name('category.status');

// //post routes
// Route::get('/backend/post/index', [PostController::class, 'index'])->name('post.index');
// Route::post('/backend/post/store', [PostController::class, 'store'])->name('post.store');
// Route::get('/backend/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
// Route::post('/backend/post/update', [PostController::class, 'update'])->name('post.update');
// Route::delete('/backend/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
// Route::get('/backend/post/status/{id}', [PostController::class, 'status'])->name('post.status');

// //logout
// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//  });
Route::middleware(['auth:web', 'verified'])->group(function () {
     // Define the dashboard route expected by Jetstream/Fortify
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ---------- Dashboard Routes ----------
    Route::redirect('/backend/dashboard', '/dashboard/index');
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/posts/{timePeriod?}', [DashboardController::class, 'posts'])->name('dashboard.posts');

    // ---------- Category Routes ----------
    // Redirect for missing 'index', 'store', and 'edit'
    Route::redirect('/category', '/backend/category/index');
    Route::redirect('/category/create', '/backend/category/store');
    Route::redirect('/category/edit', '/backend/category/index');  // Redirect to index if `edit` is incomplete

    // Actual category routes
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/status/{id}', [CategoryController::class, 'status'])->name('category.status');

    // ---------- Post Routes ----------
    // Redirect for missing 'index', 'store', and 'edit'
    Route::redirect('/post', '/backend/post/index');
    Route::redirect('/post/create', '/backend/post/store');
    Route::redirect('/post/edit', '/backend/post/index');  // Redirect to index if `edit` is incomplete

    // Actual post routes
    Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/post/status/{id}', [PostController::class, 'status'])->name('post.status');

    //User Management Routes
    Route::get('/user/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/userPermissions', [UserPermissionController::class, 'index'])->name('user_permissions.index');
    Route::get('/roles', [RolesController::class, 'index'])->name('role.index');

    // ---------- Logout Route ----------
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/frontend/index', function () {
    return view('frontend/index');
});



Route::get('components_list_group', function () {
    return view('backend/components-list-group');
});

Route::get('components_modal', function () {
    return view('backend/components-modal');
});

Route::get('components_pagination', function () {
    return view('backend/components-pagination');
});

Route::get('components_progress', function () {
    return view('backend/components-progress');
});

Route::get('components_spinners', function () {
    return view('backend/components-spinners');
});

Route::get('components_tabs', function () {
    return view('backend/components-tabs');
});

Route::get('components_tooltips', function () {
    return view('backend/components-tooltips');
});

Route::get('forms_editors', function () {
    return view('backend/forms-editors');
});

Route::get('forms_elements', function () {
    return view('backend/forms-elements');
});


Route::get('forms_layouts', function () {
    return view('backend/forms-layouts');
});




Route::get('/forms-validation', function () {
    return view('backend.forms-validation');
});

Route::get('/icons-bootstrap', function () {
    return view('backend.icons-bootstrap');
});

Route::get('/icons-boxicons', function () {
    return view('backend.icons-boxicons');
});

Route::get('/icons-remix', function () {
    return view('backend.icons-remix');
});

Route::get('/backend-index', function () {
    return view('backend.index');
})->name('backendindex');

Route::get('/pages-blank', function () {
    return view('backend.pages-blank');
});

Route::get('/pages-contact', function () {
    return view('backend.pages-contact');
});

Route::get('/pages-error-404', function () {
    return view('backend.pages-error-404');
});

Route::get('/pages-faq', function () {
    return view('backend.pages-faq');
});

Route::get('/pages-login', function () {
    return view('backend.pages-login');
});


Route::get('/charts-apexcharts', function () {
    return view('backend/charts-apexcharts');
})->name('charts.apexcharts');
Route::get('/charts-chartjs', function () {
    return view('backend/charts-chartjs');
})->name('charts.chartjs');
Route::get('/components-accordion', function () {
    return view('backend/components-accordion');
})->name('components.accordion');
Route::get('/components-alerts', function () {
    return view('backend/components-alerts');
})->name('components.alerts');
Route::get('/components-badges', function () {
    return view('backend/components-badges');
})->name('components.badges');
Route::get('/components-breadcrumbs', function () {
    return view('backend/components-breadcrumbs');
})->name('components.breadcrumbs');
Route::get('/components-buttons', function () {
    return view('backend/components-buttons');
})->name('components.buttons');
Route::get('/components-cards', function () {
    return view('backend/components-cards');
})->name('components.cards');
Route::get('/components-carousel', function () {
    return view('backend/components-carousel');
})->name('components.carousel');




Route::get('frontend-about', function () {
    return view('frontend/about');
})->name('frontend-about');




Route::get('frontend-category', function () {
    return view('frontend/category');
});

Route::get('frontend-contact', function () {
    return view('frontend/contact');
})->name('frontend-contact');

Route::get('frontend-search', function () {
    return view('frontend/search');
})->name('frontend-search');


Route::get('frontend-single-post', function () {
    return view('frontend/single-post');
})->name('frontend-single-post');



Route::get('frontend-index', function () {
    return view('frontend/index');
});



require __DIR__ . '/ubaid.php';
