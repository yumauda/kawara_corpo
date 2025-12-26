"use strict";

const chooseSlider = new Swiper(".choose-slider", {
  slidesPerView: 1.5,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  spaceBetween: 50,
});

const topicsSlider = new Swiper(".swiper-topics", {
  slidesPerView: 3.8,
  centeredSlides: false,
  loop: true,
  initialSlide: 0,
  spaceBetween: 30,
});
const voiceSlider = new Swiper(".voice-slider", {
  slidesPerView: 3.5,
  centeredSlides: true,
  loop: true,
  spaceBetween: 60,
  watchSlidesProgress: true,

  on: {
    afterInit(sw) {
      applyGapCenter(sw);
    },
    resize(sw) {
      // リサイズでグリッドが作り直されるので再適用
      sw.update();
      applyGapCenter(sw);
    },
    update(sw) {
      // updateが走ったときも念のため
      applyGapCenter(sw);
    },
  },
});
function applyGapCenter(sw) {
  if (!sw.slides || !sw.slides.length) return;

  // 以前に適用した分があれば一旦戻す（再適用時のズレ防止）
  const prev = sw.__gapShift || 0;
  if (prev) {
    sw.snapGrid = sw.snapGrid.map((v) => v - prev);
    sw.slidesGrid = sw.slidesGrid.map((v) => v - prev);
    sw.translate += prev; // ここは符号に注意（下でまた調整）
  }

  const slideSize = sw.slides[0].swiperSlideSize; // 等幅前提
  const shift = (slideSize + sw.params.spaceBetween) / 2;

  // スナップ位置(=止まる場所)を「半コマ」ずらす
  sw.snapGrid = sw.snapGrid.map((v) => v + shift);
  sw.slidesGrid = sw.slidesGrid.map((v) => v + shift);

  // 現在位置も同じだけずらして見た目を維持
  sw.translate -= shift;
  sw.setTranslate(sw.translate);

  sw.__gapShift = shift;
}

const slider2 = new Swiper(".slider2", {
  slidesPerView: 1.6,
  centeredSlides: true,
  loop: false,
  spaceBetween: 52,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 2,
      spaceBetween: 32,
      centeredSlides: false,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  scrollbar: {
    el: ".swiper-scrollbar",
  },
});
const slider3 = new Swiper(".slider3", {
  slidesPerView: 1.2,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  scrollbar: {
    el: ".swiper-scrollbar",
  },
});

// ピックアップタブスライダー
const sliderPickup = new Swiper(".slider-pickup", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
    },
  },
  navigation: {
    nextEl: '[data-content="all"] .swiper-button-next',
    prevEl: '[data-content="all"] .swiper-button-prev',
  },
});

const sliderStay = new Swiper(".slider-stay", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
    },
  },
  navigation: {
    nextEl: '[data-content="stay"] .swiper-button-next',
    prevEl: '[data-content="stay"] .swiper-button-prev',
  },
});

const sliderFood = new Swiper(".slider-food", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
    },
  },
  navigation: {
    nextEl: '[data-content="food"] .swiper-button-next',
    prevEl: '[data-content="food"] .swiper-button-prev',
  },
});

const sliderRestaurant = new Swiper(".slider-restaurant", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
    },
  },
  navigation: {
    nextEl: '[data-content="restaurant"] .swiper-button-next',
    prevEl: '[data-content="restaurant"] .swiper-button-prev',
  },
});

const sliderNews = new Swiper(".slider-news", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 3,
      centeredSlides: false,
    },
  },
  navigation: {
    nextEl: '[data-content="news"] .swiper-button-next',
    prevEl: '[data-content="news"] .swiper-button-prev',
  },
});

const slider4 = new Swiper(".slider4", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  spaceBetween: 10,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 2.2,
      spaceBetween: 10,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  scrollbar: {
    el: ".swiper-scrollbar",
  },
});
const slider5 = new Swiper(".slider5", {
  slidesPerView: 1.1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 1.8,
      spaceBetween: 10,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    },
  },
  navigation: {
    nextEl: ".slider5 .swiper-button-next",
    prevEl: ".slider5 .swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
