<?php
use predictionio\EventClient;

class User_model extends Fit_Model {

	function register($data)
	{
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('User', $data);
		
		$client = new EventClient($this->accessKey, $this->eventServerURL, 10, 10);
		$response = $client->setUser($data['email']);
		// $client->createEvent(array(
		// 				'event' => '$set',
		// 				'entityType' => 'user',
		// 				'entityId' => $data['email']
		// 				));
	}

	function getByEmail($email)
	{
		return $this->db->get_where('User', array('email' => $email))->row();
	}
}

?>
