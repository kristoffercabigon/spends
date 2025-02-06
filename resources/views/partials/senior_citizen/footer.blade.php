<footer x-data = "{showRequestTrackerModal: localStorage.getItem('showRequestTrackerModal') === 'true',
    showRequestStatusModal: localStorage.getItem('showRequestStatusModal') === 'true',}"  class="flex flex-col w-full relative items-center bg-[#FF4802] text-center shadow-lg text-surface">

  <div class="bg-white w-full h-[2px] flex items-center relative shadow-[0_12px_16px_rgba(255,255,255,0.7)]">
    <img src="{{ asset('images/osca_image_transparent_with_border.png') }}" alt="OSCA Logo" class="w-[70px] mx-auto top-[-20px]">
  </div>

  <div class="container pt-16">
    <div class="mb-6 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-10">
        <a href="/" class="text-white hover:text-orange-300 hover:scale-105 transition duration-150 ease-in-out">Home</a>
        <a href="/announcements" class="text-white hover:text-orange-300 hover:scale-105 transition duration-150 ease-in-out">Announcement</a>
        <a @click.prevent="showRequestTrackerModal = true; localStorage.setItem('showRequestTrackerModal', 'true')" class="text-white hover:text-orange-300 hover:scale-105 transition duration-150 ease-in-out">Tracker</a>
        <a href="/contact-us" class="text-white hover:text-orange-300 hover:scale-105 transition duration-150 ease-in-out">Contact Us</a>
        <a href="/about-us" class="text-white hover:text-orange-300 hover:scale-105 transition duration-150 ease-in-out">About Us</a>

    </div>
    <div class="mb-2 flex justify-center space-x-2">
      <a
        href="https://www.facebook.com/oscacaloocan"
        target="_blank"
        rel="noopener noreferrer"
        type="button"
        class="rounded-full bg-transparent hover:animate-scale p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-400 focus:outline-none focus:ring-0"
        data-twe-ripple-init>
        <span class="[&>svg]:h-5 [&>svg]:w-5">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="white"
            viewBox="0 0 320 512">
            <path
              d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
          </svg>
        </span>
      </a>

    </div>
  </div>
  <hr class="border-t-2 border-white mx-auto w-[80%] my-4">

    <x-modal.senior_citizen.request_tracker />
    <x-modal.senior_citizen.request_status />

  <div class=" mx-4 pb-4 pt-2 text-center text-white">
    © 2024 Socal Pension Network of DSWD for Senior Citizens. All rights reserved  
  </div>
</footer>

</body>
</html>

