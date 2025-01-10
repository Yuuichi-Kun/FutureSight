let menuOpen = document.querySelector('.menu-toggle');
let menuWrapper = document.querySelector('.menu-wrapper');

menuOpen.addEventListener('click', function() {
    if(menuOpen.classList.contains("bxs-grid-alt")) {
        menuOpen.classList.remove("bxs-grid-alt");
        menuOpen.classList.add("bx-x");
    } else {
        menuOpen.classList.remove("bx-x");
        menuOpen.classList.add("bxs-grid-alt");
    }
    menuWrapper.classList.toggle('active');
});

var swiper = new Swiper(".mySwiperTestimoni", {
    pagination: {
      el: ".swiper-pagination",
    },
  });

var swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },
    navigation: {
        nextEl: ".bxs-chevron-right-circle",
        prevEl: ".bxs-chevron-left-circle",
      },
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
  });

  