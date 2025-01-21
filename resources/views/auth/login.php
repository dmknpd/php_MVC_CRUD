<?php

/**
 * @var \Core\View\View $view
 * @var \Core\Session\Session $session
 */
?>

<?php $view->component('header') ?>


<h1 class="page-title">Login User</h1>

<div class="form-wrapper">
  <form action="/login" method="POST" class="form">

    <!-- Email -->
    <div class="form__input-group">
      <label for="title" class="form__label">Email</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="email" name="email" id="email"
            class="form__input"
            placeholder="John@mail.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
        </div>
      </div>
    </div>

    <!-- Password -->
    <div class="form__input-group">
      <label for="title" class="form__label">Password</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="password" name="password" id="password"
            class="form__input"
            value="<?= htmlspecialchars($old['password'] ?? '') ?>" required>
        </div>
      </div>

      <?php if ($session->has('error')) : ?>
        <p class="form__error">
          <?= $session->getFlash('error') ?>
        </p>

      <?php endif; ?>

    </div>

    <!-- Submit -->
    <div class="form__button-container">
      <button type="submit"
        class="form__button">
        Login
      </button>
    </div>

  </form>
</div>
</body>

<?php $view->component('footer') ?>