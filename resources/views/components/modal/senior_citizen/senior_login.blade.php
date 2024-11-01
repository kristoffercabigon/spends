@if (session('clearLoginModal'))
<script>
    localStorage.removeItem('showLoginModal');
</script>
@endif

<div style="display: none" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
    x-show="showLoginModal"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showLoginModal = false; localStorage.setItem('showLoginModal', 'false')"> 
    <div @click.stop>
        <section class="bg-gray-50 dark:bg-gray-900 relative">
            <button @click="showLoginModal = false; localStorage.setItem('showLoginModal', 'false')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email@example.com">
                            
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="relative">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            
                            <button class="absolute inset-y-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-10 @error('password') mt-[10%] h-[48%] right-[-2px] top-[1px] @else mt-[10%] h-[66%] right-[-2px] top-[-1px] @enderror hover:bg-gray-600" 
                                type="button" onclick="togglePassword('password', 'togglePasswordIcon')">
                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-5 h-5" id="togglePasswordIcon">
                            </button>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" name="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a @click.prevent="
                                    localStorage.setItem('showLoginModal', 'false');
                                    localStorage.setItem('showForgotPasswordModal', 'true');
                                    window.location.href = '{{ route('forgot-password') }}?showForgotPasswordModal=true';
                                " 
                                class="text-sm text-primary-600 hover:underline dark:text-primary-500 cursor-pointer">
                                Forgot password?
                            </a>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? 
                            <a @click.prevent="
                                localStorage.setItem('showLoginModal', 'false');
                                window.location.href = '/register';
                            " 
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500 cursor-pointer">
                                Sign up
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
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