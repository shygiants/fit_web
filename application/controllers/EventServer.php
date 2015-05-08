<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("library/vendor/autoload.php");
use predictionio\EventClient;

class EventServer extends Fit_Controller {

	// private $accessKey = 'wERSmq7bExLqaTR9FyJKMJtEOTu0ikH74Sf4ovyLc8G3vWGNsSX2NCa29YVshWLu';
	private $accessKey = 'To5PPEhDmUF3rAnUwHZrn2ORSIZSuf7IOIdAWMXxfT2MZhcGzF31kWIlCJFWZ42j';
	private $eventServerURL = 'http://52.68.79.109:7070';

	public function rate()
	{
		// TODO: Form validation

		if ($_SERVER['REQUEST_METHOD'] != 'POST' || $this->session->userdata('is_login'))
			$this->_response(array('success' => 'false'));
		
		$this->load->model('event_model');
		$this->event_model->setRating($this->input->post());

		// $client = new EventClient($this->accessKey, $this->eventServerURL);
		// $response = $client->createEvent(array(
		// 				'event' => 'rate',
		// 				'entityType' => 'user',
		// 				'entityId' => $this->input->post('user_id'),
		// 				'targetEntityType' => 'item',
		// 				'targetEntityId' => $this->input->post('fashion_id'),
		// 				'properties' => array(
		// 					'rating' => $this->event_model->getRating($this->input->post('type_id')))
		// 				));
		
		// $this->_response($response);
		$this->_response(array('success' => 'true'));
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