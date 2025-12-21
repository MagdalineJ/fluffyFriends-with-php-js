<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/bootstrap.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: quote.php');
  exit;
}

$email   = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$cart    = $_SESSION['cart'] ?? [];

$errors = [];
$old = ['email' => $email, 'message' => $message];

if ($email === '') $errors[] = 'Email is required.';
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address.';
if ($message === '') $errors[] = 'Message is required.';
if (empty($cart)) $errors[] = 'Cart is empty.';

if ($errors) {
  // rebuild cart pets for re-render
  $cartIds = array_keys($cart);
  $petsInCart = [];
  if (!empty($cartIds)) {
    $ph = implode(',', array_fill(0, count($cartIds), '?'));
    $stmt = $pdo->prepare("SELECT petID, nickname FROM pets WHERE petID IN ($ph)");
    $stmt->execute($cartIds);
    foreach ($stmt->fetchAll() as $row) {
      $row['quantity'] = (int)$cart[(int)$row['petID']];
      $petsInCart[] = $row;
    }
  }

  $title = 'Request a Quote';
  ob_start();
  include __DIR__ . '/templates/quote.html.php';
  $output = ob_get_clean();
  include __DIR__ . '/templates/homepage.html.php';
  exit;
}

function makeMailer(): PHPMailer {
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host       = $_ENV['MAIL_HOST'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $_ENV['MAIL_USER'];
  $mail->Password   = $_ENV['MAIL_PASS'];
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = (int)$_ENV['MAIL_PORT'];
  return $mail;
}

try {
  // 1) Save to DB
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("
    INSERT INTO quote_request (requester_email, requester_message)
    VALUES (?, ?)
  ");
  $stmt->execute([$email, $message]);
  $quoteId = (int)$pdo->lastInsertId();

  $stmtItem = $pdo->prepare("
    INSERT INTO quote_request_item (quote_id, petID, quantity)
    VALUES (?, ?, ?)
  ");
  foreach ($cart as $petID => $qty) {
    $stmtItem->execute([$quoteId, (int)$petID, (int)$qty]);
  }

  $pdo->commit();

  // 2) Email content
  $cartText = "";
  foreach ($cart as $petID => $qty) {
    $cartText .= "- Pet ID $petID (Qty: $qty)\n";
  }

  $fromEmail = $_ENV['MAIL_USER'];
  $fromName  = $_ENV['MAIL_FROM_NAME'] ?? 'Fluffy Friends';

  // 3) Admin email (to you)
  $admin = makeMailer();
  $admin->setFrom($fromEmail, $fromName);
  $admin->addAddress($fromEmail);
  $admin->addReplyTo($email);
  $admin->Subject = "New Quote Request (#$quoteId)";
  $admin->Body =
    "Quote ID: $quoteId\n\n" .
    "From: $email\n\n" .
    "Message:\n$message\n\n" .
    "Cart:\n$cartText";
  $admin->send();

  // 4) User confirmation
  $confirm = makeMailer();
  $confirm->setFrom($fromEmail, $fromName);
  $confirm->addAddress($email);
  $confirm->Subject = "Quote Request Received (#$quoteId)";
  $confirm->Body =
    "Thank you for your request.\n\n" .
    "Quote ID: $quoteId\n\n" .
    "We will contact you soon.";
  $confirm->send();

  // clear cart + redirect
  unset($_SESSION['cart']);
  $_SESSION['quote_success'] = ['quote_id' => $quoteId, 'email' => $email];

  header('Location: quoteSuccess.php');
  exit;

} catch (PDOException $e) {
  if ($pdo->inTransaction()) $pdo->rollBack();
  die('Database error: ' . $e->getMessage());
} catch (Exception $e) {
  if ($pdo->inTransaction()) $pdo->rollBack();
  die('Email error: ' . $e->getMessage());
}