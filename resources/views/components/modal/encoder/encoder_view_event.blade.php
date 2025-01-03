@if (session('clearEncoderViewEventModal'))
<script>
    localStorage.removeItem('showEncoderViewEventModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showEncoderViewEventModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showEncoderViewEventModal = false; localStorage.setItem('showEncoderViewEventModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showEncoderViewEventModal = false; localStorage.setItem('showEncoderViewEventModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        View Event
                    </h1>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Event Title:</label>
                        <div id="view_title" class="mt-1 text-gray-900 font-semibold"></div>
                    </div>

                    <div>
    <label class="block text-sm font-medium text-gray-700">Event Date:</label>
    <p id="view_event_date" class="mt-1 block w-full text-gray-900"></p> <!-- Using <p> for non-input display -->
</div>

                    <div class="overflow-y-auto max-h-[350px]">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Event Description:</label>
                            <div id="view_description" class="mt-1 text-gray-700"></div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function loadEventDataForView(id) {
        fetch(`/encoder/events-list/getEventDataForView/${id}`)
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('eventData', JSON.stringify(data));

                populateFormFieldsForView(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function populateFormFieldsForView(data) {
        document.getElementById('view_title').innerText = data.title || 'No Title';
        document.getElementById('view_description').innerText = data.description || 'No Description';

        const date = new Date(data.event_date);

        const formattedDate = date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const formattedTime = date.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        const formattedDateTime = `${formattedDate}; ${formattedTime}`;

        document.getElementById('view_event_date').innerText = formattedDateTime;
    }

    window.addEventListener('DOMContentLoaded', () => {
        const savedData = localStorage.getItem('eventData');
        if (savedData) {
            const data = JSON.parse(savedData);
            populateFormFieldsForView(data);
        }
    });
</script>
