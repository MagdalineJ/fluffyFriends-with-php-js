<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$data = $_SESSION['quote_success'] ?? null;
if (!$data) {
  header('Location: quote.php');
  exit;
}
unset($_SESSION['quote_success']);

$title = 'Quote Sent';

ob_start();
?>
<div class="container text-center" style="margin-top:120px;" >
  <h2 class="text-success">Quote Sent Successfully!</h2>
  <p>Quote ID: <strong><?= (int)$data['quote_id'] ?></strong></p>
  <p>Confirmation sent to <strong><?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') ?></strong></p>
  <a href="petlist.php" class="btn btn-primary mt-3">Back to Pets</a>
</div>
<?php
$output = ob_get_clean();

include __DIR__ . '/templates/homepage.html.php';