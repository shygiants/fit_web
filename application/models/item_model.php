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
			new Attribute('Season', '시즌', $this->db->get('Season')->result()),
			new Attribute('Style', '스타일', $this->db->get('Style')->result()),
			new Attribute('Look', '체형', $this->db->get('Look')->result()),
			new Attribute('Height', '키', $this->db->get('Height')->result()),
			new Attribute('Age', '나이', $this->db->get('Age')->result()),
			new Attribute('Outer', '아우터 종류', $this->db->get('Outer')->result()),
			new Attribute('Outer Color', '아우터 색', $this->db->get('Color')->result()),
			new Attribute('Outer Pattern', '아우터 무늬', $this->db->get('Pattern')->result()),
			new Attribute('Top', '상의 종류', $this->db->get('Top')->result()),
			new Attribute('Top Color', '상의 색', $this->db->get('Color')->result()),
			new Attribute('Top Pattern', '상의 무늬', $this->db->get('Pattern')->result()),
			new Attribute('Bottom', '하의 종류', $this->db->get('Bottom')->result()),
			new Attribute('Bottom Color', '하의 색', $this->db->get('Color')->result()),
			new Attribute('Bottom Pattern', '하의 무늬', $this->db->get('Pattern')->result()),
			new Attribute('Shoe', '신발 종류', $this->db->get('Shoe')->result()),
			new Attribute('Shoe Color', '신발 색', $this->db->get('Color')->result()),
			new Attribute('Shoe Pattern', '신발 무늬', $this->db->get('Pattern')->result()),
			new Attribute('Hat', '모자 종류', $this->db->get('Hat')->result()),
			new Attribute('Hat Color', '모자 색', $this->db->get('Color')->result()),
			new Attribute('Hat Pattern', '모자 무늬', $this->db->get('Pattern')->result())
			);

		return $attributes;
	}
}

?>