<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DB_Stud_model extends CI_Model
{
    public function select()
    {
        $sql = "select * from Stud_Info";
        $result = $this->db->query($sql);
        // $result = $this->db->get('Stud_Info');
        $r = $result->result_array();
        return $r;

    }

    public function insert_stud_record()
    {
        try {
            $sql = "insert into Stud_Info (iStud_Roll_No, vStud_Name, vStud_Address, iStud_Phone_No, iAge ) values (5, 'Abhi', 'Sangli', 2056589696, 22)";
            $result = $this->db->query($sql);
            echo "Data inserted successfully";
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
        return $result;
    }

    public function form_insert($data)
    {
        try {
            $this->db->insert('Stud_Info', $data);
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
        // return $result;

    }

    public function deleteRecord($id){
        // echo $id;
        $this->db->where('iStud_Roll_No', $id);
        $result = $this->db->delete('Stud_Info');
        // print_r($result);
        // die;
    }
    public function update_stud($data, $id)
    {
        try {
            
            // echo "<pre>";
            // print_r($data);
            // exit;
            // $this->db->where('id', $id);
            // $this->db->update('mytable', $data);
            // echo "<pre>";
            // print_r($data);
            // exit;
            echo $id;
            $this->db->where('iStudInfoId',$id);
            $result = $this->db->update('Stud_Info', $data);
            print_r($result);
            // die;
           return $result; 

        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
        // return $result;
    }

    public function select_specific_record($id)
    {
        try {
            // $this->db->where()
            $sql = "select iStudInfoId, iStud_Roll_No, vStud_Name, vStud_Address, iStud_Phone_No, iAge, vImage from Stud_Info where iStudInfoId='$id'";
            $result = $this->db->query($sql);
            // $result = $this->db->get('Stud_Info');
            $r = $result->result_array();
            return $r;
        } catch (PDOException $e) {
            echo "error ";
        }
    }
}
?>