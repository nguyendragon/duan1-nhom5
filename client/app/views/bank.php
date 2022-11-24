<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "layout/head.php" ?>
</head>

<body>
    <div class="trangchu">
        <?php include_once "layout/header.php"; ?>
        <div class="bg-[#f5f5f5] pt-5 pb-5">
            <div class="max-w-5xl m-auto my-4">
                <div class="grid grid-cols-4 gap-1 col-span-1 flex">
                    <?php include_once "layout/slideBar_profile.php"; ?>
                    <div class="col-span-3 bg-white">
                        <div>
                            <div class="pt-4 flex justify-between px-6 border-b-[1px] pb-3">
                                <h1 class="text-md">Thẻ tín dụng/ Ghi nợ</h1>
                                <div class="">
                                    <button class="flex items-center bg-[#e74c3c] text-center text-white rounded p-2 flex">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        <p class="text-sm">Thêm thẻ mới</p>
                                    </button>
                                </div>
                            </div>

                            <div class="min-h-[200px] flex justify-center items-center">
                                <h2 class="text-sm">Bạn chưa liên kết ngân hàng.</h2>
                            </div>
                        </div>
                        <!-- thẻ ghi nợ -->
                        <div>
                            <div class="pt-4 flex justify-between px-6 border-b-[1px] pb-3">
                                <h1 class="text-md">Tài khoản ngân hàng của tôi</h1>
                                <div class="">
                                    <button class="flex items-center bg-[#e74c3c] text-center text-white rounded p-2 flex">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        <p class="text-sm">Thêm tài khoản ngân hàng</p>
                                    </button>
                                </div>
                            </div>

                            <div class="min-h-[200px] flex justify-center items-center">
                                <h2 class="text-sm">Bạn chưa có tài khoản ngân hàng.</h2>
                            </div>
                        </div>
                        <!-- thẻ ngân hàng -->
                    </div>
                </div>
                <!-- content -->
            </div>
        </div>
        <?php include_once "layout/footer.php"; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>