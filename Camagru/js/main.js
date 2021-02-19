// mobile navbar
const burgerIcon = document.querySelector("#burger");
const navbarMenu = document.querySelector("#nav-link");

burgerIcon.addEventListener("click", () => {
  navbarMenu.classList.toggle("is-active");
});
// notification delete
document.addEventListener("DOMContentLoaded", () => {
  (document.querySelectorAll(".notification .delete") || []).forEach(
    ($delete) => {
      const $notification = $delete.parentNode;

      $delete.addEventListener("click", () => {
        $notification.parentNode.removeChild($notification);
      });
    }
  );
});

if (document.getElementById("video")) {
  var video = document.getElementById("video"),
    canvas = document.getElementById("canvas"),
    context = canvas.getContext("2d"),
    allStikers = document.querySelectorAll(".sticker-item"),
    stikers = document.getElementsByClassName("stiker-on-video"),
    stiker = document.getElementById("selectedstick"),
    stickerOnVideo = document.querySelector(".stiker-on-video"),
    uploadImg = document.getElementById("input"),
    output = document.getElementById("output"),
    btnUploid = document.getElementById("upload"),
    btnStart = document.getElementById("start"),
    btnPause = document.getElementById("pause"),
    btnStop = document.getElementById("stop"),
    btnSave = document.getElementById("save"),
    takeBtn = document.getElementById("snap"),
    btnClear = document.getElementById("clear"),
    width = 640,
    height = 480,
    dataURL;
  canvas.width = width;
  canvas.height = height;
  takeBtn.disabled = true;
  btnSave.disabled = true;

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
    canvas.width = width;
    canvas.height = height;
  }
  // start camera btn
  btnStart.addEventListener("click", () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.getUserMedia({ video: true }, streamWebCam, throwError);
    } else {
      alert("getUserMedia not supported");
    }
  });
  // pause camera btn
  btnPause.addEventListener("click", () => {
    if (video.srcObject != null) {
      video.pause();
      takeBtn.disabled = true;
    }
  });
  // stop camera btn
  btnStop.addEventListener("click", (stream) => {
    if (video.srcObject != null) {
      video.srcObject = null;
      var stickerOnVideo = document.querySelector(".stiker-on-video");
      stickerOnVideo.setAttribute("src", "");
      stickerOnVideo.style.visibility = `hidden`;
      takeBtn.disabled = true;
    }
  });
  // take photo btn
  takeBtn.addEventListener("click", () => {
    if (video.srcObject != null) {
      if (stiker.style.visibility === "visible") {
        rh = height / canvas.offsetHeight;
        rw = width / canvas.offsetWidth;
        var stikerheight = stiker.offsetHeight * rh;
        stikerwidth = stiker.offsetWidth * rw;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        dataURL = canvas.toDataURL("image/png");
        output.setAttribute("src", dataURL);
        context.drawImage(stiker, 0, 0, stikerwidth, stikerheight);
        btnSave.disabled = false;
      } else alert("please choose a stickers");
    } else {
      alert("please start the camera to take a photo");
    }
  });
  // clear canvas btn
  btnClear.addEventListener("click", () => {
    context.clearRect(0, 0, canvas.width, canvas.height);
    output.removeAttribute("src");
    btnSave.disabled = true;
  });

  //put stickers in vedio
  allStikers.forEach(function (item) {
    item.addEventListener("click", function () {
      stickerOnVideo.setAttribute("src", item.src);
      stickerOnVideo.setAttribute("name", item.name);
      if (video.srcObject != null) {
        stickerOnVideo.style.visibility = `visible`;
      }
      takeBtn.disabled = false;
    });
  });
  //   save image btn
  btnSave.addEventListener("click", saveImage);
  // fonction save image
  function saveImage() {
    if (!(output.src === "") && dataURL && stiker.name) {
      var params = "imgBase64=" + dataURL + "&emoticon=" + stiker.name;
      var xhr = new XMLHttpRequest();
      //   xhr.onload = () => {
      //     console.log(JSON.parse(xhr.response));
      //   };
      xhr.open("POST", "/camera/saveImage");
      xhr.withCredentialfull_canvas = true;
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          window.location.reload();
        }
      };
      xhr.send(params);
      //   setInterval(function () {
      //     window.location.reload();
      //   }, 50);
    } else alert("take picture and chose a stikers");
  }
  // upload image
  btnUploid.addEventListener("click", () => {
    var uploadBtn = document.querySelector("span.file-cta");
    uploadImg.value = "";
    takeBtn.disabled = true;
    if (stickerOnVideo.name.length > 0) {
      uploadBtn.click();
      uploadImg.addEventListener("change", function (e) {
        var file;
        file = e.target.files[0];
        if (file.type.match("image.*")) {
          var reader = new FileReader();
          rw = width / canvas.offsetWidth;
          rh = height / canvas.offsetHeight;
          var stikerheight = stiker.offsetHeight * rh;
          stikerwidth = stiker.offsetWidth * rw;
          reader.readAsDataURL(file);
          reader.onloadend = function (e) {
            var myImage = new Image(680, 480);
            myImage.src = e.target.result;
            myImage.onload = function (ev) {
              context.drawImage(myImage, 0, 0, canvas.width, canvas.height);
              dataURL = canvas.toDataURL("image/png");
              output.setAttribute("src", dataURL);
              context.drawImage(stiker, 0, 0, stikerwidth, stikerheight);
              btnSave.disabled = false;
            };
          };
        } else alert("is not valid image");
      });
    } else {
      alert("please select a sticker");
    }
  });
  function delete_img(id, image) {
    var params = "id=" + id + "&image=" + image;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/camera/deleteImage");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        window.location.reload();
      }
    };
    xhr.send(params);
    //   setInterval(function () {
    //     window.location.reload();
    //   }, 50);
  }
}

var likeBtn = document.querySelectorAll(".fas.fa-2x.fa-heart");
var postedImage = document.querySelectorAll(".card-image img");
var sentComment = document.querySelectorAll(".icon.is-large.is-right");

sentComment.forEach(function (item, index) {
  item.addEventListener("click", function () {
    // console.log(postedImage[index].src);
    var path = postedImage[index].src;
    var imageName = path.split("/").reverse()[0];
    var content = document.querySelectorAll(".input.is-rounded")[index];
    content = content.value.trim();
    if (content) {
      setComment(imageName, index, content);
    }
  });
});

likeBtn.forEach(function (item, index) {
  item.addEventListener("click", function () {
    // console.log(postedImage[index].src);
    var path = postedImage[index].src;
    var imageName = path.split("/").reverse()[0];

    setlike(imageName, index);
  });
});

function setlike(id, index) {
  id = "id=" + id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      if (res.status) {
        if (res.liked) {
          likeBtn[index].style.color = `crimson`;
        } else {
          likeBtn[index].style.color = ``;
        }
        if (res.notif) {
          sendmail(res.email, "like");
        }
      } else {
        window.location.href = "/users/login";
      }
    }
  };
  xhr.open("POST", "/home/setLike");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(id);
}

function setComment(id_img, index, content) {
  comment = "img=" + id_img + "&comment=" + content;

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
       var res = JSON.parse(this.responseText);
    //   if (res.img) {
    //      
    //   } else {
    //     likeBtn[index].style.color = ``;
    //   }
      if (res.notif) {
        sendmail(res.email, "comment");
      }
    }
  };

  xhr.open("POST", "/home/setComment");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(comment);
}

function sendmail(email, action) {
  var xhr = new XMLHttpRequest();
  var email = "email=" + email + "&action=" + action;
  xhr.open("POST", "/home/emailing");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(email);
}
