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
                                Activity Log
                            </p>
                        </div>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="grid mb-4 grid-cols-1 md:grid-cols-2 gap-4">
                        <div>

                            <div class="flex justify-start max-w-2xl mb-4">
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-2 border-r-2 border-[#1AA514] focus:ring-[#1AA514] focus:border-[#1AA514]" placeholder="Search name in here.." required />
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
                                    <select id="user-type-dropdown" class="bg-gray-50 mb-4 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5">
                                        <option value="all" selected>Show All User Type</option>
                                        @foreach ($user_type_lists as $user_type_list)
                                            @if ($user_type_list->id != 1)
                                                <option value="{{ $user_type_list->id }}">{{ $user_type_list->user_type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex relative mb-4 justify-start md:justify-end">
                                <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-white bg-[#1AA514] hover:bg-[#148e10] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-md px-5 py-2 text-center inline-flex items-center" type="button">
                                    Activity Type
                                    <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <div id="dropdownDefaultCheckbox" class="z-10 hidden animate-drop-in w-48 bg-white divide-y shadow-lg divide-gray-100 rounded-lg shadow absolute top-12 lg:right-0">
                                    <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownCheckboxButton">
                                        @foreach ($activity_types as $activity_type)
                                        <li>
                                            <div class="flex items-center">
                                                <input name="activity_type_checkbox" id="checkbox-item-{{ $activity_type->id }}" type="checkbox" value="{{ $activity_type->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="checkbox-item-{{ $activity_type->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $activity_type->activity_type }}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="flex relative mb-4 justify-start md:justify-end">
                                <button id="dropdownStatusButton" data-dropdown-toggle="dropdownStatus" class="text-white bg-[#1AA514] hover:bg-[#148e10] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-md px-5 py-2 text-center inline-flex items-center" type="button">
                                    Status
                                    <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <div id="dropdownStatus" class="z-10 hidden animate-drop-in w-48 bg-white divide-y shadow-lg divide-gray-100 rounded-lg shadow absolute top-12 lg:right-0">
                                    <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownStatusButton">
                                        <li>
                                            <div class="flex items-center">
                                                <input name="status_checkbox" id="checkbox-item-successful" type="checkbox" value="Successful" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="checkbox-item-successful" class="ms-2 text-sm font-medium text-gray-900">Successful</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <input name="status_checkbox" id="checkbox-item-failed" type="checkbox" value="Failed" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="checkbox-item-failed" class="ms-2 text-sm font-medium text-gray-900">Failed</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="overflow-x-auto drop-shadow-lg">
                        <table class="min-w-full table-auto relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8" data-aos="zoom-in">
                            <thead>
                                <tr class="bg-[#FF4802] text-white">
                                    
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                                    <th class="px-4 py-2 font-semibold text-left">Activity</th>
                                    <th class="px-4 py-2 font-semibold text-left">Activity Type</th>
                                    <th class="px-4 py-2 font-semibold text-left">Status</th>
                                    <th class="px-4 py-2 font-semibold text-left">Date</th>
                                    <th class="px-4 py-2 font-semibold text-left">Time</th>
                                    <th class="px-4 py-2 font-semibold text-left">Modified By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity_logs as $key => $activity_log)
                                    @php
                                        $defaultEncoderProfile = "https://api.dicebear.com/9.x/initials/svg?seed={$activity_log->encoder_first_name}-{$activity_log->encoder_last_name}";
                                        $defaultAdminProfile = "https://api.dicebear.com/9.x/initials/svg?seed={$activity_log->admin_first_name}-{$activity_log->admin_last_name}";
                                        
                                        $profilePicture = $activity_log->encoder_profile_picture 
                                            ? asset('storage/images/encoder/encoder_thumbnail_profile/' . $activity_log->encoder_profile_picture)
                                            : ($activity_log->activity_user_type_id == 3 && $activity_log->admin_profile_picture 
                                                ? asset('storage/images/admin/admin_thumbnail_profile/' . $activity_log->admin_profile_picture)
                                                : ($activity_log->activity_user_type_id == 3 ? $defaultAdminProfile : $defaultEncoderProfile));
                                    @endphp
                                    
                                    <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }}">
                                        <td class="px-4 py-2">{{ $activity_log->id }}</td>
                                        <td class="px-4 py-2">{{ $activity_log->activity }}</td>
                                        <td class="px-4 py-2">{{ $activity_log->activity_type }}</td>
                                        <td class="px-4 py-2">{{ $activity_log->status }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($activity_log->created_at)->setTimezone('Asia/Manila')->format('F j, Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($activity_log->created_at)->setTimezone('Asia/Manila')->format('g:i A') }}
                                        </td>
                                        <td class="px-4 py-2 gap-2">
                                            <div class="flex flex-row items-center gap-2">
                                                <img class="w-10 h-10 rounded-full ring-2 ring-white mr-2" src="{{ $profilePicture }}" alt="Profile Picture">
                                                @if ($activity_log->activity_user_type_id == 2)
                                                    {{ $activity_log->encoder_first_name }} {{ $activity_log->encoder_last_name }} ({{ $activity_log->user_type }})
                                                @elseif ($activity_log->activity_user_type_id == 3)
                                                    {{ $activity_log->admin_first_name }} {{ $activity_log->admin_last_name }} ({{ $activity_log->user_type }})
                                                @else
                                                    Unknown
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <nav aria-label="Page navigation example" class="w-full">
                            <ul class="flex flex-wrap justify-center">
                                @if (!$activity_logs->onFirstPage())
                                <li>
                                    <a href="{{ $activity_logs->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($activity_logs->previousPageUrl())
                                <li>
                                    <a href="{{ $activity_logs->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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
                                    $start = max(1, $activity_logs->currentPage() - 2);
                                    $end = min($activity_logs->lastPage(), $activity_logs->currentPage() + 2);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    @if ($i == $activity_logs->currentPage())
                                    <a href="{{ $activity_logs->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                        {{ $i }}
                                    </a>
                                    @else
                                    <a href="{{ $activity_logs->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        {{ $i }}
                                    </a>
                                    @endif
                                </li>
                                @endfor

                                @if ($activity_logs->nextPageUrl())
                                <li>
                                    <a href="{{ $activity_logs->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($activity_logs->hasMorePages())
                                <li>
                                    <a href="{{ $activity_logs->url($activity_logs->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
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
</section>

<script>
document.getElementById('dropdownCheckboxButton').addEventListener('click', function () {
    var dropdown = document.getElementById('dropdownDefaultCheckbox');
    dropdown.classList.toggle('hidden');
});
</script>

<script>
document.getElementById('dropdownStatusButton').addEventListener('click', function () {
    var dropdown = document.getElementById('dropdownStatus');
    dropdown.classList.toggle('hidden');
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const currentPage = {{ $activity_logs->currentPage() }};
    const startInput = document.getElementById("datepicker-range-start");
    const endInput = document.getElementById("datepicker-range-end");
    const searchDropdown = document.getElementById("search-dropdown");
    const userTypeDropdown = document.getElementById("user-type-dropdown");
    const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

    const savedStartDate = localStorage.getItem('startDate');
    const savedEndDate = localStorage.getItem('endDate');
    const orderDropdown = document.getElementById("order-dropdown");
    const savedSearchQuery = localStorage.getItem('SearchQuery') || '';
    const SelectedActivityType = JSON.parse(localStorage.getItem('SelectedActivityType')) || [];
    const SelectedStatuses = JSON.parse(localStorage.getItem('SelectedStatuses')) || [];
    const savedUserTypeId = localStorage.getItem('userTypeId');
    const savedOrder = localStorage.getItem('order') || 'asc';

    orderDropdown.value = savedOrder;

    searchDropdown.value = savedSearchQuery;

    if (savedUserTypeId) {
        userTypeDropdown.value = savedUserTypeId;
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

    document.querySelectorAll('input[name="activity_type_checkbox"]').forEach(checkbox => {
        if (SelectedActivityType.includes(checkbox.value)) {
            checkbox.checked = true;
        }
        checkbox.addEventListener('change', function () {
            const updatedActivityType = Array.from(document.querySelectorAll('input[name="activity_type_checkbox"]:checked'))
                .map(checkbox => checkbox.value);
            localStorage.setItem('SelectedActivityType', JSON.stringify(updatedActivityType));
            updateTable(1);
        });
    });

    document.querySelectorAll('input[name="status_checkbox"]').forEach(checkbox => {
        if (SelectedStatuses.includes(checkbox.value)) {
            checkbox.checked = true;
        }
        checkbox.addEventListener('change', function () {
            const updatedStatuses = Array.from(document.querySelectorAll('input[name="status_checkbox"]:checked'))
                .map(checkbox => checkbox.value);
            localStorage.setItem('SelectedStatuses', JSON.stringify(updatedStatuses));
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

    userTypeDropdown.addEventListener("change", function () {
        const userTypeId = this.value;
        localStorage.setItem('userTypeId', userTypeId);
        updateTable(1);
    });

    searchDropdown.addEventListener("keyup", function () {
        const SearchQuery = searchDropdown.value.toLowerCase();
        localStorage.setItem('SearchQuery', SearchQuery);
        updateTable(1);
    });

    orderDropdown.addEventListener("change", function () {
        const order = this.value;
        localStorage.setItem('order', order);
        updateTable(1);
    });

    function updateTable(page) {
        const userTypeId = userTypeDropdown.value === 'all' ? null : userTypeDropdown.value;
        const SearchQuery = searchDropdown.value.toLowerCase();
        const startDate = startInput.value;
        const endDate = endInput.value;
        const SelectedActivityType = JSON.parse(localStorage.getItem('SelectedActivityType')) || [];
        const SelectedStatuses = JSON.parse(localStorage.getItem('SelectedStatuses')) || [];
        const order = orderDropdown.value;

        fetch('/admin/activity-log/filter-activity-log?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                user_type_id: userTypeId,
                search_query: SearchQuery,
                activity_ids: SelectedActivityType,
                status_ids: SelectedStatuses,
                start_date: startDate,
                end_date: endDate,
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

    function renderTable(activityLogs) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';

        activityLogs.forEach((activity, index) => {
            const defaultProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${activity.encoder_first_name || 'Unknown'}-${activity.encoder_last_name || 'Unknown'}`;

            const defaultAdminProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${activity.admin_first_name || 'Admin'}-${activity.admin_last_name || 'User'}`;

            const profilePicture = activity.encoder_profile_picture
                ? `/storage/images/encoder/encoder_thumbnail_profile/${activity.encoder_profile_picture}`
                : activity.admin_profile_picture
                ? `/storage/images/admin/admin_thumbnail_profile/${activity.admin_profile_picture}`
                : activity.activity_user_type_id == 3
                ? defaultAdminProfile
                : defaultProfile;

            const addedBy = activity.activity_user_type_id == 2
                ? `${activity.encoder_first_name || ''} ${activity.encoder_last_name || ''} (Encoder)`.trim()
                : activity.activity_user_type_id == 3
                ? `${activity.admin_first_name || ''} ${activity.admin_last_name || ''} (Admin)`.trim()
                : 'Unknown';

            const utcDate = new Date(activity.created_at + 'Z');

            const formattedDate = new Intl.DateTimeFormat('en-US', {
                timeZone: 'Asia/Manila', 
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            }).format(utcDate);

            const formattedTime = new Intl.DateTimeFormat('en-US', {
                timeZone: 'Asia/Manila', 
                hour: '2-digit',
                minute: '2-digit',
                hour12: true,
            }).format(utcDate);

            const row = `
                <tr class="${index % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'}">
                    <td class="px-4 py-2">${activity.id}</td>
                    <td class="px-4 py-2">
                        <div class="relative group">
                            <span class="cursor-pointer font-semibold text-blue-600 hover:underline">${activity.activity}</span>
                            <div class="hidden group-hover:block absolute z-10 bg-white border border-gray-200 shadow-lg rounded-md p-2 w-48 h-24 overflow-auto">
                                <p class="text-sm text-gray-700">${activity.changes || 'No changes available'}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2">${activity.activity_type}</td>
                    <td class="px-4 py-2">${activity.status}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2">${formattedTime}</td>
                    <td class="px-4 py-2 gap-2">
                        <div class="flex flex-row items-center gap-2">
                            <img class="w-10 h-10 rounded-full ring-2 ring-white" src="${profilePicture}" alt="Profile Picture">
                            <span>${addedBy}</span>
                        </div>
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


</body>
</html>

