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
		<h1>SIGN IN</h1>
		<p>LOG IN TO YOUR ACCOUNT TO CONTINUE.</p>
		<form action="/users/login" class="myform" method='post'>
			<div class="field">
				<label>Email or Username</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="login" type="text" value="<?php if (!$data['login_err']) echo $data['login']; ?>" required>
					<span class="icon is-small is-left">
						<i class="fas fa-user"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if ($data['login_err']) {
												echo $data['login_err'];
											} ?></p>
			</div>
			<div class="field">
				<label>Password</label>
				<a href="/users/forgot" class="">FORGOT PASSWORD?</a>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="password" type="password" value="<?php if (!$data['password_err']) echo $data['password']; ?>" required>
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if ($data['password_err']) {
												echo $data['password_err'];
											} ?></p>
			</div>
			<div class="control is-justify-content-flex-start">
				<input type="submit" value="Log In" class="button is-rounded is-medium is-fullwidth">
			</div>
			<div class="create is-justify-content-flex-end">NOT REGISTERED ? <a href="/users/register">CREATE AN ACCOUNT</a> </div>

		</form>
	</div>
</div>


<?php require_once APPROOT . "/views/inc/footer.php"; ?>