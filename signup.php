<?php
session_start();
require __DIR__ . '/includes/DatabaseConnection.php';

$error = '';
$old = ['name'=>'', 'email'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $old['name'] = $name;
  $old['email'] = $email;

  if ($name === '') {
    $error = 'Name is required';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Valid email required';
  } elseif (strlen($password) < 6) {
    $error = 'Password must be at least 6 characters';
  } else {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetchColumn() > 0) {
      $error = 'Email already registered';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("
        INSERT INTO users (name, email, password_hash)
        VALUES (?, ?, ?)
      ");
      $stmt->execute([$name, $email, $hash]);

      $_SESSION['user'] = [
        'id' => (int)$pdo->lastInsertId(),
        'name' => $name,
        'email' => $email,
        'role' => 'user'
      ];

      header('Location: index.php');
      exit;
    }
  }
}

$title = 'Sign Up';
$layout = 'auth'; // hiding everything else in homepage

ob_start();
include __DIR__ . '/templates/signup.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';