<?php
require_once("library/vendor/autoload.php");
use predictionio\EventClient;

class User_model extends CI_Model {
	private $accessKey = 'To5PPEhDmUF3rAnUwHZrn2ORSIZSuf7IOIdAWMXxfT2MZhcGzF31kWIlCJFWZ42j';
	private $eventServerURL = 'http://52.68.79.109:7070';

	function __construct()
	{
		parent::__construct();
	}

	function register($data)
	{
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('User', $data);
		$client = new EventClient($this->accessKey, $this->eventServerURL);
		$response = $client->setUser($data['email']);
	}

	function getByEmail($email)
	{
		return $this->db->get_where('User', array('email' => $email))->row();
	}
}

?>