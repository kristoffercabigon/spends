@if(session()->has('encoder-message-header') || session()->has('encoder-message-body'))
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 3000)" 
     class="bg-teal-100 fixed top-[70px] right-0 m-4 max-w-md mx-auto mt-4 z-[1000] border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" 
     role="alert"
     x-transition:enter="transform transition ease-out duration-300"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transform transition ease-in duration-300"
     x-transition:leave-start="translate-x-0 opacity-100"
     x-transition:leave-end="translate-x-full opacity-0">
  <div class="flex">
    <div class="mr-3">
      <lottie-player src="https://lottie.host/8fd84508-22f6-4737-8ae6-6abba363740a/SMWXybYv5s.json" 
                     background="transparent" 
                     speed="1" 
                     style="width: 48px; height: 48px" 
                     autoplay direction="1" mode="normal"></lottie-player>
    </div>
    <div>
      <p id="encoder-message-header" class="font-bold">{{ session('encoder-message-header') }}</p>
      <p id="encoder-message-body" class="text-sm">{{ session('encoder-message-body') }}</p>
    </div>  
  </div>
</div>
@endif
