<?php


require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/bootstrap.php';


$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
  die('Cart is empty. Add pets first.');
}

$errors = [];
$old = [];

$cartIds = array_keys($cart);
$petsInCart = [];

$placeholders = implode(',', array_fill(0, count($cartIds), '?'));
$stmt = $pdo->prepare("SELECT petID, nickname FROM pets WHERE petID IN ($placeholders)");
$stmt->execute($cartIds);

foreach ($stmt->fetchAll() as $row) {
  $row['quantity'] = (int)$cart[(int)$row['petID']];
  $petsInCart[] = $row;
}

$title = 'Request a Quote';

ob_start();
include __DIR__ . '/templates/quote.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';