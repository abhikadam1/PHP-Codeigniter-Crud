<?php
defined("BASEPATH") or EXIT("NO DIRECT SCRIPT ACCESS ALLOWED");

class Image_Upload_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('assignment/image_upload_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session'));
    }

    // Function to get upload images view
    public function index($error=[])
    {
        $this->load->view('assignment/imageUploadView', $error);
    }
    // Function to get list uploaded images
    public function getImageList()
    {
        $data['arr'] = $this->image_upload_model->getImages();
       
        $this->load->view('Assignment/imageListView', $data);
    }
    
    // Function to handle uploaded images
    public function uploadImage()
    {
        $postData = $this->input->post();
        // print_r($postData);

        $this->form_validation->set_rules('e_name', 'Your Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('caption', 'Caption', 'required|trim|min_length[10]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', 'Something went wrong');
            $this->index();
        } else {
            $config1['upload_path'] = './uploads';
            $config1['allowed_types'] = 'jpeg|png';
            $config1['max_size'] = 2048;
            $config1['min_size'] = 512;
            $this->load->library('upload', $config1);
            if ($this->upload->do_upload('e_img')) {

                $upload_data = $this->upload->data();
                $image_path = 'uploads/' . $upload_data['file_name'];
              
                $thumbnail_image_path = './thumbnails/' . $upload_data['file_name'];
               
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image_path;
                $config['new_image'] = $thumbnail_image_path;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['thumb_marker'] = '_thumb';
                $config['width'] = 250;
                $config['height'] = 250;

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
               
                $data = array(
                    'vImagePath' => $image_path,
                    'vThumbnailPath' => $thumbnail_image_path,
                    'vImageCaption' => $this->input->post('caption'),
                    'vUsername' => $this->input->post('e_name'),
                );
              
                $r = $this->image_upload_model->uploadImage($data);
                if ($r) {
                    $this->session->set_flashdata('msg', 'Image Uploaded Succesfully');
                    // $data['arr'] = $this->user_model->getEmployees();

                    redirect(base_url() . 'Assignment/Image_Upload_Controller/getImageList');
                    // $this->load->view('Assignment/userView',$data);

                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong Try Again');
                    $this->load->view('Assignment/Image_Upload_Controller/index');
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                // $this->load->view('upload_form', $error);
                $this->session->set_flashdata('msg', 'Something went wrong');
                $this->index($error);
            }
        }
    }

     // Function to handle image preview
    public function getUploadView()
    {
        $data['arr'] = $this->image_upload_model->getImages();
       
        $this->load->view('Assignment/imageListView', $data);
    }
}
?>