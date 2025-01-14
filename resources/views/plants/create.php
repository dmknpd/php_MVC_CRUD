<?php

/**
 * @var \Core\View\View $view
 */
?>

<?php $view->component('header') ?>

<h1 class="page-title">Create Plant</h1>

<div class="form-wrapper">
  <form action="/plants" method="POST" class="form">

    <!-- Title -->
    <div class="form__input-group">
      <label for="title" class="form__label">Title</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="text" name="title" id="title"
            class="form__input"
            placeholder="Cactus" value="<?= htmlspecialchars($old['title'] ?? '') ?>" required>
        </div>

        <?php if (!empty($errors['title'])) : ?>
          <p class="form__error">
            <?= htmlspecialchars($errors['title']) ?>
          </p>
        <?php endif; ?>

      </div>
    </div>

    <!-- Description -->
    <!-- <div class="form__input-group">
      <label for="description" class="form__label">Description</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <textarea name="description" id="description"
            class="form__input"
            rows="5" placeholder="Lorem ipsum dolor sit amet..." required></textarea>
        </div>

        <?php if (!empty($errors['description'])) : ?>
          <p class="form__error">
            <?= htmlspecialchars($errors['description']) ?>
          </p>
        <?php endif; ?>
      </div>
    </div> -->

    <!-- Price -->
    <!-- <div class="form__input-group">
      <label for="price" class="form__label">Price</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <div class="form__input-sign">$</div>
          <input type="number" name="price" id="price"
            class="form__input"
            placeholder="100" required>
        </div>

        <?php if (!empty($errors['price'])) : ?>
          <p class="form__error">
            <?= htmlspecialchars($errors['price']) ?>
          </p>
        <?php endif; ?>

      </div>
    </div> -->

    <!-- Image URL -->
    <!-- <div class="form__input-group">
      <label for="img" class="form__label">Image URL</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="text" name="img" id="img"
            class="form__input"
            placeholder="https://whateveruwant.com" required>
        </div>

        <?php if (!empty($errors['img'])) : ?>
          <p class="form__errors">
            <?= htmlspecialchars($errors['img']) ?>
          </p>
        <?php endif; ?>

      </div>
    </div> -->

    <!-- Submit -->
    <div class="form__button-container">
      <button type="submit"
        class="form__button">
        Add plant
      </button>
    </div>

  </form>
</div>
</body>

<?php $view->component('footer') ?>