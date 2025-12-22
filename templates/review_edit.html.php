<div class="container" style="max-width: 650px; margin-top: 110px;">
  <h2 class="text-success mb-3">Edit Review</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" action="review_edit.php">
    <input type="hidden" name="reviewID" value="<?= (int)$existing['reviewID'] ?>">

    <div class="mb-3">
      <label class="form-label">Your Name</label>
      <input class="form-control" name="name" required
             value="<?= htmlspecialchars($existing['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Your Review</label>
      <textarea class="form-control" name="review" rows="4" required><?= htmlspecialchars($existing['review'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Pet Breed</label>
      <select name="breedID" class="form-select" required>
        <option value="1" <?= ((int)$existing['breedID']===1)?'selected':'' ?>>Dog</option>
        <option value="2" <?= ((int)$existing['breedID']===2)?'selected':'' ?>>Cat</option>
        <option value="3" <?= ((int)$existing['breedID']===3)?'selected':'' ?>>Rabbit</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Rating</label>
      <select name="rating" class="form-select" required>
        <?php for ($i=1;$i<=5;$i++): ?>
          <option value="<?= $i ?>" <?= ((int)$existing['rating']===$i)?'selected':'' ?>><?= $i ?></option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="d-flex  gap-2">
      <button class="btn btn-outline-success ms-auto">Save Changes</button>
      <a href="reviews.php" class="btn btn-outline-danger">Cancel</a>
    </div>
  </form>
</div>