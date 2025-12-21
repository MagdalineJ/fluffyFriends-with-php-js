<?php

require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/bootstrap.php';


$title = 'Reviews';

$stmt = $pdo->query("
  SELECT reviewID, name, review, rating, breedID, user_id
  FROM reviews
  ORDER BY reviewID DESC
");

$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$breedMap = [
  1 => 'Dog',
  2 => 'Cat',
  3 => 'Rabbit'
];

$success = $_SESSION['review_success'] ?? null;
$error   = $_SESSION['review_error'] ?? null;
unset($_SESSION['review_success'], $_SESSION['review_error']);

ob_start();
include __DIR__ . '/templates/review.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';