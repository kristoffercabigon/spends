@include('partials.encoder.encoder_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_dashboard_nav :data="$array"/>

<section x-data="{ 
        showEncoderChangePasswordModal: localStorage.getItem('showEncoderChangePasswordModal') === 'true',
        showEncoderChangePasswordEmailVerifyModal: localStorage.getItem('showEncoderChangePasswordEmailVerifyModal') === 'true',
        showEncoderEditProfileModal: localStorage.getItem('showEncoderEditProfileModal') === 'true',
        showEncoderEditProfilePictureModal: localStorage.getItem('showEncoderEditProfilePictureModal') === 'true',
        showEncoderVerifyCurrentPasswordModal: localStorage.getItem('showEncoderVerifyCurrentPasswordModal') === 'true',
        showEncoderCameraModal: false,
        showEncoderProfilePicModal: false,
        showEncoderPreviewProfilePicModal: false,
        @php
            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
        @endphp
        previewUrl1: '{{ $encoder->encoder_profile_picture ? asset("storage/images/encoder/encoder_profile_picture/".$encoder->encoder_profile_picture) : $default_profile }}',
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
    class="bg-cover bg-center bg-no-repeat min-h-screen" 
    style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">

    <ul class="circles">
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
    
    <div class="absolute inset-0 rounded-md bg-white mx-4 my-4 lg:ml-[95px] z-10"></div>
    
    <div class="relative flex items-center justify-center font-poppins lg:pl-[80px] z-20">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 mb-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="text-center md:text-left">
                            Profile
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">
                    <div x-data="{ 
                            @php
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                            @endphp
                            showEncoderRegisteredProfilePicModal: false,
                            previewUrl: '{{ $encoder->encoder_profile_picture ? asset("storage/images/encoder/encoder_profile_picture/".$encoder->encoder_profile_picture) : $default_profile }}'
                        }">
                        <div class="md:flex no-wrap ">
                            <div class="w-full md:w-3/12 md:mx-2">
                                <div class="bg-white p-3 shadow-md border-t-4 border-b-4 rounded-md border-gray-400 lg:mb-12">
                                    <div class=" flex items-center justify-center cursor-pointer">
                                        @php
                                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                                        @endphp

                                        <img class="w-48 h-48 hover:animate-scale rounded-full border-4 border-gray-400"
                                            src="{{ $encoder->encoder_profile_picture ? asset('storage/images/encoder/encoder_profile_picture/'.$encoder->encoder_profile_picture) : $default_profile }}" 
                                            @click="showEncoderRegisteredProfilePicModal = true"
                                            alt="Profile Picture">
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <button 
                                            type="button" 
                                            class="hover:scale-105 transition duration-150 ease-in-out p-2 w-8 h-8 rounded-full text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none mt-2 mr-2"
                                            @click.prevent="showEncoderEditProfilePictureModal = true; localStorage.setItem('showEncoderEditProfilePictureModal', 'true')">
                                            <img src="../../images/pencil.png" alt="Pencil Icon" class="w-4 h-4 mx-auto">
                                        </button>
                                    </div>
                                    <h1 class="text-gray-900 font-bold text-xl mt-2 leading-8 my-1">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name }}</h1>
                                    <h3 class="text-gray-600 font-lg text-semibold leading-6">Encoder ID: <span class="font-semibold">{{ $encoder->encoder_id }}</span></h3>
                                    <div class="flex items-center justify-center">
                                    <button 
                                        type="button" 
                                        class="hover:scale-105 transition duration-150 ease-in-out py-3 px-4 md:w-auto text-sm cursor-pointer tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none mt-4" 
                                        @click.prevent="showEncoderEditProfileModal = true; localStorage.setItem('showEncoderEditProfileModal', 'true')"
                                    >
                                       <span class="text-green-500">
                                            <img src="../../images/edit-user.png" alt="Key Icon" class="h-5 inline">
                                        </span> Edit Profile
                                    </button>
                                    </div>
                                    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                        <li class="flex items-center py-3">
                                            <span>Encoder Roles</span>
                                            <div class="flex flex-wrap items-center justify-center my-2 mx-2 gap-2">
                                                @foreach ($categories as $category)
                                                    @if (!empty($roles[$category]))
                                                        <div class="relative group">
                                                            <span class="cursor-pointer bg-{{ $categoryColors[$category] }} py-1 px-2 rounded text-white text-sm">
                                                                {{ ucfirst($category) }}
                                                            </span>
                                                            <div class="hidden group-hover:block absolute z-10 bg-white border border-gray-200 shadow-lg rounded-md p-2 w-max">
                                                                <ul class="text-sm text-gray-700">
                                                                    @foreach ($roles[$category] as $role)
                                                                        <li class="list-disc ml-4">{{ $role }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                        <li class="flex items-center py-3">
                                            <span>Date Registered</span>
                                            <span class="ml-auto">
                                                {{ \Carbon\Carbon::parse($encoder->encoder_date_registered)->format('F j, Y') }}
                                            </span>
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
                                        <span class="tracking-wide text-white font-light">Encoder Information</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">First Name</div>
                                                <div class="px-4 py-2">{{ $encoder->encoder_first_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Middle Name</div>
                                                <div class="px-4 py-2">
                                                    @if($encoder->encoder_middle_name)
                                                        {{ $encoder->encoder_middle_name }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                                <div class="px-4 py-2">{{ $encoder->encoder_last_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Suffix</div>
                                                <div class="px-4 py-2">
                                                    @if($encoder->encoder_suffix)
                                                        {{ $encoder->encoder_suffix }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Address</div>
                                                <div class="px-4 py-2">{{ $encoder->encoder_address }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Address</div>
                                                <div class="px-4 py-2">{{ $encoder->barangay_no }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/key.png" alt="Key Icon" class="h-5 inline">
                                        </span>                             
                                    <span class="tracking-wide text-white font-light">Account Information</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm gap-4">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Email</div>
                                                <div class="px-4 py-2 break-words">{{ $encoder->encoder_email }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Password</div>
                                                <div class="px-4 py-2">
                                                    <button 
                                                        type="button" 
                                                        class="hover:scale-105 transition duration-150 ease-in-out py-3 px-4 md:w-auto text-sm cursor-pointer tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none" 
                                                        @click.prevent="showEncoderChangePasswordModal = true; localStorage.setItem('showEncoderChangePasswordModal', 'true'); localStorage.setItem('encoderEmail', '{{ $encoder->encoder_email }}')"
                                                    >
                                                        Change Password
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Contact Number</div>
                                                <div class="px-4 py-2 break-words">{{ $encoder->encoder_contact_no }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('components.modal.encoder.encoder_registered_profilepic_zoom')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="showEncoderChangePasswordModal" @click.away="showEncoderChangePasswordModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_change_password')
</div>
<div x-show="showEncoderChangePasswordEmailVerifyModal" @click.away="showEncoderChangePasswordEmailVerifyModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_email_verify_for_change_password')
</div>
<div x-show="showEncoderEditProfileModal" @click.away="showEncoderEditProfileModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_edit_profile')
</div>
<div x-show="showEncoderEditProfilePictureModal" @click.away="showEncoderEditProfilePictureModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_edit_profile_picture')
</div>
<div x-show="showEncoderCameraModal" @click.away="showEncoderCameraModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_camera')
</div>
<div x-show="showEncoderProfilePicModal" @click.away="showEncoderProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_profilepic_zoom')
</div>
<div x-show="showEncoderPreviewProfilePicModal" @click.away="showEncoderPreviewProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_preview_profilepic_zoom')
</div>
<div x-show="showEncoderVerifyCurrentPasswordModal" @click.away="showEncoderVerifyCurrentPasswordModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_verify_current_password')
</div>
</section>

</body>
</html>

