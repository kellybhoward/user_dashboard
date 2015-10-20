<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}

	public function validate_login($login_info) 
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_database');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

	    if($this->form_validation->run()) 
	    {
	    	return "valid";
	    } 
	    else 
	    {
	    	return array(validation_errors());
	    }
	}

	public function validate_registration($post) 
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[users.email]|valid_email|required');
	    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[confirm_password]|required|md5');
	    if($this->form_validation->run()) 
	    {
	    	return "valid";
	    } 
	    else 
	    {
	    	return array(validation_errors());
	    }
	}

	public function validate_update($update)
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
	    if($this->form_validation->run()) 
	    {
	    	return "valid";
	    } 
	    else 
	    {
	    	return array(validation_errors());
	    }
	}

	public function validate_user($updated_user)
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|alpha|required|xss_clean');
	    $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
	    $this->form_validation->set_rules('user_level', 'User Level', 'trim|numeric|required');
	    if($this->form_validation->run()) 
	    {
	    	return "valid";
	    } 
	    else 
	    {
	    	return array(validation_errors());
	    }
	}

	public function validate_password($updated_password)
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[confirm_password]|required|md5');
	    if($this->form_validation->run()) 
	    {
	    	return "valid";
	    } 
	    else 
	    {
	    	return array(validation_errors());
	    }
	}

	public function validate_description($updated_description)
	{
		$this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('description', 'Description', 'trim|min_length[3]|xss_clean');
	    if($this->form_validation->run())
	    {
	    	return "valid";
	    }
	    else
	    {
	    	return array(validation_errors());
	    }
	}

	public function update_profile($updated_profile)
	{
		$sql = "UPDATE users SET email=?, first_name=?, last_name=? WHERE user_id=?";
		return $this->db->query($sql, $updated_profile);
	}

	public function update_password($updated_password)
	{
		$sql = "UPDATE users SET password=? WHERE user_id=?";
		return $this->db->query($sql, $updated_password);
	}

	public function update_description($updated_description)
	{
		$sql = "UPDATE users SET description=? WHERE user_id=?";
		return $this->db->query($sql, $updated_description);
	}

	public function update_user($updated_user)
	{
		$sql = "UPDATE users SET email=?, first_name=?, last_name=?, user_level=? WHERE user_id=?";
		return $this->db->query($sql, $updated_user);
	}

	public function login($email, $password)
	{
	    $this -> db -> select('email', 'password', 'id');
	    $this -> db -> from('users');
	    $this -> db -> where('email', $email);
	    $this -> db -> where('password', md5($password));
	    $this -> db -> limit(1);
	 
	    $query = $this -> db -> get();
	 
	    if($query -> num_rows() == 1)
	    {
	    	return $query->result();
	    }
	    else
	    {
	    	return false;
	    }
	}

	public function get_user_by_email($email)
	{
		return $this->db->query("SELECT first_name, last_name, email, user_level, date_format(users.created_at, '%b %D %Y') as created_at, description, user_id FROM users WHERE email =?", $email)->row_array();
	}

	public function get_user_by_id($id)
	{
		return $this->db->query("SELECT first_name, last_name, email, user_level, description, date_format(users.created_at, '%b %D %Y'), user_id as created_at, user_id FROM users WHERE user_id =?", $id)->row_array();
	}

	public function get_all_users(){
		return $this->db->query("SELECT user_id, concat(first_name, ' ', last_name) as name, email, date_format(users.created_at, '%b %D %Y') as created_at, user_level FROM users")->result_array();
	}
	public function get_all_users_separate(){
		return $this->db->query("SELECT user_id, first_name, last_name, email, date_format(users.created_at, '%b %D %Y') as created_at, user_level FROM users")->result_array();
	}
	
	public function add_user($user_info)
	{
		
		$query = "INSERT INTO users (first_name, last_name, email, password, user_level, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
		$values = [$user_info['first_name'], $user_info["last_name"], $user_info['email'], $user_info['password'], $user_info['user_level']];

		return $this->db->query($query, $values);
	}

	public function delete_user_by_id($id){
		return $this->db->query("DELETE FROM users WHERE user_id = ?", $id);
	}
}