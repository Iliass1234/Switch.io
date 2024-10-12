<?php
add_action('cmb2_admin_init', 'cmb2ProgettiMb');

function cmb2ProgettiMb()
{

    $cmbProgetti = new_cmb2_box(array(
        'id' => 'tc_progetti_mb',
        'title' => 'Progetto',
        'object_types' => array(\tc\Theme\tcStarterTheme::TC_PROGETTI_CPT_NAME),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ));
    $cmbProgetti->add_field( array(
        'name' => 'Galleria',
        'id'   => 'tc_progetti_gallery_mb',
        'type' => 'file_list',

        'text' => array(
            'add_upload_files_text' => 'Replacement',
            'remove_image_text' => 'Replacement',
            'file_text' => 'Replacement',
            'file_download_text' => 'Replacement',
            'remove_text' => 'Replacement',
        )
    ) );
    $group_field_id = $cmbProgetti->add_field(array(
        'id' => 'tc_progetti_gruppo_mb',
        'type' => 'group',
        'options' => array(
            'group_title' => __('Entry {#}', 'cmb2'),
            'sortable' => true,

        ),
    ));
    $cmbProgetti->add_group_field($group_field_id, array(
        'name' => 'Titolo',
        'id' => 'tc_progetti_titolo',
        'type' => 'text',
        'repeatable' => true,
    ));
    $cmbProgetti->add_group_field($group_field_id, array(
        'name' => 'Descrizione',
        'id' => 'tc_progetti_descrizione',
        'type' => 'wysiwyg',
        'options' => array(),
    ));


}