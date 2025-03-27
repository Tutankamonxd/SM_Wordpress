jQuery(function($) {
    "use strict";

    // Search focus handler
  function food_grocery_hub_searchFocusHandler() {
    const searchFirstTab = $('.inner_searchbox input[type="search"]');
    const searchLastTab = $('button.search-close');

    $(".open-search").click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('body').addClass("search-focus");
      searchFirstTab.focus();
    });

    $("button.search-close").click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('body').removeClass("search-focus");
      $(".open-search").focus();
    });

    // Redirect last tab to first input
    searchLastTab.on('keydown', function(e) {
      if ($('body').hasClass('search-focus') && e.which === 9 && !e.shiftKey) {
        e.preventDefault();
        searchFirstTab.focus();
      }
    });

    // Redirect first shift+tab to last input
    searchFirstTab.on('keydown', function(e) {
      if ($('body').hasClass('search-focus') && e.which === 9 && e.shiftKey) {
        e.preventDefault();
        searchLastTab.focus();
      }
    });

    // Allow escape key to close menu
    $('.inner_searchbox').on('keyup', function(e) {
      if ($('body').hasClass('search-focus') && e.keyCode === 27) {
        $('body').removeClass('search-focus');
        searchLastTab.focus();
      }
    });
  }

  // Call the search focus handler
  food_grocery_hub_searchFocusHandler();

    // Scroll to top functionality
    $(window).on('scroll', function() {
        if ($(this).scrollTop() >= 50) {
            $('#return-to-top').fadeIn(200);
        } else {
            $('#return-to-top').fadeOut(200);
        }
    });

    $('#return-to-top').on('click', function() {
        $('body,html').animate({ scrollTop: 0 }, 500);
    });

    // Side navigation toggle
    $('.gb_toggle').on('click', function() {
        food_grocery_hub_Keyboard_loop($('.side_gb_nav'));
    });

    // Preloader fade out
    setTimeout(function() {
        $(".loader").fadeOut("slow");
    }, 1000);

    // Sticky menu
    $(window).on('scroll', function() {
        var data_sticky = $('.menubar').data('sticky');
        if (data_sticky === true) {
            if ($(this).scrollTop() > 1) {
                $('.menubar').addClass("stick_head");
            } else {
                $('.menubar').removeClass("stick_head");
            }
        }
    });

    // Slider
    $(document).ready(function() {
        $('#slider .owl-carousel').owlCarousel({
          loop: true,
          margin: 0,
          nav: false,
          dots: true,
          rtl: false,
          items: 1,
          autoplay: false,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
        });
    });

});

// Mobile responsive menu
function food_grocery_hub_menu_open_nav() {
    jQuery(".sidenav").addClass('open');
}

function food_grocery_hub_menu_close_nav() {
    jQuery(".sidenav").removeClass('open');
}