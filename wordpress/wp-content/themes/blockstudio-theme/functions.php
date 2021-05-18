<?php

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
        }
    );

    add_filter(
        'template_include',
        function ($template) {
            return get_stylesheet_directory() . '/static/no-timber.html';
        }
    );
    return;
}

/**
 * acf options
 * use in wp-multilang https://support.advancedcustomfields.com/forums/topic/wp-multilang-with-acf-options-page/ 
 */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Options',
        'menu_title'    => 'Options',
        'menu_slug'     => 'options',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

    // acf_add_options_sub_page(array(
    // 	'page_title' 	=> 'Sub-Options',
    // 	'menu_title'	=> 'Sub-Options',
    // 	'parent_slug'	=> 'options',
    // ));

}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
    /** Add timber support. */
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'theme_supports'));
        add_action('after_setup_theme', array($this, 'default_setup'));
        add_filter('timber/context', array($this, 'add_to_context'));
        add_filter('timber/twig', array($this, 'add_to_twig'));
        // add_action('init', array($this, 'register_post_types')); please use "Custom Post Type UI" plugin to register
        // add_action('init', array($this, 'register_taxonomies')); please use "Custom Post Type UI" plugin to register
        parent::__construct();
    }

    public function theme_supports()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            )
        );

        add_theme_support('menus');
    }

    public function default_setup()
    {
        require_once 'api/index.php';
        require_once 'functions/index.php';
        
        if (is_admin()) {
            add_action('admin_enqueue_scripts', 'admin_style');
            add_filter('upload_mimes', 'upload_svg');
            add_filter('upload_size_limit', 'upload_size_limit');
            add_filter('admin_footer_text', 'admin_copyright');
        } else {
            add_action('login_enqueue_scripts', 'admin_style'); 
            add_action('pre_get_posts', 'pre_posts_page');
            add_filter('show_admin_bar', 'is_blog_admin');
        }
    }

    /** This is where you add some context
     *
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context($context)
    {
        $context['site'] = $this;
        $post = new Timber\Post();
        $posts = new Timber\PostQuery();
        $fields = get_fields($post);
        $context['NODE_ENV'] = WP_DEBUG ? 'development' : 'production';
        $context['post'] = $post;
        $context['posts'] = $posts;
        $context['fields'] = $fields;
        $context['blog_public'] = get_option('blog_public');
        $context['seo'] = get_seo($fields ? $fields['seo'] : null);
        $context['global_options'] = get_field('global_options', 'option');
        $context['main_menu'] = get_menu('main_menu');
        $context['breadcrumb'] = get_breadcrumb('main_menu', function ($item) use ($post) {
            return $item['page_id'] == $post->ID;
        });

        return $context;
    }

    /** This is where you can add your own functions to twig.
     *
     * @param string $twig get extension.
     */
    public function add_to_twig($twig)
    {
        $twig->addExtension(new Twig\Extension\StringLoaderExtension());
        $twig->addFunction(new Timber\Twig_Function('enqueue_script', 'enqueue_script'));
        $twig->addFunction(new Timber\Twig_Function('enqueue_style', 'enqueue_style'));
        $twig->addFunction(new Timber\Twig_Function('require_assets', 'require_assets'));
        $twig->addFunction(new Timber\Twig_Function('t', 'translate_language'));
        return $twig;
    }

    /**
     *  This is where you can register custom post types. 
     * 	please use "Custom Post Type UI" plugin to register
     * */
    public function register_post_types()
    {
    }

    /** 
     * This is where you can register custom taxonomies. 
     * please use "Custom Post Type UI" plugin to register
     * */
    public function register_taxonomies()
    {
    }
}

new StarterSite();