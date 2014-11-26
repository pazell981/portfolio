<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Los_Angeles');

class Blog extends CI_Model{
	function add_comment($comment_info){
         $query = "INSERT INTO comments (post_id, user_id, comment, created_on, updated_on) VALUES (?,?,?,?,?)";
         $values = array($comment_info['post_id'], $comment_info['userid'], $comment_info['comment'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
    }
    function add_post($post_info){
         $query = "INSERT INTO posts (user_id, post, created_on, updated_on, blogs_id) VALUES (?,?,?,?,?)";
         $values = array($post_info['userid'], $post_info['post'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"), $post_info['blog_id']); 
         return $this->db->query($query, $values);
    }
    function delete_comment($id){
        return $this->db->query("DELETE FROM comments WHERE id=?",array($id));
    }
    function delete_post($id){
        return $this->db->query("DELETE FROM posts WHERE id=?",array($id));
    }
    function get_blog_name($blog_id){
        return $this->db->query("SELECT name FROM blogs WHERE id=?", array($blog_id))->row_array();
    }
    function get_comments(){
        $query = "SELECT comments.id, comments.post_id, comments.user_id, comments.comment, comments.created_on, users.first_name, users.last_name FROM comments JOIN users ON comments.user_id=users.id ORDER BY comments.created_on DESC";
        return $this->db->query($query)->result_array();
    }
    function get_posts($user_id){
		return $this->db->query("SELECT users.first_name, users.last_name, blogs.name, posts.id, posts.user_id, posts.post, posts.created_on FROM posts JOIN blogs ON posts.blogs_id=blogs.id JOIN users ON posts.user_id=users.id WHERE blogs.id IN (SELECT blogs_ID FROM admin WHERE users_id=?) ORDER BY posts.created_on DESC", array($user_id))->result_array();
	}
    function get_posts_per_blog($blog_id){
        return $this->db->query("SELECT users.first_name, users.last_name, blogs.name, posts.blogs_id, posts.id, posts.user_id, posts.post, posts.created_on FROM posts JOIN blogs ON posts.blogs_id=blogs.id JOIN users ON posts.user_id=users.id WHERE blogs.id=? ORDER BY posts.created_on DESC", array($blog_id))->result_array();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */