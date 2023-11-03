<?php 
defined("BASEPATH") or exit('No Direct Script Access Allowed');

class User_controller extends CI_Controller{
    public function __construct(){
        parent :: __construct();
        $this->load->model('Assignment/User_Model', 'user_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));
    }

    public function index(){
        $this->load->view('Assignment/registerUser');             
    }

    public function loginForm(){
        $this->load->view('Assignment/loginUser');             
    }
    public function submit(){
        $postData = $this->input->post();
        // print_r($postData);

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'trim|min_length[8]|max_length[15]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', 'Something went wrong');
            $this->index();
        } else {
            $data = array(
                'vEmail' => $this->input->post('email'),
                'vPassword' => $this->input->post('pass'),
            );

            
            $r = $this->user_model->checkUser($data);
            if ($r) {
                $this->session->set_flashdata('msg', 'Login Sussesfull');
                // $data['arr'] = $this->user_model->getEmployees();
                
                redirect(base_url() . 'Assignment/User_controller/getEmployeeList');
                // $this->load->view('Assignment/userView',$data);

            } else {
                $this->session->set_flashdata('msg', 'Something went wrong Try Again');
                $this->load->view('Assignment/loginUser');
            }
        }
    }

    public function register_user()
    {
        $postData = $this->input->post();
        // print_r($postData);
        // echo $this->input->post('email');
        // if (!empty($this->input->post('submit'))) {
        // $this->form_validation->set_rules('name', ' Full Name', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('num', 'Contact', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('pass', 'Password', 'trim|min_length[8]|max_length[15]');
        // $this->form_validation->set_rules('c_pass', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', 'Something went wrong');
            // print_r($postData);
            // die();
            $this->index();
            // $this->load->view('Assignment/registerUser');    
        } else {
            $data = array(
                'vName' => $this->input->post('name'),
                'iMobileNo' => $this->input->post('num'),
                'vEmail' => $this->input->post('email'),
                'vPassword' => $this->input->post('pass'),
                'eRole' => 'admin',
            );

            // echo "<pre>";
            // print_r($data);
            // die();
            // $data1 = array(
            //     'vEmail' => $this->input->post('email')
            // );
            // $result = $this->User_model->register_user_check($data1);
            // if (!$result) {
            $r = $this->user_model->addUser($data);
            // print($r);
            // die;
            if ($r) {
                $this->session->set_flashdata('msg', 'Registered Successfully You can login now');
                // redirect(base_url() . 'Assignment/User_controller/loginUser');
                $this->load->view('Assignment/loginUser');

            } else {
                // } else {
                $this->session->set_flashdata('msg', 'Email already exists');
                // $this->load->view('d4_login');
                $this->load->view('Assignment/registerUser');
                // redirect(base_url() . 'Assignment/loginUser');
            }
        }

    }

    public function addEmployeeForm(){
        $this->load->view('Assignment/addEmployee');
    }

    public function employeeRegister()
    {
        $postData = $this->input->post();
        // echo "<pre>";
        // print_r($postData);
        // die();
        // echo $this->input->post('email');
        // if (!empty($this->input->post('submit'))) {
        // $this->form_validation->set_rules('e_code', 'Employee Code', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('e_email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('num', 'Contact', 'required|min_length[10]|max_length[10]');
        // $this->form_validation->set_rules('pass', 'Password', 'trim|min_length[8]|max_length[15]');
        // $this->form_validation->set_rules('c_pass', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', 'Something went wrong');
            // print_r($postData);
            // die();
            $this->addEmployeeForm();
            // $this->load->view('Assignment/registerUser');    
        } else {

            // $config['upload_path'] = 'C:\xampp\htdocs\cit\uploads';
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            // application\controllers\uploads
            // C:\xampp\htdocs\cit\application\controllers\uploads
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('e_img')) {
            //    print_r($this->upload->do_upload('e_img'));
                // die();
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];

            $data = array(
                'vEmployeeCode' => $this->input->post('e_code'),
                'vEmployeeName' => $this->input->post('e_name'),
                'iEmployeeAge' => $this->input->post('e_age'),
                'iEmployeeContactNo' => $this->input->post('e_contact'),
                'vEmployeeDept' => $this->input->post('e_dept'),
                'iEmployeeSalary	' => $this->input->post('e_salary'),
                'vEmployeeEmail' => $this->input->post('e_email'),
                'vEmployeeImage' => $image_path,
            );

            // echo "<pre>";
            // print_r($data);
            // die();
            // $data1 = array(
            //     'vEmail' => $this->input->post('email')
            // );
            // $result = $this->User_model->register_user_check($data1);
            // if (!$result) {
            $r = $this->user_model->registerEmp($data);
            // print($r);
            // die;
            if ($r) {
                $this->session->set_flashdata('msg', ' Employee Registered Successfully');
                redirect(base_url() . 'Assignment/User_controller/getEmployeeList');
                // $data['arr'] = $this->user_model->getEmployees();
                
                // redirect(base_url() . 'Assignment/User_controller/loginUser');
                // $this->load->view('Assignment/userView',$data);
            } else {
                // } else {
                $this->session->set_flashdata('msg', 'Try Again');
                // $this->load->view('d4_login');
                $this->load->view('Assignment/addEmployee');
                // redirect(base_url() . 'Assignment/loginUser');
            }
        }
        $this->session->set_flashdata('msg', 'Try Again');
        // $this->load->view('d4_login');
        $this->load->view('Assignment/addEmployee');
        }

    }

    public function getEmployeeList(){
        $data['arr'] = $this->user_model->getEmployees();                
        // redirect(base_url() . 'Assignment/User_controller/loginUser');
         $this->load->view('Assignment/userView',$data);
    }

    public function editEmployee($id){
        $data['arr'] = $this->user_model->getEmployeeById($id);                
        // redirect(base_url() . 'Assignment/User_controller/loginUser');
         $this->load->view('Assignment/editEmployee',$data);
    }

    public function validate_password($password)
    {
        if (preg_match('$[0-9]$', $password) && preg_match('$[a-zA-Z]$', $password)) {

            return TRUE;
        }
        $this->form_validation->set_message('validate_password', 'The {field} must contain atleast one uppercase, one lowrcase and one number');
        return FALSE;
    }
}
?>