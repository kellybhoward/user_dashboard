<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->output->enable_profiler();
		$this->load->model('comment');
	}
	public function index()
	{
		redirect('/');
	}
	public function post($message_id, $author_id)
	{
		$comment = $this->input->post('comment');

		$this->comment->add_comment($message_id, $author_id, $comment);
		redirect('/');
	}
}