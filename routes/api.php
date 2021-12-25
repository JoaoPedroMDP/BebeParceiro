<?php
declare(strict_types=1);

use App\Domains\Appointment\Actions\IndexAppointmentsAction;
use App\Domains\Service\Actions\DeleteServiceAction;
use App\Domains\Service\Actions\IndexServicesAction;
use App\Domains\Service\Actions\StoreServiceAction;
use App\Domains\Service\Actions\UpdateServiceAction;
use App\Domains\User\Actions\LoginAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// SERVICE
Route::get('service', [IndexServicesAction::class, 'handle']);
Route::post('service', [StoreServiceAction::class, 'handle']);
Route::post('service/{id}', [UpdateServiceAction::class, 'handle']);
Route::delete('service/{id}', [DeleteServiceAction::class, 'handle']);

Route::post('login', [LoginAction::class, 'handle']);
Route::middleware(['auth:sanctum'])->group(function() {
	// APPOINTMENTS
	Route::get('appointment', [IndexAppointmentsAction::class, 'handle']);
});
