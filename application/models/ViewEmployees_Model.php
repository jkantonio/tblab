<?php
class ViewEmployees_Model extends CI_Model
{

	public function getTrans(){
        $this->db->select('*');
		$this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }
}	
?>