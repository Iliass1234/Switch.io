<?php
add_action('cmb2_admin_init', 'cmb2tcHomeIntroMb');
add_action('cmb2_admin_init', 'cmb2tcHomeSezioneTeamMb');
add_action('cmb2_admin_init', 'cmb2tcHomeerviziMb');

function cmb2tcHomeIntroMb() {

    $idHome = get_option('page_on_front');
    $cmb = new_cmb2_box(array(
        'id' => 'tc_hero_home_mb',
        'title' => 'Intro',
        'object_types' => array('page',), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array($idHome)),
    ));

    $cmb->add_field(array(
        'name' => 'Titolo',
        'id' => 'tc_home_intro_titolo',
        'type' => 'text',
    ));
    $cmb->add_field(array(
        'name' => 'Descrizione',
        'id' => 'tc_home_intro_descrizione',
        'type' => 'wysiwyg',
        'options' => array(),
    ));
}
function cmb2tcHomeSezioneTeamMb() {

    $idHome = get_option('page_on_front');
    $cmb = new_cmb2_box(array(
        'id' => 'tc_home_sezione_team_mb',
        'title' => 'Sezione Team',
        'object_types' => array('page',), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array($idHome)),
    ));

    $cmb->add_field( array(
        'name' => 'Galleria',
        'id'   => 'tc_home_sezione_team_gallery',
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files"
            'remove_image_text' => 'Replacement', // default: "Remove Image"
            'file_text' => 'Replacement', // default: "File:"
            'file_download_text' => 'Replacement', // default: "Download"
            'remove_text' => 'Replacement', // default: "Remove"
        ),
    ) );
    $cmb->add_field(array(
        'name' => 'Descrizione parte 1',
        'id' => 'tc_home_sezione_team_descrizione1',
        'type' => 'wysiwyg',
        'options' => array(),
    ));
    $cmb->add_field(array(
        'name' => 'Descrizione parte 2',
        'id' => 'tc_home_sezione_team_descrizione2',
        'type' => 'wysiwyg',
        'options' => array(),
    ));
    $group_field_id = $cmb->add_field(array(
        'id' => 'tc_home_sezione_team_gruppo_fondatore',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Entry {#}', 'cmb2'),
            'sortable' => true,

        ),
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Immagine Fondatore',
        'id' => 'tc_home_sezione_team_img_fondatore',
        'type' => 'file',
        'query_args' => array(
            'type' => array(
                'image',

            ),
        ),
        'preview_size' => 'small',

    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Descrizione',
        'id' => 'tc_home_sezione_team_descrizione',
        'type' => 'wysiwyg',
        'options' => array(),
    ));

    $group_field_id = $cmb->add_field(array(
        'id' => 'tc_home_sezione_team_gruppo',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Entry {#}', 'cmb2'),
            'sortable' => true,

        ),
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Immagine',
        'id' => 'tc_home_sezione_team_img',
        'type' => 'file',
        'query_args' => array(
            'type' => array(
                'image',

            ),
        ),
        'preview_size' => 'small',

    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Titolo',
        'id' => 'tc_home_sezione_team_titolo',
        'type' => 'text',
        'repeatable' => true,
    ));
}
function cmb2tcHomeerviziMb() {

    $idHome = get_option('page_on_front');
    $cmb = new_cmb2_box(array(
        'id' => 'tc_home_sezione_servizi_mb',
        'title' => 'Sezione Servizi',
        'object_types' => array('page',), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
        'show_on' => array('key' => 'id', 'value' => array($idHome)),
    ));

    $group_field_id = $cmb->add_field(array(
        'id' => 'tc_home_sezione_servizi_gruppo',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Entry {#}', 'cmb2'),
            'sortable' => true,

        ),
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Titolo Servizio',
        'id' => 'tc_home_sezione_servizi_titolo1',
        'type' => 'text',
        'repeatable' => true,
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Titolo Secondario',
        'id' => 'tc_home_sezione_servizi_titolo2',
        'type' => 'text',
        'repeatable' => true,
    ));
    $cmb->add_group_field($group_field_id, array(
        'name' => 'Descrizione',
        'id' => 'tc_home_sezione_team_descrizione',
        'type' => 'wysiwyg',
        'options' => array(),
    ));

}