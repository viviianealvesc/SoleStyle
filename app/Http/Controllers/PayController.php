<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
 
    public function pagarCompra(Request $request) {

        $dados = $request->all();
  
        $user = auth()->user();
  
         // Acessar o endereço do usuario logado
         $enderecoUser = $user->endereco;
  
      if (isset($dados['pix'])) {
  
        $prodQuant = $user->carrinho->toArray();
  
        // Inicializa uma variável para armazenar os nomes dos produtos
        $nomesProdutos = '';
  
        // Loop através de todos os produtos e concatena os nomes
        foreach ($prodQuant as $produto) {
            $nomesProdutos .= $produto['nome'] . ', ';
        }
  
        // Remove a vírgula extra no final da string
        $nomesProdutos = rtrim($nomesProdutos, ', ');
  
         // // // // // // // // // // // // // // // // // //
  
        $infoEnd = [];
       
        // Loop através de todos os produtos e concatena os nomes
        foreach ($enderecoUser as $endereco) {
        $infoEnd[] = $endereco;
        }
  
  
        $endpoint = 'https://sandbox.api.pagseguro.com/orders';
        $token = '5CDFE1B717394FBCB659BACF6D2572C7';
  
          $body =
          [
            "reference_id" => "ex-00001",
            "customer" => [
              "name" => "$user->name",
              "email" => "$user->email",
              "tax_id" => "12345678909",
              "phones" => [
                [
                  "country" => "55",
                  "area" => "11",
                  "number" => "999999999",
                  "type" => "MOBILE"
                ]
              ]
            ],
  
            "items" => [
              [
                "name" =>  $nomesProdutos,
                "quantity" => count($prodQuant),
                "unit_amount" => 500,
              ]
            ],
            "qr_codes" => [
              [
                "amount" => [
                  "value" => 500
                ],
                "expiration_date" => "2024-06-29T20:15:59-03:00",
              ]
            ],
            "shipping" => [
              "address" => [
                "street" => "rua",
                "number" => "1384",
                "complement" => "apto 12",
                "locality" => "Pinheiros",
                "city" => "São Paulo",
                "region_code" => "SP",
                "country" => "BRA",
                "postal_code" => "01452002"
              ]
            ],
            "notification_urls" => [
              "https://alexandrecardoso-pagseguro.ultrahook.com"
            ]
          ];
  
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $endpoint);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_CAINFO, base_path('cacert.pem'));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization: Bearer ' . $token
            ]);
  
            $response = curl_exec($curl);
            $error = curl_error($curl);
  
            curl_close($curl);
  
            //if ($error) {
            //var_dump($error);
          // die();
          // }
  
           //$data = json_decode($response, true);
  
          // echo "<pre>";
           // var_dump($data);
           // echo "</pre>";
          
          return view('pay', [
            'response' => json_decode($response, true),
            'error' => $error
          ]);
          
  
      } elseif(isset($dados['cartao'])) {
  
        echo 'cartao';
  
      }
        
         
  
      }
}
