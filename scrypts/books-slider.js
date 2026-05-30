const slider = document.querySelector('.books-slider'); 

if (slider) {
    const track = slider.querySelector('.books-slider__track');
    const items = slider.querySelectorAll('.slider_item');
    const prevBtn = slider.querySelector('.books-slider__btn_prev');
    const nextBtn = slider.querySelector('.books-slider__btn_next');
    const visibleItems = 4;

    let currentIndex = 0;

    function getStep() {
        const firstItem = items[0];
        const secondItem = items[1];

        if (!firstItem) {
            return 0;
        }

        if (!secondItem) {
            return firstItem.offsetWidth;
        }

        return secondItem.offsetLeft - firstItem.offsetLeft;
    }

    function getVisibleItemsCount() {
        const step = getStep();

        if (step === 0) {
            return visibleItems;
        }

        return Math.max(1, Math.round(track.parentElement.offsetWidth / step));
    }

    function updateSlider() {
        const maxIndex = Math.max(items.length - getVisibleItemsCount(), 0);
        const step = getStep();

        currentIndex = Math.min(currentIndex, maxIndex);
        track.style.transform = `translateX(-${currentIndex * step}px)`;

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === maxIndex;
    }

    nextBtn.addEventListener('click', () => {
        const maxIndex = Math.max(items.length - getVisibleItemsCount(), 0);

        if (currentIndex < maxIndex) {
            currentIndex += 1;
            updateSlider();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex -= 1;
            updateSlider();
        }
    });

    window.addEventListener('resize', updateSlider);

    updateSlider();
}
