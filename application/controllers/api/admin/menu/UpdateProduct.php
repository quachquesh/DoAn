<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UpdateProduct extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('menuManager')){
			$this->output->set_status_header(500);
			exit();
		} else {
			$this->load->model('admin/MenuManager');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'POST') {
			$id = $this->input->post('productID');
			$data['name'] = $this->input->post('name');
			$data['price'] = $this->input->post('price');
			$data['typeCode'] = $this->input->post('typeCode');
			$data['itemsNew'] = $this->input->post('itemsNew');
			$data['bestSeller'] = $this->input->post('bestSeller');
			$data['discountType'] = $this->input->post('discountType');
			$data['discount'] = $this->input->post('discount');
			$data['avt'] = $this->input->post('image-src');

			$res['status'] = false;
			// Nếu thay đổi avt khác
			if ($this->input->post('image-update') != "") {
				$file_name = $_FILES['file']['name'];
				$duoi = pathinfo($file_name, PATHINFO_EXTENSION);
				if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif' || $duoi === 'jpeg') {

					$dir_old = $data['avt'];
					$dir_new = 'uploads/menu/'.$data['typeCode'].'_'.$id.'.'.$duoi;

					$data['avt'] = $dir_new;
					if ($this->MenuManager->updateProductById($id, $data)) {
						$res['status'] = true;
						$res['message'] = 'Cập nhật sản phẩm thành công';
						$res['data'] = $data;
						// Xóa file cũ
						unlink($dir_old);
						// Tiến hành upload file
						move_uploaded_file($_FILES['file']['tmp_name'], $dir_new);
					} else {
						$res['message'] = 'Cập nhật sản phẩm thất bại';
					}
				} else {
					$res['message'] = 'Chỉ được upload file ảnh';
				}
			} else {
				if ($this->MenuManager->updateProductById($id, $data)) {
					$res['status'] = true;
					$res['message'] = 'Cập nhật sản phẩm thành công';
					$res['data'] = $data;
				} else {
					$res['message'] = 'Cập nhật sản phẩm thất bại';
				}
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

/* End of file UpdateProduct.php */
/* Location: ./application/controllers/UpdateProduct.php */