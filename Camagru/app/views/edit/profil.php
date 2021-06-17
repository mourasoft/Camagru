<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div>
			<div class="notification is-<?= $type ?>"><?= $msg ?>
			<button class="delete"></button>
			</div>
	<?php endforeach; ?>
<?php endif; ?>



	<div class="form">
		<div class="login-box">
			<h1>Edit Profile</h1>
			<form action="/edits/profil" class="myedit" method='post'>
				<div class="field">
					<label>Username: *</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="username" type="text" value="<?php if (!$data['username_err']) echo $data['username']; ?>" required>
						<span class="icon is-small is-left">
							<i class="fas fa-user"></i>
						</span>
					</div>
					<p class="help is-danger"><?php if ($data['username_err']) {
																			echo $data['username_err'];
																		} ?></p>
				</div>
				<div class="field">
					<label>Email: *</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="email" type="email" value="<?php if (!$data['email_err']) echo $data['email']; ?>" required>
						<span class="icon is-small is-left">
							<i class="fas fa-envelope"></i>
						</span>
					</div>
					<p class="help is-danger"><?php if ($data['email_err']) {
																			echo $data['email_err'];
																		} ?></p>
				</div>
				<div class="field">
					<label>Password: *</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="password" type="password" value="<?php if (!$data['password_err']) echo $data['password']; ?>"required>
						<span class="icon is-small is-left">
							<i class="fas fa-lock"></i>
						</span>
					</div>
					<p class="help is-danger"><?php if ($data['password_err']) {
																			echo $data['password_err'];
																		} ?></p>
				</div>
				<label class="checkbox">
					<input type="checkbox" name="notif"  <?php if($data['notif'] ) echo 'checked';?>>
					Notifications in your email
				</label>
				<div class="control ">
					<input type="submit" value="Edit It" class="button is-rounded is-medium is-fullwidth">

				</div>
				<div><a href=<?= URLROOT . "/edits/pass" ?>>Change My Password</a></div>


			</form>
		</div>
	</div>



<?php require_once APPROOT . "/views/inc/footer.php"; ?>