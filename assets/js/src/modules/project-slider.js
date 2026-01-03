// Project slider initialization (uses global Swiper from CDN)
document.addEventListener('DOMContentLoaded', function () {
  try {
    if ( typeof Swiper === 'undefined' ) return;
    var sliders = document.querySelectorAll('.my-swiper');
    sliders.forEach(function (el) {
      new Swiper(el, {
        loop: true,
        lazy: { loadPrevNext: true },
        preloadImages: false,
        effect: 'fade',
        speed: 900,
        autoplay: { delay: 4500, disableOnInteraction: false },
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        navigation: {
          nextEl: el.querySelector('.swiper-button-next'),
          prevEl: el.querySelector('.swiper-button-prev'),
        },
        keyboard: { enabled: true },
        a11y: true,
      });
    });
  } catch (e) {
    // fail silently
    console.warn('Swiper init failed', e);
  }
});


