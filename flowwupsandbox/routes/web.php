<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    // return redirect()->route('dashboard');
    return view('dashboard');
    // return redirect()->route('roadmap.public');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboardv1', function () {
    return view('dashboardv1');
})->name('dashboardv1');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/posts/{id}', function ($id) {
    return view('livewire.posts-home',array($id));
})->name('dashboard.posts');



use App\Http\Livewire\CreatePost;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/createpost',CreatePost::class )->name('post.create');
use App\Http\Livewire\EditPost;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/editpost/{id}',EditPost::class )->name('post.edit');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/stripe/checkout', [\App\Http\Controllers\StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/portal', [\App\Http\Controllers\StripeController::class, 'portal'])->name('stripe.portal');
});

Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\WebhookController@handleWebhook'
);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/billing', function() {
        return view('billing');
    })->name('billing');
});

//Create Board
/*
Route::middleware('auth:sanctum')->get('/dashboard/create-board', function () {
    //return $request->user();
    //dd("Creating a board");

    //$user = Auth::user();
    //dd($user);
    return view('livewire/boards/create-board');
});
*/


use App\Http\Livewire\Createboard;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/createboard', Createboard::class);

use App\Http\Livewire\BoardsHome;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/boards', BoardsHome::class);

use App\Http\Livewire\BoardSetting;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/boardsetting/{id}', BoardSetting::class)->name('dashboard.boardsetting');

use App\Http\Livewire\CreateCategory;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/createcategory', CreateCategory::class);

use App\Http\Livewire\ShareBoard;
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/shareboard/{id}', ShareBoard::class)->name('dashboard.shareboard');


use App\Http\Livewire\RoadmapPublic;
Route::get('/roadmap', RoadmapPublic::class)->name('roadmap.public');

use App\Http\Livewire\ShowPublicBoard;
Route::get('/boards/{id}', ShowPublicBoard::class)->name('showboard.public');

use App\Http\Livewire\ShowPublicPost;
Route::get('/posts/{id}', ShowPublicPost::class)->name('showpost.public');


Route::get('storage/profile-photos/{image}', function($image = null)
{
    
    $path = storage_path().'/app/public/profile-photos/' . $image;
    if (file_exists($path)) { 
        return Response::download($path);
    }
});