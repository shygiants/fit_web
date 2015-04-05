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
			new Attribute('Season', $this->db->get('Season')->result()),
			new Attribute('Style', $this->db->get('Style')->result()),
			new Attribute('Look', $this->db->get('Look')->result()),
			new Attribute('Height', $this->db->get('Height')->result()),
			new Attribute('Age', $this->db->get('Age')->result()),
			new Attribute('Outer', $this->db->get('Outer')->result()),
			new Attribute('Outer Color', $this->db->get('Color')->result()),
			new Attribute('Outer Pattern', $this->db->get('Pattern')->result()),
			new Attribute('Top', $this->db->get('Top')->result()),
			new Attribute('Top Color', $this->db->get('Color')->result()),
			new Attribute('Top Pattern', $this->db->get('Pattern')->result()),
			new Attribute('Bottom', $this->db->get('Bottom')->result()),
			new Attribute('Bottom Color', $this->db->get('Color')->result()),
			new Attribute('Bottom Pattern', $this->db->get('Pattern')->result()),
			new Attribute('Shoe', $this->db->get('Shoe')->result()),
			new Attribute('Shoe Color', $this->db->get('Color')->result()),
			new Attribute('Shoe Pattern', $this->db->get('Pattern')->result()),
			new Attribute('Hat', $this->db->get('Hat')->result()),
			new Attribute('Hat Color', $this->db->get('Color')->result()),
			new Attribute('Hat Pattern', $this->db->get('Pattern')->result())
			);

		return $attributes;
	}
}

?>