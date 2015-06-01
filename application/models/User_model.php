<?php
use predictionio\EventClient;

class User_model extends Fit_Model {

	function register($data) {
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('User', $data);
		
		$client = new EventClient($this->accessKey, $this->eventServerURL, 10, 10);
		$response = $client->setUser($data['email']);
	}

	function getByEmail($email) {
		return $this->db->get_where('User', array('email' => $email))->row();
	}

	function getFollowing($email) {
		$this->db->from('Follow');
		$this->db->where('follower_id', $email);
		return $this->db->count_all_results();
	}

	function getFollowed($email) {
		$this->db->from('Follow');
		$this->db->where('followed_id', $email);
		return $this->db->count_all_results();
	}

	function getRating($email) {
		$this->db->from('Rate');
		$this->db->where('user_id', $email);
		return $this->db->count_all_results();
	}

	function isFollowing($follower, $followed) {
		$this->db->from('Follow');
		$filter = array('follower_id' => $follower, 'followed_id' => $followed);
		$this->db->where($filter);
		return ($this->db->count_all_results() != 0);
	}
}
?>
