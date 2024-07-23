const [ inputName1, inputName2, inputName3, inputName4, inputPrice1, inputPrice2, inputPrice3, inputPrice4, size1, size2, size3, size4, size5, size6, size7, size8, size9, size10, size11, size12, size13, size14, size15, size16, size17, size18, size19, size20] = [
    '.input-name1',
    '.input-name2',
    '.input-name3',
    '.input-name4',
    '.input-price1',
    '.input-price2',
    '.input-price3',
    '.input-price4',
    '.select-size1',
    '.select-size2',
    '.select-size3',
    '.select-size4',
    '.select-size5',
    '.select-size6',
    '.select-size7',
    '.select-size8',
    '.select-size9',
    '.select-size10',
    '.select-size11',
    '.select-size12',
    '.select-size13',
    '.select-size14',
    '.select-size15',
    '.select-size16',
    '.select-size17',
    '.select-size18',
    '.select-size19',
    '.select-size20',
].map((selector) => {
    return document.querySelector(selector);
})

function OpeningForm(varInfo, varImage, varClosingBackground, varClosingButton) {
    varInfo.classList.remove('closing-background_transition-closed');
    varInfo.classList.add('closing-background_transition-open');
    varImage.classList.remove('closing-background_transition-closed');
    let int1 = setInterval(function () {
        varInfo.classList.remove('form_closing');
        varInfo.classList.add('form_open');

        varImage.classList.remove('form_closing');
        varImage.classList.add('form_open');
        window.clearInterval(int1);
    }, 200);
    let int2 = setInterval(function () {
        varInfo.classList.remove('closing-background_transition-open');
        varImage.classList.add('closing-background_transition-closed');
        window.clearInterval(int2);
    }, 600);
    varClosingBackground.classList.remove('closing-background_transition-closed');
    varClosingBackground.classList.add('closing-background_transition-open');
    let int3 = setInterval(function () {
        varClosingBackground.classList.remove('closing-background_closed');
        varClosingBackground.classList.add('closing-background_open');
        varClosingButton.classList.add('button-animation');
        window.clearInterval(int3);
    }, 200);
    let int4 = setInterval(function () {
        varClosingBackground.classList.remove('closing-background_transition-open');
        varClosingBackground.classList.add('closing-background_transition-closed');
        window.clearInterval(int4);
    }, 600);
}

function ClosingForm(varInfo, varImage, varClosingBackground, varClosingButton) {
    varInfo.classList.remove('closing-background_transition-closed');
    varInfo.classList.add('closing-background_transition-open');
    varImage.classList.remove('closing-background_transition-closed');
    varImage.classList.add('closing-background_transition-open');

    varInfo.classList.remove('form_open');
    varInfo.classList.add('form_closing');

    varImage.classList.remove('form_open');
    varImage.classList.add('form_closing');


    varInfo.classList.remove('closing-background_transition-open');
    varImage.classList.add('closing-background_transition-closed');


    varClosingBackground.classList.remove('closing-background_transition-closed');
    varClosingBackground.classList.add('closing-background_transition-open');

    varClosingBackground.classList.remove('closing-background_open');
    varClosingBackground.classList.add('closing-background_closed');
    varClosingButton.classList.remove('button-animation');

    varClosingBackground.classList.remove('closing-background_transition-open');
    varClosingBackground.classList.add('closing-background_transition-closed');
}

function ActionsWithForm() {
    for (d = 2; d <= 4; d++) {
        if (document.querySelector(`.input-hidden${d}`).getAttribute('value') == 'open') {
            OpeningForm(document.querySelector(`.product-info${d}`), document.querySelector(`.product-image${d}`), document.querySelector(`.closing-background${d}`), document.querySelector(`.closing-button${d}`));
        }
    }
}

ActionsWithForm();

[...document.querySelectorAll('.information-container__closing-button')].forEach(button => {
    button.addEventListener('click', () => {
        let d = button.classList[1].slice(14, 15);
        OpeningForm(document.querySelector(`.product-info${d}`), document.querySelector(`.product-image${d}`), document.querySelector(`.closing-background${d}`), document.querySelector(`.closing-button${d}`));
        document.querySelector(`.input-hidden${d}`).setAttribute('value', 'open');
    })
});

[...document.querySelectorAll('.information-container__button-close')].forEach(button => {
    button.addEventListener('click', () => {
        let d = button.classList[1].slice(12, 13);
        ClosingForm(document.querySelector(`.product-info${d}`), document.querySelector(`.product-image${d}`), document.querySelector(`.closing-background${d}`), document.querySelector(`.closing-button${d}`));
        document.querySelector(`.input-hidden${d}`).setAttribute('value', 'closed');
    })
});

inputName1.addEventListener('input', () => {
    inputName2.setAttribute('value', inputName1.value);
    inputName3.setAttribute('value', inputName1.value);
    inputName4.setAttribute('value', inputName1.value);
})

inputPrice1.addEventListener('input', () => {
    inputPrice2.setAttribute('value', inputPrice1.value);
    inputPrice3.setAttribute('value', inputPrice1.value);
    inputPrice4.setAttribute('value', inputPrice1.value);
})

function SizeWithoutIdentify(size, selectSizeChildren, sizeArray, value) {
    if (size.value == value) {
        for (k = 0; k <= 4; k++) {
            if (selectSizeChildren[k] != selectSizeChildren[0]) {
                for (q = 0; q <= 4; q++) {
                    if (sizeArray[q] != size && sizeArray[q].value != 6 && sizeArray[q].value == size.value) {
                        sizeArray[q].value = 6;
                    }
                }
            }
        }
    }
}

function sizeOnChange(size) {
    for (d = 1; d <= 4; d++) {
        let sizeArray = [];

        if (d == 1) {
            sizeArray = [size1, size2, size3, size4, size5];
        } else if (d == 2) {
            sizeArray = [size6, size7, size8, size9, size10];
        } else if (d == 3) {
            sizeArray = [size11, size12, size13, size14, size15];
        } else if (d == 4) {
            sizeArray = [size16, size17, size18, size19, size20];
        };

        for (i = 0; i <= 4; i++) {
            if (sizeArray[i] != size) {
                const selectSizeChildren = sizeArray[i].children;
                for (s = 1; s <= 5; s++) {
                    SizeWithoutIdentify(size, selectSizeChildren, sizeArray, s);
                }
            }
        }
    }
}

[...document.querySelectorAll('.information-container__select-size')].forEach(size => {
    size.onchange = () => {
        sizeSelector = document.querySelector(`.${size.name}`);
        sizeOnChange(sizeSelector);
    }
});


//Шапка

window.onload = function() {
    let preloader = document.getElementById('preloader');
    preloader.classList.add('hide-preloader');
    let int1 = setInterval(function() {
          preloader.classList.add('preloader-hidden');
          window.clearInterval(int1);
    }, 1990);
}

const profileA = document.querySelector('.profile');

const likedA = document.querySelector('.liked');
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

likedA.addEventListener('mouseover', function() {
    likedA.parentNode.style.cssText = `
        border: calc(var(--index) * .28) solid black;
    `;
});

likedA.addEventListener('mouseout', function() {
    likedA.parentNode.style.cssText = `
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

tippy('.profile', {
  content: 'Войти',
  inertia: false,
});

tippy('.liked', {
  content: 'Избранное'
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
