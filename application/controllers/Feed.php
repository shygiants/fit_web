<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends Fit_Controller {

	public function getAll() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('fashion_model');
		$this->load->model('event_model');

		$cardData = $this->fashion_model->getCardData($this->input->post('email'));
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->output->set_content_type('application/json')
		->set_output(json_encode(array(
			'cards' => $cardData,
			'rating_types' => $ratingTypes)));
	}

	public function getDetail() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('fashion_model');
		$result = $this->fashion_model->getFashionById(
			$this->input->post('fashion_id'),
			$this->input->post('user_id'));
		
		$this->_response($result);
	}

}