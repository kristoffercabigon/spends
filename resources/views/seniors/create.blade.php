@include('partials.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background_seniors.jfif') }}'); background-attachment: fixed;">
    <div class="bg-white bg-opacity-50 min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[sans-serif]">

            <div class="mx-4 mb-4 -mt-16">
                <div class="max-h-[80vh] overflow-y-auto">
                    <form action="/store" enctype="multipart/form-data" method="POST" class="w-full bg-white shadow-lg sm:pt-2 px-12 py-10 rounded-md">
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
                                <input name="first_name" type="text" value="{{ old('first_name') }}" 
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
                                    @error('last_name') text-red-700 dark:text-red-500 
                                    @elseif(old('last_name')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Last Name/ Huling Pangalan
                                </label>
                                <input name="last_name" type="text" value="{{ old('last_name') }}" 
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
                                    @error('middle_name') text-red-700 dark:text-red-500 
                                    @elseif(old('middle_name')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Middle Name/ Gitnang Pangalan
                                </label>
                                <input name="middle_name" type="text" value="{{ old('middle_name') }}" 
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
                                    @error('suffix') text-red-700 dark:text-red-500 
                                    @elseif(old('suffix')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Suffix/ Karugtong ng Pangalan
                                </label>
                                <input name="suffix" type="text" value="{{ old('suffix') }}" 
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
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 6h6m-8 0h.01M4 7h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                                    </svg>
                                </span>

                                @if(old('birthdate'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif

                                @error('birthdate')
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 6h6m-8 0h.01M4 7h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                                        </svg>
                                    </span>
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
                                    @error('citizenship_id') text-red-700 dark:text-red-500 
                                    @elseif(old('citizenship_id')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Citizenship / Nasyonalidad
                                </label>
                                <select name="citizenship_id" 
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('citizenship_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:text-red-500 dark:border-red-500 
                                    @elseif(old('citizenship_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-green-400 dark:border-green-500 
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled selected>Select citizenship</option>
                                    @foreach($citizenship as $citizenship1)
                                        <option value="{{ $citizenship1->id }}" {{ old('citizenship_id') == $citizenship1->id ? 'selected' : '' }}>
                                            {{ $citizenship1->citizenship_name }} 
                                        </option>
                                    @endforeach
                                </select>
                                @if(old('citizenship_id'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('citizenship_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
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

                        <div class="mt-8 flex justify-center">
                            <button type="submit" class="py-3 px-6 w-full md:w-auto text-sm tracking-wider font-semibold rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                Sign up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials.footer')
