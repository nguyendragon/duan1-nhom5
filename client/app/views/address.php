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
                                <h1 class="text-xl">Địa chỉ của tôi</h1>
                                <div class="">
                                    <button id="add_address" class="flex justify-center items-center bg-[#e74c3c] text-white rounded p-2">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        <p class="">Thêm địa chỉ mới</p>
                                    </button>
                                </div>
                            </div>
                            <div class="max-h-[500px] overflow-y-auto">
                                <div class="pl-6">
                                    <h1 class="py-4 text-[20px]">Địa chỉ</h1>
                                </div>
                                <?php foreach ($list_address as $key => $value) : ?>
                                    <div class="border-b-[1px] pb-3">
                                        <div class="flex justify-between px-6">
                                            <div>
                                                <div class="py-3">
                                                    <span><?= $value['fullname'] ?></span>
                                                    <span> | </span>
                                                    <span>(+84) <?= $value['phone'] ?></span>
                                                </div>

                                                <div class="font-light">
                                                    <div>
                                                        <span><?= $value['detail'] ?></span>
                                                    </div>
                                                    <div><?= $value['ward'] ?>, <?= $value['district'] ?>, <?= $value['city'] ?></div>

                                                </div>
                                                <?php if ($value['address_default'] == 1) : ?>
                                                    <div class="w-[80px] text-center pt-1 cursor-pointer">
                                                        <p class="border-2 text-[#e74c3c] rounded-sm">Mặc định</p>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                            <div class="pt-2 min-w-[150px]">
                                                <div>
                                                    <button data-id="<?= $value['id_address'] ?>" class="update text-[#3498db]">Cập nhật</button>
                                                    <?php if ($value['address_default'] == 0) : ?>
                                                        <button data-id="<?= $value['id_address'] ?>" class="delete text-[#3498db] pl-4">Xóa</button>
                                                    <?php endif ?>
                                                </div>
                                                <div class="pt-2">
                                                    <button class="bg-[#ecf0f1] border font-semi px-1 py-1 rounded-sm">Thiết lập mặc định</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content -->
            </div>
        </div>
        <?php include_once "layout/footer.php"; ?>
    </div>
    <!-- Start Modal -->
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal-address" data-type="" data-id="">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form id="form-address" action="" method="post">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="form-group mb-5">
                            <input placeholder="Họ và tên" type="text" id="fullname" class="w-full border-[1px] outline-none p-2 mb-2 mb-3" />
                        </div>
                        <div class="form-group mb-5">
                            <input placeholder="Số điện thoại" type="text" id="phone" class="w-full border-[1px] outline-none p-2 mb-2 mb-3" />
                        </div>
                        <div class="form-group mb-5">
                            <div class="grid grid-cols-3 gap-4 mb-5">
                                <select id="city" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Chọn tỉnh thành</option>
                                </select>
                                <select id="district" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Chọn quận huyện</option>
                                </select>
                                <select id="ward" class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <input placeholder="Địa chỉ cụ thể" type="text" id="detail" class="w-full border-[1px] outline-none p-2 mb-2 mb-3" />
                        </div>
                        <div class="form-group mb-5">
                            <div class="flex items-center">
                                <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300">
                                <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-300">Chọn làm địa chỉ mặc định</label>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right">
                        <button id="hidden_model" type="button" class="py-2 px-4 text-gray-500 rounded mr-2">
                            <span>Trở lại</span>
                        </button>
                        <button id="submit-address" type="submit" class="py-2 px-4 bg-[#ee4d2d] text-white rounded mr-2">
                            <span>Hoàn thành</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        fetch('https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json')
            .then((response) => response.json())
            .then((data) => renderCity(data));

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Id === this.value);
                    city_data = result[0].Name; // lấy ra tên tỉnh
                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
    </script>
    <script>
        $('#add_address').click(function(e) {
            e.preventDefault();
            $('#modal-address').attr('data-type', 'add')
            $('#modal-address').toggle('hidden');
        });

        $('#hidden_model').click(function(e) {
            e.preventDefault();
            $('#modal-address').attr('data-type', '')
            $('#modal-address').attr('data-id', '')
            $('#modal-address').toggle('hidden');
            $('#form-address')[0].reset();
            $('#checked-checkbox').attr('disabled', false);
        });

        function checkSelect(text) {
            return text.indexOf('Chọn');
        }

        function checkNumber(mail) {
            let reg = /^[0-9]*\d$/
            return reg.test(mail)
        }

        $('#submit-address').click(function(e) {
            e.preventDefault();
            let fullname = $('#fullname').val().trim();
            let phone = $('#phone').val().trim();
            let detail = $('#detail').val().trim();
            let check = $('#checked-checkbox').is(":checked");

            let city = $('#city').find(`option:selected`).text();
            let district = $('#district').find(`option:selected`).text();
            let ward = $('#ward').find(`option:selected`).text();

            if (checkSelect(city) >= 0 || checkSelect(district) >= 0 || checkSelect(ward) >= 0 || !fullname || !phone || !detail) {
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

            let type = $('#modal-address').attr('data-type');
            let id = $('#modal-address').attr('data-id');

            $.ajax({
                type: "POST",
                url: `<?= BASE_URL ?>/user/${type}Address`,
                data: {
                    fullname: fullname,
                    phone: phone,
                    detail: detail,
                    city: city,
                    district: district,
                    ward: ward,
                    id: id,
                    default: check ? 1 : 0,
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

        $('.update').click(function(e) {
            e.preventDefault();
            $('#modal-address').attr('data-type', 'update')
            $('#modal-address').toggle('hidden');
            let id = $(this).attr('data-id');
            $('#modal-address').attr('data-id', id)
            $.ajax({
                type: "GET",
                url: "<?= BASE_URL ?>/user/selectAddress/" + id,
                dataType: "json",
                success: function(response) {
                    $('#fullname').val(response.fullname);
                    $('#phone').val(response.phone);
                    $('#detail').val(response.detail);
                    $('#checked-checkbox').attr('checked', response.address_default == 1);
                    $('#checked-checkbox').attr('disabled', response.address_default == 1);
                }
            });
        });

        $('.delete').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa tất cả không ?',
                showDenyButton: true,
                confirmButtonText: 'Đồng ý',
                denyButtonText: `Hủy bỏ`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: `<?= BASE_URL ?>/user/deleteAddress`,
                        data: {
                            id_address: id,
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
                }
            })
        });
    </script>
</body>

</html>