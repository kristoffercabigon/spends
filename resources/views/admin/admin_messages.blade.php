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
                                Messages
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
                                    <select id="message-type-dropdown" class="bg-gray-50 mb-4 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5">
                                        <option value="all" selected>Show All Message Type</option>
                                        @foreach ($message_types as $message_type)

                                                <option value="{{ $message_type->id }}">{{ $message_type->message_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                    <th class="px-4 py-2 font-semibold text-left">Name</th>
                                    <th class="px-4 py-2 font-semibold text-left">Sent by</th>
                                    <th class="px-4 py-2 font-semibold text-left">Sent to</th>
                                    <th class="px-4 py-2 font-semibold text-left">Subject</th>
                                    <th class="px-4 py-2 font-semibold text-left">Message</th>
                                    <th class="px-4 py-2 font-semibold text-left">Date</th>
                                    <th class="px-4 py-2 font-semibold text-left">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $key => $message)
                                    <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }}">
                                        <td class="px-4 py-2">{{ $message->id }}</td>
                                        <td class="px-4 py-2">{{ $message->name }}</td>
                                        <td class="px-4 py-2">{{ $message->sent_by_email }}</td>
                                        <td class="px-4 py-2">{{ $message->sent_to_email }}</td>
                                        <td class="px-4 py-2">{{ $message->subject }}</td>
                                        <td class="px-4 py-2">{{ $message->message }}</td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('Asia/Manila')->format('F j, Y') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($message->created_at)->setTimezone('Asia/Manila')->format('g:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <nav aria-label="Page navigation example" class="w-full">
                            <ul class="flex flex-wrap justify-center">
                                @if (!$messages->onFirstPage())
                                <li>
                                    <a href="{{ $messages->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($messages->previousPageUrl())
                                <li>
                                    <a href="{{ $messages->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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
                                    $start = max(1, $messages->currentPage() - 2);
                                    $end = min($messages->lastPage(), $messages->currentPage() + 2);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    @if ($i == $messages->currentPage())
                                    <a href="{{ $messages->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                        {{ $i }}
                                    </a>
                                    @else
                                    <a href="{{ $messages->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        {{ $i }}
                                    </a>
                                    @endif
                                </li>
                                @endfor

                                @if ($messages->nextPageUrl())
                                <li>
                                    <a href="{{ $messages->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($messages->hasMorePages())
                                <li>
                                    <a href="{{ $messages->url($messages->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
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
    document.addEventListener("DOMContentLoaded", function () {
    const currentPage = {{ $messages->currentPage() }};
    const startInput = document.getElementById("datepicker-range-start");
    const endInput = document.getElementById("datepicker-range-end");
    const searchDropdown = document.getElementById("search-dropdown");
    const messageTypeDropdown = document.getElementById("message-type-dropdown");
    const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

    const savedStartDate = localStorage.getItem('startDate');
    const savedEndDate = localStorage.getItem('endDate');
    const orderDropdown = document.getElementById("order-dropdown");
    const savedSearchQuery = localStorage.getItem('SearchQuery') || '';
    const savedMessageTypeId = localStorage.getItem('messageTypeId');
    const savedOrder = localStorage.getItem('order') || 'asc';

    orderDropdown.value = savedOrder;

    searchDropdown.value = savedSearchQuery;

    if (savedMessageTypeId) {
        messageTypeDropdown.value = savedMessageTypeId;
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

    messageTypeDropdown.addEventListener("change", function () {
        const messageTypeId = this.value;
        localStorage.setItem('messageTypeId', messageTypeId);
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
        const messageTypeId = messageTypeDropdown.value === 'all' ? null : messageTypeDropdown.value;
        const SearchQuery = searchDropdown.value.toLowerCase();
        const startDate = startInput.value;
        const endDate = endInput.value;
        const order = orderDropdown.value;

        fetch('/admin/messages/filter-messages?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                message_type_id: messageTypeId,
                search_query: SearchQuery,
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

    function renderTable(messages) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';

        messages.forEach((message, index) => {

            const utcDate = new Date(message.created_at + 'Z');

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
                    <td class="px-4 py-2">${message.id}</td>
                    <td class="px-4 py-2">${message.name}</td>
                    <td class="px-4 py-2">${message.sent_by_email}</td>
                    <td class="px-4 py-2">${message.sent_to_email}</td>
                    <td class="px-4 py-2">${message.subject}</td>
                    <td class="px-4 py-2">${message.message}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-4 py-2">${formattedTime}</td>
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

