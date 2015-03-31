<?php
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function register($data)
	{
		$this->db->set('Email', $data['email']);
		$this->db->set('Password', $data['password']);
		$this->db->set('First_name', $data['firstName']);
		$this->db->set('Last_name', $data['lastName']);
		$this->db->set('Registered', 'NOW()', FALSE);
		$this->db->insert('User');
	}
}

?>