<?php 

	class user extends DController{
		
		public function __construct(){
			$data = array();
			parent::__construct();
		} 

		public function index(){
			$this->login();
		}

		/****  Json_decode  ***/
		public function res_json($status, $message){
			$data = array(
				'status' => "$status",
				'message' => "$message",
			);
			return json_encode($data);
		}

		public function checkLogin()
		{
			if (!isset($_SESSION['token'])) {
				return header('Location:'.BASE_URL."/user/login");
			}
		}

		public function login(){
			$this->load->view('login');
		}

		public function register(){
			$this->load->view('register');
		}

		// Profile
		public function profile(){
			$this->checkLogin();
			$usermodel = $this->load->model('usermodel');
			$token = $_SESSION['token'];
			$data['dataUser'] = $usermodel->getUserBySession($token);
			$this->load->view('profile', $data);
		}

		public function updateProfile(){
			$this->checkLogin();
			$username = addslashes($_POST['username']);
			$fullname = addslashes($_POST['fullname']);
			$phone = addslashes($_POST['phone']);
			$sex = addslashes($_POST['sex']);
			$date_of_birth = addslashes($_POST['date_of_birth']);
			$user_model = $this->load->model('usermodel');
			$token = $_SESSION['token'];
			$userInfo = $user_model->getUserByUsername($username);
			if ($fullname && $phone && $sex && $date_of_birth && $user_model && !isset($userInfo['id_user'])) {
				$user_model->updateProfile($username, $fullname, $phone, $sex, $date_of_birth, $token);
				echo $this->res_json('1', "Cập Nhật thành công");
			} else if (isset($userInfo['id_user'])) {
				echo $this->res_json('2', "Tên đăng nhập đã tồn tại");
			} else {
				echo $this->res_json('2', "Vui lòng nhập đầy đủ thông tin");
			}
		}

		// Address
		public function address(){
			$this->checkLogin();
			$user_model = $this->load->model('usermodel');
			$token = $_SESSION['token'];
			$userInfo = $user_model->getUserBySession($token);
			$data['list_address'] = $user_model->selectAddress($userInfo['id_user']);
			$this->load->view('address', $data);
		}

		public function addAddress(){
			$this->checkLogin();
			$user_model = $this->load->model('usermodel');
			$token = $_SESSION['token'];

			$fullname = addslashes($_POST['fullname']);
			$phone = addslashes($_POST['phone']);
			$detail = addslashes($_POST['detail']);
			$city = addslashes($_POST['city']);
			$district = addslashes($_POST['district']);
			$ward = addslashes($_POST['ward']);
			$create_at = date("d M Y, H:i a");
			$time = time();
			$address_default = '';
			
			$userInfo = $user_model->getUserBySession($token);
			$list_address = $user_model->selectAddress($userInfo['id_user']);
			if (count($list_address) == 0) $address_default = 1;
			if ($fullname && $phone && $detail && $city && $district && $ward && $create_at && $time) {
				$user_model->addAddress($fullname, $phone, $city, $district, $ward, $detail, $address_default, $userInfo['id_user'], $create_at, $time);
				echo $this->res_json('1', "Thêm địa chỉ thành công");
			} else {
				echo $this->res_json('2', "Vui lòng nhập đầy đủ thông tin");
			}
		}

		public function updateAddress(){
			$this->checkLogin();
			$user_model = $this->load->model('usermodel');
			$token = $_SESSION['token'];

			$fullname = addslashes($_POST['fullname']);
			$phone = addslashes($_POST['phone']);
			$detail = addslashes($_POST['detail']);
			$city = addslashes($_POST['city']);
			$district = addslashes($_POST['district']);
			$ward = addslashes($_POST['ward']);
			$id_address = addslashes($_POST['id']);
			$address_default = addslashes($_POST['default']); 
			
			$userInfo = $user_model->getUserBySession($token);
			if ($fullname && $phone && $detail && $city && $district && $ward && $id_address && $address_default) {
				$user_model->updateAddress($fullname, $phone, $city, $district, $ward, $detail, $address_default, $id_address, $userInfo['id_user']);
				echo $this->res_json('1', "Thêm địa chỉ thành công");
			} else {
				echo $this->res_json('2', "Vui lòng nhập đầy đủ thông tin");
			}
		}

		public function deleteAddress(){
			$this->checkLogin();
			$user_model = $this->load->model('usermodel');
			$token = $_SESSION['token'];

			$id_address = addslashes($_POST['id_address']);
			
			$userInfo = $user_model->getUserBySession($token);
			if ($id_address) {
				$user_model->deleteAddress($id_address, $userInfo['id_user']);
				echo $this->res_json('1', "Xóa địa chỉ thành công");
			} else {
				echo $this->res_json('2', "Vui lòng nhập đầy đủ thông tin");
			}
		}

		public function selectAddress($id_address){
			$this->checkLogin();
			$user_model = $this->load->model('usermodel');
			$address = $user_model->selectAddressById($id_address);
			if (isset($address['id_address'])) {
				echo json_encode($address);
			}
		}

		// Bank
		public function bank(){
			$this->checkLogin();
			$this->load->view('bank');
		}

		public function changePassword(){
			$this->checkLogin();
			$this->load->view('change-password');
		}
 
		public function editPassword(){
			$this->checkLogin();
			$password = md5(addslashes($_POST['password']));
			$new_password = md5(addslashes($_POST['new_password']));
			$usermodel = $this->load->model('usermodel');
			$token = $_SESSION['token'];

			$user = $usermodel->getUserBySession($token);
			if (isset($user['id_user'])) {
				if ($user['password'] == $password) {
					$user = $usermodel->editPassword($token, $new_password);
					echo $this->res_json('1', "Thay đổi mật khẩu thành công");
				} else {
					echo $this->res_json('2', "Mật khẩu không chính xác");
				}
			}
		}

		public function bill(){
			$this->checkLogin();
			$usermodel = $this->load->model('usermodel');
			$token = $_SESSION['token'];

			$user = $usermodel->getUserBySession($token);
			$this->load->view('bill');
		}

		public function notifications(){
			$this->checkLogin();
			$this->load->view('notifications');
		}

		public function voucher(){
			$this->checkLogin();
			$this->load->view('voucher');
		}

		public function cart(){
			$user_model = $this->load->model('usermodel');
			if (isset($_SESSION['token'])) {
				$token = $_SESSION['token'];
				$userInfo = $user_model->getUserBySession($token);
				$data['address_default'] = $user_model->addressDefault($userInfo['id_user']);
			}
			if (!isset($_SESSION['token'])) $data['address_default'] = [];
			$this->load->view('cart', $data);
		} 

		public function search($id_cate = null){
			extract($_REQUEST);
			$product_model = $this->load->model('productmodel');
			$category_model = $this->load->model('categorymodel');
			if ($id_cate) {
				$data['product'] = $product_model->productByIdCate($id_cate);
				$data['category'] = $category_model->categoryById($id_cate);
			} else {
				if(!isset($_GET['q'])) $q = '';
				$data['product'] = $product_model->productByKeyWord($q);
			}
			$this->load->view('search', $data);
		}
		
		public function logout(){
				Session::unset('token');
				header('Location:'.BASE_URL."/user/login");
		}

		public function login_customer(){
			$username = addslashes($_POST['email']);
			$password = md5(addslashes($_POST['password']));
			$usermodel = $this->load->model('usermodel');
			$user = $usermodel->login($username,$password);
			if (isset($user['id_user'])) {
				Session::set('token', $user['email']);
				echo $this->res_json('1', "Đăng Nhập thành công");
			} else {
				echo $this->res_json('2', "Tài khoản hoặc mật khẩu không chính xác");
			}
		}

		public function register_customer(){
			$email = addslashes($_POST['email']);
			$password = md5(addslashes($_POST['password']));
			$create_at = date("d M Y, H:i a");
			$time = time();
			$usermodel = $this->load->model('usermodel');

			$user = $usermodel->getUserBySession($email);

			if (!isset($user['id_user'])) {
				$usermodel->insertUser($email, $password, $create_at, $time);
				Session::set('token', $email);
				echo $this->res_json('1', "Đăng ký thành công");
			} else {
				echo $this->res_json('2', "Email đã tồn tại trong hệ thống");
			}

		}
	}


?>