
const ratingItemsList = document.querySelectorAll('.rating__item');
const ratingItemsArray = Array.prototype.slice.call(ratingItemsList);

ratingItemsArray.forEach(item => {
    item.addEventListener('click', () => {
    const { itemValue } = item.dataset;
    targetNode = document.querySelector(".rating");
    targetNode.setAttribute("value", itemValue);
  

    targetNodes = document.querySelector(".ratings");
    targetNodes.setAttribute("value", itemValue);

});
});

const profileA = document.querySelector('.profile');
const basketA = document.querySelector('.basket');

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


tippy('#profile_lk', {
    content: 'Личный кабинет',
    inertia: false,
});

tippy('#profile', {
content: 'Вход',
inertia: false,
});


tippy('#basket', {
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

