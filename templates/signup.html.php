<div class="container" style="max-width:520px; margin-top:150px;">
  <h2 class="mb-4">Create Account</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input
        class="form-control"
        name="name"
        value="<?= htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8') ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        name="email"
        value="<?= htmlspecialchars($old['email'], ENT_QUOTES, 'UTF-8') ?>"
        required
      >
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        name="password"
        required
      >
    </div>

    <button class="btn btn-success w-100">Sign Up</button>

    <p class="mt-3 text-center">
      Already have an account?
      <a href="login.php">Log in</a>
    </p>
  </form>
</div>