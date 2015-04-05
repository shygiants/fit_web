<?php

class Attribute {

	public $label, $table;

	function __construct($label, $table)
	{
		$this->label = $label;
		$this->table = $table;
	}
}

?>