<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Inventory_model extends CI_Model{ 

		private $table = 'tbl_4_rent';

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
		
		
		public function countAll(){
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id WHERE tbl_4_rent.item_status = 'good' GROUP BY tbl_images.item_id;");
			return $select->num_rows();
		}
		
		public function all($limit,$offset)
		{
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id WHERE tbl_4_rent.item_status = 'good' GROUP BY tbl_images.item_id LIMIT ".$limit." OFFSET ".$offset.";"); 
			return $select->result();
			
		}

		public function item_lost($data)
		{
			echo sizeof($data);
			
			for( $a = 0 ; $a <  sizeof($data) ; $a++ ){
				if( $data[$a]['quantity'] != '0' ){
					
					
					$upsert = $this->db->query(" INSERT INTO tbl_lost SET item_id = ". $data[$a]['item_id'] ." , qty =". $data[$a]['quantity'] ." , reciept_number = ' ". $data[$a]['reciept_number'] ." ' ON DUPLICATE KEY UPDATE qty = qty +  ". $data[$a]['quantity'] ." ");
					// UPDATE tbl_inventory SET qty_status = qty_status - new.qty WHERE costume_id = new.item_id;
					//$tbl_inventory = $this->db->query(" UPDATE tbl_inventory SET qty_status = qty_status - ". $data[$a]['quantity'] ." WHERE costume_id = ".$data[$a]['item_id'] ."");
					
					$tbl_history = $this->db->query(" UPDATE tbl_history SET item_status = 'Lost' WHERE item_id = ".$data[$a]['item_id'] ." and reciept_number = '". $data[$a]['reciept_number'] ."' ");
					// UPDATE tbl_cart SET qty = qty - new.qty WHERE reciept_number = new.reciept_number;
					$tbl_cart = $this->db->query("UPDATE tbl_cart SET qty = qty - ". $data[$a]['quantity'] ." WHERE item_id = ".$data[$a]['item_id'] ." and reciept_number = '". $data[$a]['reciept_number'] ."' ");

					echo ( 'here:'. "  UPDATE tbl_history SET item_status = 'Lost' WHERE item_id = ".$data[$a]['item_id'] ." " );
					//die();
					// $result = $query->query(); 
					
				}
				
			}
			
			return true;
		}
		
		public function update( $data )
		{
			
			$this->db->set( 'qty_status' , $data['total_envintory_qty']);
			$this->db->where('costume_id', $data['id']);
			$this->db->update('tbl_inventory');
			
			unset($data['total_envintory_qty']);
			
			
			$this->db->set( $data , FALSE);
			$this->db->where('id', $data['id']);
			$this->db->update('tbl_4_rent');

			return true;
		}

		

		public function get($id)
		{
			$q = $this->db->get_where($this->table, ['id' => $id]);

			return $q->num_rows() > 0 ? $q->row()->image : '';
		}

		public function return_checkout($id)
		{
			$this->db->where('reciept_number', $id['reciept_number']);
			$this->db->delete('tbl_cart');
			 return true;
		}

		public function destroy($id)
		{
			return $this->db->delete($this->table, array('id' => $id));
		}
		
		public function update_items($id)
		{
			$q = $this->db->get_where('tbl_cart', ['reciept_number' => $id]);
			$rows = $q->num_rows();
			
			if($rows > 0 ){
				return $rows;
			}else{
				return 'empty';
			}
			
		}
		
		
		public function update_image( $item_id, $data  ){

			$this->db->set( 'image' , addslashes($data));
			$this->db->where('item_id', $item_id);
			$this->db->update('tbl_images');
			
			return true;
	
		}
		
		public function update_rent( $id ){

			$this->db->set( 'item_status', 'damage');
			$this->db->where('id', $id);
			$this->db->update('tbl_4_rent');
			
			return true;
	
		}
		
		
		public function delete_image( $item_id ){

			$this->db->query("delete  from tbl_images where id IN (" .$item_id. ")");
	
		}
		
		
		public function store_image( $item_id, $data  ){

			$insert = $this->db->query(" insert into tbl_images set item_id =  " . $item_id . " ,image ='". addslashes($data) ."' ");
			return $insert;
	
		}
		
		public function count_data($data){
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id  WHERE tbl_4_rent.item_status = 'good' AND tbl_4_rent.name LIKE '".$data."%' GROUP BY tbl_images.item_id;  ");
			return $select->num_rows();
	
		}
		
		public function search_data($key, $start_from, $record_per_page){
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id  WHERE tbl_4_rent.item_status = 'good' AND tbl_4_rent.name LIKE '".$key."%' GROUP BY tbl_images.item_id LIMIT ".$start_from.", ".$record_per_page.";");
			return $select->result();
	
		}
		
		public function count_category( $key){
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id  WHERE tbl_4_rent.item_status = 'good' AND tbl_4_rent.category = '".$key."' GROUP BY tbl_images.item_id;");
			return $select->num_rows();
	
		}

		public function search_category($key, $start_from, $record_per_page){
			
			$select = $this->db->query(" SELECT * FROM tbl_images INNER JOIN tbl_4_rent ON tbl_4_rent.id=tbl_images.item_id  WHERE tbl_4_rent.item_status = 'good' AND tbl_4_rent.category = '".$key."' GROUP BY tbl_images.item_id LIMIT ".$start_from.", ".$record_per_page.";");
			return $select->result();
			
		}
		
		public function store($data = array() )
		{
			 
			
			try {
				if ( empty($data) ) {
					return FALSE;
				} else {
					// $action = $this->db->insert($this->table, $this);
					$action = $this->db->insert($this->table, $data); 
					$insert_id = $this->db->insert_id();

					$this->flush();

					return $insert_id;
				}
			} catch (Exception $e) {
				return FALSE;
			}
		}

	}
?>