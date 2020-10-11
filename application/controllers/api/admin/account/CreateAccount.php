<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateAccount extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('accountManager')){
			$this->output->set_status_header(500);
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "POST") {
			$data['userName'] = $this->input->post('userName');
			$data['password'] = $this->input->post('password');
			$data['firstName'] = $this->input->post('firstName');
			$data['lastName'] = $this->input->post('lastName');
			$data['email'] = $this->input->post('email');
			$data['phoneNumber'] = $this->input->post('phoneNumber');
			$data['level'] = $this->input->post('level');

			$res['status'] = true;

			$this->load->model('Validator');

			foreach ($data as $key => $value) {
				if ($this->Validator->isRequired($value)) {
					$res['status'] = false;
					$res['message'] = "Vui lòng điền vào tất cả các trường";
					break;
				} else if ($this->Validator->checkKiTuDacBiet($value)) {
					if ($key != 'password' && $key != 'email') {
						$res['status'] = false;
						$res['message'] = "Vui lòng không điền các kí tự không hợp lệ";
						break;
					}
				}
			}
			if ($res['status'] != false) {
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập <b>Email</b> đúng định dạng";
				}
				else if ($this->Validator->checkHTML($data['email'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng không điền các kí tự không hợp lệ";
				}
				else if ($this->Validator->checkNumber($data['firstName'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập <b>Họ và tên lót</b> đúng định dạng";
				}
				else if ($this->Validator->checkNumber($data['lastName'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập <b>Tên</b> đúng định dạng";
				}
				else if (!$this->Validator->isNumber($data['phoneNumber'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập <b>Số điện thoại</b> đúng định dạng";
				}
				else if ($this->Validator->minMaxLength($data['password'], 6, 18)) {
					$res['status'] = false;
					$res['message'] = "Mật khẩu phải từ 6-18 kí tự";
				}
			}
			if ($res['status'] == true) {
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
				$data['createBy'] = $this->session->userdata('userName');
				$this->load->model('admin/CreateUser');
				if ($this->CreateUser->AddData($data)) {
					$res['message'] = "Tạo tài khoản thành công";
				} else {
					$res['status'] = false;
					$res['message'] = "Tên đăng nhập đã tồn tại";
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

/* End of file CreateAccount.php */
/* Location: ./application/controllers/CreateAccount.php */