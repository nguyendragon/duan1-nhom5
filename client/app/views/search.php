<?php
    if(!isset($_GET['q']) && !isset($category['id_cate'])) {
        header('location: '.BASE_URL.'/');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "layout/head.php" ?>
</head>

<body>
    <div class="trangchu">
        <?php include_once "layout/header.php" ?>
        <div class="banner__container">
            <img src="<?= BASE_URL ?>/public/images/img04.jpg" alt="">
            <div class="form_chu text-center text-6xl px-2 py-2 ">
                <h1 class=" font-bold">ĐẶT MÓN NÀO</h1>
                <h1 class=" font-bold py-4 text-red-600">CŨNG FREESHIP</h1>
            </div>
            <div class="form__map">
                <div class="form__input px-5 py-5">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" name="q" id="search" class="outline-none" placeholder="Tìm quán ăn, trà sữa yêu thích đế đặt Foship giao ngay">
                </div>
                <div class="map__item px-3 py-3">
                    <span class="text-gray-500 px-2 py-2">Giao tới địa chỉ</span>
                    <div class=" map__items-address">
                        <i class=" text-red-600  px-2 py-2 fa-sharp fa-solid fa-location-dot"></i>
                        <p class="px-2 py-2">Hà nội</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="sp mt-[100px]">
            <div class="">
                <?php if (isset($_GET['q'])) : ?>
                    <h1 class="font-bold text-xl m-2 uppecase">Tìm kiếm theo từ khóa "<?= $_GET['q'] ?>"</h1>
                <?php endif ?>
                <?php if (isset($category['id_cate'])) : ?>
                    <h1 class="font-bold text-xl m-2 uppecase">Thể loại "<?= $category['name_category'] ?>"</h1>
                <?php endif ?>
                <?php if (count($product) == 0) : ?>
                    <div class="container bg-[#ecf0f1] p-4">
                        <p class="">
                            <span>Không có sản phẩm liên quan, </span>
                            <a href="<?=BASE_URL.'/'?>" class="text-[#3498db]">quay lại trang chủ</a>
                        </p>
                    </div>
                <?php endif ?>
                <div style="display:grid; grid-template-columns: repeat(6,1fr); gap:10px ">
                    <?php
                    foreach ($product as $key => $item) :
                    ?>
                        <div class="rounded-2xl bg-white px-2 py-4 ">
                            <a href="<?= BASE_URL ?>/product/details/<?= $item['id_product'] ?>">
                                <div class="flex justify-center">
                                    <img class="w-[165px] h-[165px] rounded" src="<?= BASE_IMG . $item['image'] ?>" alt="">
                                </div>
                                <h2 class="font-bold text py-1 hover:text-red-600"><?= $item['name_product'] ?></h2>
                                <p class="font-bold py-1 hover:text-red-600">
                                    <del class="ml-1"><?= str_replace(",",  ".", number_format($item['price'])) ?>đ</del>
                                    <span class="text-red-500 ml-1"><?= str_replace(",",  ".", number_format($item['price'] - $item['sale'])) ?>đ</span>
                                </p>
                                <p><i class="hover:text-red-600 text-red-600 fa-sharp fa-solid fa-location-dot"></i> 3.3km
                                </p>
                                <div class="text-center py-4 px-2">
                                    <a href="<?= BASE_URL ?>/product/add_cart/<?= $item['id_product'] ?>" class="hover:text-white hover:bg-[#f7001e] text-sm border-gray-400 px-8 py-2 rounded-xl text-black bg-gray-200 font-bold transition-all">Thêm vào giỏ</a>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="font-bold text-center  py-8">
                    <a href="">XEM TẤT CẢ<i class='bx bxs-chevron-right'></i></a>
                </div>
            </div>
        </div>
        <?php include_once "layout/footer.php" ?>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://kit.fontawesome.com/459431e08d.js" crossorigin="anonymous"></script>
    <script src="<?= BASE_URL ?>/public/js/gt.js"></script>
    <script>
        $('#search').keyup(function(e) {
            let query = $('#search').val().trim();
            if (e.keyCode == 13) {
                window.location.href = '<?= BASE_URL."/user/search?q=" ?>' + query;
            }
        });
    </script>
</body>

</html>