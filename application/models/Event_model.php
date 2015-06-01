<?php
use predictionio\EventClient;
use predictionio\EngineClient;

class Event_model extends Fit_Model {

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

		$client = new EventClient($this->accessKey, $this->eventServerURL, 10, 10);
		$response = $client->createEvent(array(
						'event' => 'rate',
						'entityType' => 'user',
						'entityId' => $this->input->post('user_id'),
						'targetEntityType' => 'item',
						'targetEntityId' => $this->input->post('fashion_id'),
						'properties' => array(
							'rating' => (float)($this->event_model->getRating($this->input->post('type_id'))))
						));
	}

	public function getRating($typeId) {
		$rating = $this->db
		->select('rating')
		->from('RatingType')
		->where('id', $typeId)->get()->row();

		return $rating->rating;
	}

	public function getRatingTypes() {
		$types = $this->db
		->select('id, label')
		->from('RatingType')->get()->result();

		return $types;
	}

	public function comment($data) {
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Comment', $data);
	}

	public function follow($data) {
		$existing = $this->db->get_where('Follow', $data)->row();

		if ($existing != null) {
			$this->db
			->where($data)
			->delete('Follow');
			return false;
		}

		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Follow', $data);

		return true;
	}

	public function likeComment($data) {
		$existing = $this->db->get_where('LikeComment', $data)->row();

		if ($existing != null) {
			$this->db
			->where($data)
			->delete('LikeComment');
			return false;
		}

		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('LikeComment', $data);

		return true;
	}
}
?>
