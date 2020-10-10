<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('level')) {
			$this->load->view('admin/template/main');
		} else {
			$this->load->view('admin/login_view');
		}
	}

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */