<?php

namespace Ibnfaroukroqay\Dynamics;

use App\Constants\DynamicsConstants;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Dynamics
{

    public static function getUrlProperty()
    {
        return config('dynamics.url');
    }

    public static function getAuthUrlProperty()
    {
        return config('dynamics.auth_url');
    }

    public static function getAuthDataProperty()
    {
        return config('dynamics.auth_data');
    }

    public static function getNewToken()
    {
        $response = Http::asForm()->post(
            self::getAuthUrlProperty(),
            self::getAuthDataProperty()
        );
        if ($response->ok()) {
            $responseBody = $response->object();
            if (isset($responseBody->access_token)) {
                Storage::disk('local')->put('dynamics.key', $responseBody->access_token);
                return $responseBody->access_token;
            }
        }
        return null;
    }

    public static function getToken(): ?string
    {
        if (Storage::disk('local')->exists('dynamics.key')) {
            return Storage::disk('local')->get('dynamics.key');
        }
        return self::getNewToken();
    }

    public static function list($endpoint)
    {
        $token = self::getToken();
        $url = self::getUrlProperty().$endpoint;
        try {
            $response = Http::withToken($token)->withHeaders([
                'Content-Type' => 'application/json',
            ])->retry(2, 0, function ($exception, $request) {
                if (! $exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken(self::getNewToken());
                return true;
            })->send('POST', $url);
            if ($response->ok()) {
                return $response->json();
            }
            return [];
        } catch (\Exception $e) {
            info('Exception: '.$e->getCode().' | '.$e->getMessage());
            return [];
        }
    }

    public static function sendRequest($endpoint, $data)
    {
        $token = self::getToken();
        $url = self::getUrlProperty().$endpoint;
        try {
            $response = Http::withToken($token)->withHeaders([
                'Content-Type' => 'application/json',
            ])->retry(2, 0, function ($exception, $request) {
                if (! $exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken(self::getNewToken());
                return true;
            })->post($url, $data);
            if ($response->ok()) {
                return $response->json();
            }
            return [];
        } catch (\Exception $e) {
            info($e->getCode().' | '.$e->getMessage());
            return [];
        }
    }
}
