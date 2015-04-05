<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graphic extends Fit_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if ($email == 'shygiants@nate.com' && $password == '=pUgCkvyXiLsqVuxJ8Kv')
		{
			$this->session->set_userdata('is_login', true);
			redirect('graphic/edit');
		}
		else
			redirect('graphic/');
	}

	public function edit()
	{
		$this->load->model('item_model');

		$data = array('attributes' => $this->item_model->getAttributes());

		$this->load->view('header');
		$this->load->view('edit', $data);
		$this->load->view('footer');
	}
}

?>