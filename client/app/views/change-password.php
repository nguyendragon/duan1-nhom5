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
                            <div class="pt-4 px-6 border-b-[1px] pb-3">
                                <h1 class="text-xl">Đổi mật khẩu</h1>
                                <span class="text-sm">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</span>
                            </div>
                        </div>

                        <div class="mt-20 px-5">
                            <form id="form-change-password" action="" method="post">
                                <div class="flex items-center mb-5">
                                    <div class="min-w-[190px]">
                                        <p class="text-left text-[#999]">Mật khẩu hiện tại</p>
                                    </div>
                                    <input class="w-full p-2 border-2 outline-none" type="password" name="" id="password">
                                </div>

                                <div class="flex items-center mb-5">
                                    <div class="min-w-[190px]">
                                        <p class="text-left text-[#999]">Mật khẩu mới</p>
                                    </div>
                                    <input class="w-full p-2 border-2 outline-none" type="password" name="" id="new-password">
                                </div>

                                <div class="flex items-center mb-5">
                                    <div class="min-w-[190px]">
                                        <p class="text-left text-[#999]">Xác nhận mật khẩu mới</p>
                                    </div>
                                    <input class="w-full p-2 border-2 outline-none" type="password" name="" id="re-new-password">
                                </div>
                                <div class="pt-4">
                                    <button id="submit-password" class="w-full bg-[#e74c3c] px-3 py-2 rounded text-white my-5">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
        </div>
        <?php include_once "layout/footer.php"; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#submit-password').click(function(e) {
            e.preventDefault();
            let password = $('#password').val().trim();
            let new_password = $('#new-password').val().trim();
            let re_new_password = $('#re-new-password').val().trim();

            if (!password || !new_password || !re_new_password) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập đầy đủ thông tin!',
                })
            }

            if (new_password != re_new_password) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mật khẩu xác nhận không chính xác!',
                })
            }

            $.ajax({
                type: "POST",
                url: `<?= BASE_URL ?>/user/editPassword`,
                data: {
                    password: password,
                    new_password: new_password
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == '1') {
                        Swal.fire(
                            'Good job!',
                            response.message,
                            'success'
                        );
                        $('#form-change-password')[0].reset();
                    } else {
                        return Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        })
                    }
                }
            });
        });
    </script>
</body>

</html>