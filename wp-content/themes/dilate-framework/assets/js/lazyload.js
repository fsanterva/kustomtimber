//Function Lazy Load 
( function() { 'use strict';
  let images = document.querySelectorAll('img[data-src]');
  let pictureSrc = document.querySelectorAll('picture source[data-srcset]');
  var mobile = window.innerWidth;

  document.addEventListener('DOMContentLoaded', onReady);
  function onReady() {
  // Show above-the-fold images first
  showImagesOnView();

  // scroll listener
  window.addEventListener( 'scroll', showImagesOnView, false );
  }

  // Show the image if reached on viewport
  function showImagesOnView( e ) {
    
    for( let i of images ) {
      
      if( i.getAttribute('src') ) { continue; } // SKIP if already displayed

      // Compare the position of image and scroll
      let bounding = i.getBoundingClientRect();

      let isOnView = bounding.top >= 0 &&
      bounding.left >= 0 &&
      bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      bounding.right <= (window.innerWidth || document.documentElement.clientWidth);

      if(mobile <= 1024) {
      //if( isOnView ) {
      //setTimeout(function(){
        i.setAttribute( 'src', i.dataset.src );
        if( i.getAttribute('data-srcset') ) {
        i.setAttribute( 'srcset', i.dataset.srcset );
        }
      //},1500);
      //}
      } else {
        
        i.setAttribute( 'src', i.dataset.src );
        if( i.getAttribute('data-srcset') ) {
          i.setAttribute( 'srcset', i.dataset.srcset );
        }
        
      }
      
    }
    
    for( let j of pictureSrc ) {
      
      if( j.getAttribute('srcset') ) { continue; } // SKIP if already displayed

      // Compare the position of image and scroll
//       let bounding = i.getBoundingClientRect();

//       let isOnView = bounding.top >= 0 &&
//       bounding.left >= 0 &&
//       bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
//       bounding.right <= (window.innerWidth || document.documentElement.clientWidth);

      if(mobile <= 1024) {
      //if( isOnView ) {
      //setTimeout(function(){
//         j.setAttribute( 'src', j.dataset.src );
        if( j.getAttribute('data-srcset') ) {
        j.setAttribute( 'srcset', j.dataset.srcset );
        }
      //},1500);
      //}
      } else {
        
//         i.setAttribute( 'src', i.dataset.src );
        if( j.getAttribute('data-srcset') ) {
          j.setAttribute( 'srcset', j.dataset.srcset );
        }
        
      }
      
    }
    
  }

})();