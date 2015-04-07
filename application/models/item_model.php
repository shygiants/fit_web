<?php
class Item_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getAttributes()
	{
		require_once("application/libraries/Attribute.php");

		$attributes = array(
			new Attribute('season_id', '시즌', $this->db->get('Season')->result()),
			new Attribute('style_id', '스타일', $this->db->get('Style')->result()),
			new Attribute('look_id', '체형', $this->db->get('Look')->result()),
			new Attribute('height_id', '키', $this->db->get('Height')->result()),
			new Attribute('age_id', '나이', $this->db->get('Age')->result()),
			new Attribute('outer_id', '아우터 종류', $this->db->get('Outer')->result()),
			new Attribute('outer_color_id', '아우터 색', $this->db->get('Color')->result()),
			new Attribute('outer_pattern_id', '아우터 무늬', $this->db->get('Pattern')->result()),
			new Attribute('top_id', '상의 종류', $this->db->get('Top')->result()),
			new Attribute('top_color_id', '상의 색', $this->db->get('Color')->result()),
			new Attribute('top_pattern_id', '상의 무늬', $this->db->get('Pattern')->result()),
			new Attribute('bottom_id', '하의 종류', $this->db->get('Bottom')->result()),
			new Attribute('bottom_color_id', '하의 색', $this->db->get('Color')->result()),
			new Attribute('bottom_pattern_id', '하의 무늬', $this->db->get('Pattern')->result()),
			new Attribute('shoe_id', '신발 종류', $this->db->get('Shoe')->result()),
			new Attribute('shoe_color_id', '신발 색', $this->db->get('Color')->result()),
			new Attribute('shoe_pattern_id', '신발 무늬', $this->db->get('Pattern')->result()),
			new Attribute('hat_id', '모자 종류', $this->db->get('Hat')->result()),
			new Attribute('hat_color_id', '모자 색', $this->db->get('Color')->result()),
			new Attribute('hat_pattern_id', '모자 무늬', $this->db->get('Pattern')->result())
			);

		return $attributes;
	}

	function add($data)
	{
		$this->db->set('created_date', 'NOW()', FALSE);
		$this->db->insert('Item', $data);

		$id = $this->db->insert_id();

		$this->load->helper('path');

		$file_name = $data['editor_id'].'_'.$id.'.jpg';

		$relative_path = 'resource/itemImg/';
		$absolute_path = set_realpath($relative_path); 
		$destination_path = $absolute_path.$file_name;
		copy($data['img_path'], $destination_path);

		$this->db->where('id', $id);
		$this->db->update('Item', array('img_path' => $relative_path.$file_name));
	}

	function get($editor_id = 0)
	{
		$query = $this->db
		->select('img_path, src_link, 
			Gender.label 성별,
			Season.label 시즌, 
			Style.label 스타일, 
			Look.label 체형,
			Height.label 키,
			Age.label 나이')
		->from('Item')
		->join('Gender', 'Gender.id = Item.gender_id')
		->join('Season', 'Season.id = Item.season_id')
		->join('Style', 'Style.id = Item.style_id')
		->join('Look', 'Look.id = Item.look_id')
		->join('Height', 'Height.id = Item.height_id')
		->join('Age', 'Age.id = Item.age_id')
		->get();

		return $query->result();
	}

	function getCardData($editor_id = 0)
	{
		return $this->db
		->select('img_path, Item.editor_id, first_name, last_name')
		->from('Item, User')
		->where('User.editor_id = Item.editor_id')
		->get()->result();
	}
}

?>