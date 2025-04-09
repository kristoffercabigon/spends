@if (session('clearAdminViewMessageModal'))
<script>
    localStorage.removeItem('showAdminViewMessageModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showAdminViewMessageModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showAdminViewMessageModal = false; localStorage.setItem('showAdminViewMessageModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminViewMessageModal = false; localStorage.setItem('showAdminViewMessageModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        View Message
                    </h1>

                    <div class="overflow-y-auto max-h-[450px]">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sent by:</label>
                            <div id="view_sent_by_email" class="mt-1 text-gray-900 font-semibold"></div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sent to:</label>
                            <div id="view_sent_to_email" class="mt-1 text-gray-900 font-semibold"></div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Received on:</label>
                            <p id="view_message_date" class="mt-1 block w-full text-gray-900"></p> 
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Subject:</label>
                            <div id="view_subject" class="mt-1 text-gray-900 font-semibold"></div>
                        </div>

                        <div class="overflow-y-auto max-h-[350px]">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Message:</label>
                                <div id="view_message" class="mt-1 text-gray-700"></div>
                            </div>
                        </div>

                        <div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Attachment:</label>
                                <div id="view_attachment" class="mt-1 text-gray-700"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function loadMessageDataForView(id) {
        fetch(`/admin/messages/getMessageDataForView/${id}`)
            .then(response => response.json())
            .then(data => {
                localStorage.setItem('messageData', JSON.stringify(data));

                populateFormFieldsForView(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function populateFormFieldsForView(data) {
        document.getElementById('view_sent_by_email').innerText = 
        data.sent_by_email?.trim() || data.sent_by_contact?.trim() || 'No Email or Contact';
        document.getElementById('view_sent_to_email').innerText = 
        data.sent_to_email?.trim() || data.sent_to_contact?.trim() || '-';
        document.getElementById('view_subject').innerText = data.subject || 'No Subject';
        document.getElementById('view_message').innerText = data.message || 'No Message';

        const date = new Date(data.created_at);
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
        document.getElementById('view_message_date').innerText = formattedDateTime;

        const attachmentDiv = document.getElementById('view_attachment');
        if (data.message_attachment) {
            const attachmentURL = `/storage/${data.message_attachment}`;

            if (data.message_attachment.match(/\.(jpeg|jpg|gif|png)$/)) {
                const img = document.createElement('img');
                img.src = attachmentURL;
                img.alt = 'Attachment';
                img.classList.add('w-full', 'h-auto');
                attachmentDiv.appendChild(img);
            } else {
                const link = document.createElement('a');
                link.href = attachmentURL;
                link.innerText = 'Download Attachment';
                link.target = '_blank';
                attachmentDiv.appendChild(link);
            }
        } else {
            attachmentDiv.innerText = 'No Attachment';
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const savedData = localStorage.getItem('messageData');
        if (savedData) {
            const data = JSON.parse(savedData);
            populateFormFieldsForView(data);
        }
    });
</script>
