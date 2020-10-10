<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateAccount extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level') || $this->session->userdata('level') > 2 || $this->session->userdata('level') < 1){
			echo "Không đủ quyền";
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

			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

			$res['status'] = true;

			foreach ($data as $key => $value) {
				if ($this->isRequired($value)) {
					$res['status'] = false;
					$res['message'] = "Vui lòng điền vào tất cả các trường";
					break;
				} else if ($this->checkKiTuDacBiet($value)) {
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
					$res['message'] = "Vui lòng nhập 'Email' đúng định dạng";
				}
				else if ($this->checkHTML($data['email'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng không điền các kí tự không hợp lệ";
				}
				else if ($this->checkNumber($data['firstName'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập 'Họ và tên lót' đúng định dạng";
				}
				else if ($this->checkNumber($data['lastName'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập 'Tên' đúng định dạng";
				}
				else if (!$this->isNumber($data['phoneNumber'])) {
					$res['status'] = false;
					$res['message'] = "Vui lòng nhập 'Số điện thoại' đúng định dạng";
				}
			}
			if ($res['status'] == true) {
				$data['createBy'] = $this->session->userdata('userName');
				$this->load->model('admin/CreateUser');
				if ($this->CreateUser->AddData($data)) {
					$res['message'] = "Tạo tài khoản thành công";
				} else {
					$res['status'] = false;
					$res['message'] = "Thêm dữ liệu thất bại";
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

	// chuỗi rỗng => true
	function isRequired($str) {
		return empty($str) ? true : false;
	}

	// có số trong chuỗi => true
	function checkNumber($str) {
		return !!preg_match("/([0-9])/",$str);
	}

	// có kí tự khác ngàoi số => false
	function isNumber($number) {
		return !!preg_match("/^[0-9]*$/",$number);
	}

	// Có kí tự đặc biệt => true
	function checkKiTuDacBiet($string) {
		return preg_match('/[!@#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $string);
	}

	// Có kí tự cấm trong HTML => true
	function checkHTML($string) {
		return !!preg_match('/[<>(){}\/\\\\]/', $string);	
	}
}

/* End of file CreateAccount.php */
/* Location: ./application/controllers/CreateAccount.php */