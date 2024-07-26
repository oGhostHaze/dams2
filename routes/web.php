<?php

use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\DarkModeController;
use App\Http\Livewire\Pages\Dashboard;
use App\Http\Livewire\Pages\ManageFiles;
use App\Http\Livewire\Pages\ManageFileTypes;
use App\Http\Livewire\Pages\ManageFileTypeSecondaries;
use App\Http\Livewire\Pages\ManageFileTypeTertiaries;
use App\Http\Livewire\Pages\ManageFileTypeTertiariesSub;
use App\Http\Livewire\Pages\UploadFile;
use App\Http\Livewire\Pages\UploadFileSecondary;
use App\Http\Livewire\Pages\ViewFile;
use App\Http\Livewire\PdfViewer;
use App\Http\Livewire\References\ManageTypes;
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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

// Route::middleware('guest')->get('/login', function () {
//     return view('auth.login');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/top-menu/dashboard', Dashboard::class)->name('top.dashboard');

    Route::get('/pdf-viewer/{archive_id?}', PdfViewer::class)->name('viewer');
    Route::get('/file/viewer/{archive_id}', ViewFile::class)->name('file.view');
    Route::get('/file-search', ManageFiles::class)->name('file.search');
    Route::get('/types', ManageFileTypes::class)->name('type.manager');
    Route::get('/types/{type_id}/second-level', ManageFileTypeSecondaries::class)->name('type.second.manager');
    Route::get('/types/{type_id}/third-level', ManageFileTypeTertiaries::class)->name('type.third.manager');
    Route::get('/types/{type_id}/fourth-level', ManageFileTypeTertiariesSub::class)->name('type.fourth.manager');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/file-manager/upload', UploadFile::class)->name('file.upload');
    Route::get('/file-manager/upload/secondary/{type_id}', UploadFileSecondary::class)->name('file.upload.second');

    Route::prefix('/references')->name('ref.')->group(
        function () {
            Route::get('/types', ManageTypes::class)->name('types');
        }
    );
});
