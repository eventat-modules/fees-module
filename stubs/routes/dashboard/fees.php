<?php

use App\Http\Controllers\Dashboard\FeeController;

Route::get('trashed/fees', [FeeController::class, 'trashed'])->name('fees.trashed');
Route::get('trashed/fees/{trashed_fee}', [FeeController::class, 'showTrashed'])->name('fees.trashed.show');
Route::post('fees/{trashed_fee}/restore', [FeeController::class, 'restore'])->name('fees.restore');
Route::delete('fees/{trashed_fee}/forceDelete', [FeeController::class, 'forceDelete'])->name('fees.forceDelete');
Route::resource('fees', FeeController::class);
