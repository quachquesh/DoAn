<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validator extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	// chuỗi rỗng => true
	public function isRequired($str) {
		return empty($str) ? true : false;
	}

	// có số trong chuỗi => true
	public function checkNumber($str) {
		return !!preg_match("/([0-9])/",$str);
	}

	// có kí tự khác ngoài số => false
	public function isNumber($number) {
		return !!preg_match("/^[0-9]*$/",$number);
	}

	// Có kí tự đặc biệt => true
	public function checkKiTuDacBiet($string) {
		return preg_match('/[!@#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $string);
	}

	// Có kí tự cấm trong HTML => true
	public function checkHTML($string) {
		return !!preg_match('/[<>(){}\/\\\\]/', $string);	
	}

	public function minMaxLength($str, $min, $max)
	{
		$length = strlen($str);
		return ($length < $min || $length > $max) ? true : false;
	}
}

/* End of file Validator.php */
/* Location: ./application/models/Validator.php */