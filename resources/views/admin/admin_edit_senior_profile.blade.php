@include('partials.admin.admin_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-admin_dashboard_nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
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
    
    <div class="relative flex items-center justify-center font-poppins lg:mt-[80px] lg:pl-[255px]">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mb-4 mt-4 ml-4 mr-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <form id="form" action="{{ route('admin-submit-edit-beneficiary', ['senior' => $senior->id]) }}" enctype="multipart/form-data" method="POST" class="w-full bg-white rounded-md">
                    @method('PUT')
                    @csrf

                        <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            <p class="text-center">
                                Edit Beneficiary
                            </p>
                        </div>

                        <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                        <div class="text-xl font-bold mt-8 mb-6 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Basic Information
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('first_name') text-red-700 
                                    @else text-gray-800 @enderror">
                                    First Name
                                </label>
                                <input name="first_name" id="first_name" type="text" value="{{ $senior->first_name }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('first_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter first name" />
                                @error('first_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('middle_name') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Middle Name
                                </label>
                                <input name="middle_name" id="middle_name" type="text" value="{{ $senior->middle_name ?? '' }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('middle_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter middle name" />
                                @error('middle_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('last_name') text-red-700
                                    @else text-gray-800 @enderror">
                                    Last Name
                                </label>
                                <input name="last_name" id="last_name" type="text" value="{{ $senior->last_name }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('last_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter last name" />
                                @error('last_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('suffix') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Suffix
                                </label>
                                <input name="suffix" id="suffix" type="text" value="{{ $senior->suffix ?? '' }}"
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('suffix') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter suffix (e.g., Jr., Sr., III)" />
                                @error('suffix')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('birthdate') text-red-700
                                    @else text-gray-800 @enderror">
                                    Birthdate
                                </label>
                                <input name="birthdate" type="text" id="datepicker" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md cursor-pointer transition-all 
                                    @error('birthdate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Select birthdate" readonly 
                                    value="{{ $senior->birthdate }}" />
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none @error('birthdate') h-[90%] @else h-[125%] @enderror">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 6h6m-8 0h.01M4 7h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                                    </svg>
                                </span>
                                @error('birthdate')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @if($errors->has('age') || (old('age') && old('age') < 60)) 
                                        text-red-700 
                                    @else 
                                        text-gray-800 
                                    @endif">
                                    Age
                                </label>

                                <input name="age" type="text" id="age" value="{{ $senior->age }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                    @if($errors->has('age') || (old('age') && old('age') < 60)) 
                                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                    @else 
                                        bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 
                                    @endif" 
                                    placeholder="Age" readonly />

                                @if($errors->has('age') || (old('age') && old('age') < 60))
                                    <p class="text-red-500 text-xs mt-2 p-1">The age must be 60 years old or above.</p>
                                @endif
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('birthplace') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Birthplace
                                </label>
                                <input name="birthplace" type="text" value="{{ $senior->birthplace }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                    @error('birthplace') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter place of birth" />
                                @error('birthplace')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('sex_id') text-red-700
                                    @else text-gray-800 @enderror">
                                    Sex
                                </label>
                                <select name="sex_id" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('sex_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled>Select sex</option>
                                    @foreach($sexes as $sex)
                                        <option value="{{ $sex->id }}" 
                                            {{ old('sex_id', $senior->sex_id) == $sex->id ? 'selected' : '' }}>
                                            {{ $sex->sex }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sex_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('civil_status_id') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Civil Status
                                </label>
                                <select name="civil_status_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('civil_status_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled {{ !$senior->civil_status_id && !old('civil_status_id') ? 'selected' : '' }}>Select civil status</option>
                                    @foreach($civil_status_list as $civil_status1) 
                                        <option value="{{ $civil_status1->id }}" 
                                            {{ old('civil_status_id', $senior->civil_status_id) == $civil_status1->id ? 'selected' : '' }}>
                                            {{ $civil_status1->civil_status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('civil_status_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('contact_no') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Contact Number
                                </label>

                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                        +63
                                    </span>
                                    
                                    <input name="contact_no" type="text" value="{{ Str::replaceFirst('+63', '', $senior->contact_no) }}"
                                        class="w-full text-sm px-4 py-3 rounded-r-md transition-all pr-10 
                                        @error('contact_no') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                        @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                        placeholder="Enter contact number (10 digits)" 
                                        inputmode="numeric" pattern="[0-9]*" maxlength="10" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>

                                @error('contact_no')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="md:col-span-3 relative">
                                <label class="text-sm mb-2 block 
                                    @error('address') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Home Address
                                </label>
                                <input name="address" type="text" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('address') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter address" value="{{ $senior->address }}" />
                                <span id="tooltip-icon" class="absolute top-[28px] right-0 flex items-center justify-center bg-gray-400 hover:bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-12 cursor-pointer @error('address') h-[44%] @else h-[63%] @enderror group">
                                    <svg fill="#ffffff" class="w-7 h-7 hover:animate-jiggle" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 416.979 416.979" xml:space="preserve" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <path d="M356.004,61.156c-81.37-81.47-213.377-81.551-294.848-0.182c-81.47,81.371-81.552,213.379-0.181,294.85
                                                c81.369,81.47,213.378,81.551,294.849,0.181C437.293,274.636,437.375,142.626,356.004,61.156z M237.6,340.786
                                                c0,3.217-2.607,5.822-5.822,5.822h-46.576c-3.215,0-5.822-2.605-5.822-5.822V167.885c0-3.217,2.607-5.822,5.822-5.822h46.576
                                                c3.215,0,5.822,2.604,5.822,5.822V340.786z M208.49,137.901c-18.618,0-33.766-15.146-33.766-33.765
                                                c0-18.617,15.147-33.766,33.766-33.766c18.619,0,33.766,15.148,33.766,33.766C242.256,122.755,227.107,137.901,208.49,137.901z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>

                                    <div id="tooltip-text" class="absolute top-full right-0 mt-2 w-48 p-2 text-sm text-white bg-customOrange rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                        Enter your full home address. (House No., Street, Barangay, City/Municipality, Province)
                                    </div>
                                </span>

                                @error('address')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('barangay_id') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Barangay
                                </label>
                                <select name="barangay_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('barangay_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled {{ !$senior->barangay_id && !old('barangay_id') ? 'selected' : '' }}>
                                        Select barangay
                                    </option>
                                    @foreach($barangay as $barangay1)
                                        <option value="{{ $barangay1->id }}" 
                                            {{ old('barangay_id', $senior->barangay_id) == $barangay1->id ? 'selected' : '' }}>
                                            {{ $barangay1->barangay_no }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barangay_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="relative md:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('type_of_living_arrangement') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Living Arrangement
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    @foreach($arrangement_lists as $arrangement)
                                        <div class="flex items-center mb-2 md:mr-4"> 
                                            <input type="radio" 
                                                name="type_of_living_arrangement" 
                                                value="{{ $arrangement->id }}" 
                                                id="living_arrangement_{{ $arrangement->id }}" 
                                                class="mr-2 shadow-md" 
                                                {{ old('type_of_living_arrangement', $senior->type_of_living_arrangement) == $arrangement->id ? 'checked' : '' }}
                                                onclick="toggleInputField({{ $arrangement->id }}, 'livingArrangement')">

                                            <label for="living_arrangement_{{ $arrangement->id }}" 
                                                class="text-sm text-gray-800 @error('type_of_living_arrangement') text-red-700  @enderror">
                                                {{ $arrangement->type_of_living_arrangement_list }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                @php
                                    $lastArrangementId = $arrangement_lists->last()->id;
                                @endphp

                                <input type="text" 
                                    name="other_arrangement_remark" 
                                    id="other_arrangement_remark" 
                                    class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('type_of_living_arrangement', $senior->type_of_living_arrangement) == $lastArrangementId ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('other_arrangement_remark', $senior->other_arrangement_remark) }}" 
                                    style="width: -webkit-fill-available;">

                                @error('type_of_living_arrangement')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @error('other_arrangement_remark')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 mb-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">Guardian</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block">First Name</label>
                                <input 
                                    name="guardian_first_name" 
                                    id="guardian_first_name" 
                                    type="text" 
                                    value="{{ $senior_guardian->guardian_first_name ?? '' }}" 
                                    class="w-full bg-gray-100 text-sm px-4 py-3 rounded-md transition-all pr-10" 
                                    placeholder="Enter first name" 
                                />
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block">Middle Name</label>
                                <input 
                                    name="guardian_middle_name" 
                                    id="guardian_middle_name" 
                                    type="text" 
                                    value="{{ $senior_guardian->guardian_middle_name ?? '' }}" 
                                    class="w-full bg-gray-100 text-sm px-4 py-3 rounded-md transition-all pr-10" 
                                    placeholder="Enter middle name" 
                                />
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block">Last Name</label>
                                <input 
                                    name="guardian_last_name" 
                                    id="guardian_last_name" 
                                    type="text" 
                                    value="{{ $senior_guardian->guardian_last_name ?? '' }}" 
                                    class="w-full bg-gray-100 text-sm px-4 py-3 rounded-md transition-all pr-10" 
                                    placeholder="Enter last name" 
                                />
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block">Suffix</label>
                                <input 
                                    name="guardian_suffix" 
                                    id="guardian_suffix" 
                                    type="text" 
                                    value="{{ $senior_guardian->guardian_suffix ?? '' }}" 
                                    class="w-full bg-gray-100 text-sm px-4 py-3 rounded-md transition-all pr-10" 
                                    placeholder="Enter suffix (e.g., Jr., Sr., III)" 
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block">Relationship</label>
                                <select 
                                    name="guardian_relationship_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all">
                                    <option value="" disabled>Select relationship</option>
                                    @foreach($relationship_list as $relationship1) 
                                        <option 
                                            value="{{ $relationship1->id }}" 
                                            {{ old('guardian_relationship_id', $senior_guardian->guardian_relationship_id ?? '') == $relationship1->id ? 'selected' : '' }}>
                                            {{ $relationship1->relationship }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block">Contact Number</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">+63</span>
                                    <input 
                                        name="guardian_contact_no" 
                                        type="text" 
                                        value="{{ ltrim($senior_guardian->guardian_contact_no ?? '', '+63') }}" 
                                        class="w-full bg-gray-100 text-sm px-4 py-3 rounded-r-md transition-all pr-10" 
                                        placeholder="Enter contact number (10 digits)" 
                                        inputmode="numeric" 
                                        pattern="[0-9]*" 
                                        maxlength="10" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">Family Composition</p>
                        </div>

                        <div class="mt-8">
                            <div class="overflow-x-auto">
                                <table id="familyTable" class="table-auto w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Name</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Relationship</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Age</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Civil Status</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Occupation</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Income</th>
                                            <th id="remove-header" class="border border-gray-300 px-4 py-2 text-left font-semibold">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(old('relative_name'))
                                            @foreach(old('relative_name') as $index => $name)
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_name[]" value="{{ $name }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter name" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select relationship</option>
                                                        @foreach ($relationship_list as $relationship)
                                                            <option value="{{ $relationship->id }}" {{ (old('relative_relationship_id')[$index] ?? '') == $relationship->id ? 'selected' : '' }}>
                                                                {{ $relationship->relationship }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="number" name="relative_age[]" value="{{ old('relative_age')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select status</option>
                                                        @foreach ($civil_status_list as $status)
                                                            <option value="{{ $status->id }}" {{ (old('relative_civil_status_id')[$index] ?? '') == $status->id ? 'selected' : '' }}>
                                                                {{ $status->civil_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_occupation[]" value="{{ old('relative_occupation')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_income[]" value="{{ old('relative_income')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 flex items-center justify-center">
                                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1v-7a1 1 0 00-1-1H5zm3 2a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1zm5 0a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @elseif(isset($family_composition) && count($family_composition))
                                            @foreach($family_composition as $index => $family)
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_name[]" value="{{ $family->relative_name }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter name" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select relationship</option>
                                                        @foreach ($relationship_list as $relationship)
                                                            <option value="{{ $relationship->id }}" {{ $family->relative_relationship_id == $relationship->id ? 'selected' : '' }}>
                                                                {{ $relationship->relationship }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="number" name="relative_age[]" value="{{ $family->relative_age }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select status</option>
                                                        @foreach ($civil_status_list as $status)
                                                            <option value="{{ $status->id }}" {{ $family->relative_civil_status_id == $status->id ? 'selected' : '' }}>
                                                                {{ $status->civil_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_occupation[]" value="{{ $family->relative_occupation }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_income[]" value="{{ $family->relative_income }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 flex items-center justify-center" id="removeCell-0">
                                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                        <img src="../../../images/trashbin.png" alt="Delete" class="h-5 w-5" />
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_name[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter name" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled selected>Select relationship</option>
                                                        @foreach ($relationship_list as $relationship)
                                                            <option value="{{ $relationship->id }}">
                                                                {{ $relationship->relationship }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="number" name="relative_age[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled selected>Select status</option>
                                                        @foreach ($civil_status_list as $status)
                                                            <option value="{{ $status->id }}">
                                                                {{ $status->civil_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_occupation[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="text" name="relative_income[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2 hidden flex items-center justify-center" id="removeCell-0">
                                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                        <img src="images/trashbin.png" alt="Delete" class="h-5 w-5" />
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-center">
                            <button type="button" onclick="addRow()" class="py-3 px-6 flex justify-center items-center md:w-auto flex justify-center items-center text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add another row
                            </button>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Economic Status
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="relative md:col-span-4 sm:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('pensioner') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Does the user already a pensioner?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4"> 
                                        <input type="radio" 
                                            name="pensioner" 
                                            value="1" 
                                            id="pensioner_yes" 
                                            class="mr-2 shadow-md" 
                                            {{ (old('pensioner') !== null ? old('pensioner') : $senior->pensioner) == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'pensioner')">

                                        <label for="pensioner_yes" 
                                            class="text-sm text-gray-800 @error('pensioner') text-red-700 @enderror">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="flex items-center mb-2 md:mr-4"> 
                                        <input type="radio" 
                                            name="pensioner" 
                                            value="0" 
                                            id="pensioner_no" 
                                            class="mr-2 shadow-md" 
                                            {{ (old('pensioner') !== null ? old('pensioner') : $senior->pensioner) == 0 ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'pensioner')">

                                        <label for="pensioner_no" 
                                            class="text-sm text-gray-800 @error('pensioner') text-red-700 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                @error('pensioner')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">
                                    <div class="w-full md:col-span-2 text-gray-800 relative">
                                        <label id="pensioner_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ old('pensioner') == 1 ? '' : 'hidden' }}">
                                            If yes, how much pension does the user receive?
                                        </label>

                                        <select name="if_pensioner_yes" 
                                            id="if_pensioner_yes" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ (old('pensioner') !== null ? old('pensioner') : $senior->pensioner) == 1 ? '' : 'hidden' }}" 
                                            style="width: -webkit-fill-available;" 
                                            {{ (old('pensioner') !== null ? old('pensioner') : $senior->pensioner) == 1 ? 'required' : '' }}>
                                            <option value="" disabled {{ old('if_pensioner_yes', $senior->if_pensioner_yes) ? '' : 'selected' }}>
                                                Select pension amount
                                            </option>
                                            @foreach($pensions as $pension)
                                                <option value="{{ $pension->id }}" 
                                                    {{ (old('if_pensioner_yes') !== null ? old('if_pensioner_yes') : $senior->if_pensioner_yes) == $pension->id ? 'selected' : '' }}>
                                                    {{ $pension->how_much_pension }}
                                                </option>
                                            @endforeach
                                        </select>


                                        @error('if_pensioner_yes')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2 relative {{ $senior->pensioner == 1 ? '' : 'hidden' }}" id="source_list">

                                        <label id="source_label" class="text-sm text-gray-800 mb-2 block">
                                            If yes, from what source?
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            @foreach($sources as $source)
                                                <div class="flex items-center mb-2 md:mr-4">
                                                    <input type="checkbox"
                                                        name="source[]"
                                                        value="{{ $source->id }}"
                                                        id="source_{{ $source->id }}"
                                                        class="mr-2 shadow-md source-checkbox"
                                                        @if(in_array($source->id, $pension_sources->pluck('source_id')->toArray())) checked @endif>

                                                    <label for="source_{{ $source->id }}"
                                                        class="text-sm text-gray-800 @error('source') text-red-700 @enderror">
                                                        {{ $source->source_list }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <label id="other_source_label" 
                                            class="text-sm text-gray-800 mt-4 mb-2 block 
                                            {{ is_array(old('source')) && in_array($pension_sources->last()->source_id, old('source')) ? '' : 'hidden' }}">
                                            If others, please specify:
                                        </label>

                                        <input type="text"
                                            name="other_source_remark[{{ $sources->last()->id }}]"
                                            id="other_source_remark_{{ $sources->last()->id }}"
                                            class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ is_array(old('source')) && in_array($pension_sources->last()->source_id, old('source')) ? '' : 'hidden' }}"
                                            placeholder="Enter additional information"
                                            value="{{ old('other_source_remark.' . $sources->last()->id) ?? ($pension_sources->firstWhere('source_id', $sources->last()->id)?->other_source_remark ?? '') }}"
                                            style="width: -webkit-fill-available;"
                                            {{ is_array(old('source')) && in_array($pension_sources->last()->source_id, old('source')) ? 'required' : '' }}>

                                        @error('source')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror

                                        @error('other_source_remark')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="relative md:col-span-4 sm:col-span-4"> 
                                <label class="text-sm mb-2 block 
                                    @error('permanent_source') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Does the user have permanent source of income?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="permanent_source" 
                                            value="1" 
                                            id="permanent_yes" 
                                            class="mr-2 shadow-md" 
                                            {{ (old('permanent_source') !== null ? old('permanent_source') : $senior->permanent_source) == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'permanent_source')">
                                        <label for="permanent_yes" 
                                            class="text-sm text-gray-800 @error('permanent_source') text-red-700 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="permanent_source" 
                                            value="0" 
                                            id="permanent_no" 
                                            class="mr-2 shadow-md" 
                                            {{ (old('permanent_source') !== null ? old('permanent_source') : $senior->permanent_source) == 0 ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'permanent_source')">
                                        <label for="permanent_no" 
                                            class="text-sm text-gray-800 @error('permanent_source') text-red-700 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="md:grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">

                                    <div class="md:col-span-2 text-gray-800 relative">
                                        <label id="permanent_income_label" class="text-sm mt-4 mb-2 block {{ old('permanent_source') == 1 || $senior->permanent_source == 1 ? '' : 'hidden' }}">
                                            If yes, how much income?
                                        </label>

                                        <select name="if_permanent_yes_income" 
                                        id="if_permanent_yes_income" 
                                        class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                        {{ old('permanent_source') == 1 || $senior->permanent_source == 1 ? '' : 'hidden' }}" 
                                        style="width: -webkit-fill-available;"
                                        {{ old('permanent_source') == 1 || $senior->permanent_source == 1 ? 'required' : '' }}>
                                            <option value="" disabled selected>Select income amount</option>
                                            @foreach($incomes as $income)
                                                @php
                                                    $remark = $income_sources_edit->firstWhere('income_source_id', $income->id)?->other_income_source_remark ?? '';
                                                @endphp
                                                <option value="{{ $income->id }}" 
                                                        {{ old('if_permanent_yes_income', $income_sources_edit->pluck('income_source_id')->contains($income->id) ? $income->id : null) == $income->id ? 'selected' : '' }}
                                                        data-other-remark="{{ $remark }}">
                                                    {{ $income->how_much_income }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="md:col-span-2 relative {{ old('permanent_source') == 1 || $senior->permanent_source == 1 ? '' : 'hidden' }}" id="income_source_list">

                                        <label id="income_source_label" class="text-sm text-gray-800 mt-4 mb-2 block">
                                            If yes, from what source?
                                        </label>

                                        <div class="flex flex-col md:flex-col mt-4 md:flex-wrap">
                                            @foreach($income_sources as $income_source)
                                                <div class="flex items-center mb-2 md:mr-4">
                                                    <input type="checkbox"
                                                        name="income_source[]"
                                                        value="{{ $income_source->id }}"
                                                        id="{{ $income_source->id }}"
                                                        class="mr-2 shadow-md income-source-checkbox"
                                                        {{ 
                                                                is_array(old('income_source')) && in_array($income_source->id, old('income_source')) 
                                                                || $income_sources_edit->pluck('income_source_id')->contains($income_source->id) 
                                                                ? 'checked' : '' 
                                                        }}
                                                        onclick="toggleCheckboxForIncomeSourceInputField()">

                                                    <label for="{{ $income_source->id }}"
                                                        class="text-sm text-gray-800 @error('income_source') text-red-700 @enderror">
                                                        {{ $income_source->where_income_source }}
                                                        <span class="italic">{{ $income_source->where_income_source_examples }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <label id="other_income_source_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ is_array(old('income_source')) && in_array($income_sources->last()->id, old('income_source')) ? '' : 'hidden' }}">
                                            If others, please specify:
                                        </label>

                                        @php
                                            $oldIncomeSource = old('income_source');
                                            $isOtherIncomeSourceSelected = is_array($oldIncomeSource) && end($oldIncomeSource) == $income_sources->last()->id;
                                            $remark = $income_sources_edit->firstWhere('income_source_id', $income_source->id)?->other_income_source_remark ?? '';
                                        @endphp

                                        <input type="text"
                                            name="other_income_source_remark"
                                            id="other_income_source_remark"
                                            class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all
                                            {{ ($isOtherIncomeSourceSelected || $income_sources->last()->id == $income_source->id) ? '' : 'hidden' }}"
                                            placeholder="Enter additional information"
                                            value="{{ old('other_income_source_remark.' . $income->id) ?? $remark }}"
                                            style="width: -webkit-fill-available;"
                                            {{ $isOtherIncomeSourceSelected ? 'required' : '' }}>

                                        @error('income_source')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                        @error('other_income_source_remark')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                @error('permanent_source')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_permanent_yes_income')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Health Condition
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="relative md:col-span-3 sm:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('has_illness') text-red-700  
                                    @else text-gray-800 @enderror">
                                    Does the user have an existing illness?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_illness" 
                                            value="1" 
                                            id="illness_yes" 
                                            class="mr-2 shadow-md" 
                                            {{ old('has_illness', $senior->has_illness) == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'has_illness')">
                                        <label for="illness_yes" 
                                            class="text-sm text-gray-800 @error('has_illness') text-red-700 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_illness" 
                                            value="0" 
                                            id="illness_no" 
                                            class="mr-2 shadow-md" 
                                            {{ old('has_illness', $senior->has_illness) == 0 ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'has_illness')">
                                        <label for="illness_no" 
                                            class="text-sm text-gray-800 @error('has_illness') text-red-700 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <label id="illness_label" 
                                    class="text-sm text-gray-800 mt-4 mb-2 block 
                                    {{ old('has_illness', $senior->has_illness) == 1 ? '' : 'hidden' }}">
                                    If yes, please specify:
                                </label>

                                <input type="text" 
                                name="if_illness_yes" 
                                id="if_illness_yes" 
                                class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                {{ old('has_illness', $senior->has_illness) == 1 ? '' : 'hidden' }}" 
                                placeholder="Enter additional information"
                                value="{{ old('if_illness_yes', $senior->if_illness_yes) }}" 
                                style="width: -webkit-fill-available;">

                                @error('has_illness')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_illness_yes')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative md:col-span-3 sm:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('has_disability') text-red-700
                                    @else text-gray-800 @enderror">
                                    Does the user have disability?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_disability" 
                                            value="1" 
                                            id="disability_yes" 
                                            class="mr-2 shadow-md" 
                                            {{ old('has_disability', $senior->has_disability) == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'has_disability')">
                                        <label for="disability_yes" 
                                            class="text-sm text-gray-800 @error('has_disability') text-red-700 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_disability" 
                                            value="0" 
                                            id="disability_no" 
                                            class="mr-2 shadow-md" 
                                            {{ old('has_disability', $senior->has_disability) == 0 ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'has_disability')">
                                        <label for="disability_no" 
                                            class="text-sm text-gray-800 @error('has_disability') text-red-700 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <label id="disability_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ old('has_disability', $senior->has_disability) == 1 ? '' : 'hidden' }}">
                                    If yes, please specify: <span class="italic">
                                </label>

                                <input type="text" 
                                    name="if_disability_yes" 
                                    id="if_disability_yes" 
                                    class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('has_disability', $senior->has_disability) == 1 ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('if_disability_yes', $senior->if_disability_yes) }}" style="width: -webkit-fill-available;"
                                    >
                                @error('has_disability')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_disability_yes')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Identification
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                            @php
                                $valid_id_url = $senior->valid_id 
                                    ? asset('storage/images/senior_citizen/valid_id/' . $senior->valid_id)
                                    : ''; 
                            @endphp

                            <div x-data="{
                                    showAdminApplicantValidIDModal: false,
                                    previewAdminApplicantValidIDUrl: '{{ $valid_id_url }}',
                                    previewValidIdImage(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.previewAdminApplicantValidIDUrl = e.target.result;
                                                document.getElementById('valid_id_preview').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }">
                                <label class="text-sm mb-2 block 
                                    @error('valid_id') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Valid ID
                                </label>
                                <input id="valid_id_input" name="valid_id" type="file" accept="image/*"
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('valid_id') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                    @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload image of Valid ID" @change="previewValidIdImage">

                                <p id="valid_id_filename" class="text-gray-700 text-xs mt-2"></p>

                                <div class="flex justify-center items-center mt-4">
                                    <img :src="previewAdminApplicantValidIDUrl" id="valid_id_preview" 
                                        class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                        style="display: {{ $valid_id_url ? 'block' : 'none' }};" 
                                        alt="Valid ID Preview" 
                                        @click="showAdminApplicantValidIDModal = true">
                                </div>

                                @error('valid_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @include('components.modal.admin.admin_applicant_valid_id_zoom')
                            </div>
                            
                            @php
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=" . $senior->first_name . "-" . $senior->last_name;
                                $profile_picture_url = $senior->profile_picture 
                                    ? asset('storage/images/senior_citizen/profile_picture/' . $senior->profile_picture) 
                                    : $default_profile;
                            @endphp

                            <div x-data="{
                                    showAdminApplicantCameraModal: false,
                                    showAdminApplicantProfilePicModal: false,
                                    previewAdminApplicantProfilePicUrl: '{{ $profile_picture_url }}',
                                    previewImage(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.previewAdminApplicantProfilePicUrl = e.target.result;
                                                document.getElementById('profile_picture_preview').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }" 
                                @open-admin-applicant-camera-modal.window="showAdminApplicantCameraModal = true; localStorage.setItem('showAdminApplicantCameraModal', 'true')" 
                                @close-admin-applicant-camera-modal.window="showAdminApplicantCameraModal = false; localStorage.setItem('showAdminApplicantCameraModal', 'false')">

                                <label class="text-sm mb-2 block 
                                    @error('profile_picture') text-red-700
                                    @else text-gray-800 @enderror">
                                    Profile Picture
                                </label>

                                <div class="relative">
                                    <input name="profile_picture" type="file" 
                                        class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all 
                                        @error('profile_picture') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                        @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                        placeholder="Upload photo of Pensioner" id="AdminApplicantProfilePictureField" 
                                        @change="previewImage">

                                    <button @click="$dispatch('open-admin-applicant-camera-modal')" 
                                            class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12" 
                                            type="button">
                                        <img src="../../../images/camera.png" alt="Toggle Profile Picture" class="hover:animate-jiggle camera-icon w-7 h-7" id="toggleCameraIcon">
                                    </button>
                                </div>

                                <p id="profile_picture_filename" class="text-gray-700 text-xs mt-2"></p>

                                <div class="flex justify-center items-center mt-4">
                                    <img :src="previewAdminApplicantProfilePicUrl" id="profile_picture_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                        style="display: block;" alt="Profile Picture Preview"
                                        @click="showAdminApplicantProfilePicModal = true">
                                </div>

                                @error('profile_picture')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @include('components.modal.admin.admin_applicant_camera')
                                @include('components.modal.admin.admin_applicant_profile_pic_zoom')
                            </div>

                            @php
                                $indigency_url = $senior->indigency 
                                    ? asset('storage/images/senior_citizen/indigency/' . $senior->indigency)
                                    : '';
                            @endphp

                            <div x-data="{
                                    showAdminApplicantIndigencyModal: false,
                                    previewAdminApplicantIndigencyUrl: '{{ $indigency_url }}',
                                    previewIndigencyImage(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.previewAdminApplicantIndigencyUrl = e.target.result;
                                                document.getElementById('indigency_preview').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }">
                                <label class="text-sm mb-2 block 
                                    @error('indigency') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Certificate of Indigency
                                </label>
                                <input id="indigency_input" name="indigency" type="file" accept="image/*"
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('indigency') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                    @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload photo of Indigency Certificate" @change="previewIndigencyImage">

                                <p id="indigency_filename" class="text-gray-700 text-xs mt-2"></p>

                                <div class="flex justify-center items-center mt-4">
                                    <img :src="previewAdminApplicantIndigencyUrl" id="indigency_preview" 
                                        class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                        style="display: {{ $indigency_url ? 'block' : 'none' }};" 
                                        alt="Indigency Certificate Preview" 
                                        @click="showAdminApplicantIndigencyModal = true">
                                </div>

                                @error('indigency')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @include('components.modal.admin.admin_applicant_indigency_zoom')
                            </div>

                            @php
                                $birth_certificate_url = $senior->birth_certificate 
                                    ? asset('storage/images/senior_citizen/birth_certificate/' . $senior->birth_certificate)
                                    : ''; 
                            @endphp

                            <div x-data="{
                                    showAdminApplicantBirthCertificateModal: false,
                                    previewAdminApplicantBirthCertificateUrl: '{{ $birth_certificate_url }}',
                                    previewBirthCertificateImage(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.previewAdminApplicantBirthCertificateUrl = e.target.result;
                                                document.getElementById('birth_certificate_preview').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }">
                                <label class="text-sm mb-2 block 
                                    @error('birth_certificate') text-red-700 
                                    @else text-gray-800 @enderror">
                                    Birth Certificate
                                </label>
                                <input id="birth_certificate_input" name="birth_certificate" type="file" accept="image/*"
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('birth_certificate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload photo of Birth Certificate" @change="previewBirthCertificateImage">

                                <p id="birth_certificate_filename" class="text-gray-700 text-xs mt-2"></p>

                                <div class="flex justify-center items-center mt-4">
                                    <img :src="previewAdminApplicantBirthCertificateUrl" id="birth_certificate_preview" 
                                        class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                        style="display: {{ $birth_certificate_url ? 'block' : 'none' }};" 
                                        alt="Birth Certificate Preview" 
                                        @click="showAdminApplicantBirthCertificateModal = true">
                                </div>

                                @error('birth_certificate')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @include('components.modal.admin.admin_applicant_birth_certificate_zoom')
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Account Information
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block 
                                    @error('email') text-red-700
                                    @else text-gray-800 @enderror">
                                    Email Address
                                </label>
                                <input name="email" type="email" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter email" value="{{ $senior->email }}" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="flex justify-center mt-8">
                            {!! htmlFormSnippet() !!}
                        </div>
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="text-red-500 flex justify-center text-sm mt-2">
                                {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif

                        <div class="mt-8 flex justify-center">
                            <button type="submit" id="submit" name="submit" class="hover:scale-105 transition duration-150 ease-in-out py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src= "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
    function toggleInputField(value, type) {
        let additionalInput, additionalIncomeInput, additionalLabel, additionalIncomeLabel;

        if (type === 'pensioner') {
            additionalInput = document.getElementById('if_pensioner_yes');
            const pensionerLabel = document.getElementById('pensioner_label');
            const sourceList = document.getElementById('source_list');
            const checkboxes = document.querySelectorAll(".source-checkbox");

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                pensionerLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required'); 
                sourceList.classList.remove('hidden');
            } else {
                additionalInput.classList.add('hidden');
                pensionerLabel.classList.add('hidden');
                additionalInput.removeAttribute('required');
                sourceList.classList.add('hidden');
                additionalInput.value = '';

                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        } else if (type === 'permanent_source') {
            additionalIncomeInput = document.getElementById('if_permanent_yes_income');
            const permanentIncomeLabel = document.getElementById('permanent_income_label');
            const incomeSourceList = document.getElementById('income_source_list');
            const checkboxes = document.querySelectorAll(".income-source-checkbox");

            if (value == 1) {
                additionalIncomeInput.classList.remove('hidden');
                permanentIncomeLabel.classList.remove('hidden');
                additionalIncomeInput.setAttribute('required', 'required');
                incomeSourceList.classList.remove('hidden');
            } else {
                additionalIncomeInput.classList.add('hidden');
                permanentIncomeLabel.classList.add('hidden');
                additionalIncomeInput.removeAttribute('required');
                incomeSourceList.classList.add('hidden');
                additionalIncomeInput.value = '';

                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        } else if (type === 'livingArrangement') {
            additionalInput = document.getElementById('other_arrangement_remark');

            if (value == 5) {
                additionalInput.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required');
            } else {
                additionalInput.classList.add('hidden');
                additionalInput.removeAttribute('required');
                additionalInput.value = ''; 
            }
        } else if (type === 'sourceslist') {
            additionalInput = document.getElementById('other_source_remark');
            const lastSourceId = {{ $sources->last()->id }};

            if (value == lastSourceId) {
                additionalInput.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required');
            } else {
                additionalInput.classList.add('hidden');
                additionalInput.removeAttribute('required');
                additionalInput.value = '';
            }
        }  else if (type === 'has_illness') {
            additionalInput = document.getElementById('if_illness_yes');
            additionalLabel = document.getElementById('illness_label');

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                additionalLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required'); 
            } else {
                additionalInput.classList.add('hidden');
                additionalLabel.classList.add('hidden');
                additionalInput.removeAttribute('required'); 
                additionalInput.value = ''; 
            }
        } else if (type === 'has_disability') {
            additionalInput = document.getElementById('if_disability_yes');
            additionalLabel = document.getElementById('disability_label');

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                additionalLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required'); 
            } else {
                additionalInput.classList.add('hidden');
                additionalLabel.classList.add('hidden');
                additionalInput.removeAttribute('required'); 
                additionalInput.value = ''; 
            }
        } else if (type === 'incomesourceslist') {
            additionalInput = document.getElementById('other_income_source_remark');
            const lastIncomeSourceId = {{ $income_sources->last()->id }};

            if (value == lastIncomeSourceId) {
                additionalInput.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required');
            } else {
                additionalInput.classList.add('hidden');
                additionalInput.removeAttribute('required');
                additionalInput.value = ''; 
            }
        } 
    }

    function toggleCheckboxInputField(sourceCheckbox, additionalInput, sourceLabel) {
        if (sourceCheckbox.checked) {
            additionalInput?.classList.remove("hidden");
            sourceLabel?.classList.remove("hidden");
            additionalInput?.setAttribute("required", "required");
        } else {
            additionalInput?.classList.add("hidden");
            sourceLabel?.classList.add("hidden");
            additionalInput?.removeAttribute("required");
            if (additionalInput) additionalInput.value = ""; 
        }
    }

    function toggleCheckboxForIncomeSourceInputField() {
        const lastIncomeSourceId = {{ $income_sources->last()->id }};
        const incomeSourceCheckbox = document.querySelector(`input[name="income_source[]"][value="${lastIncomeSourceId}"]`);
        const additionalIncomeInput = document.getElementById('other_income_source_remark');
        const incomeSourceLabel = document.getElementById('other_income_source_label');

        if (incomeSourceCheckbox.checked) {
            additionalIncomeInput.classList.remove('hidden');
            incomeSourceLabel.classList.remove('hidden');
            additionalIncomeInput.setAttribute('required', 'required');
        } else {
            additionalIncomeInput.classList.add('hidden');
            incomeSourceLabel.classList.add('hidden');
            additionalIncomeInput.removeAttribute('required');
            additionalIncomeInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const previousPensionerValue = '{{ old("pensioner") }}';
        if (previousPensionerValue == 1) { 
            toggleInputField(1, 'pensioner');
        }

        const lastSourceId = {{ $sources->last()->id }};
        const sourceCheckbox = document.querySelector(`input[name="source[]"][value="${lastSourceId}"]`);
        const additionalInput = document.getElementById(`other_source_remark_${lastSourceId}`);
        const sourceLabel = document.getElementById("other_source_label");

        if (sourceCheckbox) {
            sourceCheckbox.addEventListener("change", () => toggleCheckboxInputField(sourceCheckbox, additionalInput, sourceLabel));
            toggleCheckboxInputField(sourceCheckbox, additionalInput, sourceLabel);
        }

        const lastIncomeSourceId = {{ $income_sources->last()->id }};
        const incomeSourceCheckbox = document.querySelector(`input[name="income_source[]"][value="${lastIncomeSourceId}"]`);
        if (incomeSourceCheckbox) {
            incomeSourceCheckbox.addEventListener('change', toggleCheckboxForIncomeSourceInputField);
            toggleCheckboxForIncomeSourceInputField();
        }

        const previousPermanentSourceValue = '{{ old("permanent_source") }}';
        if (previousPermanentSourceValue == 1) {
            document.getElementById('if_permanent_yes_income').classList.remove('hidden');
            document.getElementById('permanent_income_label').classList.remove('hidden');
            document.getElementById('income_source_list').classList.remove('hidden');
            toggleInputField(1, 'permanent_source');
        }

        const lastArrangementId = '{{ $lastArrangementId }}';
        const previousLivingArrangementValue = '{{ old("type_of_living_arrangement", $senior->type_of_living_arrangement) }}';

        if (previousLivingArrangementValue == lastArrangementId) {
            document.getElementById('other_arrangement_remark').classList.remove('hidden');
        }
            
        const previousDisabilityValue = '{{ old("has_disability") }}';
        if (previousDisabilityValue == 1) { 
            document.getElementById('if_disability_yes').classList.remove('hidden');
            document.getElementById('disability_label').classList.remove('hidden');
        }
    });
</script>

<script>
    let rowCount = @if(old('relative_name')) {{ count(old('relative_name')) }} @else 1 @endif;

    function addRow() {
    rowCount++;
    
    let newRow = `
        <tr>
            <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="relative_name[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter name" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                    <option value="" disabled selected>Select relationship</option>
                    @foreach ($relationship_list as $relationship)
                        <option value="{{ $relationship->id }}">{{ $relationship->relationship }}</option>
                    @endforeach
                </select>
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="number" name="relative_age[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                    <option value="" disabled selected>Select status</option>
                    @foreach ($civil_status_list as $status)
                        <option value="{{ $status->id }}">{{ $status->civil_status }}</option>
                    @endforeach
                </select>
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="relative_occupation[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="relative_income[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2 hidden flex items-center justify-center" id="removeCell-${rowCount}">
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                    <img src="../../../images/trashbin.png" alt="Delete" class="h-5 w-5" />
                </button>
            </td>
        </tr>
    `;

        $('#familyTable tbody').append(newRow);
        updateRemoveIconVisibility();
    }

    function removeRow(button) {
        const row = button.closest('tr'); 
        row.parentNode.removeChild(row); 
        updateRemoveIconVisibility(); 
    }

    function updateRemoveIconVisibility() {
        const tableBody = document.getElementById('familyTable').getElementsByTagName('tbody')[0];
        const rows = tableBody.getElementsByTagName('tr');

        const removeHeader = document.getElementById('remove-header');
        removeHeader.style.display = rows.length > 1 ? '' : 'none';

        for (let i = 0; i < rows.length; i++) {
            const removeCell = rows[i].querySelector(`[id^='removeCell-']`);
            if (removeCell) {
                removeCell.classList.toggle('hidden', rows.length <= 1);
            }
        }
    }

    updateRemoveIconVisibility(); 

    const tooltipIcon = document.getElementById('tooltip-icon');
    const tooltipText = document.getElementById('tooltip-text');

    tooltipIcon.addEventListener('click', () => {
        tooltipText.classList.toggle('opacity-0');
        tooltipText.classList.toggle('opacity-100');

        tooltipIcon.classList.toggle('bg-gray-400');
        tooltipIcon.classList.toggle('bg-gray-500');
    });

    document.getElementById('valid_id_input').addEventListener('change', function() {
    var file = this.files[0];

    document.getElementById('valid_id_filename').textContent = file ? 'Image attached' : '';

        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('valid_id_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('valid_id_preview').style.display = 'none';
        }
    });

    document.getElementById('AdminApplicantProfilePictureField').addEventListener('change', function() {
    var file = this.files[0];

    document.getElementById('profile_picture_filename').textContent = file ? 'Image attached' : '';

        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('profile_picture_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('profile_picture_preview').style.display = 'none';
        }
    });

    document.getElementById('indigency_input').addEventListener('change', function() {
    var file = this.files[0];

    document.getElementById('indigency_filename').textContent = file ? 'Image attached' : '';

        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('indigency_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('indigency_preview').style.display = 'none';
        }
    });

    document.getElementById('birth_certificate_input').addEventListener('change', function() {
    var file = this.files[0];

    document.getElementById('birth_certificate_filename').textContent = file ? 'Image attached' : '';

        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('birth_certificate_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('birth_certificate_preview').style.display = 'none';
        }
    });

</script>

</body>
</html>

