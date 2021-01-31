<nav class="navbar is-dark ">
	<div class="container">
		<!-- logo  -->

		<!-- menu -->

		<div class="navbar-menu" id="nav-link">
			<div class="navbar-start">
				<a href="<?= URLROOT ?>" class="navbar-item">camagru</a>
			</div>
			<div class="navbar-end">
				<?php if (!islogged()) : ?>
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
<div class="container">