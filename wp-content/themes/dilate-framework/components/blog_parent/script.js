(function($) {
  
  $(document).ready(function($) {
    
    function loadBlogs(page, s, cat) {
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'getBlogs',
          s: s,
          cat: cat,
          page: page
        },
        beforeSend: function() {
          $('.ajaxloader').addClass('loading');
        },
        success:function(response) {
          $('#blog_main__results').empty().append(response);
          imgSwap();
        },
        complete: function() {
          $('.ajaxloader').removeClass('loading');
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
    
    function imgSwap() {
      $('#blog_main__results').find('img').each(function() {
        var me = $(this);
        var src = me.data('src');
        me.attr('src', src);
      });
    }
    
    function blogHandlers() {
      $(document).on('click', '.comp_blog_parent .filter__block li a', function() {
        var me = $(this);
        var cat = me.data('val');
        var catText = me.text();
        var searchKey = ( $('.comp_blog_parent .searchField').length ) ? $('.comp_blog_parent .searchField').val() : '';
        loadBlogs(0, searchKey, cat);
        // console.log(0, searchKey, displayNum, cat);
        console.log(0, searchKey, cat);
        
        $('.comp_blog_parent .filter__block li').removeClass('active');
        me.closest('li').addClass('active');
        me.closest('.filter__block').removeClass('floatlist__on');
        me.closest('.filter__block').find('.mobileFilterToggleBtn .text').text(catText);
      });
      
      $(document).on('click', '.comp_blog_parent .searchFieldWrap button.searchButton', function() {
        var me = $(this);
        var searchKey = me.closest('.searchFieldWrap').find('.searchField').val();
        var cat = $('.comp_blog_parent .filter__block li.active a').data('val');
        loadBlogs(0, searchKey, cat);
        // console.log(0, searchKey, displayNum, cat);
        console.log(0, searchKey, cat);
      });
      $(document).on('keypress', '.comp_blog_parent .searchFieldWrap .searchField', function(e) {
        var me = $(this);
        var btn = me.closest('.searchFieldWrap').find('button.searchButton');
        if (e.keyCode == 13) {
          btn.trigger('click');
        }
      });
      
      $(document).on('click', '.comp_blog_parent .pagination .page', function() {
        var me = $(this);
        var page = me.data("page");
        var searchKey = ( $('.comp_blog_parent .searchField').length ) ? $('.comp_blog_parent .searchField').val() : '';
        var cat = $('.comp_blog_parent .filter__block li.active a').data('val');
        loadBlogs(page, searchKey, cat);
      });
      
      $(document).on('click', '.comp_blog_parent .filter__block .mobileFilterToggleBtn', function() {
        var me = $(this);
        me.closest('.filter__block').addClass('floatlist__on');
      });
    }
    
    if( $('.comp_blog_parent #blog_main__results').length ) {
      var searchKey = ( $('.comp_blog_parent .searchField').length ) ? $('.comp_blog_parent .searchField').val() : '';
      var cat = ( $('.comp_blog_parent .filter__block').length ) ? $('.comp_blog_parent .filter__block li.active a').data('val') : '';
      loadBlogs(0, searchKey, cat);
      blogHandlers();
    }
    
  });
  
} (window.jQuery || window.$) );
