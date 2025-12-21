<div class="container" style="max-width: 850px; margin-top:150px;">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h2 class="text-success mb-0">Admin: Add Pet</h2>
    <a href="petlist.php" class="btn btn-outline-secondary btn-sm">
      ← Back to Pet List
    </a>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-body">
   <form method="post" action="/fluffyfriends/admin_save_added_pet.php" class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Nickname</label>
          <input type="text" name="nickname" class="form-control" placeholder="e.g., Milo" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="">Select gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Origin</label>
          <input type="text" name="origin" class="form-control" placeholder="e.g., London" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Type</label>
          <input type="text" name="type" class="form-control" placeholder="e.g., Golden Retriever" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Category</label>
          <select name="breedID" class="form-select" required>
            <option value="">Select category</option>
            <?php foreach ($breeds as $b): ?>
              <option value="<?= (int)$b['breedID'] ?>">
                <?= htmlspecialchars($b['pet'], ENT_QUOTES, 'UTF-8') ?>
              </option>
            <?php endforeach; ?>
          </select>
          <div class="form-text">This comes from your <code>breed</code> table.</div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Image filename (DB value)</label>
          <input type="text" name="img" class="form-control" placeholder="e.g., dog1.jpg" required>
          <div class="form-text">Make sure the file exists in your pets image folder.</div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Date Added</label>
          <input type="date" name="dateAdded" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="col-12 pt-2">
          <button type="submit" class="btn btn-success w-100">
            Save Pet
          </button>
        </div>

      </form>
    </div>
  </div>
</div>