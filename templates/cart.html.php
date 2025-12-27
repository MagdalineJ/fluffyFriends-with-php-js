<div class="container my-4 text-center" id="cart" data-cart>
  <h2 class="mb-4">Your Cart</h2>

  <div id="cart-error" class="alert alert-danger d-none" role="alert"></div>

  <?php if (empty($petsInCart)): ?>
    <div class="text-center text-muted my-5">
      <h5>Your cart is empty 😿</h5>
    </div>
  <?php else: ?>

    <?php foreach ($petsInCart as $pet): ?>
      <div class="card  mb-5 mcol-auto shadow-sm" data-cart-item="<?= (int)$pet['petID'] ?>">
        <div class="card-body ">
          <h5><?= htmlspecialchars($pet['nickname'], ENT_QUOTES, 'UTF-8') ?></h5>

          <p class="mb-1">
            Type: <?= htmlspecialchars($pet['type'], ENT_QUOTES, 'UTF-8') ?><br>
            Gender: <?= htmlspecialchars($pet['gender'], ENT_QUOTES, 'UTF-8') ?>
          </p>

          <p class="mt-2 mb-0">
            <strong>Quantity:</strong><br>

            <!-- − button -->
            <form method="post" action="/fluffyfriends/cartActions.php" class="cart-form d-inline">
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">
              <input type="hidden" name="amount" value="-1">
              <button class="btn btn-sm btn-outline-secondary" type="submit">−</button>
            </form>

            <span class="mx-2 fw-bold"><?= (int)$pet['quantity'] ?></span>

            <!-- + button -->
            <form method="post" action="/fluffyfriends/cartActions.php" class="cart-form d-inline">
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">
              <input type="hidden" name="amount" value="1">
              <button class="btn btn-sm btn-outline-secondary" type="submit">+</button>
            </form>
          </p>

          <!-- Remove -->
          <form method="post" action="/fluffyfriends/cartActions.php" class="cart-form mt-2">
            <input type="hidden" name="action" value="remove">
            <input type="hidden" name="petID" value="<?= (int)$pet['petID'] ?>">
            <button class="btn btn-danger btn-sm" type="submit">Remove</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="mt-4 fs-5 fw-bold" data-cart-total>
      Total Pets in Cart: <?= (int)$totalQty ?>
    </div>

    <form method="get" action="quote.php">
  <button class="btn btn-success mt-3">Get a Quote</button>
</form>

    <!-- Clear cart -->
    <form method="post" action="/fluffyfriends/cartActions.php" class="cart-form mt-3">
      <input type="hidden" name="action" value="clear">
      <button class="btn btn-danger" type="submit">Clear Cart</button>
    </form>

  <?php endif; ?>
</div>