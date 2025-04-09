@include('partials.admin.admin_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-admin_dashboard_nav :data="$array"/>

<section x-data="{
showAdminViewEventModal: localStorage.getItem('showAdminViewEventModal') === 'true',
showAdminDeleteEventModal: localStorage.getItem('showAdminDeleteEventModal') === 'true',
}"
class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
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
                                Events List
                            </p>
                        </div>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="grid mb-4 grid-cols-1 md:grid-cols-2 gap-4">
                        <div>

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
                            <div class="flex mb-4 relative justify-start md:justify-end">
                                <div class="relative w-[50%]">
                                    <select id="barangay-dropdown" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5">
                                        <option value="all" selected>Show All Barangays</option>
                                        @foreach ($barangayList as $barangay)
                                            <option value="{{ $barangay->id }}">{{ $barangay->barangay_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="relative flex sm:justify-start md:justify-end w-full">
                                <label class="inline-flex items-center cursor-pointer">
                                    <span class="text-sm font-medium text-gray-900">Featured Only</span>
                                    <input type="checkbox" id="featured" value="" class="sr-only peer">
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
                                    <th class="px-4 py-2 font-semibold text-left">Title</th>
                                    <th class="px-4 py-2 font-semibold text-left">Description</th>
                                    <th class="px-4 py-2 font-semibold text-left">Added by</th>
                                    <th class="px-4 py-2 font-semibold text-left">Barangay</th>
                                    <th class="px-4 py-2 font-semibold text-left">Date</th>
                                    <th class="px-4 py-2 font-semibold text-left">Featured</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $key => $event)
                                @php
                                    $defaultProfile = "https://api.dicebear.com/9.x/initials/svg?seed={$event->encoder_first_name}-{$event->encoder_last_name}";
                                    $profilePicture = $event->encoder_profile_picture 
                                    ? asset('storage/images/encoder/encoder_thumbnail_profile/' . $event->encoder_profile_picture)
                                    : $defaultProfile;
                                @endphp
                                <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }}">
                                    <td class="px-4 py-2">{{ $event->id }}</td>
                                    <td class="px-4 py-2 truncate" style="max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $event->title }}
                                    </td>
                                    <td class="px-4 py-2 truncate" style="max-width: 300px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                        {{ $event->description }}
                                    </td>
                                    <td class="px-4 py-2 gap-2">
                                        <div class="flex flex-row items-center gap-2">
                                        <img class="w-10 h-10 rounded-full ring-2 ring-white mr-2" src="{{ $profilePicture }}" alt="Profile Picture">
                                        @if ($event->event_user_type_id == 2)
                                            {{ $event->encoder_first_name }} {{ $event->encoder_last_name }}
                                        @elseif ($event->event_user_type_id == 3)
                                            {{ $event->admin_first_name }} {{ $event->admin_last_name }}
                                        @else
                                            Unknown
                                        @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">{{ $event->barangay_no}}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</td>
                                    <td class="px-4 py-2">{{ $event->is_featured ? 'Yes' : 'No' }}</td>
                                    <td class="px-4 py-2 flex justify-start items-center whitespace-nowrap w-[150px] shrink-0">
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
                                @if (!$events->onFirstPage())
                                <li>
                                    <a href="{{ $events->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($events->previousPageUrl())
                                <li>
                                    <a href="{{ $events->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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
                                    $start = max(1, $events->currentPage() - 2);
                                    $end = min($events->lastPage(), $events->currentPage() + 2);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    @if ($i == $events->currentPage())
                                    <a href="{{ $events->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                        {{ $i }}
                                    </a>
                                    @else
                                    <a href="{{ $events->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        {{ $i }}
                                    </a>
                                    @endif
                                </li>
                                @endfor

                                @if ($events->nextPageUrl())
                                <li>
                                    <a href="{{ $events->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($events->hasMorePages())
                                <li>
                                    <a href="{{ $events->url($events->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
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
<div x-show="showAdminViewEventModal" @click.away="showAdminViewEventModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_view_event')
</div>
<div x-show="showAdminDeleteEventModal" @click.away="showAdminDeleteEventModal = false" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50">
    @include('components.modal.admin.admin_delete_event')
</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const currentPage = {{ $events->currentPage() }};
    const barangayDropdown = document.getElementById("barangay-dropdown");
    const startInput = document.getElementById("datepicker-range-start");
    const endInput = document.getElementById("datepicker-range-end");
    const featuredCheckbox = document.getElementById("featured");
    const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

    const savedBarangayId = localStorage.getItem('barangayId');
    const savedStartDate = localStorage.getItem('startDate');
    const savedEndDate = localStorage.getItem('endDate');
    const orderDropdown = document.getElementById("order-dropdown");
    const savedOrder = localStorage.getItem('order') || 'asc';
    const savedIsFeatured = localStorage.getItem('isFeatured');
    
    orderDropdown.value = savedOrder;

    if (savedBarangayId) {
        barangayDropdown.value = savedBarangayId;
    }

    if (savedIsFeatured) {
        featuredCheckbox.checked = savedIsFeatured === '1';
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

    orderDropdown.addEventListener("change", function () {
        const order = this.value;
        localStorage.setItem('order', order);
        updateTable(1);
    });

    featuredCheckbox.addEventListener("change", function () {
        const isFeatured = this.checked ? 1 : 0;
        localStorage.setItem('isFeatured', isFeatured);
        updateTable(1);
    });

    function updateTable(page) {
        const barangayId = barangayDropdown.value === 'all' ? null : barangayDropdown.value;
        const startDate = startInput.value;
        const endDate = endInput.value;
        const order = orderDropdown.value;
        const isFeatured = featuredCheckbox.checked ? 1 : 0;

        fetch('/admin/events-list/filter-events-list?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                barangay_id: barangayId,
                start_date: startDate,
                end_date: endDate,
                order: order,
                is_featured: isFeatured, 
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

        data.forEach((event, index) => {
            const defaultProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${event.encoder_first_name || 'Unknown'}-${event.encoder_last_name || 'Unknown'}`;

            const profilePicture = event.encoder_profile_picture
                ? `/storage/images/encoder/encoder_thumbnail_profile/${event.encoder_profile_picture}`
                : event.admin_profile_picture
                ? `/storage/images/admin/admin_thumbnail_profile/${event.admin_profile_picture}`
                : defaultProfile;

            const addedBy = event.event_user_type_id == 2
                ? `${event.encoder_first_name || ''} ${event.encoder_last_name || ''} (Encoder)`.trim()
                : event.event_user_type_id == 3
                ? `${event.admin_first_name || ''} ${event.admin_last_name || ''} (Admin)`.trim()
                : 'Unknown';

            const formattedDate = new Date(event.event_date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });

            // <a 
            //     href="/admin/events-list/edit-event/${event.id}"
            //     class="bg-orange-500 ml-1 animate-pop hover:bg-orange-600 rounded-md p-2 cursor-pointer" 
            // >
            //     <img src="../images/pencil.png" alt="Edit Event" class="w-4 h-4">
            // </a>

            const row = `
                <tr class="${index % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'}">
                    <td class="px-4 py-2">${event.id}</td>
                    <td class="px-4 py-2 truncate" style="max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${event.title}</td>
                    <td class="px-4 py-2 truncate" style="max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">${event.description || 'Unknown'}</td>
                    <td class="px-4 py-2 gap-2">
                        <div class="flex flex-row items-center gap-2">
                        <img class="w-10 h-10 rounded-full ring-2 ring-white" src="${profilePicture}" alt="Profile Picture">
                        <span>${addedBy}</span>
                        </div>
                    </td>
                    <td class="px-4 py-2">${event.barangay_no}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2">${event.is_featured === 1 ? 'Yes' : 'No'}</td>
                    <td class="px-4 py-2 flex justify-start items-center whitespace-nowrap w-[150px] shrink-0">
                        <a 
                            href="javascript:void(0)" 
                            class="bg-blue-500 animate-pop hover:bg-blue-600 rounded-md p-2 cursor-pointer" 
                            @click="showAdminViewEventModal = true; 
                            localStorage.setItem('showAdminViewEventModal', 'true');
                            loadEventDataForView(${event.id})"
                        >
                            <img src="../images/view-senior.png" alt="View Event" class="w-4 h-4">
                        </a>
                        
                        <a 
                            href="javascript:void(0)" 
                            class="bg-red-500 ml-1 animate-pop hover:bg-red-600 rounded-md p-2 cursor-pointer" 
                            @click="showAdminDeleteEventModal = true; 
                            localStorage.setItem('showAdminDeleteEventModal', 'true');
                            loadEventDataForDelete(${event.id})"
                        >
                            <img src="../images/trashbin-white.png" alt="Delete Event" class="w-4 h-4">
                        </a>
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
        XLSX.writeFile(wb, `events_${adminFirstName}_${adminLastName}_${userRole}_${currentDate}.xlsx`);
    }

    function exportToImage() {
        html2canvas(document.querySelector('table')).then(canvas => {
            let link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = `events_${adminFirstName}_${adminLastName}_${userRole}_${currentDate}.png`;
            link.click();
        });
    }
</script>

</body>
</html>

