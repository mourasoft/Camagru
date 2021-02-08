<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div class="notification is-<?= $type ?>"><?= $msg ?></div>
	<?php endforeach; ?>
<?php endif; ?>



<div class=studio>
	<div class="camera">
		<div class="video">
			<video id="video"></video>
			<img src class="stiker-on-video" id="selectedstick" />
		</div>
		<div class="canva is_primary">
			<canvas id="canvas"><img  id="output"></canvas>
		</div>
		<div class="sticks">
			<img class="sticker-item" name="04" src="/img/stikers/04.png" alt="04">
			<img class="sticker-item" name="05"src="/img/stikers/05.png" alt="05">
			<img class="sticker-item" name="06"src="/img/stikers/06.png" alt="06">
		</div>

	</div>
	<div class="setting">
		<div class="buttons">
			<button class="button is-info" id="start">start</button>
			<button class="button is-warning" id="pause">pause</button>
			<button class="button is-danger" id="stop">stop</button>
			<button class="button is-success" id="snap" disabled>Take</button>
			<button class="button is-success" id="save" disabled>Save</button>
			<button class="button is-danger" id="clear">clear</button>

			<div class="file">
				<label class="file-label">
					<input class="file-input" type="file" name="resume" id="input">
					<span class="file-cta">
						<span class="file-icon">
							<i class="fas fa-upload"></i>
						</span>
						<span class="file-label">
							Choose a file…
						</span>
					</span>
				</label>
			</div>

		</div>
		<div class="preview">preview</div>
	</div>

</div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>