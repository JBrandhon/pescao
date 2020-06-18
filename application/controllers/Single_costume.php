<?php
	class Single_costume extends CI_Controller {

		public function view($page = 'single-costume')
		{
				if ( ! file_exists(APPPATH.'views/public/'.$page.'.php'))
				{
						// Whoops, we don't have a page for that!
						show_404();
				}
				$data['page_id'] = 10;
				$data['title'] = ucfirst($page); // Capitalize the first letter

				$this->load->view('elements/header', $data);
				$this->load->view('public/'.$page, $data);
				$this->load->view('elements/footer', $data);
		}

	}
?>
