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
    var el = me.find('.section__bgimage');
    
    var initscrolled = $(window).scrollTop();
    var initinitY = me.offset().top;
    var initheight = me.height();
    var initendY  = initinitY + me.height();
    var initspeed = 1.25;
    
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
      var speed = 1.25;
      
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
    
    if( windowWidth > baseWidth ) {
      var burgerMenuWidth = $('body .burgermenu').width() * scaleValue;
      $('body .burgermenu').css({
        'right': -(burgerMenuWidth)+'px'
      });
      $('body.flyoutmenu__open .burgermenu').css({
        'right': '0px'
      });
      $('#beforemain_wrap, body header').css({
        'left': '0px'
      });
      $('body.flyoutmenu__open #beforemain_wrap, body.flyoutmenu__open header').css({
        'left': -(burgerMenuWidth)+'px'
      });
    }
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
    
    //FIX FOR INNER FIXED POSITIONED ELEMENTS
    // if( $('.comp_quicklinks_floating_bar').length ) {
    //   var qlinksTop = $('.comp_quicklinks_floating_bar').offset().top;
    //   var prevSection = $('.comp_quicklinks_floating_bar').prev('section');

    //   $(window).scroll(function() {
    //     var scrollTop = $(this).scrollTop();
    //     if( scrollTop > qlinksTop -100) {
    //       $('.comp_quicklinks_floating_bar').insertAfter( 'header' );
    //       $('.comp_quicklinks_floating_bar .row').css({
    //         'transform':'scale('+scaleValue+')',
    //         'transform-origin':'top center'
    //       });
    //     }else{
    //       $('.comp_quicklinks_floating_bar').insertAfter( prevSection );
    //       $('.comp_quicklinks_floating_bar .row').css({
    //         'transform':'scale(1)',
    //         'transform-origin':'top center'
    //       });
    //     }
    //   });
    // }
  }
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
  
  initIsOnScreen();
  stickyHeader();
  flyoutMenuHandler();
  bodyResponsiveScaleUp();
  misc();
});
  
} (window.jQuery || window.$) );