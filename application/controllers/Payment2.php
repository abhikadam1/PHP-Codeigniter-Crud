<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require APPPATH . 'vendor/autoload.php';

require FCPATH . 'vendor/autoload.php'; // Correct path
use Razorpay\Api\Api;

class Payment2 extends CI_Controller
{
    private $api_key = "rzp_test_MIErTzaxYi2SrZ";
    private $api_secret = "khSCl5NCETdnRFEnpYLGMgOF";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index1(): void
    {
        $this->load->view('payment');
    }
    public function payment()
    {
        $amount = $this->input->post('amount');
    }
    // }
    public function index(): void
    {
        $this->load->view('payment_view');
    }

    public function process_payment()
    {
        pr($_POST);
        $api = new Api($this->api_key, $this->api_secret);
        $payment_id = $this->input->post('razorpay_payment_id');

        try {
            $payment = $api->payment->fetch($payment_id);
            if ($payment->status == "captured") {
                echo "Payment Successful!";
            } else {
                $payment->capture(['amount' => $payment->amount]);
                echo "Payment Captured Successfully!";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>