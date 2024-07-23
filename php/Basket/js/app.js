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

//Добавление карты
let block = document.getElementById('BlockCard');
let BtnOpen = document.getElementById('CardOpen');
let BtnClose = document.getElementById('closing-card');
let background = document.getElementById('background');

BtnOpen.addEventListener('click', function() {
    block.classList.remove('display-none');
    block.classList.add('display-flex');

    background.classList.remove('display-none');
    background.classList.add('display-flex');
});
BtnClose.addEventListener('click', function() {
    block.classList.remove('display-flex');
    block.classList.add('display-none');

    background.classList.remove('display-flex');
    background.classList.add('display-none');
});


//Подтверждение заказа
let BtnOpenOrder = document.getElementById('submitOrder');
let blockOrder = document.getElementById('BlockOrder');
let BtnCloseOrder = document.getElementById('closing-order');


BtnOpenOrder.addEventListener('click', function() {
    blockOrder.classList.remove('display-none');
    blockOrder.classList.add('display-flex');

    background.classList.remove('display-none');
    background.classList.add('display-flex');
});

BtnCloseOrder.addEventListener('click', function() {
    blockOrder.classList.remove('display-flex');
    blockOrder.classList.add('display-none');

    background.classList.remove('display-flex');
    background.classList.add('display-none');
});



function handleButtonClick() {
    // Вызываем функцию на сервере PHP
    fetch('../DeleteCardBasket.php')
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
}

// Получаем элемент кнопки по идентификатору
var button = document.getElementById("submitDeleteProduct=' . $list_productToBasketID . '");

// Добавляем обработчик события 'click' к кнопке
button.addEventListener('click', handleButtonClick);