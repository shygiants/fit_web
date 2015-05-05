<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends Fit_Controller {

	public function register()
	{
		// TODO: Post validation
		
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(array('error' => 'Invalid method'));
			return;
		}
			
		$this->load->model('user_model');

		if ($this->user_model->getByEmail($this->input->post('email')) != null) {
			$this->_response(array(
			'error' => 'Email is already exists',
			'exists' => 'true')); // TODO: Return what's wrong
			return;
		}
		
		if (!function_exists('password_hash'))
			$this->load->helper('password_helper');
		
		$hashedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		$userData = array(
			'email' => $this->input->post('email'),
			'password' => $hashedPassword,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			);
		$userData['password'] = $hashedPassword;
		$this->user_model->register($userData);

		$this->session->set_userdata('is_login', true);
		$this->_response(array('is_login' => 'true'));
		
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$this->_response(array('error' => 'Invalid method'));
			return;
		}

		$this->load->model('user_model');
		$userData = $this->user_model->getByEmail($this->input->post('email'));
		
		if (!function_exists('password_verify'))
			$this->load->helper('password_helper');

		// There is not that email or password is wrong
		if ($userData != null && 
			password_verify($this->input->post('password'), $userData->password))
		{
			$this->session->set_userdata('is_login', true);
			$this->_response(array('is_login' => 'true'));
		}
		else
			$this->_response(array('is_login' => 'false'));
	}

	public function checkLogin()
	{
		if ($this->session->userdata('is_login'))
		{
			$this->_response(array('is_login' => 'true'));
		}
		else
		{
			$this->_response(array('is_login' => 'false'));	
		}

	}
}