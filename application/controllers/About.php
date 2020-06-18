<?php
	class About extends CI_Controller {
		public function test(){
			 $page_id =$this->uri->segment(3); 
			 echo $page_id;
		}

	}
?>
