(function() {
  var getUrl = window.location;
  var giftofspeed = document.createElement('link');
  giftofspeed.rel = 'stylesheet';
  giftofspeed.href = script_vars.path + '/css/fonts.css';
  giftofspeed.type = 'text/css';
  giftofspeed.media = 'all';
  setTimeout(function() {
    var godefer = document.getElementsByTagName('link')[0];
    godefer.parentNode.insertBefore(giftofspeed, null);
  },1000);
}());