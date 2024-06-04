@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<!--- Aqui eu vou gerar o QRCODE --->

@if($error)
  {{ $error }}
@endif

<div class="flex justify-center items-center mt-11">
  <div class="col-4">
    <h3 class="text-white font-semibold text-center mb-4">QR code de pagamento</h3>

    @if($response)
      <img src="{{ $response['qr_codes'][0]['links'][0]['href'] }}" alt="">
    @endif
</div>
</div>



@endsection