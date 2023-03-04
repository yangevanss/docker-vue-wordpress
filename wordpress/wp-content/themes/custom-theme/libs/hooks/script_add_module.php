<?php
function script_add_module(String $tag, String $handle, String $src)
{
  if (str_contains($handle, 'custom-script-')) {
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    return $tag;
  }
  return $tag;
}
