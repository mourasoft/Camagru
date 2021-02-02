// mobile menu
const burgerIcon = document.querySelector("#burger");
const navbarMenu = document.querySelector("#nav-link");

burgerIcon.addEventListener("click", () => {
	navbarMenu.classList.toggle("is-active");
});

var video = document.getElementById("video"),
	canvas = document.getElementById("canvas"),
	context = canvas.getContext("2d");
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true }).then((stream) => {
		video.srcObject = stream;
		video.play();
		width = stream.getTracks()[0].getSettings().width ;
		height = stream.getTracks()[0].getSettings().height;
		canvas.width = width;
		canvas.height = height;
	});
}

document.getElementById("snap").addEventListener("click", () => {	
	context.drawImage(video, 0, 0, canvas.width  , canvas.height);
	debug('---->' + width);
	debug('---->' + height);
});

function debug($var){
	console.log($var);
}


