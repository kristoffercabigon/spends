<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title !== "" ? $title : 'SPENDS System'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    {!!htmlScriptTagJsApi()!!}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body class="bg-white font-poppins min-h-screen pt-[80px]">

<x-messages.senior_citizen.messages />
<x-messages.senior_citizen.error_messages />

<div id="accessibility-toolbar" class="animate-drop-in transition-opacity" style="position: fixed; top: 220px; bottom: 330px; right: 10px; z-index: 9999; background: #fff; padding-top: 10px; padding-left: 2px; padding-right: 2px; padding-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; display: none; flex-direction: column;">
    <button id="increase-font" class="flex items-center justify-center"><img id="increase-font" src="../../images/add.png" class="w-4 h-4" alt="Increase Font" style="cursor: pointer;" /></button>
    <button id="decrease-font" class="flex items-center justify-center"><img id="decrease-font" src="../../images/minus.png" class="w-4 h-4" alt="Decrease Font" style="cursor: pointer;" /></button>
    <button id="grayscale-toggle" class="flex items-center justify-center"><img id="grayscale-toggle" src="../../images/droplet.png" class="w-4 h-4" alt="Grayscale" style="cursor: pointer;" /></button>
    <button id="reset-settings" class="flex items-center justify-center"><img id="reset-settings" src="../../images/undo.png" class="w-4 h-4" alt="Reset Settings" style="cursor: pointer;" /></button>
</div>

<div id="floating-button" style="position: fixed; top: 170px; right: 10px; z-index: 9999; background-color: #2196F3; width: 50px; height: 50px; color: #fff; border-radius: 5px; display: flex; justify-content: center; align-items: center; cursor: pointer; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
    <img src="../../images/accessibility.png" alt="Accessibility" class="h-10 w-10">
</div>

<style>
    body.grayscale {
        filter: grayscale(100%);
    }

    #accessibility-toolbar {
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 9999;
        background: #fff;
        padding: 10px 2px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: none;
        flex-direction: column;
    }

    #floating-button {
        position: fixed;
        bottom: 10px;
        right: 10px;
        z-index: 9999;
        background-color: #2196F3;
        width: 50px;
        height: 50px;
        color: #fff;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }

    #accessibility-toolbar button {
        margin: 5px;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        background-color: #2196F3;
        color: #fff;
        border: none;
        border-radius: 3px;
    }

    #accessibility-toolbar button:hover {
        background-color: #1E88E5;
    }

    #floating-button:hover {
        background-color: #1E88E5;
    }

    #accessibility-toolbar img, 
    #floating-button img {
        width: 16px !important;  
        height: 16px !important; 
    }

    #floating-button img {
        width: 40px !important;
        height: 40px !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const body = document.body;
        const accessibilityToolbar = document.getElementById("accessibility-toolbar");
        const floatingButton = document.getElementById("floating-button");
        const circles = document.getElementById("circles");
        let fontSize = localStorage.getItem("fontSize") ? parseInt(localStorage.getItem("fontSize")) : 16;
        let isGrayscale = localStorage.getItem("grayscale") === "true";

        function applyFontSize() {
            document.documentElement.style.fontSize = fontSize + "px";
        }

        function applyGrayscale() {
            const screenWidth = window.innerWidth;

            if (isGrayscale) {
                body.classList.add("grayscale");

                if (screenWidth <= 1024) {
                    accessibilityToolbar.style.bottom = "830px";
                } else {
                    accessibilityToolbar.style.bottom = "720px";
                }

                if (circles) {
                    circles.style.display = "none";
                }
            } else {
                body.classList.remove("grayscale");

                if (screenWidth <= 1024) { 
                    accessibilityToolbar.style.bottom = "280px";
                } else {
                    accessibilityToolbar.style.bottom = "330px";
                }

                if (circles) {
                    circles.style.display = "block";
                }
            }
        }

        window.addEventListener("resize", applyGrayscale);

        applyFontSize();
        applyGrayscale();

        floatingButton.addEventListener("click", function () {
            accessibilityToolbar.style.display = accessibilityToolbar.style.display === "none" ? "flex" : "none";
        });

        document.getElementById("increase-font").addEventListener("click", function () {
            fontSize += 2;
            localStorage.setItem("fontSize", fontSize);
            applyFontSize();
        });

        document.getElementById("decrease-font").addEventListener("click", function () {
            if (fontSize > 10) {
                fontSize -= 2;
                localStorage.setItem("fontSize", fontSize);
                applyFontSize();
            }
        });

        document.getElementById("grayscale-toggle").addEventListener("click", function () {
            isGrayscale = !isGrayscale;
            localStorage.setItem("grayscale", isGrayscale);
            applyGrayscale();
        });

        document.getElementById("reset-settings").addEventListener("click", function () {
            localStorage.removeItem("fontSize");
            localStorage.removeItem("grayscale");
            location.reload();
        });
    });
</script>


@php 
$array = array('title' => 'SPENDS') 
@endphp

<x-senior_nav :data="$array"/>

<style>
    .swiper-button-prev:after,
    .swiper-rtl .swiper-button-next:after {
        content: '' !important;
    }

    .swiper-button-next:after,
    .swiper-rtl .swiper-button-prev:after {
        content: '' !important;
    }

    .swiper-button-next svg,
    .swiper-button-prev svg {
        width: 24px !important;
        height: 24px !important;
    }

    .swiper-button-next,
    .swiper-button-prev {
        position: relative !important;
    }

    .swiper-slide.swiper-slide-active {
        --tw-border-opacity: 1 !important;
        border-color: rgb(79 70 229 / var(--tw-border-opacity)) !important;
    }

    .swiper-slide.swiper-slide-active>.swiper-slide-active\:text-indigo-600 {
        --tw-text-opacity: 1;
        color: rgb(79 70 229 / var(--tw-text-opacity));
    }

    .swiper-slide.swiper-slide-active>.flex .grid .swiper-slide-active\:text-indigo-600 {
        --tw-text-opacity: 1;
        color: rgb(79 70 229 / var(--tw-text-opacity));
    }
</style>

<section class="min-h-screen font-poppins">
    <div class="text-4xl font-bold mb-6 mt-6 text-center leading-tight tracking-tight text-gray-900">
        <p>Event Details</p>
    </div>

    <div class="mx-4 lg:mx-[48px]">
        <div class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">
            
            <h2 class="font-bold mb-4 text-xl sm:text-2xl md:text-3xl lg:text-3xl">{{ $event->title }}</h2>

            @if ($event->image && $event->is_highlighted)
                <div class="relative">
                    <img src="{{ asset('storage/images/events/' . $event->image) }}" 
                        alt="Highlighted Event Image" 
                        class="w-full mb-4 rounded-lg shadow-md 
                            md:w-1/2 md:float-left md:mr-4 md:mb-4">
                    
                    <p class="text-gray-700 text-lg leading-relaxed">
                        {{ $event->description }}
                    </p>
                </div>
                <div class="clearfix"></div>
            @else
                <p class="text-gray-700 text-lg leading-relaxed">{{ $event->description }}</p>
            @endif

            @php
                if ($event->event_user_type_id == 2) {
                    $profilePicture = $event->encoder_profile_picture
                        ? asset('storage/images/encoder/encoder_thumbnail_profile/' . $event->encoder_profile_picture)
                        : "https://api.dicebear.com/9.x/initials/svg?seed={$event->encoder_first_name}-{$event->encoder_last_name}";
                    $authorName = $event->encoder_first_name . ' ' . $event->encoder_last_name;
                    $authorRole = "Encoder";
                } elseif ($event->event_user_type_id == 3) {
                    $profilePicture = $event->admin_profile_picture
                        ? asset('storage/images/admin/admin_thumbnail_profile/' . $event->admin_profile_picture)
                        : "https://api.dicebear.com/9.x/initials/svg?seed={$event->admin_first_name}-{$event->admin_last_name}";
                    $authorName = $event->admin_first_name . ' ' . $event->admin_last_name;
                    $authorRole = "Admin";
                } else {
                    $profilePicture = "https://api.dicebear.com/9.x/initials/svg?seed=Unknown";
                    $authorName = "Unknown";
                    $authorRole = "N/A";
                }
            @endphp
            
            <div class="mt-4 text-gray-600 flex items-center space-x-4">
                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }} |
                </p>

                <div class="flex items-center space-x-2">
                    <img src="{{ $profilePicture }}" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
                    <p class="font-semibold">{{ $authorName }}</p>
                </div>
            </div>

            @if ($event->video)
                <div class="mt-6">
                    <video controls class="w-full rounded-lg">
                        <source src="{{ asset('storage/videos/events/' . $event->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            <div class="mt-6">
                <h3 class="text-xl font-bold text-gray-900">Event Images</h3>
                <div id="default-carousel" class="relative w-full mt-4">
                    <div class="overflow-hidden relative w-full h-60 md:h-80">
                        @foreach ($eventImages as $key => $image)
                            <div class="absolute h-full w-full transition-transform transform translate-x-{{ $key === 0 ? '0' : '100%' }} carousel-item" data-carousel-item>
                                <img src="{{ asset('storage/images/events/' . $image->image) }}" 
                                    alt="Event Image" 
                                    class="w-full h-full object-contain rounded-lg">
                            </div>
                        @endforeach
                    </div>

                    <button class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full shadow-md" data-carousel-prev>
                        &#9664;
                    </button>
                    <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full shadow-md" data-carousel-next>
                        &#9654;
                    </button>

                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach ($eventImages as $key => $image)
                            <button class="w-3 h-3 rounded-full bg-gray-400 indicator {{ $key === 0 ? 'bg-blue-600' : '' }}" data-carousel-slide-to="{{ $key }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 mb-16">
                <h3 class="text-xl mb-4 font-bold text-gray-900">Other Events</h3>

                <div class="flex mb-16 justify-center flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between gap-8">

                    <div class="w-full">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @php
                                    $shuffledEvents = $events->shuffle();
                                @endphp

                                @foreach ($shuffledEvents as $event)
                                    <div class="swiper-slide w-full max-lg:max-w-xl lg:w-1/2 group">
                                        <div class="flex items-center mb-9">
                                            @if($event->image)
                                                <img src="{{ asset('storage/images/events/'.$event->image) }}" 
                                                    alt="{{ $event->title }}" 
                                                    class="rounded-2xl w-full object-cover" 
                                                    style="max-height: 250px; object-fit: cover; object-position: center;">
                                            @else
                                                <img src="{{ asset('path/to/default/image.jpg') }}" 
                                                    alt="Default Image" 
                                                    class="rounded-2xl w-full object-cover" 
                                                    style="max-height: 250px; object-fit: cover; object-position: center;">
                                            @endif
                                        </div>
                                        <h3 id="title" class="text-xl text-gray-900 font-medium leading-8 mb-4 group-hover:text-indigo-600">
                                            {{ $event->title }}
                                        </h3>
                                        <p id="description" class="text-gray-500 leading-6 transition-all duration-500 mb-8">
                                            {{ Str::limit($event->description, 100, '...') }}
                                        </p>
                                        <a href="/announcements/events/{{ $event->id }}" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                            Read more
                                            <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.25 6L13.25 6M9.5 10.5L13.4697 6.53033C13.7197 6.28033 13.8447 6.15533 13.8447 6C13.8447 5.84467 13.7197 5.71967 13.4697 5.46967L9.5 1.5" 
                                                    stroke="#4338CA" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-center mt-10 gap-8 mb-4">
                            <button id="slider-button-left" class="swiper-button-prev group flex justify-center items-center border border-solid border-[#1AA514] w-11 h-11 transition-all duration-500 rounded-full hover:bg-[#1AA514]" data-carousel-prev>
                                <svg class="h-6 w-6 text-[#1AA514] group-hover:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button id="slider-button-right" class="swiper-button-next group flex justify-center items-center border border-solid border-[#1AA514] w-11 h-11 transition-all duration-500 rounded-full hover:bg-[#1AA514]" data-carousel-next>
                                <svg class="h-6 w-6 text-[#1AA514] group-hover:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@include('partials.senior_citizen.footer')

<!-- Carousel Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.querySelector('#default-carousel');
        const items = carousel.querySelectorAll('[data-carousel-item]');
        const indicators = carousel.querySelectorAll('[data-carousel-slide-to]');
        let currentIndex = 0;

        function updateCarousel(index) {
            items.forEach((item, i) => {
                item.style.transform = `translateX(${(i - index) * 100}%)`;
            });
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('bg-blue-600', i === index);
                indicator.classList.toggle('bg-gray-400', i !== index);
            });
        }

        carousel.querySelector('[data-carousel-prev]').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel(currentIndex);
        });

        carousel.querySelector('[data-carousel-next]').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel(currentIndex);
        });

        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                currentIndex = i;
                updateCarousel(currentIndex);
            });
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel(currentIndex);
        }, 5000);

        updateCarousel(currentIndex);
    });
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4, 
        spaceBetween: 28,
        centeredSlides: false,
        loop: true,
        autoplay: {
            delay: 5000, 
            disableOnInteraction: false, 
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 20,
                centeredSlides: false,
            },
            568: {
                slidesPerView: 2,
                spaceBetween: 28,
                centeredSlides: false,
            },
            768: {
                slidesPerView: 2, 
                spaceBetween: 28,
                centeredSlides: false,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 32,
            },
        },
    });
</script>
