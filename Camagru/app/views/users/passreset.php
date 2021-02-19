<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<!-- <link rel="stylesheet" href="<?= URLROOT ?>/css/style.css"> -->
<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div id="notif" class="notification is-<?= $type ?>"><?= $msg ?><button class="delete"></button></div>
	<?php endforeach; ?>
<?php endif; ?>
<div class="form">
	<div class="registration-box">
		<h1>Reset password</h1>
		<form class="myreset" action="/users/passreset/<?php if (isset($data['id'])) echo $data['id'] ?>" method="post">
			<div class="field">
				<label>Password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="password" type="password" value="<?php if (!isset($data['password_err'])) echo $data['password']; ?>">
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if (isset($data['password_err'])) {
												echo $data['password_err'];
											} ?></p>
			</div>
			<div class="field">
				<label>Confirm Password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="c_password" type="password" value="<?php if (!isset($data['c_password_err'])) echo $data['c_password']; ?>">
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if (isset($data['c_password_err'])) {
												echo $data['c_password_err'];
											} ?></p>
			</div>
			<div class="control" style="display: flex; justify-content: center;">
				<input type="submit" value="reset" class="button is-linkclass is-primary">
			</div>
		</form>
	</div>
</div>

<?php require_once APPROOT . "/views/inc/footer.php"; ?>