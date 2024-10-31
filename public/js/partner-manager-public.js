(function( $ ) {
  'use strict';

  $('.partner-slider').ready(function () {
    $('.partner-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 8000,
      cssEase: 'linear',
      dots: false,
      arrows: false,
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      }]
    });
  });
})( jQuery );
