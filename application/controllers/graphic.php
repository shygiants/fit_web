<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graphic extends Fit_Controller {

	function _header()
	{
		$this->load->view('header', array('is_login' => $this->session->userdata('is_login')));	
	}

	public function index()
	{
		if ($this->session->userdata('is_login')
		 && $this->session->userdata('is_editor'))
		{
			redirect('graphic/feed');
			return;
		}

		$this->_header();
		$this->load->view('home');
		$this->load->view('footer');
		$this->load->view('home_js');
	}

	public function login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]');
		
		if ($this->form_validation->run())
		{
			$this->load->model('user_model');
			$userData = $this->user_model->getByEmail($this->input->post('email'));
			
			if (!function_exists('password_verify'))
				$this->load->helper('password_helper');

			// There is not that email or password is wrong
			if ($userData != null && password_verify($this->input->post('password'), $userData->password))
			{
				$this->session->set_userdata('is_login', true);
				if ($userData->editor_id != null)
				{
					$this->session->set_userdata('is_editor', true);
					$this->session->set_userdata('editor_id', $userData->editor_id);
				}
				redirect('graphic/edit');
				return;
			}
		}

		redirect('graphic/');
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect('graphic');
	}

	public function edit()
	{
		if (!($this->session->userdata('is_login'))
		 || !($this->session->userdata('is_editor')))
		{
			redirect('graphic');
			return;
		}
		$this->load->model('item_model');

		$data = array(
			'attributes' => $this->item_model->getAttributes(),
			'editor_id' => $this->session->userdata('editor_id')
			);

		$this->_header();
		$this->load->view('edit', $data);
		$this->load->view('footer');
		$this->load->view('edit_js');
	}

	public function add()
	{
		if (!($this->session->userdata('is_login'))
		 || !($this->session->userdata('is_editor')))
		{
			redirect('graphic');
			return;
		}
		$this->load->model('item_model');
		$itemData = $this->input->post();
		
		$this->item_model->add($itemData);

		redirect('graphic/feed');
	}

	public function feed()
	{
		if (!($this->session->userdata('is_login'))
		 || !($this->session->userdata('is_editor')))
		{
			redirect('graphic');
			return;
		}

		$this->load->model('item_model');

		$this->_header();
		$data = array('data' => $this->item_model->getCardData());
		
		$this->load->view('feed', $data);
		$this->load->view('footer');
	}

	public function register()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[User.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]|matches[rePassword]');
		$this->form_validation->set_rules('rePassword', 'Confirm Password', 'required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('firstName', 'First Name', 'required|max_length[20]');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required|max_length[20]');
		
		$this->load->model('user_model');

		if ($this->form_validation->run() == FALSE
		 || $this->user_model->getByEmail($this->input->post('email')) != null)
		{
			redirect('graphic');
		}
		else
		{
			if (!function_exists('password_hash'))
				$this->load->helper('password_helper');
			
			$hashedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
			$this->user_model->register(array(
				'email' => $this->input->post('email'),
				'password' => $hashedPassword,
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName')));

			$this->session->set_userdata('is_login', true);
			redirect('graphic/edit');
		}
	}
}

?>