<?php
// error_reporting(1);
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
require_once 'config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$config = array(
    'LOCALHOST' => 'localhost',
    'USERNAME' => 'root',
    'PASSWORD' => '',
    'DATABASE' => 'fast_food', 
);

class System {
    public function __construct() {
        $this->connect();
    }

    // Kết Nối Database
    public function connect() {
        global $config;
        $conn = mysqli_connect($config['LOCALHOST'], $config['USERNAME'], $config['PASSWORD'], $config['DATABASE']) or die("Can't Connect To Database!");
        $conn->set_charset("utf8");
        return $conn;
    }

    /***   đếm tất cả người dùng hệ thống   ***/
    public function count_user() {
        $result = mysqli_query($this->connect(), "SELECT `id` FROM `users` WHERE `status` = 1");
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    /***   Đăng nhập   ***/
    public function login($email, $pass) {
        $email = addslashes($email);
        $pass = addslashes($pass);

        $result = mysqli_query($this->connect(), "SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$pass."' AND `role` = 2 ");
        $rowcount = mysqli_num_rows($result);
        if($rowcount > 0) {
            $_SESSION['token_seller'] = $email;
            return true;
        }else {
            return false;
        }
        
    }
    /***   Kiểm tra đăng nhập   ***/
    public function check_login() {
        if(!isset($_SESSION['token_seller'])) {
            return header("Location: ".BASE_URL."/login.php");
        }
    }
    
    public function userInfo() {
        if (isset($_SESSION['token_seller'])) {
            $email = $_SESSION['token_seller'];
            $result = mysqli_query($this->connect(), "SELECT * FROM `users` WHERE `email`='".$email."'")->fetch_array();
            return $result;
        }
    }

    public function listProduct() {
        $id_res = $this->restaurant()['id_restaurant']; // id cửa hàng
        $result = mysqli_query($this->connect(), "SELECT * FROM `product` WHERE `id_restaurant`='".$id_res."' ORDER BY id_product DESC");
        return $result;
    }
    
    public function listOrder() {
        $id_res = $this->restaurant()['id_restaurant']; // id cửa hàng
        $result = mysqli_query($this->connect(), "SELECT * FROM `orders` 
        RIGHT JOIN product 
        ON orders.id_product = product.id_product WHERE status_order = 0 AND orders.id_restaurant = '".$id_res."'
        ORDER BY orders.id_order DESC");
        return $result;
    }

    public function listOrderAll() {
        $id_res = $this->restaurant()['id_restaurant']; // id cửa hàng
        $result = mysqli_query($this->connect(), "SELECT * FROM `orders` 
        RIGHT JOIN product 
        ON orders.id_product = product.id_product WHERE status_order != 0 AND orders.id_restaurant = '".$id_res."'
        ORDER BY orders.id_order DESC");
        return $result;
    }


    public function Statistical() {
        $user = $this->userInfo();
        $id_u = $user['id_user'];
        // Top 3 sản phẩm
        $id_res = $this->restaurant()['id_restaurant'];
        $top_products = mysqli_query($this->connect(), "SELECT id_product, COUNT(*) as total FROM orders WHERE id_restaurant = '".$id_res."' group by id_product order by COUNT(*) desc limit 3");

        // Tổng số món cửa hàng
        $total_product = mysqli_query($this->connect(), "SELECT COUNT(id_product) as total FROM `product` WHERE `id_restaurant`='".$id_res."'")->fetch_array();

        // Chi tiết đơn hàng
        $order_new = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND status_order >= 0 AND status_order <= 3 AND create_at = '".date( "Y-m-d")."'")->fetch_array();
        $order_wait = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND status_order = 0")->fetch_array();
        $order_done = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND status_order = 1")->fetch_array();
        $order_cannel = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND status_order = 5")->fetch_array();
        // Danh thu ngày/tuần/tháng
        $total_money = mysqli_query($this->connect(), "SELECT SUM(total) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND status_order = 1")->fetch_array();
        $today_money = mysqli_query($this->connect(), "SELECT SUM(total) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND create_at = '".date( "Y-m-d")."' AND status_order = 1")->fetch_array();
        $week_money = mysqli_query($this->connect(), "SELECT SUM(total) as total FROM `orders` WHERE WEEKOFYEAR(create_at) = WEEKOFYEAR(CURDATE()) AND WEEKDAY('".date( "Y-m-d")."') BETWEEN 1 AND WEEKDAY(CURDATE()) AND id_restaurant = '".$id_res."' AND status_order = 1")->fetch_array();
        $month_money = mysqli_query($this->connect(), "SELECT SUM(total) as total FROM `orders` WHERE create_at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE() AND id_restaurant = '".$id_res."' AND status_order = 1")->fetch_array();
        // Đơn hàng ngày/tuần/tháng
        $today_order = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE `id_restaurant`='".$id_res."' AND create_at = '".date( "Y-m-d")."' AND status_order >= 0 AND status_order <= 3")->fetch_array();
        $week_order = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE WEEKOFYEAR(create_at) = WEEKOFYEAR(CURDATE()) AND WEEKDAY('".date( "Y-m-d")."') BETWEEN 1 AND WEEKDAY(CURDATE()) AND status_order >= 0 AND status_order <= 3")->fetch_array();
        $month_order = mysqli_query($this->connect(), "SELECT COUNT(id_order) as total FROM `orders` WHERE create_at BETWEEN DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE() AND id_restaurant = '".$id_res."'  AND status_order >= 0 AND status_order <= 3")->fetch_array();
        $data = array(
            // Top 3 sản phẩm
            'top_products' => $top_products,

            // Tổng số món cửa hàng
            'total_product' => $total_product['total'],

            // Chi tiết đơn hàng
            'order_new' => $order_new['total'],
            'order_wait' => $order_wait['total'],
            'order_done' => $order_done['total'],
            'order_cannel' => $order_cannel['total'],

            // Danh thu ngày/tuần/tháng
            'total_money' => $total_money['total'],
            'today_money' => $today_money['total'],
            'week_money' => $week_money['total'],
            'month_money' => $month_money['total'],

            // Đơn hàng ngày/tuần/tháng
            'today_order' => $today_order['total'],
            'week_order' => $week_order['total'],
            'month_order' => $month_order['total'],
        );
        // print_r($data);
        return $data;
    }

    public function productById($id) {
        $id_res = $this->restaurant()['id_restaurant'];
        $result = mysqli_query($this->connect(), "SELECT * FROM `product` WHERE `id_product`='".$id."' AND `id_restaurant`='".$id_res."'")->fetch_array();
        return $result;
    }

    public function restaurant() {
        $user = $this->userInfo();
        $id_u = $user['id_user'];
        $result = mysqli_query($this->connect(), "SELECT * FROM `restaurants` WHERE `id_user`='".$id_u."'")->fetch_array();
        return $result;
    }

    public function listCategory() {
        $result = mysqli_query($this->connect(), "SELECT * FROM `category` ORDER BY id_cate  DESC");
        return $result;
    }

    public function checkUser($username) {
        $result = mysqli_num_rows(mysqli_query($this->connect(), "SELECT * FROM `users` WHERE `username`='".$username."'"));
        return $result;
    }

    /***   tạo ra chuỗi ngẫu nhiên gồm cả số và chữ (tạo token)    ***/
    public function Creat_Token($length){
        $token = openssl_random_pseudo_bytes($length);
        $token = bin2hex($token);
        return $token;
    }
    
    /***  Format Money  ***/
    public function money($data, $type) {
        return str_replace(",",  $type, number_format($data));
    }

    public function time()
    {
        $time = date("d M Y, H:i a");
        return $time;
    }

    public function res_json($status, $message){
        $data = array(
            'status' => "$status",
            'message' => "$message",
        );
        return $data;
    }

    public function status_user($username, $password)
    {
        $result = mysqli_query($this->connect(), "SELECT `status` FROM `users` WHERE `username`='".$username."' AND `password`='".md5($password)."' ")->fetch_array();
        return $result['status'];
    }

    public function random_id($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function missionDone($quantity){
        $result = mysqli_query($this->connect(), "SELECT `username` , COUNT(username) AS 'quantity' FROM `mission_done` GROUP BY(username) HAVING COUNT(username)>=1 ORDER BY COUNT(username) DESC LIMIT $quantity");
        return $result;
    }

    public function missionDone2(){
        $result = mysqli_query($this->connect(), "SELECT `id` FROM `mission_done` WHERE `username` = '".$this->userInfo()['username']."' ");
        return mysqli_num_rows($result);
    }

    public function missionToday(){
        $user = $this->userInfo();
        $today = date('d/m/Y');
        $result = mysqli_query($this->connect(), "SELECT * FROM `mission_done` WHERE `username` = '".$user['username']."' AND `time` = '".$today."' ");
        return $result;
    }

    public function readUser($user){
        $result = mysqli_query($this->connect(), "SELECT * FROM users WHERE username='$user'");
        return $result;
    }
}
