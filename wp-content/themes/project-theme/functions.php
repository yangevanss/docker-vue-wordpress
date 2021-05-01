<?php
if (!function_exists('is_login_page')) {
    function is_login_page() {
        return in_array(
            $GLOBALS['pagenow'],
            ['wp-login.php', 'wp-register.php'],
            true
        );
    }
}

function my_custom_login_logo() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url') . '/src/style/adminLogin.css">';
}

// ***** 檢查是否啟用 timber *****
if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });

    add_filter('template_include', function ($template) {
        return get_stylesheet_directory() . '/static/no-timber.html';
    });
    return;
}
// ***** 檢查是否啟用 timber *****

// ***** 設定 WP ******
add_action('after_setup_theme', function () {
    include_once 'functions/wordpress/_wordpress.php'; // 設定 WP 後台
    include_once 'functions/custom/admin-styles.php'; // 設定後台樣式
    include_once 'functions/custom/option-set.php'; // 設定網站共用文字

    include_once 'functions/custom/remove-thumbnail-box.php'; // 移除精選區塊
    include_once 'functions/custom/remove-admin-side-btn.php'; // 移除後台側邊按鈕
    include_once 'functions/custom/remove-preview-btn.php'; // 移除後台預覽按鈕
    include_once 'functions/wordpress/hide-editor.php'; // 移除編輯器

    include_once 'functions/custom/page-set.php'; // 設定頁面陣列
    include_once 'functions/custom/clear-transient.php'; // 增加清除快取按鈕

    include_once 'functions/custom/preget-set.php'; // 修改一頁出現幾篇，或是限制搜尋結果出現的post_type
    include_once 'functions/custom/query_post_type_tags.php'; // 讓 tag 篩選也可以篩選 custom post type

    include_once 'api/api.php'; // 引入 API
    include_once 'post-type/post-type.php'; // 設定 custom post type

    // *** 引入共用 funtion ***
    include_once 'functions/helpers/get-theme-files.php';
    include_once 'functions/helpers/generate-breadcrumbs.php';
    // *** 引入共用 funtion ***

    if (is_login_page()) {
        add_action('login_head', 'my_custom_login_logo'); // 設定登入頁樣式
    }

    $user = wp_get_current_user();
    if ( in_array( 'editor', (array) $user->roles ) ) {
        include_once 'functions/custom/edit-menu-btn.php'; // 客制編輯者權限menu選單
    }
});
// ***** 設定 WP ******


// ***** 快取機制 *****
// Timber::$cache = true;
// $loader = new Timber\Loader();
// $loader->clear_cache_twig();
// ***** 快取機制 *****

Timber::$dirname = array('templates', 'views');
Timber::$autoescape = false;

class StarterSite extends Timber\Site {
    public function __construct() {
        add_action('after_setup_theme', array($this, 'theme_supports'));
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        parent::__construct();
    }

    public function add_to_context($context) {
        $context['site'] = $this;
        $context['node_env'] = WP_DEBUG ? 'development' : 'production';
        return $context;
    }

    public function theme_supports() {
        add_theme_support('post-thumbnails');
    }

    public function add_to_twig($twig) {
        // 新增自訂twig程式
        $twig->addExtension(new Twig_Extension_StringLoader());
        $twig->addFunction(new Twig_SimpleFunction('getFileExt', 'getFileExt'));
        $twig->addFunction(new Twig_SimpleFunction('customDateFormat', 'customDateFormat'));

        $twig->addFunction(new Twig_SimpleFunction('enqueue_script', function ($name, $cover = true) {
            $url = path_join(get_template_directory_uri(), './src/js/');
            if (WP_DEBUG) {
                $url = path_join('http://localhost:8080/', './js/');
            }
            if($cover && wp_script_is('default')){
                wp_dequeue_script('default');
            }
            wp_enqueue_script($name, $url . $name . '.bundle.js', null, null, true);
        }));

        $twig->addFunction(new Twig_SimpleFunction('enqueue_style', function ($name, $cover = true) {
            if (!WP_DEBUG) {
                $url = path_join(get_template_directory_uri(), './src/css/');
                if($cover && wp_style_is('default')){
                    wp_dequeue_style('default');
                }
                wp_enqueue_style($name, $url . $name . '.css', null, null, 'all');
            }
        }));

        $twig->addFunction(new Twig_SimpleFunction('require_assets', function($src) {
            $url = path_join(get_template_directory_uri() . '/src/', $src);
            if (WP_DEBUG) {
                $url = path_join('http://localhost:8080/', $src);
            }
            return $url;
        }));


        return $twig;
    }

}

new StarterSite();
