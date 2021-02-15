<?php require_once APPROOT . "/views/inc/header.php"; ?>
<?php require_once APPROOT . "/views/inc/navbar.php" ?>

<?php if ($flash = getFlash()) : ?>
	<?php foreach ($flash as $type => $msg) : ?>
		<div id="notif" class="notification is-<?= $type ?>"><?= $msg ?><button class="delete"></button></div>
	<?php endforeach; ?>
<?php endif; ?>



<div class=studio>
	<div class="camera">
		<div class="video">
			<video id="video"></video>
			<img src class="stiker-on-video" id="selectedstick" />

		</div>
		<div class="canva is_primary">
			<canvas id="canvas"><img id="output"></canvas>
		</div>
		<div class="sticks">
			<img class="sticker-item" name="04" src="/img/stikers/04.png" alt="04">
			<img class="sticker-item" name="05" src="/img/stikers/05.png" alt="05">
			<img class="sticker-item" name="06" src="/img/stikers/06.png" alt="06">
		</div>

	</div>
	<div class="setting">
		<div class="buttons">
			<button class="button is-info" id="start">
				<span class="icon is-small">
					<i class="fas fa-play"></i>
				</span>
				<span>start</span>
			</button>
			<button class="button is-warning" id="pause">
				<span class="icon is-small">
					<i class="fas fa-pause"></i>
				</span>
				<span>pause</span>
			</button>
			<button class="button is-danger" id="stop">
				<span class="icon is-small">
					<i class="fas fa-stop"></i>
				</span>
				<span>
					stop
				</span> </button>
			<button class="button is-success" id="snap">
				<span class="icon is-small">
					<i class="fas fa-camera"></i>
				</span>
				<span>Take</span>
			</button>
			<button class="button is-success" id="save">
				<span class="icon is-small">
					<i class="fas fa-check"></i>
				</span>
				<span>Save</span>
			</button>
			<button class="button is-danger" id="clear">
				<span class="icon is-small">
					<i class="fas fa-broom"></i>
				</span>
				<span>clear</span>
			</button>
			<button class="button is-success" id="upload">
				<span class="icon is-small">
					<i class="fas fa-upload"></i>
				</span>
				<span>Upload</span>
			</button>

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
		<div class="preview">

			<?php foreach ($images as $image) : ?>
				<div class="imageStudio">
					<img class="images" src="<?= URLROOT ?>/img/pic/<?= $image->path ?>" alt="">
					<span class="icon is-small">
						<i onclick="delete_img('<?= $image->id ?>','<?= $image->path ?>')" id="removeImage" class="fas fa-trash-alt is-red"></i>
					</span>
					<!-- <button  class="delete"></button> -->
				</div>
			<?php endforeach; ?>
		</div>
	</div>

</div>
<?php require_once APPROOT . "/views/inc/footer.php"; ?>