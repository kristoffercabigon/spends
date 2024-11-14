@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <div class="min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[sans-serif]">
            <div class="mx-4">
                <div class="bg-white mt-4 shadow-lg rounded-md mb-5 sm:mb-5 relative">
                    <div class="w-full sm:w-[50%] mx-auto relative font-poppins">
                        <div id="progressLeft" class="absolute top-[35%] left-0 h-[2px] z-0 transform -translate-y-1/2 bg-gray-500" style="width: 50%;"></div>
                        <div id="progressRight" class="absolute top-[35%] left-1/2 h-[2px] z-0 transform -translate-y-1/2 bg-gray-500" style="width: 50%;"></div>

                        <ul class="grid grid-cols-2 mx-auto py-2 gap-x-4 md:gap-x-8 w-[100%] relative z-10">
                            <div class="flex flex-col items-center gap-y-2">
                                <li id="navstep1" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-7 min-h-7 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step1">
                                            <span id="step1text">1</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800">Requirements</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2">
                                <li id="navstep2" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-7 min-h-7 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step2">
                                            <span id="step2text">2</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800  text-center">Registration</span>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 sm:mt-8">
                    <div id="content1" class="font-poppins">
                        <div class="max-h-[80vh] shadow-lg mt-[-17px] overflow-y-auto">
                            <div class="w-full bg-white sm:pt-2 px-6 py-10 rounded-md lg:px-12">
                                <div class="text-2xl font-bold mt-[15px] mb-6 leading-tight tracking-tight text-gray-900 md:text-2xl">
                                    <p class="mx-4 text-center">
                                        Requirements <span class="italic">(Mga Kinakailangan)</span>
                                    </p>
                                </div>

                                <hr class="my-8 border-0 h-0.5 bg-gradient-to-r from-transparent via-[#1AA514] to-transparent">

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement1" class="font-semibold text-lg text-red-600 mb-4">NEW APPLICATION:</p>
                                    <p class="text-gray-700 mb-4">(Bagong senior citizen, wala pang senior citizen ID mula sa Caloocan o ibang lugar)</p>

                                    <ol class="list-decimal list-inside space-y-3 text-gray-700 mb-[24px]">
                                        <li class="font-semibold">1x1 (1 piraso)</li>
                                        <li class="font-semibold">Isang (1) kopya ng Birth Certificate, dalhin rin ang orihinal na kopya nito</li>
                                        <li class="font-semibold">Isang (1) kopya ng valid ID na may (Caloocan address) tulad ng:
                                            <ul class="list-disc list-inside pl-5 font-light">
                                                <li>Philippine Passport</li>
                                                <li>Driver's License</li>
                                                <li>UMID Card</li>
                                                <li>Voter's ID</li>
                                                <li>Philhealth ID</li>
                                                <li>Postal ID</li>
                                                <li>OFW ID</li>
                                                <li>National ID</li>
                                            </ul>
                                        </li>
                                        <li class="font-semibold">Orihinal na dokumento ng ALINMAN sa mga sumusunod:
                                            <ul class="list-disc list-inside pl-5 font-light">
                                                <li>Barangay Certification</li>
                                                <li>Certificate of Residency</li>
                                                <li>Barangay Indigency for Senior Citizen Application Purposes</li>
                                            </ul>
                                        </li>
                                    </ol>

                                    <p id="requirement2" class="font-semibold text-lg text-red-600 mb-4">KARAGDAGANG DOKUMENTO:</p>
                                    <ol class="list-decimal list-inside space-y-3 text-gray-700">
                                        <li class="font-semibold">Kung babaeng ikinasal,
                                            <ul class="list-disc list-inside pl-5 space-y-2 font-light">
                                                <li>Isang (1) kopya ng Marriage Certificate, dalhin rin ang orihinal na kopya nito.</li>
                                            </ul>
                                        </li>
                                        <li class="font-semibold">Kung dual citizen/hindi ipinanganak na Pilipino,
                                            <ul class="list-disc list-inside pl-5 space-y-2 font-light">
                                                <li>Identification Certificate mula sa Bureau of Immigration o anumang katibayan ng Filipino citizenship o re-acquisition of citizenship mula sa Philippine Embassy.</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement3" class="font-semibold text-lg text-red-600 mb-4">REPLACEMENT ID (Pagpapapalit)</p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement4" class="font-semibold text-lg text-red-600 mb-4">IF MARRIED (Kung ikinasal)</p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                        <li class="font-semibold">Isang (1) kopya ng Marriage Certificate, dalhin rin ang orihinal na kopya nito</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement5" class="font-semibold text-lg text-red-600 mb-4">IF CHANGE ADDRESS</p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                        <li class="font-semibold">Certificate of Residency mula sa kasalukuyang Barangay</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement6" class="font-semibold text-lg text-red-600 mb-4">LOST ID (Nawala)</p>
                                    <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Kung PVC ang nawala:
                                            <ul class="list-disc list-inside pl-5 space-y-2 font-light">
                                                <li>Affidavit of Loss</li>
                                            </ul>
                                        </li>
                                        <li class="font-semibold">Kung lumang senior ID ang nawala:
                                            <ul class="list-disc list-inside pl-5 space-y-2 font-light">
                                                <li>Isang (1) kopya of Birth Certificate, dalhin rin ang orihinal na kopya nito</li>
                                                <li>Isang (1) kopya ng Valid ID (Caloocan Address)</li>
                                                <li>Affidavit of Loss</li>
                                                <li>Senior Citizen Booklet</li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="content2" class="shadow-lg font-poppins" style="display: none;">
                        <div class="max-h-[80vh] shadow-lg mt-[-17px] overflow-y-auto">
                            <form id="form" action="/store" enctype="multipart/form-data" method="POST" class="w-full bg-white sm:pt-2 px-6 py-10 rounded-md lg:px-12">
                                @csrf
                                <div class="text-2xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                                    <p class="mx-4 text-center">
                                        Registration Form
                                    </p>
                                </div>

                                <hr class="my-8 border-0 h-0.5 bg-gradient-to-r from-transparent via-[#1AA514] to-transparent">

                                <div class="text-xl font-bold mt-8 mb-6 leading-tight tracking-tight text-gray-900 md:text-xl">
                                    <p class="text-left">
                                        Basic Information
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                    <div class="relative">
                                        <label class="text-sm mb-2 block 
                                            @error('first_name') text-red-700 
                                            @elseif(old('first_name')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            First Name <span class="italic"> (Unang Pangalan) </span>
                                        </label>
                                        <input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                            @error('first_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                            @elseif(old('first_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('middle_name') text-red-700 
                                            @elseif(old('middle_name')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Middle Name <span class="italic"> (Gitnang Pangalan) </span>
                                        </label>
                                        <input name="middle_name" id="middle_name" type="text" value="{{ old('middle_name') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                            @error('middle_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                            @elseif(old('middle_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('last_name') text-red-700
                                            @elseif(old('last_name')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Last Name <span class="italic"> (Huling Pangalan) </span>
                                        </label>
                                        <input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                            @error('last_name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                            @elseif(old('last_name')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('suffix') text-red-700 
                                            @elseif(old('suffix')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Suffix <span class="italic"> (Karugtong na Pangalan) </span>
                                        </label>
                                        <input name="suffix" id="suffix" type="text" value="{{ old('suffix') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                            @error('suffix') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                            @elseif(old('suffix')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('birthdate') text-red-700
                                            @elseif(old('birthdate')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Birthdate <span class="italic"> (Kaarawan) </span>
                                        </label>
                                        <input name="birthdate" type="text" id="datepicker" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md cursor-pointer transition-all 
                                            @error('birthdate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                            @elseif(old('birthdate')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                            placeholder="Select birthdate" readonly 
                                            value="{{ old('birthdate') }}" />
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none @error('birthdate') h-[90%] @elseif(old('birthdate')) h-[90%] @else h-[125%] @enderror">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 6h6m-8 0h.01M4 7h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"></path>
                                            </svg>
                                        </span>
                                        @error('birthdate')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @elseif(old('birthdate'))
                                            <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                        @enderror
                                    </div>

                                    <div class="relative">
                                        <label class="text-sm mb-2 block 
                                            @if($errors->has('age') || (old('age') && old('age') < 60)) 
                                                text-red-700 
                                            @elseif(old('age') && old('age') >= 60) 
                                                text-green-700 
                                            @else 
                                                text-gray-800 
                                            @endif">
                                            Age <span class="italic"> (Edad) </span>
                                        </label>

                                        <input name="age" type="text" id="age" value="{{ old('age') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                            @if($errors->has('age') || (old('age') && old('age') < 60)) 
                                                bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('age') && old('age') >= 60) 
                                                bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else 
                                                bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 
                                            @endif" 
                                            placeholder="Age" readonly />

                                        @if(old('age') && old('age') >= 60 && !$errors->has('age'))
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        @endif

                                        @if($errors->has('age') || (old('age') && old('age') < 60))
                                            <p class="text-red-500 text-xs mt-2 p-1">The age must be 60 years old or above.</p>
                                        @elseif(old('age') && old('age') >= 60)
                                            <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                        @endif
                                    </div>

                                    <div class="relative">
                                        <label class="text-sm mb-2 block 
                                            @error('birthplace') text-red-700 
                                            @elseif(old('birthplace')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Birthplace <span class="italic"> (Lugar ng Kapanganakan) </span>
                                        </label>
                                        <input name="birthplace" type="text" value="{{ old('birthplace') }}" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10 
                                            @error('birthplace') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                            @elseif(old('birthplace')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('sex_id') text-red-700
                                            @elseif(old('sex_id')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Sex <span class="italic"> (Kasarian) </span>
                                        </label>
                                        <select name="sex_id" 
                                            class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                            @error('sex_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('sex_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500
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
                                            @error('civil_status_id') text-red-700 
                                            @elseif(old('civil_status_id')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Civil Status
                                        </label>
                                        <select name="civil_status_id" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                            @error('civil_status_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('civil_status_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500 
                                            @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                            <option value="" disabled selected>Select civil status</option>
                                            @foreach($civil_status_list as $civil_status1) 
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
                                            @error('contact_no') text-red-700 
                                            @elseif(old('contact_no')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Contact Number
                                        </label>

                                        <div class="flex">
                                            <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                                +63
                                            </span>
                                            
                                            <input name="contact_no" type="text" value="{{ old('contact_no') }}" 
                                                class="w-full text-sm px-4 py-3 rounded-r-md transition-all pr-10 
                                                @error('contact_no') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                                @elseif(old('contact_no')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('address') text-red-700 
                                            @elseif(old('address')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Home Address <span class="italic"> (Tirahan) </span>
                                        </label>
                                        <input name="address" type="text" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                            @error('address') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                            @elseif(old('address')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                            placeholder="Enter address" value="{{ old('address') }}" />

                                        <span id="tooltip-icon" class="absolute top-[28px] right-0 flex items-center justify-center bg-gray-400 hover:bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-12 cursor-pointer @error('address') h-[44%] @elseif(old('address')) h-[44%] @else h-[63%] @enderror group">
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
                                        @elseif(old('address'))
                                            <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                        @enderror
                                    </div>

                                    <div class="relative">
                                        <label class="text-sm mb-2 block 
                                            @error('barangay_id') text-red-700 
                                            @elseif(old('barangay_id')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Barangay
                                        </label>
                                        <select name="barangay_id" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                            @error('barangay_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('barangay_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500
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
                                            @error('type_of_living_arrangement') text-red-700 
                                            @elseif(old('type_of_living_arrangement')) text-green-700
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
                                                        {{ old('type_of_living_arrangement') == $arrangement->id ? 'checked' : '' }}
                                                        onclick="toggleInputField({{ $arrangement->id }}, 'livingArrangement')">

                                                    <label for="living_arrangement_{{ $arrangement->id }}" 
                                                        class="text-sm text-gray-800 @error('type_of_living_arrangement') text-red-700  @enderror">
                                                        {{ $arrangement->type_of_living_arrangement_list }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <input type="text" 
                                            name="other_arrangement_remark" 
                                            id="other_arrangement_remark" 
                                            class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                            {{ old('type_of_living_arrangement') == 5 ? '' : 'hidden' }}" 
                                            placeholder="Enter additional information"
                                            value="{{ old('other_arrangement_remark') }}" style="width: -webkit-fill-available;">

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
                                                            <input type="text" name="relative_relationship[]" value="{{ old('relative_relationship')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter relationship" style="min-width: 150px;">
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2">
                                                            <input type="number" name="relative_age[]" value="{{ old('relative_age')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                                                        </td>
                                                        <td class="border border-gray-300 px-4 py-2">
                                                            <select name="relative_civil_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                                                                <option value="" disabled>Select status</option>
                                                                @foreach ($civil_status_list as $status)
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
                                            @elseif(old('pensioner')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Are you a pensioner? <span class="italic"> (Ikaw ba ay kasalukuyang tumatanggap ng pensyon?) </span>
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            <div class="flex items-center mb-2 md:mr-4"> 
                                                <input type="radio" 
                                                    name="pensioner" 
                                                    value="1" 
                                                    id="pensioner_yes" 
                                                    class="mr-2 shadow-md" 
                                                    {{ old('pensioner') == 1 ? 'checked' : '' }}
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
                                                    {{ old('pensioner') === '0' ? 'checked' : '' }}
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
                                                    If yes, how much pension do you receive? <span class="italic"> (Kung oo, magkano ang iyong natatanggap?) </span>
                                                </label>

                                                <select name="if_pensioner_yes" 
                                                        id="if_pensioner_yes" 
                                                        class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                                        {{ old('pensioner') == 1 ? '' : 'hidden' }}" 
                                                        style="width: -webkit-fill-available;"
                                                        {{ old('pensioner') == 1 ? 'required' : '' }}>
                                                    <option value="" disabled selected>Select pension amount</option>
                                                    @foreach($pensions as $pension)
                                                        <option value="{{ $pension->id }}" {{ old('if_pensioner_yes') == $pension->id ? 'selected' : '' }}>
                                                            {{ $pension->how_much_pension }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('if_pensioner_yes')
                                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="md:col-span-2 relative {{ old('pensioner') == 1 ? '' : 'hidden' }}" id="source_list">
                                                <label id="source_label" class="text-sm text-gray-800 mt-4 mb-2 block">
                                                    If yes, from what source? <span class="italic"> (Kung oo, mula saan?) </span>
                                                </label>

                                                <div class="flex flex-col md:flex-row md:flex-wrap">
                                                    @foreach($sources as $source)
                                                        <div class="flex items-center mb-2 md:mr-4">
                                                            <input type="checkbox"
                                                                name="source[]"
                                                                value="{{ $source->id }}"
                                                                id="{{ $source->id }}"
                                                                class="mr-2 shadow-md source-checkbox"
                                                                {{ is_array(old('source')) && in_array($source->id, old('source')) ? 'checked' : '' }}
                                                                onclick="toggleCheckboxInputField()">

                                                            <label for="{{ $source->id }}"
                                                                class="text-sm text-gray-800 @error('source') text-red-700 @enderror">
                                                                {{ $source->source_list }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <label id="other_source_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ is_array(old('source')) && in_array(4, old('source')) ? '' : 'hidden' }}">
                                                    If others, please specify: <span class="italic"> (Kung iba, pakitukoy:) </span>
                                                </label>

                                                @php
                                                    $oldSource = old('source');
                                                    $isOtherSourceSelected = is_array($oldSource) && end($oldSource) == $sources->last()->id;
                                                @endphp

                                                <input type="text"
                                                    name="other_source_remark"
                                                    id="other_source_remark"
                                                    class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all
                                                    {{ $isOtherSourceSelected ? '' : 'hidden' }}"
                                                    placeholder="Enter additional information"
                                                    value="{{ old('other_source_remark') ?? '' }}"
                                                    style="width: -webkit-fill-available;"
                                                    {{ $isOtherSourceSelected ? 'required' : '' }}>

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
                                            @elseif(old('permanent_source')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Do you have permanent source of income? <span class="italic"> (Ikaw ba ay may pinagkakakitaan?) </span>
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            <div class="flex items-center mb-2 md:mr-4">
                                                <input type="radio" 
                                                    name="permanent_source" 
                                                    value="1" 
                                                    id="permanent_yes" 
                                                    class="mr-2 shadow-md" 
                                                    {{ old('permanent_source') == 1 ? 'checked' : '' }}
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
                                                    {{ old('permanent_source') === '0' ? 'checked' : '' }}
                                                    onclick="toggleInputField(0, 'permanent_source')">
                                                <label for="permanent_no" 
                                                    class="text-sm text-gray-800 @error('permanent_source') text-red-700 @enderror">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                        <div class="md:grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">

                                            <div class="md:col-span-2 text-gray-800 relative">
                                                <label id="permanent_income_label" class="text-sm mt-4 mb-2 block {{ old('permanent_source') == 1 ? '' : 'hidden' }}">
                                                    If yes, how much income? <span class="italic"> (Kung oo, magkano and iyong kinikita?) </span>
                                                </label>

                                                <select name="if_permanent_yes_income" 
                                                        id="if_permanent_yes_income" 
                                                        class="bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all 
                                                        {{ old('permanent_source') == 1 ? '' : 'hidden' }}" 
                                                        style="width: -webkit-fill-available;"
                                                        {{ old('permanent_source') == 1 ? 'required' : '' }}>
                                                    <option value="" disabled selected>Select income amount</option>
                                                    @foreach($incomes as $income)
                                                        <option value="{{ $income->id }}" {{ old('if_permanent_yes_income') == $income->id ? 'selected' : '' }}>
                                                            {{ $income->how_much_income }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="md:col-span-2 relative {{ old('permanent_source') == 1 ? '' : 'hidden' }}" id="income_source_list">
                                                <label id="income_source_label" class="text-sm text-gray-800 mt-4 mb-2 block">
                                                    If yes, from what source? <span class="italic">(Kung oo, mula saan?)</span>
                                                </label>

                                                <div class="flex flex-col md:flex-col mt-4 md:flex-wrap">
                                                    @foreach($income_sources as $income_source)
                                                        <div class="flex items-center mb-2 md:mr-4">
                                                            <input type="checkbox"
                                                                name="income_source[]"
                                                                value="{{ $income_source->id }}"
                                                                id="{{ $income_source->id }}"
                                                                class="mr-2 shadow-md income-source-checkbox"
                                                                {{ is_array(old('income_source')) && in_array($income_source->id, old('income_source')) ? 'checked' : '' }}
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
                                                    If others, please specify: <span class="italic"> (Kung iba, pakitukoy:) </span>
                                                </label>

                                                @php
                                                    $oldIncomeSource = old('income_source');
                                                    $isOtherIncomeSourceSelected = is_array($oldIncomeSource) && end($oldIncomeSource) == $income_sources->last()->id;
                                                @endphp

                                                <input type="text"
                                                    name="other_income_source_remark"
                                                    id="other_income_source_remark"
                                                    class="mt-4 bg-gray-100 focus:bg-transparent text-sm px-4 py-3 rounded-md transition-all
                                                    {{ $isOtherIncomeSourceSelected ? '' : 'hidden' }}"
                                                    placeholder="Enter additional information"
                                                    value="{{ old('other_income_source_remark') ?? '' }}"
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
                                            @elseif(old('has_illness')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Do you have an existing illness? <span class="italic"> (Ikaw ba ay may kasalukuyang sakit?) </span>
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            <div class="flex items-center mb-2 md:mr-4">
                                                <input type="radio" 
                                                    name="has_illness" 
                                                    value="1" 
                                                    id="illness_yes" 
                                                    class="mr-2 shadow-md" 
                                                    {{ old('has_illness') == 1 ? 'checked' : '' }}
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
                                                    {{ old('has_illness') === '0' ? 'checked' : '' }}
                                                    onclick="toggleInputField(0, 'has_illness')" >
                                                <label for="illness_no" 
                                                    class="text-sm text-gray-800 @error('has_illness') text-red-700 @enderror">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                        <label id="illness_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ old('has_illness') == 1 ? '' : 'hidden' }}">
                                            If yes, please specify: <span class="italic"> (Kung oo, pakitukoy:) </span>
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
                                            @error('has_disability') text-red-700
                                            @elseif(old('has_disability')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Do you have disability? <span class="italic"> (Ikaw ba ay may kapansanan?) </span>
                                        </label>

                                        <div class="flex flex-col md:flex-row md:flex-wrap">
                                            <div class="flex items-center mb-2 md:mr-4">
                                                <input type="radio" 
                                                    name="has_disability" 
                                                    value="1" 
                                                    id="disability_yes" 
                                                    class="mr-2 shadow-md" 
                                                    {{ old('has_disability') == 1 ? 'checked' : '' }}
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
                                                    {{ old('has_disability') === '0' ? 'checked' : '' }}
                                                    onclick="toggleInputField(0, 'has_disability')" >
                                                <label for="disability_no" 
                                                    class="text-sm text-gray-800 @error('has_disability') text-red-700 @enderror">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                        <label id="disability_label" class="text-sm text-gray-800 mt-4 mb-2 block {{ old('has_disability') == 1 ? '' : 'hidden' }}">
                                            If yes, please specify: <span class="italic"> (Kung oo, pakitukoy:) </span>
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
                                        Identification
                                    </p>
                                </div>

                                <div class="text-sm mt-8 text-gray-800 font-semibold">
                                    <div class="flex items-center">
                                        <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                        <p class="text-left">
                                            Note: documents or files uploaded must be clear; otherwise, it may hinder the approval of your account.
                                        </p>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                        <p class="mt-2 text-left italic">
                                            Paalala: ang mga dokumento o files na ipapasa ay kailangang malinaw at klaro; kung hindi, maaari itong maging hadlang sa pag-apruba ng iyong account.
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                    <div x-data="{
                                        showValidIdModal: false,
                                        validIdPreviewUrl: '', // Corrected to use 'validIdPreviewUrl'
                                        previewValidIdImage(event) {
                                            const input = event.target;
                                            if (input.files && input.files[0]) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    this.validIdPreviewUrl = e.target.result; // Correct variable name
                                                    document.getElementById('valid_id_preview').style.display = 'block';
                                                };
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                    }">
                                        <label class="text-sm mb-2 block 
                                            @error('valid_id') text-red-700 
                                            @elseif(old('valid_id')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Valid ID
                                        </label>
                                        <input id="valid_id_input" name="valid_id" type="file" accept="image/*"
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                            @error('valid_id') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                            @elseif(old('valid_id')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                            placeholder="Upload image of Valid ID" @change="previewValidIdImage">

                                        <p id="valid_id_filename" class="text-gray-700 text-xs mt-2"></p>

                                        <div class="flex justify-center items-center mt-4">
                                            <img :src="validIdPreviewUrl" id="valid_id_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                style="display: none;" alt="Valid ID Preview" @click="showValidIdModal = true">
                                        </div>

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

                                        @include('components.modal.senior_citizen.validid_zoom')
                                    </div>
                                    
                                    <div x-data="{
                                            showCameraModal: false,
                                            showProfilePicModal: false,
                                            previewUrl: '',
                                            previewImage(event) {
                                                const input = event.target;
                                                if (input.files && input.files[0]) {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        this.previewUrl = e.target.result;
                                                        document.getElementById('profile_picture_preview').style.display = 'block';
                                                    };
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        }" 
                                        @open-camera-modal.window="showCameraModal = true; localStorage.setItem('showCameraModal', 'true')" 
                                        @close-camera-modal.window="showCameraModal = false; localStorage.setItem('showCameraModal', 'false')">

                                        <label class="text-sm mb-2 block 
                                            @error('profile_picture') text-red-700
                                            @elseif(old('profile_picture')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Profile Picture
                                        </label>

                                        <div class="relative">
                                            <input name="profile_picture" type="file" 
                                                class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all 
                                                @error('profile_picture') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                                @elseif(old('profile_picture')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                                @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                                placeholder="Upload photo of Pensioner" id="profilePictureField" 
                                                @change="previewImage">

                                            <button @click="$dispatch('open-camera-modal')" 
                                                    class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12" 
                                                    type="button">
                                                <img src="../images/camera.png" alt="Toggle Profile Picture" class="hover:animate-jiggle camera-icon w-7 h-7" id="toggleCameraIcon">
                                            </button>
                                        </div>

                                        <p id="profile_picture_filename" class="text-gray-700 text-xs mt-2"></p>

                                        <div class="flex justify-center items-center mt-4">
                                            <img :src="previewUrl" id="profile_picture_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" style="display: none;" alt="Profile Picture Preview"
                                                @click="showProfilePicModal = true">
                                        </div>

                                        @if(old('profile_picture'))
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        @endif

                                        @error('profile_picture')
                                            <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                        @elseif(old('profile_picture'))
                                            <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                        @enderror

                                        @include('components.modal.senior_citizen.register_camera')
                                        @include('components.modal.senior_citizen.profilepic_zoom')
                                    </div>

                                    <div x-data="{
                                            showIndigencyModal: false,
                                            indigencyPreviewUrl: '',
                                            previewIndigencyImage(event) {
                                                const input = event.target;
                                                if (input.files && input.files[0]) {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        this.indigencyPreviewUrl = e.target.result;
                                                        document.getElementById('indigency_preview').style.display = 'block';
                                                    };
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        }">
                                        <label class="text-sm mb-2 block 
                                            @error('indigency') text-red-700 
                                            @elseif(old('indigency')) text-green-700 
                                            @else text-gray-800 @enderror">
                                            Certificate of Indigency
                                        </label>
                                        <input id="indigency_input" name="indigency" type="file" accept="image/*"
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                            @error('indigency') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 
                                            @elseif(old('indigency')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                            placeholder="Upload photo of Pensioner" @change="previewIndigencyImage">

                                        <p id="indigency_filename" class="text-gray-700 text-xs mt-2"></p>

                                        <div class="flex justify-center items-center mt-4">
                                            <img :src="indigencyPreviewUrl" id="indigency_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                style="display: none;" alt="Indigency Certificate Preview" @click="showIndigencyModal = true">
                                        </div>

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

                                        @include('components.modal.senior_citizen.indigency_zoom')
                                    </div>

                                    <div x-data="{
                                            showBirthCertificateModal: false,
                                            birthCertificatePreviewUrl: '',
                                            previewBirthCertificateImage(event) {
                                                const input = event.target;
                                                if (input.files && input.files[0]) {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => {
                                                        this.birthCertificatePreviewUrl = e.target.result;
                                                        document.getElementById('birth_certificate_preview').style.display = 'block';
                                                    };
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        }">
                                        <label class="text-sm mb-2 block 
                                            @error('birth_certificate') text-red-700 
                                            @elseif(old('birth_certificate')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Birth Certificate
                                        </label>
                                        <input id="birth_certificate_input" name="birth_certificate" type="file" accept="image/*"
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                            @error('birth_certificate') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('birth_certificate')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                            @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                            placeholder="Upload photo of Birth Certificate" @change="previewBirthCertificateImage">

                                        <p id="birth_certificate_filename" class="text-gray-700 text-xs mt-2"></p>

                                        <div class="flex justify-center items-center mt-4">
                                            <img :src="birthCertificatePreviewUrl" id="birth_certificate_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                style="display: none;" alt="Birth Certificate Preview" @click="showBirthCertificateModal = true">
                                        </div>

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

                                        @include('components.modal.senior_citizen.birthcertificate_zoom')
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
                                            @elseif(old('email')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Email Address
                                        </label>
                                        <input name="email" type="email" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                            @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                            @elseif(old('email')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
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
                                            @error('password') text-red-700 
                                            @elseif(old('password')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Password
                                        </label>
                                        <div class="relative">
                                            <div class="flex">
                                                <input name="password" type="password" 
                                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all 
                                                    @error('password') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                                    @elseif(old('password')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                                    @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                                    placeholder="Enter password" id="passwordField" oninput="updatePasswordCriteria(this.value)"/>

                                                <button class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-12 hover:bg-gray-600 @error('password') h-[27%]  @else h-[33%] @enderror" 
                                                    type="button" onclick="togglePassword('passwordField', 'togglePasswordIcon1')">
                                                    <img src="../images/hide.png" alt="Show Password" class="eye-icon w-7 h-7 hover:animate-jiggle" id="togglePasswordIcon1">
                                                </button>
                                            </div>

                                            <div class="ml-2 mt-4 text-gray-800 text-sm">
                                                <ul>
                                                    <li id="minLength"><i class="fas fa-times text-red-500"></i> Minimum 8 characters</li>
                                                    <li id="uppercase"><i class="fas fa-times text-red-500"></i> At least one uppercase letter</li>
                                                    <li id="lowercase"><i class="fas fa-times text-red-500"></i> At least one lowercase letter</li>
                                                    <li id="symbol"><i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)</li>
                                                </ul>
                                            </div>

                                            @if(old('password'))
                                                <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </span>
                                                <span class="text-green-500 text-xs mt-2 pl-2">Looks good!</span>
                                            @endif
                                            @error('password')
                                                <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-gray-800 text-sm mb-2 block 
                                            @error('password_confirmation') text-red-700
                                            @elseif(old('password_confirmation')) text-green-700
                                            @else text-gray-800 @enderror">
                                            Confirm Password
                                        </label>
                                        <div class="relative">
                                            <div class="flex">
                                                <input name="password_confirmation" type="password" 
                                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                                    @error('password_confirmation') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500
                                                    @elseif(old('password_confirmation')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                                    placeholder="Confirm password" id="passwordConfirmationField" />

                                                <button class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12 h-full" type="button" id="button-addon2" onclick="togglePassword('passwordConfirmationField', 'togglePasswordIcon2')">
                                                    <img src="../images/hide.png" alt="Show Password" class="eye-icon w-7 h-7 hover:animate-jiggle" id="togglePasswordIcon2">
                                                </button>
                                            </div>
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
                                </div>

                                <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                    <p class="text-left">E-Signature</p>
                                </div>

                                <div class="mt-4 text-center">
                                    <canvas id="sig-canvas" class="border border-gray-500 shadow-md rounded-md w-full h-32 sm:h-40 md:h-48 lg:h-56"></canvas>
                                    <input type="hidden" id="sig-dataUrl" name="signature_data">
                                    <img id="sig-image" style="display:none;">
                                    <p id="signaturevalidation" class="text-sm mt-2 text-red-500" style="display:none;">Please provide your signature.</p>
                                    <div class="flex justify-center items-center mt-4">
                                        <button type="button" id="sig-clearBtn" class="py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none">Clear Signature</button>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center mt-8"> 
                                    <div class="col-md-12 text-center"> 
                                        <div class="checkbox-container">
                                            <input class="form-check-input checkdrop shadow-md w-6 h-6" type="checkbox" id="confirm-checkbox" name="confirm-checkbox" 
                                                {{ old('confirm-checkbox') ? 'checked' : '' }}>
                                        </div>
                                        <div class="mt-4">
                                            <label class="form-check-label1 text-gray-800" id="confirm-checkbox-label" onclick="event.preventDefault();">
                                                I, <span id="full-name-placeholder">{{ old('first_name') }} {{ old('middle_name') }} {{ old('last_name') }}{{ old('suffix') ? ', ' . old('suffix') : '' }}</span>, hereby confirm that the above-mentioned information is true and correct to the best of my knowledge; and hereby authorized the verification of the details provided herein.
                                            </label>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-check-label1 text-gray-800" style="font-style: italic;">
                                                Ako si <span id="full-name-placeholder-2">{{ old('first_name') }} {{ old('middle_name') }} {{ old('last_name') }}{{ old('suffix') ? ', ' . old('suffix') : '' }}</span> at aking pinatutunayan na ang mga nakasaad na impormasyon ay totoo at tama sa abot ng aking kaalaman; at sa pamamagitan nito ay pinahihintulutan ko ang pagpapatunay ng mga detalyeng ibinigay dito.
                                            </label>
                                        </div>

                                        @if ($errors->has('confirm-checkbox'))
                                            <p class="text-red-500 text-sm mt-2">{{ $errors->first('confirm-checkbox') }}</p>
                                        @else
                                            <p id="checkbox-error" class="text-red-500" style="display:none;">This checkbox is required.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-8 p-4 border border-gray-400 rounded-lg bg-gray-100 text-gray-800">
                                    <div class="text-center">
                                        <h3 class="text-lg font-bold">DATA PRIVACY</h3>
                                    </div>
                                    <p class="mt-4 text-justify text-indent">
                                        In compliance with the provisions of Republic Act No. 10173, also known as the Data Privacy Act of 2012 and its implementing Rules and Regulations (IRR), the Department of Social Welfare and Development (DSWD) ensures that the personal information provided is collected and processed by authorized personnel and is only used for the implementation of the Social Pension for Indigent Senior Citizens (SPISC) Program as mandated under Republic Act No. 9994.
                                    </p>
                                    <p class="mt-4 text-justify text-indent italic">
                                        Bilang alinsunod sa mga probisyon ng Batas Republika No. 10173, na kilala rin bilang Data Privacy Act of 2012 at ang Implementing Rules and Regulations (IRR) nito, tinitiyak ng Department of Social Welfare and Development (DSWD) na ang personal na impormasyong ibinigay ay kinokolekta at pinoproseso ng awtorisadong mga tauhan at ginagamit lamang para sa pagpapatupad ng Social Pension for Indigent Senior Citizens (SPISC) Program ayon sa mandato sa ilalim ng Batas Republika No. 9994.
                                    </p>
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
                                        Sign up
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-3 mb-8 flex justify-between items-center">
                    <div>
                        <button type="button" id="backButton" class="hover:animate-scale py-3 px-6 shadow-lg text-sm tracking-wider font-light rounded-md text-gray-800 bg-white border border-gray-200 shadow-sm hover:bg-gray-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                            <svg class="shrink-0 w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 18l-6-6 6-6"></path>
                            </svg>
                            Back
                        </button>
                    </div>
                    <div>
                        <button type="button" id="nextButton" class="hover:animate-scale py-3 px-6 shadow-lg text-sm tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148e10] focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                            Next
                            <svg class="shrink-0 w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6"></path>
                            </svg>
                        </button>
                    </div>
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

    function toggleCheckboxInputField() {
        const lastSourceId = {{ $sources->last()->id }};
        const sourceCheckbox = document.querySelector(`input[name="source[]"][value="${lastSourceId}"]`);
        const additionalInput = document.getElementById('other_source_remark');
        const sourceLabel = document.getElementById('other_source_label');

        if (sourceCheckbox && sourceCheckbox.checked) {
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
        if (sourceCheckbox) {
            sourceCheckbox.addEventListener('change', toggleCheckboxInputField);
            toggleCheckboxInputField();
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
                    <img src="images/trashbin.png" alt="Delete" class="h-5 w-5" />
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

    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.src = "../images/show.png"; 
        } else {
            passwordField.type = "password";
            icon.src = "../images/hide.png"; 
        }
    }

    function updatePasswordCriteria(password) {
        document.getElementById("minLength").innerHTML = 
            password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Minimum 8 characters' : 
            '<i class="fas fa-times text-red-500"></i> Minimum 8 characters';
        
        document.getElementById("uppercase").innerHTML = 
            /[A-Z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one uppercase letter' : 
            '<i class="fas fa-times text-red-500"></i> At least one uppercase letter';
        
        document.getElementById("lowercase").innerHTML = 
            /[a-z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one lowercase letter' : 
            '<i class="fas fa-times text-red-500"></i> At least one lowercase letter';
        
        document.getElementById("symbol").innerHTML = 
            /[@$!%*?&]/.test(password) ? '<i class="fas fa-check text-green-500"></i> At least one symbol (@$!%*?&)' : 
            '<i class="fas fa-times text-red-500"></i> At least one symbol (@$!%*?&)';
    }

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

    document.getElementById('profilePictureField').addEventListener('change', function() {
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

<script>
    let currentStep = localStorage.getItem('currentStep') ? parseInt(localStorage.getItem('currentStep')) : 1; 
    let scrollPosition = localStorage.getItem('scrollPosition') ? parseInt(localStorage.getItem('scrollPosition')) : 0;

    window.scrollTo(0, scrollPosition);

    function saveScrollPosition() {
        localStorage.setItem('scrollPosition', window.scrollY);
    }

    window.addEventListener('scroll', saveScrollPosition);

    function updateButtonVisibility() {
        const backButton = document.getElementById('backButton');
        const nextButton = document.getElementById('nextButton');

        backButton.style.display = currentStep === 1 ? 'none' : 'inline-flex';
        nextButton.style.display = currentStep === 2 ? 'none' : 'inline-flex';
    }

    function updateStepStyles() {
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step1text = document.getElementById('step1text');
        const step2text = document.getElementById('step2text');
        const progressLeft = document.getElementById('progressLeft');
        const progressRight = document.getElementById('progressRight');


        step1.style.backgroundColor = '#A1A1AA'; 
        step2.style.backgroundColor = '#A1A1AA'; 
        step1text.style.color = '#fff';
        step2text.style.color = '#fff';
        progressLeft.style.backgroundColor = '#A1A1AA';
        progressRight.style.backgroundColor = '#A1A1AA';

        if (currentStep === 1) {
            step1.style.backgroundColor = '#1AA514';
            step1text.style.color = '#fff';  
            progressLeft.style.width = '50%'; 
            progressLeft.style.backgroundColor = '#1AA514';
        } else if (currentStep === 2) {
            step1.style.backgroundColor = '#1AA514';
            step2.style.backgroundColor = '#1AA514';
            step2text.style.color = '#fff'; 
            progressLeft.style.width = '50%';
            progressLeft.style.backgroundColor = '#1AA514';
            progressRight.style.backgroundColor = '#1AA514';
        }
    }

    document.getElementById('nextButton').addEventListener('click', function() {
        if (currentStep === 1) {
            document.getElementById('content1').style.display = 'none';
            document.getElementById('content2').style.display = 'block';
            currentStep++;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
        }
    });

    document.getElementById('backButton').addEventListener('click', function() {
        if (currentStep === 2) {
            document.getElementById('content2').style.display = 'none';
            document.getElementById('content1').style.display = 'block';
            currentStep--;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
        }
    });

    updateButtonVisibility();
    updateStepStyles();

    if (currentStep === 2) {
        document.getElementById('content1').style.display = 'none';
        document.getElementById('content2').style.display = 'block';
    } else {
        document.getElementById('content1').style.display = 'block';
        document.getElementById('content2').style.display = 'none';
    }
</script>

@include('partials.senior_citizen.footer')
