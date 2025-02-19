<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php'; // Load Razorpay SDK

use Razorpay\Api\Api;

class Payment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('razorpay_payment'); // Load payment view
    }

    public function create_order() {
        $api = new Api('rzp_test_MIErTzaxYi2SrZ', 'khSCl5NCETdnRFEnpYLGMgOF'); // Replace with your API keys

        try {
            $order = $api->order->create([
                'receipt' => 'ORDER_' . rand(1000, 9999),
                'amount' => 50000, // ₹500 (in paise)
                'currency' => 'INR',
                'payment_capture' => 1 // Auto capture
            ]);
            // print_r($order->attributes); die;

            echo json_encode($order->toArray());
            exit;
        } catch (Exception $e) {
            // print_r($e); die;
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function verify_payment() {
        $api = new Api('rzp_test_MIErTzaxYi2SrZ', 'khSCl5NCETdnRFEnpYLGMgOF'); // Replace with your API keys

        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $razorpay_order_id = $this->input->post('razorpay_order_id');
        $razorpay_signature = $this->input->post('razorpay_signature');

        try {
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            echo "✅ Payment Successful!";
        } catch (Exception $e) {
            echo "❌ Payment Verification Failed: " . $e->getMessage();
        }
    }
}
