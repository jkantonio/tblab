<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PulmonaryEvaluation extends CI_controller{
	public function index(){
        $data['userID'] = $this->session->userdata('userID');
        $this->load->view('pages/pulmonary-evaluation',$data);
    }
}
?>