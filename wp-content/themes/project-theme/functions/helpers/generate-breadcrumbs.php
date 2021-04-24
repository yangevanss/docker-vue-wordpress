<?php
/** 變數說明
 *
 *  @param Object $menu 為 menu-to-array 所產出的目標 menu
 *  @param Number $id 為目標頁面 id
 *  @param Array $others 其他想放入的，為二維陣列，內層包含：id, name, link
 */

function format_menu($menu = null) {
    if ($menu === null) return null;

    $response = [];
    foreach ($menu as $i => $item) {
        $response[$item->ID] = [
            'ID' => $item->ID,
            'page_id' => (intval($item->ID) === intval($item->object_id)) ? null : $item->object_id,
            'title' => $item->title,
            'url' => $item->url,
            'parent_id' => $item->menu_item_parent,
        ];
    }
    return $response;
}

function generate_breadcrumbs($menu_id, $id, $others = null) {
    $breadcrumb = null;
    $footprint_id = null;
    $menu = format_menu(wp_get_nav_menu_items($menu_id));

    if (($id !== null) && $menu) {
        $parent = null;

        // 一維 menu 內符合的項目
        foreach($menu as $item_index => $menu_item){
            if ($menu_item['page_id'] !== null) {
                $is_match = intval($menu_item['page_id']) === intval($id);
                if ($is_match && ($menu_item['parent_id'] !== 0)) {
                    $parent = &$menu[$menu_item['parent_id']];
                    $footprint_id[] = $item_index;
                    break;
                }
            }
        }

        // Loop 查找 parent ID
        do {
            $footprint_id[] = $parent['ID'];
            
            if (intval($parent['parent_id']) !== 0) {
                $parent = &$menu[$parent['parent_id']];

                if (intval($parent['parent_id']) === 0) {
                    $footprint_id[] = $parent['ID'];
                }
            }
        } while (intval($parent['parent_id']) !== 0);

        // 反轉 footprint 和查找相關項目
        if (sizeof($footprint_id) > 0) {
            foreach (array_reverse($footprint_id) as $crumb_index => $crumb_id) {
                $crumb = $menu[$crumb_id];
                $breadcrumb[] = [
                    "id" => $crumb['page_id'],
                    "name" => $crumb['title'],
                    "link" => $crumb['url']
                ];
            }
        }

        // 推入其餘項目
        if ($others) {
            foreach ($others as $i => $item) {
                $breadcrumb[] = $item;
            }
        }
    }

    return $breadcrumb;
}