(function($) {
  
  $(document).ready(function($) {
    
    $(".comp_product_child_similar_tones_and_grades .tones__carousel_wrapper").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      autoplaySpeed: 5000,
      pauseOnFocus: false,
      pauseOnHover: false,
      arrows: true,
      speed: 500,
      fade: false,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="71.061" height="58.09" viewBox="0 0 71.061 58.09"><path d="M1421.994,7536.837l29.453-29.045,4.778,4.713-21.289,20.994h58.118v6.677h-58.118l21.289,20.994-4.778,4.713Z" transform="translate(-1421.994 -7507.792)"/></svg></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="71.062" height="58.09" viewBox="0 0 71.062 58.09"><path d="M1493.055,7536.837l-29.453-29.045-4.778,4.713,21.289,20.994h-58.118v6.677h58.118l-21.289,20.994,4.778,4.713Z" transform="translate(-1421.994 -7507.792)"/></svg></button>',
      responsive: [
        {
          breakpoint: 1299,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 979,
          settings: {
            slidesToShow: 2,
          }
        }
      ]
    });
    
    $(".comp_product_child_similar_tones_and_grades .grades__carousel_wrapper").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      dots: false,
      autoplaySpeed: 5000,
      pauseOnFocus: false,
      pauseOnHover: false,
      arrows: true,
      speed: 500,
      fade: false,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="71.061" height="58.09" viewBox="0 0 71.061 58.09"><path d="M1421.994,7536.837l29.453-29.045,4.778,4.713-21.289,20.994h58.118v6.677h-58.118l21.289,20.994-4.778,4.713Z" transform="translate(-1421.994 -7507.792)"/></svg></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="71.062" height="58.09" viewBox="0 0 71.062 58.09"><path d="M1493.055,7536.837l-29.453-29.045-4.778,4.713,21.289,20.994h-58.118v6.677h58.118l-21.289,20.994,4.778,4.713Z" transform="translate(-1421.994 -7507.792)"/></svg></button>',
      responsive: [
        {
          breakpoint: 1299,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 979,
          settings: {
            slidesToShow: 2,
          }
        }
      ]
    });
    
    $(document).on('click', '.comp_product_child_similar_tones_and_grades .tabs__nav button', function() {
      
      var me = $(this);
      var dataID = me.data('id');
      me.closest('.tabs__nav').find('button').removeClass('active');
      me.addClass('active');
      
      me.closest('.tabs').find('.tabs__content .tab').removeClass('active');
      me.closest('.tabs').find('.tabs__content .tab.'+dataID).addClass('active');
      
    });
    
  });
  
} (window.jQuery || window.$) );