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
            <div class="bg-white mt-4 ml-4 mr-4 mb-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="w-full">
                        <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            <p class="text-center">
                                Blockchain - Senior Beneficiaries
                            </p>
                        </div>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2">Barangay</th>
                                    <th class="border px-4 py-2">Barangay ID</th>
                                    <th class="border px-4 py-2">Total Beneficiaries</th>
                                    <th class="border px-4 py-2">Receiving Pension</th>
                                    <th class="border px-4 py-2">Stored on Blockchain</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beneficiaries as $beneficiary)
                                <tr>
                                    <td class="border px-4 py-2">{{ $beneficiary['barangay'] }}</td>
                                    <td class="border px-4 py-2">{{ $beneficiary['barangay_id'] }}</td>
                                    <td class="border px-4 py-2">{{ $beneficiary['total_beneficiaries'] }}</td>
                                    <td class="border px-4 py-2">₱{{ number_format($beneficiary['receiving_pension'], 2) }}</td>
                                    <td class="border px-4 py-2">
                                        {{ isset($beneficiary['timestamp']) ? date('Y-m-d H:i:s', strtotime($beneficiary['timestamp'])) : 'N/A' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-red-500">No data found on blockchain.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
