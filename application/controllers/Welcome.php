<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('maps_view');
		// $this->load->view('welcome_message');
		// $this->load->view('addTableRow');
	}
	public function handsonTable()
	{
		$this->load->view('my_handson_table');
	}
	public function createLedger()
	{
		// echo "srgpsn";
		$option = "";
		$option = '<option  disabled value="-1" >Select Ledger</option>';
		$option .= '<option  value="1" >1 Ledger</option>';
		$option .= '<option  value="2" >2 Ledger</option>';
		$option .= '<option  value="3" >3 Ledger</option>';
		$option .= '<option  value="4" >4 Ledger</option>';
		$option .= '<option  value="5" >5 Ledger</option>';
		$option .= '<option  value="6" >6 Ledger</option>';
		$option .= '<option  value="7" >7 Ledger</option>';
		$selected = '5 Ledger';


		for ($i = 1; $i < 6; $i++) {
			$option = '<option  disabled value="-1" >Select Ledger</option>';
			$option .= '<option  value="1" >1 Ledger</option>';
			$option .= '<option  value="2" >2 Ledger</option>';
			$option .= '<option  value="3" >3 Ledger</option>';
			$option .= '<option  value="4" >4 Ledger</option>';
			$option .= '<option  value="5" >5 Ledger</option>';
			$option .= '<option  value="6" >6 Ledger</option>';
			$option .= '<option  value="7" >7 Ledger</option>';
			$option .= '<option selected value="' . $i . '"> ' . $i . ' Ledger</option>';
			$data['rate'] = $i*2;
			$data['quantity'] = $i*3;
			$data['amt'] = $data['rate']*$data['quantity'];
			$data['ledger'] = $option;
			$data['selected'] = $selected;
			$d[$i] = $data;
		}
		$val = $this->input->post('val');
		if($val== "true"){
			// echo "<pre>";print_r($val) ;exit();
			$d = [];
		}
		$response['data'] = $d;
		$response['status'] = 200;
		echo json_encode($response);
	}
}
