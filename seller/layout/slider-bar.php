<?php include_once "config.php" ?>
<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper text-center">
      <a href="index.php">
        <img class="img-fluid for-light" style="height: 25px;" src="<?=BASE_URL?>/assets/images/logo.png?e=<?=time()?>" alt="">
        <img class="img-fluid for-dark" style="height: 25px;" src="<?=BASE_URL?>/assets/images/logo.png?e=<?=time()?>" alt="">
      </a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="<?=BASE_URL?>/assets/images/logo-icon.png" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid" src="<?=BASE_URL?>/assets/images/logo-icon.png" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"> </i></div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav" href="index.php">
              <i data-feather="trending-up"></i>
              <span>Thống kê</span></a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="bar-chart-2"></i>
              <span>Sản phẩm</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="product-add.php">Thêm sản phẩm</a></li>
              <li><a href="product-list.php">Quản lý sản phẩm</a></li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="package"></i>
              <span>Đơn hàng</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="order-add.php">Thêm đơn hàng</a></li>
              <li><a href="orders-list.php">Quản lý đơn hàng</a></li>
              <li><a href="orderAll.php">Tất cả đơn hàng</a></li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav" href="settings.php">
              <i data-feather="settings"></i>
              <span>Cài đặt</span>
            </a>
          </li>
        </ul>

      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>