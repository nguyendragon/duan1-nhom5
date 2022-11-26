<?php 

	class restaurant extends DController{
		
		public function __construct(){
			$data = array();
			parent::__construct();

		}
		public function index(){
			// $this->details($link);
		}


		public function details($link){
			$restaurant_model = $this->load->model('restaurantmodel');
			$category_model = $this->load->model('categorymodel');
			$product_model = $this->load->model('productmodel');
			$data['restaurant'] = $restaurant_model->restaurantByLink($link);

			$id_res = $data['restaurant']['id_restaurant'];
			$id_cate = $data['restaurant']['id_cate']; 
			
			$data['category'] = $category_model->categoryById($id_cate);
			$data['product'] = $product_model->productByIdRes($id_res);

			$this->load->view('details_restaurant', $data);
		}

		// public function restauranById($id){
		// 	$restaurant_model = $this->load->model('restaurantmodel');
		// 	$category_model = $this->load->model('categorymodel');
		// 	$product_model = $this->load->model('productmodel');
		// 	$data['restaurant'] = $restaurant_model->restaurantById($id);

		// 	$id_res = $data['restaurant']['id_restaurant'];
		// 	$id_cate = $data['restaurant']['id_cate']; 
			
		// 	$data['category'] = $category_model->categoryById($id_cate);
		// 	$data['product'] = $product_model->productByIdRes($id_res);

		// 	$this->load->view('details_restaurant', $data);
		// }

	}


?>