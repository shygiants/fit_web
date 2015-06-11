<?php
class CollectionTuple {

	public $id, $user_id, $name, $desc, $thumbnail;
	public $last_name, $first_name, $nick_name;

	function __construct($id, $user_id, $name, $desc, $thumbnail, $last_name = null, $first_name = null, $nick_name = null)
	{
		$this->id = $id;	
		$this->user_id = $user_id;
		$this->name = $name;
		$this->desc = $desc;
		$this->thumbnail = $thumbnail;
		$this->last_name = $last_name;
		$this->first_name = $first_name;
		$this->nick_name = $nick_name;
	}
}

?>