<?php
$DOM = new DOMDocument();

function get_all_image_sizes($attachment_id = 0)
{
  $sizes = get_intermediate_image_sizes();
  if (!$attachment_id) $attachment_id = get_post_thumbnail_id();

  $images = [];
  foreach ($sizes as $size) {
    $image = wp_get_attachment_image_src($attachment_id, $size);
    $images[$size] = $image[0];
    $images[$size . '-width'] = $image[1];
    $images[$size . '-height'] = $image[2];
  }

  $GLOBALS['DOM']->loadHTML(wp_get_attachment_image($attachment_id, 'large'));
  $img  = $GLOBALS['DOM']->getElementsByTagName('img')[0];

  $imageObject = [
    'ID' => $attachment_id,
    'alt' => $img->getAttribute('alt'),
    'width' => $img->getAttribute('width'),
    'height' => $img->getAttribute('height'),
    'url' => $img->getAttribute('src'),
    'sizes' => $images
  ];

  return $imageObject;
}
