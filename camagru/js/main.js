// mobile menu 
const burgerIcon = document.querySelector('#burger');
const navbarMenu = document.querySelector('#nav-link')
 
burgerIcon.addEventListener('click', () => {
    navbarMenu.classList.toggle('is-active')
})

var video = document.getElementById("video"),
    canvas = document.getElementById("canvas"),
    context = canvas.getContext("2d");
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) 
{
    navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
        video.srcObject = stream;
        video.play();
    });
    }
