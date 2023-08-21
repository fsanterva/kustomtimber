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


/******************************

INIT_IS_ON_SCREEN
  PARALLAX_SCROLLING
  PARALLAX_MOUSEMOVE
  PARALLAX_BACKGROUND_IMAGE
STICKY_HEADER
FLYOUT_MENU_HANDLER
VIVUS_INIT
BODY_RESPONSIVE_SCALE_UP
MISC
PANELLUM_INIT
FORM_EVENT_HANDLERS

*******************************/

(function($) {
	
  /* INIT_IS_ON_SCREEN */
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
  
    /* PARALLAX_SCROLLING */
    $('.compSection[data-animate="1"]').each(function() {
      var me = $(this);
      var el = me.find('.to_parallax_scroll');

        $(window).scroll(function() {

          // Check if the element is in the viewport.
          var visible = me.is_on_screen_parallax();
          if(visible) {
            el.each(function() {
              var that = $(this);
              
              var scrolled = $(window).scrollTop();
              var initY = that.offset().top;
              var height = that.height();
              var endY  = initY + that.height();
              
              var speed = that.data('speed');
              var finalSpeed = (typeof speed !== "undefined") ? speed : 0.5;
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
  
    /* PARALLAX_MOUSEMOVE */
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


    /* PARALLAX_BACKGROUND_IMAGE */
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
      }else{
        el.find('img').css('transform','translateY(0px)');
      }

      $(window).scroll(function() {
        
        el.each(function() {
          var that = $(this);
          var scrolled = $(window).scrollTop();
          var initY = that.offset().top;
          var height = that.height();
          var endY  = initY + that.height();
          var speed = 2;

          if( scrolled > initY ) {
            var diff = scrolled - initY;
            var ratio = Math.round((diff / height) * 100);
            that.find('img').css('transform','translateY('+parseInt( (ratio * speed) )+'px)');
          }else{
            that.find('img').css('transform','translateY(0px)');
          }
        });

      });

    });

  }
  
  /* STICKY_HEADER */
  function stickyHeader() {
    if( $('header').hasClass('sticky') ) {
      
      var scrolledInit = $(window).scrollTop();
      if( scrolledInit > 0 ) {
        $('header').addClass('sticky__done');
      }else{
        $('header').removeClass('sticky__done');
      }
      
      $(window).scroll(function() {

        var scrolled = $(window).scrollTop();
        if( scrolled > 70 ) {
          $('header').addClass('sticky__done');
        }else{
          $('header').removeClass('sticky__done');
        }

      });
    }
  }
  
  /* FLYOUT_MENU_HANDLER */
  function flyoutMenuHandler() {
    $(document).on('click', '.burgermenu__toggle, body.flyoutmenu__open #beforemain_wrap', function() {
      $('body').toggleClass('flyoutmenu__open');

      var baseWidth = 1920;
      var windowWidth = $(window).width();
      var scaleValue = windowWidth/baseWidth;

    });
  }

  /* VIVUS_INIT */
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
  
 
  /* MISC */
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
    
    $('.burgermenu .menu__wrap li.menu-item-has-children > a').append( $('<span class="toggleSubMenu"/>') );
    $(document).on('click', '.burgermenu .menu__wrap li.menu-item-has-children > a .toggleSubMenu', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      var me = $(this);
      me.closest('li').toggleClass('open');
    });
    
    $('.range__megamenu_wrap--timber').appendTo( $('header nav .nav__menu li.range__megamenu--timber') );
    $('.range__megamenu_wrap--cork').appendTo( $('header nav .nav__menu li.range__megamenu--cork') );
    
    $(document).on('click', 'header .range__megamenu_wrap .range__list a', function(e) {
      e.preventDefault();
      var me = $(this);
      var slug = me.data('slug');
      
      me.closest('.range__list').find('a').removeClass('active');
      me.addClass('active');
      
      me.closest('.range__megamenu_wrap').find('.products__holder').removeClass('active');
      me.closest('.range__megamenu_wrap').find('.products__holder#rangemenu__'+slug).addClass('active');
    });
    
    // $('picture.no-lazy').each(function() {
    //   var source = $(this).find('source');
    //   var srcset = source.data('srcset');
    //   source.attr('srcset', srcset);

    //   var img = $(this).find('img');
    //   var src = img.data('src');
    //   img.attr('src', src);
    // });
  }
  
  /* PANELLUM_INIT */
  function panellumInit() {
    $('.comp_project_child_gallery .panorama__container').each(function() {
      var id = $(this).attr('id');
      var url = $(this).data('url');
      
      var pano = pannellum.viewer(id, {
        "type": "equirectangular",
        "panorama": url,
        "autoLoad": true,
        "pitch": 2.3,
        "mouseZoom": false,
        "hfov": 120
      });
      
      pano.on('mousedown', function(event) {
        var cont = pano.getContainer();
        $(cont).addClass('dragging');
      });
      pano.on('mouseup', function(event) {
        var cont = pano.getContainer();
        $(cont).removeClass('dragging');
      });
      pano.on('touchstart', function(event) {
        var cont = pano.getContainer();
        $(cont).addClass('dragging');
      });
      pano.on('touchend', function(event) {
        var cont = pano.getContainer();
        $(cont).removeClass('dragging');
      });
      
    });
  }
  
  /* FORM_EVENT_HANDLERS */
  function formEventHandlers() {
    
    // $(document).on('click', '.requestFreeSampleTrigger, .freeSamplePopup', function(e) {
    //   e.preventDefault();
    //   $('body').addClass('popup__on');
    //   $('.popup__form_wrap .form__block').removeClass('active');
    //   $('.popup__form_wrap .form__block#requestSampleForm').addClass('active');
    // });
    $(document).on('click', '.site__button.downloadCatalogueBtn ', function(e) {
      e.preventDefault();
      var me = $(this);
      var fileID = me.data('fileid');
      $('body').addClass('popup__on');
      $('.popup__form_wrap .form__block').removeClass('active');
      $('.popup__form_wrap .form__block#downloadCatalogueForm').addClass('active');
      
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'getFileURL',
          fileid: fileID,
        },
        beforeSend: function() {},
        success:function(response) {
          console.log(response);
          $('.popup__form_wrap .form__block#downloadCatalogueForm form .download__file input').val(response);
        },
        complete: function() {},
        error: function(e) {
          console.log(e);
        }
      });
      
    });
    
    $(document).on('click', 'footer .downloadCatalogueBtn', function(e) {
      e.preventDefault();
      var me = $(this);
      var fileURL = me.attr('href');
      $('body').addClass('popup__on');
      $('.popup__form_wrap .form__block').removeClass('active');
      $('.popup__form_wrap .form__block#downloadCatalogueForm').addClass('active');
      
      $('.popup__form_wrap .form__block#downloadCatalogueForm form .download__file input').val(fileURL);
      
    });
    
    $(document).on('click', '.popup__form_wrap .closePopupForm', function() {
      $('body').removeClass('popup__on');
      $('.popup__form_wrap .form__block').removeClass('active');
    });
    
  }

  function globalPopupFormHandlers() {
  
    $(document).on('click', '.popup__trigger', function(e) {
      e.preventDefault();
      var me = $(this);
      var id = me.data('id');
      $('body').addClass('form__popup--open');
      $('.form__popup[data-id="'+id+'"]').addClass('open');
    });
    
    $(document).on('click', '.form__popup .inner__wrap .popClose', function() {
      $(this).closest('.form__popup').removeClass('open');
      $('body').removeClass('form__popup--open');
    });
    
    $(document).on('click', '.form__popup', function(e) {
  //     e.preventDefault();
      e.stopPropagation();
      $('body').removeClass('form__popup--open');
      $(this).removeClass('open');
    });
    $(document).on('click', '.form__popup .inner__wrap', function(e) {
  //     e.preventDefault();
      e.stopPropagation();
    });
    
  };
  
  $(document).ready(function() {
    $('body').on('contextmenu', 'img', function(e){
      return false;
  });
    
  
  initIsOnScreen();
  stickyHeader();
  vivusInit();
  panellumInit();
  misc();
  formEventHandlers();
  globalPopupFormHandlers();
});
  
} (window.jQuery || window.$) );
