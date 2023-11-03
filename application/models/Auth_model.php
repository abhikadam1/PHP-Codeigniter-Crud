<?php 
class Auth_Model extends CI_Model{
    public function add_user($data){
        try {
            $this->db->insert('User_info', $data);
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }

    public function add_product($data){
        try {
            $this->db->insert('products', $data);
            return true;
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }

    public function add_product1($data){
        try {
            $this->db->where('iid',$data['iId']);
            $result = $this->db->update('products', $data);
            return true;
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }

    public function login_user($data){
        try {
            $this->db->select('*');
            $this->db->from('User_Info');
            $this->db->where('vEmail', $data['vEmail']);
            $this->db->where('vPassword', $data['vPassword']);
            $resultdata = $this->db->get()->result_array();
            if($resultdata){
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }

    public function get_products(){
        try {
            $this->db->select('*');
            $this->db->from('products');
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

    public function get_products1($id){
        try {
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('iId', $id);
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

    public function delete_product($id){
        try {
            $this->db->where('iId', $id);
            $resultdata = $this->db->delete('products');
           
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
    }


}
?>