<?php
class Event_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function setRating($rating) {
		$existing = $this->db->get_where('Rate', array(
			'user_id' => $rating['user_id'],
			'fashion_id' => $rating['fashion_id']))->row();
		if ($existing != null) {
			$this->db
			->where('id', $existing->id)
			->set('created_date', 'NOW()', FALSE)
			->update('Rate', array('type_id' => $rating['type_id']));
		}
		else {
			$this->db->set('created_date', 'NOW()', FALSE);
			$this->db->insert('Rate', $rating);
		}
	}

	public function getRating($typeId) {
		$rating = $this->db
		->select('rating')
		->from('RatingType')
		->where('type_id', $typeId)->get()->row();

		return $rating;
	}

	public function getRatingTypes() {
		$types = $this->db
		->select('id, label')
		->from('RatingType')->get()->result();

		return $types;
	}
}
?>