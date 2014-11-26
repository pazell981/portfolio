<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administer extends CI_Model{
	function add_admin($admininfo){
		$values = array($admininfo['user_id'], $admininfo['blog_id'], $admininfo['admin_lvl']);
		return $this->db->query('INSERT INTO admin (users_id, blogs_id, admin_lvl) VALUES (?,?,?)', $values);
	}
	function add_blog($bloginfo){
		return $this->db->query('INSERT INTO blogs (name, description) VALUES (?,?)', $bloginfo);
	}
	function delete_user($ids){
		return $this->db->query('DELETE FROM admin WHERE users_id = ? && blogs_id=?', array($ids["user_id"],$ids["blog_id"]));
	}
	function get_blog_by_blog_name($name){
		return $this->db->query('SELECT * FROM blogs WHERE name=?', array($name))->row_array();
	}
	function get_blog_by_user_id($id){
		return $this->db->query('SELECT * FROM blogs JOIN admin ON blogs.id=admin.blogs_id WHERE admin.users_id=?', array($id))->result_array();
	}
	function get_blogs_by_blog_id($id){
		return $this->db->query('SELECT * FROM blogs WHERE id= ?', array($id))->row_array();
	}
	function get_user_and_admin_by_id($ids){
		return $this->db->query('SELECT * FROM users JOIN admin ON users.id=admin.users_id WHERE admin.users_id = ? AND admin.blogs_id=?', array($ids["users_id"],$ids["blogs_id"]))->row_array();
	}
	function get_user_id_by_email($email){
		return $this->db->query('SELECT id FROM users WHERE email = ?', array($email))->row_array();
	}
	function get_user_by_id($id){
		return $this->db->query('SELECT * FROM users JOIN admin ON users.id=admin.users_id WHERE admin.users_id = ?', array($id))->row_array();
	}
	function get_users_per_blog($id){
		return $this->db->query('SELECT users.id, users.first_name, users.last_name, users.email, admin.users_id, admin.admin_lvl, admin.blogs_id, blogs.name, blogs.blog_owner_id, users.created_at FROM users JOIN admin ON users.id=admin.users_id JOIN blogs ON admin.blogs_id=blogs.id WHERE blogs.blog_owner_id=? OR blogs.id IN (SELECT blogs_ID FROM admin WHERE users_id=?) ORDER BY users.last_name', array($id, $id))->result_array();
	}
	function update_admin($admininfo){
		$values = array($admininfo['admin_lvl'],$admininfo['id'],$admininfo['blog_id']);
		return $this->db->query('UPDATE admin SET admin_lvl=? WHERE users_id=? AND blogs_id=?', $values);
	}
	function update_blog($bloginfo){
		$values = array($bloginfo['name'],$bloginfo['description'], $bloginfo['blog_id']);
		return $this->db->query('UPDATE blogs SET name=?, description=? WHERE id=?', $values);
	}
	function update_description($description){
		$query = "UPDATE users SET description=?, updated_at=? WHERE id=?";
		$values = array($description['description'], date("Y-m-d, H:i:s"), $description['id']); 
		return $this->db->query($query, $values);		
	}
	function update_password($password){
		$query = "UPDATE users SET password=?, updated_at=? WHERE id=?";
		$values = array($password['password'], date("Y-m-d, H:i:s"), $password['id']); 
		return $this->db->query($query, $values);
	}
	function update_userinfo($user_info){
		$query = "UPDATE users SET first_name=?, last_name=?, email=?, updated_at=? WHERE id=?";
		$values = array($user_info['first_name'], $user_info['last_name'], $user_info['email'], date("Y-m-d, H:i:s"), $user_info['id']); 
		return $this->db->query($query, $values);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */