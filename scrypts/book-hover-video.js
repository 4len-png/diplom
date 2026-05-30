if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    document.querySelectorAll('[data-hover-video]').forEach((media) => {
        const video = media.querySelector('video');

        if (!video) {
            return;
        }

        function startVideo() {
            media.classList.add('is-video-active');
            video.muted = true;
            video.currentTime = 0;
            video.play().catch(() => {});
        }

        function stopVideo() {
            media.classList.remove('is-video-active');
            video.pause();
            video.currentTime = 0;
        }

        media.addEventListener('mouseenter', startVideo);
        media.addEventListener('mouseleave', stopVideo);
        media.addEventListener('focusin', startVideo);
        media.addEventListener('focusout', stopVideo);
    });
}
