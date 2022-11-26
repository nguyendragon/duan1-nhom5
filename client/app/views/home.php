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
                    <input type="text" name="q" id="search" class="outline-none" placeholder="Tìm quán ăn, trà sữa yêu thích đế đặt Foship giao ngay">

                </div>
                <div class="map__item px-3 py-3 ">
                    <span class="text-gray-500 px-2 py-2">Giao tới địa chỉ</span>
                    <div class=" map__items-address cursor-pointer" id="find-location">
                        <i class=" text-red-600 px-2 py-2 fa-sharp fa-solid fa-location-dot"></i>
                        <p class="px-2 py-2 font-bold">Hà nội</p>
                        <p class="flex-1 text-end"><i class="fa-solid fa-angle-right"></i></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div style="width: 100%">
            <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Trường Cao đẳng Thực hành FPT Polytechnic Hà Nội&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                <a href="https://www.gps.ie/sport-gps/">fitness tracker</a>
            </iframe>
        </div> -->
        <div id="map"></div>
        <script>
            const btn = document.querySelector('#find-location');
            const findLocation = () => {
                const status = document.querySelector('.status');

                const success = (position) => {
                    console.log(position);
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;
                    // const geoApiUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=vi`;
                    const geoApiUrl = `https://rsapi.goong.io/Place/AutoComplete?api_key=O3s20d3zNP5aq4lSltC7uOjRfx34oTegmgdVg8Wk&location=${latitude},${longitude}&input=Cao đẳng fpt`;
                    fetch(geoApiUrl)
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            let description = data.predictions[0].description;
                            let width = '100%';
                            let height = '650px';
                            // let url = `https://www.google.com/maps?q=${latitude},${longitude}&hl=vi;z=14&output=embed`;
                            let url = `https://www.google.com/maps?q=${description}&hl=vi;z=14&output=embed`;
                            document.querySelector('#map').innerHTML = `
                            <iframe src="${url}" style="width: ${width};height: ${height}" frameborder="0"></iframe>                        
                            `;
                        });
                }

                const error = () => {
                    status.textContent = "Error";
                }

                navigator.geolocation.getCurrentPosition(success, error);
            }

            btn.addEventListener('click', findLocation);
        </script>

        <?php include_once "layout/banner.php" ?>


        <div class="sp">
            <div>
                <h1 class="font-bold text-xl m-2">CHỌN THEO THỂ LOẠI</h1>
                <div style="display:grid; grid-template-columns: repeat(10,1fr); gap:10px ">
                    <?php
                    foreach ($category as $key => $cate) :  ?>
                        <a href="<?= BASE_URL . '/user/search/' . $cate['id_cate'] ?>">
                            <img class="rounded-2xl" src="<?= BASE_URL ?>/public/images/<?= $cate['images'] ?>" alt="">
                            <p class="ten"><?= $cate['name_category'] ?></p>
                        </a>
                    <?php endforeach ?>
                </div>
                <div class="font-bold text-center py-8">
                    <a href="">XEM TẤT CẢ<i class='bx bxs-chevron-right'></i></a>
                </div>
            </div>

            <div class="">
                <h1 class="font-bold text-xl m-2 uppecase">KHÁM PHÁ MÓN MỚI</h1>
                <div style="display:grid; grid-template-columns: repeat(6,1fr); gap:10px ">
                    <?php
                    foreach ($product as $key => $item) :
                    ?>
                        <div class="rounded-2xl bg-white px-2 py-4 ">
                            <a href="product/details/<?= $item['id_product'] ?>">
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
                                    <a href="product/add_cart/<?= $item['id_product'] ?>" class="hover:text-white hover:bg-[#f7001e] text-sm border-gray-400 px-8 py-2 rounded-xl text-black bg-gray-200 font-bold transition-all">Thêm vào giỏ</a>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="font-bold text-center  py-8">
                    <a href="">XEM TẤT CẢ<i class='bx bxs-chevron-right'></i></a>
                </div>
            </div>

            <div class="">
                <h1 class="font-bold text-xl m-2 uppecase">Thử quán mới</h1>
                <div style="display:grid; grid-template-columns: repeat(6,1fr); gap:10px ">
                    <?php
                    foreach ($restaurants as $key => $item) :
                    ?>
                        <div class="rounded-2xl bg-white px-2 py-4 ">
                            <a href="restaurant/details/<?= $item['link'] ?>">
                                <div class="flex justify-center">
                                    <img class="w-[165px] h-[165px] rounded" src="<?= $item['images'] ?>" alt="">
                                </div>
                                <h2 class="font-bold text py-1 hover:text-red-600"><?= $item['name'] ?></h2>
                                <p class=" hover:text-red-600"><i class=" text-red-600 fa-sharp fa-solid fa-location-dot"></i> 0.3km</p>
                                <div class="flex py-2  hover:text-red-600">
                                    <img class="w-6" src="public/images/sale3.png" alt="">
                                    <div class="px-2">Giảm 10.000đ</div>
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
    <script src="public/js/gt.js"></script>
    <script>
        $('#search').keyup(function(e) {
            let query = $('#search').val().trim();
            if (e.keyCode == 13) {
                window.location.href = '<?= BASE_URL . "/user/search?q=" ?>' + query;
            }
        });
    </script>
</body>

</html>