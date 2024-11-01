@if (session('savePasswordResetModal'))
    <script>
        console.log("Modal session active, email:", '{{ session('email') }}', "token:", '{{ session('token') }}');
        localStorage.setItem('resetEmail', localStorage.getItem('resetEmail') || '{{ session('email') }}');
        localStorage.setItem('resetToken', localStorage.getItem('resetToken') || '{{ session('token') }}');
        localStorage.setItem('showPasswordResetModal', 'true');
    </script>
@endif

@if (session('removePasswordResetModal'))
    <script>
        localStorage.removeItem('showPasswordResetModal');
        localStorage.setItem('resetEmail', localStorage.getItem('resetEmail'));
        localStorage.setItem('resetToken', localStorage.getItem('resetToken'));
    </script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-data="{
         showPasswordResetModal: localStorage.getItem('showPasswordResetModal') === 'true',
         email: localStorage.getItem('resetEmail'), 
         token: localStorage.getItem('resetToken'),
         init() {
             if (this.email) {
                 localStorage.setItem('resetEmail', this.email);
                 document.getElementById('resetEmail').value = this.email;
             }
             if (this.token) {
                 localStorage.setItem('resetToken', this.token);
             }
             localStorage.setItem('showPasswordResetModal', this.showPasswordResetModal);
         }
     }"
     x-show="showPasswordResetModal"
     style="display: none"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click.away="showPasswordResetModal = false; localStorage.setItem('showPasswordResetModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 dark:bg-gray-900 relative">
            <button @click="showPasswordResetModal = false; localStorage.setItem('showPasswordResetModal', 'false')" 
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

                    <div x-show="email" class="text-sm text-gray-600 dark:text-gray-400">
                        Change password for email: <strong x-text="email"></strong>
                    </div>

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('reset-password') }}"> 
                        @csrf
                        @method('PUT')
                        
                        <div class="relative">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="hidden" name="email" id="resetEmail" value="">
                            <input type="password" name="password" id="password1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="New Password"
                                oninput="updatePasswordCriteria(this.value)">
                            
                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 hover:bg-gray-600 @error('password') h-[24%] mt-[7%] right-[-2px]  @else mt-[7%] h-[28%] right-[-2px] @enderror" 
                                type="button" onclick="togglePassword('password1', 'togglePasswordIcon')">
                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5" id="togglePasswordIcon">
                            </button>

                            <div class="ml-2 mt-4 text-gray-800 text-sm">
                                <ul>
                                    <li id="minLength"><i class="fas fa-times text-red-500"></i> Minimum 8 characters</li>
                                    <li id="uppercase"><i class="fas fa-times text-red-500"></i> At least one uppercase letter</li>
                                    <li id="lowercase"><i class="fas fa-times text-red-500"></i> At least one lowercase letter</li>
                                    <li id="symbol"><i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)</li>
                                </ul>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Confirm Password">
                            
                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 hover:bg-gray-600 @if('password_confirmation') h-[65%] mt-[7%] right-[-2px]@endif" 
                                type="button" onclick="togglePassword('password_confirmation', 'toggleConfirmationIcon')">
                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5" id="toggleConfirmationIcon">
                            </button>
                            
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset Password</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script src= "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
function updatePasswordCriteria(password) {
    document.getElementById("minLength").innerHTML = 
        password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' : 
        '<i class="fas fa-times text-red-500"></i> Minimum 8 characters';
    
    document.getElementById("uppercase").innerHTML = 
        /[A-Z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' : 
        '<i class="fas fa-times text-red-500"></i> At least one uppercase letter';
    
    document.getElementById("lowercase").innerHTML = 
        /[a-z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' : 
        '<i class="fas fa-times text-red-500"></i> At least one lowercase letter';
    
    document.getElementById("symbol").innerHTML = 
        /[@$!%*?&]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one symbol (@$!%*?&)' : 
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
