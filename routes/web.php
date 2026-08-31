<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Supervisor\PartnerController as SupervisorPartnerController;
use App\Http\Controllers\Partner\DashboardController as PartnerDashboard;
use App\Http\Controllers\Officiant\DashboardController as OfficiantDashboard;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboard;
use App\Http\Controllers\Agent\DashboardController as AgentDashboard;
use App\Http\Controllers\BrandsAuctionController;
use App\Http\Controllers\Supervisor\FranchiseBrandController;
use App\Http\Controllers\Supervisor\FranchiseOpportunityController;
use App\Http\Controllers\Supervisor\PageSliderController;
use App\Http\Controllers\Supervisor\CommercialAgenciesController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NafathController;
use App\Http\Controllers\Jobs\Auth\LoginController as JobsLoginController;
use App\Http\Controllers\Jobs\Auth\RegisterController as JobsRegisterController;
use App\Http\Controllers\Jobs\JobController;
use App\Http\Controllers\Jobs\DashboardController as JobsDashboard;
use App\Http\Controllers\Jobs\ServicesController as JobsServices;
use App\Models\Jobs\JobListing;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Jobs\CadresApplicationController;
use App\Http\Controllers\Jobs\JobSpecializationController;
use App\Http\Controllers\UpdateService\ServiceCatalogController;
use App\Http\Controllers\UpdateService\AdminServiceController;
use App\Http\Controllers\UpdateService\AmrtmAuthController;
use App\Http\Controllers\UpdateService\NotificationController;
use App\Http\Controllers\UpdateService\PaymentController;
use App\Http\Controllers\UpdateService\IconController;
use App\Http\Controllers\UpdateService\OfficeAuthController;
use App\Http\Controllers\UpdateService\OfficeDashboardController;
use App\Http\Controllers\UpdateService\SupervisorController;
use App\Http\Controllers\FranchiseApplicationController;
use App\Http\Controllers\UpdateService\OfficeProfileController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\UpdateService\ProviderAccountController;
use App\Http\Controllers\UpdateService\HomepageController;

// ── Public pages ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('home');
})->name('home');

// ── Language switch ───────────────────────────────────────────────────────────
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');


// ── Amrtm Services Platform (/amrtm) ─────────────────────────────────────────
Route::prefix('amrtm')->name('amrtm.')->group(function () {




    // ─────────────────────────────────────────────────────────────────────────
    // Business Auth
    // ─────────────────────────────────────────────────────────────────────────

    Route::middleware('guest.business')->group(function () {

        Route::get(
            '/login',
            [AmrtmAuthController::class, 'showLoginForm']
        )->name('login');

        Route::post(
            '/login',
            [AmrtmAuthController::class, 'login']
        )->name('login.submit')
            ->middleware('throttle:business-login');

        Route::get(
            '/register',
            [AmrtmAuthController::class, 'showRegisterForm']
        )->name('register');

        Route::post(
            '/register',
            [AmrtmAuthController::class, 'register']
        )->name('register.submit')
            ->middleware('throttle:business-register');
    });


    // ─────────────────────────────────────────────────────────────────────────
    // Nafath
    // ─────────────────────────────────────────────────────────────────────────

    Route::get(
        '/nafath',
        [NafathController::class, 'show']
    )->name('nafath.show');

    Route::post(
        '/nafath',
        [NafathController::class, 'verify']
    )->name('nafath.verify');

    Route::get(
        '/nafath/wait',
        [NafathController::class, 'wait']
    )->name('nafath.wait');

    Route::get(
        '/nafath/callback',
        [NafathController::class, 'callback']
    )->name('nafath.callback');


    // ─────────────────────────────────────────────────────────────────────────
    // Business Logout
    // ─────────────────────────────────────────────────────────────────────────

    Route::post(
        '/logout',
        [AmrtmAuthController::class, 'logout']
    )->name('logout')
        ->middleware('auth:business');


    // ─────────────────────────────────────────────────────────────────────────
    // Public Catalog
    // ─────────────────────────────────────────────────────────────────────────

    Route::get(
        '/',
        [ServiceCatalogController::class, 'index']
    )->name('index');

    Route::get(
        '/catalog/{key}',
        [ServiceCatalogController::class, 'categoryPage']
    )->name('catalog.category');

    Route::get(
        '/catalog/{key}/{entityId}',
        [ServiceCatalogController::class, 'entityPage']
    )->name('catalog.entity');


    // ─────────────────────────────────────────────────────────────────────────
    // Offices Directory
    // ─────────────────────────────────────────────────────────────────────────

    Route::get(
        '/offices/{type}',
        [ServiceCatalogController::class, 'officeDirectory']
    )
        ->where(
            'type',
            'law|services|customs|accounting|engineering|freelance'
        )
        ->name('offices.directory');

    Route::get(
        '/offices/{type}/{officeId}',
        [ServiceCatalogController::class, 'officeDetail']
    )
        ->where(
            'type',
            'law|services|customs|accounting|engineering|freelance'
        )
        ->name('offices.detail');


    // ─────────────────────────────────────────────────────────────────────────
    // Business User Dashboard
    // ─────────────────────────────────────────────────────────────────────────

    Route::middleware('auth:business')->group(function () {

        Route::get(
            '/dashboard',
            [ServiceCatalogController::class, 'userDashboard']
        )->name('user.dashboard');

        Route::get(
            '/payment/callback',
            [PaymentController::class, 'callback']
        )->name('payment.callback');
    });


    // ─────────────────────────────────────────────────────────────────────────
    // Business Admin Dashboard
    // ─────────────────────────────────────────────────────────────────────────

    Route::middleware([
        'auth:business',
        'business-role:admin,supervisor'
    ])->group(function () {

        Route::get(
            '/admin',
            [AdminServiceController::class, 'dashboard']
        )->name('admin.dashboard');

        Route::get(
            '/admin/icons',
            [IconController::class, 'page']
        )->name('admin.icons');

        Route::get('/admin/homepage', [HomepageController::class, 'page'])->name('admin.homepage');

        Route::prefix('/admin/api/homepage')->name('admin.api.homepage.')->group(function () {
            Route::get('/settings', [HomepageController::class, 'getSettings'])->name('settings');
            Route::post('/settings', [HomepageController::class, 'saveSettings'])->name('settings.save');
            Route::get('/slides', [HomepageController::class, 'listSlides'])->name('slides');
            Route::post('/slides', [HomepageController::class, 'storeSlide'])->name('slides.store');
            Route::post('/slides/reorder', [HomepageController::class, 'reorderSlides'])->name('slides.reorder');
            Route::put('/slides/{id}', [HomepageController::class, 'updateSlide'])->name('slides.update');
            Route::post('/slides/{id}/toggle', [HomepageController::class, 'toggleSlide'])->name('slides.toggle');
            Route::delete('/slides/{id}', [HomepageController::class, 'deleteSlide'])->name('slides.delete');
        });
    });


    // ─────────────────────────────────────────────────────────────────────────
    // Public / Business API
    // ─────────────────────────────────────────────────────────────────────────

    Route::prefix('api')->name('api.')->group(function () {

        Route::get(
            '/services',
            [ServiceCatalogController::class, 'apiServices']
        )->name('services');

        Route::get(
            '/office-types',
            [ServiceCatalogController::class, 'publicOfficeTypes']
        )->name('office-types');


        // ─────────────────────────────────────────────────────────────────────
        // Authenticated Business API
        // ─────────────────────────────────────────────────────────────────────

        Route::middleware([
            'auth:business',
            'throttle:business-api'
        ])->group(function () {

            // User-only actions
            Route::middleware('no-admin')->group(function () {

                Route::post(
                    '/requests',
                    [ServiceCatalogController::class, 'submitRequest']
                )->name('requests.submit');

                Route::post(
                    '/payments/charge',
                    [ServiceCatalogController::class, 'chargeBalance']
                )->name('payments.charge');

                Route::post(
                    '/office-requests',
                    [ServiceCatalogController::class, 'submitOfficeRequest']
                )->name('office-requests.submit');
            });


            // Requests
            Route::get(
                '/requests',
                [ServiceCatalogController::class, 'myRequests']
            )->name('requests.index');

            Route::get(
                '/requests/{id}',
                [ServiceCatalogController::class, 'myRequestShow']
            )->name('requests.show');


            // Dashboard
            Route::get(
                '/dashboard/user',
                [ServiceCatalogController::class, 'userStats']
            )->name('dashboard.user');


            // Payments
            Route::get(
                '/payments/history',
                [ServiceCatalogController::class, 'paymentHistory']
            )->name('payments.history');


            // Profile
            Route::put(
                '/profile',
                [ServiceCatalogController::class, 'updateProfile']
            )->name('profile.update');

            Route::put(
                '/profile/password',
                [ServiceCatalogController::class, 'changePassword']
            )->name('profile.password');


            // Notifications
            Route::get(
                '/notifications',
                [NotificationController::class, 'index']
            )->name('notifications.index');

            Route::get(
                '/notifications/unread-count',
                [NotificationController::class, 'unreadCount']
            )->name('notifications.unread');

            Route::post(
                '/notifications/{id}/read',
                [NotificationController::class, 'markRead']
            )->name('notifications.read');

            Route::post(
                '/notifications/read-all',
                [NotificationController::class, 'markAllRead']
            )->name('notifications.read-all');


            // ─────────────────────────────────────────────────────────────────
            // Admin API
            // ─────────────────────────────────────────────────────────────────

            Route::middleware([
                'business-role:admin,supervisor',
                'audit-admin'
            ])->group(function () {

                Route::get(
                    '/dashboard/admin',
                    [AdminServiceController::class, 'adminStats']
                )->name('dashboard.admin');

                Route::get(
                    '/admin/requests',
                    [AdminServiceController::class, 'adminRequests']
                )->name('admin.requests');

                Route::put(
                    '/admin/requests/{id}/status',
                    [AdminServiceController::class, 'updateRequestStatus']
                )->name('admin.requests.status');

                Route::post(
                    '/admin/requests/{id}/note',
                    [AdminServiceController::class, 'sendNote']
                )->name('admin.requests.note');

                Route::post(
                    '/admin/requests/{id}/info',
                    [AdminServiceController::class, 'requestInfo']
                )->name('admin.requests.info');

                Route::put(
                    '/admin/services/{id}/price',
                    [AdminServiceController::class, 'updateServicePrice']
                )->name('admin.services.price');

                Route::put(
                    '/admin/services/{id}',
                    [AdminServiceController::class, 'updateService']
                )->name('admin.services.update');

                Route::get(
                    '/admin/payments',
                    [AdminServiceController::class, 'adminTransactions']
                )->name('admin.payments');


                // Catalog - Categories
                Route::get(
                    '/admin/catalog/categories',
                    [AdminServiceController::class, 'adminCategories']
                )->name('admin.catalog.categories');

                Route::post(
                    '/admin/catalog/categories',
                    [AdminServiceController::class, 'createCategory']
                )->name('admin.catalog.categories.create');

                Route::put(
                    '/admin/catalog/categories/{id}',
                    [AdminServiceController::class, 'updateCategory']
                )->name('admin.catalog.categories.update');

                Route::delete(
                    '/admin/catalog/categories/{id}',
                    [AdminServiceController::class, 'deleteCategory']
                )->name('admin.catalog.categories.delete');


                // Catalog - Entities
                Route::get(
                    '/admin/catalog/entities',
                    [AdminServiceController::class, 'adminEntities']
                )->name('admin.catalog.entities');

                Route::post(
                    '/admin/catalog/entities',
                    [AdminServiceController::class, 'createEntity']
                )->name('admin.catalog.entities.create');

                Route::put(
                    '/admin/catalog/entities/{id}',
                    [AdminServiceController::class, 'updateEntity']
                )->name('admin.catalog.entities.update');

                Route::delete(
                    '/admin/catalog/entities/{id}',
                    [AdminServiceController::class, 'deleteEntity']
                )->name('admin.catalog.entities.delete');


                // Catalog - Services
                Route::get(
                    '/admin/catalog/services',
                    [AdminServiceController::class, 'adminServices']
                )->name('admin.catalog.services');

                Route::post(
                    '/admin/catalog/services',
                    [AdminServiceController::class, 'createGovService']
                )->name('admin.catalog.services.create');

                Route::delete(
                    '/admin/catalog/services/{id}',
                    [AdminServiceController::class, 'deleteGovService']
                )->name('admin.catalog.services.delete');


                // Icons
                Route::get(
                    '/admin/icons',
                    [IconController::class, 'list']
                )->name('admin.icons.list');

                Route::post(
                    '/admin/icons',
                    [IconController::class, 'upload']
                )->name('admin.icons.upload');

                Route::delete(
                    '/admin/icons',
                    [IconController::class, 'delete']
                )->name('admin.icons.delete');



                // Offices

                Route::get(
                    '/admin/offices',
                    [AdminServiceController::class, 'adminOffices']
                )->name('admin.offices');

                Route::get(
                    '/admin/offices/stats',
                    [AdminServiceController::class, 'adminOfficeStats']
                )->name('admin.offices.stats');

                Route::get(
                    '/admin/offices/{id}/details',
                    [AdminServiceController::class, 'adminOfficeDetails']
                )->name('admin.offices.details');

                Route::get(
                    '/admin/offices/{id}/documents/{documentId}',
                    [AdminServiceController::class, 'viewOfficeDocument']
                )->name('admin.offices.document');

                Route::post(
                    '/admin/offices/{id}/verify',
                    [AdminServiceController::class, 'verifyOffice']
                )->name('admin.offices.verify');

                Route::post(
                    '/admin/offices/{id}/toggle',
                    [AdminServiceController::class, 'toggleOffice']
                )->name('admin.offices.toggle');

                Route::delete(
                    '/admin/offices/{id}',
                    [AdminServiceController::class, 'deleteOffice']
                )->name('admin.offices.delete');



                // Office Financial
                Route::get(
                    '/admin/office-financial',
                    [AdminServiceController::class, 'officeFinancialReport']
                )->name('admin.office-financial');

                Route::get(
                    '/admin/office-requests-all',
                    [AdminServiceController::class, 'adminOfficeRequestsList']
                )->name('admin.office-requests-all');


                // Users
                Route::get(
                    '/admin/users',
                    [AdminServiceController::class, 'adminUsers']
                )->name('admin.users');

                Route::get(
                    '/admin/users/stats',
                    [AdminServiceController::class, 'adminUserStats']
                )->name('admin.users.stats');

                Route::post(
                    '/admin/users/{id}/toggle',
                    [AdminServiceController::class, 'toggleUserStatus']
                )->name('admin.users.toggle');

                Route::post(
                    '/admin/users/{id}/balance',
                    [AdminServiceController::class, 'adjustUserBalance']
                )->name('admin.users.balance');


                // Logs
                Route::get(
                    '/admin/logs',
                    [AdminServiceController::class, 'adminActivityLogs']
                )->name('admin.logs');


                // Analytics
                Route::get(
                    '/admin/analytics',
                    [AdminServiceController::class, 'adminAnalytics']
                )->name('admin.analytics');
            });


            // ─────────────────────────────────────────────────────────────────
            // Supervisor API
            // ─────────────────────────────────────────────────────────────────

            Route::middleware('business-role:supervisor')->group(function () {

                Route::get(
                    '/supervisor/admins',
                    [SupervisorController::class, 'admins']
                )->name('supervisor.admins');

                Route::post(
                    '/supervisor/admins',
                    [SupervisorController::class, 'createAdmin']
                )->name('supervisor.admins.create');

                Route::put(
                    '/supervisor/admins/{id}/permissions',
                    [SupervisorController::class, 'updateAdminPermissions']
                )->name('supervisor.admins.permissions');

                Route::post(
                    '/supervisor/admins/{id}/toggle',
                    [SupervisorController::class, 'toggleAdmin']
                )->name('supervisor.admins.toggle');

                Route::get(
                    '/supervisor/revenue',
                    [SupervisorController::class, 'revenueReport']
                )->name('supervisor.revenue');

                Route::get(
                    '/supervisor/monthly-report',
                    [SupervisorController::class, 'monthlyReport']
                )->name('supervisor.monthly-report');
            });
        });
    });
});
// ─────────────────────────────────────────────────────────────────────────────
// Office / Business Sector Platform (/amrtm/office)
// ─────────────────────────────────────────────────────────────────────────────
Route::prefix('amrtm/office')
    ->name('amrtm.office.')
    ->group(function () {

        // =========================================================
        // Office Specialties
        // =========================================================
    
        Route::get(
            '/specialties',
            [AdminServiceController::class, 'adminSpecialties']
        )->name('admin.specialties');

        Route::post(
            '/specialties',
            [AdminServiceController::class, 'createSpecialty']
        )->name('admin.specialties.create');

        Route::delete(
            '/specialties/{id}',
            [AdminServiceController::class, 'deleteOfficeSpecialty']
        )->name('admin.specialties.delete');


        // =========================================================
        // معلومات أنواع المكاتب
        // =========================================================
    
        Route::view(
            '/law-info',
            'update_service.Content.LawInfo'
        )->name('law.info');

        Route::view(
            '/accounting-info',
            'update_service.Content.AccountingInfo'
        )->name('accounting.info');

        Route::view(
            '/engineering-info',
            'update_service.Content.EngineeringInfo'
        )->name('engineering.info');

        Route::view(
            '/customs-info',
            'update_service.Content.CustomsInfo'
        )->name('customs.info');

        Route::view(
            '/services-info',
            'update_service.Content.ServicesInfo'
        )->name('services.info');

        Route::view(
            '/freelance-info',
            'update_service.Content.FreelanceInfo'
        )->name('freelance.info');


        // =========================================================
        // Login / Register
        // =========================================================
    
        Route::middleware('guest.office')->group(function () {

            Route::get(
                '/login',
                [OfficeAuthController::class, 'showLogin']
            )->name('login');

            Route::post(
                '/login',
                [OfficeAuthController::class, 'login']
            )->name('login.submit');

            Route::get(
                '/register',
                [OfficeAuthController::class, 'showRegister']
            )->name('register');

            Route::post(
                '/register',
                [OfficeAuthController::class, 'register']
            )->name('register.submit');
        });



        // =========================================================
        // Logout
        // =========================================================
    
        Route::post(
            '/logout',
            [OfficeAuthController::class, 'logout']
        )
            ->name('logout')
            ->middleware('auth.office');


        // =========================================================
        // استكمال بيانات المكتب
        // =========================================================
    
        Route::get(
            '/complete',
            [OfficeProfileController::class, 'show']
        )->name('complete');

        Route::post(
            '/complete',
            [OfficeProfileController::class, 'save']
        )->name('complete.save');

        Route::post(
            '/complete/submit',
            [OfficeProfileController::class, 'submit']
        )->name('complete.submit');


        // =========================================================
        // Dashboard المكتب
        // =========================================================
    
        Route::middleware([
            'auth.office',
            'complete.office.profile'
        ])->group(function () {

            Route::get(
                '/dashboard',
                [OfficeDashboardController::class, 'dashboard']
            )->name('dashboard');

            Route::get(
                '/profile',
                [OfficeDashboardController::class, 'profile']
            )->name('profile');

            Route::post(
                '/profile',
                [OfficeDashboardController::class, 'updateProfile']
            )->name('profile.update');


            // =====================================================
            // Dashboard API
            // =====================================================
    
            Route::prefix('api')
                ->name('api.')
                ->group(function () {

                    // Requests
                    Route::get(
                        '/requests',
                        [OfficeDashboardController::class, 'getRequests']
                    )->name('requests');

                    Route::get(
                        '/requests/{id}',
                        [OfficeDashboardController::class, 'getRequest']
                    )->name('request');

                    Route::put(
                        '/requests/{id}/status',
                        [OfficeDashboardController::class, 'updateStatus']
                    )->name('request.status');

                    Route::get(
                        '/requests/{id}/messages',
                        [OfficeDashboardController::class, 'getMessages']
                    )->name('messages');

                    Route::post(
                        '/requests/{id}/messages',
                        [OfficeDashboardController::class, 'sendMessage']
                    )->name('message.send');


                    // Stats
                    Route::get(
                        '/stats',
                        [OfficeDashboardController::class, 'stats']
                    )->name('stats');


                    // Services
                    Route::get(
                        '/services',
                        [OfficeDashboardController::class, 'listServices']
                    )->name('services');

                    Route::post(
                        '/services',
                        [OfficeDashboardController::class, 'createService']
                    )->name('services.create');

                    Route::put(
                        '/services/{id}',
                        [OfficeDashboardController::class, 'updateService']
                    )->name('services.update');

                    Route::delete(
                        '/services/{id}',
                        [OfficeDashboardController::class, 'deleteService']
                    )->name('services.delete');


                    // Direct Requests
                    Route::get(
                        '/direct-requests',
                        [OfficeDashboardController::class, 'directRequests']
                    )->name('direct-requests');

                    Route::put(
                        '/direct-requests/{id}/status',
                        [OfficeDashboardController::class, 'updateDirectRequestStatus']
                    )->name('direct-requests.status');


                    // Notifications
                    Route::get(
                        '/notifications',
                        [OfficeDashboardController::class, 'notifications']
                    )->name('notifications');

                    Route::post(
                        '/notifications/read-all',
                        [OfficeDashboardController::class, 'markAllNotifsRead']
                    )->name('notifications.read-all');

                    Route::post(
                        '/notifications/{id}/read',
                        [OfficeDashboardController::class, 'markNotifRead']
                    )->name('notifications.read');


                    // Financial
                    Route::get(
                        '/financial',
                        [OfficeDashboardController::class, 'financial']
                    )->name('financial');
                });
        });
    });


// =========================================================
// Provider Account Registration
// =========================================================

Route::get(
    '/amrtm/provider-account/create',
    [ProviderAccountController::class, 'create']
)->name('amrtm.provider.account.create');

Route::get(
    '/amrtm/provider-account/specialties',
    [ProviderAccountController::class, 'specialties']
)->name('amrtm.provider.account.specialties');

Route::post(
    '/amrtm/provider-account',
    [ProviderAccountController::class, 'store']
)->name('amrtm.provider.account.store');








// ── Jobs Platform ─────────────────────────────────────────────────────────────
Route::prefix('jobs')->name('jobs.')->group(function () {

    // صفحة البحث العامة
    Route::get('/', function () {
        $jobs = JobListing::where('status', 'active')->limit(4)->get();
        return view('jobs.welcome', ['jobs' => $jobs, 'jobsCount' => JobListing::count()]);
    })->name('index');

    Route::get('/search', function (\Illuminate\Http\Request $request) {
        $query = JobListing::where('status', 'active');
        if ($request->filled('title'))
            $query->where('title', 'like', '%' . $request->title . '%');
        if ($request->filled('location'))
            $query->where('location', $request->location);
        if ($request->filled('experience_level'))
            $query->where('experience_level', $request->experience_level);
        if ($request->filled('type'))
            $query->where('job_type', $request->type);
        $jobs = $query->paginate(10)->withQueryString();
        return view('jobs.search', ['jobs' => $jobs]);
    })->name('search');
    Route::get('/specializations', [JobSpecializationController::class, 'index'])
        ->name('specializations.index');
    // Auth
    Route::get('/register', [JobsRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [JobsRegisterController::class, 'register']);
    Route::get('/login', [JobsLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [JobsLoginController::class, 'login']);
    Route::post('/logout', [JobsLoginController::class, 'logout'])->name('logout');

    // Serve i18n translations as JS (avoids missing public file on server)
    Route::get('/i18n.js', function () {
        return response()->view('jobs.i18n-js')
            ->header('Content-Type', 'text/javascript')
            ->header('Cache-Control', 'public, max-age=86400');
    })->name('i18n-script');

    // IP Geo-detection proxy (avoids CORS issues with external APIs)
    Route::get('/geo', function () {
        $ip = request()->ip();
        // On local/private IP, default to SA
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return response()->json(['country_code' => 'SA']);
        }
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(3)->get("https://ipapi.co/{$ip}/json/");
            return response()->json($response->json());
        } catch (\Throwable $e) {
            return response()->json(['country_code' => 'SA']);
        }
    })->name('geo');

    // Cadres (public)
    Route::get('/cadres/apply', [CadresApplicationController::class, 'create'])->name('cadres.apply');
    Route::post('/cadres/apply', [CadresApplicationController::class, 'store'])->name('cadres.store');
    Route::get('/cadres/success', [CadresApplicationController::class, 'success'])->name('cadres.success');

    // Services (public)
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/executive-jobs', [JobsServices::class, 'executiveJobs'])->name('executive-jobs');
        Route::get('/professional-jobs', [JobsServices::class, 'professionalJobs'])->name('professional-jobs');
        Route::get('/administrative-jobs', [JobsServices::class, 'administrativeJobs'])->name('administrative-jobs');
        Route::get('/manpower-companies', [JobsServices::class, 'manpowerCompanies'])->name('manpower-companies');
        Route::get('/recruitment-companies', [JobsServices::class, 'recruitmentCompanies'])->name('recruitment-companies');
        Route::get('/staffing-companies', [JobsServices::class, 'staffingCompanies'])->name('staffing-companies');
    });

    // Protected (requires jobs guard)
    Route::middleware('auth:jobs')->group(function () {
        // Job CRUD
        Route::resource('listings', JobController::class)->except(['index', 'show']);
        Route::get('listings/{job}', [JobController::class, 'show'])->name('listings.show');

        // Dashboards
        Route::get('/company/dashboard', [JobsDashboard::class, 'company'])->name('company.dashboard');
        Route::get('/company/profile', [JobsDashboard::class, 'profile'])->name('company.profile');
        Route::get('/job-seeker/dashboard', [JobsDashboard::class, 'jobSeeker'])->name('jobseeker.dashboard');
    });
});
// this is a temporary route for testing, it will be removed later
Route::get('/favicon.svg', function () {
    $fullPath = base_path('dist/favicon.svg');
    abort_unless(File::isFile($fullPath), 404);

    return response()->file($fullPath, [
        'Content-Type' => 'image/svg+xml',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('dist.favicon');

Route::get('/assets/{path}', function (string $path) {
    abort_if(str_contains($path, '..'), 404);

    $fullPath = base_path('dist/assets/' . $path);
    abort_unless(File::isFile($fullPath), 404);

    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    $contentTypes = [
        'js' => 'application/javascript; charset=UTF-8',
        'mjs' => 'application/javascript; charset=UTF-8',
        'css' => 'text/css; charset=UTF-8',
        'svg' => 'image/svg+xml',
        'json' => 'application/json; charset=UTF-8',
        'map' => 'application/json; charset=UTF-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
    ];

    return response()->file($fullPath, [
        'Content-Type' => $contentTypes[$extension] ?? 'application/octet-stream',
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('dist.assets');

Route::get('/business-services/dist/{path}', function (string $path) {
    abort_if(str_contains($path, '..'), 404);

    $fullPath = base_path('dist/' . $path);
    abort_unless(File::isFile($fullPath), 404);

    $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    $contentTypes = [
        'js' => 'application/javascript; charset=UTF-8',
        'mjs' => 'application/javascript; charset=UTF-8',
        'css' => 'text/css; charset=UTF-8',
        'svg' => 'image/svg+xml',
        'json' => 'application/json; charset=UTF-8',
        'map' => 'application/json; charset=UTF-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
    ];

    return response()->file($fullPath, [
        'Content-Type' => $contentTypes[$extension] ?? 'application/octet-stream',
        'Cache-Control' => str_starts_with($path, 'assets/')
            ? 'public, max-age=31536000, immutable'
            : 'public, max-age=3600',
    ]);
})->where('path', '.*')->name('business-services.dist');

Route::get('/business-services/{path?}', function () {
    $indexPath = base_path('dist/index.html');
    abort_unless(File::isFile($indexPath), 404);

    $html = File::get($indexPath);
    $html = str_replace(
        ['href="/favicon.svg"', 'href="/assets/', 'src="/assets/'],
        [
            'href="/business-services/dist/favicon.svg"',
            'href="/business-services/dist/assets/',
            'src="/business-services/dist/assets/',
        ],
        $html,
    );

    return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
})->where('path', '.*')->name('business-services');

// ── Public pages (about, projects, agencies platform) ─────────────────────────
Route::get('/about', function () {
    return view('about'); })->name('about');
Route::get('/projects', function () {
    return view('projects'); })->name('projects');
Route::get('/brands-auction', [BrandsAuctionController::class, 'index'])->name('brands.auction');

// Intent route: auth middleware stores intended URL → after login sends user back here → reopens modal
Route::get('/brands-auction/intent', function (\Illuminate\Http\Request $req) {
    return redirect('/brands-auction?' . http_build_query([
        'open' => $req->query('brand', ''),
        'bid' => $req->query('bid', ''),
        'start' => $req->query('start', ''),
        'class' => $req->query('class', ''),
    ]));
})->middleware('auth')->name('brands.auction.intent');

// Auction detail + bid submission
Route::get('/brands-auction/auction/{auction}', [BrandsAuctionController::class, 'show'])->name('brands.auction.show');
Route::post('/brands-auction/auction/{auction}/bid', [BrandsAuctionController::class, 'bid'])->middleware('auth')->name('brands.auction.bid');

// Detail pages
Route::get('/brands-auction/franchise/{opportunity}', [BrandsAuctionController::class, 'franchiseDetail'])->name('brands.auction.franchise.show');
Route::get('/brands-auction/brand/{brand}', [BrandsAuctionController::class, 'brandDetail'])->name('brands.auction.brand.show');
Route::get('/brands-auction/agency/{agency}', [BrandsAuctionController::class, 'agencyDetail'])->name('brands.auction.agency.show');

// Franchise apply (public, AJAX)
Route::post('/franchise/apply', [FranchiseApplicationController::class, 'store'])->name('franchise.apply');
// Agencies — hidden from public nav/home; toggle via AGENCIES_ENABLED in .env
Route::get('/agencies', function () {
    return view('agencies_platform'); })->name('agencies');

// ── Amr Platform & Form ───────────────────────────────────────────────────────
Route::get('/media/public/{path}', function (string $path) {

    abort_if(str_contains($path, '..'), 404);

    $disk = Storage::disk('public');

    abort_unless($disk->exists($path), 404);

    $absolutePath = $disk->path($path);

    return response()->file($absolutePath, [
        'Content-Type' => mime_content_type($absolutePath),
        'Content-Disposition' => 'inline; filename="' . basename($absolutePath) . '"',
        'Cache-Control' => 'public, max-age=3600',
    ]);

})->where('path', '.*')->name('public.storage');
// Route::get('/venues', function () {
//     $featureCategories = \App\Models\PartnerCategory::orderBy('name')->pluck('name');
//     $partnersByCategory = \App\Models\PartnerCategory::with('partners')
//         ->orderBy('name')
//         ->get()
//         ->mapWithKeys(fn($cat) => [
//             $cat->name => $cat->partners->map(fn($p) => [
//                 'name'     => $p->company_name,
//                 'logo_url' => $p->logo_url,
//             ])->values(),
//         ])
//         ->toArray();
//     return view('venue_select', compact('featureCategories', 'partnersByCategory'));
// })->name('hall.select');

Route::get('/halls_list', [HallController::class, 'index'])->name('halls.list');
Route::get('/halls/{hall}', [HallController::class, 'show'])->name('halls.show');
Route::get('/halls/{hall}/qr-code.svg', [HallController::class, 'qrCode'])->name('halls.qr');

// Public services/partners list
Route::get('/services', function () {
    $categories = \App\Models\PartnerCategory::withCount('partners')
        ->orderBy('name')
        ->get();

    $partners = \App\Models\Partner::with(['category', 'media', 'services'])
        ->where('status', 'active')
        ->orderByDesc('created_at')
        ->get();

    $officiants = \App\Models\Officiant::with(['user', 'services', 'media'])
        ->whereHas('user')
        ->where('status', 'active')
        ->orderByDesc('created_at')
        ->get();

    return view('services_list', compact('categories', 'partners', 'officiants'));
})->name('services.list');

// Service Bookings
Route::middleware('auth')->post('/partners/{partner}/book', [\App\Http\Controllers\ServiceBookingController::class, 'store'])->name('partner.book.store');

// ── Cart / Basket ─────────────────────────────────────────────────────────────
Route::middleware('auth')->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/order', [CartController::class, 'placeOrder'])->name('place-order');
    Route::get('/confirmation/{order}', [CartController::class, 'confirmation'])->name('confirmation');
});

// Partner profile (public)
Route::get('/partners/{partner}', [\App\Http\Controllers\Service\PartnerProfileController::class, 'show'])->name('partners.profile');

// Officiant profile (public)
Route::get('/officiants/{officiant}', [\App\Http\Controllers\Service\OfficiantProfileController::class, 'show'])->name('officiants.profile');
Route::get('/officiants/{officiant}/qr-code.svg', [\App\Http\Controllers\Service\OfficiantProfileController::class, 'qrCode'])->name('officiants.qr');

// User bookings (my requests)
Route::middleware('auth')->get('/my-bookings', [\App\Http\Controllers\User\BookingsController::class, 'index'])->name('user.my-bookings');
Route::middleware('auth')->post('/officiants/{officiant}/book', [\App\Http\Controllers\Service\OfficiantBookingController::class, 'store'])->name('officiant.book.store');

// ── Consultants (static pages) ────────────────────────────────────────────────
Route::get('/consultants', function () {
    return view('consultants'); })->name('consultants');
Route::get('/consultants-list', function () {
    return view('consultants_list'); })->name('consultants.list');
Route::get('/consultant-profile', function () {
    return view('consultant_profile'); })->name('consultant.profile');
Route::get('/booking-confirm', function () {
    return view('booking_confirm'); })->name('booking.confirm');
Route::get('/service-details', function () {
    return view('service_details'); })->name('service.details');

// Static pages
Route::get('/privacy', function () {
    return view('privacy'); })->name('privacy');

// Contact page
Route::get('/contact', function () {
    return view('contact'); })->name('contact');
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'email' => ['required', 'email', 'max:150'],
        'subject' => ['required', 'string', 'max:100'],
        'message' => ['required', 'string', 'max:3000'],
        'phone' => ['nullable', 'string', 'max:20'],
    ]);
    return back()->with('contact_success', 'تم إرسال رسالتك بنجاح! سيتواصل معك فريقنا قريباً.');
})->name('contact.send');

// Booking form (requires login)
Route::get('/halls/{hall}/booking', [HallController::class, 'bookingForm'])->name('halls.booking')->middleware('auth');
Route::post('/halls/{hall}/book', [HallController::class, 'book'])->name('halls.book')->middleware('auth');

// Hall request (owner only)
Route::get('/hall-request', [HallController::class, 'requestForm'])->name('halls.request')->middleware(['auth', 'role:owner']);
Route::post('/hall-request', [HallController::class, 'submitRequest'])->name('halls.request.submit')->middleware(['auth', 'role:owner']);

// ── OTP Verification ─────────────────────────────────────────────────────────
Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.show');
Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify');
Route::post('/verify-otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

// ── Auth ──────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/register/owner', [RegisterController::class, 'showOwnerForm'])->name('register.owner');
    Route::post('/register/owner', [RegisterController::class, 'registerOwner'])->name('register.owner.submit');
    Route::get('/register/officiant', [RegisterController::class, 'showOfficiantForm'])->name('register.officiant');
    Route::post('/register/officiant', [RegisterController::class, 'registerOfficiant'])->name('register.officiant.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── Owner Dashboard ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:owner', 'owner.onboarded'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('dashboard');

        // Application status pages (accessible regardless of approval status)
        Route::get('/application-pending', [OwnerDashboard::class, 'applicationPending'])->name('application-pending');
        Route::get('/application-rejected', [OwnerDashboard::class, 'applicationRejected'])->name('application-rejected');

        // Route::get('/venues', function () { return view('venue_select'); })->name('venues');
    
        // Hall Info
        Route::get('/hall-info', [OwnerDashboard::class, 'hallInfo'])->name('hall-info');
        Route::post('/hall-info', [OwnerDashboard::class, 'saveHallInfo'])->name('hall-info.save');

        // Media
        Route::get('/media', [OwnerDashboard::class, 'media'])->name('media');
        Route::post('/media', [OwnerDashboard::class, 'uploadMedia'])->name('media.upload');
        Route::delete('/media/{id}', [OwnerDashboard::class, 'deleteMedia'])->name('media.delete');

        // Features
        Route::get('/features', [OwnerDashboard::class, 'features'])->name('features');
        Route::post('/features', [OwnerDashboard::class, 'saveFeatures'])->name('features.save');

        // Seasonal Prices
        Route::get('/seasonal-prices', [OwnerDashboard::class, 'seasonalPrices'])->name('seasonal-prices');
        Route::post('/seasonal-prices', [OwnerDashboard::class, 'saveSeasonalPrice'])->name('seasonal-prices.save');
        Route::put('/seasonal-prices/{id}', [OwnerDashboard::class, 'updateSeasonalPrice'])->name('seasonal-prices.update');
        Route::delete('/seasonal-prices/{id}', [OwnerDashboard::class, 'deleteSeasonalPrice'])->name('seasonal-prices.delete');

        // Offers
        Route::get('/offers', [OwnerDashboard::class, 'offers'])->name('offers');
        Route::post('/offers', [OwnerDashboard::class, 'saveOffer'])->name('offers.save');
        Route::post('/offers/{id}/toggle', [OwnerDashboard::class, 'toggleOffer'])->name('offers.toggle');
        Route::delete('/offers/{id}', [OwnerDashboard::class, 'deleteOffer'])->name('offers.delete');

        // Busy Dates
        Route::get('/busy-dates', [OwnerDashboard::class, 'busyDates'])->name('busy-dates');
        Route::post('/busy-dates', [OwnerDashboard::class, 'addBusyDate'])->name('busy-dates.add');
        Route::delete('/busy-dates/{id}', [OwnerDashboard::class, 'removeBusyDate'])->name('busy-dates.remove');

        // Bookings
        Route::get('/bookings', [OwnerDashboard::class, 'bookings'])->name('bookings');
        Route::post('/bookings/{id}/status', [OwnerDashboard::class, 'updateBookingStatus'])->name('bookings.status');

        // Documents
        Route::get('/documents', [OwnerDashboard::class, 'documents'])->name('documents');
        Route::post('/documents', [OwnerDashboard::class, 'uploadDocument'])->name('documents.upload');

        // Partners
        Route::get('/partners', [OwnerDashboard::class, 'partners'])->name('partners');
        Route::post('/partners', [OwnerDashboard::class, 'savePartner'])->name('partners.save');
        Route::delete('/partners/{id}', [OwnerDashboard::class, 'deletePartner'])->name('partners.delete');
        // Additional Features
        Route::get('/additional-features', [OwnerDashboard::class, 'additionalFeatures'])->name('additional-features');
        Route::post('/additional-features', [OwnerDashboard::class, 'saveAdditionalFeatures'])->name('additional-features.save');
        Route::delete('/additional-features/{id}', [OwnerDashboard::class, 'deleteAdditionalFeature'])->name('additional-features.delete');
    });

// ── Partner Dashboard ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:partner', 'partner.onboarded'])
    ->prefix('partner')
    ->name('partner.')
    ->group(function () {
        Route::get('/dashboard', [PartnerDashboard::class, 'index'])->name('dashboard');

        // Status pages
        Route::get('/profile-setup', [PartnerDashboard::class, 'profileSetup'])->name('profile-setup');
        Route::post('/profile-setup', [PartnerDashboard::class, 'saveProfile'])->name('profile-setup.save');
        Route::get('/application-pending', [PartnerDashboard::class, 'applicationPending'])->name('application-pending');
        Route::get('/application-rejected', [PartnerDashboard::class, 'applicationRejected'])->name('application-rejected');

        // Media
        Route::get('/media', [PartnerDashboard::class, 'media'])->name('media');
        Route::post('/media', [PartnerDashboard::class, 'uploadMedia'])->name('media.upload');
        Route::delete('/media/{media}', [PartnerDashboard::class, 'deleteMedia'])->name('media.delete');

        // Services
        Route::get('/services', [PartnerDashboard::class, 'services'])->name('services');
        Route::post('/services', [PartnerDashboard::class, 'storeService'])->name('services.store');
        Route::delete('/services/{service}', [PartnerDashboard::class, 'deleteService'])->name('services.delete');
    });


// ── Officiant Dashboard ───────────────────────────────────────────────────────
Route::middleware(['auth', 'role:officiant', 'officiant.onboarded'])
    ->prefix('officiant')
    ->name('officiant.')
    ->group(function () {
        Route::get('/dashboard', [OfficiantDashboard::class, 'index'])->name('dashboard');

        // Status pages
        Route::get('/profile-setup', [OfficiantDashboard::class, 'profileSetup'])->name('profile-setup');
        Route::post('/profile-setup', [OfficiantDashboard::class, 'saveProfile'])->name('profile-setup.save');
        Route::get('/application-pending', [OfficiantDashboard::class, 'applicationPending'])->name('application-pending');
        Route::get('/application-rejected', [OfficiantDashboard::class, 'applicationRejected'])->name('application-rejected');

        // Media
        Route::get('/media', [OfficiantDashboard::class, 'media'])->name('media');
        Route::post('/media', [OfficiantDashboard::class, 'uploadMedia'])->name('media.upload');
        Route::delete('/media/{media}', [OfficiantDashboard::class, 'deleteMedia'])->name('media.delete');

        // Services
        Route::get('/services', [OfficiantDashboard::class, 'services'])->name('services');
        Route::post('/services', [OfficiantDashboard::class, 'storeService'])->name('services.store');
        Route::delete('/services/{service}', [OfficiantDashboard::class, 'deleteService'])->name('services.delete');

        // Bookings
        Route::get('/bookings', [OfficiantDashboard::class, 'bookings'])->name('bookings');
        Route::patch('/bookings/{booking}/status', [OfficiantDashboard::class, 'updateBookingStatus'])->name('bookings.status');
    });

// ── Admin Dashboard (redirects → supervisor) ─────────────────────────────────
// Admin role has been unified into Supervisor. These named routes are kept so
// any bookmarked /admin/* URLs redirect gracefully.
Route::middleware(['auth', 'role:supervisor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => redirect()->route('supervisor.dashboard'))->name('dashboard');
        Route::get('/approvals', fn() => redirect()->route('supervisor.approvals'))->name('approvals');
        Route::get('/approvals/{id}/review', fn($id) => redirect()->route('supervisor.approvals.review', $id))->name('approvals.review');
        Route::any('/approvals/{id}/process', fn($id) => redirect()->route('supervisor.approvals.process', $id))->name('approvals.process');
        Route::get('/halls', fn() => redirect()->route('supervisor.halls'))->name('halls');
        Route::any('/halls/{id}/status', fn($id) => redirect()->route('supervisor.halls.status', $id))->name('halls.status');
        Route::get('/halls/{id}/review', fn($id) => redirect()->route('supervisor.halls.review', $id))->name('halls.review');
        Route::any('/halls/{id}/decide', fn($id) => redirect()->route('supervisor.halls.decide', $id))->name('halls.decide');
        Route::get('/users', fn() => redirect()->route('supervisor.users'))->name('users');
        Route::get('/bookings', fn() => redirect()->route('supervisor.bookings'))->name('bookings');
    });

// ── Supervisor Dashboard ──────────────────────────────────────────────────────
Route::middleware(['auth', 'role:supervisor'])
    ->prefix('supervisor')
    ->name('supervisor.')
    ->group(function () {
        Route::get('/dashboard', [SupervisorDashboard::class, 'index'])->name('dashboard');
        Route::get('/users', [SupervisorDashboard::class, 'users'])->name('users');
        Route::get('/users/create', [SupervisorDashboard::class, 'createUser'])->name('users.create');
        Route::post('/users', [SupervisorDashboard::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [SupervisorDashboard::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [SupervisorDashboard::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [SupervisorDashboard::class, 'deleteUser'])->name('users.delete');
        Route::get('/referrals', [SupervisorDashboard::class, 'referrals'])->name('referrals');
        Route::post('/referrals/{id}/confirm', [SupervisorDashboard::class, 'confirmReferral'])->name('referrals.confirm');
        Route::get('/financials', [SupervisorDashboard::class, 'financials'])->name('financials');
        Route::get('/halls', [SupervisorDashboard::class, 'halls'])->name('halls');
        Route::get('/hall-requests', [SupervisorDashboard::class, 'hallRequests'])->name('hall-requests');
        Route::post('/halls/{id}/status', [SupervisorDashboard::class, 'updateHallStatus'])->name('halls.status');
        Route::get('/halls/{id}/review', [SupervisorDashboard::class, 'reviewHall'])->name('halls.review');
        Route::post('/halls/{id}/decide', [SupervisorDashboard::class, 'decideHall'])->name('halls.decide');
        Route::get('/bookings', [SupervisorDashboard::class, 'bookings'])->name('bookings');
        Route::get('/approvals', [SupervisorDashboard::class, 'approvals'])->name('approvals');
        Route::get('/approvals/{id}/review', [SupervisorDashboard::class, 'reviewDocument'])->name('approvals.review');
        Route::post('/approvals/{id}/process', [SupervisorDashboard::class, 'processApproval'])->name('approvals.process');
        // Partners & Categories
        Route::get('/partners', [SupervisorDashboard::class, 'partners'])->name('partners');
        Route::post('/partners', [SupervisorDashboard::class, 'savePartner'])->name('partners.save');
        Route::delete('/partners/{id}', [SupervisorDashboard::class, 'deletePartner'])->name('partners.delete');
        Route::post('/partner-categories', [SupervisorDashboard::class, 'saveCategory'])->name('partner-categories.save');
        Route::delete('/partner-categories/{id}', [SupervisorDashboard::class, 'deleteCategory'])->name('partner-categories.delete');
        // Partner Accounts (create / manage)
        Route::get('/partner-accounts', [SupervisorPartnerController::class, 'index'])->name('partner-accounts.index');
        Route::get('/partner-accounts/create', [SupervisorPartnerController::class, 'create'])->name('partner-accounts.create');
        Route::post('/partner-accounts', [SupervisorPartnerController::class, 'store'])->name('partner-accounts.store');
        Route::get('/partner-accounts/{partner}', [SupervisorPartnerController::class, 'show'])->name('partner-accounts.show');
        Route::patch('/partner-accounts/{partner}/status', [SupervisorPartnerController::class, 'updateStatus'])->name('partner-accounts.status');
        Route::delete('/partner-accounts/{partner}', [SupervisorPartnerController::class, 'destroy'])->name('partner-accounts.destroy');

        // Franchise Brands Management
        Route::get('/brands', [FranchiseBrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [FranchiseBrandController::class, 'create'])->name('brands.create');
        Route::post('/brands', [FranchiseBrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [FranchiseBrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [FranchiseBrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [FranchiseBrandController::class, 'destroy'])->name('brands.destroy');
        Route::delete('/brands/images/{image}', [FranchiseBrandController::class, 'deleteImage'])->name('brands.images.delete');

        // Franchise opportunities
        Route::get('/franchise', [FranchiseOpportunityController::class, 'index'])->name('franchise.index');
        Route::get('/franchise/create', [FranchiseOpportunityController::class, 'create'])->name('franchise.create');
        Route::post('/franchise', [FranchiseOpportunityController::class, 'store'])->name('franchise.store');
        Route::get('/franchise/{franchise}/edit', [FranchiseOpportunityController::class, 'edit'])->name('franchise.edit');
        Route::put('/franchise/{franchise}', [FranchiseOpportunityController::class, 'update'])->name('franchise.update');
        Route::delete('/franchise/{franchise}', [FranchiseOpportunityController::class, 'destroy'])->name('franchise.destroy');
        Route::post('/franchise/{franchise}/toggle', [FranchiseOpportunityController::class, 'toggle'])->name('franchise.toggle');

        // Commercial Agencies
        Route::get('/agencies', [CommercialAgenciesController::class, 'index'])->name('agencies.index');
        Route::get('/agencies/create', [CommercialAgenciesController::class, 'create'])->name('agencies.create');
        Route::post('/agencies', [CommercialAgenciesController::class, 'store'])->name('agencies.store');
        Route::get('/agencies/{agency}/edit', [CommercialAgenciesController::class, 'edit'])->name('agencies.edit');
        Route::put('/agencies/{agency}', [CommercialAgenciesController::class, 'update'])->name('agencies.update');
        Route::delete('/agencies/{agency}', [CommercialAgenciesController::class, 'destroy'])->name('agencies.destroy');
        Route::post('/agencies/{agency}/toggle', [CommercialAgenciesController::class, 'toggle'])->name('agencies.toggle');

        // Page sliders
        Route::get('/sliders', [PageSliderController::class, 'index'])->name('sliders.index');
        Route::get('/sliders/create', [PageSliderController::class, 'create'])->name('sliders.create');
        Route::post('/sliders', [PageSliderController::class, 'store'])->name('sliders.store');
        Route::get('/sliders/{slider}/edit', [PageSliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/sliders/{slider}', [PageSliderController::class, 'update'])->name('sliders.update');
        Route::delete('/sliders/{slider}', [PageSliderController::class, 'destroy'])->name('sliders.destroy');
        Route::post('/sliders/{slider}/toggle', [PageSliderController::class, 'toggle'])->name('sliders.toggle');

        // Franchise applications
        Route::get('/franchise-applications', [\App\Http\Controllers\Supervisor\FranchiseApplicationsController::class, 'index'])->name('franchise-applications.index');
        Route::patch('/franchise-applications/{app}/status', [\App\Http\Controllers\Supervisor\FranchiseApplicationsController::class, 'updateStatus'])->name('franchise-applications.status');
        Route::delete('/franchise-applications/{app}', [\App\Http\Controllers\Supervisor\FranchiseApplicationsController::class, 'destroy'])->name('franchise-applications.destroy');

        // Halls supervisor create
        Route::get('/halls/create', [\App\Http\Controllers\Supervisor\HallController::class, 'create'])->name('halls.create');
        Route::post('/halls', [\App\Http\Controllers\Supervisor\HallController::class, 'store'])->name('halls.store');
    });

// ── Agent Dashboard ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:agent'])
    ->prefix('agent')
    ->name('agent.')
    ->group(function () {
        Route::get('/dashboard', [AgentDashboard::class, 'index'])->name('dashboard');
        Route::get('/hall-owner-registration', [AgentDashboard::class, 'createHallOwner'])->name('hall-owner-registration.create');
        Route::get('/referrals', [AgentDashboard::class, 'referrals'])->name('referrals');
        Route::post('/hall-owner-registration', [AgentDashboard::class, 'storeHallOwner'])->name('hall-owner-registration.store');
        Route::get('/halls', [AgentDashboard::class, 'halls'])->name('halls');
    });

// ── Manager Dashboard ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/dashboard', [ManagerDashboard::class, 'index'])->name('dashboard');
        // Referrals
        Route::get('/referrals', [ManagerDashboard::class, 'referrals'])->name('referrals');
        Route::post('/referrals/{id}/decide', [ManagerDashboard::class, 'decide'])->name('referrals.decide');
        // Agents
        Route::get('/agents', [ManagerDashboard::class, 'agents'])->name('agents');
        Route::get('/agents/create', [ManagerDashboard::class, 'createAgent'])->name('agents.create');
        Route::post('/agents', [ManagerDashboard::class, 'storeAgent'])->name('agents.store');
        // Halls
        Route::get('/halls', [ManagerDashboard::class, 'halls'])->name('halls');
        Route::get('/halls/requests', [ManagerDashboard::class, 'hallRequests'])->name('hall-requests');
        Route::get('/halls/{id}/review', [ManagerDashboard::class, 'reviewHallRequest'])->name('halls.review');
        Route::post('/halls/{id}/decide', [ManagerDashboard::class, 'decideHallRequest'])->name('halls.decide');
        Route::get('/halls/create', [ManagerDashboard::class, 'createHall'])->name('halls.create');
        Route::post('/halls', [ManagerDashboard::class, 'storeHall'])->name('halls.store');
        // Bookings
        Route::get('/bookings', [ManagerDashboard::class, 'bookings'])->name('bookings');
        // Partners & Categories (old supervisor-style list)
        Route::get('/partners', [ManagerDashboard::class, 'partners'])->name('partners');
        Route::post('/partners', [ManagerDashboard::class, 'savePartner'])->name('partners.save');
        Route::delete('/partners/{id}', [ManagerDashboard::class, 'deletePartner'])->name('partners.delete');
        Route::post('/partner-categories', [ManagerDashboard::class, 'saveCategory'])->name('partner-categories.save');
        Route::delete('/partner-categories/{id}', [ManagerDashboard::class, 'deleteCategory'])->name('partner-categories.delete');
        // Partner Accounts (create / manage) — same controller as supervisor
        Route::get('/partner-accounts', [SupervisorPartnerController::class, 'index'])->name('partner-accounts.index');
        Route::get('/partner-accounts/create', [SupervisorPartnerController::class, 'create'])->name('partner-accounts.create');
        Route::post('/partner-accounts', [SupervisorPartnerController::class, 'store'])->name('partner-accounts.store');
        Route::get('/partner-accounts/{partner}', [SupervisorPartnerController::class, 'show'])->name('partner-accounts.show');
        Route::patch('/partner-accounts/{partner}/status', [SupervisorPartnerController::class, 'updateStatus'])->name('partner-accounts.status');
        Route::delete('/partner-accounts/{partner}', [SupervisorPartnerController::class, 'destroy'])->name('partner-accounts.destroy');
    });


//More info about Offices
Route::view('/law-info', 'update_service.Content.LawInfo')
    ->name('law.info');

Route::view('/accounting-info', 'update_service.Content.AccountingInfo')
    ->name('accounting.info');

Route::view('/engineering-info', 'update_service.Content.EngineeringInfo')
    ->name('engineering.info');

Route::view('/customs-info', 'update_service.Content.CustomsInfo')
    ->name('customs.info');

Route::view('/services-info', 'update_service.Content.ServicesInfo')
    ->name('services.info');

Route::view('/freelance-info', 'update_service.Content.FreelanceInfo')
    ->name('freelance.info');
