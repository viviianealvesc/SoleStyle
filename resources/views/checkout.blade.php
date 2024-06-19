<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Checkout</h1>

    <form id="payment-form">
        <div id="card-element">
            <!-- Elemento do cartão do Stripe será inserido aqui -->
        </div>
        <button id="submit-payment">Pagar Agora</button>
    </form>

    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var paymentForm = document.getElementById('payment-form');
        paymentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Requisição AJAX para criar um PaymentIntent
            fetch('/api/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Confirmar o pagamento usando o client_secret
                stripe.confirmCardPayment(data.client_secret, {
                    payment_method: {
                        card: cardElement
                    }
                }).then(function(result) {
                    if (result.error) {
                        // Handle errors (ex: card declined)
                        console.error(result.error.message);
                    } else {
                        // Payment successful
                        console.log(result.paymentIntent);
                        // Redirecionar ou mostrar mensagem de sucesso
                    }
                });
            });
        });
    </script>
</body>
</html>