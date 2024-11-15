@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section x-data="{ showChangePasswordModal: localStorage.getItem('showChangePasswordModal') === 'true',
                 showChangePasswordModal: localStorage.getItem('showChangePasswordModal') === 'true',
                 showChangePasswordEmailVerifyModal: localStorage.getItem('showChangePasswordEmailVerifyModal') === 'true' }"
                class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <div class="min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 mb-16 shadow-lg rounded-md">              
                <div class="mb-16 mt-5 p-5 px-6 py-10 lg:px-12">
                    <div class="text-2xl font-bold mb-6 leading-tight tracking-tight text-gray-900 md:text-4xl">
                        <p class="mx-4 text-center">
                            Profile
                        </p>
                    </div>

                    <hr style="height: 1.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 32px; margin-bottom: 32px;">
                    <div x-data="{ 
                            @php
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                            @endphp
                            showRegisteredProfilePicModal: false,
                            previewUrl: '{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}'
                        }">
                        <div class="md:flex no-wrap ">
                            <div class="w-full md:w-3/12 md:mx-2">
                                <div class="bg-white p-3 shadow-md border-t-4 border-b-4 rounded-md border-green-400">
                                    <div class="flex items-center cursor-pointer justify-center image overflow-hidden"
                                        @click="showRegisteredProfilePicModal = true">
                                        @php
                                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                                        @endphp
                                        <img class="w-48 h-48 hover:animate-scale rounded-full border-4 border-green-400"
                                            src="{{ $senior->profile_picture ? asset('storage/images/senior_citizen/profile_picture/'.$senior->profile_picture) : $default_profile }}"
                                            alt="">
                                    </div>
                                    <h1 class="text-gray-900 font-bold text-xl mt-4 leading-8 my-1">{{ $senior->first_name }} {{ $senior->last_name }}</h1>
                                    <h3 class="text-gray-600 font-lg text-semibold leading-6">OSCA ID: <span class="font-semibold">{{ $senior->osca_id }}</span></h3>
                                    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                        <li class="flex items-center py-3">
                                            <span>Status</span>
                                            <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                                        </li>
                                        <li class="flex items-center py-3">
                                            <span>Date Approved</span>
                                            <span class="ml-auto">Nov 07, 2024</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="my-4 mx-2"></div>

                            <div class="w-full md:w-9/12">
                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke="white">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide text-white font-light">Basic Information</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">First Name</div>
                                                <div class="px-4 py-2">{{ $senior->first_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Middle Name</div>
                                                <div class="px-4 py-2">
                                                    @if($senior->middle_name)
                                                        {{ $senior->middle_name }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                                <div class="px-4 py-2">{{ $senior->last_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Suffix</div>
                                                <div class="px-4 py-2">
                                                    @if($senior->suffix)
                                                        {{ $senior->suffix }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Birthdate</div>
                                                <div class="px-4 py-2">{{ \Carbon\Carbon::parse($senior->birthdate)->format('F j, Y') }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Age</div>
                                                <div class="px-4 py-2">{{ $senior->age }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Birthplace</div>
                                                <div class="px-4 py-2">{{ $senior->birthplace }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Sex</div>
                                                <div class="px-4 py-2">
                                                    @php
                                                        $sex = $sex->firstWhere('id', $senior->sex_id);
                                                    @endphp

                                                    {{ $sex->sex ?? 'Unknown' }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Civil Status</div>
                                                <div class="px-4 py-2">
                                                    @php
                                                        $civil_status = $civil_status->firstWhere('id', $senior->civil_status_id);
                                                    @endphp

                                                    {{ $civil_status->civil_status ?? 'Unknown' }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Address</div>
                                                <div class="px-4 py-2">{{ $senior->address }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Barangay</div>
                                                <div class="px-4 py-2">
                                                    @php
                                                        $barangay = $barangay->firstWhere('id', $senior->barangay_id);
                                                    @endphp

                                                    {{ $barangay->barangay_no ?? 'Unknown' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../images/key.png" alt="Key Icon" class="h-5 inline">
                                        </span>                             
                                    <span class="tracking-wide text-white font-light">Account Information</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm gap-4">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Email</div>
                                                <div class="px-4 py-2 break-words">{{ $senior->email }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Contact Number</div>
                                                <div class="px-4 py-2">{{ $senior->contact_no }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Date Applied</div>
                                                <div class="px-4 py-2">{{ \Carbon\Carbon::parse($senior->date_applied)->format('F j, Y') }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Password</div>
                                                <div class="px-4 py-2">
                                                    <button 
                                                        type="button" 
                                                        class="hover:scale-105 transition duration-150 ease-in-out py-3 px-4 md:w-auto text-sm cursor-pointer tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none" 
                                                        @click.prevent="showChangePasswordModal = true; localStorage.setItem('showChangePasswordModal', 'true'); localStorage.setItem('seniorEmail', '{{ $senior->email }}')"
                                                    >
                                                        Change Password
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('components.modal.senior_citizen.registered_profilepic_zoom')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="showChangePasswordModal" @click.away="showChangePasswordModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.senior_citizen.change_password')
</div>
<div x-show="showChangePasswordEmailVerifyModal" @click.away="showChangePasswordEmailVerifyModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.senior_citizen.email_verify_for_change_password')
</div>
</section>

@include('partials.senior_citizen.footer')

