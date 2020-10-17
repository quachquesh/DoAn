<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('accountManager')) {
			$this->output->set_status_header(500);
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$this->load->model('admin/GetData');
			$data = $this->GetData->getDuty();
			foreach ($data as $key => $value) {
				$level[$key] = $value['level'];
			}
			array_multisort($level, SORT_ASC, $data);

			$adminLevel = $this->session->userdata('level');
			if ($adminLevel != 1) {
				foreach ($data as $key => $value) {
					if ($value['level'] > $adminLevel) {
						break;
					}
					unset($data[$key]);
				}
			}

			$data = array('duty' => $data);
			$this->load->view('admin/AccountManager/main', $data, FALSE);

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

}