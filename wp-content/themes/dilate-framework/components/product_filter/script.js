(function($) {
  
  $(document).ready(function($) {

    //FLOATING FILTER ON SCROLL
    function floatingFilterHanlder() {
      var baseWidth = 1920;
      var windowWidth = $(window).width();
      var scaleValue = windowWidth/baseWidth;

      if( windowWidth <= baseWidth ) {

        $(window).scroll(function() {
          var scrolltop = $(window).scrollTop();
          var elem = $('.comp_product_filter');
          var filterWrapHeight = elem.find('.product__filter_wrap.row--filter__wrapper').outerHeight();
          
          if( scrolltop > elem.offset().top - 60 ) {
            $('.product__filter_wrap.row--filter__wrapper').addClass('fixed');
            elem.find('.row--productlist').css({
              'margin-top':filterWrapHeight+'px'
            });
          }else{
            $('.product__filter_wrap.row--filter__wrapper').removeClass('fixed');
            elem.find('.row--productlist').css({
              'margin-top':'0px'
            });
          }

        });

      }

    }
    
    //HIDE FILTER BUTTON HANDLER
    $(document).on('click', '.product__filter_wrap.row--filter__wrapper .primary__filter .hide__filters', function() {
      
      var me = $(this);
      var container = me.closest('.row--filter__wrapper');
      
      container.toggleClass('hideFilter');
      
      if( container.hasClass('hideFilter') ) {
        me.find('.text').text('Show Filters');
        me.closest('.primary__filter').find('.nav__wrap').removeClass('showOptions');
      }else{
        me.find('.text').text('Hide Filters');
      }
      
    });

    //COLOR BUTTONS HANDLER
    $(document).on('change', '.product__filter_wrap.row--filter__wrapper .filter__box .data__options input[type="radio"]', function() {
      
      var me = $(this);
      var value = me.val();
      var id = me.data('id');
      var name = me.data('name');

      me.closest('.filter__box').find('.data__result > span').text(name);

      getFilterValues();
      
    });

    //SEARCHBOX HANDLER
    $(document).on('input', '.product__filter_wrap.row--filter__wrapper .filter__box #searchProductName', function() {
      
      var me = $(this);
      var value = me.val().toLowerCase();

      if (!value.trim()) {
        
        $('.comp_product_filter #productListContainer .item').show();

      }else{

        $('.comp_product_filter #productListContainer .item').hide();

        $('.comp_product_filter #productListContainer .item').each( function( index, el ) {
          var me = $(this);
          var nameText = me.find('.product__name').text().toLowerCase();

          if( nameText.indexOf(value) >= 0 ) {
            
            me.show();

          }
        });

      }
      
    });

    //SELECT BOX HANDLER
    $(document).on('change', '.product__filter_wrap.row--filter__wrapper .filter__box.filter__box--select select', function() {
      
      getFilterValues();
      
    });


    function getFilterValues() {
      var rangeVal = $('.product__filter_wrap.row--filter__wrapper .primary__filter .range__nav li.active a').data('slug');
      var colourVal;
      if( !$('.filter__box .data__options input[type="radio"][name="colourOption"]:checked').val() ) {
        colourVal = "";
      }else{
        colourVal = $('.filter__box .data__options input[type="radio"][name="colourOption"]:checked').val();
      }
      var gradeVal;
      if( !$('.filter__box .data__options input[type="radio"][name="gradeOption"]:checked').val() ) {
        gradeVal = "";
      }else{
        gradeVal = $('.filter__box .data__options input[type="radio"][name="gradeOption"]:checked').val();
      }
      var widthVal = $('.product__filter_wrap .filter__box.filter__box--select select#widthSelectFld').val();
      var lengthVal = $('.product__filter_wrap .filter__box.filter__box--select select#lengthSelectFld').val();
      var thickVal = $('.product__filter_wrap .filter__box.filter__box--select select#thicknessSelectFld').val();


      loadProducts(rangeVal, colourVal, gradeVal, widthVal, lengthVal, thickVal);
    }


    //MAIN PRODUCT AJAX HANDLER
    function loadProducts(range, colour, grade, width, length, thickness) {
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'getproducts',
          range: range,
          colour: colour,
          grade: grade,
          width: width,
          length: length,
          thickness: thickness
        },
        beforeSend: function() {
          $('.ajaxloader').addClass('loading');
        },
        success:function(response) {
          $('#productListContainer').empty().append(response);
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
    

    //IMG DATA SRC SWITCHER AFTER AJAX CALL
    function imgSwap() {
      $('#productListContainer').find('img').each(function() {
        var me = $(this);
        var src = me.data('src');
        me.attr('src', src);
      });
    }

    function resetFilters() {
      $('.product__filter_wrap.row--filter__wrapper .filter__box input#searchProductName').val('');
      $('.product__filter_wrap.row--filter__wrapper .filter__box .data__options input').prop('checked', false);
      $('.product__filter_wrap.row--filter__wrapper .filter__box .data__result > span').text('-select-')
      $('.product__filter_wrap.row--filter__wrapper .filter__box select#widthSelectFld option:eq(0)').prop("selected", true);
      $('.product__filter_wrap.row--filter__wrapper .filter__box select#lengthSelectFld option:eq(0)').prop("selected", true);
      $('.product__filter_wrap.row--filter__wrapper .filter__box select#thicknessSelectFld option:eq(0)').prop("selected", true);
    }

    //RANGE FILTER HANDLER
    $(document).on('click', '.product__filter_wrap.row--filter__wrapper .primary__filter .range__nav a', function() {
      var me = $(this);
      var range = me.data('slug');
      var name = me.text();
      var nav = me.closest('.range__nav');
      nav.find('li').removeClass('active');
      me.closest('li').addClass('active');
      me.closest('.nav__wrap').find('.mobile__toggle').text(name);
      me.closest('.nav__wrap').removeClass('showOptions');

      loadProducts(range, '', '', '', '', '');
      resetFilters();
    });
    $(document).on('click', function(event) {
      if (!$(event.target).closest('.nav__wrap').length)  {
        $(".product__filter_wrap .primary__filter .nav__wrap").removeClass("showOptions");
      }
    });
    
    //RANGE FILTER MOBILE TOGGLE HANDLER
    $(document).on('click', '.product__filter_wrap .primary__filter .nav__wrap .mobile__toggle', function() {
      var me = $(this);
      me.closest('.nav__wrap').addClass('showOptions');
    });

    loadProducts('', '', '', '', '', '');
    floatingFilterHanlder();

  });
  
} (window.jQuery || window.$) );