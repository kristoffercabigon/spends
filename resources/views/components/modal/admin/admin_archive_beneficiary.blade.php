@if (session('clearAdminArchiveBeneficiaryModal'))
<script>
    localStorage.removeItem('showAdminArchiveBeneficiaryModal', 'true');
</script>
@endif



<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showAdminArchiveBeneficiaryModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showAdminArchiveBeneficiaryModal = false; localStorage.setItem('showAdminArchiveBeneficiaryModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminArchiveBeneficiaryModal = false; localStorage.setItem('showAdminArchiveBeneficiaryModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">

                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    
                    <div class="flex justify-center items-center">
                        <dotlottie-player src="https://lottie.host/23bc49c1-1a83-40e4-acd3-d422bccf6866/VZ8CMkc9tQ.lottie" background="transparent" speed="1" style="width: 150px; height: 150px" loop autoplay></dotlottie-player>
                    </div>

                    <p class="text-sm text-gray-500">
                        Are you sure you want to move <strong id="beneficiary_name"></strong> with OSCA ID
                        <strong id="beneficiary_osca_id"></strong> on the archive?
                    </p>

                    <form x-data="{ isAdminLoadingArchiveBeneficiary: false }"
                        @submit.prevent="
                            isAdminLoadingArchiveBeneficiary = true;
                            $nextTick(() => $el.submit());
                        "
                        class="space-y-4 md:space-y-6" method="POST" action="{{ route('admin-submit-archive-beneficiary') }}">
                        @csrf

                        <input type="hidden" name="id" id="beneficiary_id" value="{{ old('id', '') }}">

                        <div class="flex justify-between items-center space-x-4">
                            <button type="submit" class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <span x-show="!isAdminLoadingArchiveBeneficiary">Yes</span>
                                <span x-show="isAdminLoadingArchiveBeneficiary" style="display: none;" class="flex items-center justify-center">
                                    <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>
                                    Archiving...
                                </span>
                            </button>

                            <button type="button" 
                                @click="showAdminArchiveBeneficiaryModal = false; localStorage.setItem('showAdminArchiveBeneficiaryModal', 'false')"
                                class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                No
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function loadBeneficiaryDataForArchive(id) {
        fetch(`/admin/beneficiaries/getBeneficiaryDataForArchive/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch data: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                localStorage.setItem('beneficiaryData', JSON.stringify(data));
                populateFormFieldsForArchiveBeneficiary(data);
                populateModalTextForArchiveBeneficiary(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function populateFormFieldsForArchiveBeneficiary(data) {
        document.getElementById('beneficiary_id').value = data.id || '';
    }

    function populateModalTextForArchiveBeneficiary(data) {
        const fullName = `${data.first_name} ${data.middle_name ? data.middle_name + ' ' : ''}${data.last_name}${data.suffix ? ' ' + data.suffix : ''}`;
        document.getElementById('beneficiary_name').textContent = fullName.trim();
        document.getElementById('beneficiary_osca_id').textContent = data.osca_id || 'N/A';
    }

    window.addEventListener('DOMContentLoaded', () => {
        const savedData = localStorage.getItem('beneficiaryData');
        if (savedData) {
            const data = JSON.parse(savedData);
            populateFormFieldsForArchiveBeneficiary(data);
            populateModalTextForArchiveBeneficiary(data);
        }
    });
</script>


