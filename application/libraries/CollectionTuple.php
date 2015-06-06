<?php
class CollectionTuple {

	public $id, $user_id, $name, $desc, $thumbnail;

	function __construct($id, $user_id, $name, $desc, $thumbnail)
	{
		$this->id = $id;	
		$this->user_id = $user_id;
		$this->name = $name;
		$this->desc = $desc;
		$this->thumbnail = $thumbnail;
	}
}

?>