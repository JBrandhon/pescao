<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Test extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
		
		echo $this->isUserLoggedIn;
		echo  $this->session->userdata('isUserLoggedIn');
		
    } 
	
	public function index(){ 
		echo "i am here";
    } 
}