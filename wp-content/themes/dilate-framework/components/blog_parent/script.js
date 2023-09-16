(function($) {
  
  $(document).ready(function($) {
    
    function smoothScroll(div) {
      $('html, body').animate({
          scrollTop: div.offset().top - 120
      }, 500);
    }
    
    // function getBlogs(pagenum, s, cat, orderby, order) {
    function getBlogs(s, cat, range, orderby, order, p) {
      console.log(s);
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'getPosts',
          s: s,
          cat: cat,
          range: range,
          orderby: orderby,
          order: order,
          p: p
        },
        beforeSend: function() {
          $(".blog__list_container").addClass("loading");
        },
        success:function(response) {
          $(".blog__list_container").empty().html(response);
          imgSwap();
        },
        complete: function() {
          $(".blog__list_container").removeClass("loading");

          var paged = 1;
          var last_paged = $('.articles__wrapper').attr('data-last-page');

          console.log('paged '+ paged);
          console.log('last_paged '+ last_paged);

          if(last_paged == paged){
            $("#loadmore").attr('disabled', true);  
          } else {
            $("#loadmore").attr('disabled', false);  
          }

        },
        error: function(e) {
          console.log(e);
        }
      });
    }


     // function getBlogs(pagenum, s, cat, orderby, order) {
      function getNextBlogs(s, cat, range, orderby, order, p) {
        console.log(s);
        $.ajax({
          type: 'POST',
          url: '/wp-admin/admin-ajax.php',
          data: {
            action: 'getPosts',
            s: s,
            cat: cat,
            range: range,
            orderby: orderby,
            order: order,
            p: p
          },
          beforeSend: function(response) {
            var paged = $("#loadmore").attr('data-page');
            var last_paged = $('.articles__wrapper').attr('data-last-page');

            paged = parseInt(paged) + 1;

            //console.log('page' + paged);
            //console.log('last page' + last_paged);

            if(last_paged >= paged){
              $(".blog__list_container").addClass("loading");
              $("#loadmore").attr("data-page", paged);
              $("#loadmore").text("Loading...");  
            } else {
              $("#loadmore").text("Loading...");  
              $("#loadmore").attr('disabled', true);  
            }
            
          },
          success:function(response) {
            $(".blog__list_container").append(response);
            imgSwap();
          },
          complete: function() {
            $(".blog__list_container").removeClass("loading");
            $("#loadmore").text("Load More");
          },
          error: function(e) {
            //console.log(e);
          }
        });
      }

      function imgSwap() {
        $('.blog__list_container').find('picture').each(function() {
          var me = $(this);
          me.find('source').each(function() {
            var that = $(this);
            if( !that.attr('srcset') ) {
              var srcset = that.data('srcset');
              that.attr('srcset', srcset);
            }

          });
        });
      }
    
    function getBlogHandler() {
      $(document).on('click', '.filter__field--search button.searchBtn', function() {
        var me = $(this);
        var s = me.closest('.tail').find('#blogFilterSearchField').val();
        var cat = me.closest('.filter__block').find('#blogFilterCategoryField').val();
        var range = me.closest('.filter__block').find('#blogFilterCategoryFieldRange').val();
        var orderby = me.closest('.filter__block').find('#blogFilterSortField').val();
        var order = me.closest('.filter__block').find('#blogFilterSortField').find(':selected').data('order');

        smoothScroll( $(".blog__list_container") );
        getBlogs(s, cat, range, orderby, order, 1);
      });
      
      $(document).on('keypress', '#blogFilterSearchField', function(e) {
        var me = $(this);
        var btn = me.closest('.tail').find('button.searchBtn');
        if (e.keyCode == 13) {
          smoothScroll( $(".blog__list_container") );
          btn.trigger('click');
        }
      });

      
      $(document).on('change', '#blogFilterCategoryField', function(e) {
          var me = $(this);
          var s = me.closest('.tail').find('#blogFilterSearchField').val();
          var cat = me.closest('.filter__block').find('#blogFilterCategoryField').val();
          var range = me.closest('.filter__block').find('#blogFilterCategoryFieldRange').val();
          var orderby = me.closest('.filter__block').find('#blogFilterSortField').val();
          var order = me.closest('.filter__block').find('#blogFilterSortField').find(':selected').data('order');

          smoothScroll( $(".blog__list_container") );
          getBlogs(s, cat, range, orderby, order, 1);
      });

      $(document).on('change', '#blogFilterCategoryFieldRange', function(e) {
        var me = $(this);
        var s = me.closest('.tail').find('#blogFilterSearchField').val();
        var cat = me.closest('.filter__block').find('#blogFilterCategoryField').val();
        var range = me.closest('.filter__block').find('#blogFilterCategoryFieldRange').val();
        var orderby = me.closest('.filter__block').find('#blogFilterSortField').val();
        var order = me.closest('.filter__block').find('#blogFilterSortField').find(':selected').data('order');

        smoothScroll( $(".blog__list_container") );
        getBlogs(s, cat, range, orderby, order, 1);
      });


      $(document).on('click', '#loadmore', function() {
        var me = $(this);
        var s = $('#blogFilterSearchField').val();
        var cat = $('.filter__block').find('#blogFilterCategoryField').val();
        var range = $('.filter__block').find('#blogFilterCategoryFieldRange').val();
        var orderby = $('.filter__block').find('#blogFilterSortField').val();
        var order = $('.filter__block').find('#blogFilterSortField').find(':selected').data('order');
        var p = me.attr('data-page')

        //smoothScroll( $(".blog__list_container") );        
        getNextBlogs(s, cat, range, orderby, order, p);
      });

    }
    
    if( $(".blog__list_container").length ) {
      getBlogs('', '', '', 'date', 'DESC', 1);
      getBlogHandler();
    }
    
  });
  
} (window.jQuery || window.$) );
