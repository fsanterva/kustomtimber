(function($) {
  
  $(document).ready(function($) {
    
    function smoothScroll(div) {
      $('html, body').animate({
          scrollTop: div.offset().top - 120
      }, 500);
    }
    
    function getBlogs(pagenum, s, cat, orderby, order) {
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'get_blogs',
          s: s,
          page: pagenum,
          cat: cat,
          orderby: orderby,
          order: order
        },
        beforeSend: function() {
          $(".blog__list_container").addClass("loading");
        },
        success:function(response) {
          $(".blog__list_container").empty().html(response);
        },
        complete: function() {
          $(".blog__list_container").removeClass("loading");
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
    
    function getBlogHandler() {
      $(document).on('click', '.comp_blog_list .filter__block .left .filter__field--search button.searchBtn', function() {
        var me = $(this);
        var s = me.closest('.field__wrap').find('#blogFilterSearchField').val();
        var cat = me.closest('.filter__block').find('#blogFilterCategoryField').val();
        var orderby = me.closest('.filter__block').find('#blogFilterSortField').val();
        var order = me.closest('.filter__block').find('#blogFilterSortField').find(':selected').data('order');
        smoothScroll( $(".blog__list_container") );
        getBlogs(0, s, cat, orderby, order);
      });
      $(document).on('keypress', '.comp_blog_list .filter__block #blogFilterSearchField', function(e) {
        var me = $(this);
        var btn = me.closest('.field__wrap').find('button.searchBtn');
        if (e.keyCode == 13) {
          smoothScroll( $(".blog__list_container") );
          btn.trigger('click');
        }
      });
      // $(document).on('click', '.comp_blog_list .pagination .pages li .page, .comp_blog_list .pagination .button__group .arrow', function() {
      //   var me = $(this);
      //   var page = me.data("page");
      //   var s = me.closest('.comp_blog_list').find('#blogFilterSearchField').val();
      //   var cat = me.closest('.comp_blog_list').find('#blogFilterCategoryField').val();
      //   var orderby = me.closest('.comp_blog_list').find('#blogFilterSortField').val();
      //   var order = me.closest('.comp_blog_list').find('#blogFilterSortField').find(':selected').data('order');
      //   smoothScroll( $(".blog__list_container") );
      //   getBlogs(page, s, cat, orderby, order);
      // });
      // $(document).on('change', '.comp_blog_list .filter__block #blogFilterCategoryField', function() {
      //   var me = $(this);
      //   var page = me.data("page");
      //   var s = me.closest('.comp_blog_list').find('#blogFilterSearchField').val();
      //   var cat = me.val();
      //   var orderby = me.closest('.comp_blog_list').find('#blogFilterSortField').val();
      //   var order = me.closest('.comp_blog_list').find('#blogFilterSortField').find(':selected').data('order');
      //   smoothScroll( $(".blog__list_container") );
      //   getBlogs(0, s, cat, orderby, order);
      // });
      // $(document).on('change', '.comp_blog_list .filter__block #blogFilterSortField', function() {
      //   var me = $(this);
      //   var page = me.data("page");
      //   var s = me.closest('.comp_blog_list').find('#blogFilterSearchField').val();
      //   var cat = me.closest('.comp_blog_list').find('#blogFilterCategoryField').val();
      //   var orderby = me.val();
      //   var order = me.find(':selected').data('order');
      //   smoothScroll( $(".blog__list_container") );
      //   getBlogs(page, s, cat, orderby, order);
      // });
    }
    
    if( $(".blog__list_container").length ) {
      getBlogs(0, '', '', 'date', 'DESC');
      getBlogHandler();
    }
    
  });
  
} (window.jQuery || window.$) );
