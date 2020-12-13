<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class For_rent_model extends CI_Model{ 

		private $table = 'tbl_4_rent';
		// private $table = 'tbl_inventory';

		public function __construct()
		{
			parent::__construct();
		}

		public function get($id)
		{	

		// $query = $this->db->get('employees_tasks');
		// $ret = $query->result_array();
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id =".$id." AND  tbl_images.item_id =".$id." ; ");
			return $select->result_array();
			// $q = $this->db->get_where($this->table, ['id' => $id]);

			// return $q->result_array();
		}
		
		public function get_image($id)
		{	

		// $query = $this->db->get('employees_tasks');
		// $ret = $query->result_array();
			$select = $this->db->query(" SELECT * FROM tbl_images WHERE item_id = '".$id."'");
			return $select->result_array();
			// $q = $this->db->get_where($this->table, ['id' => $id]);

			// return $q->result_array();
		}

		public function get_remaining_qty($id)
		{	
			$q = $this->db->get_where('tbl_cart', ['item_id' => $id]);

			return $q->result_array();
		}

	}
?>		