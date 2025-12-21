<?php 
include 'includes/bootstrap.php';

$title = 'Fluffy Friends';
ob_start();
$output = ob_get_clean();
include 'templates/homepage.html.php';


?>