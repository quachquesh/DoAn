<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('level')) {
			redirect(base_url().'admin/DashBoard');
		}
	}

	public function index()
	{
		$this->load->view('admin/login_view');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */