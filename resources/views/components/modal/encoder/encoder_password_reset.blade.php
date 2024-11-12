@if (session('saveEncoderPasswordResetModal'))
    <script>
        console.log("Modal session active, encoder_email:", '{{ session('encoder_email') }}', "encoder_token:", '{{ session('encoder_token') }}');
        localStorage.setItem('resetEncoderEmail', localStorage.getItem('resetEncoderEmail') || '{{ session('encoder_email') }}');
        localStorage.setItem('resetEncoderToken', localStorage.getItem('resetEncoderToken') || '{{ session('encoder_token') }}');
        localStorage.setItem('showEncoderPasswordResetModal', 'true');
    </script>
@endif

@if (session('removeEncoderPasswordResetModal'))
    <script>
        localStorage.removeItem('showEncoderPasswordResetModal');
        localStorage.setItem('resetEncoderEmail', localStorage.getItem('resetEncoderEmail'));
        localStorage.setItem('resetEncoderToken', localStorage.getItem('resetEncoderToken'));
    </script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-data="{
         showEncoderPasswordResetModal: localStorage.getItem('showEncoderPasswordResetModal') === 'true',
         encoder_email: localStorage.getItem('resetEncoderEmail'), 
         encoder_token: localStorage.getItem('resetEncoderToken'),
         init() {
             if (this.encoder_email) {
                 localStorage.setItem('resetEncoderEmail', this.encoder_email);
                 document.getElementById('resetEncoderEmail').value = this.encoder_email;
             }
             if (this.encoder_token) {
                 localStorage.setItem('resetEncoderToken', this.encoder_token);
             }
             localStorage.setItem('showEncoderPasswordResetModal', this.showEncoderPasswordResetModal);
         }
     }"
     x-show="showEncoderPasswordResetModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showEncoderPasswordResetModal = false; localStorage.setItem('showEncoderPasswordResetModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 dark:bg-gray-900 relative">
            <button @click="showEncoderPasswordResetModal = false; localStorage.setItem('showEncoderPasswordResetModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Reset Password
                    </h1>

                    <div x-show="encoder_email" class="text-sm text-gray-600 dark:text-gray-400">
                        Change password for email: <strong x-text="encoder_email"></strong>
                    </div>

                    <form x-data="{ isLoadingResetPassword: false }"
                        @submit.prevent="
                            isLoadingResetPassword = true;
                            $nextTick(() => $el.submit());
                        "
                        class="space-y-4 md:space-y-6" method="POST" action="{{ route('encoder-reset-password') }}">
                        @csrf
                        @method('PUT')

                        <div class="relative">
                            <label for="encoder_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="hidden" name="encoder_email" id="resetEncoderEmail" value="">
                            <input type="password" name="encoder_password" id="passwordC"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="New Password"
                                oninput="updatePasswordCriteria(this.value)">

                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 hover:bg-gray-600 @error('encoder_password') h-[24%] mt-[7%] right-[-2px]  @else mt-[7%] h-[28%] right-[-2px] @enderror" 
                                    type="button" onclick="togglePassword('passwordC', 'togglePasswordIconC')">
                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5 hover:animate-jiggle" id="togglePasswordIconC">
                            </button>

                            <div class="ml-2 mt-4 text-gray-800 text-sm">
                                <ul>
                                    <li id="minLength"><i class="fas fa-times text-red-500"></i> Minimum 8 characters</li>
                                    <li id="uppercase"><i class="fas fa-times text-red-500"></i> At least one uppercase letter</li>
                                    <li id="lowercase"><i class="fas fa-times text-red-500"></i> At least one lowercase letter</li>
                                    <li id="symbol"><i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)</li>
                                </ul>
                            </div>
                            @error('encoder_password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative">
                            <label for="encoder_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" name="encoder_password_confirmation" id="encoder_password_confirmationD"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Confirm Password">

                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 hover:bg-gray-600 @if('encoder_password_confirmation') h-[65%] mt-[7%] right-[-2px]@endif" 
                                    type="button" onclick="togglePassword('encoder_password_confirmationD', 'toggleConfirmationIconD')">
                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5 hover:animate-jiggle" id="toggleConfirmationIconD">
                            </button>

                            @error('encoder_password_confirmation')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-center mt-8">
                            {!! htmlFormSnippet() !!}
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="text-red-500 flex justify-center text-sm mt-2">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="hover:animate-pop relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <span x-show="!isLoadingResetPassword">Reset Password</span>
                            <span x-show="isLoadingResetPassword" style="display: none;" class="flex items-center justify-center">
                                <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Loading...
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
        icon.src = "../images/show.png"; 
    } else {
        passwordField.type = "password";
        icon.src = "../images/hide.png"; 
    }
}
</script>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const encoder_email = urlParams.get('encoder_email');
    const encoder_token = urlParams.get('encoder_token');

    if (encoder_email) localStorage.setItem('resetEncoderEmail', encoder_email);
    if (encoder_token) localStorage.setItem('resetEncoderToken', encoder_token);
</script>
