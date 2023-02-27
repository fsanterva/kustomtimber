(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click', '.comp_product_child_gallery .site__button.enquireNowBtn', function(e) {
      e.preventDefault();
      var me = $(this);
      if( $('.comp_product_child_enquire_form').length ) {
        $('html, body').animate({
          scrollTop: $('.comp_product_child_enquire_form').offset().top
        }, 1000);
      }
    });
    
    $(".comp_product_child_gallery .carousel__wrap").slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      dots: false,
      autoplaySpeed: 5000,
      pauseOnFocus: true,
      pauseOnHover: false,
      autoplay: true,
      arrows: true,
      speed: 500,
      fade: false,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style1"><svg xmlns="http://www.w3.org/2000/svg" width="83.747" height="19.297" viewBox="0 0 83.747 19.297"><path d="M779.367,314.685l.681.676-8.54,8.493h81.906v.958H771.508l8.54,8.492-.681.678-9.7-9.649Z" transform="translate(-769.667 -314.685)" fill="#333230"/></svg><span class="text">PREVIOUS</span></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style1"><span class="text">NEXT</span><svg xmlns="http://www.w3.org/2000/svg" width="83.747" height="19.297" viewBox="0 0 83.747 19.297"><path d="M843.714,314.685l-.681.676,8.54,8.493H769.667v.958h81.906l-8.54,8.492.681.678,9.7-9.649Z" transform="translate(-769.667 -314.685)" fill="#333230"/></svg></button>',
      responsive: [
        {
          breakpoint: 979,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
    
  });
  
} (window.jQuery || window.$) );