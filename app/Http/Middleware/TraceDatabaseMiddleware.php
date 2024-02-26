<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenTelemetry\API\Trace\Span;
use OpenTelemetry\Tracing\Tracer;
use Symfony\Component\HttpFoundation\Response;
use OpenTelemetry\SDK\Trace\TracerProvider;
use App\OpenTelemetry\BaseTracer;
use Illuminate\Support\Facades\Redis;

class TraceDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        DB::listen(function ($query) { 
          
           /** @var BaseTracer $tracer */
           $tracer = BaseTracer::getTracer();
           $span = $tracer->spanBuilder("database tracing")->startSpan();
           $spanScope = $span->activate();

        //    info("query",['sql'=> $query->sql,'binding'=> $query->binding,'time' => $query->time]);

        //    $spanScope->setAttribute('sql', $query->sql);
        //    $spanScope->setAttribute('binding', $query->binding);
        //    $spanScope->setAttribute('time', $query->time);

        


           $span->end();
           $spanScope->detach();
           
        });

        DB::listen(function ($query) { 
          
        
            info("query",['sql'=> $query->sql,'binding'=> $query->binding,'time' => $query->time]);
 
     
            
         });



        // Redis::enableEvents();

        // Redis::listen(function ($eventName, $data) {
        //     /** @var BaseTracer $tracer */
        //     $tracer = BaseTracer::getTracer();
        //     $span = $tracer->spanBuilder("redis tracing")->startSpan();
        //     $spanScope = $span->activate();

        //     $span->setAttribute('event', $eventName);
        //     $span->setAttribute('data', $data);

        //     $span->end();
        //     $spanScope->detach();
        // });


 

        return $next($request);
    }
}
