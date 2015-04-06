<?php
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function register($data)
	{
		$this->db->set('email', $data['email']);
		$this->db->set('password', $data['password']);
		$this->db->set('first_name', $data['firstName']);
		$this->db->set('last_name', $data['lastName']);
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('User');
	}

	function getByEmail($email)
	{
		return $this->db->get_where('User', array('email' => $email))->row();
	}
}

?>