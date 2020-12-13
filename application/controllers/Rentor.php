<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rentor extends CI_Controller {

		function __construct() { 
	
        parent::__construct(); 
         
			$this->load->model('rentee'); 
			$this->load->model('cart'); 

			  $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
			// $this->load->model('inventory_model', 'model', TRUE);
		}
		
		public function index(){ 
	
			if($this->isUserLoggedIn){ 
				redirect('admin/dashboard'); 
			}else{ 
				redirect('admin/login'); 
			} 
		} 
			
		public function billing_details()
		{
			 if(!$this->isUserLoggedIn){ 
				redirect('admin/login'); 
			}
			
			$recieptID =$this->uri->segment(3); 
			$ifcart = $this->cart->ifcart($recieptID);			
			$status = $this->cart->get_status($recieptID);
			$this->session->set_userdata('sessionReciept', $recieptID);
			
						
			if ( $ifcart > 0  ) 
			   {
					$page = "checkout.php";
					$cart = $this->cart->get_cart($recieptID);
					$rentee = $this->rentee->get_rentee($recieptID);
					
					//var_dump( $cart );
					//var_dump( $rentee );
					
					 $this->load->view('elements/header', [
						'admin_id' => $this->session->userdata('userId')
					]);
					$this->load->view('admin/'.$page, [
						'cart' => $cart,
						'status' => $status,
						'return' => true,
						'recieptId' => $recieptID,
						'rentee' => $rentee
					]);
					$this->load->view('elements/footer');
			   } else {
				 $this->session->set_userdata('sessionReciept', $recieptID);
				 redirect('/checkout/cart');
			 }

		}
		public function reciept()
		{
			$recieptID 	=$this->uri->segment(3);
			
			$cart 		= $this->cart->get_cart($recieptID);
			$rentee = $this->rentee->get_rentee($recieptID);
			
			$this->load->view('elements/reciept',[
				'cart' => $cart,
				'rentee' => $rentee
			]);
		}
		public function item_lost()
		{	
			 if(!$this->isUserLoggedIn){ 
				redirect('admin/login'); 
			}
			
			 $recieptID =$this->uri->segment(3); 
			 
			$page = "item_lost.php";
			
			 $this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId'),
				'cart' => $this->cart->get_cart($recieptID)
			]);
			$this->load->view('admin/'.$page);
			$this->load->view('elements/footer');
		}
			
}
