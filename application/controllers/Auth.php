<?php 
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->helper(array ('url', 'form'));
    }

    public function index(){
        $this->load->view('register');
    }
    public function registerData(){
        $postData = $this->input->post();
        $data = array(
            'vName' => $this->input->post('name'),
            'vEmail' => $this->input->post('email'),
            'vPassword' => $this->input->post('pass'),
            'iMobileNo' => $this->input->post('mobNo')
        );

        $this->Auth_Model->add_user($data);
        $this->load->view('login');
    }

    public function loginData(){
        $postData = $this->input->post();
        $data = array(
            'vEmail' => $this->input->post('email'),
            'vPassword' => $this->input->post('pass')
        );

        $res = $this->Auth_Model->login_user($data);
        if($res){
            $data1['arr'] = $this->Auth_Model->get_products();
            $this->load->view('products',$data1 );
        }else{
            $this->load->view('login');
        }
    }

    public function productData(){
        $postData = $this->input->post();
        $data = array(
            'iProductId' => $this->input->post('pid'),
            'vProductName' => $this->input->post('name'),
            'vSpecification' => $this->input->post('sp'),
            'iQuantity' => $this->input->post('qnt'),
            'fPrice' => $this->input->post('price')
        );

        $res = $this->Auth_Model->add_product($data);
        if($res){
            $this->displayProducts();
            // $data1['arr'] = $this->Auth_Model->get_products();
            // $this->load->view('products',$data1 );
        }else{
            $this->load->view('login');
        }
    }
    public function productData1(){
        $postData = $this->input->post();
        $id = $postData['id'];
        // echo $id;
        // die;
        $data = array(
            'iId' => $this->input->post('id'),
            'iProductId' => $this->input->post('pid'),
            'vProductName' => $this->input->post('name'),
            'vSpecification' => $this->input->post('sp'),
            'iQuantity' => $this->input->post('qnt'),
            'fPrice' => $this->input->post('price')
        );

        $res = $this->Auth_Model->add_product1($data);
        if($res){
            $this->displayProducts();
            // $data1['arr'] = $this->Auth_Model->get_products();
            // $this->load->view('products',$data1 );
        }else{
            $this->load->view('login');
        }
    }
    
    public function displayProducts(){
        $data1['arr'] = $this->Auth_Model->get_products();
        $this->load->view('products',$data1 );
    }

    public function add_product(){
        $this->load->view('add_product');

    }

    public function edit($id){
        $data['arr'] = $this->Auth_Model->get_products1($id);
        $this->load->view('edit_product', $data);
        // $data1['arr'] = $this->Auth_Model->get_products();
        // $this->load->view('products',$data1 );

    }

    public function delete($id){
        $data1['arr'] = $this->Auth_Model->delete_product($id);
        $data['arr'] = $this->Auth_Model->get_products();
        $this->load->view('products',$data );
    }

    public function login_here(){
        $this->load->view('login');

    }
    public function register_here(){
        $this->load->view('register');

    }
}
?>