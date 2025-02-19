<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Pay ₹500 using Razorpay</h2>
    <button id="pay-btn">Pay with Razorpay</button>

    <script>
        $("#pay-btn").click(function() {
            $.ajax({
                url: "<?php echo base_url('payment/create_order'); ?>",
                type: "POST",
                dataType: "json",
                success: function(order) {
                    console.log(order, " data ");
                    
                    if (order.id) {
                        var options = {
                            "key": "rzp_test_MIErTzaxYi2SrZ", // Replace with your Key ID
                            "amount": order.amount,
                            "currency": order.currency,
                            "name": "Test Company",
                            "description": "Purchase Product",
                            "order_id": order.id,
                            "handler": function(response) {
                                $.ajax({
                                    url: "<?php echo base_url('payment/verify_payment'); ?>",
                                    type: "POST",
                                    data: response,
                                    success: function(verificationResponse) {
                                        alert(verificationResponse);
                                    }
                                });
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp = new Razorpay(options);
                        rzp.open();
                    } else {
                        alert("❌ Error creating order.");
                    }
                }
            });
        });
    </script>
</body>
</html>
