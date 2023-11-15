<?php

use App\Http\Controllers\PostController;
use App\Mail\OrderShipper;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('post', PostController::class);

Route::get('posts/trashed', [PostController::class, 'trashed'])->name('post.trashed');

Route::get('posts/{id}/restore', [PostController::class, 'restore'])->name('post.restore');

Route::delete('posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('post.force_delete');


// Route methods

/**
 * GET - Request a resource
 * POST - Create a new resource
 * PUT - Update a resource
 * PATCH - Modify a resource
 * DELETE - Delete a resource
 */

/** Fallback route */
Route::fallback(function () {
    return "404 Not Found";
});


Route::get('/unavailable', function () {
    return view('unavailable');
})->name('unavailable');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('contact', function () {
    $posts = Post::all();
    return view('contact', compact('posts'));
});

Route::get('send-mail', function () {
    // Mail::raw('Hello my friend!', function ($message) {
    //     $message->to('test@gmail.com')->subject('noreplay');
    // });

    Mail::send(new OrderShipper);
    echo 'success';
});

Route::get('get-session', function (Request $request) {
    $data = session()->all();
    // $data = $request->session()->get('_token');
    dd($data);
});

Route::get('save-session', function (Request $request) {
    // $request->session()->put('user_id', '123');
    // $request->session()->put([
    //     'user_status' => 'logged_in'
    // ]);

    session(['user_ip' => '123.23.11']);
    return redirect('get-session');
});

Route::get('delete-session', function (Request $request) {
    // $request->session()->forget('user_ip');
    session()->flush();
    return redirect('get-session');
});

Route::get('flash-session', function (Request $request) {
    $request->session()->flash('status', 'true');
    return redirect('get-session'); 
});
