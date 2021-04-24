<?php
    function array_find_index(Array $arr = null, Closure $callback = null){
        $index = 0;
        foreach($arr as $key => $value){
            if($callback($value, $key, $arr)){
                return $index;
            }
            $index ++;
        }
        return -1;
    }

    function menu_to_array(String $menu_type = null){
        $generate = [];
        $temp_parents_ID;
        $temp_parents;
        $menu_items = wp_get_nav_menu_items($menu_type);

        if ($menu_items) {
            foreach($menu_items as $item){
                $ID = $item->ID;
                $parent_ID = $item->menu_item_parent;
                $data = [
                    'ID' => $ID,
                    'page_id' => $item->object_id,
                    'title' => $item->title,
                    'url' => $item->url,
                    'parent' => $parent_ID,
                    'menu_children' => [],
                ];
    
                if($parent_ID){
                    $temp_parents_ID[] = $ID;
                    $temp_parents[] = &$data['menu_children'];

                    $deep = array_find_index($temp_parents_ID, function($value) use ($parent_ID){
                        return $value == $parent_ID;
                    });
                    $temp_parents[$deep][$ID] = $data;
                    continue;
                }
                $temp_parents_ID = [$ID];
                $temp_parents = [&$data['menu_children']];
                $generate[$ID] = $data;
            }
        }
        return $generate;
    }
