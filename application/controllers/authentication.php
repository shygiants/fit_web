<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends Fit_Controller {

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
			_response(array('success' => 'false')); // TODO: Return what's wrong
		}
		else
		{
			$this->load->model('user_model');
			if (!function_exists('password_hash'))
				$this->load->helper('password_helper');
			
			$hashedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			$this->user_model->register(array(
				'email' => $this->input->post('email'),
				'password' => $hashedPassword,
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName')));

			_response(array('success' => 'true'));
		}
	}

	public function login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required | valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required | min_length[8] | max_length[20]');
		
		if ($this->form_validation->run() == FALSE)
			_response(array('authorized' => 'false')); // TODO: Let's make structured response
		else
		{
			$this->load->model('user_model');
			$userData = $this->user_model->getByEmail($this->input->post('email'));
			
			if (!function_exists('password_verify'))
				$this->load->helper('password_helper');

			if (password_verify($this->input->post('password'), $userData->Password))
			{
				$this->session->set_userdata('is_login', true);
				_response(array('authorized' => 'true'));
			}
			else
				_response(array('authorized' => 'false'));
		}
	}

	function _response($response)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}