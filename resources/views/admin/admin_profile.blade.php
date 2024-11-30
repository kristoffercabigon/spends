@include('partials.admin.admin_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-admin_dashboard_nav :data="$array"/>

<section x-data="{ 
        showAdminChangePasswordModal: localStorage.getItem('showAdminChangePasswordModal') === 'true',
        showAdminChangePasswordEmailVerifyModal: localStorage.getItem('showAdminChangePasswordEmailVerifyModal') === 'true',
        showAdminEditProfileModal: localStorage.getItem('showAdminEditProfileModal') === 'true',
        showAdminEditProfilePictureModal: localStorage.getItem('showAdminEditProfilePictureModal') === 'true',
        showAdminVerifyCurrentPasswordModal: localStorage.getItem('showAdminVerifyCurrentPasswordModal') === 'true',
        showAdminCameraModal: false,
        showAdminProfilePicModal: false,
        showAdminPreviewProfilePicModal: false,
        @php
            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$admin->admin_first_name."-".$admin->admin_last_name;
        @endphp
        previewUrl1: '{{ $admin->admin_profile_picture ? asset("storage/images/admin/admin_profile_picture/".$admin->admin_profile_picture) : $default_profile }}',
        previewAdminUrl: '',
        previewAdminImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewAdminUrl = e.target.result;
                    document.getElementById('admin_profile_picture_preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }"
    @open-admin-camera-modal.window="showAdminCameraModal = true; localStorage.setItem('showAdminCameraModal', 'true')"
    @close-admin-camera-modal.window="showAdminCameraModal = false; localStorage.setItem('showAdminCameraModal', 'false')" 
    class="bg-cover bg-center bg-no-repeat min-h-screen" 
    style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    
    <div class="absolute inset-0 rounded-md bg-white mx-4 my-4 lg:ml-[95px] z-10"></div>
    
    <div class="relative flex items-center justify-center font-poppins lg:pl-[80px] z-20">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="text-center md:text-left">
                            Profile
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">
                    <div x-data="{ 
                            @php
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$admin->admin_first_name."-".$admin->admin_last_name;
                            @endphp
                            showAdminRegisteredProfilePicModal: false,
                            previewUrl: '{{ $admin->admin_profile_picture ? asset("storage/images/admin/admin_profile_picture/".$admin->admin_profile_picture) : $default_profile }}'
                        }">
                        <div class="md:flex no-wrap ">
                            <div class="w-full md:w-3/12 md:mx-2">
                                <div class="bg-white p-3 shadow-md border-t-4 border-b-4 rounded-md border-gray-400 lg:mb-12">
                                    <div class="flex items-center justify-center cursor-pointer">
                                        @php
                                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$admin->admin_first_name."-".$admin->admin_last_name;
                                        @endphp

                                        <img class="w-48 h-48 hover:animate-scale rounded-full border-4 border-gray-400"
                                            src="{{ $admin->admin_profile_picture ? asset('storage/images/admin/admin_profile_picture/'.$admin->admin_profile_picture) : $default_profile }}" 
                                            @click="showAdminRegisteredProfilePicModal = true"
                                            alt="Profile Picture">
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <button 
                                            type="button" 
                                            class="hover:scale-105 transition duration-150 ease-in-out p-2 w-8 h-8 rounded-full text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none mt-2 mr-2"
                                            @click.prevent="showAdminEditProfilePictureModal = true; localStorage.setItem('showAdminEditProfilePictureModal', 'true')">
                                            <img src="../../images/pencil.png" alt="Pencil Icon" class="w-4 h-4 mx-auto">
                                        </button>
                                    </div>
                                    <h1 class="text-gray-900 font-bold text-xl mt-2 leading-8 my-1">{{ $admin->admin_first_name }} {{ $admin->admin_last_name }}</h1>
                                    <h3 class="text-gray-600 font-lg text-semibold leading-6">Administrator</span></h3>
                                    <div class="flex items-center justify-center">
                                    <button 
                                        type="button" 
                                        class="hover:scale-105 transition duration-150 ease-in-out py-3 px-4 md:w-auto text-sm cursor-pointer tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none mt-4" 
                                        @click.prevent="showAdminEditProfileModal = true; localStorage.setItem('showAdminEditProfileModal', 'true')"
                                    >
                                       <span class="text-green-500">
                                            <img src="../../images/edit-user.png" alt="Key Icon" class="h-5 inline">
                                        </span> Edit Profile
                                    </button>
                                    </div>
                                    <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                        <li class="flex items-center py-3">
                                            <span>Admin Roles</span>
                                            <div class="flex flex-wrap items-center justify-end my-2 mx-2 gap-2">

                                                    <span class="bg-green-500 py-1 px-2 rounded text-white text-sm">View</span>
                                                    <span class="bg-blue-500 py-1 px-2 rounded text-white text-sm">Create</span>
                                                    <span class="bg-orange-500 py-1 px-2 rounded text-white text-sm">Update</span>
                                                    <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">Delete</span>

                                            </div>
                                        </li>
                                        <li class="flex items-center py-3">
                                            <span>Date Registered</span>
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
                                        <span class="tracking-wide text-white font-light">Admin Information</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm">
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">First Name</div>
                                                <div class="px-4 py-2">{{ $admin->admin_first_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Middle Name</div>
                                                <div class="px-4 py-2">
                                                    @if($admin->admin_middle_name)
                                                        {{ $admin->admin_middle_name }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                                <div class="px-4 py-2">{{ $admin->admin_last_name }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Suffix</div>
                                                <div class="px-4 py-2">
                                                    @if($admin->admin_suffix)
                                                        {{ $admin->admin_suffix }}
                                                    @else
                                                        <em>None</em>
                                                    @endif
                                                </div>
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
                                                <div class="px-4 py-2 break-words">{{ $admin->admin_email }}</div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Password</div>
                                                <div class="px-4 py-2">
                                                    <button 
                                                        type="button" 
                                                        class="hover:scale-105 transition duration-150 ease-in-out py-3 px-4 md:w-auto text-sm cursor-pointer tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none" 
                                                        @click.prevent="showAdminChangePasswordModal = true; localStorage.setItem('showAdminChangePasswordModal', 'true'); localStorage.setItem('adminEmail', '{{ $admin->admin_email }}')"
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
                        @include('components.modal.admin.admin_registered_profilepic_zoom')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="showAdminChangePasswordModal" @click.away="showAdminChangePasswordModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_change_password')
</div>
<div x-show="showAdminChangePasswordEmailVerifyModal" @click.away="showAdminChangePasswordEmailVerifyModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_email_verify_for_change_password')
</div>
<div x-show="showAdminEditProfileModal" @click.away="showAdminEditProfileModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_edit_profile')
</div>
<div x-show="showAdminEditProfilePictureModal" @click.away="showAdminEditProfilePictureModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_edit_profile_picture')
</div>
<div x-show="showAdminCameraModal" @click.away="showAdminCameraModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_camera')
</div>
<div x-show="showAdminProfilePicModal" @click.away="showAdminProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_profilepic_zoom')
</div>
<div x-show="showAdminPreviewProfilePicModal" @click.away="showAdminPreviewProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_preview_profilepic_zoom')
</div>
<div x-show="showAdminVerifyCurrentPasswordModal" @click.away="showAdminVerifyCurrentPasswordModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_verify_current_password')
</div>
</section>

</body>
</html>

