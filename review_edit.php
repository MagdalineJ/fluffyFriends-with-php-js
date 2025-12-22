<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/DatabaseConnection.php';

if (empty($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

$reviewID = (int)($_GET['id'] ?? ($_POST['reviewID'] ?? 0));
if ($reviewID <= 0) {
  header('Location: reviews.php');
  exit;
}

$userId  = (int)$_SESSION['user']['id'];
$isAdmin = (($_SESSION['user']['role'] ?? '') === 'admin');

$breedMap = [1 => 'Dog', 2 => 'Cat', 3 => 'Rabbit'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name    = trim($_POST['name'] ?? '');
  $review  = trim($_POST['review'] ?? '');
  $rating  = (int)($_POST['rating'] ?? 0);
  $breedID = (int)($_POST['breedID'] ?? 0);

  $errors = [];
  if ($name === '') $errors[] = 'Name is required.';
  if ($review === '') $errors[] = 'Review is required.';
  if ($rating < 1 || $rating > 5) $errors[] = 'Rating must be 1–5.';
  if (!in_array($breedID, [1,2,3], true)) $errors[] = 'Choose a valid breed.';

  // Check ownership (or admin)
  $stmt = $pdo->prepare("SELECT user_id FROM reviews WHERE reviewID = ?");
  $stmt->execute([$reviewID]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    header('Location: reviews.php');
    exit;
  }

  $ownerId = (int)($row['user_id'] ?? 0);
  if (!$isAdmin && $ownerId !== $userId) {
    $_SESSION['review_error'] = 'You can only edit your own review.';
    header('Location: reviews.php');
    exit;
  }

  if ($errors) {
    $error = implode(' ', $errors);

    // re-render form with posted values
    $existing = [
      'reviewID' => $reviewID,
      'name' => $name,
      'review' => $review,
      'rating' => $rating,
      'breedID' => $breedID
    ];
  } else {
    $stmt = $pdo->prepare("
      UPDATE reviews
      SET name = ?, review = ?, rating = ?, breedID = ?
      WHERE reviewID = ?
    ");
    $stmt->execute([$name, $review, $rating, $breedID, $reviewID]);

    $_SESSION['review_success'] = 'Review updated.';
    header('Location: reviews.php');
    exit;
  }

} else {
  // GET: load existing
  $stmt = $pdo->prepare("
    SELECT reviewID, name, review, rating, breedID, user_id
    FROM reviews
    WHERE reviewID = ?
  ");
  $stmt->execute([$reviewID]);
  $existing = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$existing) {
    header('Location: reviews.php');
    exit;
  }

  $ownerId = (int)($existing['user_id'] ?? 0);
  if (!$isAdmin && $ownerId !== $userId) {
    $_SESSION['review_error'] = 'You can only edit your own review.';
    header('Location: reviews.php');
    exit;
  }
}

$title = 'Edit Review';
$layout = 'auth'; // optional: if you want only navbar+form (like login)

ob_start();
include __DIR__ . '/templates/review_edit.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';