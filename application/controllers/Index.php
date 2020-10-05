<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $data['fileMain'] = 'index_view.php';
		// $this->load->view('template/main', $data, false);
		$this->load->view('index_view');
	}
}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */