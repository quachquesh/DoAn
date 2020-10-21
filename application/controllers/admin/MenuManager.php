<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MenuManager extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('menuManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/GetData');
		}
	}

	public function index()
	{			
		$data = $this->GetData->getProductType();

		$data = array('menuType' => $data);
		$this->load->view('admin/MenuManager/main', $data, FALSE);
	}

	public function CreateProduct()
	{
		$data = $this->GetData->getProductType();

		$data = array('menuType' => $data);
		$this->load->view('admin/MenuManager/createProduct', $data, FALSE);
	}

	public function ShowProduct()
	{
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
	}

	public function ShowProductType()
	{
		$data = array(
			'productType' => $this->GetData->getProductType()
		);
		$this->load->view('admin/MenuManager/showProductType', $data, FALSE);
	}
}