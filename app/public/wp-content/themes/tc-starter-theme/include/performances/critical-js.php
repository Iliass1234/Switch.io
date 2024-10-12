<?php
$jsPath = get_template_directory() . '/assets/js/';
$themeCritical = $jsPath . 'themeCritical.min.js';
?>

    <script type="text/javascript"><?php echo file_get_contents($themeCritical) ?></script>