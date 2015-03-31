<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends Fit_Controller {

	public function index()
	{
	}

	public function register()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required | valid_email | is_unique[User.Email]');
		$this->form_validation->set_rules('password', 'Password', 'required | min_length[8] | max_length[20] | matches[re_password]');
		$this->form_validation->set_rules('re_password', 'Confirm Password', 'required | min_length[8] | max_length[20]');
		$this->form_validation->set_rules('firstName', 'First Name', 'required | max_length[20]');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required | max_length[20]');
		
		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
			$this->load->model('User_model');
			$hashedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			$this->User_model->register(array(
				'email' => $this->input->post('email'),
				'password' => $hashedPassword,
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName')));
		}
	}

}