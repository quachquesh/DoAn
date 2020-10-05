<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('email')){
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		} else {
			$this->load->model('Account');
		}
	}

	public function index()
	{
		// Quay lại trang trước
		$referred_from = $this->session->userdata('referred_from');
		redirect($referred_from, 'refresh');

		$email = $this->input->post('email');
		$pwd = $this->input->post('password');
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);

		if ($this->Account->validate($username, $password)){
			$data = array(
				'name' => $check['name'],
				'username' => $check['username']
			);
			
			$this->session->set_userdata($data);
			redirect('Adddata', 'refresh');
		}
		else {
			// $this->session->set_flashdata('error', 'Sai tên tài khoản hoặc mặt khẩu');
			$this->session->set_flashdata('error', $username);
			redirect('admin/login');
			echo $username;
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */