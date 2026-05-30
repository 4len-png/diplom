document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.head-search_input-text');
    const guideLinks = document.querySelectorAll('.guides__text');

    if (!searchInput || guideLinks.length === 0) {
        return;
    }

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();

        guideLinks.forEach((link) => {
            const title = link.textContent.trim().toLowerCase();
            const isVisible = title.includes(query);
            const nextElement = link.nextElementSibling;

            link.hidden = !isVisible;

            if (nextElement && nextElement.tagName === 'BR') {
                nextElement.hidden = !isVisible;
            }
        });
    });
});