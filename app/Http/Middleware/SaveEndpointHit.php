<?php

namespace App\Http\Middleware;

use App\Events\ApiHit;
use App\Hit;
use Closure;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SaveEndpointHit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $path = $request->path();
        $method = $request->method();
        $ip = $request->ip();
        $params = json_encode($request->query());
        $code = $response->status();

        $hit = new Hit([
            'path' => $path,
            'method' => $method,
            'query_params' => $params,
            'request_ip' => $ip,
            'response_code' => $code
        ]);
        $hit->save();
        $this->updateSyncList($hit);

        return $response;
    }

    private function updateSyncList(Hit $hit) {
        $client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $serviceSID = env('TWILIO_SYNC_SERVICE_SID');
        $syncList = $client->sync->v1->services($serviceSID)->syncLists("api_calls");
        $sid = $syncList->syncListItems->create($hit->toArray());
        Log::debug($sid);
    }
}
