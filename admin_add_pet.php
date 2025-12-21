<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/adminOnly.php';

require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/includes/DatabaseFunctions.php';

$title = 'Admin: Add Pet';

$breeds = getBreeds($pdo);

$error = $_SESSION['pet_error'] ?? '';
unset($_SESSION['pet_error']);

ob_start();
include __DIR__ . '/templates/adminAddPet.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';