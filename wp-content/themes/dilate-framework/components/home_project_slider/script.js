(function($) {
  
  $(document).ready(function($) {
    
    $(".comp_home_project_slider .projects__slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      autoplaySpeed: 3000,
      pauseOnFocus: true,
      pauseOnHover: false,
      autoplay: true,
      arrows: true,
      speed: 500,
      fade: true,
//       draggable: false,
      swipe: true,
      cssEase: 'cubic-bezier(.55,.43,.31,.99)',
      prevArrow: '<button aria-label="slider previous arrow" class="prev-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="103.994" height="85.011" viewBox="0 0 103.994 85.011"><path d="M1421.994,7550.3l43.1-42.506,6.993,6.9-31.155,30.723h85.052v9.771h-85.052l31.155,30.723-6.993,6.9Z" transform="translate(-1421.994 -7507.792)"/></svg></button>',
      nextArrow: '<button aria-label="slider next arrow" class="next-arrow style2"><svg xmlns="http://www.w3.org/2000/svg" width="267.973" height="214" viewBox="0 0 267.973 214"><path d="M1733.386,7443l-7.553,7.512,94.706,94.177H1573.014v10.625h247.525l-94.706,94.177,7.553,7.511,107.6-107Z" transform="translate(-1573.014 -7443.003)"/></svg></button>',
      customPaging: function (slider, i) {
        var cnt = (slider.slideCount < 10) ? '0' + (i + 1) : (i + 1);
        var total = (slider.slideCount < 10) ? '0' + slider.slideCount : slider.slideCount;
        return '<span class="cnt">' + cnt + '</span>/<span class="total">' + total + '</span>';
      },
      appendArrows: $('.comp_home_project_slider .row--projects .slick__navs .arrows__wrap'),
      appendDots: $('.comp_home_project_slider .row--projects .slick__navs .dots__wrap'),
    });
    
  });
  
} (window.jQuery || window.$) );