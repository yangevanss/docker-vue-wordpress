<?php
require_once(get_template_directory() . '/libs/utils/get_manifest_data.php');

function enqueue_style(String $path = null)
{
  $manifest_data = get_manifest_data($path . '.js');

  if ($manifest_data) {
    if (property_exists($manifest_data, 'css')) {
      foreach ($manifest_data->css as $path) {
        $style_key = 'custom-style-' . $path;
        if (!wp_style_is($style_key)) {
          $manifest_style_src = path_join(get_template_directory_uri(), 'dist/' . $path);
          wp_enqueue_style($style_key, $manifest_style_src, [
            'wp-block-library',
            'classic-theme-styles'
          ], false, 'all');
        }
      }
    }

    if (property_exists($manifest_data, 'imports')) {
      foreach ($manifest_data->imports as $path) {
        enqueue_style(substr($path, 0, strpos($path, ".js")));
      }
    }
  }
}

function enqueue_script_style(String $path = null, Bool $in_footer = true)
{
  $path = str_replace('@/', 'wordpress/wp-content/themes/custom-theme/src/', $path);

  $script_key = 'custom-script-' . $path;
  if ($path && !wp_script_is($script_key)) {
    if (WP_DEBUG) {
      $src = path_join($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . VITE_PORT, $path);
      return wp_enqueue_script($script_key, $src, [], false, $in_footer);
    }

    $manifest_data = get_manifest_data($path . '.js');
    if ($manifest_data) {
      $manifest_script_src = path_join(get_template_directory_uri(), 'dist/' . $manifest_data->file);
      wp_enqueue_script($script_key, $manifest_script_src, [], false, $in_footer);

      enqueue_style($path);
    }
  }
}
