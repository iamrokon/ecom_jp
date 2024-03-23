$(function() {
    $(".js-example-responsive").select2({
        dropdownParent: $('#infoEditModal')
    });
});


$(".news-flash-content").owlCarousel({
    loop: true,
    autoplay: true,
    nav: false,
    dots:false,
    items:1,
    margin:0,
    stagePadding:0,
    autoplaySpeed: 2000
    // animateOut: 'slideOutUp',
    // animateIn: 'slideInUp'
  });

// $('.news-flash-content').owlCarousel({
//     loop:true,
//     margin:0,
//     autoplay: true,
//     items:1,
//     nav: false,
//     dots:false,
//     autoplaySpeed: 2000,
//     responsiveClass:true,
//     animateOut: 'slideOutUp',
//     animateIn: 'slideInUp',
//     responsive:{
//         0:{
//             items:1,
//             nav:false
//         },
//         600:{
//             items:1,
//             nav:false
//         },
//         1000:{
//             items:1,
//             nav:false,
//             loop:true
//         }
//     }
// })
// Accordion use......
$(document).ready(function() {
    $(".contact-form").click(function() {
        $(".collapsibles-body").slideToggle("slow");
        $(".angel-icon i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
});

var $dropDown = $('.categori-dropdown-active-large');
$(document).mouseup(e => {
    if (!$dropDown.is(e.target) && $dropDown.has(e.target).length === 0) {
        $dropDown.removeClass('open');
    }
});
$('a.categori-button-active').on('click', () => {
    $('a.categori-button-active').toggleClass('open');
});


$(document).ready(function() {
    $(".category").click(function() {

        $(".slideDown").slideToggle('slow');
        $(".iconUpDown span i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
    $(".allBrand").click(function() {
        $(".slideDownBrand").slideToggle('slow');
        $(".iconUpDown2 span i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
    $(".gender").click(function() {
        $(".slideGender").slideToggle('slow');
        $(".iconUpDown3 span i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
    $(".priceDropdown").click(function() {
        $(".slidepriceDropdown").slideToggle('slow');
        $(".iconUpDown4 span i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
    $(".offDropdown").click(function() {
        $(".slideoffDropdown").slideToggle('slow');
        $(".iconUpDown5 span i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
    });
});

// $(document).on('click', 'body', function() {
//     $('.categori-dropdown-active-large').removeClass('open');
// })

$(document).ready(function() {
    $(".form-check-label").click(function () {
        // alert('hello');
        $(this).parent().find('>ul').toggleClass('open');
    });
});
/*====== Sidebar menu Active ======*/
function mobileFilterActive() {
    var navbarTrigger = $('.filter-icon'),
        endTrigger = $('.mobile-filter-close'),
        container = $('.mobile-filter-active'),
        wrapper4 = $('body');
    
    wrapper4.prepend('<div class="body-overlay-1"></div>');
    
    navbarTrigger.on('click', function(e) {
        e.preventDefault();
        container.addClass('sidebar-visible');
        wrapper4.addClass('mobile-menu-active');
    });
    
    endTrigger.on('click', function() {
        container.removeClass('sidebar-visible');
        wrapper4.removeClass('mobile-menu-active');
    });
    
    $('.body-overlay-1').on('click', function() {
        container.removeClass('sidebar-visible');
        wrapper4.removeClass('mobile-menu-active');
    });
};
mobileFilterActive();


// Sub Menu height scroll js.....
var height = $('.sub-menu').height();
if (height >= 400) {
    $('.sub-menu').addClass('sub-menu-height');
}

$(document).ready(function () {
    $('.diffRadion2').click(function () {
      $('.different-info').removeClass('d-none');
      $("#receiver").val('new').change();
      if ($('.different-info').length==0) {
        $('.different-info-detail').removeClass('d-none');
      }

    });
    $('.diffRadion1').click(function () {
        $('.different-info').addClass('d-none');
        $('.different-info-detail').addClass('d-none');
      });

  });
function callTheAddress(own){

  if (own.value!='new' && own.value!='') {
    var data=null;
    $.ajax({
        type: "GET",
        url: '/getSenderAddress/'+own.value,
        async: false,
        data: data,
        success: function(result) {
          var kekka=JSON.parse(result);
          $("#diff2_name").val(kekka.name)
          $("#diff2_furigana").val(kekka.haisoumoji1)
          $("#diff2_zipcode_first_part").val(kekka.yubinbango.substring(0, 3))
          $("#diff2_zipcode_second_part").val(kekka.yubinbango.substring(3, 7))
          $("#diff2_prefecture").val(kekka.address.split(' ')[0]).change();
          $("#diff2_address1").val(kekka.address.split(' ')[1])
          $("#diff2_address2").val(kekka.address.split(' ')[2])
          $("#diff2_biladd").val(kekka.address.split(' ')[3])
          $("#diff2_phone").val(kekka.tel)
          $('.different-info-detail').removeClass('d-none');
        }
    });
  }else if (own.value=='new') {
          $("#diff2_name").val('')
          $("#diff2_furigana").val('')
          $("#diff2_zipcode_first_part").val('')
          $("#diff2_zipcode_second_part").val('')
          $("#diff2_prefecture").val('')
          $("#diff2_address1").val('')
          $("#diff2_address2").val('')
          $("#diff2_biladd").val('')
          $("#diff2_phone").val('')
          $('.different-info-detail').removeClass('d-none');
  }else{
        $("#diff2_name").val('')
        $("#diff2_furigana").val('')
        $("#diff2_zipcode_first_part").val('')
        $("#diff2_zipcode_second_part").val('')
        $("#diff2_prefecture").val('')
        $("#diff2_address1").val('')
        $("#diff2_address2").val('')
        $("#diff2_biladd").val('')
        $("#diff2_phone").val('')
        $('.different-info-detail').addClass('d-none');
  }
}
$(document).ready(function() {
    $(".categori-dropdown-wrap ul li a").click(function () {
        // alert('hello');
        $(this).parent().find('.dropdown-menu').toggleClass('open');
    });
    $(".categori-dropdown-wrap ul li.has-children").click(function () {
        // alert('hello');
        $(this).toggleClass('arrowRotate');
    });
});
// $(window).resize(function() {
//     if ($(this).width() < 1024) {
 
//     } else {
   
//     }
//   });


//Add cart dropdown for mobile..
$(document).ready(function(){
    $(".mobile-cart-icon").click(function(){
        $(".cart-dropdown-wrap").toggleClass("cart-dropdown-wrap-mob");
        
    });
});


// function scrollToTop(){
//     var scrollTop = $(".scroll-to-top");
//     $(window).on('scroll', function() {
//         var topPos = $(this).scrollTop();

//         if (topPos > 200) {
//             $(scrollTop).css("opacity", "1");

//         } else {
//             $(scrollTop).css("opacity", "0");
//         }

//     });

//     $(scrollTop).on('click', function() {
//         $('html, body')({
//             scrollTop: 0
//         });
//         return false;

//     });

// }
// scrollToTop();