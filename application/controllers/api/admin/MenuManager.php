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
		if ($method == 'GET') {
			
			$data = $this->GetData->getProductType();

			$data = array('menuType' => $data);
			$this->load->view('admin/MenuManager/main', $data, FALSE);

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function CreateProduct()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			
			$data = $this->GetData->getProductType();

			$data = array('menuType' => $data);
			$this->load->view('admin/MenuManager/createProduct', $data, FALSE);

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function ShowProduct()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {

			$data = $this->GetData->getProduct();
			// -- sắp xếp typeCode
			// foreach ($data as $key => $value) {
			// 	$typeCode[$key] = $value['typeCode'];
			// }
			// array_multisort($typeCode, SORT_ASC, $data);

			$data = array(
				'menuData' => $data,
				'productType' => $this->GetData->getProductType()
			);
			$this->load->view('admin/MenuManager/showProduct', $data, FALSE);

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function ShowProductType()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			$data = array(
				'productType' => $this->GetData->getProductType()
			);
			$this->load->view('admin/MenuManager/showProductType', $data, FALSE);

			$this->output->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function getMenuData($id = -1)
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') {
			if ($id != -1) {
				$res = $this->GetData->getProduct($id);
			} else {
				$res = $this->GetData->getProduct();
			}

			if (!$res) {
				$res['status'] = false;
				$res['message'] = 'Không tìm thấy thông tin';
			} else if ($id != -1) {
				$res = $res[0];
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}
}