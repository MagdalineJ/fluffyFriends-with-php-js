<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/adminOnly.php';
require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: petlist.php');
  exit;
}

$petID = (int)($_POST['petID'] ?? 0);
if ($petID <= 0) {
  header('Location: petlist.php');
  exit;
}

deletePet($pdo, $petID);

header('Location: petlist.php');
exit;