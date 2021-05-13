<?php

$context = Timber::context();
$fields = get_fields(get_post_type() . '_options');
$context['title'] = post_type_archive_title(null, false);
$context['seo'] = get_seo($fields['seo']);
$context['breadcrumb'] = get_breadcrumb('main_menu', function ($item) {
    return $item['url'] == get_post_type_archive_link(get_post_type());
});

if(is_tag()){

}
if(is_category()){

}


Timber::render(array('pages/archive-' . get_post_type() . '.twig'), $context);
