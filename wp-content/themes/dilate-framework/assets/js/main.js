(function($) {
  $.fn.is_on_screen = function() {
    var win = $(window);
      var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
      };
      //viewport.right = viewport.left + win.width();
      viewport.bottom = viewport.top + win.height();
      var bounds = this.offset();
      //bounds.right = bounds.left + this.outerWidth();
      bounds.bottom = bounds.top + this.outerHeight();
      return (!(viewport.bottom < (bounds.top + (win.height()/3) ) || viewport.top > (bounds.bottom + (win.height()/3) ) ));
  };
}(jQuery));
(function($) {
  $.fn.is_on_screen2 = function() {
    var win = $(window);
      var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
      };
      //viewport.right = viewport.left + win.width();
      viewport.bottom = viewport.top + win.height();
      var bounds = this.offset();
      //bounds.right = bounds.left + this.outerWidth();
      bounds.bottom = bounds.top + this.outerHeight();
      return (!(viewport.bottom < bounds.top || viewport.top > bounds.bottom ));
  };
}(jQuery));
(function($) {
  $.fn.is_on_screen_parallax = function() {
    var win = $(window);
      var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
      };
      //viewport.right = viewport.left + win.width();
      viewport.bottom = viewport.top + win.height();
      var bounds = this.offset();
      //bounds.right = bounds.left + this.outerWidth();
      bounds.bottom = bounds.top + this.outerHeight();
      return (!(viewport.bottom < bounds.top || viewport.top > bounds.bottom ));
  };
}(jQuery));

(function($) {
	
  function initIsOnScreen() {

    $('.compSection[data-animate="1"]').each(function() {
      var me = $(this);
      me.find('.to_animate').each(function() {
        if( $(this).is_on_screen() && !( $(this).hasClass('elem_in_viewport') ) ) {
          $(this).addClass('elem_in_viewport');
        }
      });
      me.find('.to_animate_manual').each(function() {
        if( $(this).is_on_screen2() && !( $(this).hasClass('elem_in_viewport') ) ) {
          $(this).addClass('elem_in_viewport');
        }
      });
    });

    $(window).scroll(function() {
      $('.compSection[data-animate="1"]').each(function() {
        var me = $(this);
        me.find('.to_animate').each(function() {
          if( $(this).is_on_screen() && !( $(this).hasClass('elem_in_viewport') ) ) {
            $(this).addClass('elem_in_viewport');
          }
        });
      });
      $('.compSection[data-animate="1"]').each(function() {
        var me = $(this);
        me.find('.to_animate_manual').each(function() {
          if( $(this).is_on_screen2() && !( $(this).hasClass('elem_in_viewport') ) ) {
            $(this).addClass('elem_in_viewport');
          }
        });
      });
    });
  
    //PARALLAX SCROLLING
    $('.compSection[data-animate="1"]').each(function() {
      var me = $(this);
      var el = me.find('.to_parallax_scroll');
      var speed = el.data('speed');
      var finalSpeed = (typeof speed !== "undefined") ? speed : 1.25;

        $(window).scroll(function() {

          var scrolled = $(window).scrollTop();
          var initY = me.offset().top;
          var height = me.height();
          var endY  = initY + me.height();

          // Check if the element is in the viewport.
          var visible = me.is_on_screen_parallax();
          if(visible) {
            el.each(function() {
              var that = $(this);
              var diff = scrolled - initY;
              var ratio = Math.round((diff / height) * 100);
              if( that.hasClass('to_parallax_left') ) {
                that.css('transform','translateX('+parseInt(-(ratio * finalSpeed))+'px)');
              }else if( that.hasClass('to_parallax_right') ) {
                that.css('transform','translateX('+parseInt((ratio * finalSpeed))+'px)');
              }else if( that.hasClass('to_parallax_bottom') ) {
                that.css('transform','translateY('+parseInt((ratio * finalSpeed))+'px)');
              }else{
                that.css('transform','translateY('+parseInt(-(ratio * finalSpeed))+'px)');
              }
            });
          }

        });
    });
  
    //PARALLAX MOUSEMOVE
    $('.compSection[data-animate="1"]').each(function() {
      var sect = $(this);
      var el = sect.find('.to_parallax_mousemove');

      $(document).on('mousemove', function(e) {

        el.each(function() {
          var me = $(this);
          var speed = me.data('speed');
          var x = ( $(window).innerWidth() - e.pageX*speed ) / 100;
          var y = ( $(window).innerHeight() - e.pageY*speed ) / 100;

          if( me.hasClass('to_parallax_mousemove--horizontal') ) {
            me.css({
              'transform':`translate3d(${x}px, 0px, 0px)`,
              'transform-style':'preserve-3d',
              'backface-visibility':'hidden'
            });
          }else if( me.hasClass('to_parallax_mousemove--vertical') ) {
            me.css({
              'transform':`translate3d(0px, ${y}px, 0px)`,
              'transform-style':'preserve-3d',
              'backface-visibility':'hidden'
            });
          }else{
            me.css({
              'transform':`translate3d(${x}px, ${y}px, 0px)`,
              'transform-style':'preserve-3d',
              'backface-visibility':'hidden'
            });
          }

        });
      });
    });


    //PARALLAX BACKGROUND IMAGE
    $('.compSection[data-animate="1"]').each(function() {
      var me = $(this);
      var el = me.find('.section__bgimage, .to_parallax_bg');

      var initscrolled = $(window).scrollTop();
      var initinitY = me.offset().top;
      var initheight = me.height();
      var initendY  = initinitY + me.height();
      var initspeed = 2;

      if( initscrolled > initinitY ) {
        var diff = initscrolled - initinitY;
        var ratio = Math.round((diff / initheight) * 100);
        el.find('img').css('transform','translateY('+parseInt( (ratio * initspeed) )+'px)');
      }

      $(window).scroll(function() {

        var scrolled = $(window).scrollTop();
        var initY = me.offset().top;
        var height = me.height();
        var endY  = initY + me.height();
        var speed = 2;

        if( scrolled > initY ) {
          var diff = scrolled - initY;
          var ratio = Math.round((diff / height) * 100);
          el.find('img').css('transform','translateY('+parseInt( (ratio * speed) )+'px)');
        }

      });

    });

  }
  
  function stickyHeader() {
    if( $('header').hasClass('sticky') ) {
      $(window).scroll(function() {

        var scrolled = $(window).scrollTop();
        if( scrolled > 300 ) {
          $('header').addClass('sticky__done');
        }else{
          $('header').removeClass('sticky__done');
        }

      });
    }
  }
  
  function flyoutMenuHandler() {
    $(document).on('click', '.burgermenu__toggle, body.flyoutmenu__open #beforemain_wrap', function() {
      $('body').toggleClass('flyoutmenu__open');

      var baseWidth = 1920;
      var windowWidth = $(window).width();
      var scaleValue = windowWidth/baseWidth;

    });
  }

  function vivusInit() {

    $('.kustom__icon_wrap').each(function() {
      var me = $(this);
      var id = me.attr("id");

      new Vivus(id, {
              type: 'sync',
              duration: 150,
              file: '/wp-content/uploads/2023/01/kustom-k.svg',
              animTimingFunction: Vivus.EASE_OUT
            }, function() {
              $("#"+id).addClass('animate__done');
            });
    });

  }
  
  function bodyResponsiveScaleUp() {
    var baseWidth = 1920;
    var windowWidth = $(window).width();
    var scaleValue = windowWidth/baseWidth;

    if( windowWidth > baseWidth ) {
      $('body header, body #beforemain_wrap, body .burgermenu, body .quoteForm').css({
        'transform':'scale('+scaleValue+')',
        'transform-origin':'top center'
      });

      var burgerMenuWidth = $('body .burgermenu').width() * scaleValue;
      $('body .burgermenu').css({
        'right': -(burgerMenuWidth)+'px',
        'transform-origin':'top right'
      });

      //FIX FOR FIXED POSITIONED PRODUCT FILTER
      if( $('.comp_product_filter').length ) {
        var filterElem = $('.comp_product_filter .row--filter__wrapper.product__filter_wrap');
        var filterWrapHeight = filterElem.outerHeight();
        var filterTop = filterElem.offset().top;
        var headerHeight = 113*scaleValue;

        $(window).scroll(function() {
          var scrollTop = $(this).scrollTop();

          if( scrollTop > (filterTop*scaleValue) - 130 ) {

            if( $('body > .row--filter__wrapper.product__filter_wrap').length <= 0 ) {
              filterElem.insertAfter( 'header' );
            }
            $('body > .row--filter__wrapper.product__filter_wrap').addClass('fixed');
            $('body > .row--filter__wrapper.product__filter_wrap').css({
              'transform':'scale('+scaleValue+')',
              'transform-origin':'top center',
              'top':headerHeight+'px',
            });
            $('.comp_product_filter').find('.row--productlist').css({
              'margin-top':filterWrapHeight+'px'
            });

          }else{
            $('body > .row--filter__wrapper.product__filter_wrap').removeClass('fixed').prependTo( $('.comp_product_filter') );
            filterElem.css({
              'transform':'scale(1)',
              'transform-origin':'top center',
              'top':'0'
            });
            $('.comp_product_filter').find('.row--productlist').css({
              'margin-top':'0px'
            });
          }
        });
      }
    }
  }
  
  function panolensInit() {
    
    var forEach = function (array, callback, scope) {
      for (var i = 0; i < array.length; i++) {
        callback.call(scope, i, array[i]); // passes back stuff we need
      }
    };
    
    var myNodeList = document.querySelectorAll('.panorama__container');
    forEach(myNodeList, function (index, value) {
      var url = this.getAttribute('url');
      console.log(url, value);
    });
    
  }
 
  function misc() {
    $('p').each(function(){ // For each element
      if( $(this).text().trim() === '' )
          $(this).addClass('empty'); // if it is empty, it removes it
    });
    $('p').each(function(){ // For each element
      if($(this).find('img').length > 0) {
        $(this).addClass('has__image');
      }
    });
  }
  
  $(document).ready(function() {
    $('body').on('contextmenu', 'img', function(e){
      return false;
  });
    
//   function serviceWorker() {
//     if ('serviceWorker' in navigator) {
//     window.addEventListener('load', function() {
//       navigator.serviceWorker.register('/wp-content/themes/dilate-framework/assets/js/service-worker.js').then(function(registration) {
//         // Registration was successful
//         console.log('Registered!');
//       }, function(err) {
//         // registration failed :(
//         console.log('ServiceWorker registration failed: ', err);
//       }).catch(function(err) {
//         console.log(err);
//       });
//     });
//     } else {
//       console.log('service worker is not supported');
//     }
//   }
  
  initIsOnScreen();
  stickyHeader();
  flyoutMenuHandler();
  vivusInit();
  panolensInit();
  bodyResponsiveScaleUp();
  misc();
//   serviceWorker();
});
  
} (window.jQuery || window.$) );