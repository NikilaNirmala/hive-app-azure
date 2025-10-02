<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RequestController as ModelRequest;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Models\Advertisement;
use App\Models\Review;
use Illuminate\Http\Request;


// routes/web.php

//////////////////////////////////////////////////////////////////////
// GUEST ROUTES : Less strict on authentication
//////////////////////////////////////////////////////////////////////


Route::get('/', function () {
    return view('guest.home', [ 'advertisements' => Advertisement::orderBy('created_at', 'desc')->limit(4)->get(),
    'reviews' => Review::limit(3)->get()
]);
})->name('home');;

Route::get('/about', function() {
    return view('guest.about');
})->name('about');

Route::get('/services', function() {
    return view('guest.services');
})->name('services');


Route::get('/properties', function(Request $request) {
    return view('guest.properties', ['advertisements' => Advertisement::where('user_id', '!=', $request->user()?->id)->where('admin_id', '!=', null)->paginate(8)]);
})->name('properties');

Route::get('/review_form', function () {
   return view('guest.review');
})->name('review');

Route::post('/review_form', [ReviewController::class, 'submit']
)->name('review.submit');

Route::get('/properties/search', [AdvertisementController::class, 'search'])->name('properties.search');




////////////////////////////////////////////////////////////////////////////////
// ADMIN ROUTES (Admin Users only)
////////////////////////////////////////////////////////////////////////////////


Route::middleware(['auth', 'limit.user:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/ads', [AdminController::class, 'manageAds'])->name('admin.ads');
});



//////////////////////////////////////////////////////////////////////////////////
// AGENT ROUTES (Agent users only)
/////////////////////////////////////////////////////////////////////////////////


Route::middleware(['auth', 'limit.user:agent'])->group(function () {
    Route::get('/agent/requests', [AgentController::class, 'requests'])->name('agent.requests');
});




///////////////////////////////////////////////////////////////////////////////////////////////
// MEMBER ROUTES (Member users only)
//////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth', 'limit.user:member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
    Route::get('/member/request', [MemberController::class, 'sendRequest'])->name('member.request');
    Route::get('/member/advertisement/add', [AdvertisementController::class, 'addAdvertisement'])->name('member.add');
    Route::post('/member/advertisement/store', [AdvertisementController::class, 'store'])->name('advertisement.store');
    Route::get('/member/advertisement/{ad_id}', [AdvertisementController::class, 'edit'])->name('advertisement.edit');
    Route::put('/advertisement/update/{ad_id}', [AdvertisementController::class, 'update'])->name('advertisement.update');
    Route::post('/request/store', [ModelRequest::class, 'store'])->name('request.store');
    Route::get('/member/transactions', [TransactionController::class, 'load'])->name('member.transaction');
    Route::get('advertisement/{ad_id}', function ($ad_id, Request $request) {
    $advertisement = Advertisement::findOrFail($ad_id);
    if ($request->user()->id != $advertisement->user_id && $advertisement->admin_id != null){
        return view('advertisements.show', compact('advertisement'));
    } else {
        abort(404);
    }
})->name('ad.show');

Route::get('/purchase/{ad_id}', [TransactionController::class, 'purchase'])->name('purchase');


});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'redirect'])->name('dashboard');
});

