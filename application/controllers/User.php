<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Fit_Controller {

	public function getInfo() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_response(JSONResponse::createException(JSONResponse::METHOD));
			return;
		}
		else if (!$this->session->userdata('is_login')) {
			$this->_response(JSONResponse::createException(JSONResponse::NOT_LOGIN));
			return;
		}

		$email = $this->input->post('email');
		$this->load->model('user_model');
		$userData = $this->user_model->getByEmail($email);

		$output = array(
			'email' => $email,
			'nick_name' => $userData->nick_name,
			'first_name' => $userData->first_name,
			'last_name' => $userData->last_name,
			'following' => $this->user_model->getFollowing($email),
			'follower' => $this->user_model->getFollowed($email),
			'rating' => $this->user_model->getRating($email)
			);

		$this->_response($output);
	}
}
?>