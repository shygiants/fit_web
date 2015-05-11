<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends Fit_Controller {

	public function temp() {
		$response = new JSONResponse();
		$response->add('success', true);
		var_dump($response->get());
		$this->_response($response->get());
	}
}