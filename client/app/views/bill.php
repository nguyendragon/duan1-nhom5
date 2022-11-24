<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "layout/head.php" ?>
    <style>
        .active-bill {
            background-color: #ff3f34;
            color: #fff;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="trangchu">
        <?php include_once "layout/header.php"; ?>
        <div class="bg-[#f5f5f5] pt-5 pb-5">
            <div class="max-w-5xl m-auto my-4">
                <div class="grid grid-cols-4 gap-1 col-span-1 flex">
                    <?php include_once "layout/slideBar_profile.php"; ?>
                    <div class="col-span-3 bg-white">
                        <!--
                            4. Tất cả đơn hàng
                            0. Chờ xác nhận
                            2. Chờ lấy hàng
                            3. Đang giao
                            1. Đã giao
                            5. Đã hủy
                        -->
                        <div class="flex justify-around text-right border-b-[1px]">
                            <button data-type="4" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff]">Tất cả</button>
                            <button data-type="0" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff] active-bill">Chờ xác nhận</button>
                            <button data-type="2" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff]">Chờ lấy hàng</button>
                            <button data-type="3" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff]">Đang giao</button>
                            <button data-type="1" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff]">Đã giao</button>
                            <button data-type="5" class="nav-bill flex-1 py-3 transition-all hover:bg-[#ff3f34] hover:text-[#fff]">Đã hủy</button>
                        </div>

                        <div class="max-h-[440px] overflow-y-auto" id="list-orders">
                            <!-- <div class="py-2 bg-[#f5f5f5]"></div>
                            <div class="mx-4">
                                <div>
                                    <div class="pt-4 flex items-center border-b-[1px] pb-3">
                                        <img class="h-[18px] w-[18px]" src="<?= BASE_URL ?>/public/images/shop.png" alt="">
                                        <span class="font-bold px-2">quieushop</span>
                                        <button class="bg-[#ff3f34] text-white py-1 px-2 rounded-sm">Xem shop</button>
                                    </div>
                                    <div class="flex justify-between items-center border-b-[1px] py-5 hover:bg-[#f5f5f5] px-6">
                                        <div class="flex">
                                            <img class="h-[80px] w-[80px]" src="<?= BASE_URL ?>/public/images/2022-04-07 (4).png" alt="">
                                            <div class="">
                                                <div class=" pl-2 ">
                                                    <a class="text-[17px]" href="">Máy đầm sàn nhà, sàn bê tông MOVIC99( New 100%)</a>
                                                    <div class="pt-1 font-light">Phân loại: máy loại to</div>
                                                    <span>x1</span>
                                                </div>

                                            </div>
                                        </div>

                                        <div>
                                            <button class=" text-[#ff3f34] text-[18px]">212.000vnđ</button>
                                        </div>
                                    </div>
                                    <div class="pb-4">
                                        <div class="pl-4 py-4">
                                            <span>Tổng tiền:</span>
                                            <span class="text-[#ff3f34] text-[20px]">212.00vnđ</span>
                                        </div>

                                        <div class="flex justify-between mx-4 pt-5 ">
                                            <div>
                                                <span class="text-[12px] text-[#20bf6b]">Đã giao thành công</span>
                                            </div>
                                            <div class="">
                                                <button class="border bg-[#ff3f34] text-white px-3 py-2 rounded-sm">Mua lại sản phẩm</button>
                                                <button class="border px-3 py-2 rounded-sm">Liên hệ người bán</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    </div>
                </div>
                <!-- content -->
            </div>
        </div>
        <?php include_once "layout/footer.php"; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function renderListOrders(items) {
            let html = '';
            items.map((item) => {
                return html += `
                <div class="py-2 bg-[#f5f5f5]"></div>
                <div class="mx-4">
                    <div>
                        ${item.status_order == 1 ? `<div class="pt-4 flex items-center border-b-[1px] pb-3">
                            <img class="h-[18px] w-[18px]" src="<?= BASE_URL ?>/public/images/shop.png" alt="">
                            <span class="font-bold px-2">quieushop</span>
                            <button class="bg-[#ff3f34] text-white py-1 px-2 rounded-sm">Xem shop</button>
                        </div>` : ''}

                        <div class="flex justify-between items-center border-b-[1px] py-5 hover:bg-[#f5f5f5] px-6">
                            <div class="flex">
                                <img class="h-[80px] w-[80px]" src="<?= BASE_IMG ?>${item.image}" alt="">
                                <div class="">
                                    <div class=" pl-2 ">
                                        <a class="text-[17px]" href="">
                                            <span>${item.name_product} </span> 
                                            (<span class="text-red-500">-${Math.round((item.sale / item.price) * 100)}%</span>)
                                        </a>
                                        <div class="pt-1 font-light">Ghi chú: ${item.note ? item.note : ''}</div>
                                        <span class="font-semi">Số lượng: x${item.amount}</span>
                                    </div>

                                </div>
                            </div>

                            <div>
                                <del class=" text-[#999] text-[18px]">${formatMoney(item.price, '.')}đ</del>
                                <span class=" text-[#ff3f34] text-[18px]">${formatMoney(item.price - item.sale, '.')}đ</span>
                            </div>
                        </div>
                        <div class="pb-2">
                            <div class="pl-4 py-4">
                                <span>Tổng tiền:</span>
                                <span class="text-[#ff3f34] text-[18px]">${formatMoney(item.total, '.')}đ</span>
                            </div>
                            ${item.status_order == 1 ? `<div class="flex justify-between mx-4 pt-2">
                                <div>
                                    <span class="text-[12px] text-[#20bf6b]">Đã giao thành công</span>
                                </div>
                                <div class="">
                                    <button class="border bg-[#ff3f34] text-white px-3 py-2 rounded-sm">Mua lại sản phẩm</button>
                                    <button class="border px-3 py-2 rounded-sm">Liên hệ người bán</button>
                                </div>
                            </div>` : ''}
                        </div>
                    </div>
                </div>
                `;
            })
            if(items.length == 0) {
                html = '<p class="text-center mt-5">Không có dữ liệu</p>';
            }
            $('#list-orders').html(html);
        }

        $('.nav-bill').click(function(e) {
            e.preventDefault();
            let status = $(this).attr('data-type');
            $('.nav-bill').removeClass('active-bill');
            $(this).addClass('active-bill');
            $.ajax({
                type: "GET",
                url: `<?= BASE_URL . "/order/listOrders/" ?>${status}`,
                dataType: "json",
                success: function(response) {
                    renderListOrders(response);
                }
            });
        });

        function formatMoney(money, type) {
            return String(money).replace(/(\d)(?=(\d{3})+(?!\d))/g, `$1${type}`);
        }

        $.ajax({
            type: "GET",
            url: `<?= BASE_URL . "/order/listOrders/" ?>${0}`,
            dataType: "json",
            success: function(response) {
                renderListOrders(response);
            }
        });
    </script>
</body>

</html>