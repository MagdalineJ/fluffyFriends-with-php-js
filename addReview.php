<?php
session_start();

require __DIR__ . '/includes/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: reviews.php');
  exit;
}

$name    = trim($_POST['name'] ?? '');
$review  = trim($_POST['review'] ?? '');
$rating  = (int)($_POST['rating'] ?? 0);
$breedID = (int)($_POST['breedID'] ?? 0);

$errors = [];

if ($name === '') $errors[] = 'Name is required.';
if ($review === '') $errors[] = 'Review is required.';
if ($rating < 1 || $rating > 5) $errors[] = 'Rating must be between 1 and 5.';
if (!in_array($breedID, [1,2,3], true)) $errors[] = 'Please select a valid pet breed.';

if ($errors) {
  $_SESSION['review_error'] = implode(' ', $errors);
  header('Location: reviews.php');
  exit;
}

$userId = $_SESSION['user']['id'] ?? null;

$stmt = $pdo->prepare("
  INSERT INTO reviews (name, review, rating, breedID, user_id)
  VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$name, $review, $rating, $breedID, $userId]);

$_SESSION['review_success'] = 'Thank you! Your review has been submitted.';
header('Location: reviews.php');
exit;


