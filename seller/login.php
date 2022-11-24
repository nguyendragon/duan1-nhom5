<?php include_once "config.php" ?>
<?php include_once "Core.php" ?>
<?php
    $dragon = new System;
    $msg = '';
    $check = '';
    if (isset($_POST['seller_submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $check = $dragon->login($email, $password);
        if (!$check) $msg = 'Tài khoản hoặt mật khẩu không chính xác !';
        if ($check) $msg = 'Đăng nhập thành công !';
    }

    if (isset($_SESSION['token_seller'])) return header("Location: ".BASE_URL."/index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zeta admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Zeta admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?=BASE_URL?>/assets/images/logo/favicon-icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=BASE_URL?>/assets/images/logo/favicon-icon.png" type="image/x-icon">
    <title>Zeta admin dashboard </title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/themify.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/datatable-extension.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?=BASE_URL?>/assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/assets/css/responsive.css">
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5"><img class="bg-img-cover bg-center" src="<?= BASE_URL ?>/assets/images/login/3.jpg" alt="looginpage"></div>
                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form action="" method="post" class="theme-form login-form">
                            <h4>Đăng nhập</h4>
                            <h6>Welcome back! Log in to your account.</h6>
                            <?php if($msg) { ?>
                                <div class="alert alert-<?=$check ? 'success' : 'danger'?> dark" role="alert">
                                    <p><?=$msg?></p>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label>Địa chỉ Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" name="email" type="email" required="" placeholder="seller@gmail.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock"></i></span>
                                    <input class="form-control" name="password" type="password" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input id="checkbox1" checked type="checkbox">
                                    <label class="text-muted" for="checkbox1">Nhớ mật khẩu</label>
                                </div>
                                <a class="link" href="forget-password.html">Quên mật khẩu?</a>
                            </div>
                            <div class="form-group">
                                <button class="container btn btn-primary btn-block" name="seller_submit" type="submit">Đăng Nhập</button>
                            </div>
                            <div class="login-social-title">
                                <h5>Sign in with</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li><a href="#"><i data-feather="linkedin"></i></a></li>
                                    <li><a href="#"><i data-feather="twitter"></i></a></li>
                                    <li><a href="#"><i data-feather="facebook"></i></a></li>
                                    <li><a href="#"><i data-feather="instagram"> </i></a></li>
                                </ul>
                            </div>
                            <p>Don't have account?<a class="ms-2" href="#">Create Account</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= BASE_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/config.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/script.js"></script>
</body>

</html>