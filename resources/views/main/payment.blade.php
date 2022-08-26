<html>
    <body>
        <button id="rzp-button1" class="btn btn-outline-dark btn-lg"><i class="fas fa-money-bill"></i>Pay Rs.50</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var options = {
              "key": "rzp_test_uKovlltaWXyGkI",
              "amount": "5000",
              "currency": "INR",
              "description": "Aadhaar Services",
              "image": "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
              "handler" : function(response){
                console.log(response);
                // $.ajax({
                //     url: BASE_URL+'/updatePayment',
                //     type: 'post',
                //     data : "payment-id="+response.razorpay_payment_id+"&amt=50",
                //     success: function(response){
                //         var msg = '<div class="system-msg">Payment Successful.</div>';
                //         target_content(msg, target);
                //     }
                // });
              }
          };

            var rzp1 = new Razorpay(options);
            document.getElementById('rzp-button1').onclick = function (e) {
              rzp1.open();
              e.preventDefault();
            }
          </script>
          </html>

    </body>


</html>
