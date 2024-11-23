@php
    $admin = session('admin'); 
@endphp

    <div
      x-data="setup()"
      x-init="$refs.loading.classList.add('hidden'); "
      @resize.window="watchScreen()"
    >
      <div class="flex fixed top-0 left-0 z-50 h-screen antialiased text-gray-900">

        <div
          x-ref="loading"
          class="fixed h-screen inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-black bg-opacity-75"
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
          class="fixed inset-y-0 z-10 flex flex-shrink-0 bg-white border-r lg:static focus:outline-none"
        >

          <div class="flex flex-col flex-shrink-0 h-full px-2 py-4 border-r">
            <div class="flex-shrink-0">
              <a
                href="/admin/dashboard"
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

                <button
                @click="openSettingsPanel"
                class="p-2 w-10 h-10 rounded-full text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none focus:ring focus:ring-[#148410] transform hover:scale-105 transition duration-150 ease-in-out"
                >
                <span class="sr-only">Open settings panel</span>
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
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                    />
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    />
                </svg>
                </button>
            </div>

            <div class="relative flex items-center justify-center flex-shrink-0">
               @auth('admin')
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
                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$admin->admin_first_name."-".$admin->admin_last_name;
                  @endphp
                  <img id="avatarButton" class="animate-zoom-in w-10 h-10 rounded-full ring-2 ring-white" src="{{ $admin->admin_profile_picture ? asset('storage/images/admin/admin_thumbnail_profile/'.$admin->admin_profile_picture) : $default_profile }}" alt="Profile Picture">
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
                <div class="block py-2 px-4 animate-custom-fade-in-right text-gray-900 text-sm">{{ $admin->admin_first_name }} {{ $admin->admin_last_name }}</div>
                <div class="px-4 py-2 text-sm text-gray-900">
                            <div class="font-medium truncate">{{ $admin->admin_email }}</div>
                            <div class="font-medium truncate">Administrator</div>
                        </div>
                  <a
                    href="/admin/profile/{{$admin->id}}"
                    role="menuitem"
                    class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100"
                  >
                    Profile
                  <a
                      role="menuitem"
                      class="block px-4 py-2 text-sm text-gray-700 cursor-pointer transition-colors hover:bg-gray-100"
                  >
                      <form action="/admin/logout" method="POST">
                          @csrf
                          <button type="submit" class="w-full text-left">
                              Sign out
                          </button>
                      </form>
                  </a>
                </div>
              </div>
            </div>
            @endauth
          </div>
          
          <nav aria-label="Main" class="flex-1 animate-custom-fade-in-right w-64 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto" 
          x-show="isMainPanelOpen"
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
                href="/admin/dashboard"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100"
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
                href="/admin/application-requests"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100"
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
                href="/admin/activity-log"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100"
                >
                  <img 
                      src="{{ asset('images/activity_log.png') }}" 
                      alt="Dashboard Icon" 
                      class="w-5 h-5"
                      aria-hidden="true"
                  />
                  <span class="ml-2 text-sm">Activity Log</span>
                </a>
            </div>

            <div>
                <a
                href="/admin/sign-in-history"
                role="menuitem"
                class="flex items-center p-2 mb-2 text-gray-500 transition-colors duration-200 rounded-md hover:text-gray-700 hover:bg-primary-100"
                >
                  <img 
                      src="{{ asset('images/sign_in_log.png') }}" 
                      alt="Dashboard Icon" 
                      class="w-5 h-5"
                      aria-hidden="true"
                  />
                  <span class="ml-2 text-sm">Sign In History</span>
                </a>
            </div>

            <div x-data="{ isActive: false, open: false}">
              <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md hover:bg-primary-100"
                :class="{'bg-primary-100': isActive || open}"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
              >
              <img 
                  src="{{ asset('images/user.png') }}" 
                  alt="User Icon" 
                  class="w-5 h-5"
                  aria-hidden="true"
              />
                <span class="ml-2 text-sm">Beneficiaries</span>
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
              <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right space-y-2 px-7" aria-label="Dashboards">
                <a
                  href="/admin/beneficiaries"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Beneficiaries List
                </a>
                <a
                  href="/admin/add-beneficiary"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Add Beneficiary
                </a>
              </div>
            </div>

            <div x-data="{ isActive: false, open: false}">
              <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md hover:bg-primary-100"
                :class="{'bg-primary-100': isActive || open}"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
              >
              <img 
                  src="{{ asset('images/user.png') }}" 
                  alt="User Icon" 
                  class="w-5 h-5"
                  aria-hidden="true"
              />
                <span class="ml-2 text-sm">Encoders</span>
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
              <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right space-y-2 px-7" aria-label="Dashboards">
                <a
                  href="/admin/encoders"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Encoders List
                </a>
                <a
                  href="/admin/add-encoder"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Add Encoder
                </a>
              </div>
            </div>
            
            <!-- Dashboards links -->
            <div x-data="{ isActive: false, open: false}">
              <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md hover:bg-primary-100"
                :class="{'bg-primary-100': isActive || open}"
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
              <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right space-y-2 px-7" aria-label="Dashboards">
                <a
                  href="/admin/pension-distribution-list"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Pension Distribution List
                </a>
                <a
                  href="/admin/add-pension-distribution"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Add Pension Distribution Program
                </a>
                <a
                  href="/admin/events"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Events List
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Add Event
                </a>
              </div>
            </div>

            <div x-data="{ isActive: false, open: false}">
              <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md hover:bg-primary-100"
                :class="{'bg-primary-100': isActive || open}"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
              >
                <img 
                    src="{{ asset('images/data-management.png') }}" 
                    alt="User Icon" 
                    class="w-5 h-5"
                    aria-hidden="true"
                />
                <span class="ml-2 text-sm"> Data Management </span>
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
              <div role="menu" x-show="open" class="mt-2 animate-custom-fade-in-right space-y-2 px-7" aria-label="Dashboards">
                <a
                  href="/admin/pension-distribution-list"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  User Type
                </a>
                <a
                  href="/admin/pension-distribution-list"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Application Status
                </a>
                <a
                  href="/admin/add-pension-distribution"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Account Status
                </a>
                <a
                  href="/admin/events"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                  Encoder Roles
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Barangay
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Sex
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Civil Status
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Living Arrangement
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Pension Amount
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Pension Source
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Income Amount
                </a>
                <a
                  href="/admin/add-event"
                  role="menuitem"
                  class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md hover:text-gray-700"
                >
                 Income Source
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
          x-show="isSettingsPanelOpen"
          @click="isSettingsPanelOpen = false"
          class="fixed inset-0 z-10 bg-black bg-opacity-75"
          style="opacity: 0.5"
          aria-hidden="true"
        ></div>

        <section
          x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:enter-start="translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="translate-x-full"
          x-ref="settingsPanel"
          tabindex="-1"
          x-show="isSettingsPanelOpen"
          @keydown.escape="isSettingsPanelOpen = false"
          class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl sm:max-w-md focus:outline-none"
          aria-labelledby="settinsPanelLabel"
        >
          <div class="absolute left-0 p-2 transform -translate-x-full">

            <button
              @click="isSettingsPanelOpen = false"
              class="p-2 text-white rounded-md focus:outline-none focus:ring"
            >
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

          <div class="flex flex-col h-screen">

            <div
              class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b "
            >
              <span aria-hidden="true" class="text-gray-500">
                <svg
                  class="w-8 h-8"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                  />
                </svg>
              </span>
              <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500">Settings</h2>
            </div>
            <!-- Content of Settings Panel -->
            <div class="flex-1 overflow-hidden hover:overflow-y-auto">

              
              
            </div>
          </div>
        </section>

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
            } else if (window.innerWidth >= 1024) {
              this.isSidebarOpen = true
            }
          },
          isSidebarOpen: window.innerWidth >= 1024 ? true : false,
          toggleSidbarMenu() {
            this.isSidebarOpen = !this.isSidebarOpen
          },
          isMainPanelOpen: false, 
          openMainPanel() {
            this.isMainPanelOpen = true;
          },
          isSettingsPanelOpen: false,
          openSettingsPanel() {
            this.isSettingsPanelOpen = true
            this.$nextTick(() => {
              this.$refs.settingsPanel.focus()
            })
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