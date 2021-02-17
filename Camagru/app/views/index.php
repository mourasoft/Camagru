<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>
<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div id="notif" class="notification is-<?= $type ?>"><?= $msg ?><button class="delete"></button></div>
	<?php endforeach; ?>
<?php endif; ?>
<?php foreach ($posts as $post):?>
<div class="card">
	<div class="card-image">
		<figure class="image is-4by3">
			<img src="<?= URLROOT ?>/img/pic/<?= $post->path ?>" alt="image">
		</figure>
	</div>
	<div class="card-content">
		<div class="media">
			<div class="media-content">
				<p class="title is-6 ">@<?= $post->username?></p>
			</div>
			<div class="media-content">
				<span icone is-large>
					<i class="fas fa-2x	fa-heart"></i>
					<span>1 </span>
				</span>
			</div>
			<div class="media-content">
				<span icone is-large>
					<i class="fas fa-2x fa-comment-dots"></i>
					<span>1 </span>
				</span>
			</div>

		</div>
		<?php if(isLogged()):?>
		<div class="content">
			<div class="control has-icons-right">
				<input class="input is-rounded" type="text" placeholder="comment...">
			</div>
			<span id="sent_comment" class="icon is-large is-right">
					<i class="fas fa-paper-plane"></i>
				</span>
		</div>
		<?php endif;?>
		<hr class="is-black" />
		<div class="comment">
			<h2>@alaoui</h2>
			<p>tele  zjhddjhz zdjzdhdhkz dahdada dhadhadhadhadhaadadgjadhgadjadg adgdajdgahdahdahdha dahdhad kdjhd zdhzdjkhzjdz dzjdhzdhzjd dzhdzjkhicloud</p>
		</div>
		<hr class="is-black" />
		<div class="comment">
			<h2>@alaoui</h2>
			<p>tele  zjhddjhz zdjzdhdhkz dahdada dhadhadhadhadhaadadgjadhgadjadg adgdajdgahdahdahdha dahdhad kdjhd zdhzdjkhzjdz dzjdhzdhzjd dzhdzjkhicloud</p>
		</div>
	</div>
</div>
	<?php endforeach;?>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>