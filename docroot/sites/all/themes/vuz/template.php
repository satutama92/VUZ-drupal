<?php
// First, we must set up an array
$element = array(
  '#tag' => 'meta', // The #tag is the html tag - <link />
  '#attributes' => array( // Set up an array of attributes inside the tag
    'name'=>'viewport',
    'content' => 'width=797,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no'
  ),
);
drupal_add_html_head($element, 'google_font_cardo');
?>