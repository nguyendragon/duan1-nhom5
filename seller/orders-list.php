<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once "layout/head.php" ?>
  <?php
  $data = $dragon->listOrder();
  ?>
</head>
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
                  <h3>Danh sách đơn hàng</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Thống kê</li>
                    <li class="breadcrumb-item active">Đơn hàng</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <!-- <div class="text-end mb-2 mr-2">
              <a href="<?=BASE_URL.'/product-add.php'?>" class="btn btn-primary">
                <span>Đơn hàng chờ duyệt</span>
              </a>
            </div> -->
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="dt-ext table-responsive">
                      <table class="display" id="responsive">
                        <thead>
                          <tr>
                            <th>Sản phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Sale</th>
                            <th>Tổng Đơn Hàng</th>
                            <th>Trạng Thái</th>
                            <th>Thời Gian</th>
                            <th>Thao Tác</th>
                          </tr>
                        </thead>
                          <?php
                          foreach ($data as $key => $value) { ?>
                            <tr class="text-center">
                              <td style="min-width: 150px;"><?=$value['name_product'] ?></td>
                              <td style="min-width: 150px;"><?=$value['amount'] ?></td>
                              <td style="min-width: 150px;"> <?= $dragon->money($value['price'], ',') ?>đ</td>
                              <td style="min-width: 150px;"><?= $dragon->money($value['sale'], ',') ?>đ (-
                              <?= ceil((100 / $value['price']) * $value['sale']) ?>%)</td>
                              <td style="min-width: 150px;">
                                <?= $dragon->money($value['total'], ',') ?>đ
                              </td>
                              <td style="min-width: 150px;color: rgb(52 211 153);">
                                <?=$value['status_order'] == 0 ? "Đang Chờ" : "Đang Giao Hàng" ?>
                              </td>
                              <td><?=date("d M Y, H:i a", $value['time'])?></td>
                              <td> 
                                <?php if ($value['status_order'] == 0) { ?>
                                  <a
                                    href="models/order.php?type=update&status=3&id_order=<?= $value['id_order'] ?>"
                                    class="btn-primary delete-btn p-2" title="">Xác nhận</a>
                                <?php } ?>
                                <a 
                                onclick="return confirm('Xác nhận hủy !');" 
                                href="models/order.php?type=update&status=5&id_order=<?= $value['id_order'] ?>"
                                class="btn-danger delete-btn p-2" title="">Hủy đơn</a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Sản phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Sale</th>
                            <th>Tổng Đơn Hàng</th>
                            <th>Trạng Thái</th>
                            <th>Thời Gian</th>
                            <th>Thao Tác</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2022 © Zeta theme by pixelstrap  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>
    <script src="assets/js/config.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/jszip.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
    <script src="assets/js/datatable/datatable-extension/custom.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
  </body>
</html>