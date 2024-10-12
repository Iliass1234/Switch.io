<?php
/**
 * @var $field_type_object ;
 * @var $field ;
 * @var $field_type ;
 * @var $escaped_value ;
 */

?>

<div class="tcAjaxSearch">
    <?php

    echo $field_type_object->input(
        [
            'type' => 'text',
            'class' => 'tcAjaxSearch__field regular-text',
            'name' => $field_type_object->_name("[display]"),
            'id' => $field_type_object->_id("_display"),
            'data-query' => $field->args['post_type'],
            'value' => $escaped_value['display'] ?? '',
            'desc' => null,

        ]
    );

    echo $field_type_object->input(
        [
            'type' => 'text',
            'name' => $field_type_object->_name("[value]"),
            'id' => $field_type_object->_id("_value"),
            'class' => 'tcAjaxSearch__field--value small-text',
            'readonly' => 'readonly',
            'value' => $escaped_value['value'] ?? '',
            'desc' => null,
        ]
    );
    ?>
    <div class="tcAjaxSearch__suggestions" style="display: none"></div>
</div>
<div>
<i>
    <?php echo      $field_type_object->field->args['desc']?>

</i>
</div>
