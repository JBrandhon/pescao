<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Admin extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        // Load form validation ibrary & user model 
        $this->load->library('form_validation'); 
        $this->load->model('user'); 
        $this->load->model('reports'); 
        $this->load->model('rentee'); 
		$this->load->model('inventory_model', 'model', TRUE);
         
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 

    public function index(){ 
	
        if($this->isUserLoggedIn){ 
            redirect('admin/dashboard'); 
        }else{ 
            redirect('admin/login'); 
        } 
    } 
	
    public function dashboard(){ 
        $data = array(); 
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->user->getRows($con); 
             
            // Pass the user data and load view 
            $this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId')
			]); 
            $this->load->view('admin/dashboard',[ 
				'costumes' => $this->model->all(),
				]); 
            $this->load->view('elements/footer'); 
        }else{ 
            redirect('admin/login'); 
        } 
    } 
     
	 public function profile(){ 

        if($this->isUserLoggedIn){
			
        $data = $userData = array();
		$stat ;
		$user_id =   $this->session->userdata('userId');
         
        // If registration request is submitted 
        if($this->input->post('signupSubmit')){ 
			

			
			if( $this->input->post('password') == '' ){
					
					$this->form_validation->set_rules('first_name', 'First Name', 'required'); 
					$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
					$this->form_validation->set_rules('password', 'password'); 
					$this->form_validation->set_rules('conf_password', 'confirm password'); 
					$stat = $this->form_validation->run();
					$userData = array( 
						'first_name' => strip_tags($this->input->post('first_name')), 
						'last_name' => strip_tags($this->input->post('last_name')), 
						'email' => strip_tags($this->input->post('email')),
						'gender' => $this->input->post('gender'), 
						'phone' => strip_tags($this->input->post('phone')) 
					); 
					

				
			}else{
				
				    $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
					$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
					$this->form_validation->set_rules('password', 'password', 'required'); 
					$this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 
					$stat = $this->form_validation->run();
				$userData = array( 
					'first_name' => strip_tags($this->input->post('first_name')), 
					'last_name' => strip_tags($this->input->post('last_name')), 
					'email' => strip_tags($this->input->post('email')), 
					'password' => md5($this->input->post('password')), 
					'gender' => $this->input->post('gender'), 
					'phone' => strip_tags($this->input->post('phone')) 
				); 

			}
            	if($this->form_validation->run() == true){ 
				// echo $user_id;
					$update = $this->user->update_profile($userData , $user_id); 
				}else{ 
					$data['error_msg'] = 'Please fill all the mandatory fields.'; 
				} 
        } 
         
		// print_r( $userData );

            $this->load->view('elements/header', [
				'admin_id' => $this->session->userdata('userId')
			]); 
            $this->load->view('admin/profile',[ 
				'user' => $this->user->user_profile( $user_id ),
				]); 
            $this->load->view('elements/footer'); 
			
        }else{ 
            redirect('admin/login'); 
        } 
    } 
 
    public function login(){ 
        $data = array(); 
         
        // Get messages from the session 
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
         
        // If login request submitted 
        if($this->input->post('loginSubmit')){ 
            $this->form_validation->set_rules('username', 'username', 'required'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
        
            if($this->form_validation->run() == true){ 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        'username'=> $this->input->post('username'), 
                        'password' => md5($this->input->post('password')), 
                        'status' => 1 
                    ) 
                ); 
				
				echo $this->user->getRows($con);
				
                $checkLogin = $this->user->getRows($con); 
								
                if($checkLogin){ 
					$this->session->set_userdata('sessionReciept',''); 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin['id']); 
                    // $this->session->set_userdata('userId', $checkLogin['is_super_admin']); 
                    redirect('admin/dashboard/'); 
                }else{ 
                    $data['error_msg'] = 'Wrong username or password, please try again.'; 
					
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         
        // Load view 
        $this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
	
        $this->load->view('admin/login', $data); 
        $this->load->view('elements/footer'); 
    } 
 
    public function registration(){ 
        $data = $userData = array(); 
         
        // If registration request is submitted 
        if($this->input->post('signupSubmit')){ 
            $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('username', 'Username', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 
 
            $userData = array( 
                'first_name' => strip_tags($this->input->post('first_name')), 
                'last_name' => strip_tags($this->input->post('last_name')), 
                'username' => strip_tags($this->input->post('username')), 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')), 
                'gender' => $this->input->post('gender'), 
                'phone' => strip_tags($this->input->post('phone')) 
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->user->insert($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('admin/users'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
         
        // Posted data 
        $data['user'] = $userData; 
         
        // Load view 
        $this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
        $this->load->view('admin/registration', $data); 
        $this->load->view('elements/footer'); 
    } 
	
     
    public function logout(){ 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('admin/login/'); 
    } 
	
    public function sort_report(){ 
        $dateRange = array( 
                'start' => $this->input->post('start'),
                'end' => $this->input->post('end'),
            ); 
	
		$sorted =  $this->reports->sort_report( $this->input->post('start'),  $this->input->post('end'));

		 echo json_encode($sorted);
		return $sorted;
    } 
	
	public function rentor_sort_report(){ 
        $dateRange = array( 
                'start' => $this->input->post('start'),
                'end' => $this->input->post('end'),
            ); 
	
		$sorted =  $this->reports->sort_rentor_report( $this->input->post('start'),  $this->input->post('end'));

		 echo json_encode($sorted);
		return $sorted;
    }
	
	public function borrower_sort_report(){ 
        $dateRange = array( 
                'start' => $this->input->post('start'),
                'end' => $this->input->post('end'),
            ); 
	
		$sorted =  $this->reports->sort_borrower_report( $this->input->post('start'),  $this->input->post('end'));

		 echo json_encode($sorted);
		return $sorted;
    } 

    public function users(){ 
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
        $this->load->view('admin/admin-users',[ 
				'users' => $this->user->getUsers(),
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    } 

	public function rentorReport(){ 
			
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
        $this->load->view('admin/rentor_report',[ 
				'records' => $this->reports->get_report(),
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    }
	public function borrowerReport(){ 
			
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
        $this->load->view('admin/borrower_report',[ 
				'records' => $this->reports->get_report(),
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    }

	public function item_lost_report(){ 


		$sorted =  $this->reports->get_lost_item_report();

		echo json_encode($sorted);
		return $sorted;

	
    }
	public function item_lost(){ 
			
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]); 
        $this->load->view('admin/lost_reports',[ 
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    }

	public function rentors(){ 
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]);  
        $this->load->view('admin/rentors',[ 
				'rentors' => $this->rentee->get_rentors(),
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    } 
	
	public function borrowers(){ 
        if(!$this->isUserLoggedIn){ 
            redirect('admin/login'); 
		}
	
		
		$this->load->view('elements/header', [
			'admin_id' => $this->session->userdata('userId')
		]);  
        $this->load->view('admin/borrowers',[ 
				'rentors' => $this->rentee->get_rentors(),
				'admin_id' => $this->session->userdata('userId')
				]); 
        $this->load->view('elements/footer'); 
    } 
   
   
   public function deleteUser(){ 
		$id =  $this->input->post('id');
		echo 'wtf:',$id;
        return $this->user->deleteUser($id);
   }
   


   public function edit(){ 

		$userData = array(
			'id' =>  strip_tags( $this->input->post('ID') ),
			'first_name' =>  strip_tags( $this->input->post('first_name') ),
			'last_name' =>  strip_tags( $this->input->post('last_name') ),
			'email' =>  strip_tags( $this->input->post('email') ),
			'gender' =>  strip_tags( $this->input->post('gender') ),
			'phone' =>  strip_tags( $this->input->post('phone') ),
			'password' =>  strip_tags( $this->input->post('npass') )
		);			

   
		
		$status = $this->user->update($userData); 
		 
		if($status) {
			$this->users();
		}else{
			echo 'There`s Something Wrong';
			
		}
        
   }
   
     
    // Existing email check during validation 
    public function email_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->user->getRows($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('email_check', 'The given email already exists.'); 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    } 
}