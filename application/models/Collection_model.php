<?php
class Collection_model extends Fit_Model {

	function make($data) {
		$data['user_id'];
		$data['name'];
		$data['description'];

		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Collection', $data);

		return $this->db->insert_id();
	}

	function getCollections($user_id) {
		$query = 'SELECT Fashion.id, img_path, Fashion.editor_id, first_name, last_name, Rates.type_id type_id
			FROM Fashion JOIN User ON User.editor_id = Fashion.editor_id
			JOIN (SELECT * FROM Rate WHERE user_id = '.$this->db->escape($user_id).' AND type_id != 1) Rates ON Fashion.id = Rates.fashion_id
			ORDER BY Rates.created_date DESC LIMIT 1';

		$existing = $this->db->query($query)->row();
		
		$result = array(new CollectionTuple(0, $user_id, '좋아하는 패션', '사용자가 좋아한다고 평가한 패션', ($existing != null)? base_url($existing->img_path) : null));

		$collections = $this->db->get_where('Collection', array('user_id' => $user_id))->result();

		foreach ($collections as $key => $collection) {
			$thumbnail = $this->db->select('Fashion.img_path')
			->from('Collected')
			->join('Collection', 'Collected.collection_id = Collection.id')
			->join('Rate', 'Rate.id = Collected.event_id')
			->join('Fashion', 'Fashion.id = Rate.fashion_id')
			->where('Collection.id', $collection->id)
			->order_by('Collected.created_date', 'DESC')
			->limit(1)->get()->row();
			$thumbnail = ($thumbnail != null)? base_url($thumbnail->img_path) : null;
			array_push($result, new CollectionTuple($collection->id, $collection->user_id, $collection->name, $collection->description, $thumbnail));
		}

		return $result;
	}

}
?>