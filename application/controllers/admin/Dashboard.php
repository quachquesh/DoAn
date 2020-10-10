<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('level')) {
			redirect(base_url().'admin/Login');
		}
	}

	public function index()
	{
		$this->load->view('admin/dashboard_view');
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */