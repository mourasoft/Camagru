// mobile menu
const burgerIcon = document.querySelector("#burger");
const navbarMenu = document.querySelector("#nav-link");

burgerIcon.addEventListener("click", () => {
  navbarMenu.classList.toggle("is-active");
});

if (document.getElementById("video")) {
  var video = document.getElementById("video"),
    canvas = document.getElementById("canvas"),
    context = canvas.getContext("2d"),
    allStikers = document.querySelectorAll(".sticker-item"),
    stikers = document.getElementsByClassName("stiker-on-video"),
    stiker = document.getElementById("selectedstick"),
	hadimage = 0,
	dataURL;

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
    } else {
      console.log("getUserMedia not supported");
    }
  });
  // pause camera
  document.getElementById("pause").addEventListener("click", () => {
    if (video.srcObject != null) {
      video.pause();
      document.getElementById("snap").setAttribute("disabled", true);
    }
  });
  // stop camera
  document.getElementById("stop").addEventListener("click", (stream) => {
    if (video.srcObject != null) {
      video.srcObject = null;
      var stickerOnVideo = document.querySelector(".stiker-on-video");
      stickerOnVideo.setAttribute("src", "");
      document.getElementById("snap").setAttribute("disabled", true);
    }
  });
  // take photo
  document.getElementById("snap").addEventListener("click", () => {
    if (stiker.style.visibility === "visible") {
      rh = height / video.offsetHeight;
      rw = width / video.offsetWidth;
      var stikerheight = stiker.offsetHeight * rh;
      stikerwidth = stiker.offsetWidth * rw;
      stikerleft = stiker.offsetLeft * rw;
	  context.drawImage(video, 0, 0, canvas.width, canvas.height);
	  dataURL = canvas.toDataURL("image/png");
	  document.getElementById('output').setAttribute('src',dataURL);

      context.drawImage(stiker, 0, 0, stikerwidth, stikerheight);
      hadimage = 1;
      document.getElementById("save").removeAttribute("disabled");
    } else alert("please choose a stickers");
  });

  document.getElementById("clear").addEventListener("click", () => {
    context.clearRect(0, 0, canvas.width, canvas.height);
    hadimage = 0;
    document.getElementById("save").setAttribute("disabled", true);
  });

  //put stickers in vedio
  allStikers.forEach(function (item) {
    item.addEventListener("click", function () {
        var stickerOnVideo = document.querySelector(".stiker-on-video");
		stickerOnVideo.setAttribute("src", item.src);
		stickerOnVideo.setAttribute("name", item.name);
		if (video.srcObject != null){
			stickerOnVideo.style.visibility = `visible`;
		}
        document.getElementById("snap").removeAttribute("disabled");
    });
  });

  document
    .getElementById("save")
    .addEventListener("click", saveImage, () => {});
  // fonction save image
  function saveImage() {
    if (stiker.style.visibility === "visible" && hadimage) {
	//   var dataURL = canvas.toDataURL("image/png");
	  
	var params = "imgBase64=" + dataURL + "&emoticon=" + stiker.name;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "/camera/saveImage");
	
	xhr.withCredentialfull_canvas = true;
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
	console.log(params)
    //   setInterval(function () {
    //     window.location.reload();
    //   }, 50);
    } else alert("take picture and chose a stikers");
  }

  function isImage(file) {
    const validImageTypes = ["image/jpg", "image/jpeg", "image/png"];
    const fileType = file["type"];
    if (validImageTypes.indexOf(fileType)) return true;
    else return false;
  }
  function uploadImage() {
    uploadImg.addEventListener("change", function (event) {
      var file = event.target.files[0];
      var img = new Image();

      img.onload = function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(img, 0, 0, canvas.width, canvas.height);
        
      };
      if (file && isImage(file)) img.src = URL.createObjectURL(file);
      if (uploadImg.files.lenght != 0)
        document.getElementById("save").disabled = false;
    });
  }
}
