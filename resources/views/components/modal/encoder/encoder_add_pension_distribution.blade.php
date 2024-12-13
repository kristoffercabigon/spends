@if (session('clearEncoderAddPensionDistributionModal'))
<script>
    localStorage.removeItem('showEncoderAddPensionDistributionModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showEncoderAddPensionDistributionModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showEncoderAddPensionDistributionModal = false; localStorage.setItem('showEncoderAddPensionDistributionModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showEncoderAddPensionDistributionModal = false; localStorage.setItem('showEncoderAddPensionDistributionModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Add Pension Distribution Program
                    </h1>

                    <div class="mt-4 justify-end start">
                        <button type="button" onclick="addProgramRow()"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Add Program
                        </button>
                    </div>

                    <form x-data="{ isEncoderLoadingForgotPassword: false }"
                        @submit.prevent="
                            isEncoderLoadingForgotPassword = true;
                            $nextTick(() => $el.submit());
                        "
                        class="space-y-4 md:space-y-4" method="POST" action="{{ route('encoder-submit-add-pension-distribution') }}">
                        @csrf

                        <div id="programBox" class="space-y-4 md:space-y-6 overflow-x-hidden overflow-y-auto max-h-80 px-2">
                            
                            <div class="programRow border p-4 bg-gray-100 rounded-md relative">
                                <span class="absolute top-2 right-0 pr-4 text-sm font-bold text-[#1AA514]">Program 1</span>
                                <div>
                                    <label for="barangay_id_0" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                    <select name="barangay_id[]" id="barangay_id_0"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                        <option value="" disabled {{ old('barangay_id.0') ? '' : 'selected' }}>Select Barangay</option>
                                        @foreach ($barangayList as $barangay)
                                            <option value="{{ $barangay->id }}"
                                                {{ in_array($barangay->id, old('barangay_id', [])) ? 'selected' : '' }}>
                                                {{ $barangay->barangay_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barangay_id.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="venue_0" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Venue</label>
                                    <input type="text" name="venue[]" id="venue_0" placeholder="Enter venue"
                                        value="{{ old('venue.0') ?? '' }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    @error('venue.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="date_of_distribution_0" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Date and Time of Distribution</label>
                                    <input type="datetime-local" name="date_of_distribution[]" id="date_of_distribution_0"
                                        value="{{ old('date_of_distribution.0') ?? '' }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    @error('date_of_distribution.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="end_time_0" class="block mb-2 mt-2 text-sm font-medium text-gray-900">End Time</label>
                                    <input type="time" name="end_time[]" id="end_time_0"
                                        value="{{ old('end_time.0') ?? '' }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    @error('end_time.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="button" onclick="removeRow(this)"
                                    class="mt-4 text-red-500 hover:text-red-700 text-sm font-medium">
                                    Remove
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <span x-show="!isEncoderLoadingForgotPassword">Submit</span>
                            <span x-show="isEncoderLoadingForgotPassword" style="display: none;" class="flex items-center justify-center">
                                <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Submitting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    let rowCount = 1;

    function addProgramRow() {
        const programBox = document.getElementById("programBox");

        const newRow = document.createElement("div");
        newRow.classList.add("programRow", "border", "p-4", "mb-4", "bg-gray-100", "rounded-md", "relative");

        newRow.innerHTML = `
            <span class="absolute top-2 right-0 pr-4 text-sm font-bold text-[#1AA514]">Program ${rowCount + 1}</span>

            <div>
                <label for="barangay_id_${rowCount}" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                <select name="barangay_id[]" id="barangay_id_${rowCount}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    <option value="" disabled selected>Select Barangay</option>
                    @foreach ($barangayList as $barangay)
                        <option value="{{ $barangay->id }}">{{ $barangay->barangay_no }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="venue_${rowCount}" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Venue</label>
                <input type="text" name="venue[]" id="venue_${rowCount}" placeholder="Enter venue"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
            </div>

            <div>
                <label for="date_of_distribution_${rowCount}" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Date and Time of Distribution</label>
                <input type="datetime-local" name="date_of_distribution[]" id="date_of_distribution_${rowCount}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
            </div>

            <div>
                <label for="end_time_${rowCount}" class="block mb-2 mt-2 text-sm font-medium text-gray-900">End Time</label>
                <input type="time" name="end_time[]" id="end_time_${rowCount}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
            </div>

            <button type="button" onclick="removeRow(this)"
                class="mt-4 text-red-500 hover:text-red-700 text-sm font-medium">
                Remove
            </button>
        `;

        programBox.appendChild(newRow);
        rowCount++;

        updateProgramLabels();
    }

    function removeRow(button) {
        const row = button.closest(".programRow");
        row.parentNode.removeChild(row);

        updateProgramLabels();
    }

    function updateProgramLabels() {
        const programRows = document.querySelectorAll("#programBox .programRow");
        programRows.forEach((row, index) => {
            const label = row.querySelector("span");
            if (label) {
                label.textContent = `Program ${index + 1}`;
            }
        });
    }
</script>