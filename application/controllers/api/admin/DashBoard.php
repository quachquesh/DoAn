<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashBoard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('level')) {
			$this->output->set_status_header(500);
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$this->load->view('admin/dashboard_view');

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

}