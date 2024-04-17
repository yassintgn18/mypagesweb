

const slides = document.querySelectorAll(".slides img");
let slideIndex = 0;
let intervalId = null;

//initilizeSlider();
document.addEventListener("DOMContentLoaded", initilizeSlider);

function initilizeSlider(){

    if(slides.length > 0){
        slides[slideIndex].classList.add("displaylside");
        intervalId = setInterval(nextslide, 5000);
        console.log(intervalId);
    }
   
}
function showSlide(index){

    if(index >= slides.length){
        slideIndex = 0;

    }
    else if(index < 0){
        slideIndex = slides.length-1;

    }
    slides.forEach(slide => {
        slide.classList.remove("displaylside");
    });
    slides[slideIndex].classList.add("displaylside");

}
function prevslide(){
    clearInterval(intervalId);
    slideIndex--;
    showSlide(slideIndex);

}
function nextslide(){
    slideIndex++;
    showSlide(slideIndex);
}




