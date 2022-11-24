<?php 

	class product extends DController{
		
		public function __construct(){
			$data = array();
			parent::__construct();

		}
		
		public function details($id){
			$product_model = $this->load->model('productmodel');
			$data['details_product'] = $product_model->productById($id);
			$this->load->view('details_product', $data);
		}

		public function add_cart($id){
			$product_model = $this->load->model('productmodel');
			$amount = '';
			if (isset($_POST['amount'])) $amount = $_POST['amount'];
			if (isset($id) && $id > 0) {
				$data = $product_model->productById($id);
				extract($data);
				if (isset($_SESSION['cart'])) {
					if (isset($_SESSION['cart'][$id]['sl'])) {
						$_SESSION['cart'][$id]['sl'] += $amount ? $amount : 1;
					} else {
						$_SESSION['cart'][$id]['sl'] = 1;
					}
					$_SESSION['cart'][$id]['id'] = $id;
					$_SESSION['cart'][$id]['name_product'] = $name_product;
					$_SESSION['cart'][$id]['image'] = $image;
					$_SESSION['cart'][$id]['price'] = $price;
					$_SESSION['cart'][$id]['sale'] = $sale;
				} else {
					$_SESSION['cart'][$id]['sl'] = $amount ? $amount : 1;
					$_SESSION['cart'][$id]['id'] = $id;
					$_SESSION['cart'][$id]['name_product'] = $name_product;
					$_SESSION['cart'][$id]['image'] = $image;
					$_SESSION['cart'][$id]['price'] = $price;
					$_SESSION['cart'][$id]['sale'] = $sale;
				}
				header("location:" . BASE_URL . "/user/cart");
			}
		}

		public function change_cart($id){
			extract($_REQUEST);
			if (empty($_SESSION['cart'])) {
				header("location:" . BASE_URL . "/user/cart");
			} else {
				if ($act == "delete_all") {
					unset($_SESSION['cart']); 
					header("location:" . BASE_URL . "/user/cart");
				} else if ($act == "delete") {
					if (array_key_exists($id, $_SESSION['cart'])) {
						unset($_SESSION['cart'][$id]);
						$count = count($_SESSION['cart']); 
						if($count == 0) unset($_SESSION['cart']);
						header("location:" . BASE_URL . "/user/cart");
					}
				} else if ($act == "update_sl") {
					foreach ($_SESSION['cart'] as $key => $value) {
						if ($key == $id) {
							$_SESSION['cart'][$key]['sl'] = $_POST['update_sl'];
							if ($_POST['update_sl'] <= 0) unset($_SESSION['cart'][$id]);
						}
					}
					header("location:" . BASE_URL . "/user/cart");
				} else {
					header("location:" . BASE_URL . "/user/cart");
				}
			}
		}

	}


?>