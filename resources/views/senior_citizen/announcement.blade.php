@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section class="min-h-screen font-poppins">
    <div class="text-4xl font-bold mb-6 mt-6 justify-center flex leading-tight tracking-tight text-gray-900 md:text-4xl">
        <p class="mx-[48px] text-left">
            Announcement
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start" style="background-color: #fff ;">
        <div class="overflow-hidden lg:flex justify-center items-center h-full relative">

            <div class="absolute inset-0 bg-[#fff] animate-slide-out-right duration-[2000ms] delay-[1000ms]"></div>

            <img src="{{ asset('images/announcement_header.jpg') }}" alt="Announcement Image" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#fff]/100"></div>
        </div>


        <div class="z-[1] animate-fade-in-up duration-[2000ms] delay-[1000ms] flex flex-col justify-center items-end text-right pr-4 pl-4 h-full">
            <span class="text-4xl mt-4 font-bold lg:text-6xl" style="color: #FF4802 ;">Stay Informed: OSCA Pension Announcements & Events.</span>
            <p class="text-black text-lg mt-8 pb-8 leading-relaxed">
                This is where you'll find the latest updates and essential information on OSCA Social Pension distribution, including schedules, eligibility, and more. Our Events section also keeps you informed about activities and gatherings in your community. Check back regularly to stay up-to-date!
            </p>
        </div>
    </div>
    <div class="mx-4 lg:mx-[48px]">
        <div class="w-full max-w-7xl mx-auto flex-fol items-center justify-center font-[poppins]">
    
            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left">
                    Pension Distribution
                </p>
            </div>

            <div class="overflow-x-auto lg:overflow-visible">

                <table class="min-w-full table-auto drop-shadow-lg relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8" data-aos="zoom-in-up">
                    <thead>
                        <tr class="bg-[#FF4802] text-white">
                            <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                            <th class="px-4 py-2 font-semibold text-left">Barangay No.</th>
                            <th class="px-4 py-2 font-semibold text-left">Locality</th>
                            <th class="px-4 py-2 font-semibold text-left">Venue</th>
                            <th class="px-4 py-2 font-semibold text-left">Date of Distribution</th>
                            <th class="px-4 py-2 font-semibold rounded-t-md text-left">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-[#ffece5] lg:hover:bg-[#ffc8b3] lg:hover:scale-105 transition duration-150 ease-in-out">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">Barangay 175</td>
                            <td class="px-4 py-2">Camarin</td>
                            <td class="px-4 py-2">Community Center</td>
                            <td class="px-4 py-2">November 17, 2024</td>
                            <td class="px-4 py-2">9:00 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left">
                    Events
                </p>
            </div>

            <div id="default-carousel" class="relative w-full shadow-lg mb-16" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1: Active (Visible) -->
        <div class="absolute inset-0 transition-transform transform translate-x-0 duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/about_us_top.jpg') }}" alt="Event 1" class="block w-full h-full object-cover rounded-lg">
        </div>
        <!-- Item 2 -->
        <div class="absolute inset-0 transition-transform transform translate-x-full duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 2" class="block w-full h-full object-cover rounded-lg">
        </div>
        <!-- Item 3 -->
        <div class="absolute inset-0 transition-transform transform translate-x-full duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/about_us_top.jpg') }}" alt="Event 3" class="block w-full h-full object-cover rounded-lg">
        </div>
        <!-- Item 4 -->
        <div class="absolute inset-0 transition-transform transform translate-x-full duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 4" class="block w-full h-full object-cover rounded-lg">
        </div>
        <!-- Item 5 -->
        <div class="absolute inset-0 transition-transform transform translate-x-full duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('images/about_us_top.jpg') }}" alt="Event 5" class="block w-full h-full object-cover rounded-lg">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>




        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.getElementById('default-carousel');
        const items = carousel.querySelectorAll('[data-carousel-item]');
        const indicators = carousel.querySelectorAll('[data-carousel-slide-to]');
        const prevButton = carousel.querySelector('[data-carousel-prev]');
        const nextButton = carousel.querySelector('[data-carousel-next]');

        let activeIndex = 0;
        const totalItems = items.length;

        const updateSlide = (newIndex) => {
            // Remove current visible state
            items[activeIndex].classList.remove('translate-x-0');
            items[activeIndex].classList.add(newIndex > activeIndex ? '-translate-x-full' : 'translate-x-full');

            // Update active index
            activeIndex = newIndex;

            // Add visible state to the new slide
            items[activeIndex].classList.remove('translate-x-full', '-translate-x-full');
            items[activeIndex].classList.add('translate-x-0');

            // Update indicators
            indicators.forEach((indicator, i) => {
                indicator.ariaCurrent = i === activeIndex ? 'true' : 'false';
                indicator.classList.toggle('bg-blue-500', i === activeIndex);
                indicator.classList.toggle('bg-gray-300', i !== activeIndex);
            });
        };

        const goToNext = () => {
            const nextIndex = (activeIndex + 1) % totalItems;
            updateSlide(nextIndex);
        };

        const goToPrev = () => {
            const prevIndex = (activeIndex - 1 + totalItems) % totalItems;
            updateSlide(prevIndex);
        };

        const goToSlide = (index) => {
            updateSlide(index);
        };

        // Attach event listeners
        nextButton.addEventListener('click', goToNext);
        prevButton.addEventListener('click', goToPrev);

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => goToSlide(index));
        });

        // Initialize the carousel
        updateSlide(activeIndex);

        // Optional: Auto-slide functionality (uncomment if needed)
        // const autoSlideInterval = 5000; // 5 seconds
        // setInterval(goToNext, autoSlideInterval);
    });
</script>


@include('partials.senior_citizen.footer')
