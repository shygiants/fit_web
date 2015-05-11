<?php
class Attribute {

	public $name, $label, $table;

	function __construct($name, $label, $table)
	{
		$this->name = $name;	// Computer-readable
		$this->label = $label;	// Human-readable
		$this->table = $table;
	}
}

?>