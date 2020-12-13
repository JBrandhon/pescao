<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Cart extends CI_Model{ 

		private $table = 'tbl_cart';
		// private $table = 'tbl_inventory';

		public function __construct()
		{
			parent::__construct();
			$recieptId = $this->session->userdata('sessionReciept'); 
		}

		public function save( $data = array() )
		{	

			$query = $this->db->query("SELECT * FROM tbl_cart WHERE item_id=".$data['item_id']." AND reciept_number='".$this->recieptId."'");
			$result = $query->num_rows();
			
			$available = $this->db->query("SELECT * FROM tbl_4_rent WHERE id=".$data['item_id']." ");
			$old_available_rent = $available->result_array();
			
			// $available_qty = $available_rent[0]['qty'];
			$order_qty = $data['qty'];
			$id =  $data['item_id'];

		    if ( $result > 0  ) 
		   {
			  $old_qty = $this->db->query("SELECT qty FROM tbl_cart WHERE item_id=".$data['item_id']." AND reciept_number='".$this->recieptId."' ");
			  $oqty = $old_qty->result_array();
			  
			  $this->add_qty( $oqty[0]['qty'], $order_qty, $id);
			   
			  $str = $this->db->update_string('tbl_cart', $data, " item_id=".$data['item_id']." AND reciept_number='".$this->recieptId."' ");
			  $this->db->query($str);
			  
			   return  true;
	 
		   } else {
			   
			 $insert = $this->db->insert($this->table, $data); 
			 
			 return $this->deduct_qty( $old_available_rent[0]['qty'], $order_qty ,$id);

		   }
		   		   
			
		}
		
		public function deduct_qty( $old_available_rent, $order_qty, $id ){
			
			$available = $this->db->query("SELECT * FROM tbl_4_rent WHERE id=".$id." ");
			$available_rent = $available->result_array();
			$available_qty = $available_rent[0]['qty'];
			
			$qty = $available_qty - $order_qty;
		   // $update_qty = array(
			// 'qty' => $qty 
		   // );
		   
		   $query= "UPDATE `tbl_4_rent` SET `qty` = ".$qty."   WHERE `id` = ".$id." ";
		   return $this->db->query($query);
			// $this->db->set($update_qty);
			// $this->db->where('id',$id);
			// $this->db->update('tbl_4_rent');

		}
		public function add_qty( $old_qty, $order_qty, $id ){
			
			$available = $this->db->query("SELECT * FROM tbl_4_rent WHERE id=".$id." ");
			$available_rent = $available->result_array();
			$available_qty = $available_rent[0]['qty'];
			
			$final_qty = 0;
			$qty = 0;
			
			if( $old_qty > $order_qty ){
				
				$final_qty = $old_qty - $order_qty;
				$qty = $available_qty + $final_qty;
				
			}else{
				$final_qty = $order_qty - $old_qty;
				$qty = $available_qty - $final_qty;
				
			}
			
		   // $update_qty = array(
			// 'qty' => $qty 
		   // );
		   
		   $query= "UPDATE `tbl_4_rent` SET `qty` = ".$qty."   WHERE `id` = ".$id." ";
		   return $this->db->query($query);
			// $this->db->set($update_qty);
			// $this->db->where('id',$id);
			// $this->db->update('tbl_4_rent');

		}
		
		
		public function get_cart( $id )
		{	
		
		$this->db->select('tbl_4_rent.* , tbl_history.*');
		$this->db->from('tbl_4_rent');
		$this->db->join('tbl_history', 'tbl_4_rent.id = tbl_history.item_id');
		$this->db->where('tbl_history.reciept_number',$id);
		$query = $this->db->get();
        $data  = $query->result_array();
		return $data;
		
		}
		
		public function get_status( $id )
		{	
		
			$query = $this->db->query("SELECT status FROM tbl_rentee  WHERE `reciept_number` = '".$id."'");
			$result = $query->result_array();
			return $result;
		
		}

		public function ifcart( $id )
		{	
		
			$query = $this->db->query("SELECT * FROM tbl_cart  WHERE `reciept_number` = '".$id."'");
			$result = $query->num_rows();
			return $result;
		
		}
		public function update_status( $cart )
		{	
			 $query = $this->db->query("UPDATE tbl_rentee SET `status`='Unpaid' WHERE `reciept_number` ='".$cart['reciept_number']."' AND id = '".$cart['renters_id']."'; ");
			$result = $query->num_rows();
			 return $result;
		
		}

	}
?>		