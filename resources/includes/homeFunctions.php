<?php
  function getLogo() {
    $links = '';
    $links .= ' <div class="logo">';
    $links .= '   <img src=' . asset( '/public/images/logo.png' ) . '>';
    $links .= ' </div>';

    return $links;
  }

  function getNav() {

    $links = '';
    $links .= ' <ul id="h-content-item">';
    $links .= '   <li><a href=' . asset('/') . '>Home</a></li>';
    $links .= '   <li><a href=' . asset('/#photos-gallery') . '>Gallery</a></li>';
    $links .= '   <li><a href=' . asset('/#reviews-gallery') . '>Reviews</a></li>';
    $links .= '<li><a href=' . asset('/#dataJS') . '>Book an Appointment</a></li>';
    if(isGranted()) {
      #$links .= '   <li><a href="calendar.php#day_selected">Calendar</a></li>';
      $links .= '   <li><a href="calendar.php">Calendar</a></li>';
      $links .= '   <li><a href="logout.php">Logout</a></li>';
    }
    $links .= ' </ul>'; 
    $links .= getMenuTrigger();

    return $links;
  }

  function getMenuTrigger() {
    $displayForm = "";
    $displayForm .= '   <div class="nav">';
    $displayForm .= '     <input type="checkbox" id="toogle">';
    $displayForm .= '     <label id="iomenu" for="toogle">☰</label>';
    $displayForm .= '     <div class="menu">';
    $displayForm .= '       <a href="index.php">Home</a>';
    $displayForm .= '       <a href="index.php?gallery=true">Gallery</a>';
    $displayForm .= '       <a href="index.php?reviews=true">Reviews</a>';
    $displayForm .= '       <a href='. asset('/#dataJS') .'>Book an Appointment</a>';
    if(isGranted()) {
      $displayForm .= '   <a href="calendar.php#day_selected">Calendar</a>';
      $displayForm .= '   <a href="logout.php">Logout</a>';
    }
    $displayForm .= '     </div>';
    $displayForm .= '   </div>';

    return $displayForm;
  }

  function getVideo($video) {
    #$srcVideo = getSourceVideo();
    $displayForm = "";
    $displayForm .= ' <main class="main-video">';
    $displayForm .= '   <video loop="" muted="muted" autoplay="">';
    $displayForm .= '     <source src="'.$video.'"/>';
    $displayForm .= '   </video>';
    $displayForm .= ' </main>';
    
    return $displayForm;
  }

  function getAd($img, $title, $text, $sortColumns) {
    $columnImg = '<div class="ad-firstColumn"><img src='.$img.'></div>';
    $columnText = '<div class="ad-externo">';
    $columnText .= '       <div class="ad-interno">';
    $columnText .= '         <h1>'.$title.'</h1>';
    $columnText .= '         <p>'.$text.'</p>';
    $columnText .= '       </div>';
    $columnText .= '     </div>';

    $displayForm = "";
    $displayForm .= ' <section class="flayer">';
    $displayForm .= '   <div class="two-columns">';
    if ($sortColumns == 'img') {
      $displayForm .= $columnImg;
      $displayForm .= $columnText;
    } else {
      $displayForm .= $columnText;
      $displayForm .= $columnImg;
    }
    $displayForm .= '   </div>';
    $displayForm .= ' </section>';

    return $displayForm; 
  }

  function getFooter() {
    $displayFoot = '';
    $displayFoot .= '<nav>';
    $displayFoot .= ' <div class="f-column">';
    $displayFoot .= '   <span class="f-title">Information</span>';
    $displayFoot .= '   <ul class="f-content">';
    $displayFoot .= '     <li class="f-content-item">We have parking.</li>';
    $displayFoot .= '     <li class="f-content-item">We accept the following payment methods: VISA, Venmo, Paypal, Cash, Check, Zelle, Cash App.</li>';
    $displayFoot .= '   </ul>';
    $displayFoot .= ' </div>';
    $displayFoot .= ' <div class="f-column">';
    $displayFoot .= '   <span class="f-title">Our Services</span>';
    $displayFoot .= '   <ul class="f-content">';
    $displayFoot .= '     <li class="f-content-item">Wedding dress alterations</li>';
    $displayFoot .= '     <li class="f-content-item">Bridesmaid dress alterations</li>';
    $displayFoot .= '     <li class="f-content-item">Quinceanera dress alterations</li>';
    $displayFoot .= '     <li class="f-content-item">Prom dress alterations</li>';
    $displayFoot .= '     <li class="f-content-item">Suit alterations</li>';
    $displayFoot .= '   </ul>';
    $displayFoot .= ' </div>';
    $displayFoot .= ' <div class="f-column">';
    $displayFoot .= '   <span class="f-title">Contact Us</span>';
    $displayFoot .= '   <ul class="f-content">';
    $displayFoot .= '     <li class="f-content-item">1347 East 4065 South, Millcreek, Salt Lake City, Utah 84124</li>';
    $displayFoot .= '     <li class="f-content-item">Make an Appoinment for this website or call us to (385) 226-2473</li>';
    $displayFoot .= '     <li class="f-content-item">';
    $displayFoot .= '       <a href="mailto:info@cecistyle.org" target="_blank">info@cecistyle.org</a>';
    $displayFoot .= '     </li>';
    $displayFoot .= '   </ul>';
    $displayFoot .= ' </div>';
    $displayFoot .= ' <div class="f-column">';
    $displayFoot .= '   <span class="f-title">Social Media</span>';
    $displayFoot .= '   <ul class="f-content">';
    $displayFoot .= '     <li class="f-content-item">';
    $displayFoot .= '       <a href="https://www.facebook.com/cecistyleutah" class="ac-gf-directory-column-section-link" target="_blank">Facebook</a>';
    $displayFoot .= '     </li>';
    $displayFoot .= '     <li class="f-content-item">';
    $displayFoot .= '       <a href="https://www.instagram.com/cecistyleutah" class="ac-gf-directory-column-section-link" target="_blank" class="fa fa-instagram">Instagram</a>';
    $displayFoot .= '     </li>';
    $displayFoot .= '     <li class="f-content-item">';
    $displayFoot .= '       <a href="https://goo.gl/maps/9kVjUsFKFMBaMLvt6" target="_blank" rel="noopener noreferrer">Google Maps</a>';
    $displayFoot .= '     </li>';
    $displayFoot .= '   </ul>';
    $displayFoot .= ' </div>';
    $displayFoot .= '</nav>';
    $displayFoot .= '<section class="footer-right">';
    $displayFoot .= ' <div class="footer-locale">';
    $displayFoot .= '   <a class="footer-locale-link">United States</a>';
    $displayFoot .= ' </div>';
    $displayFoot .= ' <div class="footer-legal">';
    $displayFoot .= '   <div class="footer-legal-copyright">Copyright © 2019 CeciStyle Corp. All Right Reserved.s</div>';
    $displayFoot .= ' </div>';
    $displayFoot .= '</section>';


    return $displayFoot;
  }

  function isGranted()
  {
    if(isset($_SESSION['granted'])) return true;
    
    return false;
  }
?>