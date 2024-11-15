<div 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
    x-data="{
        showEncoderVerificationModal: @json(session('showEncoderVerificationModal', false)),
        showEncoderLoginModal: false, // Add the showEncoderLoginModal state
        isLoadingVerify: false,
        isLoadingResend: false,
        statusMessage: '',
        verifyStatusMessage: '',
        encoder_email: '{{ session('encoder_email', '') }}',
        code: '{{ session('code') }}',
        
        resendCode() {
            this.isLoadingResend = true;
            this.statusMessage = '';

            fetch('{{ route('encoder-resend-code') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email: this.encoder_email })
            })
            .then(response => response.json())
            .then(data => {
                this.isLoadingResend = false;
                if (data.message) {
                    this.statusMessage = 'A new verification code has been sent to your email.';
                } else if (data.error) {
                    this.statusMessage = data.error;
                } else {
                    this.statusMessage = 'Failed to resend verification code. Please try again.';
                }
            })
            .catch(error => {
                this.isLoadingResend = false;
                this.statusMessage = 'An error occurred. Please try again.';
                console.error('Error:', error);
            });
        },
        
        verifyEncoderCode() {
            this.isLoadingVerify = true;
            this.verifyStatusMessage = '';

            const codeInput = document.getElementById('encoder_verification_code').value;

            if (!codeInput || codeInput.length !== 6 || !/^\d+$/.test(codeInput)) {
                this.verifyStatusMessage = 'Verification code must be 6 digits.';
                this.isLoadingVerify = false; 
                return; 
            }

            const formData = new FormData();
            formData.append('encoder_email', this.encoder_email);
            formData.append('code', codeInput);

            fetch('{{ route("encoder-verify-email-login") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                this.isLoadingVerify = false;
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    this.verifyStatusMessage = data.error;
                } else if (data.message) {
                    this.verifyStatusMessage = data.message;
                    localStorage.setItem('isVerified', 'true');
                    this.showEncoderVerificationModal = false;
                    
                    localStorage.setItem('showEncoderLoginModal', 'true');

                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                this.isLoadingVerify = false;
                this.verifyStatusMessage = 'An error occurred. Please try again.';
            });
        }
    }"
    x-show="showEncoderVerificationModal"
    x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    style="display: none"
    @click.away="showEncoderVerificationModal = false; localStorage.setItem('showEncoderVerificationModal', 'false'); showEncoderLoginModal = false;">
    
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showEncoderVerificationModal = false; localStorage.setItem('showEncoderVerificationModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="w-full bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Enter Verification Code
                    </h1>
                    <p class="text-sm text-gray-500">
                        Please enter the 6-digit verification code sent to your email.
                        <strong x-text="encoder_email"></strong>
                    </p>

                    <div x-data="{ verifyStatusMessage: '', isLoadingVerify: false }">
                        <form @submit.prevent="verifyEncoderCode">
                            @csrf
                            <label for="encoder_verification_code" class="block mb-2 text-sm font-medium text-gray-900">
                                Verification Code
                            </label>
                            <input type="text" name="code" id="encoder_verification_code" maxlength="6" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" 
                                placeholder="Enter code here">

                            <p x-text="verifyStatusMessage" class="mt-2 text-sm" :class="verifyStatusMessage.includes('error') || verifyStatusMessage.includes('Invalid') || verifyStatusMessage.includes('Expired') ? 'text-red-600' : 'text-red-600'"></p>

                            <button type="submit" 
                                    class="relative hover:scale-105 transition duration-150 ease-in-out w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                                <span x-show="!isLoadingVerify">Verify Code</span>
                                <span x-show="isLoadingVerify" style="display: none" class="flex items-center justify-center">
                                    <svg aria-hidden="true" class="inline w-4 h-4 me-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                    </svg>
                                    Loading...
                                </span>
                            </button>
                        </form>
                    </div>

                    <p class="text-sm font-light text-gray-500 mt-4">
                        Didn't receive a code? 
                        <a href="#" class="font-medium text-primary-600 hover:underline" 
                        @click.prevent="isLoadingResend ? null : resendCode()" 
                        :class="{ 'pointer-events-none opacity-50': isLoadingResend }">Resend Code</a>
                    </p>

                    <div x-show="isLoadingResend" style="display: none" role="status" class="mt-4 flex items-center justify-center">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                    </div>

                    <p x-text="statusMessage" class="mt-4 text-sm flex items-center justify-center" :class="statusMessage.includes('Failed') ? 'text-red-500' : 'text-green-500'"></p>
                </div>
            </div>
        </section>
    </div>
</div>