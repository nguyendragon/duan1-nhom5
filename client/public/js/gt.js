$(document).ready(function(){
    $(".image-slider").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        prevArrow:`<button type='button' class='slick-prev slick-arrow'><i class='bx bx-left-arrow-circle' ></i></i></button>`,
        nextArrow:`<button type='button' class='slick-next slick-arrow'><i class='bx bx-right-arrow-circle'></i></button>`,
        
    });
  });