<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Inventory_model extends CI_Model{ 

		private $table = 'tbl_inventory';

		public $title;
		public $image;

		public function __construct()
		{
			parent::__construct();
		}

		public function flush()
		{
			$this->title = '';
			$this->image = '';
		}

		public function all()
		{
			$this->db->order_by('id', 'desc');
			$q = $this->db->get($this->table);

			return $q->result();
		}

		public function get($id)
		{
			$q = $this->db->get_where($this->table, ['id' => $id]);

			return $q->num_rows() > 0 ? $q->row()->image : '';
		}

		public function destroy($id)
		{
			return $this->db->delete($this->table, array('id' => $id));
		}

		public function store($data = array() )
		{
			 
			
			try {
				if (
					empty($data)
				) {
					return FALSE;
				} else {
					// $action = $this->db->insert($this->table, $this);
					 $action = $this->db->insert($this->table, $data); 
					$this->flush();

					return $action;
				}
			} catch (Exception $e) {
				return FALSE;
			}
		}

	}
?>