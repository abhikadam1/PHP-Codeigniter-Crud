<?php 
class ImageModel extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function select()
    {
        $sql = "select * from Store_Image";
        $result = $this->db->query($sql);
        // $result = $this->db->get('Stud_Info');
        $r = $result->result_array();
        return $r;

    }
    public function form_insert($data)
    {
        try {
            $this->db->insert('Store_Image', $data);
        } catch (PDOException $e) {
            echo "ERROR bndfgnjhgngn fbhfb:";
        }
        // return $result;

    }
}
?>