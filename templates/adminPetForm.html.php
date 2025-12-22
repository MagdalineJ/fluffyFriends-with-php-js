
<div class="container" style="max-width: 850px; margin-top:150px;">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h2 class="text-success mb-0">
      <?= ($mode === 'edit') ? 'Admin: Edit Pet' : 'Admin: Add Pet' ?>
    </h2>
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

      <form method="post" action="admin_pet_form.php" class="row g-3">
        <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">

        <div class="col-md-6">
          <label class="form-label">Nickname</label>
          <input type="text" name="nickname" class="form-control" required
                 value="<?= htmlspecialchars($pet['nickname'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select" required>
            <option value="Male" <?= (($pet['gender'] ?? '')==='Male')?'selected':'' ?>>Male</option>
            <option value="Female" <?= (($pet['gender'] ?? '')==='Female')?'selected':'' ?>>Female</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Origin</label>
          <input type="text" name="origin" class="form-control" required
                 value="<?= htmlspecialchars($pet['origin'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Type</label>
          <input type="text" name="type" class="form-control" required
                 value="<?= htmlspecialchars($pet['type'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label">Category</label>
          <select name="breedID" class="form-select" required>
            <option value="">Select category</option>
            <?php foreach ($breeds as $b): ?>
              <option value="<?= (int)$b['breedID'] ?>"
                <?= ((int)($pet['breedID'] ?? 0) === (int)$b['breedID']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($b['pet'], ENT_QUOTES, 'UTF-8') ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Image filename</label>
          <input type="text" name="img" class="form-control" required
                 value="<?= htmlspecialchars($pet['img'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
          <div class="form-text">Example: dog1.jpg (stored in pic/pets/)</div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Date Added</label>
          <input type="date" name="dateAdded" class="form-control" required
                 value="<?= htmlspecialchars(substr($pet['dateAdded'] ?? date('Y-m-d'), 0, 10), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="col-12 pt-2">
          <button type="submit" class="btn btn-success w-100">
            <?= ($mode === 'edit') ? 'Save Changes' : 'Save Pet' ?>
          </button>
        </div>
      </form>

    </div>
  </div>
</div>