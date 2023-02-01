<?php
/*
@params
button object
*/
function button($btnObj) {
  ob_start();
  
  $btnStyle = ( !empty($btnObj['button_style']) ) ? $btnObj['button_style'] : 'outlinedark';
  $btnArrow = ( !empty($btnObj['button_arrow']) ) ? $btnObj['button_arrow'] : 0;
  $btnLink = $btnObj['button_link'];
  $btnTitle = ( !empty($btnLink['title']) ) ? $btnLink['title'] : 'Edit this Text';
  $btnURL = ( !empty($btnLink['url']) ) ? $btnLink['url'] : '#';
  $btnTarget = ( !empty($btnLink['target']) ) ? $btnLink['target'] : '';
  $btnClass = $btnObj['button_custom_class'];
  $btnFunction = $btnObj['button_function'];
  
  $btnStyleVal;
  switch($btnStyle) {
    case 'outlinedark':
      $btnStyleVal = 'site__button_style--outlinedark';
      break;
    case 'outlinelight':
      $btnStyleVal = 'site__button_style--outlinelight';
      break;
    case 'solidlight':
      $btnStyleVal = 'site__button_style--solidlight';
      break;
    case 'soliddark':
      $btnStyleVal = 'site__button_style--soliddark';
      break;
    default:
      $btnStyleVal = 'site__button_style--outlinedark';
  }
  
?>
  <a class="site__button <?= $btnStyleVal; ?> <?= ($btnArrow) ? 'site__button--arrow' : ''; ?> <?= ( !empty($btnClass) ) ? $btnClass : ''; ?> <?= ($btnFunction == 'quote') ? 'quoteBtn' : '' ?>" href="<?= $btnURL; ?>" target="<?= $btnTarget; ?>">
    <span class="text"><?= $btnTitle; ?></span>
    <?php if( $btnArrow ) : ?>
    <span class="icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="10.106" height="10.095" viewBox="0 0 10.106 10.095"><path d="M1532.171,5041.9h-9.328a.388.388,0,1,0,0,.776h8.39l-8.664,8.655a.389.389,0,0,0,.55.549l8.665-8.656v8.382a.389.389,0,0,0,.777,0v-9.319A.388.388,0,0,0,1532.171,5041.9Z" transform="translate(-1522.454 -5041.904)"/></svg>
    </span>
    <?php endif; ?>
  </a>

  <?php echo ob_get_clean();
}

/*
@params
string - Headline Text
string - Headline Tag
*/
function headlineText($headline, $tag) {

  ob_start();

  if( !empty($headline) ) {
    
    $strippedMainText = str_replace('{', '<span>', $headline);
    $finalMainText = str_replace('}', '</span>', $strippedMainText);
    
    if( $tag == 'default' ) : ?>
    <span class="headline__text"><?= $finalMainText; ?></span>
    <?php else : ?>
    <<?= $tag; ?> class="headline__text <?=$tag?>"><?= $finalMainText; ?></<?= $tag; ?>>
    <?php endif;
    
  }

  echo ob_get_clean();
  
}

function renderScrolldownIcon() {

  ob_start(); ?>

  <button class="scrolldownIcon">
    <span class="icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="62.289" height="78" viewBox="0 0 62.289 78">
        <path d="M1619.694,7443l-2.2,2.188,27.566,27.411h-72.048v3.092h72.048l-27.566,27.414,2.2,2.185,31.32-31.144Z" transform="translate(7505.292 -1573.014) rotate(90)"/>
      </svg>
    </span>
    <span class="text">SCROLL</span>
  </button>

  <?php echo ob_get_clean();

}

function renderKustomTimberIcon($color) {
  
  $rand = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);
  
  ob_start(); ?>

  <span id="<?= $rand; ?>" class="kustom__icon_wrap <?=($color) ? 'white' : 'grey'?>"></span>

  <?php echo ob_get_clean();

}

function getFeaturedImage( $post_id ) {
  
  $imgURL = get_the_post_thumbnail_url($post_id);
  $imgID = get_post_thumbnail_id($post_id);
  $imgAlt = get_post_meta( $imgID, '_wp_attachment_image_alt', true );
  
  if( !$imgURL ) {
    return '';
  }
  return array('url'=>$imgURL, 'alt'=>$imgAlt);
  
}

/*
@params
int - post ID
*/
function shareSocial($pid) {
  $email = get_field('email','option');
  $title = get_the_title($pid);
  $perm = get_the_permalink($pid);
  $excerpt = get_the_excerpt($pid);
  $featImg = get_the_post_thumbnail_url($pid);
  ob_start();
  ?>
  <div class="shareBtns">
    <label class="small__text">Share article</label>
<!--     <div class="shareSocialWrap"> -->
<!--       <a class="shareSocial control"><svg xmlns="http://www.w3.org/2000/svg" width="20.62" height="22.768" viewBox="0 0 20.62 22.768"><path d="M21.674,19.226a3.13,3.13,0,0,0-2.24.858L11.22,15.336a3.847,3.847,0,0,0,.115-.8,3.845,3.845,0,0,0-.115-.8l8.1-4.691a3.437,3.437,0,1,0-1.092-2.517,3.824,3.824,0,0,0,.115.8l-8.1,4.691A3.457,3.457,0,0,0,7.889,11.1,3.4,3.4,0,0,0,4.5,14.535a3.458,3.458,0,0,0,5.8,2.517L18.457,21.8a2.87,2.87,0,0,0-.115.744,3.331,3.331,0,1,0,3.331-3.318Z" transform="translate(-4.5 -3.094)"/></svg></a> -->
      <ul class="pop_share">
        <li>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $perm; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="10.864" height="20.285" viewBox="0 0 10.864 20.285"><path d="M11.762,11.41l.563-3.671H8.8V5.357a1.836,1.836,0,0,1,2.07-1.983h1.6V.248A19.528,19.528,0,0,0,9.631,0c-2.9,0-4.8,1.758-4.8,4.941v2.8H1.609V11.41H4.834v8.875H8.8V11.41Z" transform="translate(-1.609)"/></svg>
          </a>
        </li>
        <li>
          <a href="http://twitter.com/share?text=<?= $title; ?>&url=<?= $perm; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="22.176" height="18.021" viewBox="0 0 22.176 18.021"><path d="M24.746,6.951a9.1,9.1,0,0,1-2.613.716,4.563,4.563,0,0,0,2-2.517,9.108,9.108,0,0,1-2.889,1.1,4.554,4.554,0,0,0-7.753,4.15A12.916,12.916,0,0,1,4.115,5.65a4.554,4.554,0,0,0,1.408,6.074,4.531,4.531,0,0,1-2.061-.569c0,.019,0,.038,0,.057a4.552,4.552,0,0,0,3.649,4.461,4.557,4.557,0,0,1-2.055.078,4.554,4.554,0,0,0,4.25,3.159,9.128,9.128,0,0,1-5.65,1.948,9.227,9.227,0,0,1-1.085-.064,12.877,12.877,0,0,0,6.974,2.044A12.856,12.856,0,0,0,22.489,9.894q0-.3-.013-.589a9.242,9.242,0,0,0,2.27-2.355Z" transform="translate(-2.571 -4.817)" fill="#3a4bd9"/></svg>
          </a>
        </li>
        <li>
          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $perm; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="15.56" height="13.94" viewBox="0 0 15.56 13.94"><path d="M1533.98,7253.66a1.493,1.493,0,0,0-.55,1.15,1.555,1.555,0,0,0,.56,1.2,1.953,1.953,0,0,0,1.34.5,1.917,1.917,0,0,0,1.31-.49,1.486,1.486,0,0,0,.55-1.17,1.506,1.506,0,0,0-.55-1.18,1.937,1.937,0,0,0-1.33-.49A1.959,1.959,0,0,0,1533.98,7253.66Zm-0.15,13.47h2.95v-9.74h-2.95v9.74Zm4.75,0h2.95v-3.62a9.818,9.818,0,0,1,.13-2.07,2.645,2.645,0,0,1,.88-1.44,2.36,2.36,0,0,1,1.54-.53,2.031,2.031,0,0,1,1.16.32,1.621,1.621,0,0,1,.65.91,9.739,9.739,0,0,1,.19,2.44v3.99H1549v-6.27a3.345,3.345,0,0,0-1.03-2.67,4.336,4.336,0,0,0-2.96-1.06,5.048,5.048,0,0,0-1.67.28,7.332,7.332,0,0,0-1.81,1.03v-1.05h-2.95v9.74Z" transform="translate(-1533.44 -7253.19)"></path></svg>
          </a>
        </li>
        <li>
          <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?= $perm; ?>&is_video=false&description=<?= $excerpt; ?>&media=<?= $featImg; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg>
          </a>
        </li>
      </ul>
<!--     </div> -->
<!--     <a class="control" href="mailto:<?=$email?>?subject=Check%20out%20this%20post%20from%20<?php bloginfo('name'); ?>&body=<?php $title; ?> - <?php $perm; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="20.518" height="20.525" viewBox="0 0 20.518 20.525"><path d="M19.078.127.5,10.845a.963.963,0,0,0,.088,1.731l4.26,1.788L16.365,4.215a.24.24,0,0,1,.345.333L7.054,16.311v3.226a.962.962,0,0,0,1.7.633l2.545-3.1L16.3,19.165a.965.965,0,0,0,1.323-.729L20.5,1.121A.962.962,0,0,0,19.078.127Z" transform="translate(-0.001 0.002)"/></svg>
    </a> -->
  </div>
  <?php  echo ob_get_clean();
}
?>