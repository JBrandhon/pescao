<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Borrowers extends CI_Controller {
     
    public function index(){
			$this->load->view('borrowers');
	}

}