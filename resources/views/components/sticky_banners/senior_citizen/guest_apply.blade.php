<div 
    id="marketing-banner" 
    x-data="{
        show: false, 
        init() {
            if (window.location.pathname !== '/register' && localStorage.getItem('stickyBannerDisplayed') !== 'true') {
                setTimeout(() => {
                    this.show = true;
                }, 5000);
            }
        }
    }" 
    x-show="show" 
    style="display: none"
    class="fixed z-50 flex flex-col md:flex-row justify-between w-[calc(60%-2rem)] p-4 -translate-x-1/2 bg-white border border-gray-100 rounded-lg shadow-sm lg:max-w-7xl left-1/2 top-[90px]" 
    role="alert"
    x-init="init()"
    x-transition:enter="transform transition ease-out duration-300"
    x-transition:enter-start="translate-y-[-100%] opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform transition ease-in duration-300"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-[-100%] opacity-0">

    <div class="flex flex-col items-start mb-3 me-4 md:items-center md:flex-row md:mb-0">
        <div class="flex items-center mb-2 border-gray-200 md:pe-4 md:me-4 md:border-e md:mb-0">
            <img src="{{ asset('images/osca_image.jfif') }}" class="h-6 me-2" alt="Flowbite Logo">
            <span class="self-center text-lg font-semibold whitespace-nowrap text-customOrange">SPENDS</span>
        </div>
        <p id="sticky-body-message" class="flex items-center text-sm font-normal text-gray-500">
            Take the first step towards applying for the OSCA pension program today
        </p>
    </div>
    
    <div class="flex items-center flex-shrink-0">
        <a href="/register" class="px-5 py-2 me-2 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 focus:outline-none">
            Apply Now
        </a>
        <button 
            @click="show = false; localStorage.setItem('stickyBannerDisplayed', 'true');" 
            type="button" 
            class="flex-shrink-0 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close banner</span>
        </button>
    </div>
</div>
