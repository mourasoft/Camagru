<nav class="navbar is-dark " >
    <!-- logo  -->
    <div class="navbar-brand has-shadow">
      <a class="navbar-item" >
        <img src="/logo.jpg" alt="logo site" style ="max-height: 70px;" class="py-2 px-2">
      </a>
      <a class="navbar-burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
      <!-- menu -->
      <div class="navbar-menu" id="nav-link" >
        <div class="navbar-start">
            <a href="<?= URLROOT?>" class="navbar-item" >HOME</a>
            <a href="<?= URLROOT?>" class="navbar-item">camagru</a>
        </div>
        <div class="navbar-end">
          <a href="<?= URLROOT?>/users/register" class="navbar-item">register</a>
          <a href="/users/login" class="navbar-item">login</a>
        </div>
      </div>
  </nav>