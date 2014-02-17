<?php

/**
 * m1 Theme functions and definitions
 *
 * @package m1 Theme
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
    $content_width = 770; /* pixels */

if (!function_exists('m1_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function m1_setup() {

        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * If you're building a theme based on m1 Theme, use a find and replace
         * to change 'm1' to the name of your theme in all the template files
         */
        load_theme_textdomain('m1', get_template_directory() . '/languages');

        /**
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support('automatic-feed-links');

        /**
         * Enable support for Post Thumbnails on posts and pages
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(770, 250, true);

        /**
         * This theme uses wp_nav_menu() in one location.
         */
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'm1'),
            'top' => __('Top Menu', 'm1'),
        ));

        /**
         * Enable support for Post Formats
         */
        //add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
    }

endif; // m1_setup
add_action('after_setup_theme', 'm1_setup');

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function m1_register_custom_background() {
    $args = array(
        'default-color' => 'fafaf9',
        'default-image' => '',
    );

    $args = apply_filters('m1_custom_background_args', $args);

    if (function_exists('wp_get_theme')) {
        add_theme_support('custom-background', $args);
    } else {
        define('BACKGROUND_COLOR', $args['default-color']);
        if (!empty($args['default-image']))
            define('BACKGROUND_IMAGE', $args['default-image']);
        add_custom_background();
    }
}

add_action('after_setup_theme', 'm1_register_custom_background');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function m1_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'm1'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Header', 'm1'),
        'id' => 'header-widget-area',
        'description' => __('A single search widget works best here.', 'm1'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer', 'm1'),
        'id' => 'footer-widget-area',
        'description' => __('Use 3 widgets max for best results.', 'm1'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'm1_widgets_init');

/**
 * Enqueue scripts and styles
 */
function m1_scripts() {
    wp_enqueue_style('m1-style', get_stylesheet_uri());

    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'));

    wp_enqueue_script('off-canvas-nav', get_template_directory_uri() . '/js/off-canvas-nav-simple.js', array('jquery'));

    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'));

    wp_enqueue_script('m1-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('m1-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20120202');
    }
}

add_action('wp_enqueue_scripts', 'm1_scripts');

// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass($ulclass) {
    return preg_replace('/<ul>/', '<ul class="menu">', $ulclass, 1);
}

add_filter('wp_page_menu', 'add_menuclass');

// Add custom editor styles
function m1_add_editor_styles() {
    add_editor_style('editor-style.css');
}

add_action('init', 'm1_add_editor_styles');

// Theme activation message
/* Display a notice that can be dismissed */

add_action('admin_notices', 'm1_admin_notice');

function m1_admin_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if (!get_user_meta($user_id, 'm1_ignore_notice')) {
        echo '<div class="updated"><p>';
        printf(__('Thanks for choosing the m1 Theme! Please use the <strong><a href="' . get_admin_url() . 'customize.php' . '">theme customizer</a></strong> to customize your theme colors, settings, and more.  For support, docs, upgrades, and more, please visit <a href="http://m1themes.com" target="_blank">m1 Themes.</a> | <a href="%1$s">Hide Notice</a>'), '?m1_nag_ignore=0');
        echo "</p></div>";
    }
}

add_action('admin_init', 'm1_nag_ignore');

function m1_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if (isset($_GET['m1_nag_ignore']) && '0' == $_GET['m1_nag_ignore']) {
        add_user_meta($user_id, 'm1_ignore_notice', 'true', true);
    }
}

// Add a theme customizer link
add_action('admin_menu', 'm1_customizer_link');

function m1_customizer_link() {
    // add the Customize link to the admin menu
    add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php');
}

// Add superfish init
function superfish_init() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('nav ul.menu').superfish({
                hoverClass: 'sfHover',
                disableHI: true,
                delay: 0, // no delay on mouseout
                animation: {opacity: 'show', height: 'show'}, // fade-in and slide-down animation
                speed: 'fast', // faster animation speed
                cssArrows: true                             // arrows
            });
            //stylizeSearch();


            //Função do busca de ramais
            //Função criada para o usuário selecionar o campo necessario para a pesquisa,
            //seja ela de nome, departamento, email ou ramal.
            //Desenvolvimento: Ricardo Design
            //Empresa: Criarenet
            var container = $('#bp_profile_search-2 h3.widget-title');
            container.after("<p id='tabRadio'><label><input checked='checked' name='radioTape' id='radioName' type='radio'>Nome</label><label><input name='radioTape' id='radioDepart' type='radio'>Departamento</label><label><input name='radioTape' id='radioRamal' type='radio'>Ramal</label><label><input name='radioTape' id='radioEmail' type='radio'>Email</label></p>");

            $('#radioName').on('click', function() {
                $('#bp_profile_search-2 div').hide();
                $('#bp_profile_search-2 div.editfield input').val('');
                $('.field_name').show();
                $('.submit').show();
            });

            $('#radioDepart').on('click', function() {
                $('#bp_profile_search-2 div').hide();
                $('#bp_profile_search-2 div.editfield input').val('');
                $('.field_departamento').show();
                $('.submit').show();
            });

            $('#radioRamal').on('click', function() {
                $('#bp_profile_search-2 div').hide();
                $('#bp_profile_search-2 div.editfield input').val('');
                $('.field_ramal').show();
                $('.submit').show();
            });

            $('#radioEmail').on('click', function() {
                $('#bp_profile_search-2 div').hide();
                $('#bp_profile_search-2 div.editfield input').val('');
                $('.field_email').show();
                $('.submit').show();
            });
            //end

        });
    </script>
    <?php

}

add_action('wp_head', 'superfish_init');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//CRIACAO DE FUNCOES PARA REMOVER, DESABILITAR OU MUDAR ALGUNS CAMPOS DO PAINEL ADMINISTRATIVO E NO AMBIENTE DO SITE E TEMPLATE
//LISTA DAS ALTERACOES
//REMOVER A META TAG COM A VERSAO DO WORDPRESS DO CODIGO FONTE
//ESCONDER AVISOS DE ATUALIZACOES
//REMOVER EDITOR DE NAVEGACAO
//REMOVER VERSAO DO WORDPRESS DO RODAPE DA DASHBOARD PARA OUTRA
//MUDAR O TEXTO DO RODAPE DO PAINEL DE ADMIN
//MOSTRAR A DASHBOARD NUMA SO COLUNA
//DESLIGAR A NOTIFICACAO DE UPDATE DE BROWSER
//ESCONDER OPCAO DE COR NOS PERFIS
//REMOVE CAMPOS (AIM, JABBER, YIM)
//REMOVER OPCOES PESSOAIS DO SITE
//REMOVE PALETAS DE CORES
//REMOVE INFORMACOES BIOGRAFICAS
//REGISTRANDO NOVAS SIDEBAR AO SITE
//FUNCOES CRIADAS, MODIFICAS E ATUALIZADAS 14/08/2013
//WEB DESIGN & DESENVOLVIMENTO: TIAGO TORRES (CRIARENET) - TIAGO.MATEUS@CRIARENET.COM

//REMOVER A META TAG COM A VERSAO DO WORDPRESS DO CODIGO FONTE
remove_action('wp_head', 'wp_generator');

//ESCONDER AVISOS DE ATUALIZACOES
add_action('admin_menu', 'wphidenag');

function wphidenag() {
    remove_action('admin_notices', 'update_nag', 3);
}

//REMOVER EDITOR DE NAVEGACAO
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
} 
add_action('_admin_menu', 'remove_editor_menu', 1);

//REMOVER VERSAO DO WORDPRESS DO RODAPE DA DASHBOARD PARA OUTRA
function change_footer_version() {
  return 'Version 1.0.0';}
add_filter( 'update_footer', 'change_footer_version', 9999 );

//MUDAR O TEXTO DO RODAPE DO PAINEL DE ADMIN
function remove_footer_admin () {
  echo '&copy 2013 - Intranet Davó';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//MOSTRAR A DASHBOARD NUMA SO COLUNA
function single_screen_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_screen_columns' );
function single_screen_dashboard(){return 1;}
add_filter( 'get_user_option_screen_layout_dashboard', 'single_screen_dashboard' );

//DESLIGAR A NOTIFICACAO DE UPDATE DE BROWSER
function disable_browser_upgrade_warning() {
    remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
}
add_action( 'wp_dashboard_setup', 'disable_browser_upgrade_warning' );

//ESCONDER OPCAO DE COR NOS PERFIS
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'admin_color_scheme');

//REMOVE CAMPOS (AIM, JABBER, YIM)
add_filter('user_contactmethods', 'hide_profile_fields', 10, 1);
function hide_profile_fields($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}

//REMOVER OPCOES PESSOAIS DO SITE
//function hide_personal_options() 
//    echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) {
//		$(\'form#your-profile > h3:first\').hide();
//	    $(\'form#your-profile > table:first\').hide();
//	    $(\'form#your-profile\').show(); 
//	    $(\'label[for=url], input#url\').hide();
//    });  
//	</script>' . "\n";
//}

//REMOVE PALETAS DE CORES
//function admin_color_scheme() {
//    global $_wp_admin_css_colors;
//    $_wp_admin_css_colors = 0;
//}
//add_action('admin_head', 'admin_color_scheme');

//REMOVE INFORMACOES BIOGRAFICAS
//add_action('personal_options', array('T5_Hide_Profile_Bio_Box', 'start'));
//class T5_Hide_Profile_Bio_Box {
//    public static function start() {
//        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
//        add_action($action, array(__CLASS__, 'stop'));
//        ob_start();
//    }
//
//    public static function stop() {
//        $html = ob_get_contents();
//        ob_end_clean();
//
//        // remove the headline
//        $headline = __(IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
//        $html = str_replace('<h3>' . $headline . '</h3>', '', $html);
//
//        // remove the table row
//        $html = preg_replace('~<tr>\s*<th><label for="description".*</tr>~imsUu', '', $html);
//        print $html;
//    }
//}

//REMOVENDO A BARRA DE ADMINISTRADOR DO SITE
add_filter('show_admin_bar', '__return_false');



//REGISTRANDO NOVAS SIDEBAR AO SITE
register_sidebar(array(
    'name' => 'Noticias',
    'id' => 'noticias',
    'description' => 'Sidebar para conter as noticias',
    'before_widget' => '<div class="contentNews"><ul><li class="widgetNews">',
    'after_widget' => '</li></ul></div>',
    'before_title' => '<h3 class="widget-title">',
));

/* register_sidebar(array(
  'name' => 'Cotacoes',
  'id' => 'cotacoes',
  'description' => 'Sidebar para conter as cotacoes online',
  'before_widget' => '<div class="contentActions"><ul><li class="widgetActions">',
  'after_widget' => '</li></ul></div>',
  'before_title' => '<h3 class="widget-title">',
  ));

  register_sidebar(array(
  'name' => 'Acontecimentos',
  'id' => 'Acontecimentos',
  'description' => 'Sidebar para conter os acontecimentos online',
  'before_widget' => '<div class="contentEvents"><ul><li class="widgetEvents">',
  'after_widget' => '</li></ul></div>',
  'before_title' => '<h3 class="widget-title">',
  )); */

/**
 * Plugin Name: ILC Login
 * Plugin URI: http://ilovecolors.com.ar/
 * Description: Creates a shortcode to display a login box.
 * Author: Elio Rivero
 * Author URI: http://ilovecolors.com.ar
 * Version: 1.0.0
 */

 

