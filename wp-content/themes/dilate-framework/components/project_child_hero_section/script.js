(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click',  '.comp_project_child_hero_section .row--data .data__block.data__block--description .readmore', function() {
      var me = $(this);
      var container = me.closest('p');
      container.toggleClass('show__full');
      
      if( container.hasClass('show__full') ) {
        me.text('Read less');
      }else{
        me.text('Read more');
      }
    });
    
  });
  
} (window.jQuery || window.$) );