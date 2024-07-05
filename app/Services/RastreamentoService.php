<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RastreamentoService
{
    public function consultarRastreamento($codigo)
    {
        $url = "https://api.linketrack.com/track/json?user=SEU_USER&token=SEU_TOKEN&codigo={$codigo}";
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Não foi possível obter informações de rastreamento.');
    }
}
