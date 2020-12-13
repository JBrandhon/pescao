<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Rentee extends CI_Model{ 

		private $table = 'tbl_rentee';
		// private $table = 'tbl_inventory';

		public function __construct()
		{
			parent::__construct();
		}
		
		public function saveRentee( $data = array() )
		{	

			$insert = $this->db->insert($this->table, $data); 
			return $insert?$this->db->insert_id():false;
		}

		public function get_rentee($id)
		{	
		
			$this->db->select('*');
			$this->db->from('tbl_rentee');
			$this->db->where('reciept_number',$id);

			$query = $this->db->get();
			$data  = $query->result_array();
			return $data;
		
		}
		
		public function get_rentors()
		{
			// $del = $this->db->query("SELECT * FROM tbl_rentee WHERE NOT EXISTS (SELECT * FROM  tbl_cart WHERE  tbl_cart.reciept_number = tbl_rentee.reciept_number )");
			// $del->result();

			//print_r($del->result());
			$q = $this->db->get($this->table);
				
			 //$rentor = $this->db->query("SELECT * FROM tbl_rentee  WHERE NOT EXISTS (SELECT * FROM  `tbl_cart` WHERE  `tbl_cart`.reciept_number = tbl_rentee.reciept_number )");

			//$rentor = $this->db->query("SELECT * FROM tbl_rentee WHERE EXISTS (SELECT * FROM  tbl_history WHERE  tbl_history.reciept_number = tbl_rentee.reciept_number )");
			return $q->result();
		}

	}
?>		