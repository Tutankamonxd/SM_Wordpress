"use strict";

document.addEventListener('DOMContentLoaded', function () {

    console.log("sliderx loaded");

    // Function to apply animations
    function applyAnimations(slide) {
        slide.querySelectorAll('.animate__animated').forEach(el => {
            el.classList.remove('animate__animated');
            el.style.animationDelay = '';
            el.style.animationDuration = '';
        });

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
    }

    // Function to initialize the Swiper for each settings object
    function WidgetSliderxHandler($scope) {
        const settingsData = configObj?.settings || []; // Ensure configObj is available
        settingsData.forEach((settingsObj) => {
            if (!settingsObj) {
                console.error('Slider settings are missing.');
                return;
            }

            const general = JSON.parse(settingsObj.general);
            const content = JSON.parse(settingsObj.content);
            const navigation = JSON.parse(settingsObj.navigation);
            const pagination = JSON.parse(settingsObj.pagination);

            const animationType = general.animationType || "slide";
            const sliderType = settingsObj.sliderType;

            const sliderXConfig = {
                slidesPerView: 1,
                effect: animationType,
                lazy: true,
                speed: 600,
                parallax: true,
                zoom: true,
                on: {
                    init: function () {
                        const initialSlide = $scope.querySelector('.swiper-slide.swiper-slide-active');
                        if (initialSlide) {
                            applyAnimations(initialSlide);
                        }
                    },
                    slideChangeTransitionStart: function () {
                        const previousSlide = $scope.querySelector('.swiper-slide.swiper-slide-prev');
                        const currentSlide = $scope.querySelector('.swiper-slide.swiper-slide-active');

                        if (previousSlide) {
                            previousSlide.querySelectorAll('.animate__animated').forEach(el => {
                                el.classList.remove('animate__animated');
                                el.style.animationDelay = '';
                                el.style.animationDuration = '';
                            });
                        }
                        if (currentSlide) {
                            applyAnimations(currentSlide);
                        }
                    }
                }
            };

            // Adjust settings based on animation type and slider type
            if (animationType === "coverflow") {
                sliderXConfig.coverflowEffect = {
                    rotate: 50,
                    stretch: 0,
                    depth: 100,
                    modifier: 1,
                    slideShadows: true,
                };
                sliderXConfig.centeredSlides = true;
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

            if (sliderType === "carousel" || sliderType === 'centermode' || sliderType === 'carowave') {
                sliderXConfig.spaceBetween = 20;
                sliderXConfig.breakpoints = {
                    480: { slidesPerView: 1, spaceBetween: 20 },
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 20 },
                    1920: { slidesPerView: 4, spaceBetween: 20 },
                };
            }

            const thumbnailSelector = $scope.querySelector(`#sliderX_thumbnail-${settingsObj.sliderId}`);
            const thumbSwiper = new Swiper(thumbnailSelector, {
                loop: true,
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });

            if (sliderType === "thumbnail") {
                sliderXConfig.thumbs = { swiper: thumbSwiper };
            }

            const layoutDir = general.layoutDir;
            const autoPlayVal = general.autoPlay === "true";
            const autoPlayProp = general.autoPlayProp;
            const autoPlayDelay = Number(autoPlayProp.autoPlayDelay);
            const pauseOnHover = autoPlayProp.pauseOnHover === "true";
            const disableOnInteraction = autoPlayProp.disableOnInteraction === "true";

            if (layoutDir === "vertical" && (sliderType === "featured" || sliderType === "slider")) {
                sliderXConfig.direction = "vertical";

                const nextButton = $scope.querySelector('.swiper-button-next');
                const prevButton = $scope.querySelector('.swiper-button-prev');

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

            sliderXConfig.loop = general.loop !== "false";
            const KeyboardControlVal = general.KeyboardControl === "true";
            if (KeyboardControlVal) {
                sliderXConfig.keyboard = { enabled: true };
            }
            sliderXConfig.mousewheel = general.mouseWheel !== "false";
            sliderXConfig.centeredSlides = general.centeredSlide !== "false";

            const navigationVal = navigation.navigation === "true";
            if (navigationVal) {
                sliderXConfig.navigation = {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                };
            }

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

            const sliderSelector = $scope.querySelector(`#sliderX-${settingsObj.sliderId}`);
            const swiper = new Swiper(sliderSelector, sliderXConfig);
        });
    }

    // Initialize the widget under Elementor
    window.addEventListener('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/sliderx-widget.default', function ($scope) {
            WidgetSliderxHandler($scope[0]);
        });
    });

});
