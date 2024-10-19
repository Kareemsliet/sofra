
$(function() {
    $( "#from" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
    });
  });

$(function() {
    $( "#to" ).datepicker({
      showOtherMonths: true,
      selectOtherMonths: true
    });
});


$('input').iCheck({
  checkboxClass: 'icheckbox_square-blue',
  radioClass: 'iradio_square-blue',
  increaseArea: '20%' // optional
});


$(".my-rating").starRating({
  starSize: 45,
  totalStars:	5,
  initialRating: 3,
  useFullStars: true,
  emptyColor: '#240040',
  hoverColor: '#ff4057',
  activeColor: '#ff4057',
  ratedColor: '#ff4057',
  useGradient: false,
  disableAfterRate: false,
  strokeColor: '#ff4057',
  starShape: 'rounded',
});

$('#count-example').jQuerySimpleCounter({

  // start number
  start:  0,

  // end number
  end:    155,

  // easing effect
  easing: 'swing',

  // duration time in ms
  duration: 1000,

  // callback function
  complete: ''

});


$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:40,
    nav: false,
    autoplay:true,
    dots: true,
    dotsEach: 3,
    rtl: true,
    responsive:{
        0:{
            items:1,
            dots: false,
        },
        600:{
            items:2,
            dots: false,
        },
        1000:{
            items:4
        }
    }
  });
});
