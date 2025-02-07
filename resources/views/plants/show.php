<?php

/**
 * @var \Core\View\ViewInterface $view
 * @var \Core\Auth\AuthInterface $auth
 * @var array $plant
 */
?>

<?php $view->component('header') ?>

<h1 class="page-title plant-info__title">Plant Info</h1>

<div class="plant-info__wrapper">
  <div class="plant-info__img-wrapper">
    <img class="plant-info__img" src="<?= htmlspecialchars($plant['img']) ?>" alt="plant img">
  </div>
  <div class="plant-info__content">
    <div class="plant-info__text-wrapper">
      <h3 class="plant-info__text-title"><?= htmlspecialchars($plant['title']) ?></h3>
      <p class="plant-info__text"><?= htmlspecialchars($plant['description']) ?></p>
    </div>
    <div class="plant-info__bottom">
      <p class="plant-info__price">$<?= htmlspecialchars($plant['price']) ?></p>


      <?php if ($plant['seller_id'] === $auth->user()['id']) : ?>
        <div class="plant-info__buttons">
          <a class="plant-info__edit" href="/plants/<?= htmlspecialchars($plant['id']) ?>/edit">edit</a>
          <form action="/plants/<?= htmlspecialchars($plant['id']) ?>" method="POST">
            <button class="plant-info__delete">delete</button>
          </form>
        </div>
      <?php endif; ?>



    </div>
  </div>
</div>


<?php $view->component('footer') ?>