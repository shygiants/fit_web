<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Fit_Controller {

	function getItemAttributes()
	{
		$this->load->model('fashion_model');

		$attributes = array(
			'class' => $this->fashion_model->getClass(),
			'type' => $this->fashion_model->getItemType(),
			'color' => $this->fashion_model->getColor(),
			'pattern' => $this->fashion_model->getPattern());

		$this->output->set_content_type('application/json')->set_output(json_encode($attributes));
	}

	function addFashion()
	{
		if (!($this->session->userdata('is_login'))
		 || !($this->session->userdata('is_editor')))
		{
			_response(array('success', 'false'));
		}

		$this->load->model('fashion_model');
		$fashionData = json_decode($this->input->post('query'));

		$this->fashion_model->add($fashionData);

		_response(array('success', 'true'));
	}
}