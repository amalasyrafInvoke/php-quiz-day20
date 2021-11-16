<?php

use App\Http\Controllers\AdminController;
use App\Mail\QueueEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('create-user', function(){

    $user = new User();
    $user->name = 'Ching Sue Hok';
    $user->email = 'suehok@getcto.com';
    $user->password = bcrypt('password');
    $user->save();

    return response()->json('user created');

});

Route::get('queue-email', function(){

    $email_list['email'] = 'suehok@gmail.com';
    $user = User::whereId(2)->first();
    $email_list['user'] = $user;
    dispatch(new \App\Jobs\QueueJob($email_list));


    // $email = new QueueEmail($email_list);
    // Mail::to($email_list['email'])->send($email);

    return response()->json($email_list['email']);

    // dd('Send Email Successfully');
});


Route::prefix('admin')->group(function () {
    Route::any('/login', [AdminController::class, 'index'])->name('login');

    Route::group([
        'middleware' => 'auth',
    ], function () {
        Route::any('/dashboard', [AdminController::class, 'dasboard'])->name('admin.dashboard');
        Route::any('/user', [AdminController::class, 'user'])->name('admin.user');
    });

});
