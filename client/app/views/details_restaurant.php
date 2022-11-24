<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "layout/head.php" ?>
    <style>
        #link {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        #qrcode {
            background: #fff;
            border-radius: 4px;
            height: 86px;
            left: 87.5%;
            padding: 5px;
            position: absolute;
            top: 190px;
            transform: translate(-50%, -50%);
            width: 86px;
        }
    </style>
</head>

<body>
    <?php include_once "layout/header.php" ?>
    <div class="bg-[#f6f6f6] md:py-6">
        <div class="max-w-6xl m-auto grid md:grid-cols-3 gap-8">
            <!-- content-left -->
            <div class="content-left md:col-span-2">
                <div class="bg-white drop-shadow-md rounded-md mb-4">
                    <!-- banner -->
                    <div>
                        <img class="w-full" src="<?= BASE_URL ?>/public/images/Capture.PNG" alt="">
                    </div>
                    <div class="md:px-12 px-4 py-6">
                        <div>
                            <div id="qrcode"></div>
                            <span class="bg-[#f7001e] p-1 rounded-xl text-white mr-3 mb-3 font-semibold">
                                <i class="fa fa-star-o" aria-hidden="true"></i> Đối tác Loship
                            </span>
                            <span class="bg-[#0897ee] p-1 rounded-xl text-white mb-3 ">
                                <i class="fa fa-star-half" aria-hidden="true"></i> Cửa hàng chu đáo
                            </span>
                            <i class="fa fa-heart-o hover:text-red-500 float-right md:block hidden" aria-hidden="true"></i>
                        </div>
                        <h1 class="py-2 text-2xl font-bold"><?= $restaurant['name'] ?></h1>
                        <button class="border p-1 rounded-xl "><?= $category['name_category'] ?></button>
                        <div class="grid md:grid-cols-2">
                            <div>
                                <div class="pt-2">
                                    <i class="hover:text-red-600 text-red-600 fa-sharp fa-solid fa-location-dot"></i>
                                    <span>7.2km</span>
                                    <span class="text-lime-500">
                                        <?= $restaurant['status'] == 1 ? 'Đang mở cửa' : 'Đóng cửa' ?>
                                    </span>
                                </div>
                                <div class="py-2">
                                    <i class="fa fa-thumbs-o-up  text-blue-500"></i>
                                    <?= $restaurant['vote'] ?>% <span class="text-[#9c9c9c]">(725 đánh giá)</span>
                                    <a href="" class="text-sky-400 md:float-none float-right">Xem tất cả</a>
                                </div>
                                <p class=" md:block hidden"><?= $restaurant['address'] ?></p>
                            </div>

                            <div id="link" class="md:block hidden">
                                <p class="py-2"><i class="fa fa-link" aria-hidden="true"></i>
                                    <span id="link-res"><?= BASE_URL . "/restaurant/details/" . $restaurant['link'] ?></span>
                                    <button id="copy" onclick="Copy('#link-res')" class="bg-[#f6f6f6] text-xs float-right">copy link</button>
                                </p>
                                <p class="mt-8"><i class="fa fa-star-o"></i> Quán hỗ trợ: MUỖNG/NĨA/DAO NHỰA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- responsive -->
                <div class="md:hidden block mb-3">
                    <div class="mb-3 bg-white p-3">
                        <i class="fa fa-certificate text-red-500"></i>
                        <span>Ưu đãi...</span>
                    </div>

                    <div class=" bg-white p-3">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span>Tạo nhóm cùng đặt với bạn bè</span>
                    </div>
                </div>
                <!-- menu danh mục-->
                <div class="grid md:grid-cols-4 rounded-md">
                    <div class="md:col-span-4">
                        <div class="p-3 bg-white mt-3 rounded-md">
                            <h1 class="font-bold">FRESH FRUIT TEA</h1>
                            <!-- product -->
                            <?php foreach ($product as $key => $value) : ?>
                                <div class="flex justify-between my-8">
                                    <div class="flex">
                                        <img class="w-36 rounded-md" src="<?= BASE_IMG ?>/<?= $value['image'] ?>" alt="">
                                        <div class="px-2">
                                            <p class="font-semibold"><?= $value['name_product'] ?></p>
                                            <span class="font-semibold"><?= number_format($value['price']) ?> đ</span>
                                        </div>
                                    </div>

                                    <div>
                                        <button onclick="window.location.href='<?= BASE_URL ?>/product/details/<?= $value['id_product'] ?>'">
                                            <i class="text-red-500 fa fa-plus-square fa-2x md:block hidden"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-right -->
            <div class="content-right md:block hidden">
                <ul class="p-3 bg-white rounded-md mb-3 rounded-lg">
                    <li class="border-b py-2 font-bold">
                        <h1>ƯU ĐÃI</h1>
                    </li>
                    <li class="border-b py-2">
                        <p>
                            <i class="hover:text-red-600 text-red-600 fa-sharp fa-solid fa-location-dot"></i>
                            <span class="ml-3">Freeship đơn hàng dưới 2km</span>
                        </p>
                    </li>
                    <li class="py-2">
                        <button>
                            <i class="fa fa-certificate text-blue-500"></i>
                            <span class="ml-2">Ưu đãi</span>
                        </button>
                    </li>
                </ul>

                <div class="">
                    <div class="px-3 py-6 bg-white drop-shadow-md mb-3 rounded-lg">
                        <div class="flex justify-between border-b pb-2 text-[#9c9c9c]">
                            <h1>ĐƠN HÀNG CỦA BẠN</h1>
                            <button class="bg-[#0897ee] rounded-lg p-1 text-white font-semibold">Đặt nhóm</button>
                        </div>
                        <div class="text-center p-4">
                            <p>Hãy chọn món yêu thích của bạn trên menu để đặt giao hàng ngay!</p>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <p>Tổng: <span class="text-[#9c9c9c]">(Tạm tính) <i class="fa fa-question-circle-o" aria-hidden="true"></i></span> </p> <span class="text-[#f7001e]">~ 0đ</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="bg-[#cbcbcb]	w-full text-white py-2 mb-2 rounded-lg">Tiếp tục</button>
                        <p class="text-[#9c9c9c]">lượt đặt hàng!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "layout/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/130527/qrcode.js"></script>
    <script>
        function Copy(e) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(e).html()).select();
            document.execCommand("copy");
            $temp.remove();
            Swal.fire(
                'Good job!',
                'Sao chép thành công',
                'success'
            )
        }
        $('#qrcode').empty();
        $('#qrcode').qrcode({
            width: 76,
            height: 76,
            text: 'http://localhost/client/restaurant/details/trasuatencent'
        });
    </script>
</body>

</html>