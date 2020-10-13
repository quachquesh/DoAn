<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->has_userdata('level')) {
			$this->load->view('admin/template/main');
		} else {
			if (!$this->session->has_userdata('userName'))
				$this->load->view('admin/login_view');
			else {
				$this->output->set_status_header(500);
			}
		}
	}

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */