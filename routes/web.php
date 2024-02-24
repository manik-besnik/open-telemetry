<?php

use Illuminate\Support\Facades\Route;

use Spatie\OpenTelemetry\Facades\Measure;
use App\OpenTelemetry\BaseTracer;

use App\Models\Transaction;
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
    

    Measure::start('trancation');
    /** @var BaseTracer $tracer */
    $tracer = BaseTracer::getTracer();
    $span = $tracer->spanBuilder("trancation")->startSpan();
    $spanScope = $span->activate();
    
    $transaction = new Transaction();

    $transaction->trancation_type = "deposit";
    $transaction->amount = 100;

    $transaction->save();



    $span->end();
    
    $spanScope->detach();

    
    Measure::stop('trancation');

    return response()->json(Transaction::query()->get());


});

