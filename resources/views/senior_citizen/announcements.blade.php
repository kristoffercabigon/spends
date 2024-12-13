@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
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
    <div class="text-4xl font-bold mb-6 mt-6 justify-center flex leading-tight tracking-tight text-gray-900 md:text-4xl">
        <p class="mx-[48px] text-left">
            Announcements
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
    
            <div class="text-2xl font-bold mb-4 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left">
                    Pension Distribution
                </p>
            </div>

            <div class="flex items-center justify-center mb-4">
                <div class="relative inline-block">
                    <div
                        id="dropdownMonthButton"
                        class="text-2xl flex flex-col md:flex-row justify-center items-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl cursor-pointer gap-1"
                    >
                        <div class="text-center md:text-left">
                            For the month of &nbsp;
                        </div>

                        <div
                            id="currentMonthDisplay"
                            class="font-bold tracking-wider leading-loose text-[#1AA514] flex items-center justify-center md:justify-start md:ml-1"
                        >
                            <span id="currentMonthDisplayText"></span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 text-[#1AA514]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="4"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    
                    <div
                        id="dropdownMonthMenu"
                        class="absolute animate-drop-in w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden right-0">
                        <ul id="monthList" class="py-1">
                            @foreach($availableMonths as $month)
                                <li class="px-4 py-2 cursor-pointer hover:bg-gray-100" data-month="{{ $month->month }}">
                                    {{ \Carbon\Carbon::parse($month->month)->format('F Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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
                        @foreach ($pension_distributions as $key => $pension_distribution)
                        <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }} lg:hover:scale-105 transition duration-150 ease-in-out">
                            <td class="px-4 py-2">{{ $pension_distribution->id }}</td>
                            <td class="px-4 py-2">{{ $pension_distribution->barangay_no }}</td>
                            <td class="px-4 py-2">{{ $pension_distribution->barangay_locality }}</td>
                            <td class="px-4 py-2">{{ $pension_distribution->venue }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pension_distribution->date_of_distribution)->format('F j, Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pension_distribution->date_of_distribution)->format('g:i A') }} - {{ \Carbon\Carbon::parse($pension_distribution->end_time)->format('g:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <nav aria-label="Page navigation example" class="w-full">
                    <ul class="flex flex-wrap justify-center">
                        @if (!$pension_distributions->onFirstPage())
                        <li>
                            <a href="{{ $pension_distributions->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                &laquo;&laquo;
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-s-lg cursor-not-allowed">
                                &laquo;&laquo;
                            </span>
                        </li>
                        @endif

                        @if ($pension_distributions->previousPageUrl())
                        <li>
                            <a href="{{ $pension_distributions->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                &laquo;
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed">
                                &laquo;
                            </span>
                        </li>
                        @endif

                        @php
                            $start = max(1, $pension_distributions->currentPage() - 2);
                            $end = min($pension_distributions->lastPage(), $pension_distributions->currentPage() + 2);
                        @endphp

                        @for ($i = $start; $i <= $end; $i++)
                        <li>
                            @if ($i == $pension_distributions->currentPage())
                            <a href="{{ $pension_distributions->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                {{ $i }}
                            </a>
                            @else
                            <a href="{{ $pension_distributions->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                {{ $i }}
                            </a>
                            @endif
                        </li>
                        @endfor

                        @if ($pension_distributions->nextPageUrl())
                        <li>
                            <a href="{{ $pension_distributions->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                &raquo;
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed">
                                &raquo;
                            </span>
                        </li>
                        @endif

                        @if ($pension_distributions->hasMorePages())
                        <li>
                            <a href="{{ $pension_distributions->url($pension_distributions->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                &raquo;&raquo;
                            </a>
                        </li>
                        @else
                        <li>
                            <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-e-lg cursor-not-allowed">
                                &raquo;&raquo;
                            </span>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left">
                    Events
                </p>
            </div>

            <div class="flex mb-16 justify-center flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between gap-8">
            
                <div class="w-full flex justify-between flex-col lg:w-2/5">
                    <div class="block lg:text-left text-center">
                    <h2 class="text-4xl font-bold text-gray-900 leading-[3.25rem] mb-5">Our latest <span class=" text-green-600">Events</span></h2>
                    <p class="text-gray-500 mb-10  max-lg:max-w-xl max-lg:mx-auto">Welcome to our blog section, where knowledge meets inspiration. Explore insightful articles, expert tips, and the latest trends in our field.</p>
                    <a href="javascript:;" class="cursor-pointer border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 lg:mx-0 mx-auto flex justify-center text-gray-900 font-semibold transition-all duration-300 hover:bg-gray-100">View All</a>
                  </div>
                     <!-- Slider controls -->
                     <div class="flex items-center lg:justify-start justify-center lg:mt-0 mt-8 gap-8 mb-4">
                      <button id="slider-button-left" class="swiper-button-prev group flex justify-center items-center border border-solid border-indigo-600 w-11 h-11 transition-all duration-500 rounded-full hover:bg-indigo-600" data-carousel-prev>
                          <svg class="h-6 w-6 text-indigo-600 group-hover:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              
                      </button>
                      <button id="slider-button-right" class="swiper-button-next group flex justify-center items-center border border-solid border-indigo-600 w-11 h-11 transition-all duration-500 rounded-full hover:bg-indigo-600" data-carousel-next>
                          <svg class="h-6 w-6 text-indigo-600 group-hover:text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              
                      </button>
                  </div>
                </div>

                <div class="w-full lg:w-3/5">
                    <!--Slider wrapper-->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide w-full max-lg:max-w-xl lg:w-1/2 group">
                                <div class="flex items-center mb-9">
                                    <img src="https://pagedone.io/asset/uploads/1696244059.png" alt="blogs tailwind section" class="rounded-2xl w-full object-cover">
                                </div>
                                <h3 class="text-xl text-gray-900 font-medium leading-8 mb-4 group-hover:text-indigo-600">Clever ways to invest in product to organize your portfolio</h3>
                                <p class="text-gray-500 leading-6 transition-all duration-500 mb-8">
                                    Discover smart investment strategies to streamline and organize your portfolio. Explore innovative approaches to optimize your...
                                </p>
                                <a href="javascript:;" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                    Read more<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.25 6L13.25 6M9.5 10.5L13.4697 6.53033C13.7197 6.28033 13.8447 6.15533 13.8447 6C13.8447 5.84467 13.7197 5.71967 13.4697 5.46967L9.5 1.5" stroke="#4338CA" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                      </a>
                            </div>
                            <div class="swiper-slide w-full max-lg:max-w-xl lg:w-1/2 group">
                                <div class="flex items-center mb-9">
                                    <img src="https://pagedone.io/asset/uploads/1696244074.png" alt="blogs tailwind section" class="rounded-2xl w-full object-cover">
                                </div>
                                <h3 class="text-xl text-gray-900 font-medium leading-8 mb-4 group-hover:text-indigo-600">How to grow your profit through systematic investment with us</h3>
                                <p class="text-gray-500 leading-6 transition-all duration-500 mb-8">
                                    Unlock the power of systematic investment with us and watch your profits soar. Our expert team will guide you on the path to financial..
                                </p>
                                <a href="javascript:;" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                    Read more<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.25 6L13.25 6M9.5 10.5L13.4697 6.53033C13.7197 6.28033 13.8447 6.15533 13.8447 6C13.8447 5.84467 13.7197 5.71967 13.4697 5.46967L9.5 1.5" stroke="#4338CA" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                      </a>
                            </div>
                            <div class="swiper-slide w-full max-lg:max-w-xl lg:w-1/2 group">
                                <div class="flex items-center mb-9">
                                    <img src="https://pagedone.io/asset/uploads/1696244059.png" alt="blogs tailwind section" class="rounded-2xl w-full object-cover">
                                </div>
                                <h3 class="text-xl text-gray-900 font-medium leading-8 mb-4 group-hover:text-indigo-600">Clever ways to invest in product to organize your portfolio</h3>
                                <p class="text-gray-500 leading-6 transition-all duration-500 mb-8">
                                    Discover smart investment strategies to streamline and organize your portfolio. Explore innovative approaches to optimize your...
                                </p>
                                <a href="javascript:;" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                    Read more<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.25 6L13.25 6M9.5 10.5L13.4697 6.53033C13.7197 6.28033 13.8447 6.15533 13.8447 6C13.8447 5.84467 13.7197 5.71967 13.4697 5.46967L9.5 1.5" stroke="#4338CA" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                      </a>
                            </div>
                            <div class="swiper-slide w-full max-lg:max-w-xl lg:w-1/2 group">
                                <div class="flex items-center mb-9">
                                    <img src="https://pagedone.io/asset/uploads/1696244074.png" alt="blogs tailwind section" class="rounded-2xl w-full object-cover">
                                </div>
                                <h3 class="text-xl text-gray-900 font-medium leading-8 mb-4 group-hover:text-indigo-600">How to grow your profit through systematic investment with us</h3>
                                <p class="text-gray-500 leading-6 transition-all duration-500 mb-8">
                                    Unlock the power of systematic investment with us and watch your profits soar. Our expert team will guide you on the path to financial..
                                </p>
                                <a href="javascript:;" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                    Read more<svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.25 6L13.25 6M9.5 10.5L13.4697 6.53033C13.7197 6.28033 13.8447 6.15533 13.8447 6C13.8447 5.84467 13.7197 5.71967 13.4697 5.46967L9.5 1.5" stroke="#4338CA" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                      </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 28,
        centeredSlides: false,
        loop: true,
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const currentPage = {{ $pension_distributions->currentPage() }};
    const monthDropdown = document.getElementById("dropdownMonthButton");
    const dropdownMenu = document.getElementById("dropdownMonthMenu");
    const monthList = document.getElementById("monthList");
    const currentMonthDisplayText = document.getElementById("currentMonthDisplayText");
    const paginationContainer = document.querySelector(
        "nav[aria-label='Page navigation example'] ul"
    );
    const savedMonthId = localStorage.getItem("monthId");

    const today = new Date();
    const currentYear = today.getFullYear();
    const currentMonthIndex = today.getMonth(); 

    const previousMonth = new Date(currentYear, currentMonthIndex - 1, 1); 
    const thisMonth = new Date(currentYear, currentMonthIndex, 1); 
    const nextMonth = new Date(currentYear, currentMonthIndex + 1, 1); 

    const months = [
        { date: previousMonth, id: formatMonth(previousMonth) },
        { date: thisMonth, id: formatMonth(thisMonth) },
        { date: nextMonth, id: formatMonth(nextMonth) },
    ];

    monthList.innerHTML = months
        .map(
            (month) =>
                `<li class="px-4 py-2 cursor-pointer hover:bg-gray-100" data-month="${month.id}">
                    ${new Intl.DateTimeFormat("en-US", { month: "long", year: "numeric" }).format(month.date)}
                </li>`
        )
        .join("");

    const initialMonth = savedMonthId || months[1].id; 
    currentMonthDisplayText.innerHTML = new Intl.DateTimeFormat("en-US", {
        month: "long",
        year: "numeric",
    }).format(new Date(initialMonth + "-01"));

    monthDropdown.addEventListener("click", () => {
        dropdownMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", (event) => {
        if (
            !monthDropdown.contains(event.target) &&
            !dropdownMenu.contains(event.target)
        ) {
            dropdownMenu.classList.add("hidden");
        }
    });

    monthList.addEventListener("click", (event) => {
        if (event.target.tagName === "LI") {
            const selectedMonth = event.target.getAttribute("data-month");
            const formattedMonth = new Date(selectedMonth + "-01");
            const monthName = new Intl.DateTimeFormat("en-US", {
                month: "long",
                year: "numeric",
            }).format(formattedMonth);

            currentMonthDisplayText.innerHTML = monthName;
            dropdownMenu.classList.add("hidden");

            localStorage.setItem("monthId", selectedMonth);

            updateTable(1);
        }
    });

    if (savedMonthId) {
        const savedFormattedMonth = new Date(savedMonthId + "-01");
        currentMonthDisplayText.innerHTML = new Intl.DateTimeFormat("en-US", {
            month: "long",
            year: "numeric",
        }).format(savedFormattedMonth);
    }

    function formatMonth(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, "0"); 
        return `${year}-${month}`;
    }

    function updateTable(page) {
        const monthId = localStorage.getItem('monthId') || null;

        fetch('/filter-announcements?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                month_id: monthId,
            }),
        })
            .then(response => response.json())
            .then(data => {
                renderTable(data.data);
                renderPagination(data);
            })
            .catch(error => console.error('Error:', error));
    }

    function renderTable(data) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';

        if (data.length === 0) {
            const emptyRow = `
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">None.</td>
                </tr>`;
            tbody.innerHTML = emptyRow;
            return;
        }

        data.forEach((pension_distribution, index) => {
            const formattedDate = new Date(pension_distribution.date_of_distribution).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });

            const formattedTime = new Date(pension_distribution.date_of_distribution).toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            });

            const formattedEndTime = new Date(`1970-01-01T${pension_distribution.end_time}`).toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            });

            const row = `
                <tr class="${index % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'} lg:hover:scale-105 transition duration-150 ease-in-out">
                    <td class="px-4 py-2">${pension_distribution.id}</td>
                    <td class="px-4 py-2">${pension_distribution.barangay_no}</td>
                    <td class="px-4 py-2">${pension_distribution.barangay_locality || 'Unknown'}</td>
                    <td class="px-4 py-2">${pension_distribution.venue || 'Unknown'}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2">${formattedTime} - ${formattedEndTime}</td>
                </tr>`;
            tbody.innerHTML += row;
        });
    }

    function renderPagination(data) {
        paginationContainer.innerHTML = '';

        const paginationMeta = data.meta || {
            current_page: data.current_page,
            last_page: data.last_page,
        };

        if (!paginationMeta.current_page || !paginationMeta.last_page) {
            console.error('Invalid pagination data:', data);
            return;
        }

        const { current_page, last_page } = paginationMeta;

        const createButton = (page, text, isDisabled = false, isActive = false, additionalClasses = '') => {
            const className = isDisabled
                ? `text-gray-400 bg-gray-200 cursor-not-allowed border-[#30ae2b] ${additionalClasses}`
                : isActive
                ? `text-white bg-[#1AA514] border-[#30ae2b] ${additionalClasses}`
                : `text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 border-[#30ae2b] ${additionalClasses}`;
            return `
                <li>
                    <a href="javascript:void(0);" 
                    class="flex items-center justify-center px-4 h-10 border ${className}" 
                    ${isDisabled ? '' : `data-page="${page}"`}>
                        ${text}
                    </a>
                </li>`;
        };

        paginationContainer.innerHTML += createButton(1, '««', current_page === 1, '', 'rounded-tl-lg rounded-bl-lg');

        paginationContainer.innerHTML += createButton(current_page - 1, '«', current_page === 1);

        const start = Math.max(1, current_page - 2);
        const end = Math.min(last_page, current_page + 2);
        for (let i = start; i <= end; i++) {
            paginationContainer.innerHTML += createButton(i, i, false, i === current_page);
        }

        paginationContainer.innerHTML += createButton(current_page + 1, '»', current_page === last_page);

        paginationContainer.innerHTML += createButton(last_page, '»»', current_page === last_page, '', 'rounded-tr-lg rounded-br-lg');

        document.querySelectorAll("[data-page]").forEach(button => {
            button.addEventListener("click", function () {
                const page = this.dataset.page;
                updateTable(page);

                const url = new URL(window.location);
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);
            });
        });
    }

    updateTable(currentPage);
});

</script>

@include('partials.senior_citizen.footer')
