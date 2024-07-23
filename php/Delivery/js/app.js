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
