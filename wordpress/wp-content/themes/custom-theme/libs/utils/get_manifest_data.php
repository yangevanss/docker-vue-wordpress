<?php
function get_manifest_data(String $path = null)
{
  $manifest_data = null;
  if (file_exists(path_join(WP_CONTENT_DIR, 'themes/custom-theme/dist/' . 'manifest.json'))) {
    $manifest_file = file_get_contents(path_join(get_template_directory(), 'dist/manifest.json'));
    if ($manifest_file) {
      $manifest = json_decode($manifest_file);
      if (isset($manifest->{$path})) {
        $manifest_data = $manifest->{$path};
      }
    }
  }
  return $manifest_data;
}
