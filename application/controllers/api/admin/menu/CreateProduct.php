<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateProduct extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('menuManager')){
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/MenuManager');
			$this->load->model('Validator');
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "POST") {
			$data['name'] = $this->input->post('name');
			$data['typeCode'] = $this->input->post('typeCode');
			$data['price'] = $this->input->post('price');

			$avt = $this->input->post('avt');
			$avt = explode(".", $avt);
			$avt = end($avt);

			$res['status'] = true;
			if ($avt == 'png' || $avt == 'gif' || $avt == 'jpg' || $avt == 'jpeg') {
				foreach ($data as $key => $value) {
					if ($this->Validator->isRequired($value)) {
						$res['status'] = false;
						$res['message'] = 'Vui lòng điền tất cả trường';
					}
				}
				if (!$this->Validator->isNumber($data['price'])) {
					$res['status'] = false;
					$res['message'] = 'Vui lòng điền <b>giá bán</b> đúng định dạng';
				}

				if ($res['status'] == true) {
					$id = $this->MenuManager->createProduct($data);
					if ($id) {
						$res['status'] = true;
						$res['id'] = $id;
						$res['avtName'] = $data['typeCode'].'_'.$id;
					} else {
						$res['status'] = false;
						$res['message'] = '<b>Tên sản phẩm</b> đã tồn tại!';
					}
				}
			} else {
				$res['status'] = false;
				$res['message'] = 'Chỉ được upload ảnh';
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function UploadAvtProduct()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "POST") {
			$res['status'] = false;
			if (!empty($_FILES['file'])) {
			    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
			    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
			    $dir = 'uploads/menu/'.$_FILES['file']['name'];
			    // Kiểm tra xem có phải file ảnh không
			    if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif' || $duoi === 'jpeg') {
			        // tiến hành upload
			        if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
			            // upload Nếu thành công
			            if ($this->MenuManager->updateAvtProduct($this->input->get_post('id'), $dir)) {
				            $res['status'] = true;
				            $res['message'] = 'Thêm sản phẩm thành công';
			            } else {
			            	$res['message'] = 'Có lỗi!!';
			            }
			        } else { // nếu không thành công
			            $res['message'] = 'Có lỗi!!';
			        }
			    } else { // nếu không phải file ảnh
			        $res['message'] = 'Chỉ được upload file ảnh';
			    }
			} else {
			    $res['message'] = 'Có lỗi!!';
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

/* End of file CreateProduct.php */
/* Location: ./application/controllers/CreateProduct.php */