<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class RastreioController extends Controller
{
    public function Rastreio()
    {
        $client = new User();

        try {
            $response = $client->request('GET', 'https://proxyapp.correios.com.br', [
                'query' => [
                    'user' => 'teste',
                    'token' => '1abcd00b2731640e886fb41a8a9671ad1434c599dbaa0a0de9a5aa619f29a83f',
                    'codigo' => 'LX002249507BR'
                ],
                'http_errors' => false,
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            return response()->json([
                'status' => $statusCode,
                'data' => json_decode($body)
            ]);

        } catch (RequestException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
