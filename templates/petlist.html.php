<div class="container mt-5">

  <h2 class="text-center text-success fw-bold" style="margin-top:100px;">
    Choose a pet or two
  </h2>

  <!-- Admin: Add Pet -->
  <?php if (!empty($isAdmin)): ?>
    <div class="d-flex justify-content-end mb-3">
      <a href="admin_pet_form.php" class="btn fw-bold btn-outline-success btn-sm">
        <i class="fa-solid fa-plus"></i> Add Pet
      </a>
    </div>
  <?php endif; ?>

  <?php if (empty($pets)): ?>
    <p class="text-muted text-center">No pets available.</p>
  <?php else: ?>

    <!-- Prev/Next wrapper -->
    <div class="d-flex align-items-center gap-2">

      <button class="btn btn-success prev" type="button">&lt;</button>

      <div class="row row-cols-1 row-cols-md-3 g-4 flex-grow-1" id="pets-container">

        <?php foreach ($pets as $pet): ?>
          <div class="col pet-card">
            <div class="card h-100 shadow-sm">

              <img
                src="pic/pets/<?= htmlspecialchars($pet['img'], ENT_QUOTES, 'UTF-8') ?>"
                class="card-img-top"
                style="width:100%; height:350px; object-fit:cover;"
                alt="<?= htmlspecialchars($pet['nickname'], ENT_QUOTES, 'UTF-8') ?>"
              >

              <div class="card-body d-flex flex-column">

                <h5 class="card-title">
                  <?= htmlspecialchars($pet['nickname'], ENT_QUOTES, 'UTF-8') ?>
                </h5>

                <p class="card-text mb-2">
                  <strong>Type:</strong> <?= htmlspecialchars($pet['type'], ENT_QUOTES, 'UTF-8') ?><br>
                  <strong>Gender:</strong> <?= htmlspecialchars($pet['gender'], ENT_QUOTES, 'UTF-8') ?><br>
                  <strong>Origin:</strong> <?= htmlspecialchars($pet['origin'], ENT_QUOTES, 'UTF-8') ?><br>
                  <strong>Category:</strong> <?= htmlspecialchars($pet['category'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <!-- Add to cart -->
                <form method="post" action="cartActions.php" class="mt-auto">
                  <input type="hidden" name="action" value="add">
                  <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary w-50">
                      Add to Cart
                    </button>
                  </div>
                </form>

                <!-- Admin: Delete Pet -->
                <?php if (!empty($isAdmin)): ?>
                  <form method="post"
                        action="admin_delete_pet.php"
                        class="mt-2"
                        onsubmit="return confirm('Are you sure you want to delete this pet?');">

                    <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">

                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-outline-danger btn-sm w-50">
                        <i class="fa-solid fa-trash"></i> Delete Pet
                      </button>
                    </div>
                  </form>
                <?php endif; ?>

                <!-- Admin: Edit Pet -->
                <?php if (!empty($isAdmin)): ?>
                  <a class="btn btn-outline-success btn-sm w-50 mt-2 mx-auto"
                    href="admin_pet_form.php?id=<?= (int)$pet['petID'] ?>" >
                    <i class="fa-solid fa-pen"></i> Edit Pet
                  </a>
                <?php endif; ?>

              </div>

              <div class="card-footer text-muted small">
                Added on <?= htmlspecialchars($pet['dateAdded'], ENT_QUOTES, 'UTF-8') ?>
              </div>

            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <button class="btn btn-success next" type="button">&gt;</button>
    </div>

  <?php endif; ?>
</div>

