<?php
require_once("library/vendor/autoload.php");
use predictionio\EventClient;

class Fit_Model extends CI_Model {

	protected $accessKey = 'To5PPEhDmUF3rAnUwHZrn2ORSIZSuf7IOIdAWMXxfT2MZhcGzF31kWIlCJFWZ42j';
	protected $eventServerURL = 'http://52.68.21.190:7070';

	function __construct() {
		parent::__construct();
	}
}
?>