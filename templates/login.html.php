<div class="container " style="max-width:520px; margin-top:150px;">
  <h2 class="mb-4">Log In</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input
        type="email"
        name="email"
        class="form-control"
        value="<?= htmlspecialchars($oldEmail ?? '', ENT_QUOTES, 'UTF-8') ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input
        type="password"
        name="password"
        class="form-control"
        required
      >
    </div>

    <button class="btn btn-warning w-100">Log In</button>

    <p class="mt-3 text-center">
      Don’t have an account?
      <a href="signup.php">Sign up</a>
    </p>
  </form>
</div>