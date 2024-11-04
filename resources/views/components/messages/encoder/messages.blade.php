@if(session()->has('encoder_message'))
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 7000)" 
     class="bg-teal-100 fixed top-[70px] right-0 m-4 max-w-md mx-auto mt-4 z-[1000] border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" 
     role="alert"
     x-transition:enter="transform transition ease-out duration-300"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transform transition ease-in duration-300"
     x-transition:leave-start="translate-x-0 opacity-100"
     x-transition:leave-end="translate-x-full opacity-0">
  <div class="flex">
    <div class="py-1">
      <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
      </svg>
    </div>
    <div>
      <p class="font-bold">Alert Message</p>
      <p class="text-sm">{{ session('encoder_message') }}</p>
    </div>  
  </div>
</div>
@endif
