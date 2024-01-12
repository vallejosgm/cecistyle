<?php
  function getGallery() {
    $numPhotos = 47;
    $return = '';
    $return = '<div id="pictures-gallery" class="container-gallery">';
    $return .= '  <ul class="image-gallery">';
    for ($i = 1; $i <= $numPhotos; $i++) { 
      $return .= '    <li class="animated-cover">';
      $return .= '      <img  class="animated" src="../public/images/gallery/cecistyle'.$i.'.jpg" alt=""/>';
      $return .= '    </li>';
    }
    $return .= '   </ul>';
    $return .= '</div>';

    return $return;
  }
?>