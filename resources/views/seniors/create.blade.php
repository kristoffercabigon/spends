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
                                            <th class="border border-gray-300 px-4 py-2 text-left">Remove</th>
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
                                                        <option value="" disabled selected>Select status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Widowed">Widowed</option>
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
                            <button type="button" onclick="addRow()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md flex items-center justify-center">
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
                            <div class="relative md:col-span-3 sm:col-span-3">
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
                                    >

                                @if(old('pensioner'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('pensioner')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_pensioner_yes')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative md:col-span-3 sm:col-span-3">
                                <label class="text-sm mb-2 block 
                                    @error('source') text-red-700 dark:text-red-500 
                                    @elseif(is_array(old('source')) && count(old('source')) > 0) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Source of Pension
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
                                    If other, please specify:
                                </label>

                                <input type="text"
                                    name="other_source_remark"
                                    id="other_source_remark"
                                    class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all
                                    {{ is_array(old('source')) && in_array(4, old('source')) ? 'md:col-span-4' : 'hidden' }}"
                                    placeholder="Enter additional information"
                                    value="{{ old('other_source_remark') ?? '' }}"
                                    style="width: -webkit-fill-available;">

                                @error('source')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror

                                @error('other_source_remark')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative md:col-span-3 sm:col-span-3">
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

                                <label id="permanent_label" class="text-sm mt-4 mb-2 block {{ old('permanent_source') == 1 ? '' : 'hidden' }}">
                                    If yes, from what source?
                                </label>

                                <input type="text" 
                                    name="if_permanent_yes" 
                                    id="if_permanent_yes" 
                                    class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                    {{ old('permanent_source') == 1 ? '' : 'hidden' }}" 
                                    placeholder="Enter additional information"
                                    value="{{ old('if_permanent_yes') }}" style="width: -webkit-fill-available;"
                                    >

                                @if(old('permanent_source'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('permanent_source')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_permanent_yes')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative md:col-span-4">
                                <label class="text-sm mb-2 block 
                                    @error('regular_support') text-red-700 dark:text-red-500 
                                    @elseif(old('regular_support')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Do you receive regular support from family?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="regular_support" 
                                            value="1" 
                                            id="regular_yes" 
                                            class="mr-2" 
                                            {{ old('regular_support') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'regular_support')">
                                        <label for="regular_yes" 
                                            class="text-sm text-gray-800 @error('regular_support') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="regular_support" 
                                            value="0" 
                                            id="regular_no" 
                                            class="mr-2" 
                                            {{ old('regular_support') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'regular_support')">
                                        <label for="regular_no" 
                                            class="text-sm text-gray-800 @error('regular_support') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">
                                    <div class="w-full md:col-span-2 relative">
                                        <label id="regular_label" class="text-sm mt-4 mb-2 block {{ old('regular_support') == 1 ? '' : 'hidden' }}">
                                            If yes, is it cash? how much and how often?
                                        </label>

                                        <input type="text" 
                                            name="if_cash" 
                                            id="if_cash" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('regular_support') == 1 ? '' : 'hidden' }}" 
                                            placeholder="Enter additional information"
                                            value="{{ old('if_cash') }}" style="width: -webkit-fill-available;"
                                            >
                                    </div>

                                    <div class="md:col-span-2 relative">
                                        <label id="regular_label1" class="text-sm mt-4 mb-2 block {{ old('regular_support') == 1 ? '' : 'hidden' }}">
                                            If yes, then what kind of support aside from cash?
                                        </label>

                                        <input type="text" 
                                            name="specific_support" 
                                            id="specific_support" 
                                            class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('regular_support') == 1 ? '' : 'hidden' }}" 
                                            placeholder="Enter additional information"
                                            value="{{ old('specific_support') }}" style="width: -webkit-fill-available;">
                                    </div>
                                </div>

                                @if(old('regular_support'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif
                                @error('regular_support')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('specific_support')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                                @error('if_cash')
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
                                    @error('hospitalized_6') text-red-700 dark:text-red-500 
                                    @elseif(old('hospitalized_6')) text-green-700 dark:text-green-500 
                                    @else text-gray-800 @enderror">
                                    Have been hospitalized within the last 6 months?
                                </label>

                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="hospitalized_6" 
                                            value="1" 
                                            id="hospitalized_yes" 
                                            class="mr-2" 
                                            {{ old('hospitalized_6') == 1 ? 'checked' : '' }}
                                            onclick="toggleInputField(1, 'hospitalized_6')">
                                        <label for="hospitalized_yes" 
                                            class="text-sm text-gray-800 @error('hospitalized_6') text-red-700 dark:text-red-500 @enderror">
                                            Yes
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-2 md:mr-4">
                                        <input type="radio" 
                                            name="hospitalized_6" 
                                            value="0" 
                                            id="hospitalized_no" 
                                            class="mr-2" 
                                            {{ old('hospitalized_6') === '0' ? 'checked' : '' }}
                                            onclick="toggleInputField(0, 'hospitalized_6')" >
                                        <label for="hospitalized_no" 
                                            class="text-sm text-gray-800 @error('hospitalized_6') text-red-700 dark:text-red-500 @enderror">
                                            No
                                        </label>
                                    </div>
                                </div>
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
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                E-Signature
                            </p>
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

<script>
    function toggleInputField(value, type) {
        let additionalInput;
        if (type === 'pensioner') {
            additionalInput = document.getElementById('if_pensioner_yes');
            const pensionerLabel = document.getElementById('pensioner_label');

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                pensionerLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required'); 
            } else {
                additionalInput.classList.add('hidden');
                pensionerLabel.classList.add('hidden');
                additionalInput.removeAttribute('required'); 
                additionalInput.value = ''; 
            }
        } else if (type === 'permanent_source') {
            additionalInput = document.getElementById('if_permanent_yes');
            const permanentLabel = document.getElementById('permanent_label');

            if (value == 1) {
                additionalInput.classList.remove('hidden');
                permanentLabel.classList.remove('hidden');
                additionalInput.setAttribute('required', 'required');
            } else {
                additionalInput.classList.add('hidden');
                permanentLabel.classList.add('hidden');
                additionalInput.removeAttribute('required');
                additionalInput.value = ''; 
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
        } else if (type === 'regular_support') {
            const cashInput = document.getElementById('if_cash');
            const cashLabel = document.getElementById('regular_label');
            const supportInput = document.getElementById('specific_support');
            const supportLabel = document.getElementById('regular_label1');
            
            if (value == 1) {
                cashInput.classList.remove('hidden');
                cashLabel.classList.remove('hidden');
                supportInput.classList.remove('hidden');
                supportLabel.classList.remove('hidden');
                cashInput.setAttribute('required', 'required');
                supportInput.setAttribute('required', 'required');
            } else {
                cashInput.classList.add('hidden');
                cashLabel.classList.add('hidden');
                supportInput.classList.add('hidden');
                supportLabel.classList.add('hidden');
                cashInput.removeAttribute('required');
                supportInput.removeAttribute('required');
                cashInput.value = '';
                supportInput.value = '';
            }
        } else if (type === 'has_illness') {
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
            document.getElementById('if_pensioner_yes').classList.remove('hidden');
            document.getElementById('pensioner_label').classList.remove('hidden');
        }

        const previousPermanentSourceValue = '{{ old("permanent_source") }}';
        if (previousPermanentSourceValue == 1) {
            document.getElementById('if_permanent_yes').classList.remove('hidden');
            document.getElementById('permanent_label').classList.remove('hidden');
        }

        const previousLivingArrangementValue = '{{ old("type_of_living_arrangement") }}';
        if (previousLivingArrangementValue == 5) {
            document.getElementById('other_arrangement_remark').classList.remove('hidden');
        }

        const previousRegularSupportValue = '{{ old("regular_support") }}';
        if (previousRegularSupportValue == 1) {
            document.getElementById('if_cash').classList.remove('hidden');
            document.getElementById('regular_label').classList.remove('hidden');
            document.getElementById('specific_support').classList.remove('hidden');
            document.getElementById('regular_label1').classList.remove('hidden');
        }

        const previousIllnessValue = '{{ old("has_illness") }}';
        if (previousIllnessValue == 1) { 
            document.getElementById('if_illness_yes').classList.remove('hidden');
            document.getElementById('illness_label').classList.remove('hidden');
        }

        toggleCheckboxInputField();

        const sourceCheckbox = document.querySelector('input[name="source[]"][value="4"]');
        if (sourceCheckbox) {
            sourceCheckbox.addEventListener('change', toggleCheckboxInputField);
        }
    });
</script>

<script>
    let rowCount = 1; 

    function addRow() {
        const table = document.getElementById('familyTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        const rowIndex = rowCount++;

        newRow.innerHTML = `
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
                    <option value="" disabled selected>Select status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="relative_occupation[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="relative_income[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
            </td>
            <td class="border border-gray-300 px-4 py-2 hidden" id="removeCell-${rowIndex}">
                <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 5a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zm1 3a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1v-7a1 1 0 00-1-1H5zm3 2a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1zm5 0a1 1 0 00-1 1v5a1 1 0 102 0v-5a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </td>
        `;
        
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
