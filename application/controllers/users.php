<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->enable_profiler();
		$this->load->model('user');
	}
	public function index()
	{
		redirect('/welcome');
	}
	public function login()
	{
		//loaded model already
		$result = $this->user->validate_login($this->input->post());

	    if($result == "valid") 
	    {
	    	$user_info = ['user_info'=>$this->user->get_user_by_email($this->input->post("email"))];
	    	$this->session->set_userdata('user_level', $user_info['user_info']['user_level']);
	    	$this->session->set_userdata('user_id', $user_info['user_info']['user_id']);
	    	$this->session->set_userdata('logged_in', true);
	    	$this->session->set_userdata('email', $user_info['user_info']['email']);
	    	redirect('/users/dashboard');
	    }
		else
		{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/welcome/signin");
	    }
	}

	function check_database($email)
	{
	    $email = $this->input->post('email');
	    $password = md5($this->input->post('password'));
	    
	    $result = $this->user->login($email, $password);

	    if($result)
	    {
	    	return TRUE;
	    }
	    else
	    {
	    	$this->form_validation->set_message('check_database', 'Invalid username or password');
	    	return false;
	    }
	}

	public function register()
	{

		//loaded model already
	    $result = $this->user->validate_registration($this->input->post());

	    if($result == "valid") 
	    {
	    	//if get all users == null, set user_level to 9, else user_level ==1
	    	$empty = $this->user->get_all_users();
	    	
	    	if($empty[0] != null){
		    	$user_level = 1;
		    }
		    else
		    {
		    	$user_level = 9;
		    }
		    
			$first_name = $this->input->post("first_name");
			$last_name = $this->input->post("last_name");
			$email = $this->input->post("email");
			$password = md5($this->input->post("password"));
			
			$user_info = ["first_name"=>$first_name, "last_name"=>$last_name, "email"=>$email, "password"=>$password, "user_level"=>$user_level];

			$this->user->add_user($user_info);
			$user_info = ['user_info' =>$this->user->get_user_by_email($this->input->post("email"))];
			$this->session->set_userdata('user_level', $user_level);
			$this->session->set_userdata('logged_in', true);
	    	redirect('/users/dashboard');
	    }
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/welcome/register");
	    }
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function dashboard()
	{
		$user_info = $this->user->get_all_users();
		$data = ['user_info'=>$user_info];
		if($this->session->userdata('user_level') == 9){
			$this->load->view('admin_dashboard', $data);
		}
		else
		{
			$this->load->view('dashboard', $data);
		}
	}

	public function add()
	{

		//loaded model already
	    $result = $this->user->validate_registration($this->input->post());

	    if($result == "valid") 
	    {
	    	//if get all users == null, set user_level to 9, else user_level ==1
	    	$empty = $this->user->get_all_users();
	    	
	    	if($empty[0] != null){
		    	$user_level = 1;
		    }
		    else
		    {
		    	$user_level = 9;
		    }
		    
			$first_name = $this->input->post("first_name");
			$last_name = $this->input->post("last_name");
			$email = $this->input->post("email");
			$password = md5($this->input->post("password"));
			
			$user_info = ["first_name"=>$first_name, "last_name"=>$last_name, "email"=>$email, "password"=>$password, "user_level"=>$user_level];

			$this->user->add_user($user_info);
			$user_info = ['user_info' =>$this->user->get_user_by_email($this->input->post("email"))];
			$this->session->set_userdata('logged_in', true);
	    	redirect('/users/dashboard');
	    }
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/welcome/add");
	    }
	}

	public function edit_info($id)
	{
		$updated_profile = $this->input->post();
		$result = $this->user->validate_update($updated_profile);
		if($result == "valid") 
	    {
			$this->user->update_profile($updated_profile);
			redirect('/users/dashboard');
		}
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/edit");
	    }
	}

	public function edit_password($id)
	{
		$updated_password = $this->input->post();
		$result = $this->user->validate_password($updated_password);
		if($result == "valid") 
	    {
	    	$updated_password = ['password'=>md5($this->input->post("password")), 'user_id'=>$id];
			$this->user->update_password($updated_password);
			redirect('/users/dashboard');
		}
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/edit");
	    }
	}

	public function edit_description($id)
	{
		$updated_description = $this->input->post();
		$result = $this->user->validate_description($updated_description);
		if($result == "valid")
		{
			$updated_description = ['description'=>$this->input->post('description'), 'user_id'=>$id];
			$this->user->update_description($updated_description);
			redirect('/users/dashboard');
		}
		else
		{
			$errors = array(validation_errors());
			$this->session->set_flashdata('errors', $errors);
			redirect('/edit');
		}
	}

	public function edit_user($id)
	{
		$updated_user = $this->input->post();
		$result = $this->user->validate_user($updated_user);
		if($result == "valid") 
	    {
			$this->user->update_user($updated_user);
			redirect('/users/dashboard');
		}
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/edit_user/$id");
	    }
	}

	public function edit_user_password($id)
	{
		$updated_password = $this->input->post();
		$result = $this->user->validate_password($updated_password);
		if($result == "valid") 
	    {
	    	$updated_password = ['password'=>md5($this->input->post("password")), 'user_id'=>$id];
			$this->user->update_password($updated_password);
			redirect('/users/dashboard');
		}
	    else{
	    	$errors = array(validation_errors());
	    	$this->session->set_flashdata('errors', $errors);
	    	redirect("/edit_user/$id");
	    }
	}

	public function delete_user($id)
	{
		$this->user->delete_user_by_id($id);
		redirect("/users/dashboard");
	}
}