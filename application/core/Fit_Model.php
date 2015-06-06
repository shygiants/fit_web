<?php
require_once("library/vendor/autoload.php");
require_once("application/libraries/CollectionTuple.php");
use predictionio\EventClient;
use predictionio\EngineClient;

class Fit_Model extends CI_Model {

	protected $ipAddress = '52.68.234.77';

	protected $accessKey = 'To5PPEhDmUF3rAnUwHZrn2ORSIZSuf7IOIdAWMXxfT2MZhcGzF31kWIlCJFWZ42j';
	protected $eventServerURL = 'http://127.0.0.1:7070';
	protected $engineServerURL = 'http://127.0.0.1:8000';

	function __construct() {
		parent::__construct();
	}
}
?>