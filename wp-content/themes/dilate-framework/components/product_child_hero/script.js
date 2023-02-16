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
    
  });
  
} (window.jQuery || window.$) );