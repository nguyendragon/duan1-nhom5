<?php 

	class index extends DController{
		
		public function __construct(){
			$data = array();
			parent::__construct();

		}
		public function index(){
			$this->homepage();
		}
		public function homepage(){
			$category_model = $this->load->model('categorymodel');
			$product_model = $this->load->model('productmodel');
			$restaurant_model = $this->load->model('restaurantmodel');

			$data['category'] = $category_model->listCategory();
			$data['product'] = $product_model->listProduct();
			$data['restaurants'] = $restaurant_model->listRestaurant();
			$this->load->view('home', $data);

		}
		
		public function notfound(){
			$this->load->view('404');
		}

	}


?>