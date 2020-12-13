<?php
	class AddtoCart extends CI_Controller {

    function __construct() { 
	
        parent::__construct(); 
         
			// Load form validation ibrary & user model 
			$this->load->library('form_validation'); 
			$this->load->model('cart');
			// User login status 
			$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
			$this->recieptId = $this->session->userdata('sessionReciept'); 
		} 	
		
		public function save(){
			 // if( empty( $this->recieptId ) ){
				 // $this->session->set_userdata('sessionReciept', $this->reciept(8)); 
			 // }
			 $item = array(
				'item_id' =>  $this->input->post('itemId') ,
				'qty' =>  $this->input->post('qty') ,
				'reciept_number' =>  $this->recieptId,
				'payable' => ( $this->input->post('qty') * $this->input->post('rental_prize') ) ,
			);
			 $id = $this->cart->save($item);
			 echo $id;
			 return $id;
		}
		
		// public function reciept($length_of_string) { 
		  
			// // String of all alphanumeric character 
			// $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
		  
			// // Shufle the $str_result and returns substring 
			// // of specified length 
			// return substr(str_shuffle($str_result),  
							   // 0, $length_of_string); 
		// } 

	}
?>
