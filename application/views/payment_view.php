<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAyment Integration </title>
</head>
<body>
<form action="<?= base_url('StripeController/process_payment') ?>" method="POST">
    <script src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        data-key="sk_test_1234567890abcdefghijklmnopqrstuvwxyz"
        data-amount="5000"
        data-currency="INR"
        data-name="Test Payment"
        data-description="Stripe Test Payment"
        data-locale="auto">
    </script>
</form>

</body>
</html>