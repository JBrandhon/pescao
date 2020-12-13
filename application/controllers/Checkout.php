<?php
	class Checkout extends CI_Controller {  
	function __construct() { 
	
        parent::__construct(); 
         
			// Load form validation ibrary & user model 
			$this->load->library('form_validation'); 
			$this->load->model('rentee'); 
			$this->load->model('cart'); 
			$this->load->model('payable');
			$this->load->model('inventory_model');
			// User login status 
			$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
			$this->recieptId = $this->session->userdata('sessionReciept'); 
		} 	
		
		public function index(){ 
	
			if($this->isUserLoggedIn){ 
				redirect('admin/dashboard'); 
			}else{ 
				redirect('admin/login'); 
			} 
		} 
		
		public function rentee(){
			$this->session->set_userdata('sessionReciept', $this->reciept(8));
			$renteeData = array(
				'first_name' =>  strip_tags( $this->input->post('first_name') ),
				'last_name' =>  strip_tags( $this->input->post('last_name') ),
				'email' =>  strip_tags( $this->input->post('email') ),
				'address' =>  strip_tags( $this->input->post('address') ),
				'user_status' =>  strip_tags( $this->input->post('user_status') ),
				'phone' =>  $this->input->post('phone') ,
				'address' =>  strip_tags( $this->input->post('city') ),
				'reciept_number' =>  $this->session->userdata('sessionReciept'),
				'lessor' =>  $this->session->userdata('userId'),
			);
			print_r($renteeData);
			 // die();
			 return $this->rentee->saveRentee($renteeData);

		}
		
		public function reciept_num()
		{
			$recieptID =$this->uri->segment(3);
			$this->load->view('elements/reciept');
		}
		
		public function saveCheckout(){
			
			$checkout = array(
				'reciept_number' =>  $this->recieptId,
				'renters_id' =>  $this->input->post('id'),
			);
			
			// $payable = $this->payable->paylist($checkout);
			$updateQty = $this->update_qty();
			$this->cart->update_status($checkout);
			return $this->session->set_userdata('sessionReciept', '');
			
		}
		
		public function cart(){
			if(!$this->isUserLoggedIn){ 
				redirect('admin/login'); 
			}
			
			$status = $this->cart->get_status($this->recieptId);
			
			if( ( $status && $status[0]['status'] == 'Unpaid')){
			
				$this->recieptId = '';

			}
			
			$page 	= "checkout.php";
			$cart 	= $this->cart->get_cart($this->recieptId);
			$rentee = $this->rentee->get_rentee($this->recieptId);
			
            $this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId')
			]); 
			$this->load->view('admin/'.$page, [
				'cart' => $cart,
				'status' => $status,
				'return' => false,
				'recieptId' => $this->recieptId,
				'admin_id' => $this->session->userdata('userId'),
				'rentee' => $rentee
			]);
			$this->load->view('elements/footer');
			 
		}
		
		public function update_qty( ){
			return $this->inventory_model->update_items( $this->recieptId );
		}
		
		public function reciept($length_of_string) { 
		  
			// String of all alphanumeric character 
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
		  
			// Shufle the $str_result and returns substring 
			// of specified length 
			return substr(str_shuffle($str_result),  
							   0, $length_of_string); 
		} 

	}
?>
