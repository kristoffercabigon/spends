@if (session('clearAdminEditProfileModal'))
<script>
    localStorage.removeItem('showAdminEditProfileModal');
</script>
@endif

<div style="display: none" class="fixed inset-0 bg-black bg-opacity-50 z-5 flex items-center justify-center font-poppins"
    x-show="showAdminEditProfileModal"
    x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showAdminEditProfileModal = false; localStorage.setItem('showAdminEditProfileModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminEditProfileModal = false; localStorage.setItem('showAdminEditProfileModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-[400px] bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-4 leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Edit Profile
                    </h1>
                    
                    <form x-data="{ isAdminLoadingSignUp: false }"
                          @submit.prevent="
                          isAdminLoadingSignUp = true;
                          $nextTick(() => $el.submit());" 
                          class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data" action="/admin/profile/edit-profile">
                        @method('PUT')
                        @csrf

                        <div class="space-y-4 md:space-y-6 overflow-x-hidden overflow-y-auto max-h-80 px-2">
                            <div>
                                <label for="admin_first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                                <input type="text" name="admin_first_name" id="admin_first_name" placeholder="First Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $admin->admin_first_name }}">

                                @error('admin_first_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="admin_middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle Name</label>
                                <input type="text" name="admin_middle_name" id="admin_middle_name" placeholder="Middle Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $admin->admin_middle_name }}">
                                @error('admin_middle_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="admin_last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                                <input type="text" name="admin_last_name" id="admin_last_name" placeholder="Last Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $admin->admin_last_name }}">

                                @error('admin_last_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="admin_suffix" class="block mb-2 text-sm font-medium text-gray-900">Suffix</label>
                                <input type="text" name="admin_suffix" id="admin_suffix" placeholder="Enter suffix (e.g., Jr., Sr., III)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $admin->suffix }}">

                                @error('admin_suffix')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="admin_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="text" name="admin_email" id="admin_email" placeholder="email@example.com"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ $admin->admin_email }}">

                                @error('admin_email')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-center mt-4">
                            {!! htmlFormSnippet() !!}
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="text-red-500 flex justify-center text-sm mt-2">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="relative hover:scale-105 transition duration-150 ease-in-out w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                            <span x-show="!isAdminLoadingSignUp">Update</span>
                            <span x-show="isAdminLoadingSignUp" style="display: none;" class="flex items-center justify-center">
                                <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367013 46.6973 0.446055 41.7345 1.27873C39.1893 1.69888 37.7347 4.19778 38.3728 6.62326C39.0109 9.04874 41.4898 10.4717 44.0165 10.1073C47.7697 9.51906 51.6061 9.50477 55.3964 10.0703C60.5613 10.8539 65.4804 12.6885 69.7666 15.4546C74.0529 18.2206 77.6016 21.8611 80.2044 26.149C82.3643 29.6466 83.9246 33.5265 84.8186 37.602C85.406 40.0368 87.5422 41.6781 89.9676 41.0409Z" fill="currentColor"/>
                                </svg>
                                Updating Profile...
                            </span>
                        </button>
                    
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
