<div class="bg-white">
    <div class="flex mt-4">
        <img class="rounded-full w-[60px] h-[60px] ml-4" src="<?= BASE_URL ?>/public/images/2022-04-07 (4).png" alt="">
        <div class="ml-4">
            <span class="font-bold">anhhv</span>
            <div class="flex">
                <p class="text-sm text-gray-500 py-2 cursor-pointer">Thành viên bạc</p>
            </div>
        </div>
        <!-- kết thúc ảnh và sửa -->
    </div>
    <style>
        #list-nav .active {
            color: #ff3f34;
            cursor: pointer;
            pointer-events: none;
        }
    </style>
    <div class="pt-10 pl-4" id="list-nav">
        <div class="flex mb-4 hover:text-[#ff3f34] transition-all">
            <img class="h-[25px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/tag.png" alt="">
            <a href="#">11.11 Sale to quá trời!</a>
        </div>
        <div class="flex hover:text-[#ff3f34] transition-all">
            <img class="h-[25px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/boy.png" alt="">
            <p class="cursor-pointer">Tài khoản của tôi</p>
        </div>
        <div class="pl-7 ml-5">
            <a class="w-full hover:text-[#ff3f34] transition-all block py-1 my-2" href="<?= BASE_URL ?>/user/profile">Hồ sơ</a>
            <a class="w-full hover:text-[#ff3f34] transition-all block py-1 my-2" href="<?= BASE_URL ?>/user/bank">Ngân hàng</a>
            <a class="w-full hover:text-[#ff3f34] transition-all block py-1 my-2" href="<?= BASE_URL ?>/user/address">Địa chỉ</a>
            <a class="w-full hover:text-[#ff3f34] transition-all block py-1 my-2" href="<?= BASE_URL ?>/user/changePassword">Đổi mật khẩu</a>
        </div>
        <div class="flex mb-4 hover:text-[#ff3f34] transition-all">
            <img class="h-[25px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/bill (1).png" alt="">
            <a class="w-full" href="<?= BASE_URL ?>/user/bill">Đơn mua</a>
        </div>
        <div class="flex mb-4 hover:text-[#ff3f34] transition-all">
            <img class="h-[24px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/notification.png" alt="">
            <a class="w-full" href="<?= BASE_URL ?>/user/notifications">Thông báo</a>
        </div>
        <div class="flex mb-4 hover:text-[#ff3f34] transition-all">
            <img class="h-[25px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/gift-voucher.png" alt="">
            <a class="w-full" href="<?= BASE_URL ?>/user/voucher">Kho voucher</a>
        </div>
        <div class="flex mb-4 hover:text-[#ff3f34] transition-all">
            <img class="h-[25px] w-[25px] mr-5" src="<?= BASE_URL ?>/public/images/logout.png" alt="">
            <a class="w-full" href="<?= BASE_URL ?>/user/logout">Đăng xuất</a>
        </div>
    </div>
    <!-- kết thúc mục trái -->
</div>
<script>
    let url = window.location.href;
    document.querySelector(`#list-nav a[href="${url}"]`).classList.add("active");
</script>