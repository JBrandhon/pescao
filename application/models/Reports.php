<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
	class Reports extends CI_Model{ 

		private $table = 'tbl_history';
		// private $table = 'tbl_inventory';

		public function __construct()
		{
			parent::__construct();
		}

		public function get_report()
		{	
			$this->db->select('tbl_rentee.status, tbl_rentee.user_status ,tbl_rentee.first_name , tbl_rentee.last_name, tbl_rentee.address , tbl_rentee.phone ,tbl_rentee.email ,tbl_history.*');
			$this->db->from('tbl_rentee');
			$this->db->join('tbl_history','tbl_history.reciept_number=tbl_rentee.reciept_number');
			$query=$this->db->get();
			return $query->result_array();
		}
		
		public function sort_borrower_report($start, $end){
			$query = $this->db->query("SELECT CONCAT_WS('', tbl_rentee.first_name,' ',tbl_rentee.last_name) AS `FullName` ,
				tbl_rentee.phone,
				tbl_rentee.address,
				tbl_history.item_name,
				tbl_history.rented_qty,
				tbl_history.from,
				tbl_history.payable,
				tbl_rentee.status,
				tbl_rentee.user_status
			FROM tbl_rentee,tbl_history 
			WHERE tbl_history.from BETWEEN '".$start."' AND '".$end."' AND tbl_history.reciept_number=tbl_rentee.reciept_number AND tbl_rentee.user_status = 'staff/faculty';");

			
			return $query->result();

		}
		
		public function sort_rentor_report($start, $end){
			$query = $this->db->query("SELECT CONCAT_WS('', tbl_rentee.first_name,' ',tbl_rentee.last_name) AS `FullName` ,
				tbl_rentee.phone,
				tbl_rentee.address,
				tbl_history.item_name,
				tbl_history.rented_qty,
				tbl_history.from,
				tbl_history.payable,
				tbl_rentee.status,
				tbl_rentee.user_status
			FROM tbl_rentee,tbl_history 
			WHERE tbl_history.from BETWEEN '".$start."' AND '".$end."' AND tbl_history.reciept_number=tbl_rentee.reciept_number AND tbl_rentee.user_status = 'guest';");

			
			return $query->result();

		}
		
		
		public function sort_report($start, $end){
			$query = $this->db->query("SELECT CONCAT_WS('', tbl_rentee.first_name,' ',tbl_rentee.last_name) AS `FullName` ,
				tbl_rentee.phone,
				tbl_rentee.address,
				tbl_history.item_name,
				tbl_history.rented_qty,
				tbl_history.from,
				tbl_history.payable,
				tbl_rentee.status,
				tbl_rentee.user_status
			FROM tbl_rentee,tbl_history 
			WHERE tbl_history.from BETWEEN '".$start."' AND '".$end."' AND tbl_history.reciept_number=tbl_rentee.reciept_number;");

			
			return $query->result();

		}
		
		public function get_lost_item_report(){
		$query = $this->db->query("
		SELECT tbl_4_rent.name AS item_name
			, tbl_4_rent.qty AS remaining_quantity
			, tbl_inventory.`qty_status` AS total_item_qty
			, (SELECT qty FROM tbl_lost WHERE tbl_lost.item_id = tbl_4_rent.id ) AS total_item_lost
			,  CONCAT(tbl_4_rent.rental_prize) AS rental_prize
			, CONCAT((SELECT SUM(payable) FROM tbl_history WHERE tbl_history.item_id = tbl_4_rent.id )) AS revenue
		FROM tbl_4_rent
		INNER JOIN  tbl_inventory
			ON tbl_4_rent.id = tbl_inventory.costume_id

		");
			//print_r( $query->result());
			return $query->result();

		}


	}
?>		