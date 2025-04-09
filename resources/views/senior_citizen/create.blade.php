@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <ul id="circles" class="circles absolute">
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
    <div class="min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[sans-serif]">
            <div class="mx-4">
                <div class="bg-white mt-4 shadow-lg rounded-md mb-5 sm:mb-5 relative">
                    <div class="w-full sm:w-[80%] mx-auto relative font-poppins">
                        <div class="absolute left-0 h-[2px] z-0 transform -translate-y-1/2 bg-gray-500 top-[50%] lg:top-[35%]" id="progress1" style="width: 20%;"></div>
                        <div class="absolute left-[20%] h-[2px] z-0 transform -translate-y-1/2 bg-gray-500 top-[50%] lg:top-[35%]" id="progress2" style="width: 20%;"></div>
                        <div class="absolute left-[40%] h-[2px] z-0 transform -translate-y-1/2 bg-gray-500 top-[50%] lg:top-[35%]" id="progress3" style="width: 20%;"></div>
                        <div class="absolute left-[60%] h-[2px] z-0 transform -translate-y-1/2 bg-gray-500 top-[50%] lg:top-[35%]" id="progress4" style="width: 20%;"></div>
                        <div class="absolute left-[80%] h-[2px] z-0 transform -translate-y-1/2 bg-gray-500 top-[50%] lg:top-[35%]" id="progress5" style="width: 20%;"></div>

                        <ul class="flex justify-between items-center mx-auto py-2 w-full relative z-10">
                            <div class="flex flex-col items-center gap-y-2 w-1/5">
                                <li id="navstep1" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-8 min-h-8 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step1">
                                            <span id="step1text">1</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 hidden lg:block">Requirements</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2 w-1/5">
                                <li id="navstep2" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-8 min-h-8 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step2">
                                            <span id="step2text">2</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 hidden lg:block text-center">Personal Information</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2 w-1/5">
                                <li id="navstep3" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-8 min-h-8 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step3">
                                            <span id="step3text">3</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 hidden lg:block text-center">Background</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2 w-1/5">
                                <li id="navstep4" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-8 min-h-8 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step4">
                                            <span id="step4text">4</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 hidden lg:block text-center">Status</span>
                                </li>
                            </div>

                            <div class="flex flex-col items-center gap-y-2 w-1/5">
                                <li id="navstep5" class="flex flex-col items-center gap-y-2 group">
                                    <span class="min-w-8 min-h-8 inline-flex items-center justify-center text-s align-middle">
                                        <span class="size-9 flex justify-center items-center bg-gray-100 font-medium text-gray-800 shadow-md rounded-full group-focus:bg-gray-200" id="step5">
                                            <span id="step5text">5</span>
                                        </span>
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 hidden lg:block text-center">Verification</span>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 relative sm:mt-8">
                    <div id="content1" class="font-poppins">
                        <div class="shadow-lg mt-[-17px]">
                            <div class="w-full bg-white sm:pt-2 px-6 py-10 rounded-md lg:px-12">
                                <div class="text-2xl font-bold mt-[15px] mb-6 leading-tight tracking-tight text-gray-900 md:text-2xl">
                                    <p class="mx-4 text-center">
                                        Requirements <span class="italic">(Mga Kinakailangan)</span>
                                    </p>
                                </div>

                                <hr class="my-8 border-0 h-0.5 bg-gradient-to-r from-transparent via-[#1AA514] to-transparent">

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement1" class="font-semibold text-xl text-red-600 mb-4">NEW APPLICATION:</p>
                                    <p class="text-gray-700 text-lg mb-4">(Bagong senior citizen, wala pang senior citizen ID mula sa Caloocan o ibang lugar)</p>

                                    <ol class="list-decimal list-inside text-lg space-y-3 text-gray-700 mb-[24px]">
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

                                    <p id="requirement2" class="font-semibold text-xl text-red-600 mb-4">KARAGDAGANG DOKUMENTO:</p>
                                    <ol class="list-decimal list-inside text-lg space-y-3 text-gray-700">
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
                                    <p id="requirement3" class="font-semibold text-xl text-red-600 mb-4">REPLACEMENT ID (Pagpapapalit)</p>
                                    <ol class="list-decimal text-lg list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement4" class="font-semibold text-xl text-red-600 mb-4">IF MARRIED (Kung ikinasal)</p>
                                    <ol class="list-decimal text-lg list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                        <li class="font-semibold">Isang (1) kopya ng Marriage Certificate, dalhin rin ang orihinal na kopya nito</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement5" class="font-semibold text-xl text-red-600 mb-4">IF CHANGE ADDRESS</p>
                                    <ol class="list-decimal text-lg list-inside space-y-2 text-gray-700">
                                        <li class="font-semibold">Lumang senior citizen ID (orihinal)</li>
                                        <li class="font-semibold">Certificate of Residency mula sa kasalukuyang Barangay</li>
                                    </ol>
                                </div>

                                <div class="bg-gray-100 border border-gray-400 p-6 rounded-md mt-6">
                                    <p id="requirement6" class="font-semibold text-xl text-red-600 mb-4">LOST ID (Nawala)</p>
                                    <ol class="list-decimal text-lg list-inside space-y-2 text-gray-700">
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
                    <form id="form" action="/store" enctype="multipart/form-data" method="POST" class="shadow-lg font-poppins" >
                        <div id="content2" class="w-full bg-white shadow-lg mt-[-17px] sm:pt-2 px-6 py-10 rounded-md lg:px-12" style="display: none;">

                            @csrf
                            <div class="text-2xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                                <p class="mx-4 text-center">
                                    Registration Form
                                </p>
                            </div>

                            <hr class="my-8 border-0 h-0.5 bg-gradient-to-r from-transparent via-[#1AA514] to-transparent">

                            <div class="text-md font-semibold mt-8 mb-6 leading-tight tracking-tight text-gray-900 md:text-md">
                                <p class="text-right">
                                    <div class="flex items-center justify-end">
                                        Required Field -
                                        <img src="images/asterisk.png" alt="Asterisk" class="w-4 h-4 ml-2">
                                    </div>
                                </p>
                            </div>

                            <div class="text-lg mt-8 text-gray-800 font-semibold">
                                <div class="flex items-center mt-4">
                                    <img src="images/warning.png" alt="Info Icon" class="w-4 h-4 mr-1"> 
                                    <p class="text-left">
                                        Note: If you are already an OSCA member, please provide your existing OSCA ID. If not, you may skip this part.
                                    </p>
                                </div>
                                
                                <div class="flex items-center">
                                    <img src="images/warning.png" alt="Info Icon" class="w-4 h-4 mr-1"> 
                                    <p class="mt-2 text-left italic">
                                        Paalala: Kung ikaw ay miyembro na ng OSCA, pakilagay ang kasalukuyang OSCA ID. Kung hindi, maaari nang laktawan ang bahaging ito.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="relative">
                                    <label id="oscaMemberLabel" class="text-md mt-4 mb-2 block text-gray-800">
                                        OSCA ID
                                    </label>
                                    <input 
                                        name="osca_id" 
                                        id="osca_id" 
                                        type="text" 
                                        value="{{ old('osca_id') }}" 
                                        class="w-full text-md px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter OSCA ID here"
                                    />
                                    <span 
                                        id="oscaMemberIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconOscaMember" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconOscaMember" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="oscaMemberMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="text-xl font-bold mt-8 mb-6 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Personal Information
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="first_name_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="firstNameLabel" class="text-lg text-gray-800">
                                            Unahang Pangalan
                                        </label>
                                    </div>
                                    <input 
                                        name="first_name" 
                                        id="first_name" 
                                        type="text" 
                                        value="{{ old('first_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter first name"
                                    />
                                    <span 
                                        id="firstNameIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconFirstName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconFirstName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="firstNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                     <div class="flex items-center mb-2">
                                        <label id="middleNameLabel" class="text-lg text-gray-800">
                                            Gitnang Pangalan
                                        </label>
                                    </div>
                                    <input 
                                        name="middle_name" 
                                        id="middle_name" 
                                        type="text" 
                                        value="{{ old('middle_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter middle name"
                                    />
                                    <span id="middleNameIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconMiddleName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconMiddleName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="middleNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="last_name_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="lastNameLabel" class="text-lg text-gray-800">
                                            Hulihang Pangalan
                                        </label>
				                    </div>
                                    <input 
                                        name="last_name" 
                                        id="last_name" 
                                        type="text" 
                                        value="{{ old('last_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter last name"
                                    />
                                    <span id="lastNameIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconLastName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconLastName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="lastNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                     <div class="flex items-center mb-2">
                            
                                        <label id="suffixLabel" class="text-lg text-gray-800">
                                            Karugtong na Pangalan
                                        </label>
                                    </div>
                                    <input 
                                        name="suffix" 
                                        id="suffix" 
                                        type="text" 
                                        value="{{ old('suffix') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter suffix (e.g., Jr., Sr., III)"
                                    />
                                    <span id="suffixIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconSuffix" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconSuffix" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="suffixMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="birthdate_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="birthdate" id="birthdateLabel" class="text-lg text-gray-800">
                                            Kaarawan
                                        </label>
                                    </div>

                                    <div class="flex space-x-2">
                                        <select name="birth_year" id="birth_year" class="bg-white border rounded-md px-3 py-2 text-lg w-1/3">
                                            <option value="">Year</option>
                                            @for ($year = date('Y') - 60; $year >= 1900; $year--)
                                                <option value="{{ $year }}" {{ old('birth_year') == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>

                                        <select name="birth_month" id="birth_month" class="bg-white border rounded-md px-3 py-2 text-lg w-1/3" {{ old('birth_year') ? '' : 'disabled' }}>
                                            <option value="">Month</option>
                                            @foreach (['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun',
                                                        '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'] as $num => $name)
                                                <option value="{{ $num }}" {{ old('birth_month') == $num ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="birth_day" id="birth_day" class="bg-white border rounded-md px-3 py-2 text-lg w-1/3" {{ old('birth_month') ? '' : 'disabled' }}>
                                            <option value="">Day</option>
                                            @for ($day = 1; $day <= 31; $day++)
                                                <option value="{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}" {{ old('birth_day') == $day ? 'selected' : '' }}>
                                                    {{ $day }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <input type="hidden" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">
                                    <p id="birthdateMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="age_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="age" id="ageLabel" class="text-lg text-gray-800">
                                            Edad
                                        </label>                                        
                                    </div>
                                    <input 
                                        name="age" 
                                        id="age" 
                                        type="text" 
                                        value="{{ old('age') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Age" readonly 
                                    />
                                    <span id="ageIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconAge" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconAge" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="ageMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="birthplace_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="birthplace" id="birthplaceLabel" class="text-lg text-gray-800">
                                        Lugar ng Kapanganakan
                                        </label>                                        
                                    </div>
                                    <input 
                                        name="birthplace" 
                                        id="birthplace" 
                                        type="text" 
                                        value="{{ old('birthplace') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter place of birth"
                                    />
                                    <span id="birthplaceIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconBirthplace" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconBirthplace" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="birthplaceMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="sex_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="sex_id" id="sexLabel" class="text-lg text-gray-800">
                                        Kasarian
                                        </label>                                        
                                    </div>
                                    <select name="sex_id" id="sex_id" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="" disabled {{ old('sex_id') ? '' : 'selected' }}>Select sex</option>
                                        @foreach($sexes as $sex)
                                            <option value="{{ $sex->id }}" {{ old('sex_id') == $sex->id ? 'selected' : '' }}>
                                                {{ $sex->sex }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="sexIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconSex" class="w-5 h-5 mr-[15px] text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconSex" class="w-5 h-5 mr-[15px] text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="sexMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="civil_status_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="civil_status_id" id="civilStatusLabel" class="text-lg text-gray-800">
                                        Civil Status
                                        </label>                                        
                                    </div>
                                    <select name="civil_status_id" id="civil_status_id"
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all 
                                        {{ $errors->has('civil_status_id') ? 'bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500' : 
                                        (old('civil_status_id') ? 'bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500' : 
                                        'bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500') }}">
                                        <option value="" disabled {{ old('civil_status_id') ? '' : 'selected' }}>Select civil status</option>
                                        @foreach($civil_status_list as $civil_status1)
                                            <option value="{{ $civil_status1->id }}" {{ old('civil_status_id') == $civil_status1->id ? 'selected' : '' }}>
                                                {{ $civil_status1->civil_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="civilStatusIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconCivilStatus" class="w-5 h-5 mr-[15px] text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconCivilStatus" class="w-5 h-5 mr-[15px] text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="civilStatusMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="contact_no_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="contact_no" id="contactNoLabel" class="text-lg text-gray-800">
                                        Contact Number
                                        </label>                                        
                                    </div>

                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                            +63
                                        </span>

                                        <input 
                                            name="contact_no" 
                                            id="contact_no" 
                                            type="text" 
                                            value="{{ old('contact_no') }}" 
                                            class="w-full text-lg px-4 py-3 rounded-r-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Enter contact number (10 digits)" 
                                            inputmode="numeric" 
                                            pattern="[0-9]*" 
                                            maxlength="10" 
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                        />
                                    </div>

                                    <span id="contactNoIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconContactNo" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconContactNo" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>

                                    <p id="contactNoMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                                <div class="md:col-span-2 relative">
                                    <div class="flex items-center mb-2">
                                        <img id="address_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="addressLabel" class="text-lg text-gray-800">
                                        Home Address <span class="italic"> (Tirahan) </span>
                                        </label>
                                    </div>
                                    <input
                                        name="address"
                                        id="address"
                                        type="text"
                                        value="{{ old('address') }}"
                                        class="bg-white focus:bg-transparent w-full text-lg px-4 py-3 rounded-md transition-all border-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter Address"
                                    />
                                    <span id="addressIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/3 transform -translate-y-1/2 hidden">
                                        <svg id="validIconAddress" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconAddress" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p class="text-lg mt-2 p-1">Enter House No., Street, Barangay, City/Municipality, Province</p>
                                    <p id="addressMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="barangay_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label for="barangay_id" id="barangayLabel" class="text-lg text-gray-800">
                                        Barangay
                                        </label>
                                    </div>

                                    <select name="barangay_id" id="barangay_id"
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="" disabled selected>Select barangay</option>
                                        @foreach($barangay as $barangay1)
                                            <option value="{{ $barangay1->id }}" {{ old('barangay_id') == $barangay1->id ? 'selected' : '' }}>
                                                {{ $barangay1->barangay_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="barangayIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/3 transform -translate-y-1/2 hidden">
                                        <svg id="validIconBarangay" class="w-5 h-5 mr-[15px] text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconBarangay" class="w-5 h-5 mr-[15px] text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="barangayMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                                <div class="relative md:col-span-3">
                                    <div class="flex items-center mb-2">
                                        <img id="living_arrangement_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="livingArrangementLabel" class="text-lg text-gray-800">
                                        Living Arrangement
                                        </label>
                                    </div>

                                    <div id="livingArrangementOptions" class="flex flex-col md:flex-row md:flex-wrap">
                                        @foreach($arrangement_lists as $arrangement)
                                            <div class="flex items-center mb-2 md:mr-4">
                                                <input type="radio" 
                                                    name="type_of_living_arrangement" 
                                                    value="{{ $arrangement->id }}" 
                                                    id="living_arrangement_{{ $arrangement->id }}" 
                                                    class="mr-2 shadow-md"
                                                    {{ old('type_of_living_arrangement') == $arrangement->id ? 'checked' : '' }}>
                                                <label for="living_arrangement_{{ $arrangement->id }}" 
                                                    class="text-lg text-gray-800">
                                                    {{ $arrangement->type_of_living_arrangement_list }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="relative mt-4">

                                        <label id="other_arrangement_remark_label" class="text-lg text-gray-800 mt-4 mb-2 block hidden"> 
                                            <div class="flex items-center ">
                                                <img id="other_arrangement_remark_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                 If others, please specify: <span class="italic"> (Kung iba, pakitukoy:) </span>
                                            </div>
                                        </label>

                                        <input 
                                            type="text" 
                                            name="other_arrangement_remark" 
                                            id="otherArrangementRemark" 
                                            class="bg-white focus:bg-transparent w-full text-lg px-4 py-3 rounded-md transition-all border-gray-500 focus:ring-blue-500 focus:border-blue-500 hidden" 
                                            placeholder="Enter additional information" 
                                            value="{{ old('other_arrangement_remark') }}" 
                                            style="width: -webkit-fill-available;">
                                    </div>

                                    <p id="livingArrangementMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>
                        </div>

                        <div id="content3" class="w-full bg-white shadow-lg mt-[-17px] sm:pt-2 px-6 py-10 rounded-md lg:px-12" style="display: none;">

                            <div class="text-lg mt-8 mb-8 text-gray-800 font-semibold">
                                <div class="flex items-center mt-4">
                                    <img src="images/warning.png" alt="Info Icon" class="w-4 h-4 mr-1">
                                    <p class="text-left">
                                        Note: If there is a guardian and/or a family member available, please provide their details in the input fields below. 
                                    </p>
                                </div>

                                <div class="flex items-center">
                                    <img src="images/warning.png" alt="Info Icon" class="w-4 h-4 mr-1">
                                    <p class="mt-2 text-left italic">
                                        Paalala: Kung may tagapag-alaga at/o miyembro ng pamilya, pakilagay ang kanilang impormasyon sa mga input fields sa ibaba. 
                                    </p>
                                </div>
                            </div>

                            <div class="text-xl font-bold mt-8 mb-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Guardian
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                                <div class="relative">
                                    <label id="guardianFirstNameLabel" class="text-lg mb-2 block text-gray-800">
                                        Unahang Pangalan
                                    </label>
                                    <input 
                                        name="guardian_first_name" 
                                        id="guardian_first_name" 
                                        type="text" 
                                        value="{{ old('guardian_first_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter first name"
                                    />
                                    <span 
                                        id="guardianFirstNameIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianFirstName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianFirstName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="guardianFirstNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <label id="guardianMiddleNameLabel" class="text-lg mb-2 block text-gray-800">
                                        Gitnang Pangalan
                                    </label>
                                    <input 
                                        name="guardian_middle_name" 
                                        id="guardian_middle_name" 
                                        type="text" 
                                        value="{{ old('guardian_middle_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter middle name"
                                    />
                                    <span 
                                        id="guardianMiddleNameIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianMiddleName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianMiddleName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="guardianMiddleNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <label id="guardianLastNameLabel" class="text-lg mb-2 block text-gray-800">
                                        Hulihang Pangalan
                                    </label>
                                    <input 
                                        name="guardian_last_name" 
                                        id="guardian_last_name" 
                                        type="text" 
                                        value="{{ old('guardian_last_name') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter last name"
                                    />
                                    <span 
                                        id="guardianLastNameIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianLastName" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianLastName" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="guardianLastNameMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <label id="guardianSuffixLabel" class="text-lg mb-2 block text-gray-800">
                                        Karugtong na Pangalan
                                    </label>
                                    <input 
                                        name="guardian_suffix" 
                                        id="guardian_suffix" 
                                        type="text" 
                                        value="{{ old('guardian_suffix') }}" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter suffix (e.g., Jr., Sr., III)"
                                    />
                                    <span 
                                        id="guardianSuffixIcon" 
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianSuffix" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianSuffix" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="guardianSuffixMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                <div class="relative">
                                    <label for="guardian_relationship_id" id="guardianRelationshipLabel" class="text-lg mb-2 block 
                                        {{ $errors->has('guardian_relationship_id') ? 'text-red-700' : (old('guardian_relationship_id') ? 'text-green-700' : 'text-gray-800') }}">
                                        Relationship
                                    </label>
                                    <select name="guardian_relationship_id" id="guardian_relationship_id" 
                                        class="w-full text-lg px-4 py-3 rounded-md transition-all 
                                        {{ $errors->has('guardian_relationship_id') ? 'bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500' : 
                                        (old('guardian_relationship_id') ? 'bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500' : 
                                        'bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500') }}">
                                        <option value="" disabled {{ old('guardian_relationship_id') ? '' : 'selected' }}>Select relationship</option>
                                        @foreach($relationship_list as $relationship1)
                                            <option value="{{ $relationship1->id }}" {{ old('guardian_relationship_id') == $relationship1->id ? 'selected' : '' }}>
                                                {{ $relationship1->relationship }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="guardianRelationshipIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianRelationship" class="w-5 h-5 mr-[15px] text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianRelationship" class="w-5 h-5 mr-[15px] text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>
                                    <p id="guardianRelationshipMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative">
                                    <label for="guardian_contact_no" id="guardianContactNoLabel" class="text-lg mb-2 block 
                                        {{ $errors->has('guardian_contact_no') ? 'text-red-700' : (old('guardian_contact_no') ? 'text-green-700' : 'text-gray-800') }}">
                                        Contact Number
                                    </label>

                                    <div class="flex">
                                        <span class="inline-flex items-center px-3 bg-gray-200 text-gray-700 border border-gray-300 rounded-l-md">
                                            +63
                                        </span>

                                        <input 
                                            name="guardian_contact_no" 
                                            id="guardian_contact_no" 
                                            type="text" 
                                            value="{{ old('guardian_contact_no') }}" 
                                            class="w-full text-lg px-4 py-3 rounded-r-md transition-all pr-10 bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Enter contact number (10 digits)" 
                                            inputmode="numeric" 
                                            pattern="[0-9]*" 
                                            maxlength="10" 
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                        />
                                    </div>

                                    <span id="guardianContactNoIcon" class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2 hidden">
                                        <svg id="validIconGuardianContactNo" class="w-5 h-5 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg id="invalidIconGuardianContactNo" class="w-5 h-5 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </span>

                                    <p id="guardianContactNoMessage" class="text-md mt-2 p-1 hidden"></p>
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
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Pangalan</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Relasyon</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Edad</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Civil Status</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Trabaho</th>
                                                <th class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">Kinikita</th>
                                                <th id="remove-header" class="border border-gray-300 px-4 py-2 text-left font-semibold text-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(old('relative_name'))
                                                @foreach(old('relative_name') as $index => $name)
                                                <tr>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_name[]" value="{{ $name }}" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter name" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" style="min-width: 150px;">
                                                            <option value="" disabled selected>Relationship</option>
                                                            @foreach ($relationship_list as $relationship)
                                                                <option value="{{ $relationship->id }}" {{ (old('relative_relationship_id')[$index] ?? '') == $relationship->id ? 'selected' : '' }}>
                                                                    {{ $relationship->relationship }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="number" name="relative_age[]" value="{{ old('relative_age')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter age" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" style="min-width: 150px;">
                                                            <option value="" disabled selected>Select status</option>
                                                            @foreach ($civil_status_list as $status)
                                                                <option value="{{ $status->id }}" {{ (old('relative_civil_status_id')[$index] ?? '') == $status->id ? 'selected' : '' }}>
                                                                    {{ $status->civil_status }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_occupation[]" value="{{ old('relative_occupation')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter occupation" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_income[]" value="{{ old('relative_income')[$index] }}" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter income" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2 hidden flex items-center justify-center" id="removeCell-{{ $index }}">
                                                        <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                            <img src="../images/trashbin.png" alt="Delete" class="h-5 w-5" />
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_name[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter name" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <select name="relative_relationship_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" style="min-width: 150px;">
                                                            <option value="" disabled selected>Relationship</option>
                                                            @foreach ($relationship_list as $relationship)
                                                                <option value="{{ $relationship->id }}">
                                                                    {{ $relationship->relationship }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="number" name="relative_age[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter age" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <select name="relative_civil_status_id[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" style="min-width: 150px;">
                                                            <option value="" disabled selected>Select status</option>
                                                            @foreach ($civil_status_list as $status)
                                                                <option value="{{ $status->id }}">
                                                                    {{ $status->civil_status }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_occupation[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter occupation" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2">
                                                        <input type="text" name="relative_income[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-lg" placeholder="Enter income" style="min-width: 150px;">
                                                    </td>
                                                    <td class="border border-gray-300 px-4 py-2 hidden flex items-center justify-center" id="removeCell-0">
                                                        <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                                                            <img src="../images/trashbin.png" alt="Delete" class="h-5 w-5" />
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            
                            <p id="family-composition-error" class="text-red-500 text-md mt-2"></p>

                            <div class="mt-4 flex justify-center">
                                <button type="button" onclick="addRow()" class="py-3 px-6 flex justify-center items-center md:w-auto flex justify-center items-center text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Add another row
                                </button>
                            </div>
                        </div>

                        <div id="content4" class="w-full bg-white shadow-lg mt-[-17px] sm:pt-2 px-6 py-10 rounded-md lg:px-12" style="display: none;">

                            <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Economic Status
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                                <div class="relative md:col-span-4 sm:col-span-3">
                                    <div class="flex items-center mb-2">
                                        <img id="pensioner_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="pensionerLabel" class="text-lg text-gray-800">
                                        Are you a pensioner? <span class="italic"> (Ikaw ba ay kasalukuyang tumatanggap ng pensyon?) </span>
                                        </label>
                                    </div>

                                    <div id="pensionerOptions" class="flex flex-col md:flex-row md:flex-wrap">
                                        <div class="flex items-center mb-2 md:mr-4"> 
                                            <input type="radio" 
                                                name="pensioner" 
                                                value="1" 
                                                id="pensioner_yes" 
                                                class="mr-2 shadow-md" 
                                                {{ old('pensioner') == 1 ? 'checked' : '' }}
                                                onclick="toggleInputField(1, 'pensioner')">

                                            <label for="pensioner_yes" 
                                                class="text-lg text-gray-800">
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
                                                class="text-lg text-gray-800">
                                                No
                                            </label>
                                        </div>
                                    </div>

                                    <p id="pensionerMessage" class="text-md mt-2 p-1 hidden"></p>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">
                                        <div class="w-full md:col-span-2 text-gray-800 relative">

                                            <label id="pensioner_label" class="text-lg text-gray-800 mt-4 mb-2 block {{ old('pensioner') == 1 ? '' : 'hidden' }}">
                                                <div class="flex items-center">
                                                <img id="if_pensioner_yes_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                If yes, how much pension do you receive? <span class="italic"> (Kung oo, magkano ang iyong natatanggap?) </span>
                                                </div>
                                            </label>

                                            <select name="if_pensioner_yes" 
                                                    id="if_pensioner_yes" 
                                                    class="bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all 
                                                    {{ old('pensioner') == 1 ? '' : 'hidden' }}" 
                                                    style="width: -webkit-fill-available;">
                                                <option value="" disabled selected>Select pension amount</option>
                                                @foreach($pensions as $pension)
                                                    <option value="{{ $pension->id }}" {{ old('if_pensioner_yes') == $pension->id ? 'selected' : '' }}>
                                                        {{ $pension->how_much_pension }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <p id="IfPensionerMessage" class="text-md mt-2 p-1 hidden"></p>
                                        </div>

                                        <div id="source_list" class="md:col-span-2 relative {{ old('pensioner') == 1 ? '' : 'hidden' }}" >
                                            <div class="flex items-center mt-4 mb-2">
                                                <img id="source_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                <label id="source_label" class="text-lg text-gray-800 block">
                                                    If yes, from what source? <span class="italic"> (Kung oo, mula saan?) </span>
                                                </label>
                                            </div>

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
                                                            class="text-lg text-gray-800">
                                                            {{ $source->source_list }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <label id="other_source_label" class="text-lg text-gray-800 mt-4 mb-2 block {{ is_array(old('source')) && in_array(4, old('source')) ? '' : 'hidden' }}">
                                                If others, please specify: <span class="italic"> (Kung iba, pakitukoy:) </span>
                                            </label>

                                            @php
                                                $oldSource = old('source');
                                                $isOtherSourceSelected = is_array($oldSource) && end($oldSource) == $sources->last()->id;
                                            @endphp

                                            <input type="text"
                                                name="other_source_remark"
                                                id="other_source_remark"
                                                class="mt-4 bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all
                                                {{ $isOtherSourceSelected ? '' : 'hidden' }}"
                                                placeholder="Enter additional information"
                                                value="{{ old('other_source_remark') ?? '' }}"
                                                style="width: -webkit-fill-available;">

                                            <p id="sourceMessage" class="text-md mt-2 p-1 hidden"></p>

                                            <p id="otherSourceMessage" class="text-md mt-2 p-1 hidden"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative md:col-span-4 sm:col-span-4"> 
                                    <div class="flex items-center mb-2">
                                        <img id="permanent_source_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="permanent_source_label" class="text-lg text-gray-800">
                                        Do you have permanent source of income? <span class="italic"> (Ikaw ba ay may pinagkakakitaan?) </span>
                                        </label>
                                    </div>

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
                                                class="text-lg text-gray-800">
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
                                                class="text-lg text-gray-800">
                                                No
                                            </label>
                                        </div>
                                    </div>

                                    <p id="permanent_source_message" class="text-md mt-2 p-1 hidden"></p>

                                    <div class="md:grid grid-cols-1 md:grid-cols-4 gap-8 mt-1">

                                        <div class="md:col-span-2 text-gray-800 relative">
                                                
                                            <label id="permanent_income_label" class="text-lg mt-4 mb-2 block {{ old('permanent_source') == 1 ? '' : 'hidden' }}">
                                                <div class="flex items-center ">
                                                    <img id="if_permanent_yes_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                    If yes, how much income? <span class="italic"> (Kung oo, magkano and iyong kinikita?) </span>
                                                </div>
                                            </label>
                                            
                                            <select name="if_permanent_yes_income" 
                                                    id="if_permanent_yes_income" 
                                                    class="bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all 
                                                    {{ old('permanent_source') == 1 ? '' : 'hidden' }}" 
                                                    style="width: -webkit-fill-available;">
                                                <option value="" disabled selected>Select income amount</option>
                                                @foreach($incomes as $income)
                                                    <option value="{{ $income->id }}" {{ old('if_permanent_yes_income') == $income->id ? 'selected' : '' }}>
                                                        {{ $income->how_much_income }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="income_source_list" class="md:col-span-2 relative {{ old('permanent_source') == 1 ? '' : 'hidden' }}" >
                                            <div class="flex items-center mt-4 mb-2">
                                                <img id="income_source_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                <label id="income_source_label" class="text-lg text-gray-800 block">
                                                If yes, from what source? <span class="italic">(Kung oo, mula saan?)</span>
                                                </label>
                                            </div>

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
                                                            class="text-lg text-gray-800">
                                                            {{ $income_source->where_income_source }}
                                                            <span class="italic">{{ $income_source->where_income_source_examples }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <label id="other_income_source_label" class="text-lg text-gray-800 mt-4 mb-2 block {{ is_array(old('income_source')) && in_array($income_sources->last()->id, old('income_source')) ? '' : 'hidden' }}">
                                                If others, please specify: <span class="italic"> (Kung iba, pakitukoy:) </span>
                                            </label>

                                            @php
                                                $oldIncomeSource = old('income_source');
                                                $isOtherIncomeSourceSelected = is_array($oldIncomeSource) && end($oldIncomeSource) == $income_sources->last()->id;
                                            @endphp

                                            <input type="text"
                                                name="other_income_source_remark"
                                                id="other_income_source_remark"
                                                class="mt-4 bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all
                                                {{ $isOtherIncomeSourceSelected ? '' : 'hidden' }}"
                                                placeholder="Enter additional information"
                                                value="{{ old('other_income_source_remark') ?? '' }}"
                                                style="width: -webkit-fill-available;">

                                            <p id="income_source_message" class="text-md mt-2 p-1 hidden"></p>
                                            <p id="other_income_source_message" class="text-md mt-2 p-1 hidden"></p>
                                        </div>
                                    </div>

                                    <p id="permanent_source_message" class="text-md mt-2 p-1 hidden"></p>
                                    <p id="IfPermanentIncomerMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Health Condition
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                                <div class="relative md:col-span-3 sm:col-span-3">
                                    <div class="flex items-center mb-2">
                                        <img id="illness_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="IllnessLabel" class="text-lg text-gray-800">
                                        Do you have an existing illness? <span class="italic"> (Ikaw ba ay may kasalukuyang sakit?) </span>
                                        </label>
                                    </div>

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
                                                class="text-lg text-gray-800">
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
                                                class="text-lg text-gray-800">
                                                No
                                            </label>
                                        </div>
                                    </div>

                                    <label id="illness_label" class="text-lg text-gray-800 mt-4 mb-2 block {{ old('has_illness') == 1 ? '' : 'hidden' }}">
                                        <div class="flex items-center ">
                                            <img id="has_illness_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                If yes, please specify: <span class="italic"> (Kung oo, pakitukoy:) </span>
                                        </div>
                                    </label>

                                    <input type="text" 
                                        name="if_illness_yes" 
                                        id="if_illness_yes" 
                                        class="bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all 
                                        {{ old('has_illness') == 1 ? '' : 'hidden' }}" 
                                        placeholder="Enter additional information"
                                        value="{{ old('if_illness_yes') }}" style="width: -webkit-fill-available;"
                                        >

                                    <p id="illnessMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div class="relative md:col-span-3 sm:col-span-3">
                                    <div class="flex items-center mb-2">
                                        <img id="disability_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="DisabilityLabel" class="text-lg text-gray-800">
                                        Do you have disability? <span class="italic"> (Ikaw ba ay may kapansanan?) </span>
                                        </label>
                                    </div>

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
                                                class="text-lg text-gray-800">
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
                                                class="text-lg text-gray-800">
                                                No
                                            </label>
                                        </div>
                                    </div>

                                    <label id="disability_label" class="text-lg text-gray-800 mt-4 mb-2 block {{ old('has_disability') == 1 ? '' : 'hidden' }}">
                                        <div class="flex items-center ">
                                            <img id="has_disability_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                                If yes, please specify: <span class="italic"> (Kung oo, pakitukoy:) </span>
                                        </div>
                                    </label>

                                    <input type="text" 
                                        name="if_disability_yes" 
                                        id="if_disability_yes" 
                                        class="bg-white focus:bg-transparent text-lg px-4 py-3 rounded-md transition-all 
                                        {{ old('has_disability') == 1 ? '' : 'hidden' }}" 
                                        placeholder="Enter additional information"
                                        value="{{ old('if_disability_yes') }}" style="width: -webkit-fill-available;"
                                        >

                                    <p id="disabilityMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>
                        </div>

                        <div id="content5" class="w-full bg-white shadow-lg mt-[-17px] sm:pt-2 px-6 py-10 rounded-md lg:px-12" style="display: none;">

                            <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Identification
                                </p>
                            </div>

                            <div class="text-lg mt-8 text-gray-800 font-semibold">
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
                                    validIdPreviewUrl: '',
                                    previewValidIdImage(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.validIdPreviewUrl = e.target.result;
                                                document.getElementById('valid_id_preview').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }">
                                    <div class="flex items-center mb-2">
                                        <img id="valid_id_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="validIdLabel" class="text-lg block text-gray-800">
                                        Valid ID
                                        </label>
                                    </div>
                                    <input id="valid_id_input" name="valid_id" type="file" accept="image/*"
                                        class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Upload image of Valid ID" @change="previewValidIdImage">

                                    <p id="valid_id_filename" class="text-gray-700 text-md mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="validIdPreviewUrl" id="valid_id_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                            style="display: none;" alt="Valid ID Preview" @click="showValidIdModal = true">
                                    </div>

                                    <p id="validIdMessage" class="text-md mt-2 p-1 hidden"></p>

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

                                    <label id="profilePictureLabel" class="text-lg mb-2 block text-gray-800">
                                        Profile Picture
                                    </label>

                                    <div class="relative">
                                        <input name="profile_picture" type="file" accept="image/*"
                                            class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Upload photo of Pensioner" id="profilePictureField" 
                                            @change="previewImage">

                                        <button @click="$dispatch('open-camera-modal')" 
                                                class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12" 
                                                type="button">
                                            <img src="../images/camera.png" alt="Toggle Profile Picture" class="hover:animate-jiggle camera-icon w-7 h-7" id="toggleCameraIcon">
                                        </button>
                                    </div>

                                    <p id="profile_picture_filename" class="text-gray-700 text-md mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="previewUrl" id="profile_picture_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" style="display: none;" alt="Profile Picture Preview"
                                            @click="showProfilePicModal = true">
                                    </div>

                                    <p id="profilePictureMessage" class="text-md mt-2 p-1 hidden"></p>

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
                                    <div class="flex items-center mb-2">
                                        <img id="indigency_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="indigencyLabel" class="text-lg block text-gray-800">
                                        Certificate of Indigency
                                        </label>
                                    </div>
                                    <input id="indigency_input" name="indigency" type="file" accept="image/*"
                                        class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Upload photo of Pensioner" @change="previewIndigencyImage">

                                    <p id="indigency_filename" class="text-gray-700 text-md mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="indigencyPreviewUrl" id="indigency_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                            style="display: none;" alt="Indigency Certificate Preview" @click="showIndigencyModal = true">
                                    </div>

                                    <p id="indigencyMessage" class="text-md mt-2 p-1 hidden"></p>

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
                                    <div class="flex items-center mb-2">
                                        <img id="birth_certificate_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="birthCertificateLabel" class="text-lg block text-gray-800">
                                        Birth Certificate
                                        </label>
                                    </div>
                                    <input id="birth_certificate_input" name="birth_certificate" type="file" accept="image/*"
                                        class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Upload photo of Birth Certificate" @change="previewBirthCertificateImage">

                                    <p id="birth_certificate_filename" class="text-gray-700 text-md mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="birthCertificatePreviewUrl" id="birth_certificate_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                            style="display: none;" alt="Birth Certificate Preview" @click="showBirthCertificateModal = true">
                                    </div>

                                    <p id="birthCertificateMessage" class="text-md mt-2 p-1 hidden"></p>

                                    @include('components.modal.senior_citizen.birthcertificate_zoom')
                                </div>
                            </div>

                            <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">
                                    Account Information
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                                <div class="relative">
                                    <div class="flex items-center mb-2">
                                        <img id="email_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="emailLabel" class="text-lg text-gray-800">
                                            Email Address
                                        </label>
                                    </div>
                                    <input name="email" id="email_register" type="email" 
                                        class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-md transition-all bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                        placeholder="Enter email" value="{{ old('email') }}" />
                                    
                                    <p id="emailMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>

                                <div>
                                    <div class="flex items-center mb-2">
                                        <img id="password_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="passwordLabel" class="text-lg text-gray-800">
                                        Password
                                        </label>
                                    </div>
                                    <div class="relative">
                                        <div class="flex">
                                            <input name="password" type="password" 
                                                class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                                placeholder="Enter password" id="passwordField" oninput="updatePasswordCriteria(this.value)"/>

                                            <button class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 text-gray-700 border border-gray-300 rounded-r-md w-12 hover:bg-gray-600 h-[33%]" 
                                                type="button" onclick="togglePassword('passwordField', 'togglePasswordIcon1')">
                                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-7 h-7 hover:animate-jiggle" id="togglePasswordIcon1">
                                            </button>
                                        </div>

                                        <div class="ml-2 mt-4 text-gray-800 text-md">
                                            <ul>
                                                <li id="minLength"><i class="fas fa-times text-red-500"></i> Dapat may 8 o higit pang letra</li>
                                                <li id="uppercase"><i class="fas fa-times text-red-500"></i> Dapat may isang malaking letra (A-Z)</li>
                                                <li id="lowercase"><i class="fas fa-times text-red-500"></i> Dapat may isang maliit na letra (a-z)</li>
                                                <li id="symbol"><i class="fas fa-times text-red-500"></i> Dapat may isang simbolo (@, $, !, %, ?, &)</li>
                                            </ul>
                                        </div>

                                        <p id="passwordMessage" class="text-md mt-2 p-1 hidden"></p>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center mb-2">
                                        <img id="confirm_password_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="confirmPasswordLabel" class="text-lg text-gray-800">
                                        Confirm Password
                                        </label>
                                    </div>
                                    <div class="relative">
                                        <div class="flex">
                                            <input name="password_confirmation" type="password" 
                                                class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-md transition-all bg-white border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                                placeholder="Confirm password" id="passwordConfirmationField" />

                                            <button class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12 h-full" type="button" id="button-addon2" onclick="togglePassword('passwordConfirmationField', 'togglePasswordIcon2')">
                                                <img src="../images/hide.png" alt="Show Password" class="eye-icon w-7 h-7 hover:animate-jiggle" id="togglePasswordIcon2">
                                            </button>
                                        </div>
                                    </div>
                                    <p id="confirmPasswordMessage" class="text-md mt-2 p-1 hidden"></p>
                                </div>
                            </div>

                            <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                                <p class="text-left">E-Signature</p>
                            </div>

                            <div class="text-lg mt-8 text-gray-800 font-semibold">
                                <div class="flex items-center">
                                    <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                    <p class="text-left">
                                        Note: You can choose whether to upload a photo of your signature or write your signature on the canvas below. 
                                        A signature is required, so you must complete one option.
                                    </p>
                                </div>
                                
                                <div class="flex items-center">
                                    <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                    <p class="mt-2 text-left italic">
                                        Paalala: Maaari kang pumili kung mag-a-upload ng larawan ng iyong pirma o isusulat ang iyong pirma sa canvas sa ibaba. 
                                        Kinakailangan ang pirma, kaya dapat kumpletuhin ang isa sa mga options na nasa ibaba.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                 <div x-data="{
                                        showSignatureCameraModal: false,
                                        showSignatureModal: false,
                                        previewSignatureUrl: '',
                                        previewSignatureImage(event) {
                                            const input = event.target;
                                            if (input.files && input.files[0]) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    this.previewSignatureUrl = e.target.result;
                                                    document.getElementById('signature_preview').style.display = 'block';
                                                };
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                    }" 
                                    @open-signature-camera-modal.window="showSignatureCameraModal = true; localStorage.setItem('showSignatureCameraModal', 'true')" 
                                    @close-signature-camera-modal.window="showSignatureCameraModal = false; localStorage.setItem('showSignatureCameraModal', 'false')">

                                    <div class="flex items-center mb-2">
                                        <img id="signature_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="signatureLabel" class="text-lg text-gray-800">
                                            Signature
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <input name="signature_upload" type="file" 
                                            class="bg-white focus:bg-transparent w-full text-lg text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all bg-white border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Upload photo of Signature" id="signatureField" 
                                            @change="previewSignatureImage">

                                        <button @click="$dispatch('open-signature-camera-modal')" 
                                                class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12" 
                                                type="button">
                                            <img src="../images/camera.png" alt="Toggle Signature" class="hover:animate-jiggle camera-icon w-7 h-7" id="toggleSignatureCameraIcon">
                                        </button>
                                    </div>

                                    <p id="signature_filename" class="text-gray-700 text-md mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="previewSignatureUrl" id="signature_preview" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" style="display: none;" alt="Signature Preview"
                                            @click="showSignatureModal = true">
                                    </div>

                                    <p id="signatureMessage" class="text-md mt-2 p-1 hidden"></p>

                                    @include('components.modal.senior_citizen.signature_camera')
                                    @include('components.modal.senior_citizen.signature_zoom')
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <canvas id="sig-canvas" class="border border-gray-500 shadow-md rounded-md w-full h-32 sm:h-40 md:h-48 lg:h-56"></canvas>
                                <input type="hidden" id="sig-dataUrl" name="signature_data">
                                <img id="sig-image" style="display:none;">
                                <p id="signaturevalidation" class="text-lg mt-2 text-red-500" style="display:none;">Please provide your signature.</p>
                                <div class="flex justify-center items-center mt-4">
                                    <button type="button" id="sig-clearBtn" class="py-3 px-6 md:w-auto text-lg tracking-wider font-light rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none">Clear Signature</button>
                                </div>
                            </div>

                            <div class="grid grid-cols-[auto_1fr] gap-4 items-start mt-8">
                                <div class="flex flex-col items-center w-fit">
                                    <div class="checkbox-container flex items-center gap-2">
                                        <img id="checkbox_asterisk" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3">
                                        <input 
                                            class="form-check-input checkdrop shadow-md w-6 h-6" 
                                            type="checkbox" 
                                            id="confirm-checkbox" 
                                            name="confirm-checkbox" 
                                            {{ old('confirm-checkbox') ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="w-full">
                                    <div class="text-lg">
                                        <label class="form-check-label1 text-gray-800" id="confirm-checkbox-label" onclick="event.preventDefault();">
                                            I, <span id="full-name-placeholder">{{ old('first_name') }} {{ old('middle_name') }} {{ old('last_name') }}{{ old('suffix') ? ', ' . old('suffix') : '' }}</span>, hereby confirm that the above-mentioned information is true and correct to the best of my knowledge; and hereby authorize the verification of the details provided herein.
                                        </label>
                                    </div>
                                    <div class="mt-2 text-lg">
                                        <label class="form-check-label1 text-gray-800 italic">
                                            Ako si <span id="full-name-placeholder-2">{{ old('first_name') }} {{ old('middle_name') }} {{ old('last_name') }}{{ old('suffix') ? ', ' . old('suffix') : '' }}</span> at aking pinatutunayan na ang mga nakasaad na impormasyon ay totoo at tama sa abot ng aking kaalaman; at sa pamamagitan nito ay pinahihintulutan ko ang pagpapatunay ng mga detalyeng ibinigay dito.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 p-4 border border-gray-400 rounded-lg bg-gray-100 text-gray-800">
                                <div class="text-center">
                                    <h3 class="text-xl font-bold">DATA PRIVACY</h3>
                                </div>
                                <p class="mt-4 text-lg text-justify text-indent">
                                    In compliance with the provisions of Republic Act No. 10173, also known as the Data Privacy Act of 2012 and its implementing Rules and Regulations (IRR), the Department of Social Welfare and Development (DSWD) ensures that the personal information provided is collected and processed by authorized personnel and is only used for the implementation of the Social Pension for Indigent Senior Citizens (SPISC) Program as mandated under Republic Act No. 9994.
                                </p>
                                <p class="mt-4 text-lg text-justify text-indent italic">
                                    Bilang alinsunod sa mga probisyon ng Batas Republika No. 10173, na kilala rin bilang Data Privacy Act of 2012 at ang Implementing Rules and Regulations (IRR) nito, tinitiyak ng Department of Social Welfare and Development (DSWD) na ang personal na impormasyong ibinigay ay kinokolekta at pinoproseso ng awtorisadong mga tauhan at ginagamit lamang para sa pagpapatupad ng Social Pension for Indigent Senior Citizens (SPISC) Program ayon sa mandato sa ilalim ng Batas Republika No. 9994.
                                </p>
                            </div>

                            {{-- <div class="flex justify-center mt-8">
                                {!! htmlFormSnippet() !!}
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="text-red-500 flex justify-center text-lg mt-2">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </div>
                            @endif --}}

                            <div class="mt-8 flex justify-center">
                                <button type="submit" id="submit" name="submit" class="py-3 px-6 md:w-auto text-lg tracking-wider font-light rounded-md text-white bg-blue-500 hover:scale-105 transition duration-150 ease-in-out focus:outline-none">
                                    Sign up
                                </button>
                            </div>
                            <div class="mt-2 flex flex-col items-center justify-center">
                                <div id="submit-error" class="text-red-500 text-lg mt-2" style="{{ $errors->any() ? 'display: block;' : 'display: none;' }}">
                                    @if($errors->any())
                                        <div class="flex items-center text-red-500">
                                            <p class="flex items-center">
                                                Please fill out the required fields:
                                                <img src="{{ asset('images/asterisk.png') }}" alt="Asterisk" class="w-3 h-3 ml-2">
                                            </p>
                                        </div>
                                        <ul class="mt-2 text-sm">
                                            @foreach ($errors->keys() as $field)
                                                <li class="flex items-center">
                                                    <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $field)) }} </span> is required.
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-3 mb-8 flex justify-end gap-4 items-center relative">
                    <button type="button" id="backButton" class="hover:animate-scale py-3 px-6 shadow-lg text-lg tracking-wider font-light rounded-md text-gray-800 bg-white border border-gray-200 shadow-sm hover:bg-gray-300 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="shrink-0 w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                        Back
                    </button>

                    <button type="button" id="nextButton" class="hover:animate-scale py-3 px-6 shadow-lg text-lg tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148e10] focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                        Next
                        <svg class="shrink-0 w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </button>
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
                sourceList.classList.remove('hidden');
            } else {
                additionalInput.classList.add('hidden');
                pensionerLabel.classList.add('hidden');
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
                incomeSourceList.classList.remove('hidden');
            } else {
                additionalIncomeInput.classList.add('hidden');
                permanentIncomeLabel.classList.add('hidden');
                incomeSourceList.classList.add('hidden');
                additionalIncomeInput.value = '';

                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        } else if (type === 'sourceslist') {
            additionalInput = document.getElementById('other_source_remark');
            const lastSourceId = {{ $sources->last()->id }};

            if (value == lastSourceId) {
                additionalInput.classList.remove('hidden');
            } else {
                additionalInput.classList.add('hidden');
                additionalInput.value = '';
            }
        }  else if (type === 'has_illness') {
            additionalInput = document.getElementById('if_illness_yes');
            additionalLabel = document.getElementById('illness_label');

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                additionalLabel.classList.remove('hidden');
            } else {
                additionalInput.classList.add('hidden');
                additionalLabel.classList.add('hidden'); 
                additionalInput.value = ''; 
            }
        } else if (type === 'has_disability') {
            additionalInput = document.getElementById('if_disability_yes');
            additionalLabel = document.getElementById('disability_label');

            if (value == 1) { 
                additionalInput.classList.remove('hidden');
                additionalLabel.classList.remove('hidden'); 
            } else {
                additionalInput.classList.add('hidden');
                additionalLabel.classList.add('hidden'); 
                additionalInput.value = ''; 
            }
        } else if (type === 'incomesourceslist') {
            additionalInput = document.getElementById('other_income_source_remark');
            const lastIncomeSourceId = {{ $income_sources->last()->id }};

            if (value == lastIncomeSourceId) {
                additionalInput.classList.remove('hidden');
            } else {
                additionalInput.classList.add('hidden');
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
        } else {
            additionalInput.classList.add('hidden');
            sourceLabel.classList.add('hidden');
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

        } else {
            additionalIncomeInput.classList.add('hidden');
            incomeSourceLabel.classList.add('hidden');
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
        const errorContainer = document.getElementById('family-composition-error');

        if (rowCount < 5) {
            if (errorContainer) errorContainer.textContent = '';

            rowCount++;

            let newRow = `
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    <input type="text" name="relative_name[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter name" style="min-width: 150px;">
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <select name="relative_relationship_id[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                        <option value="" disabled selected>Relationship</option>
                        @foreach ($relationship_list as $relationship)
                            <option value="{{ $relationship->id }}">{{ $relationship->relationship }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <input type="number" name="relative_age[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter age" style="min-width: 150px;">
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <select name="relative_civil_status_id[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" style="min-width: 150px;">
                        <option value="" disabled selected>Select status</option>
                        @foreach ($civil_status_list as $status)
                            <option value="{{ $status->id }}">{{ $status->civil_status }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <input type="text" name="relative_occupation[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter occupation" style="min-width: 150px;">
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <input type="text" name="relative_income[]" class="w-full text-lg px-2 py-1 border border-gray-300 rounded-md" placeholder="Enter income" style="min-width: 150px;">
                </td>
                <td class="border border-gray-300 px-4 py-2 hidden flex items-center justify-center" id="removeCell-${rowCount}">
                    <button type="button" onclick="removeRow(this)" class="text-red-500 hover:text-red-700">
                        <img src="../images/trashbin.png" alt="Delete" class="h-5 w-5" />
                    </button>
                </td>
            </tr>
            `;

            $('#familyTable tbody').append(newRow);
            updateRemoveIconVisibility();
        } else {
            if (errorContainer) {
                errorContainer.textContent = 'Maximum of 5 members only.';
            }
        }
    }

    function removeRow(button) {
        const row = button.closest('tr');
        row.parentNode.removeChild(row);
        rowCount--;
        updateRemoveIconVisibility();

        const errorContainer = document.getElementById('family-composition-error');
        if (errorContainer) errorContainer.textContent = '';
    }

    function updateRemoveIconVisibility() {
        const tableBody = document.getElementById('familyTable').getElementsByTagName('tbody')[0];
        const rows = tableBody.getElementsByTagName('tr');

        const removeHeader = document.getElementById('remove-header');
        if (removeHeader) removeHeader.style.display = rows.length > 1 ? '' : 'none';

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
            password.length >= 8 ? '<i class="fas fa-check text-green-500"></i> Dapat may 8 o higit pang letra' : 
            '<i class="fas fa-times text-red-500"></i> Dapat may 8 o higit pang letra';

        document.getElementById("uppercase").innerHTML = 
            /[A-Z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> Dapat may isang malaking letra (A-Z)' : 
            '<i class="fas fa-times text-red-500"></i> Dapat may isang malaking letra (A-Z)';

        document.getElementById("lowercase").innerHTML = 
            /[a-z]/.test(password) ? '<i class="fas fa-check text-green-500"></i> Dapat may isang maliit na letra (a-z)' : 
            '<i class="fas fa-times text-red-500"></i> Dapat may isang maliit na letra (a-z)';

        document.getElementById("symbol").innerHTML = 
            /[@$!%*?&]/.test(password) ? '<i class="fas fa-check text-green-500"></i> Dapat may isang simbolo (@, $, !, %, ?, &)' : 
            '<i class="fas fa-times text-red-500"></i> Dapat may isang simbolo (@, $, !, %, ?, &)';
    }

    // document.getElementById('valid_id_input').addEventListener('change', function() {
    // var file = this.files[0];

    // document.getElementById('valid_id_filename').textContent = file ? 'Image attached' : '';

    //     if (file && file.type.startsWith('image/')) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             var preview = document.getElementById('valid_id_preview');
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         document.getElementById('valid_id_preview').style.display = 'none';
    //     }
    // });

    // document.getElementById('profilePictureField').addEventListener('change', function() {
    // var file = this.files[0];

    // document.getElementById('profile_picture_filename').textContent = file ? 'Image attached' : '';

    //     if (file && file.type.startsWith('image/')) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             var preview = document.getElementById('profile_picture_preview');
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         document.getElementById('profile_picture_preview').style.display = 'none';
    //     }
    // });

    // document.getElementById('indigency_input').addEventListener('change', function() {
    // var file = this.files[0];

    // document.getElementById('indigency_filename').textContent = file ? 'Image attached' : '';

    //     if (file && file.type.startsWith('image/')) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             var preview = document.getElementById('indigency_preview');
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         document.getElementById('indigency_preview').style.display = 'none';
    //     }
    // });

    // document.getElementById('birth_certificate_input').addEventListener('change', function() {
    // var file = this.files[0];

    // document.getElementById('birth_certificate_filename').textContent = file ? 'Image attached' : '';

    //     if (file && file.type.startsWith('image/')) {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             var preview = document.getElementById('birth_certificate_preview');
    //             preview.src = e.target.result;
    //             preview.style.display = 'block';
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         document.getElementById('birth_certificate_preview').style.display = 'none';
    //     }
    // });

</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let currentStep = localStorage.getItem('currentStep') ? parseInt(localStorage.getItem('currentStep')) : 1;
    let scrollPosition = localStorage.getItem('scrollPosition') ? parseInt(localStorage.getItem('scrollPosition')) : 0;

    if (currentStep > 5) {
        currentStep = 1;
        localStorage.setItem('currentStep', currentStep);
    }

    window.scrollTo(0, scrollPosition);

    function saveScrollPosition() {
        localStorage.setItem('scrollPosition', window.scrollY);
    }

    window.addEventListener('scroll', saveScrollPosition);

    const contentIds = ["content1", "content2", "content3", "content4", "content5"];
    const nextButton = document.getElementById("nextButton");
    const submitButton = document.getElementById("submit");

    const requiredFields = [
        document.getElementById("first_name"),
        document.getElementById("last_name"),
        document.getElementById("address"),
        document.getElementById("barangay_id"),
        document.getElementById("birth_year"),
        document.getElementById("birth_month"),
        document.getElementById("birth_day"),
        document.getElementById("age"),
        document.getElementById("birthplace"),
        document.getElementById("sex_id"),  
        document.getElementById("civil_status_id"),  
    ];

    const pensionerYes = document.getElementById("pensioner_yes");
    const pensionerNo = document.getElementById("pensioner_no");
    const permanentYes = document.getElementById("permanent_yes");
    const permanentNo = document.getElementById("permanent_no");
    const illnessYes = document.getElementById("illness_yes");
    const illnessNo = document.getElementById("illness_no");
    const disabilityYes = document.getElementById("disability_yes");
    const disabilityNo = document.getElementById("disability_no");
    const livingArrangements = document.getElementsByName("type_of_living_arrangement");

    const validIdInput = document.getElementById("valid_id_input");
    const birthcertificateInput = document.getElementById("birth_certificate_input");
    const indigencyInput = document.getElementById("indigency_input");

    function checkFields() {
        let allFilled = true;

        if (currentStep === 2) { 
            allFilled = requiredFields.every(input => input.value.trim() !== "");
            allFilled = allFilled && Array.from(livingArrangements).some(option => option.checked);
        } else if (currentStep === 4) { 
            allFilled = pensionerYes.checked || pensionerNo.checked;
            allFilled = allFilled && (permanentYes.checked || permanentNo.checked);
            allFilled = allFilled && (illnessYes.checked || illnessNo.checked);
            allFilled = allFilled && (disabilityYes.checked || disabilityNo.checked);
        }

        nextButton.disabled = !allFilled;
        submitButton.disabled = !allFilled;
    }

    requiredFields.forEach(input => {
        input.addEventListener("input", checkFields);
    });

    Array.from(livingArrangements).forEach(option => {
        option.addEventListener("change", checkFields);
    });

    pensionerYes.addEventListener("change", checkFields);
    pensionerNo.addEventListener("change", checkFields);
    permanentYes.addEventListener("change", checkFields);
    permanentNo.addEventListener("change", checkFields);
    illnessYes.addEventListener("change", checkFields);
    illnessNo.addEventListener("change", checkFields);
    disabilityYes.addEventListener("change", checkFields);
    disabilityNo.addEventListener("change", checkFields);

    // Listen for file input change to enable submit button
    validIdInput.addEventListener("change", checkFields);

    checkFields();


    function updateButtonVisibility() {
        const backButton = document.getElementById('backButton');

        backButton.style.display = currentStep === 1 ? 'none' : 'inline-flex';
        nextButton.style.display = currentStep === 5 ? 'none' : 'inline-flex';

        if (currentStep === 1) {
            nextButton.disabled = false;
            nextButton.setAttribute('title', '');
        } else {
            checkFields(); 
        }
    }

    function updateStepStyles() {
        const steps = [1, 2, 3, 4, 5];
        steps.forEach((step) => {
            const stepElement = document.getElementById(`step${step}`);
            const stepText = document.getElementById(`step${step}text`);
            const progress = document.getElementById(`progress${step}`);

            if (step <= currentStep) {
                stepElement.style.backgroundColor = '#1AA514';
                stepText.style.color = '#fff';
                progress.style.backgroundColor = '#1AA514';
            } else {
                stepElement.style.backgroundColor = '#A1A1AA';
                stepText.style.color = '#000';
                progress.style.backgroundColor = '#A1A1AA';
            }
        });
    }

    document.getElementById('nextButton').addEventListener('click', function () {
        if (currentStep < 5) {
            document.getElementById('content' + currentStep).style.display = 'none';
            document.getElementById('content' + (currentStep + 1)).style.display = 'block';
            currentStep++;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
            window.scrollTo(0, 0); 
        }
    });

    document.getElementById('backButton').addEventListener('click', function () {
        if (currentStep > 1) {
            document.getElementById('content' + currentStep).style.display = 'none';
            document.getElementById('content' + (currentStep - 1)).style.display = 'block';
            currentStep--;
            localStorage.setItem('currentStep', currentStep);
            updateButtonVisibility();
            updateStepStyles();
            window.scrollTo(0, 0); 
        }
    });


    updateButtonVisibility();
    updateStepStyles();

    contentIds.forEach((id, index) => {
        document.getElementById(id).style.display = currentStep === index + 1 ? 'block' : 'none';
    });

    const yearSelect = document.getElementById("birth_year");
    const monthSelect = document.getElementById("birth_month");
    const daySelect = document.getElementById("birth_day");
    const birthdateInput = document.getElementById("birthdate");
    const ageInput = document.getElementById("age");

    const birthdateLabel = document.getElementById("birthdateLabel");
    const birthdateAsterisk = document.getElementById("birthdate_asterisk");
    const birthdateMessage = document.getElementById("birthdateMessage");

    const ageLabel = document.getElementById("ageLabel");
    const ageAsterisk = document.getElementById("age_asterisk");
    const validIconAge = document.getElementById("validIconAge");
    const invalidIconAge = document.getElementById("invalidIconAge");
    const ageMessage = document.getElementById("ageMessage");

    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 60;

    // Populate year dropdown
    for (let year = startYear; year >= 1900; year--) {
        let option = new Option(year, year);
        yearSelect.appendChild(option);
    }

    function populateDays() {
        let year = parseInt(yearSelect.value);
        let month = parseInt(monthSelect.value);
        if (!year || !month) return;

        let daysInMonth = new Date(year, month, 0).getDate();
        daySelect.innerHTML = '<option value="">Day</option>';

        for (let day = 1; day <= daysInMonth; day++) {
            let option = new Option(day, day < 10 ? "0" + day : day);
            daySelect.appendChild(option);
        }

        daySelect.value = "{{ old('birth_day') }}";
    }

    function updateBirthdate() {
        const year = yearSelect.value;
        const month = monthSelect.value;
        const day = daySelect.value;

        if (year && month && day) {
            birthdateInput.value = `${year}-${month}-${day}`;
        } else {
            birthdateInput.value = "";
        }
    }

    function calculateAge() {
        if (yearSelect.value && monthSelect.value && daySelect.value) {
            const birthdate = new Date(yearSelect.value, monthSelect.value - 1, daySelect.value);
            const today = new Date();
            let age = today.getFullYear() - birthdate.getFullYear();
            const monthDiff = today.getMonth() - birthdate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            ageInput.value = age;
            validateBirthdate();
        }
    }

    function validateBirthdate() {
        const year = yearSelect.value;
        const month = monthSelect.value;
        const day = daySelect.value;

        if (year && month && day) {
            const birthdate = new Date(`${year}-${month}-${day}`);
            const today = new Date();

            if (birthdate > today) {
                birthdateAsterisk.style.display = "block";
                birthdateLabel.classList.remove("text-green-700", "text-gray-800");
                birthdateLabel.classList.add("text-red-700");
                birthdateMessage.textContent = "Birthdate cannot be in the future.";
                birthdateMessage.classList.remove("text-green-500", "hidden");
                birthdateMessage.classList.add("text-red-500");
                setFieldState("error");
                resetAgeField();
            } else {
                birthdateAsterisk.style.display = "none";
                birthdateLabel.classList.remove("text-red-700", "text-gray-800");
                birthdateLabel.classList.add("text-green-700");
                birthdateMessage.textContent = "Tama ang iyong nilagay";
                birthdateMessage.classList.remove("text-red-500", "hidden");
                birthdateMessage.classList.add("text-green-500");
                setFieldState("valid");
                updateAgeField("valid");
            }
        } else {
            birthdateAsterisk.style.display = "block";
            birthdateLabel.classList.remove("text-green-700", "text-red-700");
            birthdateLabel.classList.add("text-gray-800");
            setFieldState("default");
            resetAgeField();
        }
    }

    function setFieldState(state) {
        const states = {
            valid: ["bg-green-50", "border-green-500", "text-green-900"],
            error: ["bg-red-50", "border-red-500", "text-red-900"],
            default: ["bg-gray-100", "border-gray-500"]
        };

        yearSelect.classList.remove(...states.valid, ...states.error);
        monthSelect.classList.remove(...states.valid, ...states.error);
        daySelect.classList.remove(...states.valid, ...states.error);

        if (state === "valid") {
            yearSelect.classList.add(...states.valid);
            monthSelect.classList.add(...states.valid);
            daySelect.classList.add(...states.valid);
        } else if (state === "error") {
            yearSelect.classList.add(...states.error);
            monthSelect.classList.add(...states.error);
            daySelect.classList.add(...states.error);
        } else {
            yearSelect.classList.add(...states.default);
            monthSelect.classList.add(...states.default);
            daySelect.classList.add(...states.default);
        }
    }

    function updateAgeField(state) {
        if (state === "valid") {
            ageAsterisk.style.display = "none";
            ageInput.classList.remove("text-red-700", "border-red-500");
            ageInput.classList.add("text-green-700", "border-green-500");
            ageLabel.classList.add("text-green-700");

            validIconAge.style.display = "inline";
            invalidIconAge.style.display = "none";

            ageMessage.textContent = "Tama ang iyong nilagay";
            ageMessage.classList.remove("text-red-500", "hidden");
            ageMessage.classList.add("text-green-500");
        } else {
            resetAgeField();
        }
    }

    function resetAgeField() {
        ageInput.value = "";
        ageAsterisk.style.display = "block";
        ageInput.classList.remove("text-green-700", "border-green-500", "text-red-700", "border-red-500");
        ageInput.classList.add("text-gray-800", "border-gray-500");
        ageLabel.classList.remove("text-green-700", "text-red-700");
        ageLabel.classList.add("text-gray-800");

        validIconAge.style.display = "none";
        invalidIconAge.style.display = "none";

        ageMessage.textContent = "";
        ageMessage.classList.add("hidden");
    }

    // Event Listeners
    yearSelect.addEventListener("change", function () {
        monthSelect.disabled = !this.value;
        daySelect.disabled = true;
        populateDays();
        updateBirthdate();
        calculateAge();
    });

    monthSelect.addEventListener("change", function () {
        daySelect.disabled = !this.value;
        populateDays();
        updateBirthdate();
        calculateAge();
    });

    daySelect.addEventListener("change", function () {
        updateBirthdate();
        calculateAge();
    });

    // Restore old values on page load
    if ("{{ old('birth_year') }}") {
        yearSelect.value = "{{ old('birth_year') }}";
        monthSelect.disabled = false;
    }
    if ("{{ old('birth_month') }}") {
        monthSelect.value = "{{ old('birth_month') }}";
        daySelect.disabled = false;
    }
    if ("{{ old('birth_day') }}") {
        daySelect.value = "{{ old('birth_day') }}";
    }
    updateBirthdate();
    calculateAge();

    // function validateAge() {
    //     const value = ageInput.value.trim();
    //     ageIcon.classList.remove("hidden");

    //     const age = parseInt(value, 10);

    //     if (isNaN(age) || age < 60) {
    //         ageAsterisk.style.display = "block";
    //         ageLabel.classList.remove("text-green-700");
    //         ageLabel.classList.add("text-red-700");
    //         ageInput.classList.remove(
    //             "bg-green-50",
    //             "border-green-500",
    //             "text-green-900",
    //             "placeholder-green-700",
    //             "focus:ring-green-500",
    //             "focus:border-green-500"
    //         );
    //         ageInput.classList.add(
    //             "bg-red-50",
    //             "border-red-500",
    //             "text-red-900",
    //             "placeholder-red-700",
    //             "focus:ring-red-500",
    //             "focus:border-red-500"
    //         );
    //         ageMessage.textContent = "Age must be 60 years old or above.";
    //         ageMessage.classList.remove("text-green-500", "hidden");
    //         ageMessage.classList.add("text-red-500");
    //         validIconAge.classList.add("hidden");
    //         invalidIconAge.classList.remove("hidden");
    //     } else {
    //         ageAsterisk.style.display = "none";
    //         ageLabel.classList.remove("text-red-700");
    //         ageLabel.classList.add("text-green-700");
    //         ageInput.classList.remove(
    //             "bg-red-50",
    //             "border-red-500",
    //             "text-red-900",
    //             "placeholder-red-700",
    //             "focus:ring-red-500",
    //             "focus:border-red-500"
    //         );
    //         ageInput.classList.add(
    //             "bg-green-50",
    //             "border-green-500",
    //             "text-green-900",
    //             "placeholder-green-700",
    //             "focus:ring-green-500",
    //             "focus:border-green-500"
    //         );
    //         ageMessage.textContent = "Tama ang iyong nilagay";
    //         ageMessage.classList.remove("text-red-500", "hidden");
    //         ageMessage.classList.add("text-green-500");
    //         validIconAge.classList.remove("hidden");
    //         invalidIconAge.classList.add("hidden");
    //     }

    //     if (value === "") {
    //         ageAsterisk.style.display = "block";
    //         ageLabel.classList.remove("text-green-700", "text-red-700");
    //         ageLabel.classList.add("text-gray-800");
    //         ageInput.classList.remove(
    //             "bg-green-50",
    //             "border-green-500",
    //             "text-green-900",
    //             "placeholder-green-700",
    //             "focus:ring-green-500",
    //             "focus:border-green-500",
    //             "bg-red-50",
    //             "border-red-500",
    //             "text-red-900",
    //             "placeholder-red-700",
    //             "focus:ring-red-500",
    //             "focus:border-red-500"
    //         );
    //         ageInput.classList.add(
    //             "bg-gray-100",
    //             "border-gray-500",
    //             "focus:ring-blue-500",
    //             "focus:border-blue-500"
    //         );
    //         ageMessage.classList.add("hidden");
    //         ageIcon.classList.add("hidden");
    //     }
    // }

    // ageInput.addEventListener("input", validateAge);

    // flatpickr(birthdateInput, {
    //     dateFormat: "Y-m-d",
    //     maxDate: new Date().setFullYear(new Date().getFullYear() - 60),
    //     minDate: "1900-01-01",
    //     onChange: function (selectedDates) {
    //         if (selectedDates.length > 0) {
    //             const birthdate = selectedDates[0];
    //             const today = new Date();
    //             let age = today.getFullYear() - birthdate.getFullYear();
    //             const m = today.getMonth() - birthdate.getMonth();
    //             if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
    //                 age--;
    //             }
    //             ageInput.value = age;
    //             validateBirthdate();
    //             validateAge(age);
    //         }
    //     }
    // });


    // validateAge();

});
</script>

@include('partials.senior_citizen.footer')
