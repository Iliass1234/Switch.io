<?php
/**
 * Plugin name: TC CMB2 AJAX search
 * Description: Integrazione a CMB2 per permettere la ricerca di elementi del DB tramite AJAX
 * Author: PRAGMA
 * Author Uri: https://www.pragmawebagency.it/
 * Version: 1.0.3
 */


define('TC_AJAX_SEARCH_VERSION', '1.0.3');
define('TC_AJAX_SEARCH_BASE_PATH', plugin_dir_path(__FILE__));
define('TC_AJAX_SEARCH_BASE_URL', plugin_dir_url(__FILE__));

require TC_AJAX_SEARCH_BASE_PATH . 'inc/tcAjaxSearch.php';

add_action('init', ['tcAjaxSearch', 'init']);
if (function_exists('tcum_add_support')) {

    tcum_add_support(__FILE__);
} else {

    add_action('plugins_loaded', function () {
        if (function_exists('tcum_add_support')) {

            tcum_add_support(__FILE__);
        }

    });
}


