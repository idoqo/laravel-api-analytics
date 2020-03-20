<?php

namespace App\Exceptions;

use App\Hit;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $response = parent::render($request, $exception);
        $this->logError($request, $response);
        return $response;
    }

    private function logError($request, $response) {
        $hit = new Hit([
            'path' => $request->path(),
            'method' => $request->method(),
            'query_params' => json_encode($request->query()),
            'request_ip' => $request->ip(),
            'response_code' => $response->status()
        ]);
        $hit->save();
        $client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $serviceSID = env('TWILIO_SYNC_SERVICE_SID');
        try {
            $syncList = $client->sync->v1->services($serviceSID)->syncLists->create([
                "uniqueName" => "api_calls"
            ]);
        } catch (RestException $e) {
            $syncList = $client->sync->v1->services($serviceSID)->syncLists("api_calls");
        }

        $syncList->syncListItems->create($hit->toArray());
    }
}
