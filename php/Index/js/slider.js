const sliderImages = document.querySelectorAll('.slider__img');
const sliderLine = document.querySelector('.slider__line');

const sliderBtnNext = document.querySelector('.slider__btn-next');
const sliderBtnPrev = document.querySelector('.slider__btn-prev');

let count = 0;
let width;

sliderBtnNext.addEventListener('click', nextSlide);
sliderBtnPrev.addEventListener('click', prevSlide);


function init(){
    console.log('resize');
    width = document.querySelector('.slider').offsetWidth;
    sliderLine.computedStyleMap.width = width*sliderImages.length + 'px';
    sliderImages.forEach(item => {
        item.style.width = width + 'px';
        item.style.height =  'auto';
    });
  rollSlider();
}
window.addEventListener('resize', init);
init();


function prevSlide(){
    count--;
    if (count < 0){
        count =  sliderImages.length - 1;
    }

    rollSlider();
};

function nextSlide(){
    count++;
    if (count >= sliderImages.length){
        count = 0;
    }

    rollSlider();
};



function rollSlider() {
    sliderLine.style.transform = `translateX(${-Count * sliderWidth}px)`;
};

setInterval(() => {
    nextSlide()
}, 2400);