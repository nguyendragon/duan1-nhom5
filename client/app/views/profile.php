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
                    <!-- clum1 -->
                    <div class="col-span-3 bg-white">
                        <div class="pl-5 py-2 border-b-[1px]">
                            <h1 class="text-xl">Hồ sơ của tôi</h1>
                            <span class="text-sm">Quản lí thông tin hồ sơ để bảo mật tài khoản</span>
                        </div>
                        <div class="pt-10 px-5">
                            <form action="<?= BASE_URL . '/user/updateProfile' ?>" method="post">
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Tên đăng nhập: </h2>
                                    <input 
                                    class="w-full border-2 p-2 text-[#555] outline-none" 
                                    type="text" name="username" 
                                    <?=$dataUser['username'] ? 'disabled' : ''?>
                                    value="<?= $dataUser['username'] && '' ?>" 
                                    placeholder="<?=$dataUser['username']?>">
                                </div>
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Họ và tên: </h2>
                                    <input class="w-full border-2 p-2 text-[#555] outline-none" type="text" name="fullname" value="<?= $dataUser['fullname'] ?>">
                                </div>
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Email:</h2>
                                    <input class="w-full border-2 p-2 text-[#555] outline-none" disabled type="text" placeholder="<?= $dataUser['email'] ?>">
                                </div>
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Số điện thoại:</h2>
                                    <input class="w-full border-2 p-2 text-[#555] outline-none" type="text" name="phone" value="<?= $dataUser['phone'] ?>">
                                </div>
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Giới tính:</h2>
                                    <div class="mr-2 inline-block">
                                        <input type="radio" <?= $dataUser['sex'] == 1 ? "checked" : "" ?> name="gt" value="1" id="male">
                                        <label class="cursor-pointer" for="male">Nam</label>
                                    </div>
                                    <div class="mr-2 inline-block">
                                        <input type="radio" <?= $dataUser['sex'] == 2 ? "checked" : "" ?> name="gt" value="2" id="female">
                                        <label class="cursor-pointer" for="female">Nữ</label>
                                    </div>
                                    <div class="mr-2 inline-block">
                                        <input type="radio" <?= $dataUser['sex'] == 3 ? "checked" : "" ?> name="gt" value="3" id="other">
                                        <label class="cursor-pointer" for="other">Khác</label>
                                    </div>
                                </div>
                                <div class="flex items-center mb-5">
                                    <h2 class="min-w-[150px] text-[#999]">Ngày sinh:</h2>
                                    <input class="w-full border-2 border-gray-200 p-2 outline-none" type="date" name="date_of_birth" id="" value="<?= $dataUser['date_of_birth'] ?>">
                                </div>
                                <button id="save-profile" type="submit" class="w-full bg-[#e74c3c] px-3 py-2 rounded text-white my-5">Lưu</button>
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
        function checkNumber(mail) {
            let reg = /^[0-9]*\d$/
            return reg.test(mail)
        }

        function getGt() {
            let male = $('#male').is(':checked');
            let female = $('#female').is(':checked');
            let other = $('#other').is(':checked');
            if (male) return 1;
            if (female) return 2;
            if (other) return 3;
        }

        $("#save-profile").click(function(e) {
            e.preventDefault();
            let username = $('input[name="username"]').val().trim();
            let fullname = $('input[name="fullname"]').val().trim();
            let phone = $('input[name="phone"]').val().trim();
            let sex = getGt();
            let date_of_birth = $('input[name="date_of_birth"]').val().trim();
            if (!fullname || !phone || !sex || !date_of_birth) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập đầy đủ thông tin!',
                })
            }
            if (!checkNumber(phone) || phone.length != 10) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Số điện thoại không đúng định dạng!',
                })
            }

            $.ajax({
                type: "POST",
                url: "<?= BASE_URL ?>/user/updateProfile",
                data: {
                    username: username,
                    fullname: fullname,
                    phone: phone,
                    sex: sex,
                    date_of_birth: date_of_birth
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == '1') {
                        Swal.fire(
                            'Good job!',
                            response.message,
                            'success'
                        );
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
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