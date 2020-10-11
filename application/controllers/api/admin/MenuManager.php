<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('menuManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/GetData');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'PUT') {
			
			$data = $this->GetData->getMenuType();

			$data = array('menuType' => $data);
			$this->load->view('admin/MenuManager/main', $data, FALSE);

			$this->output->set_status_header(201);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function CreateProduct()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'PUT') {
			
			$data = $this->GetData->getMenuType();

			$data = array('menuType' => $data);
			$this->load->view('admin/MenuManager/createProduct', $data, FALSE);

			$this->output->set_status_header(201);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function ShowProduct()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'PUT') {

			$data = $this->GetData->getMenu();
			foreach ($data as $key => $value) {
				$typeCode[$key] = $value['typeCode'];
			}
			array_multisort($typeCode, SORT_ASC, $data);

			$data = array(
				'menuData' => $data,
				'discountType' => $this->GetData->getMenuDiscountType(),
				'menuType' => $this->GetData->getMenuType()
			);
			$this->load->view('admin/MenuManager/showProduct', $data, FALSE);

			$this->output->set_status_header(201);
		} else {
			$this->output->set_status_header(500);
		}
	}

}