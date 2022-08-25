<?php
require_once($routeController->getController("SessionController"));
$activeSession = SessionController::activeSession();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $routeController->getRoute("index"); ?>">NETFLIX</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
    <?php //if($activeSession) :?>
    <?php if ($activeSession) { ?>
        <li class="d-flex align-items-center">
          <a class="nav-link" href="<?= $routeController->getRoute("logout"); ?>">Logout</a>
        </li>
        
        <li class="d-flex align-items-center">
        <a class="nav-link" href="<?= $routeController->getRoute("film"); ?>">Films</a>
        </li>
        <li class="d-flex align-items-center fw_bolder">
            <div class="user">Bonjour <?= $_SESSION['user']['login'] ?></div>
        </li>
    <?php //else :?>
    <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $routeController->getRoute("registration"); ?>">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $routeController->getRoute("login"); ?>">Login</a>
        </li>
    <?php //endif?>
    <?php } ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>