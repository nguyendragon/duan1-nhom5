<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "layout/head.php" ?>
  <?php include_once "config.php" ?>
  <?php include_once "Core.php" ?>
  <?php
  $dragon = new System;
  $list_pro = $dragon->listProduct();
  ?>
  <style>
    .preview-img {
      display: flex;
      font-size: 20px;
      font-weight: 700;
      justify-content: center;
      align-items: center;
      background-color: #ecf0f1;
      padding: 5px;
      min-height: 90px;
      border: 1px dashed #ccc
    }

    .ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred,
    .ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-focused {
      min-height: 200px;
    }

    .img-flag {
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <?php include_once "layout/header-nav.php" ?>
    <div class="page-body-wrapper">
      <?php include_once "layout/slider-bar.php" ?>
      <div class="page-body">
        <div class="container-fluid">
          <div class="page-title">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3>Thêm sản phẩm</h3>
              </div>
              <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                  <li class="breadcrumb-item">Thống kê</li>
                  <li class="breadcrumb-item active"> Thêm sản phẩm</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <!-- action="" method="post" -->
                  <form class="needs-validation" novalidate="">
                    <div class="row g-3 mb-4">
                      <div class="col-md-12">
                        <label class="form-label" for="id_product">Sản phẩm</label>
                        <select class="form-select" id="id_product" onchange="getProById()" required="">
                          <option value="">----- Chọn Sản phẩm -----</option>
                          <?php foreach ($list_pro as $key => $value) : ?>
                            <option thumbnail="<?= $value['image'] ?>" value="<?= $value['id_product'] ?>"><?= $value['name_product'] ?></option>
                          <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">Vui lòng chọn một trạng thái hợp lệ.</div>
                      </div>
                      <div class="col-md-4">
                        <label class="form-label" for="name_product">Tên sản phẩm</label>
                        <input class="form-control" id="name_product" disabled type="text" value="" placeholder="Nhập tên sản phẩm" required="">
                        <div class="invalid-feedback">Vui lòng nhập tên sản phẩm.</div>
                      </div>
                      <div class="col-md-4">
                        <label class="form-label" for="price_product">Giá sản phẩm</label>
                        <input class="form-control" id="price_product" disabled type="text" value="" placeholder="Nhập giá sản phẩm" required="">
                        <div class="invalid-feedback">Vui lòng nhập giá sản phẩm.</div>
                      </div>
                      <div class="col-md-4">
                        <label class="form-label" for="sale_product">Giảm giá</label>
                        <input class="form-control" id="sale_product" disabled type="text" value="0" placeholder="Giảm giá" required="">
                        <div class="invalid-feedback">Vui lòng nhập giảm giá.</div>
                      </div>
                    </div>
                    <div class="row g-3 mb-4">
                      <div class="col-md-3 mb-3">
                        <label class="form-label" for="amount">Số lượng</label>
                        <input class="form-control" id="amount" type="number" value="1" placeholder="Nhập số lượng">
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label class="form-label" for="value5">Voucher</label>
                        <input class="form-control" id="value5" type="text" placeholder="Nhập mã voucher">
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <div class="row g-3 mb-4">
                      <div class="col-md-12 preview-img">
                        <p id="image-show1">HÌNH ẢNH SẢN PHẨM</p>
                        <img id="image-show" width="162px" height="162px" src="" title="" style="display: none;">
                      </div>
                    </div>
                    <div class="row g-3 mb-4">
                      <div class="col-md-12">
                        <div id="editor">
                          Ghi chú đơn hàng này
                        </div>
                      </div>
                    </div>
                    <div class="row g-3 mb-4">
                      <div class="col-md-12 mb-3 bg-primary p-2">
                          <h4>Tổng đơn hàng: </h4>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="form-check">
                        <div class="checkbox p-0">
                          <input class="form-check-input" checked id="invalidCheck" type="checkbox" required="">
                          <label class="form-check-label" for="invalidCheck">Đồng ý với các điều khoản và điều kiện</label>
                        </div>
                        <div class="invalid-feedback">Bạn phải đồng ý trước khi gửi.</div>
                      </div>
                    </div>
                    <button class="container btn btn-primary" id="add_product" type="submit">Xác nhận thêm</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
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
  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="assets/js/scrollbar/simplebar.js"></script>
  <script src="assets/js/scrollbar/custom.js"></script>
  <script src="assets/js/config.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
  <script src="assets/js/form-validation-custom.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/theme-customizer/customizer.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let editor;

    ClassicEditor
      .create(document.querySelector('#editor'))
      .then(newEditor => {
        editor = newEditor;
      })
      .catch(error => {
        console.error(error);
      });

    $("#add_product").click(function(e) {
      e.preventDefault();
      let id_product = $('#id_product').val().trim();
      let amount = $('#amount').val().trim();
      const editorData = editor.getData();
      if (id_product && amount) {
        $.ajax({
          url: `models/order.php?type=add_o&id_p=${id_product}&a=${amount}`,
          type: 'GET',
          success: function(response) {
            let data = JSON.parse(response);
            if (data.status == 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Good Job!',
                text: data.message,
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
              });
            }
          },
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: "Vui lòng nhập đầy đủ thông tin",
        });
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    function caculateOrder() {
      
    }

    function getProById() {
      let id_product = $('#id_product').val().trim();
      $.ajax({
        type: "GET",
        url: `models/order.php?type=id_p&id_product=${id_product}`,
        dataType: "json",
        success: function(data) {
          $('#name_product').val(data.name_product);
          $('#price_product').val(data.price);
          $('#sale_product').val(data.sale);
          $('#name_product').val(data.name_product);
          $('#image-show1').fadeOut(0);
          $('#image-show').fadeIn(0);
          $('#image-show').attr('src', '<?= BASE_URL ?>/assets/upload/' + data.image);
        }
      });
    }

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }
      var baseUrl = "<?= BASE_URL ?>/assets/upload";
      var $state = $(
        `<span>
          <img 
          src="${baseUrl}/${state.element.attributes.thumbnail.nodeValue}" 
          class="img-flag" />
          <span class="ml-4">${state.text}</span>
        </span>`
      );
      return $state;
    };

    $("#id_product").select2({
      templateResult: formatState
    });
  </script>
</body>

</html>