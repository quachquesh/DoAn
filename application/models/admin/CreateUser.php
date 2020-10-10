<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateUser extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function AddData($array)
	{
		$admin_login = array(
			'userName' => $array['userName'],
			'password' => $array['password']
		);
		unset($array['password']);
		$check = $this->db->insert('admins', $array);
		return $this->db->insert('admin_login', $admin_login);
	}
}

/* End of file CreateUser.php */
/* Location: ./application/models/CreateUser.php */