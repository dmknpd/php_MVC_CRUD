<?php

/**
 * @var \Core\View\ViewInterface $view
 */

?>

<?php $view->component('header') ?>

<h1 class="page-title">Plants list</h1>

<ul class="plant-list">

  <?php foreach ($plants as $plant): ?>
    <?php $view->component('plant-card', ['plant' => $plant]) ?>
  <?php endforeach; ?>

</ul>

<?php $view->component('footer') ?>