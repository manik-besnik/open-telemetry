<?php

use Illuminate\Support\Facades\Route;

use Spatie\OpenTelemetry\Facades\Measure;

use App\Models\Trancation;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    
    return view('welcome');
});
Route::get('/trace', function () {
    


    Measure::start('parent');
    
    // $trancation = new Trancation();

    // $trancation->trancation_type = "deposit";
    // $trancation->amount = 100;

    // $trancation->save();



    sleep(1);
    Measure::stop('parent');

    return "Measure With Open Telemetry";
});

