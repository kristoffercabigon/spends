@include('partials.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background_seniors.jfif') }}'); background-attachment: fixed;">
    <div class="bg-white bg-opacity-50 min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[sans-serif]">

            <div class="mx-4 mb-4 -mt-16">
                <div class="max-h-[80vh] overflow-y-auto">
                    <form id="form" action="/store" enctype="multipart/form-data" method="POST" class="w-full bg-white shadow-lg sm:pt-2 px-12 py-10 rounded-md">
                        @csrf
                        <div class="text-xl font-bold mt-[15px] mb-6 leading-tight tracking-tight text-gray-900 md:text-2xl">
                            <p class="mx-4 text-center">
                                Registration Form
                            </p>
                        </div>

                        <div class="text-xl font-bold mt-[15px] mb-6 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Basic Information
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('first_name') text-red-700 dark:text-red-500 
                                    @elseif(old('first_name')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    First Name/ Unang Pangalan
                                </label>
                                <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('first_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('first_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter first name" />
                                @if(old('first_name'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('first_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('first_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('middle_name') text-red-700 dark:text-red-500 
                                    @elseif(old('middle_name')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Middle Name/ Gitnang Pangalan
                                </label>
                                <input name="middle_name" id="middle_name" type="text" value="{{ old('middle_name') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('middle_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('middle_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter middle name" />
                                @if(old('middle_name'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('middle_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('middle_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('last_name') text-red-700 dark:text-red-500 
                                    @elseif(old('last_name')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Last Name/ Huling Pangalan
                                </label>
                                <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('last_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('last_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter last name" />
                                @if(old('last_name'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('last_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('last_name'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('suffix') text-red-700 dark:text-red-500 
                                    @elseif(old('suffix')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Suffix/ Karugtong ng Pangalan
                                </label>
                                <input name="suffix" id="suffix" type="text" value="{{ old('suffix') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('suffix') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('suffix')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter suffix (e.g., Jr., Sr., III)" />
                                @if(old('suffix'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('suffix')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('suffix'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('birthdate') text-red-700 dark:text-red-500 
                                    @elseif(old('birthdate')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Birthdate/ Kaarawan
                                </label>
                                <input name="birthdate" type="text" id="datepicker" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md cursor-pointer transition-all 
                                    @error('birthdate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:border-red-500 
                                    @elseif(old('birthdate')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Select birthdate" readonly 
                                    value="{{ old('birthdate') }}" />

                                @error('birthdate')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('birthdate'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('age') text-red-700 dark:text-red-500 
                                    @elseif(old('age')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Age/ Edad
                                </label>
                                <input name="age" type="text" id="age" value="{{ old('age') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                    @error('age') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('age')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Age" readonly />
                                @if(old('age'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('age')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('age'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('birthplace') text-red-700 dark:text-red-500 
                                    @elseif(old('birthplace')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Birthplace/ Lugar ng Kapanganakan
                                </label>
                                <input name="birthplace" type="text" value="{{ old('birthplace') }}" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                    @error('birthplace') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('birthplace')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter place of birth" />
                                @if(old('birthplace'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('birthplace')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('birthplace'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('sex_id') text-red-700 dark:text-red-500 
                                    @elseif(old('sex_id')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Sex/ Kasarian
                                </label>
                                <select name="sex_id" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('sex_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:border-red-500 
                                    @elseif(old('sex_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled selected>Select sex</option>
                                    @foreach($sexes as $sex)
                                        <option value="{{ $sex->id }}" {{ old('sex_id') == $sex->id ? 'selected' : '' }}>
                                            {{ $sex->sex }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(old('sex_id'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('sex_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('civil_status_id') text-red-700 dark:text-red-500 
                                    @elseif(old('civil_status_id')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Civil Status
                                </label>
                                <select name="civil_status_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('civil_status_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:border-red-500 
                                    @elseif(old('civil_status_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled selected>Select civil status</option>
                                    @foreach($civil_status as $civil_status1) 
                                        <option value="{{ $civil_status1->id }}" {{ old('civil_status_id') == $civil_status1->id ? 'selected' : '' }}>
                                            {{ $civil_status1->civil_status }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(old('civil_status_id'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('civil_status_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('contact_no') text-red-700 dark:text-red-500 
                                    @elseif(old('contact_no')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Contact Number
                                </label>

                                <div class="flex">
                                    <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                        +63
                                    </span>
                                    
                                    <input name="contact_no" type="text" value="{{ old('contact_no') }}" 
                                        class="w-full text-sm px-4 py-3 rounded-r-md transition-all pr-10 
                                        @error('contact_no') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                        @elseif(old('contact_no')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                        @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                        placeholder="Enter contact number (10 digits)" 
                                        inputmode="numeric" pattern="[0-9]*" maxlength="10" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                                </div>

                                @if(old('contact_no'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif

                                @error('contact_no')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('contact_no'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="md:col-span-3 relative">
                                <label class="text-sm mb-2 block 
                                    @error('address') text-red-700 dark:text-red-500 
                                    @elseif(old('address')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Home Address / Tirahan
                                </label>
                                <input name="address" type="text" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('address') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('address')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter address" value="{{ old('address') }}" />
                                @if(old('address'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('address')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('address'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('barangay_id') text-red-700 dark:text-red-500 
                                    @elseif(old('barangay_id')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Barangay
                                </label>
                                <select name="barangay_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('barangay_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:border-red-500 
                                    @elseif(old('barangay_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled selected>Select barangay</option>
                                    @foreach($barangay as $barangay1)
                                        <option value="{{ $barangay1->id }}" {{ old('barangay_id') == $barangay1->id ? 'selected' : '' }}>
                                            {{ $barangay1->barangay_no }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(old('barangay_id'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('barangay_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="relative md:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('type_of_living_arrangement') text-red-700 dark:text-red-500 
                                    @elseif(old('type_of_living_arrangement')) text-green-700 dark:text-green-500 
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
                                                class="mr-2" 
                                                {{ old('type_of_living_arrangement') == $arrangement->id ? 'checked' : '' }}
                                                onclick="toggleInputField({{ $arrangement->id }}, 'livingArrangement')">

                                            <label for="living_arrangement_{{ $arrangement->id }}" 
                                                class="text-sm text-gray-800 @error('type_of_living_arrangement') text-red-700 dark:text-red-500 @enderror">
                                                {{ $arrangement->type_of_living_arrangement_list }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <input type="text" 
                                    name="other_arrangement_remark" 
                                    id="other_arrangement_remark" 
                                    class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('type_of_living_arrangement') == 4 ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('other_arrangement_remark') }}" style="width: -webkit-fill-available;"
                                    >

                                @if(old('type_of_living_arrangement'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('type_of_living_arrangement')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('other_arrangement_remark')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Family Composition
                            </p>
                        </div>

                        <div class="mt-8">
                            <div class="overflow-x-auto">
                                <table id="familyTable" class="table-auto w-full border-collapse border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Relationship</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Age</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Civil Status</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Occupation</th>
                                            <th class="border border-gray-300 px-4 py-2 text-left">Income</th>
                                            <th id="remove-header" class="border border-gray-300 px-4 py-2 text-left">Remove</th>
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
                                                    <input type="text" name="relative_relationship[]" value="{{ old('relative_relationship')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter relationship" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="number" name="relative_age[]" value="{{ old('relative_age')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_civil_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select status</option>
                                                        @foreach ($civil_status as $status)
                                                            <option value="{{ $status->id }}" {{ (old('relative_civil_status')[$index] ?? '') == $status->id ? 'selected' : '' }}>
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
                                                <td class="border border-gray-300 px-4 py-2 hidden" id="removeCell-{{ $index }}">
                                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1v-7a1 1 0 00-1-1H5zm3 2a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1zm5 0a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
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
                                                    <input type="text" name="relative_relationship[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter relationship" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <input type="number" name="relative_age[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                </td>
                                                <td class="border border-gray-300 px-4 py-2">
                                                    <select name="relative_civil_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                        <option value="" disabled>Select status</option>
                                                        @foreach ($civil_status as $status)
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
                                                <td class="border border-gray-300 px-4 py-2 hidden" id="removeCell-0">
                                                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1v-7a1 1 0 00-1-1H5zm3 2a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1zm5 0a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-center">
                            <button type="button" onclick="addRow()" class="bg-blue-500 text-white font-light py-2 px-4 rounded-md flex items-center justify-center">
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
                                    @error('pensioner') text-red-700 dark:text-red-500 
                                    @elseif(old('pensioner')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Are you a pensioner?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4"> 
                                        <input type="radio" 
                                            name="pensioner" 
                                            value="1" 
                                            id="pensioner_yes" 
                                            class="mr-2" 
                                            {{ old('pensioner') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'pensioner')">

                                        <label for="pensioner_yes" 
                                            class="text-sm text-gray-800 @error('pensioner') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="flex items-center mb-2 md:mr-4"> 
                                        <input type="radio" 
                                            name="pensioner" 
                                            value="0" 
                                            id="pensioner_no" 
                                            class="mr-2" 
                                            {{ old('pensioner') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'pensioner')">
                                        <label for="pensioner_no" 
                                            class="text-sm text-gray-800 @error('pensioner') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                @error('pensioner')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">
                                    <div class="w-full md:col-span-2 relative">
                                        <label id="pensioner_label" class="text-sm mt-4 mb-2 block {{ old('pensioner') == 1 ? '' : 'hidden' }}">
                                            If yes, how much pension do you receive?
                                        </label>

                                        <input type="text" 
                                            name="if_pensioner_yes" 
                                            id="if_pensioner_yes" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('pensioner') == 1 ? '' : 'hidden' }}" 
                                            placeholder="Enter additional information"
                                            value="{{ old('if_pensioner_yes') }}" style="width: -webkit-fill-available;"
                                            {{ old('pensioner') == 1 ? 'required' : '' }}>

                                        @error('if_pensioner_yes')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2 relative {{ old('pensioner') == 1 ? '' : 'hidden' }}" id="source_list">
                                        <label id="source_label" class="text-sm mt-4 mb-2 block">
                                            If yes, from what source?
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            @foreach($sources as $source)
                                                <div class="flex items-center mb-2 md:mr-4">
                                                    <input type="checkbox"
                                                        name="source[]"
                                                        value="{{ $source->id }}"
                                                        id="{{ $source->id }}"
                                                        class="mr-2"
                                                        {{ is_array(old('source')) && in_array($source->id, old('source')) ? 'checked' : '' }}
                                                        onclick="toggleCheckboxInputField()">

                                                    <label for="{{ $source->id }}"
                                                        class="text-sm text-gray-800 @error('source') text-red-700 dark:text-red-500 @enderror">
                                                        {{ $source->source_list }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <label id="other_source_label" class="text-sm mt-4 mb-2 block {{ is_array(old('source')) && in_array(4, old('source')) ? '' : 'hidden' }}">
                                            If others, please specify:
                                        </label>

                                        <input type="text"
                                            name="other_source_remark"
                                            id="other_source_remark"
                                            class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all
                                            {{ is_array(old('source')) && in_array(4, old('source')) ? '' : 'hidden' }}"
                                            placeholder="Enter additional information"
                                            value="{{ old('other_source_remark') ?? '' }}"
                                            style="width: -webkit-fill-available;"
                                            required="{{ is_array(old('source')) && in_array(4, old('source')) ? 'required' : '' }}">

                                        @error('source')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror

                                        @error('other_source_remark')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                @if(old('pensioner'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                            </div>

                            <div class="relative md:col-span-4 sm:col-span-4">
                                <label class="text-sm mb-2 block 
                                    @error('permanent_source') text-red-700 dark:text-red-500 
                                    @elseif(old('permanent_source')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Do you have permanent source of income?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="permanent_source" 
                                            value="1" 
                                            id="permanent_yes" 
                                            class="mr-2" 
                                            {{ old('permanent_source') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'permanent_source')">
                                        <label for="permanent_yes" 
                                            class="text-sm text-gray-800 @error('permanent_source') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="permanent_source" 
                                            value="0" 
                                            id="permanent_no" 
                                            class="mr-2" 
                                            {{ old('permanent_source') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'permanent_source')" >
                                        <label for="permanent_no" 
                                            class="text-sm text-gray-800 @error('permanent_source') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">
                                    <div class="w-full md:col-span-2 relative">
                                        <label id="permanent_label" class="text-sm mt-4 mb-2 block {{ old('permanent_source') == 1 ? '' : 'hidden' }}">
                                            If yes, from what source?
                                        </label>

                                        <input type="text" 
                                            name="if_permanent_yes" 
                                            id="if_permanent_yes" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('permanent_source') == 1 ? '' : 'hidden' }}" 
                                            placeholder="Enter additional information"
                                            value="{{ old('if_permanent_yes') }}" 
                                            style="width: -webkit-fill-available;">
                                    </div>

                                    <div class="md:col-span-2 relative">
                                        <label id="permanent_income_label" class="text-sm mt-4 mb-2 block {{ old('permanent_source') == 1 ? '' : 'hidden' }}">
                                            If yes, how much income?
                                        </label>

                                        <input type="text" 
                                            name="if_permanent_yes_income" 
                                            id="if_permanent_yes_income" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('permanent_source') == 1 ? '' : 'hidden' }}" 
                                            placeholder="Enter income amount"
                                            value="{{ old('if_permanent_yes_income') }}" 
                                            style="width: -webkit-fill-available;">
                                    </div>
                                </div>

                                @if(old('permanent_source'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('permanent_source')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_permanent_yes')
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
                                    @error('has_illness') text-red-700 dark:text-red-500 
                                    @elseif(old('has_illness')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Do you have an existing illness?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_illness" 
                                            value="1" 
                                            id="illness_yes" 
                                            class="mr-2" 
                                            {{ old('has_illness') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'has_illness')">
                                        <label for="illness_yes" 
                                            class="text-sm text-gray-800 @error('has_illness') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_illness" 
                                            value="0" 
                                            id="illness_no" 
                                            class="mr-2" 
                                            {{ old('has_illness') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'has_illness')" >
                                        <label for="illness_no" 
                                            class="text-sm text-gray-800 @error('has_illness') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <label id="illness_label" class="text-sm mt-4 mb-2 block {{ old('has_illness') == 1 ? '' : 'hidden' }}">
                                    If yes, please specify:
                                </label>

                                <input type="text" 
                                    name="if_illness_yes" 
                                    id="if_illness_yes" 
                                    class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('has_illness') == 1 ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('if_illness_yes') }}" style="width: -webkit-fill-available;"
                                    >

                                @if(old('has_illness'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('has_illness')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_illness_yes')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative md:col-span-3 sm:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('has_disability') text-red-700 dark:text-red-500 
                                    @elseif(old('has_disability')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Do you have disability?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_disability" 
                                            value="1" 
                                            id="disability_yes" 
                                            class="mr-2" 
                                            {{ old('has_disability') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'has_disability')">
                                        <label for="disability_yes" 
                                            class="text-sm text-gray-800 @error('has_disability') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="has_disability" 
                                            value="0" 
                                            id="disability_no" 
                                            class="mr-2" 
                                            {{ old('has_disability') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'has_disability')" >
                                        <label for="disability_no" 
                                            class="text-sm text-gray-800 @error('has_disability') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <label id="disability_label" class="text-sm mt-4 mb-2 block {{ old('has_disability') == 1 ? '' : 'hidden' }}">
                                    If yes, please specify:
                                </label>

                                <input type="text" 
                                    name="if_disability_yes" 
                                    id="if_disability_yes" 
                                    class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('has_disability') == 1 ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('if_disability_yes') }}" style="width: -webkit-fill-available;"
                                    >

                                @if(old('has_disability'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
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
                                Identificaiton
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div>
                                <label class="text-sm mb-2 block 
                                    @error('valid_id') text-red-700 dark:text-red-500 
                                    @elseif(old('valid_id')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Valid ID
                                </label>
                                <input name="valid_id" type="file" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('valid_id') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('valid_id')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload image of Valid ID" />
                                
                                @if(old('valid_id'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('valid_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('valid_id'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-sm mb-2 block 
                                    @error('profile_picture') text-red-700 dark:text-red-500 
                                    @elseif(old('profile_picture')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Profile Picture
                                </label>
                                <input name="profile_picture" type="file" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('profile_picture') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('profile_picture')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload photo of Pensioner" />
                                
                                @if(old('profile_picture'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('profile_picture')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('profile_picture'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm mb-2 block 
                                    @error('indigency') text-red-700 dark:text-red-500 
                                    @elseif(old('indigency')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Certificate of Indigency
                                </label>
                                <input name="indigency" type="file" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('indigency') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('indigency')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload photo of Pensioner" />
                                
                                @if(old('indigency'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('indigency')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('indigency'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm mb-2 block 
                                    @error('birth_certificate') text-red-700 dark:text-red-500 
                                    @elseif(old('birth_certificate')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Birth Certificate
                                </label>
                                <input name="birth_certificate" type="file" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('birth_certificate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('birth_certificate')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload photo of Pensioner" />
                                
                                @if(old('birth_certificate'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif
                                @error('birth_certificate')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('birth_certificate'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
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
                                    @error('email') text-red-700 dark:text-red-500 
                                    @elseif(old('email')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Email Address
                                </label>
                                <input name="email" type="email" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('email')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter email" value="{{ old('email') }}" />

                                @if(old('email'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <span class="text-green-500 text-xs mt-2 pl-2">Looks good!</span>
                                @endif
                                @error('email')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-800 text-sm mb-2 block 
                                    @error('password') text-red-700 dark:text-red-500 
                                    @elseif(old('password')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Password
                                </label>
                                <input name="password" type="password" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('password') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('password')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter password" />

                                @if(old('password'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <span class="text-green-500 text-xs mt-2 pl-2">Looks good!</span>
                                @endif
                                @error('password')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-gray-800 text-sm mb-2 block 
                                    @error('password_confirmation') text-red-700 dark:text-red-500 
                                    @elseif(old('password_confirmation')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Confirm Password
                                </label>
                                <input name="password_confirmation" type="password" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('password_confirmation') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 
                                    @elseif(old('password_confirmation')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:placeholder-green-500 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Enter password" />

                                @if(old('password_confirmation'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <span class="text-green-500 text-xs mt-2 pl-2">Looks good!</span>
                                @endif
                                @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">E-Signature</p>
                        </div>

                        <div class="mt-4">
                            <canvas id="sig-canvas" class="border border-gray-300 rounded-md w-full h-32 sm:h-40 md:h-48 lg:h-56"></canvas>
                            <input type="hidden" id="sig-dataUrl" name="signature_data">
                            <img id="sig-image" style="display:none;">
                            <p id="signaturevalidation" style="display:none; color:red;">Please provide your signature.</p>
                            <div class="flex justify-center items-center mt-4">
                                <button type="button" id="sig-clearBtn" class="bg-red-500 text-white px-4 py-2 rounded">Clear Signature</button>
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center mt-8">
                            <div class="col-md-12 text-center"> 
                                <div class="checkbox-container">
                                    <input class="form-check-input checkdrop" type="checkbox" id="confirm-checkbox" name="confirm-checkbox">
                                    <label class="form-check-label1" for="confirm-checkbox" id="confirm-checkbox-label">
                                        I, <span id="full-name-placeholder">{{ old('first_name') }} {{ old('middle_name') }} {{ old('last_name') }}{{ old('suffix') ? ', ' . old('suffix') : '' }}</span>, hereby confirm that the informations provided in the form is accurate
                                    </label>
                                </div>
                                <p id="checkbox-error" class="text-red-500" style="display:none;">This checkbox is required.</p>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-center">
                            <button type="submit" id="submit" name="submit" class="py-3 px-6 w-full md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                Sign up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleInputField(value, type) {
        let additionalInput, additionalIncomeInput, additionalLabel, additionalIncomeLabel;

        if (type === 'pensioner') {
            additionalInput = document.getElementById('if_pensioner_yes');
            const pensionerLabel = document.getElementById('pensioner_label');
            const sourceList = document.getElementById('source_list');

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
            }
        } else if (type === 'permanent_source') {
            additionalInput = document.getElementById('if_permanent_yes');
            additionalIncomeInput = document.getElementById('if_permanent_yes_income');
            const permanentLabel = document.getElementById('permanent_label');
            const permanentIncomeLabel = document.getElementById('permanent_income_label');

            if (value == 1) {
                additionalInput.classList.remove('hidden');
                permanentLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required');

                additionalIncomeInput.classList.remove('hidden');
                permanentIncomeLabel.classList.remove('hidden');
                additionalIncomeInput.setAttribute('required', 'required');
            } else {
                additionalInput.classList.add('hidden');
                permanentLabel.classList.add('hidden');
                additionalInput.removeAttribute('required');
                additionalInput.value = '';

                additionalIncomeInput.classList.add('hidden');
                permanentIncomeLabel.classList.add('hidden');
                additionalIncomeInput.removeAttribute('required');
                additionalIncomeInput.value = ''; 
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
            if (value == 4) {
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
        }
    }

     function toggleCheckboxInputField() {
        const sourceCheckbox = document.querySelector('input[name="source[]"][value="4"]');
        const additionalInput = document.getElementById('other_source_remark');
        const sourceLabel = document.getElementById('other_source_label');

        if (sourceCheckbox.checked) {
            additionalInput.classList.remove('hidden');
            sourceLabel.classList.remove('hidden');
            additionalInput.setAttribute('required', 'required');
        } else {
            additionalInput.classList.add('hidden');
            sourceLabel.classList.add('hidden');
            additionalInput.removeAttribute('required');
            additionalInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const previousPensionerValue = '{{ old("pensioner") }}';
        if (previousPensionerValue == 1) { 
            toggleInputField(1, 'pensioner');
        }

        const sourceCheckbox = document.querySelector('input[name="source[]"][value="4"]');
        if (sourceCheckbox) {
            sourceCheckbox.addEventListener('change', toggleCheckboxInputField);
            toggleCheckboxInputField();
        }

        const previousPermanentSourceValue = '{{ old("permanent_source") }}';
        if (previousPermanentSourceValue == 1) {
            document.getElementById('if_permanent_yes').classList.remove('hidden');
            document.getElementById('permanent_label').classList.remove('hidden');
            document.getElementById('if_permanent_yes_income').classList.remove('hidden');
            document.getElementById('permanent_income_label').classList.remove('hidden');
        }

        const previousLivingArrangementValue = '{{ old("type_of_living_arrangement") }}';
        if (previousLivingArrangementValue == 5) {
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
                <input type="text" name="relative_relationship[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter relationship" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="number" name="relative_age[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <select name="relative_civil_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                    <option value="" disabled>Select status</option>
                    @foreach ($civil_status as $status)
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
            <td class="border border-gray-300 px-4 py-2">
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1v-7a1 1 0 00-1-1H5zm3 2a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1zm5 0a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
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
        
        for (let i = 0; i < rows.length; i++) {
            const removeCell = rows[i].querySelector(`[id^='removeCell-']`);
            removeCell.classList.toggle('hidden', rows.length <= 1);
        }
    }

    updateRemoveIconVisibility(); 
</script>

@include('partials.footer')
