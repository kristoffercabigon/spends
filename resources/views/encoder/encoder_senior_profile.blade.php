@include('partials.encoder.encoder_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_dashboard_nav :data="$array"/>

<section x-data="{
        showEncoderProfilePicModal: false,
        showEncoderPreviewProfilePicModal: false,
        showEncoderApplicantBirthCertificateModal: false,
        showEncoderApplicantIndigencyModal: false,
        showEncoderApplicantValidIDModal: false,
        showEncoderApplicantSignatureModal: false,
        @php
            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
        @endphp
        previewUrl1: '{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}',
        previewEncoderUrl: '',
        previewEncoderApplicantBirthCertificateUrl: '{{ $senior->birth_certificate ? asset("storage/images/senior_citizen/birth_certificate/".$senior->birth_certificate) : ''}}',
        previewEncoderApplicantIndigencyUrl: '{{ $senior->indigency ? asset("storage/images/senior_citizen/indigency/".$senior->indigency) : ''}}',
        previewEncoderApplicantValidIDUrl: '{{ $senior->valid_id ? asset("storage/images/senior_citizen/valid_id/".$senior->valid_id) : ''}}',
        previewEncoderApplicantSignatureUrl: '{{ $senior->signature_data ? asset("storage/images/senior_citizen/signatures/".$senior->signature_data) : ''}}',
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
                                $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                            @endphp
                            showEncoderRegisteredProfilePicModal: false,
                            previewUrl: '{{ $senior->profile_picture ? asset("storage/images/senior_citizen/profile_picture/".$senior->profile_picture) : $default_profile }}'
                        }">
                        <div class="md:flex no-wrap ">
                            <div class="w-full md:w-3/12 md:mx-2">
                                <div class="bg-white p-3 shadow-lg border-t-4 border-b-4 rounded-md 
                                    {{ $account_status && $account_status->senior_account_status == 'Active' ? 'border-green-500' : 
                                    ($account_status && $account_status->senior_account_status == 'Inactive' ? 'border-orange-500' : 
                                    ($account_status && $account_status->senior_account_status == 'Disqualified' ? 'border-yellow-500' : 
                                    ($account_status && $account_status->senior_account_status == 'Deactivated' ? 'border-red-500' : 'border-gray-500'))) }}">
                                    <div class="flex items-center hover:animate-scale cursor-pointer justify-center image overflow-hidden"
                                        @click="showEncoderRegisteredProfilePicModal = true">
                                        @php
                                            $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                                        @endphp
                                        <img class="w-48 h-48 rounded-full border-4 
                                            {{ $account_status && $account_status->senior_account_status == 'Active' ? 'border-green-500' : 
                                            ($account_status && $account_status->senior_account_status == 'Inactive' ? 'border-orange-500' : 
                                            ($account_status && $account_status->senior_account_status == 'Disqualified' ? 'border-yellow-500' : 
                                            ($account_status && $account_status->senior_account_status == 'Deactivated' ? 'border-red-500' : 'border-gray-500'))) }}"
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
                                                    <button 
                                                        class="py-1 px-2 rounded text-white text-sm truncate w-32 text-center 
                                                        {{ $account_status && $account_status->senior_account_status == 'Active' ? 'bg-green-500' : 
                                                        ($account_status && $account_status->senior_account_status == 'Inactive' ? 'bg-orange-500' : 
                                                        ($account_status && $account_status->senior_account_status == 'Disqualified' ? 'bg-yellow-500' : 
                                                        ($account_status && $account_status->senior_account_status == 'Deactivated' ? 'bg-red-500' : 'bg-gray-500'))) }} "
                                                        id="accountStatusDropdownButton">
                                                        {{ $account_status ? ucfirst($account_status->senior_account_status) : '--' }}
                                                    </button>
                                                    <div 
                                                        class="absolute right-0 mt-2 w-48 animate-drop-in bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden"
                                                        id="accountStatusDropdownMenu">
                                                        <form method="POST" action="{{ route('encoder-update-account-status', $senior->id) }}" id="accountStatusUpdateForm">
                                                            @csrf
                                                            @method('PUT')

                                                            @foreach ($senior_account_status_list as $account_status)
                                                                <button 
                                                                    type="submit" 
                                                                    name="account_status" 
                                                                    value="{{ $account_status->id }}" 
                                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                    {{ $account_status->senior_account_status }}
                                                                </button>
                                                            @endforeach

                                                        </form>
                                                    </div>
                                                </div>
                                            </span>
                                        </li>
                                        <li class="flex items-center py-3">
                                            <span>Application Status</span>
                                            <span class="ml-auto">
                                                <div class="relative inline-block text-left">
                                                    <button 
                                                        class="py-1 px-2 rounded text-white text-sm truncate w-32 text-center 
                                                        {{ $application_status && $application_status->senior_application_status == 'Under Evaluation' ? 'bg-gray-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'On Hold' ? 'bg-orange-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'Approved' ? 'bg-green-500' : 
                                                        ($application_status && $application_status->senior_application_status == 'Rejected' ? 'bg-red-500' : 'bg-gray-500'))) }} "
                                                        id="statusDropdownButton">
                                                        {{ $application_status ? ucfirst($application_status->senior_application_status) : '--' }}
                                                    </button>
                                                    <div 
                                                        class="absolute right-0 mt-2 w-48 animate-drop-in bg-white border border-gray-200 rounded-md shadow-lg z-10 hidden"
                                                        id="statusDropdownMenu">
                                                        <form method="POST" action="{{ route('encoder-update-application-status', $senior->id) }}" id="statusUpdateForm">
                                                            @csrf
                                                            @method('PUT')

                                                            @foreach ($senior_application_status_list as $status)
                                                                <button 
                                                                    type="submit" 
                                                                    name="status" 
                                                                    value="{{ $status->id }}" 
                                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                    {{ $status->senior_application_status }}
                                                                </button>
                                                            @endforeach

                                                        </form>
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

                                <div class="my-4"></div>

                                <div class="bg-white p-3 shadow-lg border-t-4 border-b-4 rounded-md">
                                    <h1 class="text-gray-900 font-bold text-lg leading-8 my-1">Signature</h1>

                                    <div class="flex items-center hover:animate-scale cursor-pointer justify-center image overflow-hidden"
                                        @click="showEncoderApplicantSignatureModal = true">
                                        @if ($senior->signature_data)
                                            <img class="w-64 h-24 my-5 rounded-md shadow-lg"
                                                src="{{ asset('storage/images/senior_citizen/signatures/' . $senior->signature_data) }}"
                                                alt="Applicant's Signature">
                                        @else
                                            <span class="text-gray-500 text-center my-5" @click.stop>No signature yet.</span>
                                        @endif
                                    </div>
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
                                        <span class="tracking-wide text-white font-semibold">Basic Information</span>
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
                                                    {{ $sex->sex ?? 'Unknown' }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Civil Status</div>
                                                <div class="px-4 py-2">
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
                                                    {{ $barangay->barangay_no ?? 'Unknown' }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div class="px-4 py-2 font-semibold">Living Arrangement</div>
                                                <div class="px-4 py-2">
                                                    @if ($living_arrangement->id == $lastLivingArrangementId)
                                                        {{ $senior->other_arrangement_remark ?? 'No remark available' }}
                                                    @else
                                                        {{ $living_arrangement->type_of_living_arrangement_list ?? 'Unknown' }}
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
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke="white">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide text-white font-semibold">Guardian</span>
                                    </div>
                                    <div class="text-gray-700">
                                        @if (empty($senior_guardian))
                                            <div class="px-4 py-2 text-center font-light text-gray-500">None</div>
                                        @else
                                            <div class="grid md:grid-cols-2 text-sm">
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">First Name</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->guardian_first_name ?? 'None' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Middle Name</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->guardian_middle_name ?? 'None' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Last Name</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->guardian_last_name ?? 'None' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Suffix</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->guardian_suffix ?? 'None' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Relationship</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->relationship ?? 'None' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Contact Number</div>
                                                    <div class="px-4 py-2">{{ $senior_guardian->guardian_contact_no ?? 'None' }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/family.png" alt="Family Icon" class="h-5 inline">
                                        </span>
                                        <span class="tracking-wide text-white font-semibold">Family Composition</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full table-auto border-collapse">
                                                <thead class="bg-[#FF4802] text-white">
                                                    <tr class="">
                                                        <th class="px-4 py-1 text-left font-light border-t border-r border-b border-white">Name</th>
                                                        <th class="px-4 py-1 text-left font-light border border-white">Relationship</th>
                                                        <th class="px-4 py-1 text-left font-light border border-white">Age</th>
                                                        <th class="px-4 py-1 text-left font-light border border-white">Civil Status</th>
                                                        <th class="px-4 py-1 text-left font-light border border-white">Occupation</th>
                                                        <th class="px-4 py-1 text-left font-light border-t border-l border-b border-white">Income</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-sm">
                                                    @if($family_composition->every(function($family) { return is_null($family->relative_name); }))
                                                        <tr>
                                                            <td colspan="6" class="px-4 py-2 text-center border border-white">None</td>
                                                        </tr>
                                                    @else
                                                        @foreach($family_composition as $family)
                                                            <tr>
                                                                <td class="px-4 py-2 border-t border-r border-b border-white">{{ $family->relative_name ?? 'Unknown' }}</td>
                                                                <td class="px-4 py-2 border border-white">{{ $family->relationship ?? 'Unknown' }}</td>
                                                                <td class="px-4 py-2 border border-white">{{ $family->relative_age ?? 'Unknown' }}</td>
                                                                <td class="px-4 py-2 border border-white">{{ $family->civil_status ?? 'Unknown' }}</td>
                                                                <td class="px-4 py-2 border border-white">{{ $family->relative_occupation ?? 'Unemployed' }}</td>
                                                                <td class="px-4 py-2 border-t border-l border-b border-white">
                                                                    @if (is_numeric($family->relative_income))
                                                                        ₱ {{ number_format($family->relative_income) }}
                                                                    @else
                                                                        {{ $family->relative_income ?? 'Unemployed' }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/economy.png" alt="Family Icon" class="h-5 inline">
                                        </span>
                                        <span class="tracking-wide text-white font-semibold">Economic Status</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm gap-4">
                                            <div class="space-y-4">
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Is currently a pensioner?</div>
                                                    <div class="px-4 py-2">{{ $senior->pensioner == 1 ? 'Yes' : 'No' }}</div>
                                                </div>
                                                @if($senior->pensioner == 1)
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Pension amount received</div>
                                                    <div class="px-4 py-2">{{ $pension_amount->how_much_pension ?? 'Unknown' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Pension source</div>
                                                    <div class="px-4 py-2">
                                                        @if($source->isEmpty())
                                                            Unknown
                                                        @else
                                                            <ul class="list-disc pl-5">
                                                                @foreach($source as $src)
                                                                    <li>
                                                                        {{ $src->other_source_remark ?? $src->source_list ?? 'Unknown' }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="space-y-4">
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Has permanent source of income?</div>
                                                    <div class="px-4 py-2">{{ $senior->permanent_source == 1 ? 'Yes' : 'No' }}</div>
                                                </div>
                                                @if($senior->permanent_source == 1)
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Income amount received</div>
                                                    <div class="px-4 py-2">{{ $income_amount->how_much_income ?? 'Unknown' }}</div>
                                                </div>
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Income source</div>
                                                    <div class="px-4 py-2">
                                                        @if($source->isEmpty())
                                                            Unknown
                                                        @else
                                                            <ul class="list-disc pl-5">
                                                                @foreach($income_source as $income_src)
                                                                    <li>
                                                                        {{ $income_src->other_income_source_remark ?? $income_src->where_income_source ?? 'Unknown' }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/health-condition.png" alt="Family Icon" class="h-5 inline">
                                        </span>
                                        <span class="tracking-wide text-white font-semibold">Health Condition</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm gap-4">
                                            <div class="space-y-4">
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Does have existing illness?</div>
                                                    <div class="px-4 py-2">{{ $senior->has_illness == 1 ? 'Yes' : 'No' }}</div>
                                                </div>
                                                @if($senior->has_illness == 1)
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Illness</div>
                                                    <div class="px-4 py-2">{{ $senior->if_illness_yes ?? 'Unknown' }}</div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="space-y-4">
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Does have disability?</div>
                                                    <div class="px-4 py-2">{{ $senior->has_disability == 1 ? 'Yes' : 'No' }}</div>
                                                </div>
                                                @if($senior->has_disability == 1)
                                                <div class="grid grid-cols-2">
                                                    <div class="px-4 py-2 font-semibold">Disability</div>
                                                    <div class="px-4 py-2">{{ $senior->if_disability_yes ?? 'Unknown' }}</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/identification.png" alt="Family Icon" class="h-5 inline">
                                        </span>
                                        <span class="tracking-wide text-white font-semibold">Identification</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <div class="grid md:grid-cols-2 text-sm gap-4">
                                            <div class="space-y-4">
                                                <div class="px-4 pt-2 font-semibold flex items-center justify-between">
                                                    <span>Birth Certificate</span>
                                                    <a href="{{ $senior->birth_certificate ? asset('storage/images/senior_citizen/birth_certificate/'.$senior->birth_certificate) : '#' }}" 
                                                    download 
                                                    class="text-blue-500 hover:underline">
                                                        Download
                                                    </a>
                                                </div>
                                                <div class="px-4 pb-2 flex justify-center items-center">
                                                    <img class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                        src="{{ $senior->birth_certificate ? asset('storage/images/senior_citizen/birth_certificate/'.$senior->birth_certificate) : '' }}" 
                                                        alt="" 
                                                        @click="showEncoderApplicantBirthCertificateModal = true">
                                                </div>
                                                <div class="px-4 pt-2 font-semibold flex items-center justify-between">
                                                    <span>Valid ID</span>
                                                    <a href="{{ $senior->valid_id ? asset('storage/images/senior_citizen/valid_id/'.$senior->valid_id) : '#' }}" 
                                                    download 
                                                    class="text-blue-500 hover:underline">
                                                        Download
                                                    </a>
                                                </div>
                                                <div class="px-4 pb-2 flex justify-center items-center">
                                                    <img class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                        src="{{ $senior->valid_id ? asset('storage/images/senior_citizen/valid_id/'.$senior->valid_id) : '' }}" 
                                                        alt="" 
                                                        @click="showEncoderApplicantValidIDModal = true">
                                                </div>
                                            </div>

                                            <div class="space-y-4">
                                                <div class="px-4 pt-2 font-semibold flex items-center justify-between">
                                                    <span>Indigency</span>
                                                    <a href="{{ $senior->indigency ? asset('storage/images/senior_citizen/indigency/'.$senior->indigency) : '#' }}" 
                                                    download 
                                                    class="text-blue-500 hover:underline">
                                                        Download
                                                    </a>
                                                </div>
                                                <div class="px-4 pb-2 flex justify-center items-center">
                                                    <img class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" 
                                                        src="{{ $senior->indigency ? asset('storage/images/senior_citizen/indigency/'.$senior->indigency) : '' }}" 
                                                        alt="" 
                                                        @click="showEncoderApplicantIndigencyModal = true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-6"></div>

                                <div class="bg-[#ffece5] pb-3 mb-6 shadow-md rounded-md">
                                    <div class="flex bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 font-semibold text-gray-900 leading-8">
                                        <span class="text-green-500">
                                            <img src="../../images/key.png" alt="Key Icon" class="h-5 inline">
                                        </span>                             
                                    <span class="tracking-wide text-white font-semibold">Account Information</span>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('components.modal.encoder.encoder_registered_profilepic_zoom')
                        @include('components.modal.encoder.encoder_applicant_birth_certificate_zoom')
                        @include('components.modal.encoder.encoder_applicant_indigency_zoom')
                        @include('components.modal.encoder.encoder_applicant_valid_id_zoom')
                        @include('components.modal.encoder.encoder_applicant_signature_zoom')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="showEncoderProfilePicModal" @click.away="showEncoderProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_profilepic_zoom')
</div>
<div x-show="showEncoderPreviewProfilePicModal" @click.away="showEncoderPreviewProfilePicModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.encoder.encoder_preview_profilepic_zoom')
</div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('statusDropdownButton');
        const menu = document.getElementById('statusDropdownMenu');
        
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('accountStatusDropdownButton');
        const menu = document.getElementById('accountStatusDropdownMenu');
        
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>


</body>
</html>

