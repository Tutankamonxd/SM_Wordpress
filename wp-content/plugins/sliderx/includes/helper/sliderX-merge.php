<?php
/*
* @Pakage SliderX.
*/

if (!function_exists('sliderX_mergeData')) {
    function sliderX_mergeData($data1=null, $data2=array()) {
      $merged = array();
      if( !empty($data1) &&  count($data1) > 0 ){
          foreach ($data1 as $item) {
              $merged[] = array(
                  'image' => $item->image,
                  'title' => $item->title,
                  'subtitle' => $item->subtitle,
                  'description' => $item->description,
                  'btnText1' => $item->btnText1,
                  'btnLink1' => $item->btnLink1,
                  'btnText2' => $item->btnText2,
                  'btnLink2' => $item->btnLink2
              );
          }
      }
      return $merged;
    }
  }