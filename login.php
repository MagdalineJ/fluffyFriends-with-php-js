<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/DatabaseConnection.php';

$error = '';
$oldEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $oldEmail = $email;

  $stmt = $pdo->prepare("
    SELECT user_id, name, email, password_hash, role
    FROM users
    WHERE email = ?
  ");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user'] = [
      'id'    => (int)$user['user_id'],
      'name'  => $user['name'],
      'email' => $user['email'],
      'role'  => $user['role']
    ];
    header('Location: index.php');
    exit;
  } else {
    $error = 'Invalid email or password';
  }
}

$title = 'Login';
$layout = 'auth';          // to hide other sections in homepage

ob_start();
include __DIR__ . '/templates/login.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';