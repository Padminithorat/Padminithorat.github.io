var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
window.onload= function () {
 setInterval(function(){ 
     plusSlides(1);
 }, 3000);
 }






 let menuicon = document.getElementById("menu-icon");
let nav = document.querySelector('.navbar');


menuicon.addEventListener("click", () => {
    menuicon.classList.toggle('bx-x');
    if (nav.style.transform === "translateX(0%)") {
        nav.style.transform = "translateX(-100%)";
    } else {
        nav.style.transform = "translateX(0%)";
    }
});


var text = document.getElementById('text');
var newDom = '';
var animationDelay = 6;

for(let i = 0; i < text.innerText.length; i++)
{
    newDom += '<span class="char">' + (text.innerText[i] == ' ' ? '&nbsp;' : text.innerText[i])+ '</span>';
}

text.innerHTML = newDom;
var length = text.children.length;

for(let i = 0; i < length; i++)
{
    text.children[i].style['animation-delay'] = animationDelay * i + 'ms';
}
