<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Spatie\OpenTelemetry\Facades\Measure;

class TraceDatabaseQuerie
{
    

    public function handle($request, Closure $next)
    {  
        
           
        
        DB::listen(function () { 

            Measure::start("mysql")->tags([
                'Mysql' => "No Data"
            ]);    
            

            Measure::stop("mysql");
            
        });

        return $next($request);

    }
}
