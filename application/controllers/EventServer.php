<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("library/vendor/autoload.php");
use predictionio\EventClient;

class EventServer extends Fit_Controller {

	private $accessKey = 'wERSmq7bExLqaTR9FyJKMJtEOTu0ikH74Sf4ovyLc8G3vWGNsSX2NCa29YVshWLu';
	private $eventServerURL = 'http://163.152.21.217:7070';

	public function index()
	{
	}

	public function rate()
	{
		// TODO: Form validation

		$userId = $this->input->post('userId');
		$rating = $this->input->post('rating');
		$itemId = $this->input->post('itemId');
		// $userId = "shygiants_web";
		// $rating = "4";
		// $itemId = "item_web";

		$client = new EventClient($this->accessKey, $this->eventServerURL);
		$response = $client->createEvent(array(
						'event' => 'rate',
						'entityType' => 'user',
						'entityId' => $userId,
						'targetEntityType' => 'item',
						'targetEntityId' => $itemId,
						'properties' => array('rating' => $rating)
						));
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
		// var_dump($response);
	}

	public function follow()
	{
		// TODO
	}

	public function like()
	{
		// TODO
	}

	public function comment()
	{
		// TODO
	}
}
?>