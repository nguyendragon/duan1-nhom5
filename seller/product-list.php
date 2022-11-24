<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "layout/head.php" ?>
  <style>
    .delete-btn {
      padding: 5px 12px;
      font-size: 14px;
      z-index: 0;
      border-radius: 0.25rem;
      color: #fff;
    }
  </style>
</head>

<?php include_once "Core.php" ?>
<?php
$dragon = new System;
$restaurant = $dragon->listProduct();
?>

<body>
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <?php include_once "layout/header-nav.php" ?>
    <!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <?php include_once "layout/slider-bar.php" ?>
      <!-- Page Sidebar Ends-->
      <div class="page-body">
        <div class="container-fluid">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3>Danh sách sản phẩm</h3>
              </div>
              <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="index.html">
                      <i data-feather="home"></i>
                    </a>
                  </li>
                  <li class="breadcrumb-item">Thống kê</li>
                  <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid list-products">
          <div class="text-end mb-4">
            <a href="<?=BASE_URL.'/product-add.php'?>" class="btn btn-primary">
              <span>+ Thêm sản phẩm mới</span>
            </a>
          </div>
          <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive product-table">
                    <table class="display" id="basic-1">
                      <thead>
                        <tr>
                          <th>Hình ảnh</th>
                          <th>Tên Món</th>
                          <th>Giá</th>
                          <th>Giảm</th>
                          <th>Thời gian</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($restaurant as $key => $value) : ?>
                          <tr>
                            <td>
                              <img src="<?= BASE_IMG . $value['image'] ?>" alt="" style="width: 100px;height: 100px;">
                            </td>
                            <td>
                              <h6><?= $value['name_product'] ?></h6>
                              <span><?= $value['detail'] ?></span>
                            </td>
                            <td><?= $dragon->money($value['price'], ',') ?>đ</td>
                            <td><?= $dragon->money($value['sale'], ',') ?>đ (-<?= ceil((100 / $value['price']) * $value['sale']) ?>%)</td>
                            <td><?= $value['create_at'] ?></td>
                            <td>
                              <a
                              href="product-update.php?id_p=<?= $value['id_product'] ?>"
                              class="btn-primary delete-btn" title="">Sửa</a>
                              <a 
                              onclick="return confirm('Xác nhận xóa <?= $value['name_product'] ?>');" 
                              href="models/product.php/?type=delete&id_product=<?= $value['id_product'] ?>"
                              class="btn-danger delete-btn" title="">Xóa</a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
        <!-- Container-fluid Ends-->
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 footer-copyright text-center">
              <p class="mb-0">Copyright 2022 © Zeta theme by pixelstrap </p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- latest jquery-->
  <?php include_once "layout/script.php" ?>
  <script src="assets/js/product-list-custom.js"></script>
</body>

</html>