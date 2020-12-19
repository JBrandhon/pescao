<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'tbl_admin'; 
    } 
     
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('id', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query 		= $this->db->get(); 
                $result 	= ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
    
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }

    public function update_profile($data = array() , $user_id ) {   
		print_r($user_id);
		// die();
		// return $data;
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("created", $data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Insert member data 
            $tbl_admin = $this->db->query(" UPDATE tbl_admin SET first_name = '".  $data['first_name'] ."' , last_name = '".  $data['last_name'] ."' , email = '".  $data['email'] ."' , password = '".  $data['password'] ."' , gender = '".  $data['gender'] ."' , phone = '".  $data['phone'] ."' , created = '".  $data['created'] ."' ,  modified = '".  $data['modified'] ."' where id = ".  $user_id ." ");
             
            // Return the status 
            return true; 
        } 
        return false; 
    }

	public function update( $data = array() )
	{	
		// print_r( $data );
		// // die();
		$updateData;
		if( $data['password'] == "" ){
			$updateData = array(
				'first_name' => $data['first_name'],
				'last_name' => $data['last_name'],
				'email' => $data['email'],
				'gender' => $data['gender'],
				'phone' => $data['phone']
			);
		}
		else{
			$updateData = array(
				'first_name' => $data['first_name'],
				'last_name' => $data['last_name'],
				'email' => $data['email'],
				'gender' => $data['gender'],
				'phone' => $data['phone'],
				'password' => md5($data['password'])
			);
		}

		$this->db->where('id', $data['id']);
		$this->db->update( $this->table, $updateData);
		
		return true;
		
	}

	public function getUsers()
	{
			$q = $this->db->get($this->table);

			return $q->result();
	}

	public function user_profile( $user_id )
	{		$query = $this->db->query(" select * from tbl_admin where id = ".$user_id." ");
			$result = $query->result_array();
			return $result;
	}
	
	public function deleteUser($id)
	{
			$query = $this->db->query(" update tbl_admin set status = 0 where id = ". $id ." ");
			// $result = $query->result_array();
			return true;
			
			// $q = $this->db->delete($this->table, array('id' => $id));
			// return true;
	}
	
}