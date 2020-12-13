<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirstPage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
 

   /**

    * Manage __construct

    *

    * @return Response

   */

   public function __construct() { 

      parent::__construct(); 

      $this->load->helper('url'); 

   }

  

   /**

    * Manage index

    *

    * @return Response

   */

   public function index() { 

       $this->load->view('admin/add_item.php');

   } 

    

   /**

    * Manage uploadImage

    *

    * @return Response

   */

   public function uploadImage() { 

   

      $data = [];

   

      $count = count($_FILES['files']['name']);

    

      for($i=0;$i<$count;$i++){

    

        if(!empty($_FILES['files']['name'][$i])){

    

          $_FILES['file']['name'] = $_FILES['files']['name'][$i];

          $_FILES['file']['type'] = $_FILES['files']['type'][$i];

          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];

          $_FILES['file']['error'] = $_FILES['files']['error'][$i];

          $_FILES['file']['size'] = $_FILES['files']['size'][$i];

  

          $config['upload_path'] = 'uploads/'; 

          $config['allowed_types'] = 'jpg|jpeg|png|gif';

          $config['max_size'] = '5000';

          $config['file_name'] = $_FILES['files']['name'][$i];

   

          $this->load->library('upload',$config); 

    

          if($this->upload->do_upload('file')){

            $uploadData = $this->upload->data();

            $filename = $uploadData['file_name'];

   

            $data['totalFiles'][] = $filename;

          }

        }

   

      }

   

      $this->load->view('imageUploadForm', $data); 

   }

  
	
	public function add_item(){ 
		
   }
		
}
