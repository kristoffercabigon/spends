@php
    $encoder = session('encoder'); 
@endphp
<nav x-data="{
        open: false,
        EncoderdropdownOpen: false,
        showEncoderLoginModal: localStorage.getItem('showEncoderLoginModal') === 'true',
        showEncoderForgotPasswordModal: localStorage.getItem('showEncoderForgotPasswordModal') === 'true',
        showEncoderVerificationModal: {{ session('showEncoderVerificationModal') ? 'true' : 'false' }},
    }"
    class="bg-customGreen fixed h-[80px] w-full z-20 top-0 left-0 right-0 text-white shadow-2xl">
    <div class="container max-w-screen-xl flex items-center h-full w-full justify-between relative font-poppins">
        <a href="/encoder" class="flex items-center">
            <img src="{{ asset('images/osca_image.jfif') }}" alt="Description of image" class="animate-zoom-in inline-block ml-4 lg:ml-[48px] h-[60px] w-[60px] rounded-full object-cover" />
            <span class="animate-fade-in-right self-center font-bold whitespace-nowrap text-30px ml-[12px]">
                {{ $data['title'] }}
            </span>
        </a>

        <button @click="open = !open" data-collapse-toggle="navbar-main" class="lg:hidden">
            <svg class="text-white mr-4 hover:animate-squeeze" xmlns="http://www.w3.org/2000/svg" alt="burger_icon" height="40px" viewBox="0 -960 960 960" width="40px" fill="#fff">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
            </svg>
        </button>

        <div class="hidden lg:flex flex-1 justify-center">
            <ul class="flex justify-center space-x-8">
                <li><a href="/encoder" class="hover:scale-105 transition duration-150 ease-in-out block py-2 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="hover:scale-105 transition duration-150 ease-in-out block py-2 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="hover:scale-105 transition duration-150 ease-in-out block py-2 text-16px hover:text-orange-300">About Us</a></li>
                <li><a href="/encoder/contact-us" class="hover:scale-105 transition duration-150 ease-in-out block py-2 text-16px hover:text-orange-300">Contact Us</a></li>
                @guest('encoder')
                <li><a @click.prevent="showEncoderLoginModal = true; localStorage.setItem('showEncoderLoginModal', 'true')" class="hover:scale-105 transition duration-150 ease-in-out block py-2 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                @endguest
            </ul>
        </div>

        <div class="hidden lg:block items-center">
            @auth('encoder')
                @php
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                @endphp
                <div class="flex items-center cursor-pointer relative" @click="EncoderdropdownOpen = !EncoderdropdownOpen">
                    <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white" src="{{ $encoder->encoder_profile_picture ? asset('storage/images/encoder/encoder_thumbnail_profile/'.$encoder->encoder_profile_picture) : $default_profile }}" alt="Profile Picture">
                    <div class="ml-4">
                        <div class="mr-6 lg:mr-[48px] animate-fade-in-right">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name }}</div>
                    </div>
                    <div 
                        x-show="EncoderdropdownOpen"
                        x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-[-5%]"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition transform ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-[10%]"
                        style="display: none"
                        @click.away="EncoderdropdownOpen = false"
                        id="userDropdown"
                        class="z-10 absolute left-0 transform top-0 mt-12 bg-white shadow-lg divide-y divide-gray-100 rounded-lg shadow w-44 origin-top"
                    >
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium truncate">{{ $encoder->encoder_email }}</div>
                            <div class="font-medium truncate">Encoder ID: {{ $encoder->encoder_id }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="avatarButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            </li>
                            <li>
                                <a href="/encoder/profile/{{$encoder->id}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <form action="/encoder/logout" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

        <div 
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-10" 
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0" 
            x-transition:leave-end="opacity-0 transform -translate-y-10"
            style="display: none" 
            class="absolute top-full left-0 w-full bg-customGreen bg-opacity-90 lg:hidden" 
            id="navbar-main"
        >
            <ul class="block flex-col px-4">
                @auth('encoder')
                    <li @click="EncoderdropdownOpen = !EncoderdropdownOpen" class="flex items-center right-0 cursor-pointer py-2 pr-4 pl-3 text-16px hover:text-orange-300 relative">
                        <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white" src="{{ $encoder->encoder_profile_picture ? asset("storage/images/encoder/encoder_thumbnail_profile/".$encoder->encoder_profile_picture) : $default_profile }}" alt="Profile Picture">
                        <div class="ml-4 animate-fade-in-right">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name }}</div>
                    </li>
                    <div 
                        x-show="EncoderdropdownOpen"
                        x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-[-5%]"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition transform ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-[10%]"
                        style="display: none" 
                        @click.away="EncoderdropdownOpen = false" 
                        class="absolute z-20 mt-2 right-0 left-0 ml-[60px] bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-48 origin-top"
                    >
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium truncate">{{ $encoder->encoder_email }}</div>
                            <div class="font-medium truncate">Encoder ID: {{ $encoder->encoder_id }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
                            <li><a href="/encoder/profile/{{$encoder->id}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a></li>
                        </ul>
                        <div class="py-1">
                            <form action="/encoder/logout" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                @endauth
                <li><a href="/encoder" class="hover:scale-105 transition duration-150 ease-in-out block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="hover:scale-105 transition duration-150 ease-in-out block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="hover:scale-105 transition duration-150 ease-in-out block py-2 pr-4 pl-3 text-16px hover:text-orange-300">About Us</a></li>
                <li><a href="/encoder/contact-us" class="hover:scale-105 transition duration-150 ease-in-out block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Contact Us</a></li>
                @guest('encoder')
                <li><a @click.prevent="showEncoderLoginModal = true; localStorage.setItem('showEncoderLoginModal', 'true')" class="hover:scale-105 transition duration-150 ease-in-out block py-2 pr-4 pl-3 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                @endguest
            </ul>
        </div>
    </div>

    <x-modal.encoder.encoder_login />
    <x-modal.encoder.encoder_forgot_password />
    <x-modal.encoder.encoder_verify_your_email />
</nav>
