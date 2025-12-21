<?php
session_start();
require __DIR__ . '/includes/DatabaseConnection.php';

if (empty($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

$reviewID = (int)($_POST['reviewID'] ?? 0);
if ($reviewID <= 0) {
  header('Location: reviews.php');
  exit;
}

$userId  = (int)$_SESSION['user']['id'];
$isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');

$stmt = $pdo->prepare("SELECT user_id FROM reviews WHERE reviewID = ?");
$stmt->execute([$reviewID]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
  header('Location: reviews.php');
  exit;
}

$ownerId = (int)($row['user_id'] ?? 0);

if (!$isAdmin && $ownerId !== $userId) {
  $_SESSION['review_error'] = 'You can only delete your own review.';
  header('Location: reviews.php');
  exit;
}

$stmt = $pdo->prepare("DELETE FROM reviews WHERE reviewID = ?");
$stmt->execute([$reviewID]);

$_SESSION['review_success'] = 'Review deleted.';
header('Location: reviews.php');
exit;