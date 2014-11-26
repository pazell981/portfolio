<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model{
	 function add_user($user_info){
         $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,?,?)";
         $values = array($user_info['first_name'], $user_info['last_name'], $user_info['email'], $user_info['password'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
     }
     function get_user_by_email($email){
		return $this->db->query('SELECT * FROM users WHERE email = ?', array($email))->row_array();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */