<?php
/* ==========================================================================
   INCLUDE CONFIG DU SITE
========================================================================== */

require "site-admin.php";


function evento_enqueue_style()
{
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false);
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false);
    wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css', false);
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', false);
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', false);
}

function evento_enqueue_script()
{
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1, true);
    if (is_front_page()) {
        wp_enqueue_script('google', 'http://maps.google.com/maps/api/js?sensor=true', array('jquery'), 1, true);
        wp_enqueue_script('gmaps', get_template_directory_uri() . '/js/gmaps.js', array('jquery'), 1, true);
        wp_enqueue_script('nav', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), 1, true);
    }
    wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array('jquery'), 1, true);
    wp_enqueue_script('parallax', get_template_directory_uri() . '/js/jquery.parallax.js', array('jquery'), 1, true);
    wp_enqueue_script('scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.js', array('jquery'), 1, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), 1, true);
}

add_action('wp_enqueue_scripts', 'evento_enqueue_style');
add_action('wp_enqueue_scripts', 'evento_enqueue_script');


function add_class_the_tags($html)
{
    return str_replace('<a', '<a class="label label-primary"', $html);
}

add_filter('the_tags', 'add_class_the_tags');

function add_class_the_category($html)
{
    return str_replace('<a', '<a class="label label-warning"', $html);
}

add_filter('the_category', 'add_class_the_category');

add_theme_support('post-thumbnails');
set_post_thumbnail_size(500, 333, true);
add_image_size('team-size', 263, 231, true);


add_action('widgets_init', 'theme_slug_widgets_init');
function theme_slug_widgets_init()
{
    register_sidebar(array(
        'name' => 'Barre latérale actu',
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>'
    ));
}


add_action('init', 'create_post_type');
function create_post_type()
{
    register_taxonomy(
        'metiers',
        'team',
        array(
            'labels' => array(
                'name' => 'Métier',
                'add_new_item' => 'Ajouter un métier',
                'new_item_name' => "Nouveau métier"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
    register_post_type('team',
        array(
            'labels' => array(
                'name' => __('Equipe'),
                'singular_name' => __('Equipe'),
                'all_items' => 'Tous les membres de l\'équipe',
                'add_new_item' => 'Ajouter un membre',
                'edit_item' => 'Éditer le membre',
                'new_item' => 'Nouveau membre',
                'view_item' => 'Voir le membre',
                'search_items' => 'Rechercher parmi les membres',
                'not_found' => 'Pas de membre trouvé',
                'not_found_in_trash'=> 'Pas de membre dans la corbeille'
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-universal-access',
            'taxonomy' => 'metiers'
        )
    );
    register_post_type('temoignages',
        array(
            'labels' => array(
                'name' => __('Témoignages'),
                'singular_name' => __('Témoignage')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
        )
    );
    register_post_type('sponsors',
        array(
            'labels' => array(
                'name' => __('Sponsors'),
                'singular_name' => __('Sponsor')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail')
        )
    );
}


function wpc_excerpt_pages()
{
    add_meta_box('postexcerpt', __('Extrait'), 'post_excerpt_meta_box', 'page', 'normal', 'core');
}

add_action('admin_menu', 'wpc_excerpt_pages');


add_action('init', 'ajouter_menu');

function ajouter_menu()
{
    register_nav_menu('main_menu', 'Menu principal');
    register_nav_menu('main_menu_int', 'Menu principal intérieur');
    register_nav_menu('footer_menu', 'Menu footer');
}


/* ==========================================================================
   METABOX
========================================================================== */

// Initialisation des metabox
add_action('add_meta_boxes', 'init_metabox');
function init_metabox()
{ 

    add_meta_box('meta_box_sponsor', 'Lien externe', 'meta_box_sponsor', 'articles', 'advanced', 'core');
}

function meta_box_sponsor($post)
{
    $url = get_post_meta($post->ID, '_url', true);
    echo '<p><strong>URL</strong><br><input type="text" value="' . esc_url($url) . '" name="url" size="80"></p>';
}

add_action('save_post', 'save_metabox');
function save_metabox($post_id)
{
    if (isset($_POST['url'])) {
        update_post_meta($post_id, '_url', esc_url($_POST['url']));
    }
}


function team_func($atts)
{
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'team'
    );
    $teams = get_posts($args);


    echo '<ul>';
    foreach ($teams as $team) {
        echo '<li>';
        if (isset($atts['photo']) && $atts['photo']==1) :
            echo get_the_post_thumbnail($team->ID, 'thumbnail');
        endif;
        echo $team->post_title;
        echo '</li>';
    }
    echo '</ul>';

}

add_shortcode('team', 'team_func');
