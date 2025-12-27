 <div class="row m-5">
  <div class="col-md-6 mt-5">
    <h2 class="text-success" onclick="window.location.href='reviews.php'">Reviews</h2>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (empty($reviews)): ?>
      <p>No reviews yet.</p>
    <?php else: ?>
      <?php foreach ($reviews as $r): ?>
  
        <div class="card w-100 mb-3 shadow-sm">
          <div class="card-body">
            <h5><?= htmlspecialchars($r['name']) ?></h5>
            <p class="text-muted">
              <?= $breedMap[$r['breedID']] ?? 'Unknown' ?> owner 
            </p>
            <p class="text-start text-md-center mb-2 text-break"><?= nl2br(htmlspecialchars($r['review'])) ?></p>
            <div class="rating" data-rating="<?= (int)$r['rating'] ?>"></div>

                  <!-- delete review features -->
        <?php
          $isLoggedIn = !empty($_SESSION['user']);
          $isAdmin = $isLoggedIn && ($_SESSION['user']['role'] === 'admin');
          $isOwner = $isLoggedIn && ((int)$r['user_id'] === (int)$_SESSION['user']['id']);
        ?>

        <?php if ($isAdmin || $isOwner): ?>
          <form method="post" action="deleteReview.php" onsubmit="return confirm('Delete this review?');">
          <input type="hidden" name="reviewID" value="<?= (int)$r['reviewID'] ?>">
          <button class="btn btn-outline-danger btn-sm mt-2"><i class="fa-solid fa-trash"></i> Delete</button>
          </form>
        <?php endif; ?>

                  <!-- edit review features -->
        <?php if ($isAdmin || $isOwner): ?>
          <a class="btn btn-outline-primary btn-sm mt-2"
            href="review_edit.php?id=<?= (int)$r['reviewID'] ?>">
            <i class="fa-solid fa-pen"></i> Edit
          </a>
        <?php endif; ?>         


        <!-- ----------------------- -->
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="col-md-6 mt-5 border-start ">
    <h2 class="text-success">Add a Review</h2>

    <form method="post" action="addReview.php">
      <div class="mb-3">
        <label>Your Name</label>
        <input type="text" name="name" label="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Your Review</label>
        <textarea name="review" label="written review" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label>Pet Breed</label>
        <select name="breedID" label="breeds category" class="form-select" required>
          <option value="">Select breed</option>
          <option value="1">Dog</option>
          <option value="2">Cat</option>
          <option value="3">Rabbit</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Rating</label>
        <select name="rating"  label="rating category" class="form-select" required>
          <option value="">Select rating</option>
          <option value="1">1 ★</option>
          <option value="2">2 ★★</option>
          <option value="3">3 ★★★</option>
          <option value="4">4 ★★★★</option>
          <option value="5">5 ★★★★★</option>
        </select>
      </div>

      <button class="btn btn-success w-50">Submit Review</button>
    </form>
  </div>
</div>

