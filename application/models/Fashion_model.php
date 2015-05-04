<?php
class Fashion_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getAttributes()
	{
		require_once("application/libraries/Attribute.php");

		$attributes = array(
			new Attribute('gender_id', '성별', $this->db->get('Gender')->result()),
			new Attribute('season_id', '시즌', $this->db->get('Season')->result()),
			new Attribute('style_id', '스타일', $this->db->get('Style')->result()),
			new Attribute('age_id', '나이', $this->db->get('Age')->result())
			);

		return $attributes;
	}

	function getClass()
	{
		return $this->db->get('Class')->result();
	}

	function getItemTypeByClass() {
		$classes = $this->db->select('id')->get('Class')->result();
		foreach ($classes as $class) {
			$result[$class->id] = $this->db->get_where('ItemType', array('class_id' => $class->id))->result();
		}

		return $result;
	}

	function getItemType() {
		return $this->db->get('ItemType')->result();
	}

	function getColor() {
		return $this->db->get('Color')->result();
	}

	function getPattern() {
		return $this->db->get('Pattern')->result();
	}

	function add($data) {
		foreach ($data as $key => $token) {
			if ($token->name != 'items')
				$fashionTuple[$token->name] = $token->value;
			else
				$itemTuples = $token->value;
		}

		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Fashion', $fashionTuple);

		$fashion_id = $this->db->insert_id();

		$this->load->helper('path');

		$file_name = $fashionTuple['editor_id'].'_'.$fashion_id.'.jpg';

		$relative_path = 'resource/itemImg/';
		$absolute_path = set_realpath($relative_path); 
		$destination_path = $absolute_path.$file_name;
		copy($fashionTuple['img_path'], $destination_path);

		$this->db->where('id', $fashion_id);
		$this->db->update('Fashion', array('img_path' => $relative_path.$file_name));

		foreach ($itemTuples as $key => $itemTuple) {
			$this->db->set('fashion_id', $fashion_id);
			$this->db->insert('Item', $itemTuple);
		}
	}

	function getFashionById($fashion_id) {
		$fashionTuple = $this->db
		->select('img_path, src_link, 
			Gender.label gender_label,
			first_name, last_name,
			Season.label season_label,
			Style.label style_label,
			Age.label age_label,
			Fashion.created_date created_date')
		->from('Fashion, User')
		->join('Gender', 'Gender.id = Fashion.gender_id')
		->join('Editor', 'Editor.id = Fashion.editor_id')
		->join('Season', 'Season.id = Fashion.season_id')
		->join('Style', 'Style.id = Fashion.style_id')
		->join('Age', 'Age.id = Fashion.age_id')
		->where('Fashion.id', $fashion_id)->get()->row();

		$itemTuples = $this->db->
		select('
			Class.label class_label,
			ItemType.label type_label,
			Color.label color_label,
			Pattern.label pattern_label')
		->from('Item')
		->join('ItemType', 'ItemType.id = Item.type_id')
		->join('Color', 'Color.id = Item.color_id')
		->join('Pattern', 'Pattern.id = Item.pattern_id')
		->join('Class', 'Class.id = ItemType.class_id')
		->where('Item.fashion_id', $fashion_id)->get()->result();

		$fashionTuple->img_path = base_url($fashionTuple->img_path);

		$result = array(
			'fashion' => $fashionTuple,
			'items' => $itemTuples);

		return $result;
	}

	function get($editor_id = 0)
	{
		$query = $this->db
		->select('img_path, src_link, 
			Gender.label 성별,
			Season.label 시즌, 
			Style.label 스타일, 
			Age.label 나이')
		->from('Item')
		->join('Gender', 'Gender.id = Item.gender_id')
		->join('Season', 'Season.id = Item.season_id')
		->join('Style', 'Style.id = Item.style_id')
		->join('Age', 'Age.id = Item.age_id')
		->get();

		return $query->result();
	}

	function getCardData($editor_id = 0)
	{
		$result = $this->db
		->select('id, img_path, Fashion.editor_id, first_name, last_name')
		->from('Fashion')
		->join('User', 'User.editor_id = Fashion.editor_id')
		->get()->result();

		foreach ($result as $row)
			$row->img_path = base_url($row->img_path);
		
		return $result;
	}
}

?>