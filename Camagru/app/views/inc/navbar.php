<nav class="navbar is-dark ">
	<div class="container">
		<!-- logo  -->
		<div class="navbar-brand has-shadow">
			<a href="<?= URLROOT ?>" class="navbar-item">camagru</a>
			<a class="navbar-burger" id="burger">
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
		<!-- menu -->

		<div class="navbar-menu" id="nav-link">
		
			<div class="navbar-end">
				<?php if (!islogged()) : ?>
					<a href="<?= URLROOT ?>/camera" class="navbar-item">Camera</a>
					<a href="<?= URLROOT ?>/users/register" class="navbar-item">register</a>
					<a href="<?= URLROOT ?>/users/login" class="navbar-item">login</a>
					<?php else : ?>
						
					<a href="<?= URLROOT ?>/camera" class="navbar-item">Camera</a>
					<a href="<?= URLROOT ?>/edits" class="navbar-item"><?= $_SESSION['auth']->username ?></a>
					<a href="<?= URLROOT ?>/users/logout" class="navbar-item">logout</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</nav>
<div class="container main">