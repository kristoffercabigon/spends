{{-- @if (session('clearAdminViewHashModal'))
<script>
    localStorage.removeItem('showAdminViewHashModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showAdminViewHashModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showAdminViewHashModal = false; localStorage.setItem('showAdminViewHashModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminViewHashModal = false; localStorage.setItem('showAdminViewHashModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Admin Verification
                    </h1>

                    <label for="admin-password" class="block mb-2">Enter Admin Password:</label>
                    <input type="password" id="admin-password" class="border rounded w-full mt-2 p-2" placeholder="Enter password">
                    <button id="submit" type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                    <button @click="showAdminViewHashModal = false" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <p id="error-message" class="text-red-500 mt-2 hidden"></p>

                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.getElementById('submit').addEventListener('click', function () {
        const passwordInput = document.getElementById('admin-password');
        const password = passwordInput.value.trim();
        const errorMessage = document.getElementById('error-message');

        errorMessage.classList.add('hidden');
        errorMessage.textContent = '';

        if (!password) {
            errorMessage.textContent = 'Password is required.';
            errorMessage.classList.remove('hidden');
            return;
        }

        fetch('/admin/blockchain/verify-password-hash', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 200 && body.success) {
                document.getElementById('current-block-hash-hidden').innerText = body.current_block_hash;
                document.getElementById('previous-block-hash-hidden').innerText = body.previous_block_hash;
                errorMessage.classList.add('hidden');
                localStorage.removeItem('showAdminViewHashModal');
            } else {
                errorMessage.textContent = body.message || 'An error occurred. Please try again.';
                errorMessage.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorMessage.textContent = 'An unexpected error occurred.';
            errorMessage.classList.remove('hidden');
        });
    });

</script> --}}
