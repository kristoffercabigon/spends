@if (session('clearAdminAddEncoderModal'))
<script>
    localStorage.removeItem('showAdminAddEncoderModal');
</script>
@endif

<div style="display: none" class="fixed inset-0 bg-black bg-opacity-50 z-10 flex items-center justify-center font-poppins"
    x-show="showAdminAddEncoderModal"
    x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showAdminAddEncoderModal = false; localStorage.setItem('showAdminAddEncoderModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminAddEncoderModal = false; localStorage.setItem('showAdminAddEncoderModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-[400px] bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-4 leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Add Encoder
                    </h1>
                    <div class="relative">
                        <div id="progressLeft" class="absolute top-[35%] left-0 h-[2px] z-0 transform -translate-y-1/2 bg-gray-500" style="width: 50%;"></div>
                        <div id="progressRight" class="absolute top-[35%] left-1/2 h-[2px] z-0 transform -translate-y-1/2 bg-gray-500" style="width: 50%;"></div>

                        <ul class="grid grid-cols-2 mx-auto py-2 gap-x-4 md:gap-x-8 w-[100%] relative z-10">
                            <div class="flex flex-col items-center gap-y-2">
                                <li id="navstep1" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-7 min-h-7 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step1">
                                            <span id="step1text">1</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800">Account Information</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2">
                                <li id="navstep2" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-7 min-h-7 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step2">
                                            <span id="step2text">2</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 text-center">Profile Picture</span>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <form x-data="{ isEncoderLoadingSignUp: false }"
                          @submit.prevent="
                          isEncoderLoadingSignUp = true;
                          $nextTick(() => $el.submit());" 
                          class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data" action="{{ route('admin-submit-add-encoder') }}">
                        @csrf

                        <div id="content1" class="space-y-4 md:space-y-6 overflow-x-hidden overflow-y-auto max-h-80 px-2">
                            <div>
                                <label for="encoder_first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                                <input type="text" name="encoder_first_name" id="encoder_first_name" placeholder="First Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_first_name') }}">

                                @error('encoder_first_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_first_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_middle_name" class="block mb-2 text-sm font-medium text-gray-900">Middle Name</label>
                                <input type="text" name="encoder_middle_name" id="encoder_middle_name" placeholder="Middle Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_middle_name') }}">
                                @error('encoder_middle_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_middle_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                                <input type="text" name="encoder_last_name" id="encoder_last_name" placeholder="Last Name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_last_name') }}">

                                @error('encoder_last_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_last_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_suffix" class="block mb-2 text-sm font-medium text-gray-900">Suffix</label>
                                <input type="text" name="encoder_suffix" id="encoder_suffix" placeholder="Enter suffix (e.g., Jr., Sr., III)"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_suffix') }}">

                                @error('encoder_suffix')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_suffix'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                                <input type="text" name="encoder_address" id="encoder_address" placeholder="Address"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_address') }}">

                                @error('encoder_address')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_address'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_barangay_id" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                <select name="encoder_barangay_id" id="encoder_barangay_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    <option value="" disabled selected>Select Barangay</option>
                                    @foreach ($barangay_list as $barangay)
                                        <option value="{{ $barangay->id }}" {{ old('encoder_barangay_id') == $barangay->id ? 'selected' : '' }}>
                                            {{ $barangay->barangay_no }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('encoder_barangay_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_barangay_id'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm mb-2 block">
                                    Contact Number
                                </label>

                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                        +63
                                    </span>
                                    
                                    <input name="encoder_contact_no" type="text" value="{{ old('encoder_contact_no') }}" 
                                        class="w-full text-sm px-4 py-3 rounded-r-md transition-all pr-10" 
                                        placeholder="(10 digits)" 
                                        inputmode="numeric" pattern="[0-9]*" maxlength="10" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>
                                @error('encoder_contact_no')
                                <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_contact_no'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label for="encoder_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <input type="email" name="encoder_email" id="encoder_email" placeholder="email@example.com"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_email') }}">

                                @error('encoder_email')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_email'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                        </div>

                        <div id="content2" class="space-y-4 px-2 md:space-y-6 overflow-x-hidden overflow-y-auto max-h-80 px-2">

                            <div class="relative">
                                <label for="encoder_profile_picture" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>

                                <input type="file" name="encoder_profile_picture" id="EncoderProfilePictureField"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="{{ old('encoder_profile_picture') }}" 
                                    @change="previewEncoderImage">

                                <button @click="$dispatch('open-admin-encoder-camera-modal')" 
                                    class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12 @error('encoder_profile_picture') h-[41%] mt-[8.5%] @else mt-[8.5%] @enderror" 
                                    type="button">
                                    <img src="../images/camera.png" alt="Toggle Profile Picture" class="camera-icon w-7 h-7" id="toggleCameraIcon">
                                </button>

                                @error('encoder_profile_picture')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('encoder_profile_picture'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <p id="encoder_profile_picture_filename" class="text-gray-700 text-xs mt-2"></p>

                            <div class="flex justify-center items-center mt-4">
                                <img :src="previewEncoderUrl" id="encoder_profile_picture_preview" class="max-h-48 rounded-md shadow-lg cursor-pointer" style="display: none;" alt="Profile Picture Preview"
                                    @click="showAdminEncoderProfilePicModal = true">
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

                            <button type="submit" class="relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">
                                <span x-show="!isEncoderLoadingSignUp">Sign up</span>
                                <span x-show="isEncoderLoadingSignUp" style="display: none;" class="flex items-center justify-center">
                                    <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367013 46.6973 0.446055 41.7345 1.27873C39.1893 1.69888 37.7347 4.19778 38.3728 6.62326C39.0109 9.04874 41.4898 10.4717 44.0165 10.1073C47.7697 9.51906 51.6061 9.50477 55.3964 10.0703C60.5613 10.8539 65.4804 12.6885 69.7666 15.4546C74.0529 18.2206 77.6016 21.8611 80.2044 26.149C82.3643 29.6466 83.9246 33.5265 84.8186 37.602C85.406 40.0368 87.5422 41.6781 89.9676 41.0409Z" fill="currentColor"/>
                                    </svg>
                                    Signing up...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3  flex justify-between items-center">
                            <div>
                                <button type="button" id="backButton" class="py-3 px-6 shadow-lg text-sm tracking-wider font-light rounded-md text-gray-800 border border-gray-200 bg-gray-200 shadow-sm hover:bg-gray-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                                    <svg class="shrink-0 w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 18l-6-6 6-6"></path>
                                    </svg>
                                    Back
                                </button>
                            </div>
                            <div>
                                <button type="button" id="nextButton" class="py-3 px-6 shadow-lg text-sm tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148e10] focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                                    Next
                                    <svg class="shrink-0 w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 18l6-6-6-6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script src= "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
    let currentStep = localStorage.getItem('currentStep') ? parseInt(localStorage.getItem('currentStep')) : 1; 

    function updateButtonVisibility() {
        const backButton = document.getElementById('backButton');
        const nextButton = document.getElementById('nextButton');

        backButton.style.display = currentStep === 1 ? 'none' : 'inline-flex';
        nextButton.style.display = currentStep === 2 ? 'none' : 'inline-flex';
    }

    function updateStepStyles() {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step1text = document.getElementById('step1text');
        const step2text = document.getElementById('step2text');
        const progressLeft = document.getElementById('progressLeft');
        const progressRight = document.getElementById('progressRight');


        step1.style.backgroundColor = '#A1A1AA'; 
        step2.style.backgroundColor = '#A1A1AA'; 
        step1text.style.color = '#fff';
        step2text.style.color = '#fff';
        progressLeft.style.backgroundColor = '#A1A1AA';
        progressRight.style.backgroundColor = '#A1A1AA';

        if (currentStep === 1) {
            step1.style.backgroundColor = '#1AA514';
            step1text.style.color = '#fff';  
            progressLeft.style.width = '50%'; 
            progressLeft.style.backgroundColor = '#1AA514';
        } else if (currentStep === 2) {
            step1.style.backgroundColor = '#1AA514';
            step2.style.backgroundColor = '#1AA514';
            step2text.style.color = '#fff'; 
            progressLeft.style.width = '50%';
            progressLeft.style.backgroundColor = '#1AA514';
            progressRight.style.backgroundColor = '#1AA514';
        }
    }

    document.getElementById('nextButton').addEventListener('click', function() {
        if (currentStep === 1) {
            document.getElementById('content1').style.display = 'none';
            document.getElementById('content2').style.display = 'block';
            currentStep++;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
        }
    });

    document.getElementById('backButton').addEventListener('click', function() {
        if (currentStep === 2) {
            document.getElementById('content2').style.display = 'none';
            document.getElementById('content1').style.display = 'block';
            currentStep--;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
        }
    });

    updateButtonVisibility();
    updateStepStyles();

    if (currentStep === 2) {
        document.getElementById('content1').style.display = 'none';
        document.getElementById('content2').style.display = 'block';
    } else {
        document.getElementById('content1').style.display = 'block';
        document.getElementById('content2').style.display = 'none';
    }
</script>

<script>
    document.getElementById('EncoderProfilePictureField').addEventListener('change', function() {
    var file = this.files[0];

    document.getElementById('encoder_profile_picture_filename').textContent = file ? 'Image attached' : '';

        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('profile_picture_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('profile_picture_preview').style.display = 'none';
        }
    });
</script>
