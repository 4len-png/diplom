document.addEventListener('DOMContentLoaded', () => {
    const modeButtons = document.querySelectorAll('[data-filter-mode]');
    const controls = document.querySelectorAll('[data-filter-control]');
    const classSelect = document.querySelector('[data-filter-select="class"]');
    const subjectSelect = document.querySelector('[data-filter-select="subject"]');
    const classBlocks = document.querySelectorAll('.guides__class');
    const guideLinks = document.querySelectorAll('.guides__text');

    if (!modeButtons.length || !classSelect || !subjectSelect || !guideLinks.length) {
        return;
    }

    const showControl = (mode) => {
        controls.forEach((control) => {
            control.hidden = control.dataset.filterControl !== mode;
        });

        modeButtons.forEach((button) => {
            button.classList.toggle('is-active', button.dataset.filterMode === mode);
        });
    };

    const toggleBreak = (link, isVisible) => {
        const nextElement = link.nextElementSibling;

        if (nextElement && nextElement.tagName === 'BR') {
            nextElement.hidden = !isVisible;
        }
    };

    const applyFilters = () => {
        const selectedClass = classSelect.value;
        const selectedSubject = subjectSelect.value;

        guideLinks.forEach((link) => {
            const matchesClass = selectedClass === 'all' || link.dataset.class === selectedClass;
            const matchesSubject = selectedSubject === 'all' || link.dataset.subject === selectedSubject;
            const isVisible = matchesClass && matchesSubject;

            link.hidden = !isVisible;
            toggleBreak(link, isVisible);
        });

        classBlocks.forEach((classBlock) => {
            const hasVisibleLinks = Array.from(classBlock.querySelectorAll('.guides__text')).some((link) => !link.hidden);
            classBlock.hidden = !hasVisibleLinks;
        });
    };

    modeButtons.forEach((button) => {
        button.addEventListener('click', () => {
            showControl(button.dataset.filterMode);
        });
    });

    classSelect.addEventListener('change', applyFilters);
    subjectSelect.addEventListener('change', applyFilters);

    showControl('class');
    applyFilters();
});