<?php

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\PublishedNotesController;


//Published Notes Route
Route::get('/', [PublishedNotesController::class,'index']);

//USER ROUTES
Route::get('/login', function () {return view('login');})->name('login');
Route::get('/register', function () {return view('register');})->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['role:user|publisher|admin','auth']], function () {
    Route::get('/home', function () {
        $username = auth()->user()->name;
        $notes = [];
        if(auth()->user()){
            $notes = auth()->user()->userNotes()->latest()->get();
        }
        return view('home', compact(['username', 'notes']));
    })->name('home');
    Route::post('/create-note', [NoteController::class,'createNote'])->name('createNote');
    Route::get('/edit-note/{note}',[NoteController::class, 'editNote']);
    Route::put('/edit-note/{note}',[NoteController::class, 'updateNote']);
    Route::delete('/delete-note/{note}',[NoteController::class, 'deleteNote']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

//ADMIN ROUTES
Route::get('/admin',function(){
    return view('admin.login');
})->name('admin');


Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');
Route::get('/admin/register', function () {
    return view('admin.register');
})->name('admin.register');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::post('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register');

Route::group(['middleware' => ['role:admin']], function () {
    Route::group(['prefix' => 'admin'],function(){  
        Route::get('/dashboard',function(){
            $adminname = auth()->user()->name;
            $users = User::all();
            $notes = Note::all();
            return view('admin.dashboard', compact(['users', 'notes','adminname']));
        })->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
        Route::delete('/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::put('/makeAdmin/{user}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');
        Route::get('/user-notes/{user}', [AdminController::class, 'userNotes'])->name('admin.userNotes');
        Route::delete('/delete-note/{note}',[AdminController::class, 'deleteNote'])->name('admin.deleteNote');
        Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
        Route::get('/edit-note/{note}',[AdminController::class, 'editNotes'])->name('admin.editNotes');
        Route::put('/edit-note/{note}',[AdminController::class, 'updateNotes'])->name('admin.updateNotes');
    });
});

//publisher routes
Route::get('/publisher',function(){
    return view('publisher.login');
})->name('publisher');

Route::get('/publisher/login', function () {
    return view('publisher.login');
})->name('publisher.login');

Route::get('/publisher/register', function () {
    return view('publisher.register');
})->name('publisher.register');

Route::post('/publisher/login', [PublisherController::class, 'publisherLogin'])->name('publisher.login');
Route::post('/publisher/register', [PublisherController::class, 'publisherRegister'])->name('publisher.register');

Route::group(['middleware' => ['role:publisher']], function () {
    Route::group(['prefix' => 'publisher'],function(){  
        Route::get('/dashboard',function(){
            $publishername = auth()->user()->name;
            $users = User::all();
            $notes = Note::all();
            return view('publisher.dashboard', compact(['users', 'notes','publishername']));
        })->name('publisher.dashboard');
        Route::get('/user-notes/{user}', [PublisherController::class, 'userNotes'])->name('publisher.userNotes');
        Route::put('/changeStatus/{note}', [PublisherController::class, 'changeStatus'])->name('publisher.changeStatus');
        Route::post('/logout', [PublisherController::class, 'publisherLogout'])->name('publisher.logout');
    });
});
