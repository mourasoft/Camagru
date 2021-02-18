<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div class="notification is-<?= $type ?>"><?= $msg ?></div>
	<?php endforeach; ?>
<?php endif; ?>


<div class="all">
	<div class="form">
		<div class="login-box">
			<h1>Edit Profile</h1>
			<form action="/edits/pass" class="myedit" method='post'>
				<div class="field">
					<label>New Password: *</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input" name="new_password" type="password" value="<?php if (!$data['new_password_err']) echo $data['new_password'] ?>">
						<span class="icon is-small is-left">
							<i class="fas fa-lock"></i>
						</span>
					</div>
					<p class="help is-danger"><?php if ($data['new_password_err']) {
																			echo $data['new_password_err'];
																		} ?></p>
				</div>
				<label>Confirme New Password: *</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" name="cn_password" type="password" value="<?php if (!$data['cn_password_err']) echo $data['cn_password'] ?>">
					<span class="icon is-small is-left">
						<i class="fas fa-lock"></i>
					</span>
				</div>
				<p class="help is-danger"><?php if ($data['cn_password_err']) {
																		echo $data['cn_password_err'];
																	} ?></p>
		</div>
		<label> Old Password: *</label>
		<div class="control has-icons-left has-icons-right">
			<input class="input" name="oldpassword" type="password" value="">
			<span class="icon is-small is-left">
				<i class="fas fa-lock"></i>
			</span>
		</div>
		<p class="help is-danger"><?php if ($data['old_password_err']) {
																echo $data['old_password_err'];
															} ?></p>
		<div class="control is-justify-content-flex-start">
			<input type="submit" value="Edit It" class="button is-rounded is-medium is-fullwidth">
		</div>
		<div><a href=<?= URLROOT . "/edits/profil" ?>>Edit Profile</a></div>
	</div>


	</form>
</div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>