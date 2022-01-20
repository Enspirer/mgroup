<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\ProjectsController;
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
    $trail->push(__('Create News'), route('admin.news.create'));
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

Route::get('projects', [ProjectsController::class, 'index'])->name('projects.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Projects'), route('admin.projects.index'));
});  
Route::get('projects/create', [ProjectsController::class, 'create'])->name('projects.create')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Create Project'), route('admin.projects.create'));
});  
Route::post('projects/store', [ProjectsController::class, 'store'])->name('projects.store');
Route::get('projects/getdetails', [ProjectsController::class, 'getdetails'])->name('projects.getdetails');
Route::get('projects/edit/{id}', [ProjectsController::class, 'edit'])->name('projects.edit')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Edit Project'), route('admin.projects.edit',1));
}); 
Route::post('projects/update', [ProjectsController::class, 'update'])->name('projects.update');
Route::get('projects/delete/{id}', [ProjectsController::class, 'destroy'])->name('projects.destroy');

// *********************************************************************************************** 











