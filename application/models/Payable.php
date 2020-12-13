<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Payable extends CI_Model{ 

		private $table = 'tbl_payable';
		// private $table = 'tbl_inventory';

		public function __construct()
		{
			parent::__construct();
		}

		public function paylist( $data = array() )
		{	
			
			$insert = $this->db->insert($this->table, $data); 
			
			return $insert;
		}

	}
?>		