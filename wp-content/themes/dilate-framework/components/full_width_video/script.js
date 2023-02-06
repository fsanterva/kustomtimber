(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click', '.comp_full_width_video .video__block .play__button', function() {
      var me =$(this);
      var iframe = me.closest('.video__block').find('iframe');
      var vidsrc = iframe.data('src');
      iframe.attr('src', vidsrc);
      me.closest('.video__block').addClass('video__loaded');
    });
    
  });
  
} (window.jQuery || window.$) );