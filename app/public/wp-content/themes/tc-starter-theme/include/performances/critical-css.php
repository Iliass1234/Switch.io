<?php
$cssPath = get_template_directory() . '/assets/css/';
$bootstrap = $cssPath . 'vendors/bootstrap.min.css';
$themeCritical = $cssPath . 'themeCritical.min.css';
?>

<style><?php echo file_get_contents($bootstrap) ?></style>
<style><?php echo file_get_contents($themeCritical) ?></style>