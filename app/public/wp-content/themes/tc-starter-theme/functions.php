<?php
if (file_exists(get_template_directory() . '/include/CMB2/init.php')) {
    require_once get_template_directory() . '/include/CMB2/init.php';
}
require get_template_directory() . '/include/class-tc-starter-theme.php';
require get_template_directory() . '/include/class-customizer.php';
require get_template_directory() . '/include/class-wp-bootstrap-navwalker.php';
require get_template_directory() . '/include/filters.php';
require get_template_directory() . '/include/actions.php';
require get_template_directory() . '/include/functions.php';
require get_template_directory() . '/include/settings-pages/settings-link.php';
require get_template_directory() . '/include/metaboxes/home-mb.php';
require get_template_directory() . '/include/metaboxes/progetti-mb.php';


if (!defined('TC_STARTER_THEME_CHILD')) {
    add_action('init', [\tc\Theme\tcStarterTheme::class, 'init']);
}

global $tcThemeSettings__links;
$tcThemeSettings__links = get_option(\tc\Theme\tcStarterTheme::TC_THEME_PREFIX . '_theme_settings_links');
