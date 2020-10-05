<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function Validate($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('users')->row_array();
	}
	public function ValidateAdmin($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('admin')->row_array();
	}
}

/* End of file Account.php */
/* Location: ./application/models/Account.php */