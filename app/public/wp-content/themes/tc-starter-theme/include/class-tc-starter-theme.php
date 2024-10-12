<?php

namespace tc\Theme;

if (!class_exists('tc\Theme\tcStarterTheme')) {

    /**
     * Class tcStarterTheme
     *
     * @package tc\Theme
     */
    class tcStarterTheme
    {
        protected static $instance;
        protected static $options;
        const PROJECT_VERSION = '1.0';
        const TEXT_DOMAIN = 'tc-starter-theme';
        const TC_THEME_PREFIX = 'tc_';
        const TC_PROGETTI_CPT_NAME = 'tc_progetto';

        /**
         *
         * Inizializza il tema
         *
         * @return mixed
         */
        public static function init()
        {
            if (static::$instance == null) {
                static::$instance = new static();
            }
            return static::$instance;
        }

        public function __construct()
        {
            $this->textdomain();
            $this->_inizializza_hooks();
            $this->assets_init();
            $this->_registra_sidebars();
            $this->add_theme_support();
            $this->registra_cpt() ;
            $this->registra_taxonomies() ;

        }

        /**
         *
         */
        public function textdomain()
        {
            $path = apply_filters('tc_texdomain_path', get_template_directory() . '/languages');
            return load_theme_textdomain(static::TEXT_DOMAIN, $path);
        }

        /**
         *
         */
        protected function _inizializza_hooks()
        {
            add_action('wp_head', [$this, 'printCritical'], 10);
            add_action('wp_head', [$this, 'preloadStuff'], 11);

        }
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//ASSETS
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
        /**
         *
         */
        public function assets_init()
        {
            add_action('wp_enqueue_scripts', [$this, 'register_css'], 10);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_css'], 11);

            add_action('wp_enqueue_scripts', [$this, 'register_js'], 10);
            add_action('wp_enqueue_scripts', [$this, 'enqueue_js'], 11);

            add_action('wp_enqueue_scripts', [$this, 'dequeueCss'], 999);
            add_action('wp_enqueue_scripts', [$this, 'dequeueJs'], 999);

            add_filter('script_loader_tag', [$this, 'deferScripts'], 10, 3);
            add_filter('script_loader_tag', [$this, 'asyncScripts'], 10, 3);
        }


        /**
         *
         */
        public function register_css()
        {
            $path = get_template_directory_uri() . '/assets/css/';

//            wp_register_style('theme', $path . 'theme.min.css', [], self::PROJECT_VERSION, false);
            wp_register_style('swiper', $path .'vendors/swiper-bundle.min.css', [],self::PROJECT_VERSION, false);
        }

        /**
         *
         */
        public function enqueue_css()
        {
            wp_enqueue_style('swiper');
        }

        /**
         *
         */
        public function register_js()
        {

            $path = get_template_directory_uri() . '/assets/js/';
            wp_register_script('tc-theme-aid', '');
            wp_localize_script('tc-theme-aid', 'tcThemeAID', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'theme_url' => get_template_directory_uri(),
                'css_url' => get_template_directory_uri() . '/assets/css/',
                'js_url' => get_template_directory_uri() . '/assets/js/',

            ],

            );

            wp_register_script('bootstrap', $path . 'vendors/bootstrap.bundle.min.js', [], self::PROJECT_VERSION, true);
            wp_register_script('lazysizes', $path . 'vendors/lazysizes.min.js', [], self::PROJECT_VERSION, true);
            wp_register_script('theme', $path . 'theme.min.js', [], self::PROJECT_VERSION, true);
            wp_register_script('swiper', $path . 'vendors/swiper-bundle.min.js', [], self::PROJECT_VERSION, true);


        }


        /**
         *
         */
        public function enqueue_js()
        {
            wp_enqueue_script('tc-theme-aid');
            wp_enqueue_script('bootstrap');
            wp_enqueue_script('lazysizes');
            wp_enqueue_script('theme');
            wp_enqueue_script('swiper');

        }


        /**
         *
         */
        public function printCritical()
        {
            require get_template_directory() . '/include/performances/critical-css.php';
            require get_template_directory() . '/include/performances/critical-js.php';
        }

        /**
         *
         */
        public function preloadStuff()
        {
            require get_template_directory() . '/include/performances/preload-fonts.php';
        }


        /**
         *
         */
        public function dequeueCss()
        {
            wp_dequeue_style('wp-block-library');
        }

        /**
         *
         */
        public function dequeueJs()
        {

        }

        /**
         *
         */
        public function deferScripts($tag, $handle, $src)
        {
            if (is_admin()) return $tag;
            $deferGeneral = [
                'bootstrap',
                'lazysizes',
                'theme'
            ];
            if (in_array($handle, $deferGeneral)) {
                return str_replace(' src', ' defer src', $tag);
            }
            return $tag;
        }

        /**
         *
         */
        public function asyncScripts($tag, $handle, $src)
        {
            if (is_admin()) return $tag;

            $asyncGeneral = [
                'bootstrap',
                'lazysizes',
            ];
            if (in_array($handle, $asyncGeneral)) {
                return str_replace(' src', ' async src', $tag);
            }
            return $tag;
        }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//REGISTRA CPT E TASSONOMIE
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
        protected function registra_cpt()
        {
            $labels = [
                'name'                  => 'Progetti',
                'singular_name'         => 'Progetto',
                'menu_name'             => 'Progetti',
                'name_admin_bar'        => 'Progetto',
                'archives'              => 'Archivio Progetti',
                'attributes'            => 'Attributi Progetto',
                'parent_item_colon'     => 'Progetto Parente:',
                'all_items'             => 'Tutti i Progetti',
                'add_new_item'          => 'Aggiungi Nuovo Progetto',
                'add_new'               => 'Aggiungi Nuovo',
                'new_item'              => 'Nuovo Progetto',
                'edit_item'             => 'Modifica Progetto',
                'update_item'           => 'Aggiorna Progetto',
                'view_item'             => 'Visualizza Progetto',
                'view_items'            => 'Visualizza Progetti',
                'search_items'          => 'Cerca Progetto',
                'not_found'             => 'Non trovato',
                'not_found_in_trash'    => 'Non trovato nel cestino',
                'featured_image'        => 'Immagine in evidenza',
                'set_featured_image'    => 'Imposta immagine in evidenza',
                'remove_featured_image' => 'Rimuovi immagine in evidenza',
                'use_featured_image'    => 'Usa come immagine in evidenza',
                'insert_into_item'      => 'Inserisci nel progetto',
                'uploaded_to_this_item' => 'Caricato in questo progetto',
                'items_list'            => 'Elenco progetti',
                'items_list_navigation' => 'Navigazione elenco progetti',
                'filter_items_list'     => 'Filtra elenco progetti',
            ];

            $args = [
                'labels'                => $labels,
                'supports'              => ['title', 'editor', 'excerpt', 'thumbnail'],
                'hierarchical'          => false,
                'public'                => false,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_icon'             => 'dashicons-portfolio',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'rewrite'               => ['slug' => 'progetti'],
            ];

            register_post_type('tc_progetto', $args);

        }

        protected function registra_taxonomies()
        {

        }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//SIDEBARS
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

        /**
         *
         */
        protected function _registra_sidebars()
        {

        }

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//THEME SUPPORT
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------

        /**
         *
         */
        public function add_theme_support()
        {
            add_theme_support('post-thumbnails');
            add_theme_support('custom-logo');
            add_theme_support('menus');
            add_theme_support('align-wide');
            $this->_navigation_init();
            $this->_custom_image_sizes();
        }

        /**
         *
         */
        protected function _custom_image_sizes()
        {
            add_image_size('full-thumb', 1920, 1080, true);
            add_image_size('card-thumb', 400, 400, true);
        }


        /**
         *
         */
        protected function _navigation_init()
        {
            register_nav_menu('primary', __('Menu Primary', 'tc-starter-theme'));
        }
    }
}
