<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model {

	public function __construct(){
		parent:: __construct();
	}
	public function get_all_messages($profile_id)
	{
		return $this->db->query("SELECT users.first_name, users.last_name, date_format(messages.created_at, '%b %D %Y') as created_at, message_id, messages.user_id, message FROM messages
								JOIN users ON messages.user_id = users.user_id
								WHERE messages.profile_id = $profile_id
								ORDER BY messages.message_id
								")->result_array();
	}
	public function add_message($profile_id, $author_id, $message)
	{
		$query = "INSERT INTO messages (user_id, message, created_at, profile_id) VALUES (?, ?, NOW(), ?)";
		$values = [$author_id, $message, $profile_id];

		return $this->db->query($query, $values);
	}
}