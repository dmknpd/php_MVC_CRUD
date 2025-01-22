<?php

/**
 * @var \Core\View\ViewInterface $view
 * @var \Core\Session\SessionInterface $session
 */
?>

<?php $view->component('header') ?>


<h1 class="page-title">Register New User</h1>

<div class="form-wrapper">
  <form action="/register" method="POST" class="form">

    <!-- Name -->
    <div class="form__input-group">
      <label for="title" class="form__label">Name</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="text" name="name" id="name"
            class="form__input"
            placeholder="John" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
        </div>

        <?php if ($session->has('name')) : ?>

          <ul class="form__errors-list">
            <?php foreach ($session->getFlash('name') as $error): ?>
              <li class="form__error">
                <?= $error ?>
              </li>
            <?php endforeach; ?>

          </ul>
        <?php endif; ?>

      </div>
    </div>

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

        <?php if ($session->has('email')) : ?>

          <ul class="form__errors-list">
            <?php foreach ($session->getFlash('email') as $error): ?>
              <li class="form__error">
                <?= $error ?>
              </li>
            <?php endforeach; ?>

          </ul>
        <?php endif; ?>

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

        <?php if ($session->has('password')) : ?>

          <ul class="form__errors-list">
            <?php foreach ($session->getFlash('password') as $error): ?>
              <li class="form__error">
                <?= $error ?>
              </li>
            <?php endforeach; ?>

          </ul>
        <?php endif; ?>

      </div>
    </div>

    <!-- Password -->
    <div class="form__input-group">
      <label for="title" class="form__label">Password Confirmation</label>
      <div class="form__input-wrapper">
        <div
          class="form__input-container">
          <input type="password" name="password_confirmation" id="password_confirmation"
            class="form__input"
            value="<?= htmlspecialchars($old['password_confirmation'] ?? '') ?>" required>
        </div>

        <?php if ($session->has('password')) : ?>

          <ul class="form__errors-list">
            <?php foreach ($session->getFlash('password_confirmation') as $error): ?>
              <li class="form__error">
                <?= $error ?>
              </li>
            <?php endforeach; ?>

          </ul>
        <?php endif; ?>

      </div>
    </div>


    <!-- Submit -->
    <div class="form__button-container">
      <button type="submit"
        class="form__button">
        Register
      </button>
    </div>

  </form>
</div>
</body>

<?php $view->component('footer') ?>