//Переменные

const slider = document.querySelector('.slider');
const sliderImages = document.querySelectorAll('.slider__img');
const sliderLine = document.querySelector('.slider__line');

//Кнопки

// const sliderBtnNext = document.querySelector('.slider__btn-next');
// const sliderBtnPrev = document.querySelector('.slider__btn-prev');

let Count = 0;
let width;
let sliderWidth = slider.offsetWidth;


//Перемотка слайдера вперед по нажатию на кнопку 
// sliderBtnNext.addEventListener('click', nextSlide);
// sliderBtnPrev.addEventListener('click', prevSlide);

//Функции


function nextSlide() {
    Count++;
    if (Count  == sliderImages.length){
        Count = 0;
    }


    rollSlider();
}

function prevSlide() {
    Count--;

    if (Count < 0) {
        Count = sliderImages.length - 1;
    }

        rollSlider();
}

function rollSlider() {
    sliderLine.style.transform = `translateX(${-Count * sliderWidth}px)`;
}

setInterval(() => {
    nextSlide()
}, 2500);