<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>
<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div id="notif" class="notification is-<?= $type ?>"><?= $msg ?><button class="delete"></button></div>
	<?php endforeach; ?>
<?php endif; ?>

<div class="card">
	<div class="card-image">
		<figure class="image is-4by3">
			<img src="http://192.168.99.101:8001/img/pic/21613402049.png" alt="image">
		</figure>
	</div>
	<div class="card-content">
		<div class="media">
			<div class="media-content">
				<p class="title is-6">@johnsmith</p>
			</div>
			<div class="media-content">
				<span icone is-large>
					<i class="fas fa-2x	fa-heart"></i>
					<span>1 LIKE</span>
				</span>
			</div>
			<div class="media-content">
				<span icone is-large>
					<i class="fas fa-2x fa-comment-dots"></i>
					<span>1 commantaire</span>
				</span>
			</div>

		</div>
		<div class="content">
			<div class="control has-icons-right">
				<input class="input is-rounded" type="text" placeholder="comment...">
				<span class="icon is-large is-right">
					<i class="fas fa-paper-plane"></i>
				</span>
			</div>

		</div>
	</div>
</div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>