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
                                Senior Citizen's Information
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">First Name/ Unang Pangalan</label>
                                <input name="first_name" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter first name" />
                                @error('first_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Last Name/ Huling Pangalan</label>
                                <input name="last_name" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter last name" />
                                @error('last_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Middle Name/ Gitnang Pangalan</label>
                                <input name="middle_name" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter middle name" />
                                @error('middle_name')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Suffix/ Karugtong ng Pangalan</label>
                                <input name="suffix" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter suffix (e.g., Jr., Sr., III)" />
                                @error('suffix')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Birthdate/ Kaarawan</label>
                                <div class="relative">
                                    <input name="birthdate" type="text" id="datepicker" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all cursor-pointer" placeholder="Select birthdate" readonly />
                                    @error('birthdate')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                    @enderror
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M4 21h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Age/ Edad</label>
                                <input name="age" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter age" />
                                @error('age')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Birthplace/ Lugar ng Kapanganakan</label>
                                <input name="birthplace" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter place of birth" />
                                @error('birthplace')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Sex / Kasarian</label>
                                <select name="sex" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all">
                                    <option value="" disabled selected>Select sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('sex')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Civil Status</label>
                                <select name="civil_status" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all">
                                    <option value="" disabled selected>Select civil status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                                @error('civil_status')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Employment Status</label>
                                <select name="employment_status" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all">
                                    <option value="" disabled selected>Select employment status</option>
                                    <option value="employed">Employed</option>
                                    <option value="unemployed">Unemployed</option>
                                    <option value="self_employed">Self-Employed</option>
                                    <option value="retired">Retired</option>
                                    <option value="student">Student</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('employment_status')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Religion</label>
                                <select name="religion" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all">
                                    <option value="" disabled selected>Select religion</option>
                                    <option value="catholic">Catholic</option>
                                    <option value="christianity">Christianity</option>
                                    <option value="islam">Islam</option>
                                    <option value="hinduism">Hinduism</option>
                                    <option value="buddhism">Buddhism</option>
                                    <option value="judaism">Judaism</option>
                                    <option value="atheist">Atheist</option>
                                    <option value="agnostic">Agnostic</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('religion')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Blood Type</label>
                                <select name="blood_type" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all">
                                    <option value="" disabled selected>Select blood type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="unknown">Unknown</option>
                                </select>
                                @error('blood_type')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div class="md:col-span-3">
                                <label class="text-gray-800 text-sm mb-2 block">Home Address / Tirahan</label>
                                <input name="address" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter address" />
                                @error('address')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-1">
                                <label class="text-gray-800 text-sm mb-2 block">Barangay</label>
                                <input name="barangay" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter barangay" />
                                @error('barangay')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Contact Information
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Telephone Number / Telepono</label>
                                <input name="telephone_number" type="tel" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter telephone number" />
                                @error('telephone_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Mobile Number</label>
                                <input name="mobile_number" type="tel" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter mobile number" />
                                @error('mobile_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Email Address</label>
                                <input name="existing_email" type="email" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter email" />
                                @error('existing_email')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
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
                                <label class="text-gray-800 text-sm mb-2 block">Valid ID</label>
                                <input name="valid_id" type="file" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Upload image of Valid ID" />
                                @error('valid_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Profile Picture</label>
                                <input name="profile_picture" type="file" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Upload photo of Pensioner" />
                                @error('profile_picture')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mt-8">
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">GSIS Number</label>
                                <input name="gsis_number" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter GSIS Number" />
                                @error('gsis_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">SSS Number</label>
                                <input name="sss_number" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter SSS Number" />
                                @error('sss_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">TIN Number</label>
                                <input name="tin_number" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter TIN Number" />
                                @error('tin_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Philhealth Number</label>
                                <input name="philhealth_number" type="text" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter Philhealth Number" />
                                @error('philhealth_number')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
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
                                <label class="text-gray-800 text-sm mb-2 block">Email Address</label>
                                <input name="email" type="email" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter email" />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Password</label>
                                <input name="password" type="password" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter password" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="text-gray-800 text-sm mb-2 block">Confirm Password</label>
                                <input name="password_confirmation" type="password" class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md outline-blue-500 transition-all" placeholder="Enter password" />
                                @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-2 p-1">
                                        {{$message}}
                                    </p>
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
