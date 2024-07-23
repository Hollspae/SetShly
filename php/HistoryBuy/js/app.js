window.onload = function() {
    let preloader = document.getElementById('preloader');
    preloader.classList.add('hide-preloader');
    let int1 = setInterval(function() {
          preloader.classList.add('preloader-hidden');
          window.clearInterval(int1);
    }, 1990);
 
}



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


// tippy('#profile_lk', {
//         content: 'Личный кабинет',
//         inertia: false,
// });

// tippy('#profile', {
//     content: 'Вход',
//     inertia: false,
// });

// tippy('.liked', {
//     content: 'Избранное'
//   });

// tippy('.basket', {
//   content: 'Корзина'
// });


const feedbackClose = document.getElementById('close');
const feedback = document.getElementById('feedback');
const feedbackOverlay = document.getElementById('overlay');

const ratingItem1 = document.getElementById('star-open1');

const ratingItem2 = document.getElementById('star-open2');
const ratingItem3 = document.getElementById('star-open3');
const ratingItem4 = document.getElementById('star-open4');
const ratingItem5 = document.getElementById('star-open5');

//открыть окно
ratingItem1.addEventListener('click', function() {
    feedback.className = "feedback";
    feedbackOverlay.className = "overlay";
    

});
ratingItem2.addEventListener('click', function() {
    feedback.className = "feedback";
    feedbackOverlay.className = "overlay";
    

});
ratingItem3.addEventListener('click', function() {
    feedback.className = "feedback";
    feedbackOverlay.className = "overlay";
    

});
ratingItem4.addEventListener('click', function() {
    feedback.className = "feedback";
    feedbackOverlay.className = "overlay";
    

});
ratingItem5.addEventListener('click', function() {
    feedback.className = "feedback";
    feedbackOverlay.className = "overlay";
    

});




//Закрыть окно
feedbackClose.addEventListener('click', function() {
    feedback.className = "feedback-Closing";
    feedbackOverlay.className = "feedback-Closing";
});



// const feedbackClose = document.querySelectorAll('.close');
// const feedback = document.querySelectorAll('.feedback');
// const feedbackOverloy = document.querySelectorAll('.overlay');


// //Закрыть окно
// feedbackClose.addEventListener('click', function() {
//     feedback.classList.remove = "feedback";
//     feedback.classList.add = "feedback-Closing";
//     feedbackOverloy.classList.remove = "overlay"
//     feedbackOverloy.classList.add = "feedback-Closing"
// });


