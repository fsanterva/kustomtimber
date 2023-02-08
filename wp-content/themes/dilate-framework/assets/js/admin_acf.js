(function($) {
	
  $(document).on('mouseover', '.acf-fc-popup ul li', function() {
    var dataname = $(this).find('a').data('layout');
    var img = '/wp-content/themes/dilate-framework/components/'+dataname+'/placeholder.jpg';
    var preview = $('<div class="preview"><span class="img_wrap"><img src="'+img+'"/></span></div>');
    $(this).closest('.acf-fc-popup').find('.preview').remove();
    $(this).closest('.acf-fc-popup').append(preview);
  });
  
  $(document).on('mouseover', '.acf-fc-popup', function() {
    var me = $(this);
    me.find('ul li').each(function() {
      var dataname = $(this).find('a').data('layout');
      var img = '/wp-content/themes/dilate-framework/components/'+dataname+'/placeholder.jpg';
      var toAdd = $('<span class="img_wrap"><img src="'+img+'"/></span>');
      $(this).find('a .text').contents().unwrap();
      $(this).find('a').wrapInner('<span class="text">');
      $(this).find('a .img_wrap').remove();
      $(this).find('a').append(toAdd);
    });
  });
  $(document).on('mouseover', '.acf-fc-popup ul', function(e) {
    e.stopPropagation();
    e.stopImmediatePropagation();
  });
  
  $(document).on('mouseout', '.acf-fc-popup', function() {
    $(this).find('.preview').remove();
  });
  
  $(document).on('click', '#acf_site_delete_cache_btn', function() {
    $.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      data: {
        action: 'deleteAllCache',
      },
      beforeSend: function() {
        console.log('before send...');
      },
      success:function(response) {
        console.log(response);
      },
      complete: function() {
        console.log('Done clearing cache!');
      },
      error: function(e) {
        console.log(e);
      }
    });
  });
  
} (window.jQuery || window.$) );