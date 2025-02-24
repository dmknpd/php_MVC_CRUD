<?php

/**
 * @var \Core\View\ViewInterface $view
 * @var \Core\Session\SessionInterface $session
 * @var \Core\Auth\AuthInterface $auth
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Green</title>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>

  <nav class="nav">
    <a class="nav__link" href="/">logo</a>

    <div class="nav__group">
      <a class="nav__link" href="/">Plants</a>
      <a class="nav__link" href="/">Seeds</a>
      <a class="nav__link" href="/">Contacts</a>
    </div>

    <?php if ($auth->check()) : ?>
      <div class="nav__auth">
        <a class="nav__link" href="/plants/create">Add plant</a>
        <form action="/logout" method="POST">
          <button type="submit" class="nav__link logout" href="/register">Log Out</button>
        </form>
      </div>
    <?php else: ?>
      <div class="nav__auth">
        <a class="nav__link" href="/login">Log In</a>
        <a class="nav__link" href="/register">Sign In</a>
      </div>
    <?php endif; ?>

  </nav>

  <main>