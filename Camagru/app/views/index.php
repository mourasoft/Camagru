<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>
<div class="countainer">
	<h1>Home Page</h1>
	<?php if ($flash = getFlash()) : ?>
		<?php foreach ($flash as $type => $msg) : ?>
			<div class="notification is-<?= $type ?>"><?= $msg ?></div>
		<?php endforeach; ?>
	<?php endif; ?>
	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi blanditiis neque, incidunt est assumenda cupiditate facilis mollitia deserunt consectetur in quae dolorum, pariatur eligendi excepturi, eaque nisi quam earum possimus!</p>


	<?php require_once APPROOT . "/views/inc/footer.php"; ?>