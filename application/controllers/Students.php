<?php
defined('BASEPATH') or exit('No dorect script access allowed');

class Students extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DB_Stud_model');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Summary of index
     * @return void
     */
    public function index(){
        $api_url = "http://localhost/cit/Students/listing_students";
        $client = curl_init($api_url);
        
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($client);
        
        curl_close($client);
        
        $result['arr'] = json_decode($response, true);  
        // print_r($result);
        $this->load->view('students', $result);
    }
    // public function display_stud()
    // {
    //     echo "<pre>";
    //     //    print_r( $this->DB_Stud_model->select());
    //     $data['arr'] = $this->DB_Stud_model->select();
    //     // print_r($data);

    //     $this->load->view('students', $data);
    // }

    // public function index(){
    //     // $data['arr'] = $this->DB_Stud_model->select();
    //     $this->load->view('add_stud_view');
    // }
    public function add_form()
    {
        $this->load->view('add_stud_view');
    }
    public function user_form()
    {
        $this->load->view('user_form');
    }
    public function getDepts()
    {
        echo json_encode("Success");
    }

    public function update_stud_record()
    { 
        $id = $this->input->post('id');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('s_roll_no', ' Roll No.', 'required');
        $this->form_validation->set_rules('s_stud_name', 'Username', 'required');
        $this->form_validation->set_rules('s_address', 'Address', 'required');
        $this->form_validation->set_rules('s_mobile', 'Mobile No.', 'required');
        $this->form_validation->set_rules('s_age', 'Age', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('add_stud_view');
        } else {
            //Setting values for tabel columns
            $data = array(
                'iStud_Roll_No' => $this->input->post('s_roll_no'),
                'vStud_Name' => $this->input->post('s_stud_name'),
                'vStud_Address' => $this->input->post('s_address'),
                'iStud_Phone_No' => $this->input->post('s_mobile'),
                'iAge' => $this->input->post('s_age'),
            );
        
            $this->DB_Stud_model->update_stud($data,$id);
            echo 'Data inserted Successfully';
            // die;
            redirect(base_url() . 'Students');
        }
    }
    public function add_stud_records()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('s_roll_no', ' Roll No.', 'required');
        $this->form_validation->set_rules('s_stud_name', 'Username', 'required');
        $this->form_validation->set_rules('s_address', 'Address', 'required');
        $this->form_validation->set_rules('s_mobile', 'Mobile No.', 'required');
        $this->form_validation->set_rules('s_age', 'Age', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('add_stud_view');
        } else {
           
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('s_img')) {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];

            //Setting values for tabel columns
                $data = array(
                    'iStud_Roll_No' => $this->input->post('s_roll_no'),
                    'vStud_Name' => $this->input->post('s_stud_name'),
                    'vStud_Address' => $this->input->post('s_address'),
                    'iStud_Phone_No' => $this->input->post('s_mobile'),
                    'iAge' => $this->input->post('s_age'),
                    'vImage' => $image_path,
                );
                //Transfering data to Model
                $this->DB_Stud_model->form_insert($data);
                echo 'Data inserted Successfully';
                redirect(base_url() . 'Students', 'refresh');
                // $this->load->view('students', $data);
            }
        }
    }

    public function listing_students()
    {
        $data = $this->DB_Stud_model->select();
        // $this->load->model('Students_model');
        // $data['arr'] = $this->Students_model->students_array();
        // echo "<pre>";
        echo json_encode($data);

        // $this->load->view('students', $data);
    }
    public function edit($id='')
    {
        $postData = $this->input->post();
        // $id = $postData['iStudInfoId'];
        // print_r($postData);
        // die;
        // if()
        // echo $id;
        // die;
        $data['arr'] = $this->DB_Stud_model->select_specific_record($id);

        // echo 'ggc';
        // $data1['id'] = $id;
        // $data['arr'] = $this->Students_model->students_array();
        // $new_array = array_merge($data, $data1);
        // echo "<pre>";
        $this->load->view('student_edit', $data);
        // echo json_encode('success => yes');
        // die;
    }
    public function delete($id)
    {
        // $this->load->model('Students_model');

        $arr = $this->DB_Stud_model->deleteRecord($id);
        redirect(base_url(). 'Students', 'refresh');

        $data['arr'] = $this->Students_model->students_array();
        echo "<pre>";
        
        foreach ($data as $v => $value) {
            foreach ($value as $key1 => $value1) {
                // print_r($value);
                if ($value1['roll_no'] == $id) {
                    // print_r($value1);
                    // print_r($data[$v][$key1]);
                    unset($data[$v][$key1]);
                }
            }
        }
        // exit;
        // print_r($data);

        $this->load->view('students', $data);
    }

    public function viewColumn(){
        $postData = $this->input->post();
        // print_r($postData);
        // print_r("inside view");
        $returnArr = [
            '0' => [
            'success'=> 'yes',
            'display'=> 'yes'
            ]
        ];
        // print_r($returnArr);
        echo json_encode($returnArr);
        die;
    }



      // $data = array(
                //     'image_path' => $image_path,
                //     'image_caption' => $caption
                // );

                // $this->image_model->insert_image($data);
                // redirect('image_controller');
            // l} 
            // else {
            //     $error = $this->upload->display_errors();
            //     echo $error;
            // }

            // $fileName = basename($_FILES["s_img"]["name"]); 
            // $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            // $allowTypes = array('jpg','png','jpeg','gif'); 

            // if(in_array($fileType, $allowTypes)){ 
            //     $image = $_FILES['s_img']['tmp_name']; 
            //     $imgContent = addslashes(file_get_contents($image));

            // }else{ 
            //     $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            // }
            // echo $fileName."<br> ".$fileType."<br> ".$image."<br> ".$imgContent;
            // die;

            // $status = $statusMsg = ''; 
            // if(isset($_POST["submit"])){ 
            //     $status = 'error'; 
            //     if(!empty($_FILES["s_img"]["name"])) { 
            //         // Get file info 
            //         // Allow certain file formats 
            //         if(in_array($fileType, $allowTypes)){ 
            //             $image = $_FILES['image']['tmp_name']; 
            //             $imgContent = addslashes(file_get_contents($image)); 
                    
            //             // Insert image content into database 
            //             $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', NOW())"); 
                        
            //             if($insert){ 
            //                 $status = 'success'; 
            //                 $statusMsg = "File uploaded successfully."; 
            //             }else{ 
            //                 $statusMsg = "File upload failed, please try again."; 
            //             }  
            //         }else{ 
            //             $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            //         } 
            //     }else{ 
            //         $statusMsg = 'Please select an image file to upload.'; 
            //     } 
            // } 


}

?>




