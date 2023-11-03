<?php 
class ImageController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('ImageModel');
       
        $this->load->helper(array('url', 'form'));
    }
    public function index(){
       $data['images'] = $this->ImageModel->select();
        $this->load->view('imageView', $data);
    }

    public function imageUpload(){
        $data = [];
        // echo "<pre>";
        // print_r($_FILES);
        // die;
        $count = count($_FILES['files']['name']);
      
        for($i=0;$i<$count;$i++){
      
          if(!empty($_FILES['files']['name'][$i])){
      
            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
            $_FILES['file']['size'] = $_FILES['files']['size'][$i];
    
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['files']['name'][$i];
            // echo "<pre>";
            // print_r($config);
            // print_r($this->input->post());
            // die;
            $this->load->library('upload',$config); 
      
            if($this->upload->do_upload('file')){
              $uploadData = $this->upload->data();
              $image_path = 'uploads/' .$uploadData['file_name'];


              $data = array(
                'vImagePath' => $image_path,
                'vAltText' => $this->input->post('alt_text'),
            );
            $this->ImageModel->form_insert($data);
            
            // $data['totalFiles'][] = $filename;
          }
          // print_r($data);
          // die;
          }
     
        }
        $this->index();
        // $this->load->view('imageUploadForm', $data); 
     
    }
}
?>