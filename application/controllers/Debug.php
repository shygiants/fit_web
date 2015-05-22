<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug extends Fit_Controller {

	public function temp() {
		$this->load->model('fashion_model');
		$this->load->model('event_model');

		$filtered = $this->fashion_model->getFiltered(
			json_decode('[{"type_id":9,"colors":[2,5],"patterns":[5]},{"type_id":23,"colors":[3],"patterns":[3]}]'), 
			'shygiants@nate.com');
		$ratingTypes = $this->event_model->getRatingTypes();

		$this->_response(array (
			'cards' => $filtered,
			'rating_types' => $ratingTypes));
	}

	public function filter() {
		$this->load->helper('file');
		if ( ! write_file('./result.json', $this->input->post('filters')))
		{
			echo 'Unable to write the file';
		}
		else
		{
			$this->_response(array('success' => true));
		}

		
	}
}