<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div class="notification is-<?= $type ?>"><?= $msg ?></div>
	<?php endforeach; ?>
<?php endif; ?>



<div class= studio>
	<div class="camera">
		<div class="video">
			<video id="video" ></video>
		</div>
		<div class="canva is_primary" >
			<canvas id="canvas" ></canvas>
		</div>
		<!-- <div class="updat">
			<canvas id="canvas"></canvas>
		</div> -->
	</div>
	<div class="setting">setting</div>
	<div class="preview">preview</div>
</div>



<?php require_once APPROOT . "/views/inc/footer.php"; ?>