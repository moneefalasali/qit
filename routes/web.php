<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LocalizationController;

// Localization Routes
Route::get('/locale/{locale}', [LocalizationController::class, 'setLocale'])->name('locale.set');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/request-labor', [HomeController::class, 'requestLabor'])->name('request-labor');
Route::get('/register-worker', [HomeController::class, 'registerWorker'])->name('register-worker');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Farmer Routes
Route::middleware(['auth', 'farmer'])->prefix('farmer')->group(function () {
    Route::get('/dashboard', [FarmerController::class, 'dashboard'])->name('farmer.dashboard');
    Route::get('/requests', [FarmerController::class, 'myRequests'])->name('farmer.requests');
    Route::get('/request/create', [FarmerController::class, 'createRequest'])->name('farmer.request.create');
    Route::post('/request', [FarmerController::class, 'storeRequest'])->name('farmer.request.store');
    Route::get('/request/{id}', [FarmerController::class, 'showRequest'])->name('farmer.request.show');
    Route::get('/profile', [FarmerController::class, 'profile'])->name('farmer.profile');
    Route::post('/profile', [FarmerController::class, 'updateProfile'])->name('farmer.profile.update');
    Route::get('/notifications', [FarmerController::class, 'notifications'])->name('farmer.notifications');
    Route::get('/settings', [FarmerController::class, 'settings'])->name('farmer.settings');
});

// Worker Routes
Route::middleware(['auth', 'worker'])->prefix('worker')->group(function () {
    Route::get('/dashboard', [WorkerController::class, 'dashboard'])->name('worker.dashboard');
    Route::get('/jobs', [WorkerController::class, 'availableJobs'])->name('worker.jobs');
    Route::post('/apply', [WorkerController::class, 'applyJob'])->name('worker.apply');
    Route::get('/applications', [WorkerController::class, 'myApplications'])->name('worker.applications');
    Route::get('/profile', [WorkerController::class, 'profile'])->name('worker.profile');
    Route::post('/profile', [WorkerController::class, 'updateProfile'])->name('worker.profile.update');
    Route::get('/notifications', [WorkerController::class, 'notifications'])->name('worker.notifications');
    Route::get('/documents', [WorkerController::class, 'documents'])->name('worker.documents');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/farmers', [AdminController::class, 'farmers'])->name('admin.farmers');
    Route::get('/workers', [AdminController::class, 'workers'])->name('admin.workers');
    Route::post('/worker/{id}/approve', [AdminController::class, 'approveWorker'])->name('admin.worker.approve');
    Route::post('/worker/{id}/reject', [AdminController::class, 'rejectWorker'])->name('admin.worker.reject');
    Route::get('/requests', [AdminController::class, 'requests'])->name('admin.requests');
    Route::post('/request/{id}/status', [AdminController::class, 'updateRequestStatus'])->name('admin.request.status');
    Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
    Route::post('/service/{id}/toggle', [AdminController::class, 'toggleServiceStatus'])->name('admin.service.toggle');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/activity-log', [AdminController::class, 'activityLog'])->name('admin.activity-log');
});

// Payment Routes
Route::middleware('auth')->prefix('payment')->group(function () {
    Route::get('/form/{requestId}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');
    Route::get('/history', [PaymentController::class, 'history'])->name('payment.history');
    Route::get('/receipt/{paymentId}', [PaymentController::class, 'receipt'])->name('payment.receipt');
});

// Fallback route for 404
Route::fallback(function () {
    return view('pages.404');
});
