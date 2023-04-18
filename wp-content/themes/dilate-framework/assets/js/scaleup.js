(function($) {
  
  /* BODY_RESPONSIVE_SCALE_UP */
  function bodyResponsiveScaleUp() {
    var baseWidth = 1920;
    var windowWidth = $(window).width();
    var scaleValue = windowWidth/baseWidth;

    if( windowWidth > baseWidth ) {
      $('.scalable__elements').css({
        'transform':'scale('+scaleValue+')',
        'transform-origin':'top left'
      });
      $('.requestFreeSampleTrigger').css({
        'transform':'scale('+scaleValue+') rotate(-90deg) translateX(100%)',
        'transform-origin':'bottom right'
      });

      $(document).on('click', '.burgermenu__toggle, body.flyoutmenu__open #beforemain_wrap', function() {
        $('body').toggleClass('flyoutmenu__open');
        var burgerMenuWidth2 = $('body .burgermenu').width() * scaleValue;
        if( $('body').hasClass('flyoutmenu__open') ) {
         $('header, #beforemain_wrap').css({
            'left': -(burgerMenuWidth2)+'px',
          });
          $('body .burgermenu').css({
            'transform-origin':'top right'
          });
        }else{
          $('header, #beforemain_wrap').css({
            'left': '0px',
          });
          $('body .burgermenu').css({
            'transform-origin':'top left'
          });
        }
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
    }else{
      $(document).on('click', '.burgermenu__toggle, body.flyoutmenu__open #beforemain_wrap', function() {
        $('body').toggleClass('flyoutmenu__open');
      });
    }
  }

  bodyResponsiveScaleUp();
  
} (window.jQuery || window.$) );