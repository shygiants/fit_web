<?php
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function register($data)
	{
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('User', $data);
	}

	function getByEmail($email)
	{
		return $this->db->get_where('User', array('email' => $email))->row();
	}
}

?>