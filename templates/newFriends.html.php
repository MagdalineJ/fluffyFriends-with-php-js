<h3 class="breeds">Dogs</h3>

<div class="breed-section">
  <div>
    <a class="btn btn-success prev breeds"
       href="?dog=<?= max(0, $dogIndex - 1) ?>">&lt;</a>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4 breed-container">
    <?php foreach (visiblePets($dogs, $dogIndex, $cardsPerPage) as $dog): ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($dog['img']) ?>" class="card-img-top">

          <div class="card-body">
            <h5><?= htmlspecialchars($dog['nickname']) ?></h5>
            <p>
              Type: <?= htmlspecialchars($dog['type']) ?><br>
              Gender: <?= htmlspecialchars($dog['gender']) ?><br>
              Origin: <?= htmlspecialchars($dog['origin']) ?>
            </p>
          </div>

          <div class="card-footer">
            <small>
              Added on <?= htmlspecialchars($dog['dateAdded']) ?>
              by <?= htmlspecialchars($dog['provider']) ?>
            </small>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div>
    <a class="btn btn-success next breeds"
       href="?dog=<?= min(count($dogs) - $cardsPerPage, $dogIndex + 1) ?>">&gt;</a>
  </div>
</div>


<h3 class="breeds">Cats</h3>

<div class="breed-section">
  <div>
    <a class="btn btn-success prev breeds"
       href="?dog=<?= max(0, $catIndex - 1) ?>">&lt;</a>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4 breed-container">
    <?php foreach (visiblePets($cats, $catIndex, $cardsPerPage) as $cat): ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($cat['img']) ?>" class="card-img-top">

          <div class="card-body">
            <h5><?= htmlspecialchars($cat['nickname']) ?></h5>
            <p>
              Type: <?= htmlspecialchars($cat['type']) ?><br>
              Gender: <?= htmlspecialchars($cat['gender']) ?><br>
              Origin: <?= htmlspecialchars($cat['origin']) ?>
            </p>
          </div>

          <div class="card-footer">
            <small>
              Added on <?= htmlspecialchars($cat['dateAdded']) ?>
              by <?= htmlspecialchars($cat['provider']) ?>
            </small>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div>
    <a class="btn btn-success next breeds"
       href="?cat=<?= min(count($cats) - $cardsPerPage, $catIndex + 1) ?>">&gt;</a>
  </div>
</div>
<h3 class="breeds">Rabbits</h3>

<div class="breed-section">
  <div>
    <a class="btn btn-success prev breeds"
       href="?dog=<?= max(0, $rabbitIndex - 1) ?>">&lt;</a>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4 breed-container">
    <?php foreach (visiblePets($rabbits, $rabbitIndex, $cardsPerPage) as $rabbit): ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($rabbit['img']) ?>" class="card-img-top">

          <div class="card-body">
            <h5><?= htmlspecialchars($rabbit['nickname']) ?></h5>
            <p>
              Type: <?= htmlspecialchars($rabbit['type']) ?><br>
              Gender: <?= htmlspecialchars($rabbit['gender']) ?><br>
              Origin: <?= htmlspecialchars($rabbit['origin']) ?>
            </p>
          </div>

          <div class="card-footer">
            <small>
              Added on <?= htmlspecialchars($rabbit['dateAdded']) ?>
              by <?= htmlspecialchars($rabbit['provider']) ?>
            </small>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div>
    <a class="btn btn-success next breeds"
       href="?rabbit=<?= min(count($rabbits) - $cardsPerPage, $rabbitIndex + 1) ?>">&gt;</a>
  </div>
</div>
