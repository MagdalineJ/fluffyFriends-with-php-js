<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/adminOnly.php';
require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/includes/DatabaseFunctions.php';

$breeds = getBreeds($pdo);
$error  = $_SESSION['pet_error'] ?? '';
unset($_SESSION['pet_error']);

// ---------- SAVE (POST) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $petID     = (int)($_POST['petID'] ?? 0);   // 0 => add, >0 => edit
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
  if (!$errors && !breedExists($pdo, $breedID)) $errors[] = 'Selected category does not exist.';

  // if editing, make sure the pet exists
  if (!$errors && $petID > 0 && !petExists($pdo, $petID)) {
    $errors[] = 'Pet not found.';
  }

  if ($errors) {
    $_SESSION['pet_error'] = implode(' ', $errors);

    // redirect back to same form
    if ($petID > 0) {
      header("Location: admin_pet_form.php?id=$petID");
    } else {
      header("Location: admin_pet_form.php");
    }
    exit;
  }

  // SAVE: add or update
  if ($petID > 0) {
    updatePet($pdo, [
      'petID'     => $petID,
      'nickname'  => $nickname,
      'gender'    => $gender,
      'origin'    => $origin,
      'type'      => $type,
      'breedID'   => $breedID,
      'img'       => $img,
      'dateAdded' => $dateAdded,
    ]);
  } else {
    addPet($pdo, [
      'nickname'  => $nickname,
      'gender'    => $gender,
      'origin'    => $origin,
      'type'      => $type,
      'breedID'   => $breedID,
      'img'       => $img,
      'dateAdded' => $dateAdded,
    ]);
  }

  header('Location: petlist.php');
  exit;
}

// ---------- SHOW FORM (GET) ----------
$id = (int)($_GET['id'] ?? 0);

// default values (ADD mode)
$pet = [
  'petID'     => 0,
  'nickname'  => '',
  'gender'    => 'Male',
  'origin'    => '',
  'type'      => '',
  'breedID'   => $breeds[0]['breedID'] ?? 0,
  'img'       => '',
  'dateAdded' => date('Y-m-d'),
];

$mode = 'add';
$title = 'Admin: Add Pet';

if ($id > 0) {
  $dbPet = getPetById($pdo, $id);
  if (!$dbPet) {
    $_SESSION['pet_error'] = 'Pet not found.';
    header('Location: petlist.php');
    exit;
  }
  $pet = $dbPet;
  $mode = 'edit';
  $title = 'Admin: Edit Pet';
}

ob_start();
include __DIR__ . '/templates/adminPetForm.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';