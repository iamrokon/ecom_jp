
$(document).ready(function() {
    "use strict";
  
	$(window).on('load', function () {
        bpMenuareaFixed();
    });

    // home 1 sticky
    function bpMenuareaFixed() {
        if ($('.h3-navigation-area').length) {
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 600) {
                    $('.h3-navigation-area').addClass('navbar-fixed-top');
                } else {
                    $('.h3-navigation-area').removeClass('navbar-fixed-top');
                }
            });
        }
    }
	$(document).on("click", '.menu-toggle', function () {
		$(".menu-toggle").addClass("d-none");
		$('.close-toggle').removeClass('d-none');
	});
	$(document).on("click", '.close-toggle', function () {
		$(".menu-toggle").removeClass("d-none");
		$('.close-toggle').addClass('d-none');
	});

	 // stellarnav DropDown Menu
	 $('.stellarnav').stellarNav({
        breakpoint: 991,
		
    });
  
	// These are te default settings.
	$('#slides').slideshow({
		randomize: true,            // Randomize the play order of the slides.
		slideDuration: 15000,        // Duration of each induvidual slide.
		fadeDuration: 1000,         // Duration of the fading transition. Should be shorter than slideDuration.
		animate: true,              // Turn css animations on or off.
		pauseOnTabBlur: false,       // Pause the slideshow when the tab is out of focus. This prevents glitches with setTimeout().
		enableLog: false,           // Enable log messages to the console. Useful for debugging.
		slideElementClass: 'slide', // This is also defined in the CSS!
		slideshowId: 'slideshow'    // This is also defined in the CSS!
	});

// slider area
	// function slider_area() {
	// 	var owl = $(".product-slider");
	// 	owl.owlCarousel({
	// 		loop: true,
	// 		margin: 30,
	// 		responsiveClass: true,
	// 		navigation: true,
	// 		navText:["<span class='png-arrow-prev'></span>","<span class='png-arrow-next'></span>"],
	// 		nav: true,
	// 		items: 1,
	// 		smartSpeed: 1000,
	// 		dots: true,
	// 		lazyLoad:true,
	// 		autoplay: false,
	// 		autoplayTimeout: 4000,
	// 		center: true,
	// 		responsive: {
	// 			0: {
	// 				items: 1
	// 			},
	// 			480: {
	// 				items: 2
	// 			},
	// 			760: {
	// 				items: 5,
					
	// 			}
	// 		}
	// 	});
	// }
	// slider_area();
		
	$('.product-slider').owlCarousel({
		slideBy: 5,
		loop:true,
		margin:30,
		nav:true,
		items:5,
		navText:["<span class='png-arrow-prev'></span>","<span class='png-arrow-next'></span>"],
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav: false,
				dots: false
			},
			400:{
				items:2,
				nav: false,
				dots: false
			},
			600:{
				items:3,
				nav: false,
				dots: false
			},
			1000:{
				items:5
			
			}
		}
	});

	
	// $(window).scroll(function () { 
	
	// 	console.log($(window).scrollTop());
	
	// 	if ($(window).scrollTop() > 630) {
	// 	$('.h3-navigation-area').addClass('navbar-fixed-top');
	// 	}
	
	// 	if ($(window).scrollTop() < 551) {
	// 	$('.h3-navigation-area').removeClass('navbar-fixed-top');
	// 	}
	// });
	

  });

  // /**********************
//  * Scroll To Top
//  ***********************/
function scrollToTop(){
    var scrollTop = $(".scroll-to-top");
    $(window).on('scroll', function() {
        var topPos = $(this).scrollTop();

        if (topPos > 200) {
            $(scrollTop).css("opacity", "1");

        } else {
            $(scrollTop).css("opacity", "0");
        }

    });

    $(scrollTop).on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;

    });

}
scrollToTop();
	