// mobile menu
const burgerIcon = document.querySelector("#burger");
const navbarMenu = document.querySelector("#nav-link");

burgerIcon.addEventListener("click", () => {
	navbarMenu.classList.toggle("is-active");
});

if (window.location.href == "http://localhost:8001/users/camera") {
	var video = document.getElementById("video"),
		canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		stikers = document.getElementsByClassName("stiker-on-video"),
		stiker = document.getElementById("selectedstick");

	navigator.getUserMedia =
		navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.oGetUserMedia ||
		navigator.msGetUserMedia;

	function throwError(e) {
		alert(e.name);
	}

	function streamWebCam(stream) {
		video.srcObject = stream;
		video.play();
		width = stream.getTracks()[0].getSettings().width;
		height = stream.getTracks()[0].getSettings().height;
		canvas.width = width;
		canvas.height = height;
	}
	
	document.getElementById("start").addEventListener("click", () => {
		
		
		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
			navigator.getUserMedia({ video: true }, streamWebCam, throwError);
		}
	});
	// pause camera
	document.getElementById("pause").addEventListener("click", () => {
		if (video.srcObject != null) {
			video.pause();
		}
	});
	// stop camera
	document.getElementById("stop").addEventListener("click", (stream) => {
		if (video.srcObject != null) {
			video.srcObject = null;
			var stickerOnVideo = document.querySelector(".stiker-on-video");
			stickerOnVideo.setAttribute("src", "");
		}
	});
	// take photo
	document.getElementById("snap").addEventListener("click", () => {
		rh = height / video.offsetHeight;
		rw = width / video.offsetWidth;
		alert(stiker.offsetLeft);
		var stikerheight = stiker.offsetHeight * rh;
		stikerwidth = stiker.offsetWidth * rw;
		stikerleft = stiker.offsetLeft * rw;
		context.drawImage(video, 0, 0, canvas.width, canvas.height);
		context.drawImage(stiker, stikerleft, 0, stikerwidth, stikerheight);
	});

	document.getElementById("clear").addEventListener("click", () => {
		context.clearRect(0, 0, canvas.width, canvas.height);
	});

	var stikers = document.querySelectorAll(".sticker-item");
	//put stickers in vedio
	// if (video.srcObject != null) {
	stikers.forEach(function (item) {
		item.addEventListener("click", function () {
			if (video.srcObject != null) {
				var stickerOnVideo = document.querySelector(".stiker-on-video");
				// stickerOnVideo.className = `visibility: auto`;
				stickerOnVideo.setAttribute("src", item.src);
			}
		});
	});
	document.getElementById("save").addEventListener("click", saveImage , ()=>{
		document.getElementById("save").setAttribute('disabled', true);
	})
	// fonction save image
	function saveImage() {
		var dataURL = canvas.toDataURL("image/png");
		var params = "imgBase64=" + dataURL + "&emoticon=" + stiker.src;
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "/users/saveImage");

		xhr.withCredentialfull_canvas = true;
		xhr.setRequestHeader(
			"Content-type",
			"application/x-www-form-urlencoded"
		);
		xhr.send(params);
		// setInterval(function () {
		// 	window.location.reload();
		// }, 50);
	}
}
