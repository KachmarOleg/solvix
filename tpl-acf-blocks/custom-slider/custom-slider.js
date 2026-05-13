document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.block__custom_slider').forEach(swiperWrapper => {
        const swiperContainer = swiperWrapper.querySelector('.swiper');
        const next = swiperWrapper.querySelector('.sw_next');
        const prev = swiperWrapper.querySelector('.sw_prev');
        const pagination = swiperWrapper.querySelector('.sw_pagination');
        const thumbsContainer = swiperWrapper.querySelector('.swiper_thumbs');
        const thumbsSwiper = new Swiper('.swiper_thumbs', {
            // Disable all sliding
            slidesPerView: 'auto',
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            allowTouchMove: false, // Disable drag
        });

        const swiper = new Swiper(swiperContainer, {
            navigation: {
                nextEl: next,
                prevEl: prev
            },
            loop: true,
            speed: 600,
            grabCursor: true,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            thumbs: {
                swiper: thumbsSwiper,
            }
        });
    });
});
