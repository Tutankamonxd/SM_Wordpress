"use strict";
// document.addEventListener('DOMContentLoaded', function () {

//     // Function to apply animations
//     function applyAnimations(slide) {
//       // Remove any existing animation classes
//       slide.querySelectorAll('.animate__animated').forEach(el => {
//           el.classList.remove('animate__animated');
//           el.style.animationDelay = ''; // Reset delay
//           el.style.animationDuration = ''; // Reset duration
//       });

//       // Add animation classes and set delay and duration based on data-animation, data-delay, and data-duration attributes
//       slide.querySelectorAll('[data-animation]').forEach(el => {
//           const animation = el.getAttribute('data-animation');
//           const delay = el.getAttribute('data-delay');
//           const duration = el.getAttribute('data-duration');

//           if (animation) {
//               el.classList.add('animate__animated', `animate__${animation}`);
//               if (delay) {
//                   el.style.animationDelay = delay;
//               }
//               if (duration) {
//                   el.style.animationDuration = duration;
//               }
//           }
//       });
//   }

//   const settingsData = configObj.settings || {};

//   // Iterate over each settings object
//   settingsData.forEach((settingsObj) => {
//     // Parse the JSON-formatted general settings
//     const general = JSON.parse(settingsObj.general);
//     const content = JSON.parse(settingsObj.content);
//     const navigation = JSON.parse(settingsObj.navigation);
//     const pagination = JSON.parse(settingsObj.pagination);
  
  
//     const animationType = (typeof general.animationType === 'string' && general.animationType !== "Select Effect") ? general.animationType : "slide";
  
//     // console.log(animationType);
  
    
//     const sliderType = settingsObj.sliderType;
  
//     const sliderXConfig = {
//       // direction: getDirection(), // Direction: "horizontal", "vertical"
//       slidesPerView: 1, // auto, 1,2,3 etc.
//       slidesPerColumn: 2,
//       effect: animationType, // Effect: fade, slide, cube, flip, cards, coverflow etc
//       lazy: true,
//       slidesPerView: 'auto',
//       speed: 600,
//       parallax: true,
//       zoom: true,
//       // on: {
//       //   resize: function () {
//       //     swiper.changeDirection(getDirection(sliderType));
//       //   },
//       // },
//       // on: {
//       //   init: function () {
//       //     AOS.refresh(); // Refresh AOS on slider init
//       //   },
//       //   slideChange: function () {
//       //     // Timeout to allow Swiper to complete its transition
//       //     setTimeout(() => {
//       //       AOS.refresh(); // Refresh AOS on slide change
//       //     }, 300); // Adjust timeout as needed
//       //   }
//       // },
//       on: {
//         init: function () {
//             // Apply animations on initialization
//             const initialSlide = document.querySelector('.swiper-slide.swiper-slide-active');
//             if (initialSlide) {
//                 applyAnimations(initialSlide);
//             }
//         },
//         slideChange: function () {
//             // Apply animations on slide change
//             const previousSlide = document.querySelector('.swiper-slide.swiper-slide-prev');
//             const currentSlide = document.querySelector('.swiper-slide.swiper-slide-active');

//             if (previousSlide) {
//                 previousSlide.querySelectorAll('.animate__animated').forEach(el => {
//                     el.classList.remove('animate__animated');
//                     el.style.animationDelay = ''; // Reset delay
//                     el.style.animationDuration = ''; // Reset duration
//                 });
//             }

//             if (currentSlide) {
//                 applyAnimations(currentSlide);
//             }
//         }
//     }



//     }
  
//     /* ============ Animation Type: coverflow ============ */
//     if (animationType === "coverflow") {
//       sliderXConfig.coverflowEffect = {
//         rotate: 50,
//         stretch: 0,
//         depth: 100,
//         modifier: 1,
//         slideShadows: true,
//       }
//     }
//     if (animationType === "cube") {
//       sliderXConfig.grabCursor = true,
//         sliderXConfig.cubeEffect = {
//           shadow: true,
//           slideShadows: true,
//           shadowOffset: 20,
//           shadowScale: 0.94,
//         }
//     }
  
  
//     /* ============ Slider Type ============ */
//     if (sliderType === "carousel" || sliderType === 'centermode' || sliderType === 'carowave') {
//       sliderXConfig.spaceBetween = 20,
//         sliderXConfig.breakpoints = {
//           480: {
//             slidesPerView: 1,
//             spaceBetween: 20,
//           },
//           640: {
//             slidesPerView: 2,
//             spaceBetween: 20,
//           },
//           768: {
//             slidesPerView: 3,
//             spaceBetween: 20,
//           },
//           1024: {
//             slidesPerView: 4,
//             spaceBetween: 20,
//           },
//           1920: {
//             slidesPerView: 4,
//             spaceBetween: 20,
//           },
//         }
      
//     }
  
//     const thumbnailSelector = `#sliderX_thumbnail-${settingsObj.sliderId}`;
//     var thumbSwiper = new Swiper(thumbnailSelector, {
//       loop: true,
//       spaceBetween: 10,
//       slidesPerView: 4,
//       freeMode: true,
//       watchSlidesProgress: true,
//     });
    
//     if (sliderType === "thumbnail") {
//       sliderXConfig.thumbs = {
//         swiper: thumbSwiper,
//       }
      
//     }
  
//     /* ============ General ============ */
//     const layoutType = general.layout;
//     const layoutDir = general.layoutDir;
  
//     // AutoPlay
//     const autoPlayVal = general.autoPlay === "true";
//     const autoPlayProp = general.autoPlayProp;
//     const autoPlayDelay = Number(autoPlayProp.autoPlayDelay);
//     const pauseOnHover = autoPlayProp.pauseOnHover === "true";
//     const disableOnInteraction = autoPlayProp.disableOnInteraction === "true";
  
    
//     if (layoutDir === "vertical" && (sliderType === "featured" || sliderType === "slider")) {
//       sliderXConfig.direction = "vertical";
    
//       const nextButton = document.querySelector('.swiper-button-next');
//       const prevButton = document.querySelector('.swiper-button-prev');
    
//       if (nextButton) {
//         nextButton.style.right = '20px';
//         nextButton.style.transform = 'rotate(90deg)';
//       }
    
//       if (prevButton) {
//         prevButton.style.left = '20px';
//         prevButton.style.transform = 'rotate(90deg)';
//       }
//     } else {
//       sliderXConfig.direction = "horizontal";
//     }
    
//     if (autoPlayVal) {
//       sliderXConfig.autoplay = {
//         delay: autoPlayDelay,
//         pauseOnMouseEnter: pauseOnHover,
//         disableOnInteraction: disableOnInteraction,
//       }
//     }
  
//     // Loop
//     sliderXConfig.loop = general.loop === "false" ? false : Boolean(general.loop);
//     // KeyboardControl
//     const KeyboardControlVal = general.KeyboardControl === "true";
//     if (KeyboardControlVal) {
//       sliderXConfig.keyboard = {
//         enabled: true,
//       }
//     }
//     // MouseWheel
//     sliderXConfig.mousewheel = general.mouseWheel === "false" ? false : Boolean(general.mouseWheel);
//     // Center Slides
//     sliderXConfig.centeredSlides = general.centeredSlide === "false" ? false : Boolean(general.centeredSlide);
  
//     /* ========= Navigation ===========*/
//     const navigationVal = navigation.navigation === "true";
//     if (navigationVal) {
//       sliderXConfig.navigation = {
//         nextEl: ".swiper-button-prev",
//         prevEl: ".swiper-button-next",
//       }
//     }
    
//     /* ========= Pagination =========*/
//     const paginationVal = pagination.paginationVal === "true";
//     const paginationType = pagination.paginationType || 'bullets';
//     const position = pagination.position;
  
//     if (paginationVal) {
//       sliderXConfig.pagination = {
//         el: ".swiper-pagination",
//         type: paginationType,
//         clickable: true,
//         dynamicBullets: paginationType === "bullets" ? true : false, // use this when pagination type bullets
//       }
//     }
//     // sliderX Initialization
//     const sliderSelector = `#sliderX-${settingsObj.sliderId}`;
//     var swiper = new Swiper(sliderSelector, sliderXConfig);
//     // var sliderx = new Swiper('.sliderX_center', sliderXConfig);
//   });







// });



//  callback Function
// function getDirection(sliderType) {
//   let windowWidth = window.innerWidth;
//   let direction = layoutDir === "vertical" && windowWidth <= 760 ? 'vertical' : 'horizontal';

//   return direction;
// }



document.addEventListener('DOMContentLoaded', function () {

  // Function to apply animations

  function applyAnimations(slide) {
    // Remove any existing animation classes
    slide.querySelectorAll('.animate__animated').forEach(el => {
      el.classList.remove('animate__animated');
      el.style.animationDelay = ''; // Reset delay
      el.style.animationDuration = ''; // Reset duration
    });

    // Add animation classes and set delay and duration based on data-animation, data-delay, and data-duration attributes
    slide.querySelectorAll('[data-animation]').forEach(el => {
      const animation = el.getAttribute('data-animation');
      const delay = el.getAttribute('data-delay');
      const duration = el.getAttribute('data-duration');

      if (animation) {
        el.classList.add('animate__animated', `animate__${animation}`);
        if (delay) {
          el.style.animationDelay = delay;
        }
        if (duration) {
          el.style.animationDuration = duration;
        }
      }
    });
  };

  const settingsData = configObj.settings || [];

  // Iterate over each settings object
  settingsData.forEach((settingsObj) => {
      // Parse the JSON-formatted general settings
      const general = JSON.parse(settingsObj.general);
      const content = JSON.parse(settingsObj.content);
      const navigation = JSON.parse(settingsObj.navigation);
      const pagination = JSON.parse(settingsObj.pagination);

      const animationType = (typeof general.animationType === 'string' && general.animationType !== "Select Effect") ? general.animationType : "slide";
      const sliderType = settingsObj.sliderType;

      const sliderXConfig = {
          slidesPerView: 1,
          slidesPerColumn: 2,
          effect: animationType,
          lazy: true,
          slidesPerView: 'auto',
          speed: 600,
          parallax: true,
          zoom: true,
          on: {
            init: function () {
              console.log('Swiper initialized');
              const initialSlide = document.querySelector('.swiper-slide.swiper-slide-active');
              if (initialSlide) {
                applyAnimations(initialSlide);
              }
            },
            slideChange: function () {
              // Delay the application of animations to ensure Swiper transition completes
              setTimeout(() => {
                const previousSlide = document.querySelector('.swiper-slide.swiper-slide-prev');
                const currentSlide = document.querySelector('.swiper-slide.swiper-slide-active');
    
                if (previousSlide) {
                  previousSlide.querySelectorAll('.animate__animated').forEach(el => {
                    el.classList.remove('animate__animated');
                    el.style.animationDelay = ''; // Reset delay
                    el.style.animationDuration = ''; // Reset duration
                  });
                }
    
                if (currentSlide) {
                  applyAnimations(currentSlide);
                }
              }, 300); // Adjust timeout as needed
            }
          }
      };

      // Animation Types
      if (animationType === "coverflow") {
          sliderXConfig.coverflowEffect = {
              rotate: 50,
              stretch: 0,
              depth: 100,
              modifier: 1,
              slideShadows: true,
        };
        sliderXConfig.centeredSlides = true
      }
      if (animationType === "cube") {
          sliderXConfig.grabCursor = true;
          sliderXConfig.cubeEffect = {
              shadow: true,
              slideShadows: true,
              shadowOffset: 20,
              shadowScale: 0.94,
          };
      }

      // Slider Types
      if (sliderType === "carousel" || sliderType === 'centermode' || sliderType === 'carowave') {
          sliderXConfig.spaceBetween = 20;
          sliderXConfig.breakpoints = {
              480: {
                  slidesPerView: 1,
                  spaceBetween: 20,
              },
              640: {
                  slidesPerView: 2,
                  spaceBetween: 20,
              },
              768: {
                  slidesPerView: 3,
                  spaceBetween: 20,
              },
              1024: {
                  slidesPerView: 3,
                  spaceBetween: 20,
              },
              1920: {
                  slidesPerView: 4,
                  spaceBetween: 20,
              },
          };
      }

      const thumbnailSelector = `#sliderX_thumbnail-${settingsObj.sliderId}`;
      const thumbSwiper = new Swiper(thumbnailSelector, {
          loop: true,
          spaceBetween: 10,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
      });

      if (sliderType === "thumbnail") {
          sliderXConfig.thumbs = {
              swiper: thumbSwiper,
          };
      }

      // General Settings
      const layoutDir = general.layoutDir;
      const autoPlayVal = general.autoPlay === "true";
      const autoPlayProp = general.autoPlayProp;
      const autoPlayDelay = Number(autoPlayProp.autoPlayDelay);
      const pauseOnHover = autoPlayProp.pauseOnHover === "true";
      const disableOnInteraction = autoPlayProp.disableOnInteraction === "true";

      if (layoutDir === "vertical" && (sliderType === "featured" || sliderType === "slider")) {
          sliderXConfig.direction = "vertical";

          const nextButton = document.querySelector('.swiper-button-next');
          const prevButton = document.querySelector('.swiper-button-prev');

          if (nextButton) {
              nextButton.style.right = '20px';
              nextButton.style.transform = 'rotate(90deg)';
          }

          if (prevButton) {
              prevButton.style.left = '20px';
              prevButton.style.transform = 'rotate(90deg)';
          }
      } else {
          sliderXConfig.direction = "horizontal";
      }

      if (autoPlayVal) {
          sliderXConfig.autoplay = {
              delay: autoPlayDelay,
              pauseOnMouseEnter: pauseOnHover,
              disableOnInteraction: disableOnInteraction,
          };
      }

      sliderXConfig.loop = general.loop === "false" ? false : Boolean(general.loop);
      const KeyboardControlVal = general.KeyboardControl === "true";
      if (KeyboardControlVal) {
          sliderXConfig.keyboard = {
              enabled: true,
          };
      }
      sliderXConfig.mousewheel = general.mouseWheel === "false" ? false : Boolean(general.mouseWheel);
      sliderXConfig.centeredSlides = general.centeredSlide === "false" ? false : Boolean(general.centeredSlide);

      // Navigation
      const navigationVal = navigation.navigation === "true";
      if (navigationVal) {
          sliderXConfig.navigation = {
              nextEl: ".swiper-button-prev",
              prevEl: ".swiper-button-next",
          };
      }

      // Pagination
      const paginationVal = pagination.paginationVal === "true";
      const paginationType = pagination.paginationType || 'bullets';
      if (paginationVal) {
          sliderXConfig.pagination = {
              el: ".swiper-pagination",
              type: paginationType,
              clickable: true,
              dynamicBullets: paginationType === "bullets",
          };
      }

      // Initialize Swiper
      const sliderSelector = `#sliderX-${settingsObj.sliderId}`;
      const swiper = new Swiper(sliderSelector, sliderXConfig);
  });



});










