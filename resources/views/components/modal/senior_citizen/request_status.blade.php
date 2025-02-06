@if (session('clearRequestStatusModal'))
<script>
    localStorage.removeItem('showRequestStatusModal');
</script>
@endif

@if (session('showRequestStatusModal'))
<script>
    localStorage.setItem('showRequestStatusModal', 'true');
</script>
@endif

<script>
window.addEventListener('beforeunload', function () {
    localStorage.removeItem('showRequestStatusModal');
});

document.addEventListener('DOMContentLoaded', function () {
    if (localStorage.getItem('showRequestStatusModal') === 'true') {
        document.querySelector('[x-show="showRequestStatusModal"]').style.display = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins';
    } else {
        document.querySelector('[x-show="showRequestStatusModal"]').style.display = 'none';
    }
});
</script>

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showRequestStatusModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showRequestStatusModal = false; localStorage.setItem('showRequestStatusModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 mx-4 relative rounded-lg">
            <button @click="showRequestStatusModal = false; localStorage.setItem('showRequestStatusModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Application Status
                    </h1>
                    <p class="text-sm text-gray-500">
                        Below is the status of your application:
                    </p>
                    <div class="bg-gray-100 p-4 rounded-md">
                        @php
                            $statusList = session('senior_application_status_list', []);
                            $currentStatusId = session('seniorApplicationStatus');
                            $statusText = collect($statusList)->firstWhere('id', $currentStatusId)?->senior_application_status ?? 'Unknown Status';
                        @endphp

                        @if ($currentStatusId == 1)
                            <div id="Under_Evaluation" class="flex justify-center items-center">
                                <dotlottie-player src="https://lottie.host/a7e8b4e3-2088-48de-8929-d9f1553e8a6c/Og9VYjFhcy.lottie" background="transparent" speed="1" style="width: 150px; height: 150px" loop autoplay></dotlottie-player>
                            </div>
                        @elseif ($currentStatusId == 2)
                            <div id="On_Hold" class="flex justify-center items-center">
                                <dotlottie-player src="https://lottie.host/2241432c-fc73-4043-b581-7b703558e7b0/WAQAkhMk98.lottie" background="transparent" speed="1" style="width: 150px; height: 150px" loop autoplay></dotlottie-player>
                            </div>
                        @elseif ($currentStatusId == 3)
                            <div id="Approved" class="flex justify-center items-center">
                                <dotlottie-player src="https://lottie.host/19bccf91-71aa-44e7-8d3e-fd09f8306ece/SubEG32C2L.lottie" background="transparent" speed=".5" style="width: 150px; height: 150px" loop autoplay></dotlottie-player>
                            </div>
                        @elseif ($currentStatusId == 4)
                            <div id="Disapproved" class="flex justify-center items-center">
                                <dotlottie-player src="https://lottie.host/dc98cc5b-e4e7-4e35-b48f-8aabe5bf1de3/Wii2XGlEw1.lottie" background="transparent" speed="1.5" style="width: 150px; height: 150px" loop autoplay></dotlottie-player>
                            </div>
                        @endif

                        <p class="text-4xl font-bold text-gray-800 text-center">
                            {{ $statusText }}
                        </p>
                    </div>
                    <button 
                        @click="showRequestStatusModal = false; localStorage.setItem('showRequestStatusModal', 'false')" 
                        class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Close
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>
