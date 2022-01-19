<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NewsController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

// *********************************************************************************************** 

Route::get('news', [NewsController::class, 'index'])->name('news.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('News'), route('admin.news.index'));
});  
Route::get('news/create', [NewsController::class, 'create'])->name('news.create')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('News Create'), route('admin.news.create'));
});  
Route::post('news/store', [NewsController::class, 'store'])->name('news.store');
Route::get('news/getdetails', [NewsController::class, 'getdetails'])->name('news.getdetails');
Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Edit News'), route('admin.news.edit',1));
}); 
Route::post('news/update', [NewsController::class, 'update'])->name('news.update');
Route::get('news/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

// *********************************************************************************************** 
