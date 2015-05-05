<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Fit_Controller {

	public function getAll() {
		$errorMsg = null;
		if ($_SERVER['REQUEST_METHOD'] != 'POST')
			$errorMsg = array('error' => 'Invalid method');
		else if (!$this->session->userdata('is_login'))
			$errorMsg = array('error' => 'Not login');
		if ($errorMsg != null)
			$this->_response($errorMsg);

		$this->load->model('fashion_model');
		$this->load->model('event_model');

		$cardData = $this->fashion_model->getCardData($this->input->post('email'));
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->output->set_content_type('application/json')
		->set_output(json_encode(array(
			'cards' => $cardData,
			'rating_types' => $ratingTypes)));
	}

}