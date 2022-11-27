<?php

namespace Ibnfaroukroqay\Dynamics;

use App\Constants\DynamicsConstants;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Dynamics
{
    private array $authData;

    private mixed $url;

    private mixed $authUrl;

    public function __construct()
    {
        $this->authUrl = config('dynamics.auth_url');
        $this->url = config('dynamics.url');
        $this->authData = config('dynamics.auth_data');
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        if (Storage::disk('local')->exists('dynamics.key')) {
            return Storage::disk('local')->get('dynamics.key');
        }

        return $this->getNewToken();
    }

    public function getNewToken()
    {
        $response = Http::asForm()->post(
            $this->authUrl,
            $this->authData
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

    public function list($endpoint)
    {
        $token = $this->getToken();
        $url = $this->url.$endpoint;
        try {
            $response = Http::withToken($token)->withHeaders([
                'Content-Type' => 'application/json',
            ])->retry(2, 0, function ($exception, $request) {
                if (! $exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken($this->getNewToken());

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

    public function sendRequest($endpoint, $data)
    {
        $token = $this->getToken();
        $url = $this->url.$endpoint;
        try {
            $response = Http::withToken($token)->withHeaders([
                'Content-Type' => 'application/json',
            ])->retry(2, 0, function ($exception, $request) {
                if (! $exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken($this->getNewToken());

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
