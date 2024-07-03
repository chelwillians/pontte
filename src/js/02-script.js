window.addEventListener('load', function () {
    const mainHeader = document.querySelector('.main-header');
    const hamburguerItem = document.querySelector('.main-header__hamburguer');
    const headerMenus = document.querySelector('.main-header__menus');
    hamburguerItem.addEventListener('click', (e) => {
        hamburguerItem.classList.toggle('active');
        headerMenus.classList.toggle('active');
        mainHeader.classList.toggle('active');
        document.querySelector('body').classList.toggle('no-scroll');
    })
})

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".divider__cards", {
        rewind: true,
        spaceBetween: 16,
        centeredSlides: true,
        slidesPerView: "auto",
        initialSlide: "1",
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    });

    if (window.innerWidth >= 768) {
        swiper.destroy()
    }
});

// document.addEventListener("DOMContentLoaded", (event) => {
//     const bannerHeight = document.querySelector('.main-banner').offsetHeight;
//     const mainHeader = document.querySelector('.main-header');
//     console.log(bannerHeight);
//     window.addEventListener('scroll', (e) => {
//         if (this.scrollY >= bannerHeight) {
//             mainHeader.classList.add('fixed')
//             mainHeader.classList.remove('offset')
//         } else if (this.scrollY >= (mainHeader.offsetHeight * 3)) {
//             mainHeader.classList.add('offset')
//             mainHeader.classList.remove('fixed')
//         } else {
//             mainHeader.classList.remove('fixed')
//             mainHeader.classList.remove('offset')
//         }
//     })
// });

document.addEventListener('DOMContentLoaded', () => {
    const faq = document.querySelectorAll('.faq');
    if (!faq) return;

    faq[0].addEventListener('click', (e) => {
        if (!e.target.closest('.faq__item--answer')) {
            const question = e.target.closest('.faq__item');
            question.classList.toggle('active');
        }
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const contentMidia = document.querySelectorAll('.midia__content-list .midia__content-item')
    const contentLogo = document.querySelectorAll('.midia__list .midia__item')
    const swiperMidia = new Swiper(".midia__list", {
        rewind: true,
        spaceBetween: 8,
        // centeredSlides: true,
        slidesPerView: "auto",
        breakpoints: {
            1024: {
                spaceBetween: 16,
            },
        }
    });

    contentLogo[0].classList.add('active');
    contentMidia[0].classList.add('active');

    // swiperMidia.on('slideChange', function () {
    //     let sliderActive = swiperMidia.activeIndex;

    //     document.querySelector('.midia__content-list .midia__content-item.active').classList.remove('active')
    //     contentMidia[sliderActive].classList.add('active');
    // });

    contentLogo.forEach((el, index) => {
        el.addEventListener('click', () => {
            document.querySelector('.midia__list .midia__item.active')?.classList.remove('active')
            document.querySelector('.midia__content-list .midia__content-item.active')?.classList.remove('active')

            el.classList.add('active');
            contentMidia[index].classList.add('active');
        })
    })
});
