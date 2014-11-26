<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration extends CI_Controller {
	public function index(){
		$this->load->view("home");
	}
	public function add_blog(){
		$this->load->view("create_blog");
	}
	public function add_user(){
		$this->load->model("administer");
		$userinfo = $this->session->userdata("userinfo");
		$view_data["blogs"] = $this->administer->get_blog_by_user_id($userinfo["id"]);
		$this->load->view("add_user", $view_data);
	}
	public function create_blog(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Blog Name", "trim|required|min_length[8]|is.unique[blogs.name]");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_flashdata("blog_validation", validation_errors());
		     redirect(base_url('/administration/add_blog'));
		 }else{
		 	$this->load->model("administer");
			$bloginfo = array(
				"name"			=>	$this->input->post("name"),
				"description"	=>	$this->input->post("description")
			);
			$enter_blog = $this->administer->add_blog($bloginfo);
			if(!$enter_blog){
				$this->session->set_flashdata("create_blog","error");
				redirect(base_url('/administration/add_blog'));
			}else{
				$name = $this->input->post("name");
				$blog_id = $this->administer->get_blog_by_blog_name($name);
				$admininfo = array(
					'blog_id' 	=>	$blog_id["id"],
					'user_id' 	=>	$this->input->post("user_id"),
					'admin_lvl'	=>	0
					);
				$enter_admin = $this->administer->add_admin($admininfo);
				if ($enter_admin){
					$this->session->set_flashdata("create_blog","success");
					redirect(base_url("/administration/add_blog"));
				} else {
					$this->session->set_flashdata("create_blog","error");
					redirect(base_url("/administration/add_blog"));
				}
			}

		 }
		
	}
	public function delete_user(){
		$this->load->model("administer");
		$user_ids = array(
				"user_id" =>	$this->input->post("user_id"),
				"blog_id" =>	$this->input->post("blog_id")
			);
		$this->administer->delete_user($user_ids);
		redirect(base_url("/administration/view_users"));
	}
	public function edit_blog(){
		$this->load->model("administer");
		$userinfo = $this->session->userdata("userinfo");
		$view_data["blogs"] = $this->administer->get_blog_by_user_id($userinfo["id"]);
		$view_data["bloginfo"] = NULL;
		$this->load->view("edit_blog", $view_data);
	}
	public function edit_user($id, $blog_id){
		$this->load->model("administer");
		$user_ids = array("users_id" => $id, "blogs_id"=>$blog_id);
		$view_data["user"] = $this->administer->get_user_and_admin_by_id($user_ids);
		$this->load->view("edit_user", $view_data);
	}
	public function profile(){
		$this->load->view("edit_profile");
	}
	public function register_user(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("last_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("email", "E-mail", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|matches[passwordconf]");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_flashdata("errors", validation_errors());
		     redirect(base_url("/administration/add_user"));
		}
		else{
			$this->load->model("user");
			$this->load->model('administer');
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
			$user_id = $this->administer->get_user_id_by_email($user_info["email"]);
			$permission = array(
				"user_id" 	=> 	$user_id["id"], 
				"blog_id" 	=> 	$this->input->post("blog_id"),
				"admin_lvl"	=>	$this->input->post("admin_lvl")
				);
			$add_permission = $this->administer->add_admin($permission);
			if ($add_user && $add_permission){
				$this->session->set_flashdata("add_user","success");
				redirect(base_url("/administration/add_user"));
			} else {
				$this->session->set_flashdata("add_user","error");
				redirect(base_url("/administration/add_user"));
			}
		}
	}
	public function remove_user($id, $blog_id){
		$this->load->model("administer");
		$user_ids = array("users_id" => $id, "blogs_id"=>$blog_id);
		$view_data["user"]= $this->administer->get_user_and_admin_by_id($user_ids);
		$this->load->view("remove_user", $view_data);
	}
	public function update_blog(){
		$this->load->model("administer");
		$blogid = $this->input->post("blog_id");
		$blog_update = array(
				"blog_id" 		=> $blogid,
				"name"			=> $this->input->post("name"),
				"description"	=> $this->input->post("description")
			);
		$this->administer->update_blog($blog_update);
		$view_data["bloginfo"] = $this->administer->get_blogs_by_blog_id($blogid);
		$this->load->view("edit_blog", $view_data);
	}
	public function update_description(){
		$this->load->model("administer");
		$description = array(
			"description"	=>	$this->input->post('description'),
			"id"			=>	$this->input->post('id')
			);
		$description_update = $this->administer->update_description($description);
		if ($description_update){
			$this->session->set_flashdata("update_description","success");
			$userinfo = $this->session->userdata("userinfo");
			$userinfo["description"]=$this->input->post('description');
			$this->session->set_userdata("userinfo", $userinfo);
			redirect(base_url("/administration/profile"));
		} else {
			$this->session->set_flashdata("update_description","error");
			redirect(base_url("/administration/profile"));
		}
	}
	public function update_password(){
		$this->load->model("administer");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]|matches[passwordconf]");
		if($this->form_validation->run() === FALSE){
			$this->session->set_flashdata("errors_password", validation_errors());
		    redirect(base_url("/administration/profile"));
		}else{
			$salt=bin2hex(openssl_random_pseudo_bytes(81));
			$encrypted_password = crypt($this->input->post("password"),$salt);
			$password=array(
				"password"	=>	$encrypted_password,
				"id"		=>	$this->input->post("id")
				);
			$password_change = $this->administer->update_password($password);
			if ($password_change){
				$this->session->set_flashdata("update_password","success");
				redirect(base_url("/administration/profile"));
			} else {
				$this->session->set_flashdata("update_password","error");
				redirect(base_url("/administration/profile"));
			}
		}
	}
	public function update_profile(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("last_name", "Last Name", "trim|required|alpha");
		$this->form_validation->set_rules("email", "E-mail", "required|valid_email");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_flashdata("user_validation", validation_errors());
		     redirect(base_url('/administration/profile'));
		} else {
			$this->load->model("administer");
			$user_info = array(
				"id"			=>	$this->input->post("id"),
				"first_name"	=>	$this->input->post("first_name"),
				"last_name"		=>	$this->input->post("last_name"),
				"email"			=>	$this->input->post("email"),
			);
			$update_user = $this->administer->update_userinfo($user_info);
			if ($update_user){
				$this->session->set_flashdata("update_user","success");
				$userinfo = $this->session->userdata('userinfo');
				$userinfo["first_name"]	= $user_info["first_name"];
				$userinfo["last_name"] = $user_info["last_name"];
				$userinfo["email"] = $user_info["email"];
				$this->session->set_userdata("userinfo",$userinfo);
				redirect(base_url("/administration/profile"));
			} else {
				$this->session->set_flashdata("update_user","error");
				redirect(base_url("/administration/profile"));
			}
		}
	}
	public function update_profile_with_admin(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("last_name", "First Name", "trim|required|alpha");
		$this->form_validation->set_rules("email", "E-mail", "required|valid_email");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_flashdata("user_validation", validation_errors());
		     redirect(base_url('/administration/profile'));
		} else {
			$this->load->model("administer");
			$user_info = array(
				"id"			=>	$this->input->post("user_id"),
				"first_name"	=>	$this->input->post("first_name"),
				"last_name"		=>	$this->input->post("last_name"),
				"email"			=>	$this->input->post("email"),
			);
			$admin_info = array(
					"id"		=>	$this->input->post("user_id"),
					"blog_id"	=>	$this->input->post("blog_id"),
					"admin_lvl"	=>	$this->input->post("admin_lvl")
				);
			$update_user = $this->administer->update_userinfo($user_info);
			$update_admin = $this->administer->update_admin($admin_info);
			if ($update_user && $update_admin){
				$this->session->set_flashdata("update_user","success");
				redirect(base_url("/administration/view_users"));
			} else {
				$this->session->set_flashdata("update_user","error");
				redirect(base_url("/administration/view_users"));
			}
		}
	}
	public function view_users(){
		$this->load->model("administer");
		$userinfo = $this->session->userdata("userinfo");
		$view_data["blogusers"] = $this->administer->get_users_per_blog($userinfo['id']);
		$this->load->view("view_users",$view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
