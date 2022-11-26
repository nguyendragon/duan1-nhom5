<?php
include_once "../config.php";
include_once "../Core.php";
$dragon = new System;
$dragon->check_login();
if (isset($_GET['type'])) {
  if ($_GET['type'] == 'add_o') {
    try {
      $id_p = addslashes($_GET['id_p']);
      $a = addslashes($_GET['a']);
      $user = $dragon->userInfo();
      $id_u = $user['id_user'];

      if ($id_p && $a) {
        $product = mysqli_query($dragon->connect(), "SELECT * FROM product WHERE id_product = '" . $id_p . "'")->fetch_array();
        $res = mysqli_query($dragon->connect(), "INSERT INTO orders SET 
            amount = '" . $a . "'
            ,sale = '" . $product['sale'] . "'
            ,price = '" . $product['price'] . "'
            ,total = '" .  ($product['price'] * $a) - ($product['sale'] * $a) . "'
            ,status_order = 1
            ,id_product = '" . $product['id_product'] . "'
            ,id_restaurant = '" . $product['id_restaurant'] . "'
            ,id_user  = '" . $id_u . "'
            , create_at = '" . date("Y-m-d") . "' 
            , time = '" . time() . "' 
            ");
        $result = $dragon->res_json('success', 'Thêm đơn hàng thành công');
        echo json_encode($result);
      } else {
        $result = $dragon->res_json('error', 'Vui lòng nhập đầy đủ thông tin !');
        echo json_encode($result);
      }
    } catch (\Throwable $th) {
      var_dump($th);
      $result = $dragon->res_json('error', 'Lỗi hệ thống! Vui lòng thử lại sau!');
      echo json_encode($result);
    }
  }

  if ($_GET['type'] == 'update') {
    try {
      $id_order = addslashes($_GET['id_order']);
      $status = addslashes($_GET['status']);
      echo $id_order;
      $res = mysqli_query($dragon->connect(), "UPDATE orders SET status_order = $status WHERE id_order = '" . $id_order . "'");
      $result = $dragon->res_json('success', 'Sửa món ăn thành công');
      echo json_encode($result);
      header("location: " . BASE_URL . "/orders-list.php");
    } catch (\Throwable $th) {
      var_dump($th);
      $result = $dragon->res_json('error', 'Lỗi hệ thống! Vui lòng thử lại sau!');
      echo json_encode($result);
    }
  }

  if ($_GET['type'] == 'id_p') {
    try {
      $id_product = addslashes($_GET['id_product']);
      $res = mysqli_query($dragon->connect(), "SELECT * FROM product WHERE id_product = '" . $id_product . "'")->fetch_array();
      echo json_encode($res);
      // header("location: " . BASE_URL . "/orders-list.php");
    } catch (\Throwable $th) {
      var_dump($th);
      $result = $dragon->res_json('error', 'Lỗi hệ thống! Vui lòng thử lại sau!');
      echo json_encode($result);
    }
  }
}
