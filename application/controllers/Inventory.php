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

		public function search ( $offset = 0 )
		{	
			$output = '';
			
			$data = $this->input->post('search');

			$this->load->library('pagination');			
			$config['base_url'] 		= site_url('admin/dashboard');
			$config['total_rows']		= $this->model->count_data($data);
			$config['per_page']			= 10;
			
			$this->pagination->initialize($config);
			
			$update = $this->model->search_data( $data, $config['per_page'], $offset );
			
			ob_start();
			
			if( count($update) > 0 ){
				?><div class="search-result" style="display: contents;"><?php
				foreach( $update as  $costume	 ){
				
					if( $costume->item_status  != 'damage'){
					
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
				
				<?php } else {
					
					echo '<div class="col-lg-4 col-sm-6 ">
										<p>No Data Found!</p>
								</div>';
					
					}
				}
				 ?>
				</div>
				<div class="col-lg-12 link-page text-center">
					<div class="page-link"><?php echo $this->pagination->create_links(); ?></div>
				</div>
				<?php
				
			} else {
				
				$output .= '	<div class="col-lg-4 col-sm-6 ">
										<p>No Data Found!</p>
								</div>';
								
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
		
		public function search_category( $offset=0 ){	
			
			$output = '';
			$data 	= $this->input->post('data');

			$this->load->library('pagination');			
			$config['base_url'] 		= site_url('admin/dashboard');
			$config['total_rows']		= $this->model->count_category($data);
			$config['per_page']			= 10;
			
			$this->pagination->initialize($config);
			
			$update = $this->model->search_category( $data, $config['per_page'], $offset );
			
			ob_start();
			
			if( count($update) > 0 ){
				?><div class="search-result" style="display: contents;"><?php
				foreach( $update as  $costume ){
				
					if( $costume->item_status  == 'good' ){
					
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
				
				<?php } else {
					
					echo '<div class="col-lg-4 col-sm-6 ">
										<p>No Data Found!</p>
								</div>';
					
					}
				}
				 ?>
				</div>
				<div class="col-lg-12 link-page text-center">
					<div class="page-link"><?php echo $this->pagination->create_links(); ?></div>
				</div>
				<?php
				
			} else {
				
				$output .= '	<div class="col-lg-4 col-sm-6 ">
										<p>No Data Found!</p>
								</div>';
								
			}
			$output .= ob_get_clean();
			echo $output;
		
		}
		

	}
?>
