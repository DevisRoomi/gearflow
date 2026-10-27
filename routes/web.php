<?php

use App\Http\Controllers\GearFlowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GearFlowController::class, 'index'])->name('gearflow.index');
Route::post('/loans', [GearFlowController::class, 'storeLoan'])->name('gearflow.loans.store');
Route::post('/loans/{loan}/status', [GearFlowController::class, 'updateStatus'])->name('gearflow.loans.status');
