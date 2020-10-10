<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('level') || $this->session->userdata('level') < 1 || $this->session->userdata('level') > 3) {
			redirect(base_url().'admin');
		}
	}

	public function index()
	{
		$this->load->model('admin/GetData');
		$data = $this->GetData->getDuty();
		foreach ($data as $key => $value) {
			$level[$key] = $value->level;
		}
		array_multisort($data, SORT_ASC, $level);
		$data = array('duty' => $data);
		$this->load->view('admin/createAccount_view', $data, FALSE);
	}

}

/* End of file AccountManager.php */
/* Location: ./application/controllers/AccountManager.php */