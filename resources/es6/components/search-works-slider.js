// import $ from 'jquery';
import 'slick-carousel';

const $slick_slider = $(".slick-slider.search-works")
const settings = {

  // normal options...
  infinite: false,
  slidesToShow: 1,
  infinite: true,
  dots: true,
  mobileFirst:true,

  // the magic
  responsive: [
    {
      breakpoint: 2800,
      settings: "unslick"

    },
    {
      breakpoint: 1200,
      settings: "unslick"

    },
    {
      breakpoint: 992,
      settings: "unslick"
    },
    {

      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      }
    },
    {

      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    }]
}
$slick_slider.slick(settings);

// reslick only if it's not slick()
$(window).on('resize', function() {
  if ($(window).width() < 768) {
    if ($slick_slider.hasClass('slick-initialized')) {
      $slick_slider.slick('unslick');
    }
    return
  }

  if (!$slick_slider.hasClass('slick-initialized')) {
    return $slick_slider.slick(settings);
  }
});

// $(".slick-slider.search-works").slick({

//   // normal options...
//   infinite: false,
//   slidesToShow: 1,
//   infinite: true,
//   dots: true,
//   mobileFirst:true,

//   // the magic
//   responsive: [
//     {
//       breakpoint: 2800,
//       settings: "unslick"

//     },
//     {
//       breakpoint: 1200,
//       settings: "unslick"

//     },
//     {
//       breakpoint: 992,
//       settings: "unslick"
//     },
//     {

//       breakpoint: 768,
//       settings: {
//         slidesToShow: 1,
//       }
//     },
//     {

//       breakpoint: 576,
//       settings: {
//         slidesToShow: 1
//       }
//     }]
// });