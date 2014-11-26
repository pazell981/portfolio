<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function index(){
		$this->load->model("blog");
		$this->load->model("administer");
		$userinfo = $this->session->userdata('userinfo');
		$view_data["blogs"] = $this->administer->get_blog_by_user_id($userinfo["id"]);
		$comments = $this->blog->get_comments();
		$posts = $this->blog->get_posts($userinfo['id']);
		$view_posts = array();
		for($i=0; $i<count($posts); $i++) {
			$comments_for_post=array();
			for($j=0; $j<count($comments);$j++){
				if($posts[$i]['id']==$comments[$j]['post_id'])
					$comments_for_post[]=$comments[$j];
			}
			$view_posts[$i]=$posts[$i];
			$view_posts[$i]['comments']=$comments_for_post;
		}
		$view_data["posts"] = $view_posts;
		$this->load->view("wall",$view_data);
	}
	public function add_comment(){
		$this->load->model("blog");
		$comment_info = array(
				"userid"	=>	$this->input->post("userid"),
				"post_id"	=>	$this->input->post("post_id"),
				"comment"	=>	$this->input->post("comment"),
			);
		$this->blog->add_comment($comment_info);
		redirect(base_url("/blogs/index"));
	}
	public function add_post(){
		$this->load->model("blog");
		$post_info = array(
				"userid"	=>	$this->input->post("userid"),
				"post"		=>	$this->input->post("post"),
				"blog_id"	=>	$this->input->post("blog_id")
			);
		$this->blog->add_post($post_info);
		redirect(base_url("/blogs/index"));
	}
	public function blog(){
		$this->load->model("administer");
		$userinfo = $this->session->userdata("userinfo");
		$view_data["blogs"] = $this->administer->get_blog_by_user_id($userinfo["id"]);
		$view_data["blog_id"] = NULL;
		$this->load->view("blog", $view_data);
	}
	public function delete_comment(){
		$this->load->model("blog");		
		$id = $this->input->post("comment_id");
		$this->blog->delete_comment($id);
		redirect(base_url("/blogs/index"));
	}
	public function delete_post(){
		$this->load->model("blog");
		$id = $this->input->post("post_id");
		$this->blog->delete_post($id);
		redirect(base_url("/blogs/index"));
	}
	public function select_blog(){
		$this->load->model("blog");
		$this->load->model("administer");
		$userinfo = $this->session->userdata("userinfo");
		$view_data["blogs"] = $this->administer->get_blog_by_user_id($userinfo["id"]);
		$blog_id = $this->input->post("blog_id");
		$blog_name = $this->blog->get_blog_name($blog_id);
		$comments = $this->blog->get_comments();
		$posts = $this->blog->get_posts_per_blog($blog_id);
		$view_posts = array();
		for($i=0; $i<count($posts); $i++) {
			$comments_for_post=array();
			for($j=0; $j<count($comments);$j++){
				if($posts[$i]['id']==$comments[$j]['post_id'])
					$comments_for_post[]=$comments[$j];
			}
			$view_posts[$i]=$posts[$i];
			$view_posts[$i]['comments']=$comments_for_post;
		}
		$view_data["blog_name"] = $blog_name;
		$view_data["blog_id"] = $blog_id;
		$view_data["blogposts"]=$view_posts;
		$this->load->view("blog", $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */