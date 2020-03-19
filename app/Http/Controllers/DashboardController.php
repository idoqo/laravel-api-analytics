<?php
namespace App\Http\Controllers;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\SyncGrant;

class DashboardController extends Controller
{
    public function showDashboard() {
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
