<h2 class="m-4">Request a Quote</h2>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger m-3">
    <ul class="mb-0">
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" action="sendquote.php" class="m-3">

  <label class="form-label" for="email">Your Email:</label>
  <input
    id="email"
    type="email"
    name="email"
    class="form-control mb-3"
    value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
    required
  >

  <label class="form-label" for="pets">Selected Pets:</label>
  <!-- <textarea id="pets" class="form-control mb-3" rows="5" readonly><?php foreach ($petsInCart as $pet): ?>
<?= htmlspecialchars($pet['nickname'], ENT_QUOTES, 'UTF-8') ?> (x<?= (int)$pet['quantity'] ?>)
<?php endforeach; ?></textarea> -->

<!-- ----------------- -->
<textarea id="pets" class="form-control mb-3" rows="5" readonly>
<?php if (empty($petsInCart)): ?>
Nothing selected
<?php else: ?>
<?php foreach ($petsInCart as $pet): ?>
<?= htmlspecialchars($pet['nickname'], ENT_QUOTES, 'UTF-8') ?> (x<?= (int)$pet['quantity'] ?>)
<?php endforeach; ?>
<?php endif; ?>
</textarea>
<!-- ----------------- -->


  <label class="form-label" for="message">Message:</label>
  <textarea
    id="message"
    name="message"
    class="form-control mb-3"
    rows="4"
    required
  ><?= htmlspecialchars($old['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

 <button
  type="submit"
  class="btn btn-danger"
  <?= empty($petsInCart) ? 'disabled' : '' ?>
>
  Proceed with Quote
</button>
<?php if (empty($petsInCart)): ?>
  <p class="text-muted mt-2">
    Please select at least one pet on New Friends before requesting a quote.
  </p>
<?php endif; ?>
</form>