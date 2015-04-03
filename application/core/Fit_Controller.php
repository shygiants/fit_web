<?php
class Fit_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function _response($response)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}