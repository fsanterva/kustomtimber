(function($) {
  
    $(document).ready(function($) {
        $('.map-gmap iframe').each(function(){
            var mapDataSRC = $(this).attr('data-src');
            $(this).attr('src',mapDataSRC);
        });

        $('.map-desktop .map-info .info').click(function(){
            var dataTabInfo = jQuery(this).attr('data-tab');
            $('.map-desktop .map-info .info').removeClass('active');
            $('.map-desktop .map-gmap .map').removeClass('active');

            $(this).addClass('active');
            $('.map-desktop .map-gmap .map').each(function(){
                var dataTabMap = $(this).attr('data-tab');

                if(dataTabInfo == dataTabMap){
                    $(this).addClass('active');
                }
            });

        });

        $('.map-mobile .map-info .info').click(function(){
            var dataTabInfo = jQuery(this).attr('data-tab');
            $('.map-mobile .map-info .info').removeClass('active');
            $('.map-mobile .map-gmap .map').removeClass('active');

            $(this).addClass('active');
            $('.map-mobile .map-gmap .map').each(function(){
                var dataTabMap = $(this).attr('data-tab');

                if(dataTabInfo == dataTabMap){
                    $(this).addClass('active');
                }
            });

        });
    });
    
  } (window.jQuery || window.$) );