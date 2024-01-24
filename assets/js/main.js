(function ($) {
  $(document).ready(function () {
    // home slider

    var swiper = new Swiper('.home-slider', {
      effect: 'fade',
      speed: 2000,

      autoplay: {
        delay: 5000,
      },
      autoplay: true,

      loop: true,

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    $('.swiper-video').on('loadeddata', function () {
      var duration = this.duration;

      var autoplayDelay = Math.round(duration * 1000);

      $(this)
        .closest('.video-slide')
        .attr('data-swiper-autoplay', autoplayDelay);

      console.log('Video Duration: ' + duration + ' seconds');
    });

    // navbar sticky

    $(window).scroll(function () {
      var navbar = $('#main-header');

      if ($(window).scrollTop() >= 200) {
        navbar.addClass('sticky');
      } else {
        navbar.removeClass('sticky');
      }
    });

    // mobile sidebar show hide
    $(document).on('click', '#openButton', function () {
      $('#targetElement').removeClass('sidebar-hide');
    });
    $(document).on('click', '#closeButton', function () {
      $('#targetElement').addClass('sidebar-hide');
    });

    // scroll to top for all pages

    // $('#scrollToTopBtn').hide();
    // $(window).scroll(function () {
    //   if ($(this).scrollTop() > 100) {
    //     $('#scrollToTopBtn').fadeIn();
    //   } else {
    //     $('#scrollToTopBtn').fadeOut();
    //   }
    // });

    // $('#scrollToTopBtn').click(function () {
    //   $('html, body').animate({ scrollTop: 0 }, 'slow');
    // });

    // megamenu show hide start
    
    var openMegaMenu = null;

    $('.megamenu-parent a').click(function (e) {
          e.preventDefault();
      var megaMenu = $(this).closest('.megamenu-parent').find('.megamenu-main');

      if (openMegaMenu && openMegaMenu[0] !== megaMenu[0]) {
        openMegaMenu.fadeOut('slow');
      
        openMegaMenu
          .closest('.megamenu-parent')
          .find('a')
          .removeClass('active');
           
      }

      megaMenu.fadeToggle('slow');
  
      openMegaMenu = megaMenu;
    });
    
  

    // $('.megamenu-main .megamenu-close').click(function (e) {
        
    //   e.preventDefault();

    //   $(this).closest('.megamenu-main').fadeOut('slow');

    //   $(this).closest('.megamenu-parent').children('a').removeClass('active');
    // });

    $(document).on('click', function (e) {
      if (!$(e.target).closest('.megamenu-parent').length) {
        if (openMegaMenu) {
          openMegaMenu.fadeOut('slow');
          openMegaMenu
            .closest('.megamenu-parent')
            .find('a')
            .removeClass('active');
          openMegaMenu = null;
        }
      }
    });

    $('.megamenu-main').on('click', function (e) {
      e.stopPropagation();
    });

    
    
    // megamenu show hide end
 

    var menuitemSelector = 'header .main-header .parent-ul > ul > li > a';

    $(menuitemSelector).click(function () {
      let allListOfAnchorTag = document.querySelectorAll('.parent-ul > ul > li > a');
      allListOfAnchorTag.forEach((element) => {
        element.classList.remove('active');
      });
      $(menuitemSelector).removeClass('active');

      $(this).toggleClass('active');
    });

    // home news/ events slider
    var swiper = new Swiper('.homenews-slider', {
      // autoplay: true,
      loop: true,
      slidesPerView: 3,
      spaceBetween: '8.33%',
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        360: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        375: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        414: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        576: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        // when window width is <= 768px
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        // when window width is <= 992px
        992: {
          slidesPerView: 3,
        },
        // when window width is <= 1200px
        1200: {
          slidesPerView: 3,
        },
      },
    });

    // single product page video play and pos
    var currentState = 0;

    var video = $('#productVideo')[0];

    $('#playPauseButton').click(function () {
      if (currentState === 0) {
        video.play();
        currentState = 1;
        $(this).html('<i class="fa-solid fa-pause"></i>').removeClass('paused');
      } else {
        video.pause();
        currentState = 0;
        $(this).html('<i class="fa-solid fa-play"></i>').addClass('paused');
      }
    });
    // tutti category active
    var tuttiCategoryActive = '.tutti-contentbox ul li a';

    $(document).on('click', tuttiCategoryActive, function () {
      $(tuttiCategoryActive).removeClass('active');

      $(this).addClass('active');
    });

    // sidebar slideup and down

    var $ul = $('.mobile-menu-items > ul');

    $ul.find('li > a > i').click(function (e) {
      e.preventDefault();

      var $li = $(this).closest('li');

      if ($li.find('ul').length > 0) {
        if ($li.hasClass('selected')) {
          $li.removeClass('selected').find('li').removeClass('selected');
          $li.find('ul').slideUp(400);
          $li.find('a i').removeClass('mdi-flip-v');
        } else {
          if ($li.parents('li.selected').length == 0) {
            $ul.find('li').removeClass('selected');
            $ul.find('ul').slideUp(400);
            $ul.find('li a i').removeClass('mdi-flip-v');
          } else {
            $li.parent().find('li').removeClass('selected');
            $li.parent().find('> li ul').slideUp(400);
            $li.parent().find('> li a i').removeClass('mdi-flip-v');
          }

          $li.addClass('selected');
          $li.find('>ul').slideDown(400);
          $li.find('>a>i').addClass('mdi-flip-v');
        }
      }
    });

    $('.mobile-menu-items > ul ul').each(function (i) {
      if ($(this).find('>li>ul').length > 0) {
        var paddingLeft = $(this)
          .parent()
          .parent()
          .find('>li>a')
          .css('padding-left');
        var pIntPLeft = parseInt(paddingLeft);
        var result = pIntPLeft + 4;

        $(this).find('>li>a').css('padding-left', result);
      } else {
        var paddingLeft = $(this)
          .parent()
          .parent()
          .find('>li>a')
          .css('padding-left');
        var pIntPLeft = parseInt(paddingLeft);
        var result = pIntPLeft + 4;

        $(this)
          .find('>li>a')
          .css('padding-left', result)
          .parent()
          .addClass('selected--last');
      }
    });

    var activeLi = $('li.selected');
    if (activeLi.length) {
      opener(activeLi);
    }

    function opener(li) {
      var ul = li.closest('ul');
      if (ul.length) {
        li.addClass('selected');
        ul.addClass('open');
        li.find('>a>i').addClass('mdi-flip-v');

        if (ul.closest('li').length) {
          opener(ul.closest('li'));
        } else {
          return false;
        }
      }
    }

    // mobile menu end

    // bottom fix menu  active
    var BottomFixMenuActive = '.bottomfix-menu-main ul li a';

    $(document).on('click', BottomFixMenuActive, function () {
      $(BottomFixMenuActive).removeClass('active');

      $(this).addClass('active');
    });

    // push span tag at navbar protek+design

    var originalText = $('li.protekdesing a').html();
    $('li.protekdesing a').html('<span>' + originalText + '</span>');

    // chisiamo year slider

    var swiper = new Swiper('.year-slider', {
      slidesPerView: 4,
      slidesPerGroup: 1,
      spaceBetween: 30,
      autoplay: true,
      loop: true,
      pagination: false,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        360: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        375: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        414: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        576: {
          slidesPerView: 1,
          spaceBetween: 10,
        },
        // when window width is <= 768px
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        // when window width is <= 992px
        992: {
          slidesPerView: 3,
        },
        // when window width is <= 1200px
        1200: {
          slidesPerView: 4,
        },
      },
    });

    // show hide search box

    $('li.searchbox-parent a').click(function (e) {
      e.preventDefault();

      $('.custom-searchbox-main').fadeToggle('slow');
    });

    $('.search-close').click(function (e) {
      e.preventDefault();

      $('.custom-searchbox-main').fadeOut('slow');

      $('li.searchbox-parent a').removeClass('active');
    });

    $('li:not(.searchbox-parent)').click(function () {
      $('.custom-searchbox-main').fadeOut('slow');

      $('li.searchbox-parent a').removeClass('active');
    });
    $('.js-example-basic-single').select2();

    $('.prodotti-megamenu-parent > a').on('click', function (e) {
      e.preventDefault();
    });

    $("body").delegate('.megamenu-main .megamenu-close', 'click', function (e) {
     
      e.preventDefault();
       $('li.megamenu-parent > a').removeClass('active');
      $(".megamenu-parent")
      $(this).closest('.megamenu-main').fadeOut('slow');
   
     
    });
    
 
  });
})(jQuery);
