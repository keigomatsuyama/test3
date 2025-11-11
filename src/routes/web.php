<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WeightController;

// 会員登録ステップ
Route::get('/register/step1', function () {
    return view('auth.register');
});
Route::get('/register/step2', [WeightController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [WeightController::class, 'storeStep2'])->name('register.step2.store');

// ログアウト
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ログイン済みユーザー専用ページ
Route::middleware(['auth'])->group(function () {
    // ダッシュボード（一覧）
    Route::get('/weight_logs', [WeightController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/create', [WeightController::class, 'create'])->name('weight_logs.create');

    Route::get('/weight-logs/index', [WeightController::class, 'search'])->name('weight_logs.search');
    // データ登録
    Route::post('/weight_logs', [WeightController::class, 'store'])->name('weight_logs.store');

    // 個別詳細・編集
    Route::get('/weight_logs/{weightLogId}', [WeightController::class, 'weight'])->name('weight_logs.weight');
    Route::put('/weight_logs/{weightLogId}/update', [WeightController::class, 'update'])->name('weight_logs.update');
    Route::post('/weight_logs/{weightLogId}/delete', [WeightController::class, 'destroy'])->name('weight_logs.delete');

    // 目標体重設定
    Route::get('/weight/setting', [WeightController::class, 'setting'])->name('weight_logs.setting');
    Route::post('/weight_target', [WeightController::class, 'update1'])->name('weight_target.update');
    // トップページ（ログイン状態でステップ2へ）
    Route::get('/', function () {
        return auth()->check()
            ? redirect('/register/step2')
            : redirect('/login');
    });
});
