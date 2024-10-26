<nav x-data="{ open: false, showLoginModal: localStorage.getItem('showLoginModal') === 'true' }" class="bg-customGreen fixed h-[80px] w-full z-20 top-0 left-0 sm:px-4 text-white">
    <div class="container flex flex-wrap items-center h-full justify-between relative font-poppins">
        <a href="/" class="flex items-center">
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

        <div class="hidden md:block md:w-auto flex-1">
            <ul class="flex justify-center space-x-8">
                <li><a href="/" class="block py-2 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="block py-2 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="block py-2 text-16px hover:text-orange-300">About Us</a></li>
                <li><a href="/contact-us" class="block py-2 text-16px hover:text-orange-300">Contact Us</a></li>
                @auth
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="block py-2 text-16px hover:text-orange-300">Logout</button>
                    </form>
                </li>
                @else
                <li><a @click.prevent="showLoginModal = true; localStorage.setItem('showLoginModal', 'true')" class="block py-2 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                <li><a href="/register" class="block py-2 text-16px hover:text-orange-300">Sign Up</a></li>
                @endauth
            </ul>
        </div>

        <div x-show="open" style="display: none" class="absolute top-full left-0 w-full bg-customGreen bg-opacity-90 md:hidden" id="navbar-main">
            <ul class="flex flex-col px-4">
                <li><a href="/" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Home</a></li>
                <li><a href="/announcement" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Announcement</a></li>
                <li><a href="/about-us" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">About Us</a></li>
                <li><a href="/contact-us" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Contact Us</a></li>
                @auth
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Logout</button>
                    </form>
                </li>
                @else
                <li><a @click.prevent="showLoginModal = true; localStorage.setItem('showLoginModal', 'true')" class="block py-2 text-16px hover:text-orange-300 cursor-pointer">Sign In</a></li>
                <li><a href="/register" class="block py-2 pr-4 pl-3 text-16px hover:text-orange-300">Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <x-modal.senior_login />
</nav>
