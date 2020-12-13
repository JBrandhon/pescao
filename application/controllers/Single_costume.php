

<?php


	class Single_costume extends CI_Controller {
		
		function __construct() { 
			parent::__construct(); 
			// $this->load->model('for_rent_model');
			$this->load->model('for_rent_model', 'model', TRUE);
			$this->load->model('cart');
			// Load form validation ibrary & user model 
			$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
			$this->recieptId = $this->session->userdata('sessionReciept'); 
			
		} 
		

		
		public function view(){
			 $costumeID =$this->uri->segment(3); 
			 $page = "single-costume.php";
			 // echo $costumeID;
			 
			 $single_costume 	= $this->model->get($costumeID);
			 $status 			= $this->cart->get_status($this->recieptId);
			
			 
			$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]);  
			$this->load->view('public/'.$page, [
					'single_costume' => $this->model->get($costumeID),
					'status' => $status,
					'isUserLoggedIn' => $this->isUserLoggedIn,
					'recieptId' => $this->recieptId
				]);
			$this->load->view('elements/footer');
			 
		}
		public function edit(){
			 $costumeID =$this->uri->segment(3); 
			 $page = "edit_item.php";

			 $img 				= $this->model->get_image($costumeID);
			 $single_costume    = $this->model->get($costumeID);
			
			$this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId')
			]);  
		// die();
			$this->load->view('admin/'.$page, [
					'image' => $this->model->get($costumeID),
					'single_costume' => $this->model->get($costumeID),
					'img'				=> $img,
					'remaining_qty' => $this->model->get_remaining_qty($costumeID),
					'isUserLoggedIn' => $this->isUserLoggedIn,
					'recieptId' => $this->recieptId
				]);
			$this->load->view('elements/footer');
			 
		}
		// jbg custom
		public function edit1(){
			 $costumeID =$this->uri->segment(3); 
			 $page = "edit_item1.php";
			 // echo $costumeID;
			 
			 $single_costume = $this->model->get($costumeID);
			 
			$this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId')
			]);  
		// die();
			$this->load->view('admin/'.$page, [
					'single_costume' => $this->model->get($costumeID),
					'remaining_qty' => $this->model->get_remaining_qty($costumeID),
					'isUserLoggedIn' => $this->isUserLoggedIn,
					'recieptId' => $this->recieptId
				]);
			$this->load->view('elements/footer');
			 
		}

		public function checkout(){
			$page = "checkout.php";
			$itemId =$this->uri->segment(3); 
			$qty = $this->input->post('qty');
			
			$single_costume = $this->model->get($itemId);

			$this->load->view('elements/header');
			$this->load->view('admin/'.$page, [
				'order' => $this->model->get($itemId),
				'qty' => $qty,
				'itemId' => $itemId
			]);
			$this->load->view('elements/footer');
			 
		}
	}

?>
