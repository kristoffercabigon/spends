@if (session('clearAdminAddBirthdateModal'))
<script>
    localStorage.removeItem('showAdminAddBirthdateModal');
</script>
@endif

<div style="display: none" class="fixed inset-0 bg-black bg-opacity-50 z-10 flex items-center justify-center font-poppins"
    x-data="birthdateModal()" 
    x-show="showAdminAddBirthdateModal"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showAdminAddBirthdateModal = false; localStorage.setItem('showAdminAddBirthdateModal', 'false')">
    
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminAddBirthdateModal = false; localStorage.setItem('showAdminAddBirthdateModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="w-[400px] bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-4 leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Add Birthdate
                    </h1>

                    <div>
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
                        <select name="year" id="year" x-model="selectedYear"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            @change="enableMonth()">
                            <option value="" disabled selected>Select Year</option>
                            <template x-for="year in years">
                                <option :value="year" x-text="year"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900">Month</label>
                        <select name="month" id="month" x-model="selectedMonth"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            :disabled="!selectedYear"
                            @change="enableDay()">
                            <option value="" disabled selected>Select Month</option>
                            <template x-for="(month, index) in months">
                                <option :value="index + 1" x-text="month"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label for="day" class="block mb-2 text-sm font-medium text-gray-900">Day</label>
                        <select name="day" id="day" x-model="selectedDay"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            :disabled="!selectedMonth"
                            @change="calculateAge()">
                            <option value="" disabled selected>Select Day</option>
                            <template x-for="day in days">
                                <option :value="day" x-text="day"></option>
                            </template>
                        </select>
                    </div>

                    <div class="relative">
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900">Age</label>
                        <input type="text" id="age" name="age" x-model="age"
                            class="w-full text-lg px-4 py-3 rounded-md transition-all bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            readonly placeholder="Age will be calculated">
                    </div>

                    <button type="button"
                        class="relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                        Add
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
function birthdateModal() {
    return {
        showAdminAddBirthdateModal: true,
        years: [],
        months: [
            'January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ],
        days: [],
        selectedYear: '',
        selectedMonth: '',
        selectedDay: '',
        age: '',

        init() {
            const currentYear = new Date().getFullYear();
            for (let i = currentYear - 60; i <= currentYear; i++) {
                this.years.push(i);
            }
        },

        enableMonth() {
            this.selectedMonth = '';
            this.selectedDay = '';
            this.days = [];
        },

        enableDay() {
            this.selectedDay = '';
            this.days = [];
            if (this.selectedYear && this.selectedMonth) {
                const daysInMonth = new Date(this.selectedYear, this.selectedMonth, 0).getDate();
                for (let i = 1; i <= daysInMonth; i++) {
                    this.days.push(i);
                }
            }
        },

        calculateAge() {
            if (this.selectedYear && this.selectedMonth && this.selectedDay) {
                const birthDate = new Date(this.selectedYear, this.selectedMonth - 1, this.selectedDay);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                this.age = age;
            }
        }
    };
}
</script>
