@php
    $encoder = session('encoder'); 
@endphp
<nav x-data="{
        open: false,
        EncoderdropdownOpen: false,
        showEncoderLoginModal: localStorage.getItem('showEncoderLoginModal') === 'true',
        showEncoderRegisterModal: localStorage.getItem('showEncoderRegisterModal') === 'true',
        showEncoderForgotPasswordModal: localStorage.getItem('showEncoderForgotPasswordModal') === 'true',
        showEncoderVerificationModal: {{ session('showEncoderVerificationModal') ? 'true' : 'false' }},
        showEncoderCameraModal: false,
        showEncoderProfilePicModal: false,
        previewEncoderUrl: '',
        previewEncoderImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewEncoderUrl = e.target.result;
                    document.getElementById('encoder_profile_picture_preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }"
    @open-encoder-camera-modal.window="showEncoderCameraModal = true; localStorage.setItem('showEncoderCameraModal', 'true')"
    @close-encoder-camera-modal.window="showEncoderCameraModal = false; localStorage.setItem('showEncoderCameraModal', 'false')" 
    class="bg-customGreen fixed h-[80px] w-full z-20 top-0 left-0 right-0 text-white shadow-2xl">
    <div class="container flex items-center h-full justify-between relative font-poppins">
        <a href="/encoder" class="flex items-center">
            <img src="{{ asset('images/osca_image.jfif') }}" alt="Description of image" class="inline-block ml-4 md:ml-[48px] h-[60px] w-[60px] rounded-full object-cover" />
            <span class="self-center font-bold whitespace-nowrap text-30px ml-[12px]">
                {{ $data['title'] }}
            </span>
        </a>

        <button @click="open = !open" data-collapse-toggle="navbar-main" class="md:hidden">
            <svg class="text-white mr-4" xmlns="http://www.w3.org/2000/svg" alt="burger_icon" height="40px" viewBox="0 -960 960 960" width="40px" fill="#fff">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
            </svg>
        </button>

        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex justify-center space-x-8">
                <li><a href="/encoder" class="block py-2 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="block py-2 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="block py-2 text-16px hover:text-orange-300">Pension Distribution</a></li>
                <li><a href="/contact-us" class="block py-2 text-16px hover:text-orange-300">Lists of Seniors</a></li>
                @guest
                <li><a @click.prevent="showEncoderLoginModal = true; localStorage.setItem('showEncoderLoginModal', 'true')" class="block py-2 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                <li><a @click.prevent="showEncoderRegisterModal = true; localStorage.setItem('showEncoderRegisterModal', 'true')" class="block py-2 text-16px hover:text-orange-300 cursor-pointer">Sign Up</a></li>
                @endguest
            </ul>
        </div>

        <div class="hidden md:block items-center">
            {{-- @if ($senior) --}}
                {{-- @php
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                @endphp
                <div class="flex items-center cursor-pointer" @click="EncoderdropdownOpen = !EncoderdropdownOpen">
                    <img id="avatarButton" class="w-10 h-10 rounded-full ring-2 ring-white" src="{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}" alt="Profile Picture">
                    <div class="ml-4">
                        <div>{{ $senior->first_name }} {{ $senior->last_name }}</div>
                    </div>
                </div> --}}

                <div 
                    x-show="EncoderdropdownOpen" 
                    style="display: none" 
                    @click.away="EncoderdropdownOpen = false" 
                    id="userDropdown" 
                    class="z-10 absolute right-0 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 origin-top-right"
                    x-transition:enter="transition ease-out duration-200 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                >
                    <div class="px-4 py-3 text-sm text-gray-900">
                        {{-- <div class="font-medium truncate">{{ $senior->email }}</div>
                        <div class="font-medium truncate">Encoder ID: {{ $senior->osca_id }}</div> --}}
                    </div>
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="avatarButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Messages</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100">Sign out</button>
                        </form>
                    </div>
                </div>
            {{-- @endif --}}
        </div>

        <div 
            x-show="open" 
            style="display: none" 
            class="absolute top-full left-0 w-full bg-customGreen bg-opacity-90 md:hidden" 
            id="navbar-main"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
        >
            <ul class="block flex-col px-4">
                {{-- @if ($senior) --}}
                    {{-- <li @click="EncoderdropdownOpen = !EncoderdropdownOpen" class="flex items-center right-0 cursor-pointer py-2 pr-4 pl-3 text-16px hover:text-orange-300 relative">
                        <img id="avatarButton" class="w-10 h-10 rounded-full ring-2 ring-white" src="{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}" alt="Profile Picture">
                        <div class="ml-4">{{ $senior->first_name }} {{ $senior->last_name }}</div>
                    </li> --}}
                    <div 
                        x-show="EncoderdropdownOpen" 
                        style="display: none" 
                        @click.away="EncoderdropdownOpen = false" 
                        class="absolute z-20 mt-2 right-0 left-0 ml-[60px] bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-48 origin-top"
                        x-transition:enter="transition ease-out duration-200 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                    >
                        <div class="px-4 py-3 text-sm text-gray-900">
                            {{-- <div class="font-medium truncate">{{ $senior->email }}</div>
                            <div class="font-medium truncate">Encoder ID: {{ $senior->osca_id }}</div> --}}
                        </div>
                        <ul class="py-2 text-sm text-gray-700">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile Settings</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Messages</a></li>
                        </ul>
                        <div class="py-1">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                {{-- @endif --}}
                <li><a href="/encoder" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Pension Distribution</a></li>
                <li><a href="/contact-us" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Lists of Seniors</a></li>
                @guest
                <li><a @click.prevent="showEncoderLoginModal = true; localStorage.setItem('showEncoderLoginModal', 'true')" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                <li><a @click.prevent="showEncoderRegisterModal = true; localStorage.setItem('showEncoderRegisterModal', 'true')" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300 cursor-pointer">Sign Up</a></li>
                @endguest
            </ul>
        </div>
    </div>

    
    <x-modal.encoder.encoder_profilepic_zoom />
    <x-modal.encoder.encoder_register_camera />
    <x-modal.encoder.encoder_login />
    <x-modal.encoder.encoder_forgot_password />
    <x-modal.encoder.encoder_register />
</nav>
