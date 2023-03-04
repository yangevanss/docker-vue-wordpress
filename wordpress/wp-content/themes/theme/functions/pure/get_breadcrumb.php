<?php
function get_menu_map(Array $menu)
{
    $generate = [];

    foreach ($menu as $key => $value) {
        $generate[$value->ID] = [
            'ID' => $value->ID,
            'parent' => $value->menu_item_parent,
            'page_id' => $value->object_id,
            'title' => $value->title,
            'url' => $value->url,
        ];
    }

    return $generate;
}

function get_breadcrumb(String $type, Callable $callback, Array $others = null)
{
    $generate = [];
    $origin_menu = wp_get_nav_menu_items($type);

    if($origin_menu) {
        $menu = get_menu_map(wp_get_nav_menu_items($type));
        
        $target = array_find($menu, function ($value) use ($callback) {
            return $callback($value);
        });
        
        if ($target) {
            do {
                array_unshift($generate, $target);
                $target = array_key_exists($target['parent'], $menu) ? $menu[$target['parent']] : null;
            }
            while($target);
        }
    
        if ($others && count($others)) {
            $generate = array_merge($generate, $others);
        }
    
        array_unshift($generate, [
            "page_id" => get_option('page_on_front'),
            "title" => ICL_LANGUAGE_CODE 
            ? (ICL_LANGUAGE_CODE === 'zh-hant' ? '首頁' : 'Index')
            : '首頁',
            "url" => get_home_url(),
        ]);
    }

    return $generate;
}
