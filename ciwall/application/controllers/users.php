<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
		$this->load->view("welcome");
	}

	public function login(){
		$this->load->model("user");
		$user = $this->user->get_user_by_email($this->input->post("email"));	
		if($user==FALSE){
			$this->session->set_flashdata("login","email");
			redirect(base_url("/"));
		}  //end if
		else 
		{
			$encrypted_password = crypt($this->input->post("password"),$user['password']);
			if($user["password"] == $encrypted_password)
			{
				$userinfo = array(
					"id"			=>	$user['id'],
					"first_name"	=> 	$user['first_name'],
					"last_name"		=>	$user['last_name'],
					"email"			=>	$user['email'],
					"created_at"	=>	$user['created_at'],
					"updated_at"	=>	$user['updated_at'],
					"description"	=>	$user['description']
					);
				$this->session->set_userdata("userinfo", $userinfo);
				redirect(base_url("/administration/index"));
			} 
			else 
			{
				$this->session->set_flashdata("login","password");
				redirect(base_url("/"));
			}
		}  //end big else

		redirect(base_url("/"));

	} //end login

	public function logoff(){
        $this->session->sess_destroy();
        redirect(base_url("/users/index"));   
	}
	public function register(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
		$this->form_validation->set_rules("email", "E-mail", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|matches[passwordconf]");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_flashdata("errors", validation_errors());
		     redirect(base_url(''));
		}
		else{
			$this->load->model("user");
			$this->load->library("encrypt");
			$salt=bin2hex(openssl_random_pseudo_bytes(81));
			$encrypted_password = crypt($this->input->post("password"),$salt);
			$user_info = array(
				"first_name"=>$this->input->post("first_name"),
				"last_name"=>$this->input->post("last_name"),
				"email"=>$this->input->post("email"),
				"password"=>$encrypted_password
			);
			$add_user = $this->user->add_user($user_info);
			if ($add_user){
				$this->session->set_flashdata("add_user","success");
				redirect(base_url(""));
			} else {
				$this->session->set_flashdata("add_user","error");
				redirect(base_url(""));
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */