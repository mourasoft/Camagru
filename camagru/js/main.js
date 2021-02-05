// mobile menu
const burgerIcon = document.querySelector("#burger");
const navbarMenu = document.querySelector("#nav-link");

burgerIcon.addEventListener("click", () => {
	navbarMenu.classList.toggle("is-active");
});

var video = document.getElementById("video"),
	canvas = document.getElementById("canvas"),
	context = canvas.getContext("2d");
	stikers = document.getElementsByClassName("stiker-on-video")
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
		video.srcObject = stream;
		video.play();
		width = stream.getTracks()[0].getSettings().width;
		height = stream.getTracks()[0].getSettings().height;
		canvas.width = width;
		canvas.height = height;
	});
}

document.getElementById("stop").addEventListener("click", () => {
	if(video.srcObject != null)
	{
		video.pause()

	};
})
document.getElementById("snap").addEventListener("click", () => {
	let stiker = document.getElementById("selectedstick")
	rh =  height /  video.offsetHeight
	rw =  width  / video.offsetWidth
	alert(stiker.offsetLeft);
		var stikerheight =  stiker.offsetHeight * rh;
			stikerwidth = stiker.offsetWidth * rw;
			stikerleft = stiker.offsetLeft * rw - stiker.offsetWidth;
	context.drawImage(video, 0, 0, canvas.width, canvas.height);
	context.drawImage(stiker, stikerleft ,0, stikerwidth , stikerheight);
});

document.getElementById("clear").addEventListener("click", () => {
	context.clearRect(0, 0, canvas.width, canvas.height);
})


var stikers = document.querySelectorAll(".sticker-item");

stikers.forEach(function (item) {
	item.addEventListener("click", function () {
		var stickerOnVideo = document.querySelector(".stiker-on-video");
		// stickerOnVideo.className = `visibility: auto`;
		stickerOnVideo.setAttribute("src", item.src);
		console.log(item.src);
	});
});
