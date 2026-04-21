const btn = document.querySelector('.info__button');
const moreText = document.querySelector('.more-text');

btn.addEventListener('click', () => {
    moreText.classList.toggle('open');

    if (moreText.classList.contains('open')) {
        btn.textContent = 'Свернуть';
    } else {
        btn.textContent = 'Далее';
    }
});