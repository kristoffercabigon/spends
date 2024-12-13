@php
    $encoder = session('encoder'); 
@endphp

    <div
      x-data="setup()"
      x-init="$refs.loading.classList.add('hidden'); "
      @resize.window="watchScreen()"
    >
      <div class="flex fixed top-0 left-0 z-10 h-screen antialiased text-gray-900">

        <div
          x-ref="loading"
          class="fixed h-screen inset-0 z-10 flex items-center justify-center text-2xl font-semibold text-white bg-black bg-opacity-75"
        >
          Loading.....
        </div>

        <div
          x-show="isSidebarOpen"
          @click="isSidebarOpen = false"
          class="fixed inset-0 z-10 bg-black bg-opacity-75 lg:hidden"
          aria-hidden="true"
        ></div>

        <div
          x-show="isMainPanelOpen"
          @click="isMainPanelOpen = false"
          class="fixed inset-0 z-10 bg-black bg-opacity-75 lg:hidden"
          style="opacity: 0.5"
          aria-hidden="true"
        ></div> 

        <nav x-data="{
                EncoderdashboarddropdownOpen: false,
            }"
            x-show="isMainUpperPanelLargeOpen"
            tabindex="-1"
            @keydown.escape="window.innerWidth <= 1024 ? isMainUpperPanelLargeOpen = false : ''"
            class="bg-customGreen fixed h-[80px] w-full z-20 top-0 left-0 right-0 text-white shadow-2xl" style="display: none">
            <div class="container max-w-screen-2xl flex items-center h-full w-full justify-between relative font-poppins">
                <a href="/encoder" class="flex items-center">
                    <img src="{{ asset('images/osca_image.jfif') }}" alt="Description of image" class="animate-zoom-in inline-block ml-4 md:ml-[48px] h-[60px] w-[60px] rounded-full object-cover" />
                    <span class="animate-fade-in-right self-center font-bold whitespace-nowrap text-30px ml-[12px]">
                        {{ $data['title'] }}
                    </span>
                </a>

                <div class="hidden md:flex flex-1 justify-start">
                  <div class="relative w-[50%] ml-8">
                      <input type="search" id="search-dropdown-nav" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-2 border-r-2 border-[#1AA514] focus:ring-[#1AA514] focus:border-[#1AA514]" placeholder="Search" required />
                      <button type="button" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-white rounded-r-lg border border-[#1AA514] hover:bg-[#169f11] focus:ring-4 focus:outline-none focus:ring-[#1AA514] pointer-events-none cursor-not-allowed">
                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                              <path stroke="gray" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                          </svg>
                          <span class="sr-only">Search</span>
                      </button>
                  </div>
                </div>

                <div class="hidden md:block items-center">
                    @auth('encoder')
                        @php
                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                        @endphp
                        <div class="flex items-center cursor-pointer relative" @click="EncoderdashboarddropdownOpen = !EncoderdashboarddropdownOpen">
                            <div class="mr-4 animate-fade-in-right">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name }}</div>
                            <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white md:mr-[48px]" src="{{ $encoder->encoder_profile_picture ? asset('storage/images/encoder/encoder_profile_picture/'.$encoder->encoder_profile_picture) : $default_profile }}" alt="Profile Picture">
                            <div 
                                x-show="EncoderdashboarddropdownOpen"
                                x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-[-5%]"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition transform ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform translate-y-[10%]"
                                style="display: none"
                                @click.away="EncoderdashboarddropdownOpen = false"
                                class="z-10 absolute left-0 transform top-0 mt-12 bg-white shadow-lg divide-y divide-gray-100 rounded-lg shadow w-44 origin-top"
                            >
                                <div class="px-4 py-3 text-sm text-gray-900">
                                    <div class="font-medium truncate">{{ $encoder->encoder_email }}</div>
                                    <div class="font-medium truncate">Encoder ID: {{ $encoder->encoder_id }}</div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="avatarButton">
                                    <li>
                                        <a href="/encoder" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                        <img 
                                                src="{{ asset('images/home.png') }}" 
                                                alt="Home Icon" 
                                                class="w-5 h-5"
                                                aria-hidden="true"/>
                                            <span class="ml-2">Home</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/encoder/profile/{{$encoder->id}}" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                            <img 
                                                src="{{ asset('images/user-dropdown.png') }}" 
                                                alt="Dashboard Icon" 
                                                class="w-5 h-5"
                                                aria-hidden="true"/>
                                            <span class="ml-2">Profile</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <form action="/encoder/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="block px-4 py-2 text-left text-sm text-gray-700 w-full hover:bg-gray-100 flex items-center">
                                        <img 
                                        src="{{ asset('images/logout-dropdown.png') }}" 
                                        alt="Dashboard Icon" 
                                        class="w-5 h-5"
                                        aria-hidden="true"/>
                                        <span class="ml-2">Sign out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <nav aria-label="Main" class="flex-1 w-64 px-2 bg-white py-4 animate-custom-fade-in-right space-y-2 overflow-y-hidden hover:overflow-y-auto mt-[80px]" 
        x-show="isMainPanelLargeOpen"
        tabindex="-1" style="display: none"
        @keydown.escape="window.innerWidth <= 1024 ? isMainPanelLargeOpen = false : ''"
        > 
          <div>
              <a
              href="/encoder/dashboard"
              role="menuitem"
              class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
              {{ request()->is('encoder/dashboard') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
              >
              <img 
                  src="{{ asset('images/dashboard.png') }}" 
                  alt="Dashboard Icon" 
                  class="w-5 h-5"
                  aria-hidden="true"
              />
              <span class="ml-2 text-sm">Dashboard</span>
              </a>
          </div>

          <div>
              <a
              href="/encoder/application-requests"
              role="menuitem"
              class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
              {{ request()->is('encoder/application-requests') || request()->is('encoder/application-requests/view-senior-profile/*') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
              >
              <img 
                  src="{{ asset('images/checklist.png') }}" 
                  alt="Checklist Icon" 
                  class="w-5 h-5"
                  aria-hidden="true"
              />
              <span class="ml-2 text-sm">Application Requests</span>
              </a>
          </div>

          <div>
              <a
              href="/encoder/beneficiaries"
              role="menuitem"
              class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
              {{ request()->is('encoder/beneficiaries') || request()->is('encoder/beneficiaries/view-senior-profile/*') || request()->is('encoder/beneficiaries/add-beneficiary') || request()->is('encoder/beneficiaries/edit-senior-profile/*') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
              >
                <img 
                    src="{{ asset('images/user.png') }}" 
                    alt="Dashboard Icon" 
                    class="w-5 h-5"
                    aria-hidden="true"
                />
                <span class="ml-2 text-sm">Beneficiaries</span>
              </a>
          </div>

          <!-- Dashboards links -->
          <div x-data="{ isActive: false, open: false}">
            <a
              href="#"
              @click="$event.preventDefault(); open = !open"
              :class="{
                'flex items-center p-2 rounded-md transition-colors': true,
                'hover:bg-primary-100 bg-primary-100 text-gray-700': isActive || open || 
                  '{{ request()->is('encoder/pension-distribution-list') }}' === '1' || 
                  '{{ request()->is('encoder/events-list') }}' === '1',
                'text-gray-500': !isActive && !open && 
                  '{{ request()->is('encoder/pension-distribution-list') }}' !== '1' && 
                  '{{ request()->is('encoder/events-list') }}' !== '1'
              }"
              role="button"
              aria-haspopup="true"
              :aria-expanded="(open || isActive) ? 'true' : 'false'"
            >
              <img 
                src="{{ asset('images/marketing.png') }}" 
                alt="User Icon" 
                class="w-5 h-5"
                aria-hidden="true"
              />
              <span class="ml-2 text-sm"> Announcements </span>
              <span class="ml-auto" aria-hidden="true">
                <svg
                  class="w-4 h-4 transition-transform transform"
                  :class="{ 'rotate-180': open }"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right  space-y-2 px-7" aria-label="Dashboards">
              <a
                href="/encoder/pension-distribution-list"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700
                {{ request()->is('encoder/pension-distribution-list') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
              >
                Pension Distribution List
              </a>
              <a
                href="/encoder/events-list"
                role="menuitem"
                class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700 {{ request()->is('encoder/events-list') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
              >
                Events List
              </a>
            </div>
          </div>
        </nav>

        <aside
          x-show="isSidebarOpen"
          x-transition:enter="transition-all transform duration-300 ease-in-out"
          x-transition:enter-start="-translate-x-full opacity-0"
          x-transition:enter-end="translate-x-0 opacity-100"
          x-transition:leave="transition-all transform duration-300 ease-in-out"
          x-transition:leave-start="translate-x-0 opacity-100"
          x-transition:leave-end="-translate-x-full opacity-0"
          x-ref="sidebar"
          @keydown.escape="window.innerWidth <= 1024 ? isSidebarOpen = false : ''"
          tabindex="-1"
          style="display: none"
          class="fixed inset-y-0 z-10 flex flex-shrink-0 bg-white border-r lg:static focus:outline-none"
        >

          <div class="flex flex-col flex-shrink-0 h-full px-2 py-4 border-r">
            <div class="flex-shrink-0">
              <a
                href="/encoder/dashboard"
                class="inline-block text-xl font-bold tracking-wider uppercase"
              >
                <img src="{{ asset('images/osca_image.jfif') }}" alt="Description of image" class="animate-zoom-in inline-block lg: h-[60px] w-[60px] rounded-full object-cover" />
              </a>
            </div>
            <div class="flex flex-col items-center justify-center flex-1 space-y-4">

              <button 
                @click="openMainPanel"
                class="p-2 w-10 h-10 rounded-full text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none focus:ring focus:ring-[#148410] transform hover:scale-105 transition duration-150 ease-in-out"
                >
                <span class="sr-only">Open Main panel</span>
                <img 
                    src="{{ asset('images/pages.png') }}" 
                    alt="Pages Icon" 
                    class="w-5 h-5 mx-auto"
                />
               </button>

                <button
                @click="openSearchPanel"
                class="p-2 w-10 h-10 rounded-full text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none focus:ring focus:ring-[#148410] transform hover:scale-105 transition duration-150 ease-in-out"
                >
                <span class="sr-only">Open search panel</span>
                <svg
                    class="w-5 h-5 mx-auto"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                </svg>
                </button>
            </div>

            <div class="relative flex items-center justify-center flex-shrink-0">
               @auth('encoder')
              <div class="" x-data="{ open: false }">
                <button
                  @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                  type="button"
                  aria-haspopup="true"
                  :aria-expanded="open ? 'true' : 'false'"
                  class="block animate-zoom-in transition-opacity duration-200 rounded-full focus:outline-none focus:ring"
                >
                  <span class="sr-only">User menu</span>
                  @php
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                  @endphp
                  <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white" src="{{ $encoder->encoder_profile_picture ? asset('storage/images/encoder/encoder_thumbnail_profile/'.$encoder->encoder_profile_picture) : $default_profile }}" alt="Profile Picture">
                </button>

                <div
                  x-show="open"
                  x-ref="userMenu"
                  x-transition:enter="transition-all transform ease-out"
                  x-transition:enter-start="-translate-y-1/2 opacity-0"
                  x-transition:enter-end="translate-y-0 opacity-100"
                  x-transition:leave="transition-all transform ease-in"
                  x-transition:leave-start="translate-y-0 opacity-100"
                  x-transition:leave-end="-translate-y-1/2 opacity-0"
                  @click.away="open = false"
                  @keydown.escape="open = false"
                  class="absolute w-56 z-20 py-1 mb-4 bg-white divide-gray-100 rounded-md shadow-lg min-w-max left-5 bottom-full ring-1 ring-black ring-opacity-5 focus:outline-none"
                  tabindex="-1"
                  role="menu"
                  aria-orientation="vertical"
                  aria-label="User menu"
                >
                <div class="block py-2 px-4 animate-custom-fade-in-right text-gray-900 text-sm">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name }}</div>
                <div class="px-4 py-2 text-sm text-gray-900">
                    <div class="font-medium truncate">{{ $encoder->encoder_email }}</div>
                    <div class="font-medium truncate">Encoder ID: {{ $encoder->encoder_id }}</div>
                </div>
                  <a
                    href="/encoder"
                    role="menuitem"
                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 flex items-center"
                  >
                  <img 
                      src="{{ asset('images/home.png') }}" 
                      alt="Home Icon" 
                      class="w-5 h-5"
                      aria-hidden="true"/>
                  <span class="ml-2">Home</span>
                  </a>
                  <a
                    href="/encoder/profile/{{$encoder->id}}"
                    role="menuitem"
                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 flex items-center"
                  >
                  <img 
                      src="{{ asset('images/user-dropdown.png') }}" 
                      alt="Dashboard Icon" 
                      class="w-5 h-5"
                      aria-hidden="true"/>
                  <span class="ml-2">Profile</span>
                  </a>
                  <a
                      role="menuitem"
                      class="block px-4 py-2 text-sm text-gray-700 cursor-pointer transition-colors hover:bg-gray-100"
                  >
                      <form action="/encoder/logout" method="POST">
                          @csrf
                          <button type="submit" class="w-full text-left flex items-center">
                              <img 
                                src="{{ asset('images/logout-dropdown.png') }}" 
                                alt="Dashboard Icon" 
                                class="w-5 h-5"
                                aria-hidden="true"/>
                                <span class="ml-2">Sign out</span>
                          </button>
                      </form>
                  </a>
                </div>
              </div>
            </div>
            @endauth
          </div>
          
          <nav aria-label="Main" class="flex-1 w-64 px-2 py-4 animate-custom-fade-in-right space-y-2 overflow-y-hidden hover:overflow-y-auto" 
          x-show="isMainPanelOpen"
          tabindex="-1" style="display: none"
          @keydown.escape="window.innerWidth <= 1024 ? isMainPanelOpen = false : ''"
          >
            <div class="relative pt-2 pr-2 pb-8">

                <button
                    @click="isMainPanelOpen = false"
                    class="absolute right-0 p-2 text-black rounded-md focus:outline-none focus:ring"
                >
                    <svg
                    class="w-5 h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="black"
                    >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>    
            <div>
                <a
                href="/encoder/dashboard"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
                {{ request()->is('encoder/dashboard') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
                >
                <img 
                    src="{{ asset('images/dashboard.png') }}" 
                    alt="Dashboard Icon" 
                    class="w-5 h-5"
                    aria-hidden="true"
                />
                <span class="ml-2 text-sm">Dashboard</span>
                </a>
            </div>

            <div>
                <a
                href="/encoder/application-requests"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
                {{ request()->is('encoder/application-requests') || request()->is('encoder/application-requests/view-senior-profile/*') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
                >
                <img 
                    src="{{ asset('images/checklist.png') }}" 
                    alt="Checklist Icon" 
                    class="w-5 h-5"
                    aria-hidden="true"
                />
                <span class="ml-2 text-sm">Application Requests</span>
                </a>
            </div>

            <div>
                <a
                href="/encoder/beneficiaries"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100
                {{ request()->is('encoder/beneficiaries') || request()->is('encoder/beneficiaries/view-senior-profile/*') || request()->is('encoder/beneficiaries/add-beneficiary') || request()->is('encoder/beneficiaries/edit-senior-profile/*') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
                >
                  <img 
                      src="{{ asset('images/user.png') }}" 
                      alt="Dashboard Icon" 
                      class="w-5 h-5"
                      aria-hidden="true"
                  />
                  <span class="ml-2 text-sm">Beneficiaries</span>
                </a>
            </div>

            <!-- Dashboards links -->
            <div x-data="{ isActive: false, open: false}">
              <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                :class="{
                  'flex items-center p-2 rounded-md transition-colors': true,
                  'hover:bg-primary-100 bg-primary-100 text-gray-700': isActive || open || 
                    '{{ request()->is('encoder/pension-distribution-list') }}' === '1' || 
                    '{{ request()->is('encoder/events-list') }}' === '1',
                  'text-gray-500': !isActive && !open && 
                    '{{ request()->is('encoder/pension-distribution-list') }}' !== '1' && 
                    '{{ request()->is('encoder/events-list') }}' !== '1'
                }"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
              >
                <img 
                  src="{{ asset('images/marketing.png') }}" 
                  alt="User Icon" 
                  class="w-5 h-5"
                  aria-hidden="true"
                />
                <span class="ml-2 text-sm"> Announcements </span>
                <span class="ml-auto" aria-hidden="true">
                  <svg
                    class="w-4 h-4 transition-transform transform"
                    :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </span>
              </a>
              <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right  space-y-2 px-7" aria-label="Dashboards">
                <a
                  href="/encoder/pension-distribution-list"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700
                  {{ request()->is('encoder/pension-distribution-list') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
                >
                  Pension Distribution List
                </a>
                <a
                  href="/encoder/events-list"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700 {{ request()->is('encoder/events-list') ? 'text-gray-700 bg-primary-100' : 'text-gray-500' }}"
                >
                  Events List
                </a>
              </div>
            </div>
          </nav>
        </aside>

        <div id="draggableButton" class="fixed flex items-center space-x-4 top-4 right-4 lg:hidden cursor-move">
            <button
                @click="!isDragging && (isSidebarOpen = true); $nextTick(() => { $refs.sidebar.focus() })"
                class="p-2 w-10 h-10 rounded-full shadow-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none focus:ring focus:ring-white transform hover:scale-105 transition duration-150 ease-in-out"
            >
                <span class="sr-only">Toggle main menu</span>
                <span aria-hidden="true">
                    <svg
                        x-show="!isSidebarOpen"
                        class="w-6 h-6 mx-auto"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                    <svg
                        x-show="isSidebarOpen"
                        class="w-6 h-6 mx-auto"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </span>
            </button>
        </div>

        <div
          x-transition:enter="transition duration-300 ease-in-out"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition duration-300 ease-in-out"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          x-show="isSearchPanelOpen"
          @click="isSearchPanelOpen = false"
          class="fixed inset-0 z-10 bg-black bg-opacity-75"
          style="opacity: 0.5"
          aria-hidden="ture"
        ></div>

        <section
          x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:enter-start="-translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="-translate-x-full"
          x-show="isSearchPanelOpen"
          style="display: none"
          @keydown.escape="isSearchPanelOpen = false"
          class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl sm:max-w-md focus:outline-none"
        >
          <div class="absolute right-0 p-2 transform translate-x-full">

            <button @click="isSearchPanelOpen = false" class="p-2 text-white rounded-md focus:outline-none focus:ring">
              <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <h2 class="sr-only">Search panel</h2>

          <div class="flex flex-col h-screen">

            <div
              class="relative flex-shrink-0 px-4 py-8 text-gray-400 border-b focus-within:text-gray-700"
            >
              <span class="absolute inset-y-0 inline-flex items-center px-4">
                <svg
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </span>
              <input
                x-ref="searchInput"
                type="text"
                class="w-full py-2 pl-10 pr-4 border rounded-full focus:outline-none focus:ring"
                placeholder="Search..."
              />
            </div>

            <!-- Panel content (Search result) -->
            <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-hidden h hover:overflow-y-auto">
              <h3 class="py-2 text-sm font-semibold text-gray-600">History</h3>
              <p class="px=4">Search resault</p>
              <!--  -->
              <!-- Search content -->
              <!--  -->
            </div>
          </div>
        </section>
      </div>
    </div>

    <script>
      const setup = () => {
        
        return {
          loading: true,
          watchScreen() {
            if (window.innerWidth <= 1024) {
              this.isSidebarOpen = false
              this.isMainPanelLargeOpen = false
              this.isMainUpperPanelLargeOpen = false
            } else if (window.innerWidth >= 1024) {
              this.isSidebarOpen = false
              this.isMainPanelLargeOpen = true
              this.isMainUpperPanelLargeOpen = true
            }
          },
          isSidebarOpen: window.innerWidth >= 1024 ? false : false,
          isMainPanelLargeOpen: window.innerWidth >= 1024 ? true : false,
          isMainUpperPanelLargeOpen: window.innerWidth >= 1024 ? true : false,
          toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
          },
          isMainPanelOpen: false, 
          openMainPanel() {
            this.isMainPanelOpen = true;
          },
          isSearchPanelOpen: false,
          openSearchPanel() {
            this.isSearchPanelOpen = true
            this.$nextTick(() => {
              this.$refs.searchInput.focus()
            })
          },
        }
      }
    </script>

    <script>
        const draggableButton = document.getElementById("draggableButton");
        let isDragging = false;
        let offsetX, offsetY;

        draggableButton.addEventListener("mousedown", function(e) {
            isDragging = true;
            offsetX = e.clientX - draggableButton.getBoundingClientRect().left;
            offsetY = e.clientY - draggableButton.getBoundingClientRect().top;
            document.body.style.userSelect = "none"; 
        });

        document.addEventListener("mousemove", function(e) {
            if (isDragging) {
                draggableButton.style.left = `${e.clientX - offsetX}px`;
                draggableButton.style.top = `${e.clientY - offsetY}px`;
            }
        });

        document.addEventListener("mouseup", function() {
            isDragging = false;
            document.body.style.userSelect = ""; 
        });
    </script>