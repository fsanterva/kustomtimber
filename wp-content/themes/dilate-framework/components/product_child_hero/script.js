(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click', '.comp_product_child_hero .top__info .desc__block .readmore', function() {
      var me = $(this);
      me.closest('p').toggleClass('open');
      if( me.closest('p').hasClass('open') ) {
        me.find('.text').text('Read less');
      }else{
        me.find('.text').text('Read more');
      }
    });
    
    $(document).on('click', '.comp_product_child_hero .site__button.enquireNowBtn', function(e) {
      e.preventDefault();
      var me = $(this);
      if( $('.comp_product_child_enquire_form').length ) {
        $('html, body').animate({
          scrollTop: $('.comp_product_child_enquire_form').offset().top
        }, 1000);
      }
    });
    
  });
  
} (window.jQuery || window.$) );