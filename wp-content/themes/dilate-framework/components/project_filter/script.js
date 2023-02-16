(function($) {
  
  $(document).ready(function($) {
    
    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function getFilterValues(page, isAppend) {
      
      var collectionVal = $('.comp_project_filter .project__filter_wrap .filter__box select#collectionSelectFld').val();
      var finishVal = $('.comp_project_filter .project__filter_wrap .filter__box select#finishSelectFld').val();
      var patternVal = $('.comp_project_filter .project__filter_wrap .filter__box select#patternSelectFld').val();
      var keyword = $('.comp_project_filter .project__filter_wrap .filter__box.filter__box--search #searchProjectFld').val();

      loadProjects(page, keyword, collectionVal, finishVal, patternVal, isAppend);
    }
    
    function eventHandlers() {
      
      $(document).on('click', '.comp_project_filter #projectListContainer #loadmore-button', function() {
        
        var page = $(this).data('key');
        getFilterValues(page, true);
        
      });
      
      $(document).on('change', '.comp_project_filter .project__filter_wrap .filter__box select', function() {
        
        $('.comp_project_filter .project__filter_wrap .filter__box input').val('');
        getFilterValues(0, false);
        
      });
      
      $(document).on('click', '.comp_project_filter .project__filter_wrap .filter__box.filter__box--search button', function() {
        
        $('.comp_project_filter .project__filter_wrap .filter__box select#collectionSelectFld option:eq(0)').prop("selected", true);
        $('.comp_project_filter .project__filter_wrap .filter__box select#finishSelectFld option:eq(0)').prop("selected", true);
        $('.comp_project_filter .project__filter_wrap .filter__box select#patternSelectFld option:eq(0)').prop("selected", true);
        
        getFilterValues(0, false);
        
      });
      
      $(document).on('keyup', '.comp_project_filter .project__filter_wrap .filter__box.filter__box--search #searchProjectFld', function(e) {
        if (e.key === 'Enter') {
          $('.comp_project_filter .project__filter_wrap .filter__box.filter__box--search button').trigger('click');
        }
      });
      
    }


    //MAIN PRODUCT AJAX HANDLER
    function loadProjects(page, s, collection, finish, pattern, isAppend) {
      $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'getprojects',
          page: page,
          s: s,
          collection: collection,
          finish: finish,
          pattern: pattern,
        },
        beforeSend: function() {
          $('.ajaxloader').addClass('loading');
        },
        success:function(response) {
          if( isAppend ) {
            console.log('append');
            $('#projectListContainer').find('#loadmore-button').remove();
            $('#projectListContainer').append(response);
          }else{
            console.log('replace');
            $('#projectListContainer').html(response);
          }
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
      $('#projectListContainer').find('img').each(function() {
        var me = $(this);
        var src = me.data('src');
        me.attr('src', src);
      });
    }
    
    var urlVar = getUrlVars();
    if ( urlVar.hasOwnProperty("collection") || urlVar.hasOwnProperty("finish") || urlVar.hasOwnProperty("pattern") ) {
      var collection = ( urlVar.collection ) ? urlVar.collection : '';
      var finish = ( urlVar.finish ) ? urlVar.finish : '';
      var pattern = ( urlVar.pattern ) ? urlVar.pattern : '';
      loadProjects(0, '', collection, finish, pattern, false);
    }else{
      loadProjects(0, '', '', '', '', false);
    }
    eventHandlers();

  });
  
} (window.jQuery || window.$) );