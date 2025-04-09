<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title !== "" ? $title : 'SPENDS System'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    {!!htmlScriptTagJsApi()!!}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body class="bg-white font-poppins min-h-screen pt-[80px]">

    <x-messages.senior_citizen.messages />
    <x-messages.senior_citizen.error_messages />

    <div id="accessibility-toolbar" class="animate-drop-in transition-opacity" style="position: fixed; top: 220px; bottom: 330px; right: 10px; z-index: 9999; background: #fff; padding-top: 10px; padding-left: 2px; padding-right: 2px; padding-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; display: none; flex-direction: column;">
        <button id="increase-font" class="flex items-center justify-center"><img id="increase-font" src="../images/add.png" class="w-4 h-4" alt="Increase Font" style="cursor: pointer;" /></button>
        <button id="decrease-font" class="flex items-center justify-center"><img id="decrease-font" src="../images/minus.png" class="w-4 h-4" alt="Decrease Font" style="cursor: pointer;" /></button>
        <button id="grayscale-toggle" class="flex items-center justify-center"><img id="grayscale-toggle" src="../images/droplet.png" class="w-4 h-4" alt="Grayscale" style="cursor: pointer;" /></button>
        <button id="reset-settings" class="flex items-center justify-center"><img id="reset-settings" src="../images/undo.png" class="w-4 h-4" alt="Reset Settings" style="cursor: pointer;" /></button>
    </div>

    <div id="floating-button" style="position: fixed; top: 170px; right: 10px; z-index: 9999; background-color: #2196F3; width: 50px; height: 50px; color: #fff; border-radius: 5px; display: flex; justify-content: center; align-items: center; cursor: pointer; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
        <img src="../images/accessibility.png" alt="Accessibility" class="h-10 w-10">
    </div>

    <style>
        body.grayscale {
            filter: grayscale(100%);
        }

        #accessibility-toolbar {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background: #fff;
            width: 50px; 
            height: 160px; 
            padding: 5px 2px; 
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }

        #floating-button {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background-color: #2196F3;
            width: 50px;
            height: 50px;
            color: #fff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        #accessibility-toolbar button {
            margin: 5px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            background-color: #2196F3;
            color: #fff;
            border: none;
            border-radius: 3px;
        }

        #accessibility-toolbar button:hover {
            background-color: #1E88E5;
        }

        #floating-button:hover {
            background-color: #1E88E5;
        }

        #accessibility-toolbar img, 
        #floating-button img {
            width: 16px !important;  
            height: 16px !important; 
        }

        #floating-button img {
            width: 40px !important;
            height: 40px !important;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            const accessibilityToolbar = document.getElementById("accessibility-toolbar");
            const floatingButton = document.getElementById("floating-button");
            const circles = document.getElementById("circles");
            let fontSize = localStorage.getItem("fontSize") ? parseInt(localStorage.getItem("fontSize")) : 16;
            let isGrayscale = localStorage.getItem("grayscale") === "true";

            function applyFontSize() {
                document.documentElement.style.fontSize = fontSize + "px";
            }

            function applyGrayscale() {
                const screenWidth = window.innerWidth;

                if (isGrayscale) {
                    body.classList.add("grayscale");

                    if (screenWidth <= 1024) {
                        accessibilityToolbar.style.bottom = "830px";
                    } else {
                        accessibilityToolbar.style.bottom = "720px";
                    }

                    if (circles) {
                        circles.style.display = "none";
                    }
                } else {
                    body.classList.remove("grayscale");

                    if (screenWidth <= 1024) { 
                        accessibilityToolbar.style.bottom = "280px";
                    } else {
                        accessibilityToolbar.style.bottom = "330px";
                    }

                    if (circles) {
                        circles.style.display = "block";
                    }
                }
            }

            window.addEventListener("resize", applyGrayscale);

            applyFontSize();
            applyGrayscale();

            floatingButton.addEventListener("click", function () {
                accessibilityToolbar.style.display = accessibilityToolbar.style.display === "none" ? "flex" : "none";
            });

            document.getElementById("increase-font").addEventListener("click", function () {
                fontSize += 2;
                localStorage.setItem("fontSize", fontSize);
                applyFontSize();
            });

            document.getElementById("decrease-font").addEventListener("click", function () {
                if (fontSize > 10) {
                    fontSize -= 2;
                    localStorage.setItem("fontSize", fontSize);
                    applyFontSize();
                }
            });

            document.getElementById("grayscale-toggle").addEventListener("click", function () {
                isGrayscale = !isGrayscale;
                localStorage.setItem("grayscale", isGrayscale);
                applyGrayscale();
            });

            document.getElementById("reset-settings").addEventListener("click", function () {
                localStorage.removeItem("fontSize");
                localStorage.removeItem("grayscale");
                location.reload();
            });
        });
    </script>

@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section x-data="{ showChangePasswordModal: localStorage.getItem('showChangePasswordModal') === 'true',
                 showChangePasswordModal: localStorage.getItem('showChangePasswordModal') === 'true',
                 showChangePasswordEmailVerifyModal: localStorage.getItem('showChangePasswordEmailVerifyModal') === 'true' }"
                class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <ul id="circles" class="circles ">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="min-h-screen relative flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 mb-16 shadow-lg rounded-md">              
                <div class="mb-16 mt-5 p-5 px-6 py-10 lg:px-12">
                    <div class="text-2xl font-bold mb-6 leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="mx-4 text-center">
                            Profile
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">
                    <div x-data="{ 
                            @php
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                            @endphp
                            showRegisteredProfilePicModal: false,
                            previewUrl: '{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}'
                        }">
                        <div class="md:flex no-wrap ">
                            <div class="w-full md:w-3/12 md:mx-2">
                                <div class="bg-white p-3 shadow-lg border-t-4 border-b-4 rounded-md 
                                    {{ $account_status && $account_status->senior_account_status == 'Active' ? 'border-green-500' : 
                                    ($account_status && $account_status->senior_account_status == 'Inactive' ? 'border-gray-500' : 'border-gray-500') }}">
                                    <div class="flex items-center hover:animate-scale cursor-pointer justify-center image overflow-hidden"
                                        @click="showRegisteredProfilePicModal = true">
                                        @php
                                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                                        @endphp
                                        <img class="w-48 h-48 rounded-full border-4 
                                            {{ $account_status && $account_status->senior_account_status == 'Active' ? 'border-green-500' : 
                                            ($account_status && $account_status->senior_account_status == 'Inactive' ? 'border-gray-500' : 'border-gray-500') }}"
                                            src="{{ $senior->profile_picture ? asset('storage/images/senior_citizen/profile_picture/'.$senior->profile_picture) : $default_profile }}"
                                            alt="">
                                    </div>
                                    <h1 class="text-gray-900 font-bold text-xl mt-4 leading-8 my-1">{{ $senior->first_name }} {{ $senior->last_name }}</h1>
                                    <h3 class="text-gray-600 font-lg text-semibold leading-6">OSCA ID: <span class="font-semibold">{{ $senior->osca_id }}</span></h3>
                                    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                        <li class="flex items-center py-3">
                                            <span>Account Status</span>
                                            <span class="ml-auto">
                                                <div class="relative inline-block text-left">
                                                    <span 
                                                        class="py-1 px-2 rounded text-white text-sm truncate w-32 text-center 
                                                        {{ $account_status && $account_status->senior_account_status == 'Active' ? 'bg-green-500' : 
                                                        ($account_status && $account_status->senior_account_status == 'Inactive' ? 'bg-gray-500' : 'bg-gray-500') }} "
                                                        id="accountStatusDropdownButton">
                                                        {{ $account_status ? ucfirst($account_status->senior_account_status) : '--' }}
                                                    </span>
                                                    <div 
                                                        class="absolute right-0 mt-2 w-48 animate-drop-in bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden"
                                                        id="accountStatusDropdownMenu">
                                                        
                                                    </div>
                                                </div>
                                            </span>
                                        </li>
                                        <li class="flex items-center py-3">
                                            <span>Application Status</span>
                                            <span class="ml-auto">
                                                <div class="relative inline-block text-left">
                                                    <span 
                                                        class="py-1 px-2 rounded text-white text-sm truncate w-32 text-center 
                                                        {{ $application_status && $application_status->senior_application_status == 'Under Evaluation' ? 'bg-gray-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'On Hold' ? 'bg-orange-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'Approved' ? 'bg-green-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'Rejected' ? 'bg-red-500' : 'bg-gray-500'))) }} "
                                                        id="statusDropdownButton">
                                                        {{ $application_status ? ucfirst($application_status->senior_application_status) : '--' }}
                                                    </span>
                                                    <div 
                                                        class="absolute right-0 mt-2 w-48 animate-drop-in bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden"
                                                        id="statusDropdownMenu">
                                                        
                                                    </div>
                                                </div>
                                            </span>
                                        </li>

                                        @if ($senior->account_status_id)
                                            <li class="flex items-center py-3">
                                                <span>Date Approved</span>
                                                <span class="ml-auto">
                                                    @if ($senior->date_approved)
                                                        {{ \Carbon\Carbon::parse($senior->date_approved)->format('F j, Y') }}
                                                    @else
                                                        Not yet approved.
                                                    @endif
                                                </span>
                                            </li>
                                        @endif
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

