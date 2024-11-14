@if (session('clearEncoderVerifyCurrentPasswordModal'))
<script>
    localStorage.removeItem('showEncoderVerifyCurrentPasswordModal');
</script>
@endif

@if (session('showEncoderVerifyCurrentPasswordModal'))
<script>
    localStorage.setItem('showEncoderVerifyCurrentPasswordModal', 'true');
</script>
@endif

<div x-show="showEncoderVerifyCurrentPasswordModal" style="display: none" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        @click.away="showEncoderVerifyCurrentPasswordModal = false; localStorage.setItem('showEncoderVerifyCurrentPasswordModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4">
            <button @click="showEncoderVerifyCurrentPasswordModal = false; localStorage.setItem('showEncoderVerifyCurrentPasswordModal', 'false')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Enter Current Password
                    </h1>
                    <p class="text-sm text-gray-500">To proceed with updating your changes, please enter your current password.</p>
                    <form x-data="{ isLoadingChangePassword: false }" 
                            @submit.prevent="isLoadingChangePassword = true; $nextTick(() => $el.submit());" 
                            class="space-y-4 md:space-y-6" method="POST" action="{{ route('encoder-verify-password') }}">
                        @csrf
                        <div class="relative">
                            <label for="encoder_current_password" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                            
                            <input type="password" name="encoder_current_password" id="encoder_current_password" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            
                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 hover:bg-gray-600 
                                        @error('encoder_current_password') h-[46%] mt-[7%] right-[-2px] @else h-[65%] mt-[7%] right-[-2px] @enderror" 
                                    type="button" onclick="togglePassword('encoder_current_password', 'togglePasswordIconZ')">
                                <img src="../../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5 hover:animate-jiggle" id="togglePasswordIconZ">
                            </button>

                            @error('encoder_current_password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                            <span x-show="!isLoadingChangePassword">Submit</span>
                            <span x-show="isLoadingChangePassword" style="display: none;" class="flex items-center justify-center">
                                <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7469 65.8883 12.7092 70.4622 15.7437C75.5203 18.4426 80.2036 21.9059 84.1351 25.7002C87.3016 28.7888 89.6809 32.2967 91.1892 35.9797C91.5898 37.2733 93.1688 38.0743 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Verifying Password...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script src= "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
function updatePasswordCriteria(encoder_password) {
    document.getElementById("minLength").innerHTML = 
        encoder_password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' : 
        '<i class="fas fa-times text-red-500"></i> Minimum 8 characters';
    
    document.getElementById("uppercase").innerHTML = 
        /[A-Z]/.test(encoder_password) ? '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' : 
        '<i class="fas fa-times text-red-500"></i> At least one uppercase letter';
    
    document.getElementById("lowercase").innerHTML = 
        /[a-z]/.test(encoder_password) ? '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' : 
        '<i class="fas fa-times text-red-500"></i> At least one lowercase letter';
    
    document.getElementById("symbol").innerHTML = 
        /[@$!%*?&]/.test(encoder_password) ? '<i class="fas fa-check text-green-500"></i> At least one symbol (@$!%*?&)' : 
        '<i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)';
}

function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.src = "../../images/show.png"; 
    } else {
        passwordField.type = "password";
        icon.src = "../../images/hide.png"; 
    }
}
</script>