//Function Lazy Load 
( function() { 'use strict';
  let images = document.querySelectorAll('img[data-src]');
  let pictureSrc = document.querySelectorAll('picture source[data-srcset]');
  // var mobile = window.innerWidth;

  document.addEventListener('DOMContentLoaded', onReady);
  function onReady() {
  // Show above-the-fold images first
  showImagesOnView();

  // scroll listener
  // window.addEventListener( 'scroll', showImagesOnView, false );
  }

  // Show the image if reached on viewport
  function showImagesOnView( e ) {
    
    for( let i of images ) {
      
      if( i.getAttribute('src') ) { continue; } // SKIP if already displayed

      i.setAttribute( 'src', i.dataset.src );
      
      if( i.getAttribute('data-srcset') ) {

        i.setAttribute( 'srcset', i.dataset.srcset );

      }
      
    }
    
    for( let j of pictureSrc ) {
      
      if( j.getAttribute('srcset') ) { continue; } // SKIP if already displayed

      if( j.getAttribute('data-srcset') ) {
          
        j.setAttribute( 'srcset', j.dataset.srcset );

      }
      
    }
    
  }

})();