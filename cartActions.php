<?php
session_start();
include '/includes/DatabaseConnection.php';

$action = $_POST['action'] ?? '';
$petID  = isset($_POST['petID']) ? (int)$_POST['petID'] : 0;
$amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;

$_SESSION['cart'] = $_SESSION['cart'] ?? [];

switch ($action) {
  case 'add':
    if ($petID > 0) {
      $_SESSION['cart'][$petID] = ($_SESSION['cart'][$petID] ?? 0) + 1;
    }
    break;

  case 'update':
    if ($petID > 0 && isset($_SESSION['cart'][$petID])) {
      $_SESSION['cart'][$petID] += $amount;
      if ($_SESSION['cart'][$petID] <= 0) unset($_SESSION['cart'][$petID]);
    }
    break;

  case 'remove':
    if ($petID > 0) unset($_SESSION['cart'][$petID]);
    break;

  case 'clear':
    unset($_SESSION['cart']);
    break;
}

header('Location: petlist.php'); 
exit;