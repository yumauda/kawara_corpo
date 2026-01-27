"use strict";

const chooseSlider = new Swiper(".choose-slider", {
  slidesPerView: 1.2,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  spaceBetween: 16,
  breakpoints: {
    768: {
      slidesPerView: 1.5,
      centeredSlides: true,
      loop: true,
      initialSlide: 0,
      spaceBetween: 50,
    },
  },
});

const topicsSlider = new Swiper(".swiper-topics", {
  slidesPerView: 1.2,
  centeredSlides: false,
  loop: true,
  initialSlide: 0,
  spaceBetween: 12,
  breakpoints: {
    768: {
      slidesPerView: 2.8,
      centeredSlides: false,
      loop: true,
      initialSlide: 0,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 3.8,
      centeredSlides: false,
      loop: true,
      initialSlide: 0,
      spaceBetween: 30,
    },
  },
});

const exampleSlider = new Swiper(".swiper-example", {
  slidesPerView: 1.1,
  centeredSlides: true,
  spaceBetween: -10,
  loop: true,
  initialSlide: 0,

  breakpoints: {
    768: {
      slidesPerView: "auto",
      centeredSlides: false,
      loop: true,
      initialSlide: 0,
    },
  },

  on: {
    init(swiper) {
      applyStairsClasses(swiper);
    },
    slideChangeTransitionStart(swiper) {
      applyStairsClasses(swiper);
    },
    resize(swiper) {
      applyStairsClasses(swiper);
    },
  },
});

function applyStairsClasses(swiper) {
  const slides = swiper.slides; // loopの複製スライドも含む
  const active = swiper.activeIndex;

  slides.forEach((el) => {
    el.classList.remove(
      "is-active",
      "is-prev",
      "is-next",
      "is-prev2",
      "is-next2",
      "is-far"
    );
  });

  const get = (i) => slides[(i + slides.length) % slides.length];

  get(active).classList.add("is-active");
  get(active - 1).classList.add("is-prev");
  get(active + 1).classList.add("is-next");
  get(active - 2).classList.add("is-prev2");
  get(active + 2).classList.add("is-next2");

  // それ以外も少し落とす（不要ならこのブロック削除OK）
  slides.forEach((el) => {
    if (
      !el.classList.contains("is-active") &&
      !el.classList.contains("is-prev") &&
      !el.classList.contains("is-next") &&
      !el.classList.contains("is-prev2") &&
      !el.classList.contains("is-next2")
    ) {
      el.classList.add("is-far");
    }
  });
}

const voiceSlider = new Swiper(".voice-slider", {
  // SP（デフォルト）
  slidesPerView: 1.5,
  centeredSlides: true,
  loop: true,
  spaceBetween: 16,

  breakpoints: {
    768: {
      slidesPerView: 2.5,
      centeredSlides: true,
      loop: true,
      spaceBetween: 24,
      watchSlidesProgress: true,
    },
    992: {
      slidesPerView: 3.5,
      centeredSlides: true,
      loop: true,
      spaceBetween: 60,
      watchSlidesProgress: true,
    },
  },

  on: {
    afterInit(sw) {
      if (window.matchMedia("(min-width: 768px)").matches) {
        applyGapCenter(sw);
      } else {
        resetGapCenter(sw);
      }
    },
    resize(sw) {
      // リサイズでグリッドが作り直されるので再適用
      sw.update();
      if (window.matchMedia("(min-width: 768px)").matches) {
        applyGapCenter(sw);
      } else {
        resetGapCenter(sw);
      }
    },
    update(sw) {
      // updateが走ったときも念のため
      if (window.matchMedia("(min-width: 768px)").matches) {
        applyGapCenter(sw);
      }
    },
  },
});
function resetGapCenter(sw) {
  if (!sw || !sw.snapGrid || !sw.slidesGrid) return;
  const prev = sw.__gapShift || 0;
  if (!prev) return;

  sw.snapGrid = sw.snapGrid.map((v) => v - prev);
  sw.slidesGrid = sw.slidesGrid.map((v) => v - prev);
  sw.translate += prev;
  sw.setTranslate(sw.translate);
  sw.__gapShift = 0;
}
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

const slider4 = new Swiper(".slider-topics", {
  slidesPerView: 1.1,
  centeredSlides: false,
  loop: true,
  initialSlide: 0,
  spaceBetween: 10,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 2.1,
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

const singleSlider = new Swiper(".swiper-single", {
  slidesPerView: 1,
  centeredSlides: true,
  loop: true,
  initialSlide: 0,
  spaceBetween: 40,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});