<?php

/**
 * @var \Core\View\ViewInterface $view
 * @var array $plant
 */
?>

<a href="/plants/<?= htmlspecialchars($plant['id']) ?>"
  class="plant-card">
  <div class="plant-card__left">
    <div class="plant-card__img">
      <img src="<?= htmlspecialchars($plant['img']) ?>" alt="plant img" width="90">
    </div>

    <div class="plant-card__text">
      <p class="plant-card__name"><?= htmlspecialchars($plant['name']) ?></p>

      <div class="plant-card__title-wrapper">
        <h3 class="plant-card__title">
          <?= htmlspecialchars($plant['title']) ?>
        </h3>

        <p class="plant-card__description">
          <?php
          $words = explode(' ', $plant['description']);
          if (count($words) > 10) {
            echo htmlspecialchars(implode(' ', array_slice($words, 0, 10)) . '...');
          } else {
            echo htmlspecialchars($plant['description']);
          }
          ?>
        </p>
      </div>
    </div>
  </div>

  <div class="plant-card__right">
    <h3 class="plant-card__price">$<?= htmlspecialchars($plant['price']) ?></h3>
  </div>
</a>