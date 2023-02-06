(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click', '.comp_room_visualization_section .column__right .changeFloorBtn', function() {
      var me = $(this);
      var container = $(this).closest('.column__right');
      container.toggleClass('toggled');
      if( container.hasClass('toggled') ) {
        me.text('SHOW ORIGINAL');
      }else{
        me.text('CHANGE FLOOR');
      }
    });
    
  });
  
} (window.jQuery || window.$) );