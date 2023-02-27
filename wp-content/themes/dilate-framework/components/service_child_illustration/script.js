(function($) {
  
  $(document).ready(function($) {
    
    $('.comp_service_child_illustration').each(function() {
      var me = $(this);
      var el = me.find('video');

      var source = el.find('source').data('src');
      el.find('source').attr('src', source);
      el[0].load();
      el[0].play();

    });
    
  });
  
} (window.jQuery || window.$) );