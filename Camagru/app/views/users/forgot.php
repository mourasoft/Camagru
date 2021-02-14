<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div id="notif" class="notification is-<?= $type ?>"><?= $msg ?></div>
	<?php endforeach; ?>
<?php endif; ?>



<div class="form">
	<div class="login-box">
		<h1>Password Recovery</h1>
		<p>Enter your email and instructions will sent to you!</p>
		<form action="/users/forgot" class="forgot" method='post'>
			<div class="field">
				<label>Email</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="email" type="text" value="<?php if (!$data['email_err']) echo $data['email']; ?>">
					<span class="icon is-small is-left">
						<i class="fas fa-envelope"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if ($data['email_err']) {
												echo $data['email_err'];
											} ?></p>
			</div>
			<div class="control is-justify-content-flex-start">
				<input type="submit" value="Reset" class="button is-rounded is-medium is-fullwidth">
			</div>
		</form>
	</div>

</div>



<?php require_once APPROOT . "/views/inc/footer.php"; ?>