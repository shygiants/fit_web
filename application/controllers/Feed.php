<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Fit_Controller {

	public function getAll() {
		// if ($this->session->userdata('is_login'))
		// {
		// 	$this->_response(array('is_login' => 'true'));
		// }
		// else
		// {
		// 	$this->_response(array('is_login' => 'false'));	
		// }

		$this->load->model('fashion_model');
		$this->load->model('event_model');

		$cardData = $this->fashion_model->getCardData();
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->output->set_content_type('application/json')
		->set_output(json_encode(array(
			'cards' => $cardData,
			'rating_types' => $ratingTypes)));
	}

}