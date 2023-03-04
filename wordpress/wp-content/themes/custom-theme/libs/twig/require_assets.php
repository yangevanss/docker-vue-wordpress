<?php
require_once(get_template_directory() . '/libs/utils/get_manifest_data.php');

function require_assets(String $path)
{
  $path = str_replace('@/', 'wordpress/wp-content/themes/custom-theme/src/assets/global/', $path);

  $src = path_join($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . VITE_PORT, $path);

  if (WP_DEBUG) {
    return $src;
  }

  $manifest_data = get_manifest_data($path);
  if ($manifest_data) {
    $manifest_src = path_join(get_template_directory_uri(), 'dist/' . $manifest_data->file);
    return $manifest_src;
  }
  return null;
}
