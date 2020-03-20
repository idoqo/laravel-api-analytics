<?php
namespace App\Http\Controllers;

use App\Hit;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\SyncGrant;
use Twilio\Rest\Client;

class DashboardController extends Controller
{
    const UNIQUE_NAME_EXISTS = "[HTTP 409] Unable to create record: Unique name already exists";

    public function showDashboard() {
        // prepare our Twilio sync document
        $client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $hits = Hit::orderBy("created_at", "desc")->get();
        $serviceSID = env('TWILIO_SYNC_SERVICE_SID');

        // delete any existing list with same SID and re-populate it
        $client->sync->v1->services($serviceSID)->syncLists("api_calls")->delete();
        $syncList = $client->sync->v1->services($serviceSID)->syncLists->create([
            "uniqueName" => "api_calls"
        ]);
        foreach ($hits as $hit) {
            $syncList->syncListItems->create($hit->toArray());
        }

        $data = [
            'token' => $this->getToken()
        ];
        return view('dashboard', $data);
    }

    private function getToken() {
        $identity = "Overseer";
        // Create access token, which we will serialize and send to the client
        $token = new AccessToken(
            env('TWILIO_ACCOUNT_SID'),
            env('TWILIO_API_KEY'),
            env('TWILIO_API_SECRET'),
            3600,
            $identity
        );
        // grant access to Sync
        $syncGrant = new SyncGrant();
        $syncGrant->setServiceSid(env('TWILIO_SYNC_SERVICE_SID'));
        $token->addGrant($syncGrant);
        return $token->toJWT();
    }
}
