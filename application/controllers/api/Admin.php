<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// check có phải admin không
		if(!$this->session->userdata('level')){
			$this->output->set_status_header(500);
			die();
		}
	}

	public function index()
	{
		
	}

	// Tài khoản
	public function accountAdmin($id = -1)
	{
		// Kiểm tra quyền
		if(!$this->session->userdata('accountManager')){
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/GetData');
		}

		// Kiểm tra phương thức
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == "GET") { // [GET] Lấy dữ liệu account
			if ($id === -1) {
				$res = $this->GetData->getAccountAdmin();
			} else {
				$res = $this->GetData->getAccountAdmin($id);
				if (!$res) {
					$res['status'] = false;
					$res['message'] = 'Không tìm thấy thông tin';
				} else {
					$res = $res[0];
				}
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);

		} else if ($method == "POST") {
			if ($id == -1) { // [POST] Tạo account
				$data['userName'] = $this->input->post('userName');
				$data['password'] = $this->input->post('password');
				$data['firstName'] = $this->input->post('firstName');
				$data['lastName'] = $this->input->post('lastName');
				$data['email'] = $this->input->post('email');
				$data['phoneNumber'] = $this->input->post('phoneNumber');
				$data['level'] = $this->input->post('level');

				$res['status'] = true;

				$this->load->helper('Validator');

				foreach ($data as $key => $value) {
					if (isRequired($value)) {
						$res['status'] = false;
						$res['message'] = "Vui lòng điền vào tất cả các trường";
						break;
					} else if (checkKiTuDacBiet($value)) {
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
					else if (checkHTML($data['email'])) {
						$res['status'] = false;
						$res['message'] = "Vui lòng không điền các kí tự không hợp lệ";
					}
					else if (checkNumber($data['firstName'])) {
						$res['status'] = false;
						$res['message'] = "Vui lòng nhập <b>Họ và tên lót</b> đúng định dạng";
					}
					else if (checkNumber($data['lastName'])) {
						$res['status'] = false;
						$res['message'] = "Vui lòng nhập <b>Tên</b> đúng định dạng";
					}
					else if (!isNumber($data['phoneNumber'])) {
						$res['status'] = false;
						$res['message'] = "Vui lòng nhập <b>Số điện thoại</b> đúng định dạng";
					}
					else if (minMaxLength($data['password'], 6, 18)) {
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
		        ->set_status_header(201);
			} else { // [POST] Sửa account

			}
		} else if ($method == "DELETE") { // [DELETE] Xóa account

		} else {
			$this->output->set_status_header(500);
		}
	}

	// Sản phẩm
	public function product($id = -1)
	{
		// Kiểm tra quyền
		if(!$this->session->has_userdata('productManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/ProductManager');
			$this->load->model('admin/GetData');
		}

		// Kiểm tra phương thức
		$method = $this->input->server('REQUEST_METHOD');

		if ($method == "GET") { // [GET] Lấy dữ liệu
			if ($id == -1) {
				$res = $this->GetData->getProduct();
			} else {
				$res = $this->GetData->getProduct($id);

				if (!$res) {
					$res['status'] = false;
					$res['message'] = 'Không tìm thấy thông tin';
				} else {
					$res = $res[0];
				}
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else if ($method == "POST") {
			if ($id == -1) { // [POST] Tạo mới sản phẩm
				$res['status'] = true;
				$this->load->helper('Validator');
				$this->output->set_status_header(400);
				// Kiểm tra file
				if (!empty($_FILES['avt'])) {
					$duoi = explode('.', $_FILES['avt']['name']); // tách chuỗi khi gặp dấu .
					$duoi = end($duoi); //lấy ra đuôi file

					// Kiểm tra có phải file ảnh không
					if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif' || $duoi === 'jpeg') {

						$data['name'] = $this->input->post('name');
						$data['typeCode'] = $this->input->post('typeCode');
						$data['price'] = $this->input->post('price');
						// Kiểm tra dữ liệu
						foreach ($data as $key => $value) {
							if (isRequired($value)) {
								$res['status'] = false;
								$res['message'] = 'Vui lòng điền tất cả trường';
								break;
							}
						}
						if (checkHTML($data['name'])) {
							$res['status'] = false;
							$res['message'] = 'Tên sản phẩm chứa kí tự không hợp lệ';
						} else if (!isNumber($data['price'])) {
							$res['status'] = false;
							$res['message'] = 'Vui lòng điền <b>giá bán</b> đúng định dạng';
						}

						// Nếu dữ liệu ok hết thì tiến hành tạo sản phẩm
						if ($res['status']) {
							$id = $this->ProductManager->createProduct($data);
							if ($id) {
								$dir = 'uploads/menu/'.$data['typeCode'].'_'.$id.'.'.$duoi;
								// Tiến hành upload file
								if (move_uploaded_file($_FILES['avt']['tmp_name'], $dir)) {
									// cập nhật đường dẫn file cho sản phẩm
									if ($this->ProductManager->updateAvtProduct($id, $dir)) {
										$res['message'] = 'Thêm sản phẩm thành công';
										$this->output->set_status_header(201);
									} else {
										$res['status'] = false;
						            	$res['message'] = 'Cập nhật đường dẫn file lỗi!!';
						            }
								} else {
									// upload file lỗi thì xóa sản phẩm vừa tạo
									$this->ProductManager->deleteProduct($id);
									$res['status'] = false;
					            	$res['message'] = 'Upload file lỗi!!';
					            }
							} else {
								$res['status'] = false;
								$res['message'] = '<b>Tên sản phẩm</b> đã tồn tại!';
							}
						}
					} else { // nếu không phải file ảnh
				        $res['message'] = 'Chỉ được upload file ảnh';
				    }
				} else {
					$res['message'] = 'Lỗi file';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res));
			}
			else { // [POST] Cập nhật sản phẩm
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
						if ($this->ProductManager->updateProductById($id, $data)) {
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
					if ($this->ProductManager->updateProductById($id, $data)) {
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
			}
	    } else if ($method == "DELETE") { // [DELETE] Xóa sản phẩm
	    	$res['status'] = false;

			$data = $this->GetData->getProduct($id);
			if ($data) {
				if ($this->ProductManager->deleteProduct($id)) {
					unlink($data[0]['avt']);
					$res['status'] = true;
					$res['message'] = 'Xóa thành công';
				}
			} 

			if ($res['status'] == false) {
				$res['message'] = 'Xóa thất bại';
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	// Loại sản phẩm
	public function productType($code = "")
	{
		// Kiểm tra quyền
		if(!$this->session->has_userdata('productManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/ProductManager');
			$this->load->model('admin/GetData');
		}

		// Kiểm tra phương thức
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') { // [GET] Lấy dữ liệu productType
			if ($code === "") {
				$res = $this->GetData->getProductType();
			} else {
				$res = $this->GetData->getProductType($code);
				if (!$res) {
					$res['status'] = false;
					$res['message'] = 'Không tìm thấy thông tin';
				} else {
					$res = $res[0];
				}
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else if ($method == 'POST') {
			if ($code === "") { // [POST] Tạo dữ liệu productType
				$data['code'] = $this->input->post('code');
				$data['typeName'] = $this->input->post('typeName');
				$data['business'] = $this->input->post('business');
				
				$data['code'] = str_replace(" ", "", $data['code']);
				$data['code'] = strtolower($data['code']);

				if ($this->ProductManager->createProductType($data)) {
					$res['status'] = true;
					$res['message'] = 'Thêm <b>'.$data['code'].'</b> thành công';
				} else {
					$res['status'] = false;
					$res['message'] = 'Thêm <b>'.$data['code'].'</b> thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(201);
			} else { // [POST] Update dữ liệu productType
				$data = array(
					'typeName' => $this->input->post('typeName'),
					'business' => $this->input->post('business')
				);
				$res['status'] = $this->ProductManager->updateProductType($code, $data);
				if ($res['status']) {
					$res['message'] = 'Cập nhật <b style="text-transform: uppercase;">'.$code.'</b> thành công';
				} else {
					$res['message'] = 'Cập nhật <b style="text-transform: uppercase;">'.$code.'</b> thất bại';
				}

				$this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($res))
		        ->set_status_header(200);
			}
		} else if ($method == 'DELETE') { // [DELETE] Xóa productType
			$arrAvt = $this->GetData->getProductAvtByType($code);
			if ($this->ProductManager->deleteProductType($code)) {
				foreach ($arrAvt as $value) {
				    unlink($value['avt']);
				}
				$res['status'] = true;
				$res['message'] = 'Xóa <b style="text-transform: uppercase;">'.$code.'</b> thành công';
			} else {
				$res['status'] = false;
				$res['message'] = 'Xóa <b style="text-transform: uppercase;">'.$code.'</b> thất bại';
			}

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
		} else {
			$this->output->set_status_header(500);
		}
	}

	public function order($id = -1)
	{
		// $this->load->model('admin/GetData');
		// $data = $this->GetData->getOrderHistory();
		// foreach ($data as $key => $value) {
		//     // $data[$key]['createDate'] = date("d/m/y, H:i:s", strtotime($data[$key]['createDate']));

		//     // // Chỉ lấy ngày
		//     // $data[$key]['createDate'] = date("d", strtotime($data[$key]['createDate']));
		    
		//     // Chỉ lấy tháng
		//     $data[$key]['createDate'] = date("d", strtotime($data[$key]['createDate']));
		//     // $data[$key]['createDate'] = strtotime($data[$key]['createDate']);
		// }
		// foreach ($data as $value) {
		//     if ($value['createDate'] == $date) {
		//     	$res[] = $value;
		//     }
		// }

		// Kiểm tra quyền
		if(!$this->session->has_userdata('orderManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/OrderManager');
			$this->load->model('admin/GetData');
		}

		// Kiểm tra phương thức
		$method = $this->input->server('REQUEST_METHOD');
		if ($method == 'GET') { // [GET] Lấy dữ liệu productType

			$this->output
	        ->set_content_type('application/json')
	        ->set_output(json_encode($res))
	        ->set_status_header(200);
	    } else {
			$this->output->set_status_header(500);
		}
	}

	public function orderOffline($id = -1)
	{
		// Kiểm tra quyền
		if(!$this->session->has_userdata('orderManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/OrderManager');
			$this->load->model('admin/GetData');
		}

		switch ($this->input->server('REQUEST_METHOD')) {
			case 'GET':
				if ($id === -1) {
					$data = $this->GetData->getOffline();
				} else {
					$data = $this->GetData->getOffline($id);
				}
				foreach ($data as $key => $value) {
				    $data[$key]['productList'] = json_decode($value['productList']);
				}
				$res = $data;

				$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($res))
			        ->set_status_header(200);
				break;
			case 'POST':
				if ($id != -1) {
					if ($this->OrderManager->applyOrderOffline($id)) {
						$res['status'] = true;
						$res['message'] = 'Xác nhận đơn <b>'.$id.'</b> thành công';
					} else {
						$res['status'] = false;
						$res['message'] = 'Xác nhận đơn <b>'.$id.'</b> thất bại';
					}

					$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($res))
			        ->set_status_header(200);
				}
				break;
			case 'DELETE':
				if ($this->OrderManager->deleteOrderOffline($id)) {
					$res['status'] = true;
					$res['message'] = "Xóa đơn <b>$id</b> thành công";
				} else {
					$res['status'] = false;
					$res['message'] = "Xóa đơn <b>$id</b> thất bại";
				}

				$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($res))
			        ->set_status_header(200);
				break;
			
			default:
				$this->output->set_status_header(500);
				break;
		}
	}

	public function orderOnline($id = -1)
	{
		// Kiểm tra quyền
		if(!$this->session->has_userdata('orderManager')) {
			$this->output->set_status_header(500);
			die();
		} else {
			$this->load->model('admin/OrderManager');
			$this->load->model('admin/GetData');
		}

		switch ($this->input->server('REQUEST_METHOD')) {
			case 'GET':
				if ($id === -1) {
					$data = $this->GetData->getOnline();
				} else {
					$data = $this->GetData->getOnline($id);
				}
				foreach ($data as $key => $value) {
				    $data[$key]['productList'] = json_decode($value['productList']);
				}
				$res = $data;

				$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($res))
			        ->set_status_header(200);
				break;
			case 'DELETE':
				if ($this->OrderManager->deleteOrderOnline($id)) {
					$res['status'] = true;
					$res['message'] = "Duyệt đơn <b>$id</b> thành công";
				} else {
					$res['status'] = false;
					$res['message'] = "Duyệt đơn <b>$id</b> thất bại";
				}

				$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($res))
			        ->set_status_header(200);
				break;
			
			default:
				$this->output->set_status_header(500);
				break;
		}
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */