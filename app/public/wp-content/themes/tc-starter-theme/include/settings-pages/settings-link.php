<?php
add_action('cmb2_admin_init', 'tc_impostazioni_link');
function tc_impostazioni_link()
{

    $prefix = \tc\Theme\tcStarterTheme::TC_THEME_PREFIX . '_links';
    $cmb = new_cmb2_box(array(
        'id' => \tc\Theme\tcStarterTheme::TC_THEME_PREFIX . '_theme_settings_links',
        'title' => 'TC Link',
        'object_types' => array('options-page'),
        'context' => 'normal',
        'capability' => 'edit_posts',
        'parent_slug' => 'options-general.php',
        'priority' => 'high',
        'option_key' => \tc\Theme\tcStarterTheme::TC_THEME_PREFIX . '_theme_settings_links', // The option key and admin menu page slug.
    ));
    $cmb->add_field(array(
        'name' => 'Link Generici',
        'id' => $prefix . '_generici_title',
        'type' => 'title',
    ));

    $cmb->add_field(array(
        'name' => 'Pagina privacy policy',
        'id' => $prefix . '_privacy_page',
        'type' => 'tc_ajax_search',
        'post_type' => 'page',
    ));
    $cmb->add_field(array(
        'name' => 'Pagina cookie policy',
        'id' => $prefix . '_cookie_page',
        'type' => 'tc_ajax_search',
        'post_type' => 'page',
    ));

    $cmb->add_field(array(
        'name' => 'Pagina contatti',
        'id' => $prefix . '_contacts_page',
        'type' => 'tc_ajax_search',
        'post_type' => 'page',
    ));

}
