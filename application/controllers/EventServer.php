<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventServer extends Fit_Controller {

	public function rate() {
		// TODO: Form validation

		if ($_SERVER['REQUEST_METHOD'] != 'POST' || $this->session->userdata('is_login'))
			$this->_response(array('success' => 'false'));
		
		$this->load->model('event_model');
		$this->event_model->setRating($this->input->post());
		
		// $this->_response($response);
		$this->_response(array('success' => 'true'));
		// var_dump($response);
	}

	public function follow() {
		// TODO
	}

	public function like() {
		// TODO
	}

	public function comment() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('event_model');
		$this->event_model->comment($this->input->post());

		$this->_response(array('success' => true));
	}
}
?>