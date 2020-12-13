<?php
	class Pages extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();

			$this->load->model('inventory_model', 'model', TRUE);
		}
		
		public function view($page = 'home')
		{
				if ( ! file_exists(APPPATH.'views/public/'.$page.'.php'))
				{
						// Whoops, we don't have a page for that!
						show_404();
				}
				$data['page_id'] = 10;
				$data['title'] = ucfirst($page); // Capitalize the first letter

			
				$this->load->view('elements/header', [
					'admin_id' => $this->session->userdata('userId')
				]); 
				$this->load->view('public/'.$page, [
					'images' => $this->model->all(),
				]);
				$this->load->view('elements/footer', $data);
		}
		public function userid()
		{
				$page_id = $this->uri->segment(3); 
				echo $page_id;
		}

	}
?>
