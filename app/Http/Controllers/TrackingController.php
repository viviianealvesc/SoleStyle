<?php

namespace App\Http\Controllers;

use App\Services\TrackingService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    protected $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function track(Request $request)
    {
        $trackingCode = $request->input('tracking_code');
        $result = $this->trackingService->track($trackingCode);

        // Verifica se há um erro ou se 'events' não está definido
        if (isset($result['error'])) {
            return view('events.pedido', ['error' => $result['error']]);
        } elseif (!isset($result['events'])) {
            return view('events.pedido', ['error' => 'Nenhuma informação de rastreamento disponível.']);
        }

        // Se 'events' estiver definido e não houver erro, passa para a view
        return view('track', ['events' => $result['events']]);
    }
}
