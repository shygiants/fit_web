<?php
class JSONResponse {

	const METHOD = 'InvalidMethodException';
	const EMAIL = 'EmailAlreadyExistException';

	private $array = [];

	public static function createException($type) {
		$response = new JSONResponse();
		$response->add('error', $type);

		return $response->array;
	}

	public static function isLogin($is_login) {
		$response = new JSONResponse();
		$response->add('is_login', $is_login);

		return $response->array;
	}

	public function add($name, $value) {
		$this->array[$name] = $value;

		return $this->array;
	}

	public function get() {
		return $this->array;
	}
}

?>