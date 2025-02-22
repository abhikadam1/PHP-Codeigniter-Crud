<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function addUser($data){
        try {
            $this->db->insert('User_info', $data);
            return true;
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
            return false;
        }
    }

    public function registerEmp($data){
        try {
            $this->db->insert('Employee_info', $data);
            return true;
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
            return false;
        }
    }
    
    public function checkUser($data){
        try {
            $whereCond = [
                'vEmail' => $data['vEmail'],
                'vPassword' => $data['vPassword']
            ];
            $this->db->select('*');
            $this->db->from('user_info');
            $this->db->where($whereCond);
            $returnArr = $this->db->get()->result_array();
            // print_r($returnArr);
            // die();
            if(is_array($returnArr[0])){
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
            return false;
        }
    }

    public function getEmployees(){
        try {
            $this->db->select('*');
            $this->db->from('employee_info');
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

    public function getEmployeeById($id){
        try {
            $this->db->select('*');
            $this->db->from('employee_info');
            $this->db->where('iEmployeeId', $id);
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