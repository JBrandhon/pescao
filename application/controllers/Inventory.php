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
		public function edit_rentee(){
			$id = strip_tags($this->input->post('id'));
			
			$this->model->update_rent($id);
			
		}
		public function edit()
		{
			$row_number_id = strip_tags($this->input->post('deleteItem'));
			
			$inventoryData = array( 
                'name' 					=> strip_tags($this->input->post('item_name')),
				'item_type' 			=> strip_tags($this->input->post('type')),				
                'sex' 					=> strip_tags($this->input->post('gender')), 
                'qty' 					=> strip_tags($this->input->post('qty')), 
                'description' 			=> strip_tags($this->input->post('message')), 
                'rental_prize' 			=> strip_tags($this->input->post('price')),
                'id' 					=> strip_tags($this->input->post('product-id')),
                'total_envintory_qty' 	=> strip_tags($this->input->post('total_envintory_qty')),
				'category' 				=> strip_tags($this->input->post('category'))
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

		public function search (){	

			$output = '';
			$record_per_page 	= 10;
			$data 				= $this->input->post('search');
			$page 				= $this->input->post('page');
	
			$start_from			= ($page - 1) * $record_per_page;
			
			$update 			= $this->model->search_data( $data, $start_from	, $record_per_page );
			$total_records		= $this->model->count_data($data);
			$total_page			= ceil( $total_records/$record_per_page );

			
			ob_start();
			
			if( count($update) > 0 ){
				
				foreach( $update as  $costume ){
					?>
						<div class="col-lg-4 col-sm-6 <?php echo $costume->item_type?>">
							<div class="single_category_product">
								<div class="single_category_img">
									<?php 
										echo '<img style=" height: 254px; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail"  src="data:image/jpeg;base64,'.base64_encode($costume->image ).'"/>'; 
									?>
									<div class="category_social_icon">
										<ul>
											<li><a href="<?php echo base_url('single_costume/edit/').$costume->id; ?>"><i class="ti-pencil-alt"></i></a></li>
										</ul>
									</div>
									<div class="category_product_text">
										<a href="<?php echo base_url('single_costume/view/').$costume->id; ?> ">
											<h5> <?php echo $costume->name ?> </h5>
										</a>
										<?php echo ($costume->item_type === 'Costume' ? '
											<p>₱'.number_format($costume->rental_prize, 2 ).'</p>
										': ''); ?>
										<label>qty:<?php echo number_format( $costume->qty )  ?> </labelP>
										
									</div>
								</div>
							</div>
						</div>
					<?php
				} 
				echo '<div class="col-lg-12 page-link-ctrl text-center" style="display: flex; align-items: center;justify-content: center;">';
					for($i=1; $i<=$total_page; $i++){  
						?>
								<div><span class="pagination_link_search" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="<?php echo $i; ?>"><?php echo $i; ?></span></div>
							
						<?php
					} 
				echo '</div>';
				
			} else {
				$output .= '<div class="col-lg-4 col-sm-6 "><p>No Data Found!</p></div>';
			}
			
			$output .= ob_get_clean();
			echo $output;
		
		}
		
		public function upload()
		{
			$inventoryData = array( 
                'name' 			=> strip_tags($this->input->post('item_name')), 
                'sex' 		=> strip_tags($this->input->post('for_gender')), 
                'qty' 			=> strip_tags($this->input->post('item_qty')), 
                'description' 	=> strip_tags($this->input->post('description')), 
                'rental_prize' 	=> strip_tags($this->input->post('item_prize')),
                'item_type' 	=> strip_tags($this->input->post('item_type')),
				'category' 		=> strip_tags($this->input->post('category'))
            ); 
			
			$insert = $this->model->store($inventoryData);

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
		
		public function search_category(){	
			
			$output = '';
			$record_per_page 	= 10;
			$data 				= $this->input->post('val');
			$page 				= $this->input->post('page');
	
			$start_from			= ($page - 1) * $record_per_page;
			
			$update 			= $this->model->search_category( $data, $start_from	, $record_per_page );
			$total_records		= $this->model->count_category($data);
			$total_page			= ceil( $total_records/$record_per_page );
			
			ob_start();
			
			if( count($update) > 0 ){
				
				foreach( $update as  $costume ){
					?>
						<div class="col-lg-4 col-sm-6 <?php echo $costume->item_type?>">
							<div class="single_category_product">
								<div class="single_category_img">
									<?php 
										echo '<img style=" height: 254px; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail"  src="data:image/jpeg;base64,'.base64_encode($costume->image ).'"/>'; 
									?>
									<div class="category_social_icon">
										<ul>
											<li><a href="<?php echo base_url('single_costume/edit/').$costume->id; ?>"><i class="ti-pencil-alt"></i></a></li>
										</ul>
									</div>
									<div class="category_product_text">
										<a href="<?php echo base_url('single_costume/view/').$costume->id; ?> ">
											<h5> <?php echo $costume->name ?> </h5>
										</a>
										<?php echo ($costume->item_type === 'Costume' ? '
											<p>₱'.number_format($costume->rental_prize, 2 ).'</p>
										': ''); ?>
										<label>qty:<?php echo number_format( $costume->qty )  ?> </labelP>
										
									</div>
								</div>
							</div>
						</div>
					<?php
				} 
				echo '<div class="col-lg-12 page-link-ctrl text-center" style="display: flex; align-items: center;justify-content: center;">';
					for($i=1; $i<=$total_page; $i++){  
						?>
								<div><span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="<?php echo $i; ?>"><?php echo $i; ?></span></div>
							
						<?php
					} 
				echo '</div>';
				
			} else {
				$output .= '<div class="col-lg-4 col-sm-6 "><p>No Data Found!</p></div>';
			}
			
			$output .= ob_get_clean();
			echo $output;
			
		}
		

	}
?>
