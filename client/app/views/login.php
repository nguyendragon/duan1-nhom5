<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "layout/head.php" ?>
</head>

<body>
    <div class="trangchu">
        <?php include_once "layout/header.php"; ?>
        <div class="bg-white mx-auto max-w-[600px] mt-[80px] p-3">
            <div class="popup-header flex justify-center py-2">
                <img class="w-[112px]" src="<?= BASE_URL ?>/public/images/img03.png" alt="logo-loship">
            </div>
            <div class="content">
                <div class="text-center font-bold text-[20px] mb-[8px]">Chào mừng bạn đến với Loship</div>
                <p class="text-center">Nhập số điện thoại của bạn để tiếp tục</p>
                <form action="<?=BASE_URL?>/user/login_customer" method="post">
                    <div class="my-[25px] mx-[25px]">
                        <div class="mb-4">
                            <input type="text" required="" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                            name="email" placeholder="Nhập địa chỉ email" />
                        </div>
                        <div class="mb-4">
                            <input type="password" required="" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
                            name="password" placeholder="Nhập mật khẩu" />
                        </div>
                        <button id="submit_l" class="bg-[#f7001e] text-white px-[5px] py-[10px] w-full rounded-[10px] mb-4">Đăng nhập</button>
                        <a href="<?=BASE_URL?>/user/register" class="block text-center bg-[#999] text-white px-[5px] py-[10px] w-full rounded-[10px]">Đăng ký</a>
                    </div>
                </form>
            </div>
        </div>
        <?php include_once "layout/footer.php"; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkMail(mail) {
            let reg = /\S+@\S+\.\S+/
            return reg.test(mail)
        }

        $("#submit_l").click(function(e) {
            e.preventDefault();
            let email = $('input[name="email"]').val().trim();
            let password = $('input[name="password"]').val().trim();
            if (email == "" || password == "") {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Vui lòng nhập đầy đủ thông tin!',
                })
            }
            if (!checkMail(email)) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email không đúng định dạng!',
                })
            }

            $.ajax({
                type: "POST",
                url: "<?= BASE_URL ?>/user/login_customer",
                data: {
                    email: email,
                    password: password,
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
                            window.location.href = '<?= BASE_URL . "/" ?>';
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