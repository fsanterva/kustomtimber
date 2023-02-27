(function($) {
  
  $(document).ready(function($) {
    
    $(document).on('click', '.comp_faq_section .row--faqs .faq__item .title', function(e) {
      e.preventDefault();
      var me = $(this);
      me.closest('.faq__item').toggleClass('open');
    });
    
  });
  
} (window.jQuery || window.$) );