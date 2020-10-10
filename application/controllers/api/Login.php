<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('userName')){
			$this->output->set_status_header(400);
			die();
		}
	}

	public function index()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "POST") {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('Users');
			$check = $this->Users->Validate($username);
			if ($check) {
				$checkPwd = password_verify($password, $check['password']);
				$checkAdmin = $this->Users->ValidateAdmin($username);
			}

			if ($check && $checkPwd){
				$data['username'] = $check['username'];
				$data['email'] = $check['email'];
				$data['phonenumber'] = $check['phonenumber'];
				$data['firstname'] = $check['firstname'];
				$data['lastname'] = $check['lastname'];
				if ($checkAdmin) {
					$data['levelAdmin'] = $checkAdmin['level'];
					$data['adminDateAdd'] = $checkAdmin['dateadd'];
				}
				$this->session->set_userdata($data);
				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data))
		        ->set_status_header(200);
			} else {
				$data['status'] = false;
				$data['message'] = "Sai tài khoản hoặc mật khẩu";

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($data))
		        ->set_status_header(200);
			}
		} else {
			$this->output->set_status_header(500);
		}
	}
	public function Admin()
	{
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "POST") {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('admin/AuthUser');
			$check = $this->AuthUser->Validate($username);
			$checkPwd = false;
			if (isset($check)) {
				$checkPwd = password_verify($password, $check['password']);
			}

			if (isset($check) && $checkPwd){
				$this->load->model('admin/DataUser');
				$dulieu = $this->DataUser->getData($username);
				
				foreach ($dulieu as $key => $value) {
					$data[$key] = $value;
				}

				$this->session->set_userdata($data);

				$status['status'] = true;
				$status['message'] = "Đăng nhập thành công";
				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($status))
		        ->set_status_header(200);
			} else {
				$status['status'] = false;
				$status['message'] = "Sai tài khoản hoặc mật khẩu";
				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($status))
		        ->set_status_header(200);
			}
		} else {
			$this->output->set_status_header(500);
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */