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

		$this->_response(array(
			'cards' => $cardData,
			'rating_types' => $ratingTypes));
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

	public function getComments() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('fashion_model');
		$result = $this->fashion_model->getComments(
			$this->input->post('fashion_id'),
			$this->input->post('user_id'));

		$this->_response(array('comments' => $result));
	}

	public function getSchemaData() {
		$this->load->model('fashion_model');

		$itemTypes = array(
			'classes' => $this->fashion_model->getClass(),
			'item_types' => $this->fashion_model->getItemTypeByClass(),
			'colors' => $this->fashion_model->getColor(),
			'patterns' => $this->fashion_model->getPattern()	
			);	

		$this->_response($itemTypes);
	}

	public function getFiltered() {
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

		$filtered = $this->fashion_model->getFiltered(json_decode($this->input->post('filters')), $this->input->post('email'));
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->_response(array (
			'cards' => $filtered,
			'rating_types' => $ratingTypes));
	}

	public function getRated() {
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

		$rated = $this->fashion_model->getRated($this->input->post('email'));
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->_response(array (
			'cards' => $rated,
			'rating_types' => $ratingTypes));
	}
}