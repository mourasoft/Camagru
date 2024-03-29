<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<!-- <link rel="stylesheet" href="<?= URLROOT ?>/css/style.css"> -->
<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div class="notification is-<?= $type ?>"><?= $msg ?><button class="delete"></button></div>
	<?php endforeach; ?>
<?php endif; ?>
<div class="form">
	<div class="registration-box">
		<h1>Welcome to Camagru!</h1>
		<p>Registration is free, fast, and simple.</p>
		<form class="myform" action="/users/register" method="post">
			<div class="field">
				<label>Username</label>
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
				<label>Email</label>
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
				<label>Password</label>
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
			<div class="field">
				<label>Confirm Password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="c_password" type="password" value="<?php if (!$data['c_password_err']) echo $data['c_password']; ?>" required>
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if ($data['c_password_err']) {
												echo $data['c_password_err'];
											} ?></p>
			</div>
			<div class="control" style="display: flex; justify-content: center;">
				<input type="submit" value="Register" class="button is-linkclass is-primary">
			</div>
		</form>
	</div>
</div>

<?php require_once APPROOT . "/views/inc/footer.php"; ?>