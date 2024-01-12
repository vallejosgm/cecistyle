<?php
/*
💬 Get Google-Reviews with PHP cURL & without API Key
=====================================================
**This is a dirty but usefull way to grab the first 8 most relevant reviews from Google with cURL and without the use of an API Key**
How to find the needed CID No:
  - use: [https://pleper.com/index.php?do=tools&sdo=cid_converter]
  - and do a search for your business name
Parameter
---------
```PHP
$options = array(
  'google_maps_review_cid' => '17311646584374698221', // Customer Identification (CID)
  'show_only_if_with_text' => false, // true = show only reviews that have text
  'show_only_if_greater_x' => 0,     // (0-4) only show reviews with more than x stars
  'show_rule_after_review' => true,  // false = don't show <hr> Tag after each review
  'show_blank_star_till_5' => true,  // false = don't show always 5 stars e.g. ⭐⭐⭐☆☆
  'your_language_for_tran' => 'en',  // give you language for auto translate reviews
  'sort_by_reating_best_1' => true,  // true = sort by rating (best first)
  'show_cname_as_headline' => true,  // true = show customer name as headline
  'show_age_of_the_review' => true,  // true = show the age of each review
  'show_txt_of_the_review' => true,  // true = show the text of each review
  'show_author_of_reviews' => true,  // true = show the author of each review
);
echo getReviews($options);
```
> HINT: Use .quote in you CSS to style the output
###### Copyright 2019-2020 Igor Gaffling
*/

$options = array(
  'google_maps_review_cid' => '442976692459960269', // Customer Identification (CID) 
  'show_only_if_with_text' => true, // true = show only reviews that have text
  'show_only_if_greater_x' => 3,     // (0-4) only show reviews with more than x stars
  'show_rule_after_review' => true,  // false = don't show <hr> Tag after each review (and before first)
  'show_blank_star_till_5' => true,  // false = don't show always 5 stars e.g. ⭐⭐⭐☆☆
  'your_language_for_tran' => 'en',  // give you language for auto translate reviews  
  'sort_by_reating_best_1' => true,  // true = sort by rating (best first)
  'show_cname_as_headline' => false,  // true = show customer name as headline
  'show_age_of_the_review' => true,  // true = show the age of each review
  'show_txt_of_the_review' => true,  // true = show the text of each review
  'show_author_of_reviews' => true,  // true = show the author of each review
);


/* -------------------- */

/* -------------------- */

function getReviews($option) {
  $ch = curl_init('https://www.google.com/maps?cid='.$option['google_maps_review_cid']);                                      /* GOOGLE REVIEWS BY cURL */
  if ( isset($option['your_language_for_tran']) and !empty($option['your_language_for_tran']) ) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: '.$option['your_language_for_tran']));
  }
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36');
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec($ch);
  curl_close($ch);                                                                                                            /* </cURL END> */
  $pattern = '/window\.APP_INITIALIZATION_STATE(.*);window\.APP_FLAGS=/ms';                                                   /* REVIEW REGEX PATTERN */
  if ( preg_match($pattern, $result, $match) ) {                                                                              /* CHECK IF REVIEWS FOUND */
    $match[1] = trim($match[1], ' =;');                                                                                                                /* DIRTY JSON FIX */
    $reviews  = json_decode($match[1]);                                                                                                                /* 2. JSON DECODE */
    $reviews  = ltrim($reviews[3][6], ")]}'");                                                                                                         /* DIRTY JSON FIX */
    $reviews  = json_decode($reviews);                                                                                                                 /* 2. JSON DECODE */
    $customer = $reviews[6][11];                                                                                                                       /* POSITION OF REVIEWS */
    $reviews  = $reviews[6][52][0];                                                                                                                    /* POSITION OF REVIEWS */
  }                                                                                                                                                    /* END CHECK */
  $return = '';                                                                                                                                        /* INI VAR */
  if (isset($reviews)) {                                                                                                                               /* CHECK REVIEWS */
    if ( isset($option['sort_by_reating_best_1']) and $option['sort_by_reating_best_1'] == true )                                /* CHECK SORT */
      array_multisort(array_map(function($element) { return $element[4]; }, $reviews), SORT_DESC, $reviews);                                           /* SORT */                                                         
    if (isset($option['show_cname_as_headline']) and $option['show_cname_as_headline'] == true) $return .= "<strong>".$customer."</strong><br> If you want to see all the reviews about Ceci'Style in 'Google Reviews', you can do it at <a href='https://www.google.com/maps/place/Ceci%E2%80%99Style/@40.6834871,-111.8529227,17z/data=!4m7!3m6!1s0x0:0x625c4f46dda77cd!8m2!3d40.6834871!4d-111.8529227!9m1!1b1' target='_blank'>See reviews</a><br>";       /* CUSTOMER */
    if (isset($option['show_rule_after_review']) and $option['show_rule_after_review'] == true) $return .= '<hr size="1">';

    $return .= getReviewsF($option, $reviews);
    


    #$return .= '</div>';                                                                                                      /* END LOOP */
    #$return .= '</div>';                                                                                                                               
  }                                                                                                                                                    
  return $return;                                                                                                                                      
}

function getReviewsF($option, $reviews) {
    
    $numPhotos = 8;
    $return = '';
    $return = '<div id="pictures-gallery" class="container-gallery">';
    $return .= '  <ul class="image-gallery">';
    foreach ($reviews as $review) {                                                                                                                   
      if (isset($option['show_only_if_with_text']) and $option['show_only_if_with_text'] == true and empty($review[3])) 
        continue;                      /* CHECK TEXT */
      if (isset($option['show_only_if_greater_x']) and $review[4] <= $option['show_only_if_greater_x']) 
        continue;

      $return .= "<li id='animated-group' class='animated-cover'> <div class='animated'>";                                    
      for ($i=1; $i <= $review[4]; ++$i) $return .= '⭐';  /* CHECK RATING */                                                                                              
      if (isset($option['show_blank_star_till_5']) and $option['show_blank_star_till_5'] == true) 
        for ($i=1; $i <= 5-$review[4]; ++$i) $return .= '☆'; 

      $return .= '<br>';                                                                                                                               
      if (isset($option['show_txt_of_the_review']) and $option['show_txt_of_the_review'] == true) 
        $return .= $review[3].'<br>';       /* NEWLINE */
                          
      if (isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true) 
        $return .= '<small>'.$review[0][1].'</small>';      /* AUTHOR */

      if (isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true and isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true) 
        $return .= '<small> &mdash; </small>';               /* IF AUTHOR & AGE */

      if (isset($option['show_age_of_the_review']) and $option['show_age_of_the_review'] == true) 
        $return .= '<small>'.$review[1].' </small>';         /* AGE */

      if (isset($option['show_rule_after_review']) and $option['show_rule_after_review'] == true) 
        $return .= '<hr size="1">';

      $return .= '</div></li>';                         
    }
    $return .= '   </ul>';
    $return .= '</div>';

    return $return;
  }

?>                                                                                                                                                      
