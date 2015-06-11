<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends Fit_Controller {

	public function make() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('collection_model');
		$insert_id = $this->collection_model->make($this->input->post());

		$this->_response(array('id' => $insert_id));
	}

	public function getCollections() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('collection_model');
		$collections = $this->collection_model->getCollections($this->input->post('user_id'));

		$this->_response(array('collections' => $collections));
	}

	public function isLiked() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$this->load->model('collection_model');
		$isLiked = $this->collection_model->isLiked($this->input->post());

		$this->_response(array('isLiked' => $isLiked));
	}
}
?>