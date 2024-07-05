<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TrackingService
{
    protected $user;
    protected $password;

    public function __construct()
    {
        $this->user = env('CORREIOS_USER');
        $this->password = env('CORREIOS_PASSWORD');
    }

    public function track($trackingCode)
    {
        try {
            $response = Http::withBasicAuth($this->user, $this->password)
                            ->get("https://api.linkcorreios.com.br/v1/track/{$trackingCode}");

            if ($response->successful()) {
                return $response->json();
            } else {
                return ['error' => 'Failed to retrieve tracking information'];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
