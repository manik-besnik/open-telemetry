<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Spatie\OpenTelemetry\Facades\Measure;

class TraceDatabaseQuerie
{
    

    public function handle($request, Closure $next)
    {  
        
        Measure::start("mysql")->tags([
            'Mysql' => "No Data"
        ]);        
        
        DB::listen(function ($query) {
           
            
           
        });

        Measure::stop('mysql');

        return $next($request);

    }
}
