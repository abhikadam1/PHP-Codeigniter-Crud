<?php 
defined("BASEPATH") OR EXIT("NO DIRECT SCRIPT ACCESS ALLOWED");

class Image_Upload_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function uploadImage($data){
        try {
            $this->db->insert('Image_Upload', $data);
            return true;
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
            return false;
        }
    }
    
    public function getImages(){
        try {
            $this->db->select('*');
            $this->db->from('Image_Upload');
            $resultdata = $this->db->get()->result_array();
            if($resultdata){
                return $resultdata;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }
}
?>