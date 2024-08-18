<!--========== SIDEBARNAV ==========-->
<div class="nav" id="navbar">
  <nav class="nav__container">
    <div>

      <span class="nav__logo">
        <img src="<?= pathname('images/logo.jpg') ?>" alt="Guidance Logo" class="rounded-circle" width="50">
      </span>
      <span class="nav__name nav__logo">
        <h5 class="nav__logo-name"> SMCC GUIDANCE</h5>
      </span>
      <hr>
      <div class="nav__list">
        <?php
        foreach (SIDEBAR_LINKS as $item) {
        ?>
        <div class="nav__items">
          <h3 class="nav__subtitle"><?= $item["title"] ?? '' ?></h3>

          <?php foreach (($item["children"] ?? []) as $navlinks) { ?>
            <a href="<?= $navlinks["href"] ?>" class="nav__link <?= PAGE_URI === $navlinks["href"] ? "active" : "" ?>" id="navhome">
              <i class="nav__icon <?= $navlinks['icon'] ?? '' ?>"></i>
              <span class="nav__name">Home</span>
            </a>
          <?php } ?>

          <?php if (!isset($item["children"]) && isset($item["label"]) && isset($item["href"])) { ?>
            <a href="<?= $navlinks["href"] ?>" class="nav__link <?= PAGE_URI === $navlinks["href"] ? "active" : "" ?>" id="navhome">
              <i class="nav__icon <?= $navlinks['icon'] ?? '' ?>"></i>
              <span class="nav__name">Home</span>
            </a>
          <?php } ?>

          <?php if (isset($item["divider"]) && $item["divider"]) { ?>
            <hr />
          <?php } ?>
        </div>

        <?php
        }
        ?>
      </div>
    </div>

    <a onclick="document.getElementById('logout').click()" href="#" class="nav__link nav__logout">
        <i class='bx bx-log-out nav__icon'></i>
        <span class="nav__name">Log Out</span>
    </a>
    <form class="d-none" action="<?= pathname('api/post/logout') ?>" method="post">
      <button id="logout" type="submit" class="d-none"></button>>
    </form>
  </nav>
</div>