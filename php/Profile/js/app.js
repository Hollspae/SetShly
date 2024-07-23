window.onload = function() {
    let preloader = document.getElementById('preloader');
    preloader.classList.add('hide-preloader');
    let int1 = setInterval(function() {
          preloader.classList.add('preloader-hidden');
          window.clearInterval(int1);
    }, 1990);
}

const profileA = document.querySelector('.profile');
const basketA = document.querySelector('.basket');


profileA.addEventListener('mouseover', function() {
    profileA.parentNode.style.cssText = `
        border: calc(var(--index) * .28) solid black;
    `;
});

profileA.addEventListener('mouseout', function() {
    profileA.parentNode.style.cssText = `
        border: calc(var(--index) * .28) solid var(--background-color);
    `;
});



basketA.addEventListener('mouseover', function() {
    basketA.parentNode.style.cssText = `
        border: calc(var(--index) * .28) solid black;
    `;
});

basketA.addEventListener('mouseout', function() {
    basketA.parentNode.style.cssText = `
        border: calc(var(--index) * .28) solid var(--background-color);
    `;
});


tippy('#profile_lk', {
        content: 'Личный кабинет',
        inertia: false,
});

tippy('#profile', {
    content: 'Вход',
    inertia: false,
});


tippy('.basket', {
  content: 'Корзина'
});

profileA.addEventListener('click', function() {
     document.querySelector('.background-navigation').classList.remove('display-none');
     document.querySelector('.background-navigation').classList.add('display-flex');
     document.querySelector('.authorization').classList.remove('authorization-closed');
     document.querySelector('.authorization').classList.add('authorization-open');
     let int2 = setInterval(function() {
          document.querySelector('.authorization-open').style.display = "flex";
          window.clearInterval(int2);
     }, 100);
});

document.querySelector('.registration-unlock').addEventListener('click', function() {
     document.querySelector('.authorization').classList.remove('authorization-open');
     document.querySelector('.authorization').classList.add('authorization-closed');
     document.querySelector('.registration').classList.remove('registration-closed');
     document.querySelector('.registration').classList.add('registration-open');
     let int3 = setInterval(function() {
          document.querySelector('.authorization-closed').style.display = "none";
          window.clearInterval(int3);
     }, 100);
     let int4 = setInterval(function() {
          document.querySelector('.registration-open').style.display = "flex";
          window.clearInterval(int4);
     }, 100);
});

document.querySelector('.closing-authorization').addEventListener('click', function() {
     document.querySelector('.authorization').classList.remove('authorization-open');
     document.querySelector('.authorization').classList.add('authorization-closed');
     document.querySelector('.background-navigation').classList.remove('display-flex');
     document.querySelector('.background-navigation').classList.add('display-none');
     let int5 = setInterval(function() {
          document.querySelector('.authorization-closed').style.display = "none";
          window.clearInterval(int5);
     }, 550);
});

document.querySelector('.closing-registration').addEventListener('click', function() {
     document.querySelector('.registration').classList.remove('registration-open');
     document.querySelector('.registration').classList.add('registration-closed');
     document.querySelector('.background-navigation').classList.remove('display-flex');
     document.querySelector('.background-navigation').classList.add('display-none');
     let int6 = setInterval(function() {
          document.querySelector('.registration-closed').style.display = "none";
          window.clearInterval(int6);
     }, 550);
    clearInterval()
});

let perView = 5;

function createSwiper(slidesPerView){
    return new Swiper(".slider-product", {
      effect: "coverflow",
      speed: 200,
      grabCursor: true,
      centeredSlides: true,
      centerInsufficientSlides: false,
      slidesPerView,
      initialSlide: 2,
      coverflowEffect: {
        rotate: 0,
        stretch: -160,
        depth: 500,
        modifier: 0.3,
        slideShadows: true,
      }
});

};

let swiper = createSwiper(perView);

window.addEventListener('resize', resize);
function resize() {
    const viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

    if (viewport_width <= 992 && perView === 3) {
      perView = 1  // было 5 делаем 1 — нужен экземпляр
      swiper.destroy(); // уничтожаем предыдущий экземпляр
      swiper = createSwiper(perView) // создаем новый
    } else if ( viewport_width > 992 && perView === 1) {
      perView = 5  // было 1 делаем 5 — нужен экземпляр
      swiper.destroy(); // уничтожаем предыдущий экземпляр
      swiper = createSwiper(perView) // создаем новый
    }
}
resize();

const activation = document.querySelector('.activation');

activation.addEventListener('click', event => {
    if (activation.classList.contains('false') == true) {
        let activTrue = function() {
            activation.classList.remove('false');
            activation.classList.add('true');
            document.querySelector('aside').classList.remove('transition-false');
            document.querySelector('aside').classList.add('transition-true');
            activation.parentNode.style.cssText = `left: 0`;
        };
        activTrue();
        let int7 = setInterval(function() {
            document.querySelector('aside').classList.remove('transition-true');
            document.querySelector('aside').classList.add('transition-false');
            window.clearInterval(int7);
        }, 500);
    } else if (activation.classList.contains('true') == true) {
        let activFalse = function() {
          activation.classList.remove('true');
            activation.classList.add('false');
            document.querySelector('aside').classList.remove('transition-false');
            document.querySelector('aside').classList.add('transition-true');
            activation.parentNode.style.cssText = `left: calc(var(--index) * -24.9);`;
        };
        activFalse();
        let int8 = setInterval(function() {
          document.querySelector('aside').classList.remove('transition-true');
        document.querySelector('aside').classList.add('transition-false');
          window.clearInterval(int8);
        }, 500);
    }
});
