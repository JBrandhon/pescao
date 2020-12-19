<?php
	class Inventory extends CI_Controller {

		public function __construct()
		{
			parent::__construct();

			$this->load->model('inventory_model', 'model', TRUE);
		}

		public function index()
		{
			$this->load->view('welcome_message', [
				'images' => $this->model->all(),
				'notification' => $this->session->flashdata('notification')
			]);
		}
		
		public function edit()
		{
			$row_number_id = strip_tags($this->input->post('deleteItem'));
			
			$inventoryData = array( 
                'name' 					=> strip_tags($this->input->post('item_name')),
				'item_type' 			=> strip_tags($this->input->post('type')),				
                'gender' 				=> strip_tags($this->input->post('gender')), 
                'qty' 					=> strip_tags($this->input->post('qty')), 
                'description' 			=> strip_tags($this->input->post('message')), 
                'rental_prize' 			=> strip_tags($this->input->post('price')),
                'id' 					=> strip_tags($this->input->post('product-id')),
                'total_envintory_qty' 	=> strip_tags($this->input->post('total_envintory_qty')),
            ); 
			
			$insert = $this->model->update($inventoryData);
			
			if(!empty($row_number_id)){
				$this->model->delete_image(strip_tags($this->input->post('deleteItem')));
			}
			
			$count = count($_FILES['images']['name']);
			$tmp;
			 
			for($i=0;$i<$count;$i++){

				if(!empty($_FILES['images']['name'][$i])){
					echo ( $_FILES["images"]["name"][$i] );
					$this->model->store_image(  $inventoryData['id'], file_get_contents($_FILES["images"]["tmp_name"][$i]) );
					
				}
			}
			
			if ($this->model->store() === TRUE) {
				$notification = '<div class="alert alert-success">Success uploading <strong>'. $_FILES['userfile']['name'] . '</strong> to DB.</div>';
			} else {
				$notification = '<div class="alert alert-danger">Failed uploading image.</div>';
			}

			$this->session->set_flashdata('notification', $notification);
			
			redirect(site_url('/admin/dashboard'), 'refresh');
		}
		
		public function returnItem ()
		{
			$return_checkout = array(
				'renters_id' =>  $this->input->post('id'),
				'reciept_number' =>  $this->input->post('reciept_number'),
			);
			$this->session->set_userdata('sessionReciept', '');
			$update = $this->model->return_checkout( $return_checkout );
			return $update;
		}

		public function item_lost ()
		{	
			$data = $this->input->post('data');
			print_r($data);
			return $update = $this->model->item_lost( $data );
		}

		public function search ()
		{	
			$data = $this->input->post('data');
			print_r($data);
			die();
			// return $update = $this->model->search_data( $data );
		}

		// public function delete($id)
		// {
			// if ($this->model->destroy($id))
			// {
				// $notification = '<div class="alert alert-success">Success to delete image.</div>';
			// } else {
				// $notification = '<div class="alert alert-danger">Fail to delete image.</div>';
			// }

			// $this->session->set_flashdata('notification', $notification);

			// redirect(site_url('/'), 'refresh');
		// }

		// public function get_image($id)
		// {
			// header('Content-type : image/jpeg');

			// echo $this->model->get($id);
		// }

		public function upload()
		{
		
		  
			$inventoryData = array( 
                'name' 			=> strip_tags($this->input->post('item_name')), 
                'gender' 		=> strip_tags($this->input->post('for_gender')), 
                'qty' 			=> strip_tags($this->input->post('item_qty')), 
                'description' 	=> strip_tags($this->input->post('description')), 
                'rental_prize' 	=> strip_tags($this->input->post('item_prize')),
                'item_type' 	=> strip_tags($this->input->post('item_type'))
            ); 
			
			// print_r($inventoryData);
			// die();
			
			$insert = $this->model->store($inventoryData);
			// echo $insert;

			$count = count($_FILES['images']['name']);
			$tmp;
			 
			for($i=0;$i<$count;$i++){

				if(!empty($_FILES['images']['name'][$i])){
					//echo  $_FILES["images"]["name"][$i];
					$this->model->store_image(  $insert, file_get_contents($_FILES["images"]["tmp_name"][$i]) );
					
				}
			}			

			
			// $this->model->title = $_FILES['userfile']['name'];
			// $this->model->image = file_get_contents($_FILES['userfile']['tmp_name']);

			if ($this->model->store() === TRUE) {
				$notification = '<div class="alert alert-success">Success uploading <strong>'. $_FILES['userfile']['name'] . '</strong> to DB.</div>';
			} else {
				$notification = '<div class="alert alert-danger">Failed uploading image.</div>';
			}

			$this->session->set_flashdata('notification', $notification);
				
	
			redirect(site_url('/admin/dashboard'), 'refresh');
		}
		
		public function search_item (){	
		
			echo $_POST['search'];
			
		
		}

	}
?>
