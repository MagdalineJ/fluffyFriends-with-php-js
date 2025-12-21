<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/adminOnly.php';

require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/includes/DatabaseFunctions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: admin_add_pet.php');
  exit;
}

$nickname  = trim($_POST['nickname'] ?? '');
$gender    = trim($_POST['gender'] ?? '');
$origin    = trim($_POST['origin'] ?? '');
$type      = trim($_POST['type'] ?? '');
$breedID   = (int)($_POST['breedID'] ?? 0);
$img       = trim($_POST['img'] ?? '');
$dateAdded = trim($_POST['dateAdded'] ?? '');

$errors = [];
if ($nickname === '') $errors[] = 'Nickname is required.';
if (!in_array($gender, ['Male', 'Female'], true)) $errors[] = 'Gender must be Male or Female.';
if ($origin === '') $errors[] = 'Origin is required.';
if ($type === '') $errors[] = 'Type is required.';
if ($breedID <= 0) $errors[] = 'Please select a valid category.';
if ($img === '') $errors[] = 'Image filename is required.';
if ($dateAdded === '') $errors[] = 'Date Added is required.';

if (!$errors && !breedExists($pdo, $breedID)) {
  $errors[] = 'Selected category does not exist.';
}

if ($errors) {
  $_SESSION['pet_error'] = implode(' ', $errors);
  header('Location: admin_add_pet.php');
  exit;
}

addPet($pdo, [
  'nickname'  => $nickname,
  'gender'    => $gender,
  'origin'    => $origin,
  'type'      => $type,
  'breedID'   => $breedID,
  'img'       => $img,
  'dateAdded' => $dateAdded,
]);

header('Location: petlist.php');
exit;