<?php
include_once "../config.php";
include_once "../Core.php";
$dragon = new System;
if (isset($_POST['type'])) {
  if ($_POST['type'] == 'add') {
    try {
      $name_product = addslashes($_POST['name_product']);
      $price_product = addslashes($_POST['price_product']);
      $id_category = addslashes($_POST['id_category']);
      $sale_product = addslashes($_POST['sale_product']);
      $content = addslashes($_POST['content']);

      $filename = $_FILES['file']['name'];
      $random = rand(10000, 99999);
      $location = $_SERVER['DOCUMENT_ROOT'] . "/seller/assets/upload/" . $random . "_" . $filename;

      $id_restaurant = $dragon->restaurant();
      $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);
      $valid_extensions = array("jpg", "jpeg", "png", "jfif");

      if (in_array(strtolower($imageFileType), $valid_extensions)) {
        $check = move_uploaded_file($_FILES['file']['tmp_name'], $location);
        if ($check) {
          $res = mysqli_query($dragon->connect(), "INSERT INTO product SET 
            name_product = '" . $name_product . "'
            ,image = '" . $random . "_" . $filename . "'
            ,price = '" . $price_product . "'
            ,sale = '" . $sale_product . "'
            ,voucher = '0'
            ,detail = '" . $content . "'
            ,vote = '5'
            ,id_restaurant = '" . $id_restaurant['id_restaurant'] . "'
            ,id_cate  = '" . $id_category . "'
            , create_at = '" . $dragon->time() . "' 
            , time = '" . time() . "' 
            ");
          $result = $dragon->res_json('success', 'Thêm món ăn thành công');
          echo json_encode($result);
          exit();
        }
      } else {
        $result = $dragon->res_json('error', 'File không đúng định dạng !');
        echo json_encode($result);
      }
    } catch (\Throwable $th) {
      var_dump($th);
      $result = $dragon->res_json('error', 'Lỗi hệ thống! Vui lòng thử lại sau!');
      echo json_encode($result);
    }
  }

  if ($_POST['type'] == 'update') {
    try {
      $name_product = addslashes($_POST['name_product']);
      $price_product = addslashes($_POST['price_product']);
      $id_category = addslashes($_POST['id_category']);
      $sale_product = addslashes($_POST['sale_product']);
      $content = addslashes($_POST['content']);
      $id_p = addslashes($_POST['id_p']);
      if (isset($_FILES['file'])) {
        $filename = $_FILES['file']['name'];
        $random = rand(10000, 99999);
        $location = $_SERVER['DOCUMENT_ROOT'] . "/seller/assets/upload/" . $random . "_" . $filename;

        $product = $dragon->productById($id_p);
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        $valid_extensions = array("jpg", "jpeg", "png", "jfif");
        if (in_array(strtolower($imageFileType), $valid_extensions)) {
          $check = move_uploaded_file($_FILES['file']['tmp_name'], $location);
          $res = mysqli_query($dragon->connect(), "UPDATE product SET 
              name_product = '" . $name_product . "'
              ,image = '" . $random . "_" . $filename . "'
              ,price = '" . $price_product . "'
              ,sale = '" . $sale_product . "'
              ,voucher = '0'
              ,detail = '" . $content . "'
              ,vote = '5'
              ,id_cate  = '" . $id_category . "' WHERE id_product = '".$id_p."'
              ");
          $filename = $_SERVER['DOCUMENT_ROOT']."/seller/assets/upload/".$product['image'];
          unlink($filename);
          $result = $dragon->res_json('success', 'Sửa món ăn thành công');
          echo json_encode($result);
          exit();
        } else {
          $result = $dragon->res_json('error', 'File không đúng định dạng !');
          echo json_encode($result);
        }
      } else {
        $res = mysqli_query($dragon->connect(), "UPDATE product SET 
          name_product = '" . $name_product . "'
          ,price = '" . $price_product . "'
          ,sale = '" . $sale_product . "'
          ,voucher = '0'
          ,detail = '" . $content . "'
          ,vote = '5'
          ,id_cate  = '" . $id_category . "' WHERE id_product = '".$id_p."'
          ");
        $result = $dragon->res_json('success', 'Sửa món ăn thành công');
        echo json_encode($result);
      }
    } catch (\Throwable $th) {
      var_dump($th);
      $result = $dragon->res_json('error', 'Lỗi hệ thống! Vui lòng thử lại sau!');
      echo json_encode($result);
    }
  }
}

if (isset($_GET['type'])) {
  if ($_GET['type'] == 'delete') {
    $id_product = $_GET['id_product'];
    if ($id_product) {
      $res = mysqli_query($dragon->connect(), "DELETE FROM `product` WHERE id_product = $id_product");
      header("location: " . BASE_URL . "/product-list.php");
    } else {
      header("location: " . BASE_URL . "/product-list.php");
    }
  }
}
