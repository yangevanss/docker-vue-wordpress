<?php
function optionSetArray() {
    // option 設定，如果使用多語系套件，需要去 wp-multilang/core-config.json 內的 options 增加，才會有翻譯
    return [
        [
            'label' => '網站設定',
            'id' => 'websiteSetting',
            'list' => [
                [
                    'option' => 'blogname',
                    'title' => '網站名稱'
                ], [
                    'option' => 'email', 'title' => 'E-Mail'
                ]
            ],
        ], [
            'label' => '固定文案',
            'id' => 'fixedText',
            'list' => [
                [
                    'option' => 'copyright',
                    'title' => 'copyright'
                ]
            ],
        ], [
            'label' => 'Google 相關',
            'id' => 'google_commons',
            'list' => [
                [
                    'option' => 'google_api_key',
                    'title' => 'Google API Key'
                ], 
                [
                    'option' => 'ga_source_id',
                    'title' => 'GA ID'
                ]
            ],
        ]
    ];
}

function myPluginOptions($list) {
    // 設定Html生成
    function optionHtml($option, $title, $class = null, $noTranslation = null) {
        // 設定Input Html生成
        echo '<div class="group">';
        echo '<div class="outer-box col-sm-' . 12 . '">';
        echo '<div class="label">' . $title . '</div>';
        echo '<div class="input-content">';
        printf('<input type="text" name="%s_data" id="%s_data" value="%s">', esc_attr($option), esc_attr($option), stripslashes(esc_attr(get_option($option))));
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    function optionsUpdate($list) {
        // 更新option總程式
        $langArray = [];
        if (function_exists('wpm_get_languages')) {
            $lang_switcher = wpm_get_languages();
            foreach ($lang_switcher as $lang_key => $lang) {
                $langArray[$lang_key] = $lang['name'];
            }
        }

        foreach ($list as $subGroup) {
            foreach ($subGroup['list'] as $optionArray) {
                $option = $optionArray['option'];
                update_option($option, $_POST[$option . '_data']);
            }
        }
    }

    if (isset($_POST['updateOptions']) && $_POST['updateOptions'] == 'true') {
        // 如果接收到更新參數，啟動更新
        optionsUpdate($list);
    }

    if (function_exists('wpm_get_languages')) {
        echo wpm_get_template( 'admin-language-switcher', '', '', [
            'languages' => wpm_get_languages(),
            'lang' => wpm_get_language(),
        ]);
        
        echo "<div id='lang-box'></div>
            <script>
                document.querySelector('#lang-box').innerHTML = document.querySelector('#tmpl-wpm-ls').innerHTML;
                document.querySelector('#lang-box').style.cssText = 'position:relative';
                document.querySelector('#lang-box .nav-tab-wrapper.language-switcher').style.cssText = 'position:relative;top:auto;left:auto;';
            </script>";
    }

    echo '<div class="jump-link">';
    foreach ($list as $subGroup):
        echo '<a href="#' . $subGroup['id'] . '">';
        echo $subGroup['label'];
        echo '</a>';
    endforeach;

    // if( function_exists ( 'wpm_get_languages' )){
    //     $langArray = languageSet();
    //     foreach ($langArray  as $key => $value) {
    //         echo '<a href="' . add_query_arg( 'edit_lang', $key,  menu_page_url('all-options',false) ) . '">';
    //         echo '編輯'.$value;
    //         echo '</a>';
    //     }
    // }

    echo '</div>';

    echo '<form method="post" action="" id="myPluginOptions">';
    echo '<input type="hidden" name="updateOptions" value="true">';
    foreach ($list as $subGroup):
        echo '<h2 class="option-main-title" id="' . $subGroup['id'] . '">' . $subGroup['label'] . '</h2>';
        echo '<div class="option-table">';
        foreach ($subGroup['list'] as $option):
            optionHtml(
                $option['option'],
                $option['title'],
                isset($option['class']) ? $option['class'] : null,
                isset($option['noTranslation']) ? $option['noTranslation'] : null
            );
        endforeach;
        echo '</div>';
    endforeach;
    echo '<p><button class="save-btn" type="submit"><span class="save-btn-icon"></span>儲存設定</button></p>';
    echo '</form>';
}

function get_custom_options($lang = null) {
    // 一次叫出所有的 option 陣列
    $optionList = [];
    $listArray = optionSetArray();
    foreach ($listArray as $subGroup):
        foreach ($subGroup['list'] as $option):
            $optionList[$option['option']] = get_option($option['option']);
        endforeach;
    endforeach;
    return $optionList;
}

function optionsSet() {
    // 網站設定
    $listArray = optionSetArray();
    myPluginOptions($listArray);
}

function myPluginMenu() {
    // 生成額外頁面
    add_menu_page( '網站共通資料', '網站共通資料', 'edit_theme_options', '/all-options.php', 'optionsSet', '', 80);
}

add_action('admin_menu', 'myPluginMenu');