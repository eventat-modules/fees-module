<?php

use App\Http\Controllers\Api\FeeController;

Route::apiResource('fees', FeeController::class);
Route::get('/select/fees', [FeeController::class, 'select'])->name('fees.select');
