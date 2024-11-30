@php
    $admin = session('admin');
@endphp
<nav x-data="{
        open: false,
        AdmindropdownOpen: false,
        showAdminLoginModal: localStorage.getItem('showAdminLoginModal') === 'true',
        showAdminForgotPasswordModal: localStorage.getItem('showAdminForgotPasswordModal') === 'true',
        showAdminVerificationModal: {{ session('showAdminVerificationModal') ? 'true' : 'false' }}
    }"
    class="bg-customGreen fixed h-[80px] w-full z-20 top-0 left-0 right-0 text-white shadow-2xl">
    <div class="container max-w-screen-xl flex items-center h-full w-full justify-between relative font-poppins">
        <a href="/admin" class="flex items-center">
            <img src="{{ asset('images/osca_image.jfif') }}" alt="Description of image" class="animate-zoom-in inline-block ml-4 md:ml-[48px] h-[60px] w-[60px] rounded-full object-cover" />
            <span class="animate-fade-in-right self-center font-bold whitespace-nowrap text-30px ml-[12px]">
                {{ $data['title'] }}
            </span>
        </a>

        <button @click="open = !open" data-collapse-toggle="navbar-main" class="md:hidden">
            <svg class="text-white mr-4 hover:animate-squeeze" xmlns="http://www.w3.org/2000/svg" alt="burger_icon" height="40px" viewBox="0 -960 960 960" width="40px" fill="#fff">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
            </svg>
        </button>

        <div class="hidden md:flex flex-1 justify-center">
            <ul class="flex justify-center space-x-8">
                <li>
                    <a href="/admin" 
                    class="hover:scale-105 transition duration-150 ease-in-out inline-block py-2 text-16px hover:text-orange-300 
                    {{ request()->is('admin') ? 'border-b-2 border-orange-300 text-white' : '' }}">
                    Home
                    </a>
                </li>
                <li>
                    <a href="/admin/about-us" 
                    class="hover:scale-105 transition duration-150 ease-in-out inline-block py-2 text-16px hover:text-orange-300 
                    {{ request()->is('admin/about-us') ? 'border-b-2 border-orange-300 text-white' : '' }}">
                    About Us
                    </a>
                </li>
                @guest('admin')
                <li class="inline-block">
                    <a @click.prevent="showAdminLoginModal = true; localStorage.setItem('showAdminLoginModal', 'true')"
                    class="text-white font-medium px-3 py-2 rounded-lg border border-transparent hover:border-gray-600 hover:text-orange-300 transition duration-150 ease-in-out block text-16px cursor-pointer">
                        Sign In
                 </a>  
                @endguest
            </ul>
        </div>

        <div class="hidden md:block items-center">
            @auth('admin')
                @php
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$admin->admin_first_name."-".$admin->admin_last_name;
                @endphp
                <div class="flex items-center cursor-pointer relative" @click="AdmindropdownOpen = !AdmindropdownOpen">
                    <div class="mr-4 animate-fade-in-right">{{ $admin->admin_first_name }} {{ $admin->admin_last_name }}</div>
                    <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white md:mr-[48px]" src="{{ $admin->admin_profile_picture ? asset('storage/images/admin/admin_profile_picture/'.$admin->admin_profile_picture) : $default_profile }}" alt="Profile Picture">
                    <div 
                        x-show="AdmindropdownOpen"
                        x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-[-5%]"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition transform ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-[10%]"
                        style="display: none"
                        @click.away="AdmindropdownOpen = false"
                        class="z-10 absolute left-0 transform top-0 mt-12 bg-white shadow-lg divide-y divide-gray-100 rounded-lg shadow w-44 origin-top"
                    >
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium truncate">{{ $admin->admin_email }}</div>
                            <div class="font-medium truncate">Administrator</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="avatarButton">
                            <li><a href="/admin/dashboard" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
                            <li><a href="/admin/profile/{{$admin->id}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Messages</a></li>
                        </ul>
                        <div class="py-1">
                            <form action="/admin/logout" method="POST">
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
            class="absolute top-full left-0 w-full bg-customGreen bg-opacity-90 md:hidden" 
            id="navbar-main"
        >
            <ul class="block flex-col px-4">
                @auth('admin')
                    <li @click="AdmindropdownOpen = !AdmindropdownOpen" class="flex items-center right-0 cursor-pointer py-2 pr-4 pl-3 text-16px hover:text-orange-300 relative">
                        <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white" src="{{ $admin->admin_profile_picture ? asset('storage/images/admin/admin_profile_picture/'.$admin->admin_profile_picture) : $default_profile }}" alt="Profile Picture">
                        <div class="ml-4 animate-fade-in-right">{{ $admin->admin_first_name }} {{ $admin->admin_last_name }}</div>
                    </li>
                    <div 
                        x-show="AdmindropdownOpen"
                        x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-y-[-5%]"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition transform ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform translate-y-[10%]"
                        style="display: none" 
                        @click.away="AdmindropdownOpen = false" 
                        class="absolute z-20 mt-2 right-0 left-0 ml-[60px] bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-48 origin-top"
                    >
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium truncate">{{ $admin->admin_email }}</div>
                            <div class="font-medium truncate">Admin ID: {{ $admin->admin_id }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700">
                            <li><a href="/admin/dashboard" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
                            <li><a href="/admin/profile/{{$admin->id}}" class="block px-4 py-2 hover:bg-gray-100">Profile</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Messages</a></li>
                        </ul>
                        <div class="py-1">
                            <form action="/admin/logout" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100">Sign out</button>
                            </form>
                        </div>
                    </div>
                @endauth
                <li>
                    <a href="/admin" 
                    class="hover:scale-105 transition duration-150 ease-in-out inline-block py-2 pr-4 pl-3 text-16px hover:text-orange-300 
                    {{ request()->is('admin') ? 'border-b-2 border-orange-300 text-white' : '' }}">
                    Home
                    </a>
                </li>
                <li>
                    <a href="/admin/about-us" 
                    class="hover:scale-105 transition duration-150 ease-in-out inline-block py-2 pr-4 pl-3 text-16px hover:text-orange-300 
                    {{ request()->is('admin/about-us') ? 'border-b-2 border-orange-300 text-white' : '' }}">
                    About Us
                    </a>
                </li>
                @guest('admin')
                    <li class="inline-block">
                    <a @click.prevent="showAdminLoginModal = true; localStorage.setItem('showAdminLoginModal', 'true')"
                    class="text-white font-medium px-3 py-2 rounded-lg border border-transparent hover:border-gray-600 hover:text-orange-300 transition duration-150 ease-in-out block text-16px cursor-pointer">
                        Sign In
                 </a>  
                @endguest
            </ul>
        </div>
    </div>
    
    <x-modal.admin.admin_profilepic_zoom />
    <x-modal.admin.admin_login />
    <x-modal.admin.admin_forgot_password />
    <x-modal.admin.admin_verify_your_email />
</nav>
