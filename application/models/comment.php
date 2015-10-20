<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}
	public function get_all_comments()
	{
		return $this->db->query("SELECT users.first_name, users.last_name, comment_id, comments.user_id, comment, date_format(comments.created_at, '%b %D %Y') as created_at, comments.message_id FROM comments
								JOIN messages ON comments.message_id = messages.message_id
								JOIN users ON comments.user_id = users.user_id")->result_array();
	}
	public function add_comment($message_id, $author_id, $comment)
	{
		$query = "INSERT INTO comments (user_id, comment, created_at, message_id) VALUES (?, ?, NOW(), ?)";
		$values = [$author_id, $comment, $message_id];

		return $this->db->query($query, $values);
	}
}