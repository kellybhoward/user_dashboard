<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->enable_profiler();
		$this->load->model('message');
	}
	public function index()
	{
		redirect('/');
	}
	public function post($profile_id, $author_id)
	{
		$message = $this->input->post('message');

		$this->message->add_message($profile_id, $author_id, $message);

		redirect("/welcome/user_profile/$profile_id");
	}
}