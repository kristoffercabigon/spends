@include('partials.admin.admin_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-admin_dashboard_nav :data="$array"/>

<section x-data="{ showAdminArchiveSeniorApplicationModal: localStorage.getItem('showAdminArchiveSeniorApplicationModal') === 'true',
showAdminRestoreApplicationModal: localStorage.getItem('showAdminRestoreApplicationModal') === 'true' }" class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
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
                                Application Requests
                            </p>
                        </div>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="grid mb-4 grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="flex justify-start max-w-2xl mb-4">
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-2 border-r-2 border-[#1AA514] focus:ring-[#1AA514] focus:border-[#1AA514]" placeholder="Search by Name or OSCA ID..." required />
                                    <button type="button" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-[#1AA514] rounded-r-lg border border-[#1AA514] hover:bg-[#169f11] focus:ring-4 focus:outline-none focus:ring-[#1AA514] pointer-events-none cursor-not-allowed">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>

                            <div id="date-range-picker" class="flex justify-start mb-4 items-center">
                                <div class="relative sm:w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-md focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5 pr-10 ps-10" placeholder="Select date start">
                                    <button type="button" id="clear-start" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white bg-[#1AA514] hover:bg-[#148410] rounded-tl-none rounded-br-md rounded-tr-md p-1 pl-3">
                                        Clear
                                    </button>
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative sm:w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 1 0 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-md focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5 pr-10 ps-10" placeholder="Select date end">
                                    <button type="button" id="clear-end" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white bg-[#1AA514] hover:bg-[#148410] rounded-tl-none rounded-br-md rounded-tr-md rounded-bl-none p-1 pl-3">
                                        Clear
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-start relative">
                                <div class="relative w-[50%] lg:w-[30%]">
                                    <select id="order-dropdown" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full  p-2.5">
                                        <option value="asc" selected>Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex relative justify-start md:justify-end">
                                <div class="relative w-[50%]">
                                    <select id="barangay-dropdown" class="bg-gray-50 mb-4 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5">
                                        <option value="all" selected>Show All Barangays</option>
                                        @foreach ($barangayList as $barangay)
                                            <option value="{{ $barangay->id }}">{{ $barangay->barangay_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex relative justify-start md:justify-end">
                                <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-white bg-[#1AA514] hover:bg-[#148e10] mb-4 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-md px-5 py-2 text-center inline-flex items-center" type="button">
                                    Application Status
                                    <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <div id="dropdownDefaultCheckbox" class="z-10 hidden animate-drop-in w-48 bg-white divide-y shadow-lg divide-gray-100 rounded-lg shadow absolute top-12 lg:right-0">
                                    <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownCheckboxButton">
                                        @foreach ($applicationStatuses as $status)
                                        <li>
                                            <div class="flex items-center">
                                                <input id="checkbox-item-{{ $status->id }}" type="checkbox" value="{{ $status->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="checkbox-item-{{ $status->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $status->senior_application_status }}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="flex relative justify-start md:justify-end">
                                <label class="inline-flex items-center cursor-pointer">
                                <span class="text-sm font-medium text-gray-900">Archived Only</span>
                                <input type="checkbox" id="archived" value="" class="sr-only peer">
                                <div class="relative ml-2 w-11 h-6 bg-gray-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1AA514]"></div>
                                </label>
                            </div>

                        </div>
                    </div>

                    <button onclick="printTable()" 
                        class="mb-4 p-2 bg-white border border-gray-800 rounded-md hover:bg-gray-100">
                        <img src="../images/print.png" title="Print" alt="Print" class="h-4 w-4">
                    </button>

                    <button onclick="exportToPDF()" 
                        class="mb-4 p-2 bg-white border border-gray-800 rounded-md hover:bg-gray-100" 
                        title="Export as PDF">
                        <img src="../images/export-pdf.png" alt="Export PDF" class="h-4 w-4">
                    </button>

                    <button onclick="exportToExcel()" 
                        class="mb-4 p-2 bg-white border border-gray-800 rounded-md hover:bg-gray-100" 
                        title="Export as Excel">
                        <img src="../images/export-excel.png" alt="Export Excel" class="h-4 w-4">
                    </button>

                    <button onclick="exportToImage()" 
                        class="mb-4 p-2 bg-white border border-gray-800 rounded-md hover:bg-gray-100" 
                        title="Export as Image">
                        <img src="../images/export-image.png" alt="Export Image" class="h-4 w-4">
                    </button>

                    <div class="overflow-x-auto drop-shadow-lg">
                        <table class="min-w-full table-auto relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8" data-aos="zoom-in">
                            <thead>
                                <tr class="bg-[#FF4802] text-white">
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                                    <th class="px-4 py-2 font-semibold text-left">OSCA ID</th>
                                    <th class="px-4 py-2 font-semibold text-left">Name</th>
                                    <th class="px-4 py-2 font-semibold text-left">Age</th>
                                    <th class="px-4 py-2 font-semibold text-left">Sex</th>
                                    <th class="px-4 py-2 font-semibold text-left">Application Status</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Barangay</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Date Applied</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seniors as $key => $senior)
                                @php
                                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$senior->first_name."-".$senior->last_name;
                                @endphp
                                <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }}">
                                    <td class="px-4 py-2">{{ $senior->id }}</td>
                                    <td class="px-4 py-2">{{ $senior->osca_id }}</td>
                                    <td class="px-4 py-2 flex items-center">
                                        <img id="avatarButton" class="w-10 h-10 animate-zoom-in rounded-full ring-2 ring-white mr-2" src="{{ $senior->profile_picture ? asset('storage/images/senior_citizen/thumbnail_profile/'.$senior->profile_picture) : $default_profile }}" alt="Profile Picture">
                                        <span>
                                            {{ $senior->first_name }} 
                                            {{$senior->middle_name}}
                                            {{ $senior->last_name }}
                                            @if ($senior->suffix)
                                                , {{ $senior->suffix }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $senior->age }}</td>
                                    <td class="px-4 py-2">{{ $senior->sex_name ?? 'Unknown' }}</td>
                                    <td class="px-4 py-2">{{ $senior->senior_application_status ?? 'Unknown' }}</td>
                                    <td class="px-4 py-2">{{ $senior->barangay_no }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($senior->date_applied)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2">
                                        <!-- Add actions here (e.g., View, Edit, Delete) -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <nav aria-label="Page navigation example" class="w-full">
                            <ul class="flex flex-wrap justify-center">
                                @if (!$seniors->onFirstPage())
                                <li>
                                    <a href="{{ $seniors->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                        &laquo;&laquo;
                                    </a>
                                </li>
                                @else
                                <li>
                                    <span class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-s-lg cursor-not-allowed">
                                        &laquo;&laquo;
                                    </span>
                                </li>
                                @endif

                                @if ($seniors->previousPageUrl())
                                <li>
                                    <a href="{{ $seniors->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        &laquo;
                                    </a>
                                </li>
                                @else
                                <li>
                                    <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed">
                                        &laquo;
                                    </span>
                                </li>
                                @endif

                                @php
                                    $start = max(1, $seniors->currentPage() - 2);
                                    $end = min($seniors->lastPage(), $seniors->currentPage() + 2);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    @if ($i == $seniors->currentPage())
                                    <a href="{{ $seniors->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                        {{ $i }}
                                    </a>
                                    @else
                                    <a href="{{ $seniors->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        {{ $i }}
                                    </a>
                                    @endif
                                </li>
                                @endfor

                                @if ($seniors->nextPageUrl())
                                <li>
                                    <a href="{{ $seniors->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        &raquo;
                                    </a>
                                </li>
                                @else
                                <li>
                                    <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed">
                                        &raquo;
                                    </span>
                                </li>
                                @endif

                                @if ($seniors->hasMorePages())
                                <li>
                                    <a href="{{ $seniors->url($seniors->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                        &raquo;&raquo;
                                    </a>
                                </li>
                                @else
                                <li>
                                    <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-gray-200 border border-gray-300 rounded-e-lg cursor-not-allowed">
                                        &raquo;&raquo;
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="showAdminArchiveSeniorApplicationModal" @click.away="showAdminArchiveSeniorApplicationModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_archive_application')
</div>
<div x-show="showAdminRestoreApplicationModal" @click.away="showAdminRestoreApplicationModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_restore_application')
</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
document.getElementById('dropdownCheckboxButton').addEventListener('click', function () {
    var dropdown = document.getElementById('dropdownDefaultCheckbox');
    dropdown.classList.toggle('hidden');
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const currentPage = {{ $seniors->currentPage() }};
    const barangayDropdown = document.getElementById("barangay-dropdown");
    const startInput = document.getElementById("datepicker-range-start");
    const endInput = document.getElementById("datepicker-range-end");
    const searchDropdown = document.getElementById("search-dropdown");
    const archivedCheckbox = document.getElementById("archived");
    const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

    const savedBarangayId = localStorage.getItem('barangayId');
    const savedStartDate = localStorage.getItem('startDate');
    const savedEndDate = localStorage.getItem('endDate');
    const savedSearchQuery = localStorage.getItem('searchQuery') || '';
    const savedIsArchived = localStorage.getItem('archived');
    const selectedStatuses = JSON.parse(localStorage.getItem('selectedStatuses')) || [];
    const orderDropdown = document.getElementById("order-dropdown");
    const savedOrder = localStorage.getItem('order') || 'asc';

    orderDropdown.value = savedOrder;

    searchDropdown.value = savedSearchQuery;

    if (savedIsArchived) {
        archivedCheckbox.checked = savedIsArchived === '1';
    }

    if (savedBarangayId) {
        barangayDropdown.value = savedBarangayId;
    }

    const startPicker = flatpickr(startInput, {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        maxDate: new Date(),
        defaultDate: savedStartDate || null,
        onClose: function (selectedDates) {
            const startDate = selectedDates[0];
            localStorage.setItem('startDate', startDate ? startDate.toLocaleDateString('en-CA') : '');
            updateTable(1);
        }
    });

    const endPicker = flatpickr(endInput, {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        maxDate: new Date(),
        defaultDate: savedEndDate || null,
        onClose: function (selectedDates) {
            const endDate = selectedDates[0];
            localStorage.setItem('endDate', endDate ? endDate.toLocaleDateString('en-CA') : '');
            updateTable(1);
        }
    });

    document.querySelectorAll('#dropdownDefaultCheckbox input[type="checkbox"]').forEach(checkbox => {
        if (selectedStatuses.includes(checkbox.value)) {
            checkbox.checked = true;
        }
        checkbox.addEventListener('change', function () {
            const updatedStatuses = Array.from(document.querySelectorAll('#dropdownDefaultCheckbox input[type="checkbox"]:checked'))
                .map(checkbox => checkbox.value);
            localStorage.setItem('selectedStatuses', JSON.stringify(updatedStatuses));
            updateTable(1);
        });
    });

    document.getElementById("clear-start").addEventListener("click", function () {
        startInput.value = '';
        localStorage.removeItem('startDate');
        startPicker.clear();
        updateTable(1);
    });

    document.getElementById("clear-end").addEventListener("click", function () {
        endInput.value = '';
        localStorage.removeItem('endDate');
        endPicker.clear();
        updateTable(1);
    });

    barangayDropdown.addEventListener("change", function () {
        const barangayId = this.value;
        localStorage.setItem('barangayId', barangayId);
        updateTable(1);
    });

    searchDropdown.addEventListener("keyup", function () {
        const searchQuery = searchDropdown.value.toLowerCase();
        localStorage.setItem('searchQuery', searchQuery);
        updateTable(1);
    });

    archivedCheckbox.addEventListener("change", function () {
        const archived = this.checked ? 1 : 0;
        localStorage.setItem('archived', archived);
        updateTable(1);
    });

    orderDropdown.addEventListener("change", function () {
        const order = this.value;
        localStorage.setItem('order', order);
        updateTable(1);
    });

    function updateTable(page) {
        const barangayId = barangayDropdown.value === 'all' ? null : barangayDropdown.value;
        const startDate = startInput.value;
        const endDate = endInput.value;
        const searchQuery = searchDropdown.value.toLowerCase();
        const archived = archivedCheckbox.checked ? 1 : 0;
        const selectedStatuses = JSON.parse(localStorage.getItem('selectedStatuses')) || [];
        const order = orderDropdown.value;

        fetch('/admin/application-requests/filter-application-requests?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                is_archived: archived,
                barangay_id: barangayId,
                start_date: startDate,
                end_date: endDate,
                status_ids: selectedStatuses,
                search_query: searchQuery,
                order: order,
            }),
        })
            .then(response => response.json())
            .then(data => {
                renderTable(data.data);
                renderPagination(data);
            })
            .catch(error => console.error('Error:', error));
    }


    function renderTable(data) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach((senior, index) => {

            const defaultProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${senior.first_name}-${senior.last_name}`;

            const profilePicture = senior.profile_picture
                ? `/storage/images/senior_citizen/thumbnail_profile/${senior.profile_picture}`
                : defaultProfile;

            const fullName = `${senior.first_name} ${senior.middle_name || ''} ${senior.last_name}${senior.suffix ? `, ${senior.suffix}` : ''}`;

            const formattedDate = new Date(senior.date_applied).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });

            const actionButton = senior.is_application_archived === 0 ? `
                <a 
                    href="javascript:void(0)" 
                    class="bg-gray-500 ml-1 animate-pop hover:bg-gray-600 rounded-md p-2 cursor-pointer" 
                    @click="showAdminArchiveSeniorApplicationModal = true; 
                    localStorage.setItem('showAdminArchiveSeniorApplicationModal', 'true');
                    loadSeniorDataForArchive(${senior.id})"
                >
                    <img src="../images/archive.png" alt="Archive Senior" class="w-4 h-4">
                </a>` : `
                <a 
                    href="javascript:void(0)" 
                    class="bg-green-500 ml-1 animate-pop hover:bg-green-600 rounded-md p-2 cursor-pointer" 
                    @click="showAdminRestoreApplicationModal = true; 
                    localStorage.setItem('showAdminRestoreApplicationModal', 'true');
                    loadSeniorDataForRestore(${senior.id})"
                >
                    <img src="../images/restore.png" alt="Restore Senior" class="w-4 h-4">
                </a>`;

            const row = `
                <tr class="${index % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'}">
                    <td class="px-4 py-2">${senior.id}</td>
                    <td class="px-4 py-2">${senior.osca_id}</td>
                    <td class="px-4 py-2 flex items-center">
                        <img class="w-10 h-10 rounded-full ring-2 ring-white mr-2" src="${profilePicture}" alt="Profile Picture">
                        ${fullName}
                    </td>
                    <td class="px-4 py-2">${senior.age}</td>
                    <td class="px-4 py-2">${senior.sex_name || 'Unknown'}</td>
                    <td class="px-4 py-2">${senior.senior_application_status || 'Unknown'}</td>
                    <td class="px-4 py-2">${senior.barangay_no}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2 flex justify-start items-center whitespace-nowrap w-[150px] shrink-0">
                        <a href="/admin/application-requests/view-senior-profile/${senior.id}" class="bg-blue-500 animate-pop hover:bg-blue-600 rounded-md p-2 cursor-pointer">
                            <img src="../images/view-senior.png" alt="View Senior" class="w-4 h-4">
                        </a>
                        ${actionButton}
                    </td>
                </tr>`;
            tbody.innerHTML += row;
        });
    }

    function renderPagination(data) {
        paginationContainer.innerHTML = '';

        const paginationMeta = data.meta || {
            current_page: data.current_page,
            last_page: data.last_page,
        };

        if (!paginationMeta.current_page || !paginationMeta.last_page) {
            console.error('Invalid pagination data:', data);
            return;
        }

        const { current_page, last_page } = paginationMeta;

        const createButton = (page, text, isDisabled = false, isActive = false, additionalClasses = '') => {
            const className = isDisabled
                ? `text-gray-400 bg-gray-200 cursor-not-allowed border-[#30ae2b] ${additionalClasses}`
                : isActive
                ? `text-white bg-[#1AA514] border-[#30ae2b] ${additionalClasses}`
                : `text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 border-[#30ae2b] ${additionalClasses}`;
            return `
                <li>
                    <a href="javascript:void(0);" 
                    class="flex items-center justify-center px-4 h-10 border ${className}" 
                    ${isDisabled ? '' : `data-page="${page}"`}>
                        ${text}
                    </a>
                </li>`;
        };

        paginationContainer.innerHTML += createButton(1, '««', current_page === 1, '', 'rounded-tl-lg rounded-bl-lg');

        paginationContainer.innerHTML += createButton(current_page - 1, '«', current_page === 1);

        const start = Math.max(1, current_page - 2);
        const end = Math.min(last_page, current_page + 2);
        for (let i = start; i <= end; i++) {
            paginationContainer.innerHTML += createButton(i, i, false, i === current_page);
        }

        paginationContainer.innerHTML += createButton(current_page + 1, '»', current_page === last_page);

        paginationContainer.innerHTML += createButton(last_page, '»»', current_page === last_page, '', 'rounded-tr-lg rounded-br-lg');

        document.querySelectorAll("[data-page]").forEach(button => {
            button.addEventListener("click", function () {
                const page = this.dataset.page;
                updateTable(page);

                const url = new URL(window.location);
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);
            });
        });
    }

    updateTable(currentPage);
});

</script>

<script>
    const adminFirstName = "{{ $adminFirstName }}";
    const adminLastName = "{{ $adminLastName }}";
    const userRole = "{{ $userRole }}";
    const currentDate = new Date().toLocaleString(); 

    function printTable() {
        const table = document.querySelector('table').cloneNode(true);
        
        table.querySelectorAll('img').forEach(img => img.remove());

        const newWindow = window.open('', '', 'height=800,width=600');
        newWindow.document.write('<html><head><title>Print</title></head><body>');
        newWindow.document.write(table.outerHTML);
        newWindow.document.write('<footer>');
        newWindow.document.write(`<p>Exported by: ${adminFirstName} ${adminLastName} (${userRole})</p>`);
        newWindow.document.write(`<p>Date Exported: ${currentDate}</p>`);
        newWindow.document.write('</footer>');
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.print();
    }

    function exportToPDF() {
        const element = document.querySelector('table');
        const opt = {
            margin: 1,
            filename: `beneficiary_${adminFirstName}_${adminLastName}_${userRole}_${currentDate}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
        html2pdf().from(element).set(opt).save();
    }

    function exportToExcel() {
        const table = document.querySelector('table');
        const wb = XLSX.utils.table_to_book(table, { sheet: 'Sheet 1' });
        XLSX.writeFile(wb, `beneficiary_${adminFirstName}_${adminLastName}_${userRole}_${currentDate}.xlsx`);
    }

    function exportToImage() {
        html2canvas(document.querySelector('table')).then(canvas => {
            let link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = `beneficiary_${adminFirstName}_${adminLastName}_${userRole}_${currentDate}.png`;
            link.click();
        });
    }
</script>

</body>
</html>

