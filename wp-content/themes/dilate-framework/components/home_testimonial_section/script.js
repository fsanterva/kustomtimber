(function($) {
  
  $(document).ready(function($) {
    
    $(".comp_home_testimonial_section .videoreview__slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: false,
      autoplaySpeed: 5000,
      pauseOnFocus: true,
      pauseOnHover: false,
      autoplay: false,
      arrows: true,
      speed: 500,
      fade: true,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="45.632" height="36.44" viewBox="0 0 45.632 36.44"><path d="M1591.337,7443l1.286,1.279-16.127,16.037h42.15v1.809H1576.5l16.127,16.037-1.286,1.278-18.323-18.22Z" transform="translate(-1573.014 -7443.003)"/></svg></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="45.632" height="36.44" viewBox="0 0 45.632 36.44"><path d="M1600.323,7443l-1.286,1.279,16.127,16.037h-42.15v1.809h42.15l-16.127,16.037,1.286,1.278,18.323-18.22Z" transform="translate(-1573.014 -7443.003)"/></svg></button>',
    });
    
    $(".comp_home_testimonial_section .normalreview__slider").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      dots: false,
      autoplaySpeed: 5000,
      pauseOnFocus: true,
      pauseOnHover: false,
      autoplay: true,
      arrows: false,
      speed: 500,
      fade: false,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="45.632" height="36.44" viewBox="0 0 45.632 36.44"><path d="M1591.337,7443l1.286,1.279-16.127,16.037h42.15v1.809H1576.5l16.127,16.037-1.286,1.278-18.323-18.22Z" transform="translate(-1573.014 -7443.003)"/></svg></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="45.632" height="36.44" viewBox="0 0 45.632 36.44"><path d="M1600.323,7443l-1.286,1.279,16.127,16.037h-42.15v1.809h42.15l-16.127,16.037,1.286,1.278,18.323-18.22Z" transform="translate(-1573.014 -7443.003)"/></svg></button>',
      responsive: [
        {
          breakpoint: 979,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
    
    $(document).on('click', '.comp_home_testimonial_section .videoreview__slider .video__block .play__button', function() {
      var me =$(this);
      var iframe = me.closest('.video__block').find('iframe');
      var vidsrc = iframe.data('src');
      iframe.attr('src', vidsrc);
      me.closest('.video__block').addClass('video__loaded');
    });
    
  });
  
} (window.jQuery || window.$) );