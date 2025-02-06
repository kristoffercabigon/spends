@if(session()->has('admin-error-message-header') || session()->has('admin-error-message-body'))
<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 3000)" 
     class="bg-red-100 fixed top-[70px] right-0 m-4 max-w-md mx-auto mt-4 z-[1000] border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" 
     role="alert"
     x-transition:enter="transform transition ease-out duration-300"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transform transition ease-in duration-300"
     x-transition:leave-start="translate-x-0 opacity-100"
     x-transition:leave-end="translate-x-full opacity-0">
  <div class="flex">
    <div class="mr-3">
      <lottie-player src="https://lottie.host/24f3f0a4-4d86-42ba-a059-d6464d7de05a/VLimILhhIl.json"   
                     background="transparent" 
                     speed="1" 
                     style="width: 48px; height: 48px" 
                     autoplay direction="1" mode="normal"></lottie-player>
    </div>
    <div>
      <p id="admin-error-message-header" class="font-bold">{{ session('admin-error-message-header') }}</p>
      <p id="admin-error-message-body" class="text-sm">{{ session('admin-error-message-body') }}</p>
    </div>  
  </div>
</div>
@endif
