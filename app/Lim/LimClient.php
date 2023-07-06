<?php
namespace App\Lim;

use Illuminate\Support\Facades\Http;

class LimClient
{
    public static function getUrl($path = null)
    {
        $baseUrl = env('SSO_SERVER', 'http://id.limcorp.vn');
        if ($path) {
            return $baseUrl . '/' . $path;
        }
        return $baseUrl;
    }

    public static function user($token)
    {
        $response = Http::withHeaders(['Authorization' => $token])->get(self::getUrl('api/me'));
        if ($response->status() == 200) {
            return $response->json();
        }
        return null;
    }

    public static function requestTokenWithAuthCode($code)
    {
        $response = Http::asForm()->post(self::getUrl('oauth/token'), [
            'grant_type' => 'authorization_code',
            'client_id' => env('SSO_CLIENT_ID', 3),
            'client_secret' => env('SSO_CLIENT_SECRET', 'XM9bihuqAkvE6fbI4yPnimMrAxr3iUdaqvyZa8rS'),
            'redirect_uri' => 'http://localhost:8000/api/callback',
            'code' => $code,
        ]);

        if ($response->status() == 200) {
            return $response->json();
        }
        return null;
    }

    public static function redirectLogin($state = null)
    {
        $query = http_build_query([
            'client_id' => env('SSO_CLIENT_ID', 3),
            'redirect_uri' => 'http://localhost:8000/api/callback',
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
            // 'prompt' => '', // "none", "consent", or "login"
        ]);

        return redirect(self::getUrl('oauth/authorize?'.$query));
    }
}
