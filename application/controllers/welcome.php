<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->enable_profiler();
	}

	//Loading basic views: home, signin, and register OR redirect to users/dashboard if logged in
	public function index()
	{
		if($this->session->userdata("logged_in") == true){
			redirect("users/dashboard");
		}
		else
		{
			$this->load->view('home');
		}
	}
	public function signin()
	{
		$this->load->view('signin');
	}
	public function register()
	{
		$this->load->view('register');
	}

	//Check if user is an admin before loading the add user page. If not admin, redirect to home/dashboard
	public function add()
	{
		if($this->session->userdata('user_level') == 9)
		{	
			$this->load->view('add');
		}
		else{
			redirect("/");
		}
	}

	//Get user info from email in session to populate the edit user profile page
	public function edit()
	{
		$this->load->model('user');
		$user_info = $this->user->get_user_by_email($this->session->userdata('email'));
		$data = ['user_info'=>$user_info];
		$this->load->view('edit', $data);
	}

	//Check if admin before loading Edit User page. Load info from $id passed to the method
	public function edit_user($id)
	{
		if($this->session->userdata('user_level') == 9)
		{	
			$this->load->model('user');
			$user_info = $this->user->get_user_by_id($id);			
			$data = ['user_info'=>$user_info];
			$this->load->view('edit_user', $data);
		}
		else{
			redirect("/");
		}
	}
	public function profile()
	{
		$this->load->model('user');
		$user_info = $this->user->get_user_by_email($this->session->userdata('email'));
		$profile_id = $user_info['user_id'];
		$this->load->model('message');
		$all_messages = $this->message->get_all_messages($profile_id);
		$this->load->model('comment');
		$all_comments = $this->comment->get_all_comments();
		$data = ['user_info'=>$user_info, 'all_messages'=>$all_messages, 'all_comments'=>$all_comments];
		
		$this->load->view('profile', $data);
	}
	public function user_profile($id)
	{
		$this->load->model('user');
		$user_info = $this->user->get_user_by_id($id);
		// var_dump($user_info);
		// die();
		$profile_id = $user_info['user_id'];
		$this->load->model('message');
		$all_messages = $this->message->get_all_messages($profile_id);
		$this->load->model('comment');
		$all_comments = $this->comment->get_all_comments();
		$data = ['user_info'=>$user_info, 'all_messages'=>$all_messages, 'all_comments'=>$all_comments];

		$this->load->view('profile', $data);
	}
}