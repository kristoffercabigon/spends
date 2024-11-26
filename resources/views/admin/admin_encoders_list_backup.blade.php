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
    
    <div class="absolute inset-0 rounded-md bg-white mx-4 my-4 lg:ml-[95px] z-10"></div>
    
    <div class="relative flex items-center justify-center font-poppins lg:pl-[80px] z-20">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 mb-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="w-full">
                        <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            <p class="text-center md:text-left">
                                Encoders List
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

                            <div id="date-range-picker" class="flex justify-start items-center">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-md focus:ring-[#1AA514] focus:border-[#1AA514] block w-full ps-10 p-2.5 pr-10" placeholder="Select date start">
                                    <button type="button" id="clear-start" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white bg-[#1AA514] hover:bg-green-600 rounded-tl-none rounded-br-md rounded-tr-md p-1 pl-3">
                                        Clear
                                    </button>
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 1 0 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full ps-10 p-2.5 pr-10" placeholder="Select date end">
                                    <button type="button" id="clear-end" class="absolute inset-y-0 right-0 flex items-center pr-3 text-white bg-[#1AA514] hover:bg-green-600 rounded-tl-none rounded-br-md rounded-tr-md rounded-bl-none p-1 pl-3">
                                        Clear
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex relative mb-4 justify-start md:justify-end">
                                <div class="relative w-[50%] lg:w-[30%]">
                                    <select id="order-dropdown" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full  p-2.5">
                                        <option value="asc" selected>Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex relative justify-start md:justify-end">
    <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-white bg-[#1AA514] hover:bg-[#148e10] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-md px-5 py-2 text-center inline-flex items-center" type="button">
        Encoder Roles
        <svg class="w-2.5 h-2.5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <div id="dropdownDefaultCheckbox" class="z-10 hidden animate-drop-in w-48 bg-white divide-y shadow-lg divide-gray-100 rounded-lg shadow absolute top-12 lg:right-0">
        <ul class="p-3 space-y-3 text-sm text-gray-700" aria-labelledby="dropdownCheckboxButton">
            <!-- View Checkbox -->
            <li>
                <div class="flex items-center">
                    <input id="checkbox-item-view" type="checkbox" value="1,2,3,4" class="checkbox-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="checkbox-item-view" class="ms-2 text-sm font-medium text-gray-900">View</label>
                </div>
            </li>
            <!-- Create Checkbox -->
            <li>
                <div class="flex items-center">
                    <input id="checkbox-item-create" type="checkbox" value="5,6,7" class="checkbox-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="checkbox-item-create" class="ms-2 text-sm font-medium text-gray-900">Create</label>
                </div>
            </li>
            <!-- Update Checkbox -->
            <li>
                <div class="flex items-center">
                    <input id="checkbox-item-update" type="checkbox" value="8,9,10,11,12" class="checkbox-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="checkbox-item-update" class="ms-2 text-sm font-medium text-gray-900">Update</label>
                </div>
            </li>
            <!-- Delete Checkbox -->
            <li>
                <div class="flex items-center">
                    <input id="checkbox-item-delete" type="checkbox" value="13,14,15" class="checkbox-item w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <label for="checkbox-item-delete" class="ms-2 text-sm font-medium text-gray-900">Delete</label>
                </div>
            </li>
        </ul>
    </div>
</div>

                        </div>
                    </div>

                    <div class="overflow-x-auto lg:overflow-hidden">
                        <table class="min-w-full table-auto drop-shadow-lg relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8" data-aos="zoom-in">
                            <thead>
                                <tr class="bg-[#FF4802] text-white">
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                                    <th class="px-4 py-2 font-semibold text-left">Encoder ID</th>
                                    <th class="px-4 py-2 font-semibold text-left">Name</th>
                                    <th class="px-4 py-2 font-semibold text-left">Encoder Roles</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Date Registered</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encoders as $key => $encoder)
                                @php
                                    $default_profile = "https://api.dicebear.com/9.x/initials/svg?seed=".$encoder->encoder_first_name."-".$encoder->encoder_last_name;
                                @endphp
                                <tr class="{{ $key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]' }}">
                                    <td class="px-4 py-2">{{ $encoder->id }}</td>
                                    <td class="px-4 py-2">{{ $encoder->encoder_id }}</td>
                                    <td class="px-4 py-2 flex items-center">
                                        <img id="avatarButton" class="w-10 h-10 animate-zoom-in rounded-full ring-2 ring-white mr-2" src="{{ $encoder->encoder_profile_picture ? asset('storage/images/encoder/encoder_thumbnail_profile/'.$encoder->encoder_profile_picture) : $default_profile }}" alt="Profile Picture">
                                        <span>
                                            {{ $encoder->encoder_first_name }} 
                                            {{$encoder->encoder_middle_name}}
                                            {{ $encoder->encoder_last_name }}
                                            @if ($encoder->encoder_suffix)
                                                , {{ $encoder->encoder_suffix }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $encoder->encoder_role }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($encoder->encoder_date_registered)->format('F j, Y') }}</td>
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
                                @if (!$encoders->onFirstPage())
                                <li>
                                    <a href="{{ $encoders->url(1) }}" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($encoders->previousPageUrl())
                                <li>
                                    <a href="{{ $encoders->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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
                                    $start = max(1, $encoders->currentPage() - 2);
                                    $end = min($encoders->lastPage(), $encoders->currentPage() + 2);
                                @endphp

                                @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    @if ($i == $encoders->currentPage())
                                    <a href="{{ $encoders->url($i) }}" class="flex items-center justify-center px-4 h-10 text-white bg-[#1AA514] border border-[#30ae2b] hover:bg-green-600">
                                        {{ $i }}
                                    </a>
                                    @else
                                    <a href="{{ $encoders->url($i) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
                                        {{ $i }}
                                    </a>
                                    @endif
                                </li>
                                @endfor

                                @if ($encoders->nextPageUrl())
                                <li>
                                    <a href="{{ $encoders->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] hover:bg-gray-100 hover:text-gray-700">
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

                                @if ($encoders->hasMorePages())
                                <li>
                                    <a href="{{ $encoders->url($encoders->lastPage()) }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-[#30ae2b] rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
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
        const dropdownButton = document.getElementById('dropdownCheckboxButton');
        const dropdown = document.getElementById('dropdownDefaultCheckbox');
        const checkboxes = document.querySelectorAll('.checkbox-item');
        const startInput = document.getElementById("datepicker-range-start");
        const endInput = document.getElementById("datepicker-range-end");
        const searchDropdown = document.getElementById("search-dropdown");
        const orderDropdown = document.getElementById("order-dropdown");
        const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

        const savedStartDate = localStorage.getItem('encoderStartDate');
        const savedEndDate = localStorage.getItem('encoderEndDate');
        const savedSearchQuery = localStorage.getItem('encoderSearchQuery') || '';
        const encoderSelectedRoles = localStorage.getItem('encoderSelectedRoles') || '';
        const savedOrder = localStorage.getItem('encoderOrder') || 'asc';
        const currentPage =  {{ $encoders->currentPage() }};

        orderDropdown.value = savedOrder;
        searchDropdown.value = savedSearchQuery;

        // Dropdown toggle
        dropdownButton.addEventListener('click', function () {
            dropdown.classList.toggle('hidden');
        });

        // Function to get selected roles as a comma-separated string
        function getSelectedRoles() {
            let selectedRoles = '';
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    if (selectedRoles) {
                        selectedRoles += ', ';
                    }
                    selectedRoles += checkbox.value;
                }
            });
            return selectedRoles;
        }

        // Automatically checkboxes based on localStorage and add event listeners
        // Restore checkbox states based on localStorage
    const storedRoles = encoderSelectedRoles.split(',').map(role => role.trim());


    checkboxes.forEach(checkbox => {
        // Restore checked state
        if (storedRoles.includes(checkbox.value)) {
            checkbox.checked = true;
        }

        // Add event listener to save changes to localStorage
        checkbox.addEventListener('change', function () {
            const updatedRoles = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value)
                .join(', ');

            localStorage.setItem('encoderSelectedRoles', updatedRoles);
            updateTable(1);
        });
    });

        // Datepicker initialization
        const startPicker = flatpickr(startInput, {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            maxDate: new Date(),
            defaultDate: savedStartDate || null,
            onClose: function (selectedDates) {
                const encoderStartDate = selectedDates[0];
                localStorage.setItem('encoderStartDate', encoderStartDate ? encoderStartDate.toLocaleDateString('en-CA') : '');
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
                const encoderEndDate = selectedDates[0];
                localStorage.setItem('encoderEndDate', encoderEndDate ? encoderEndDate.toLocaleDateString('en-CA') : '');
                updateTable(1);
            }
        });

        // Clear buttons
        document.getElementById("clear-start").addEventListener("click", function () {
            startInput.value = '';
            localStorage.removeItem('encoderStartDate');
            startPicker.clear();
            updateTable(1);
        });

        document.getElementById("clear-end").addEventListener("click", function () {
            endInput.value = '';
            localStorage.removeItem('encoderEndDate');
            endPicker.clear();
            updateTable(1);
        });

        // Search input
        searchDropdown.addEventListener("keyup", function () {
            const encoderSearchQuery = searchDropdown.value.toLowerCase();
            localStorage.setItem('encoderSearchQuery', encoderSearchQuery);
            updateTable(1);
        });

        // Order dropdown
        orderDropdown.addEventListener("change", function () {
            const encoderOrder = this.value;
            localStorage.setItem('encoderOrder', encoderOrder);
            updateTable(1);
        });


    function updateTable(page) {
        const encoderStartDate = startInput.value || '';
        const encoderEndDate = endInput.value || '';
        const encoderSearchQuery = searchDropdown.value.toLowerCase();
        const encoderSelectedRoles = localStorage.getItem('encoderSelectedRoles') || ''; // Retrieve roles from localStorage
        const encoderOrder = orderDropdown.value;

        const rolesFilter = encoderSelectedRoles.length
            ? encoderSelectedRoles.split(',').map(role => role.trim())
            : []; // Handle empty roles properly

        // Send request to backend
        fetch('/admin/filter-encoders?page=' + page, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                start_date: encoderStartDate,
                end_date: encoderEndDate,
                encoder_roles_ids: rolesFilter, // Send roles as array
                search_query: encoderSearchQuery,
                order: encoderOrder,
            }),
        })
        .then(response => response.json())
        .then(data => {
            renderTable(data.data); // Render table
            renderPagination(data); // Render pagination
        })
        .catch(error => console.error('Error:', error));
    }

        // Table rendering
    function renderTable(data) {
        const tbody = document.querySelector('tbody');
        tbody.innerHTML = '';
        data.forEach((encoder, index) => {
            const defaultProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${encoder.encoder_first_name}-${encoder.encoder_last_name}`;
            const profilePicture = encoder.encoder_profile_picture
                ? `/storage/images/encoder/encoder_thumbnail_profile/${encoder.encoder_profile_picture}`
                : defaultProfile;
            const fullName = `${encoder.encoder_first_name} ${encoder.encoder_middle_name || ''} ${encoder.encoder_last_name}${encoder.encoder_suffix ? `, ${encoder.encoder_suffix}` : ''}`;
            const formattedDate = new Date(encoder.encoder_date_registered).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });
            const row = `
                <tr class="${index % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'}">
                    <td class="px-4 py-2">${encoder.id}</td>
                    <td class="px-4 py-2">${encoder.encoder_id}</td>
                    <td class="px-4 py-2 flex items-center">
                        <img class="w-10 h-10 rounded-full ring-2 ring-white mr-2" src="${profilePicture}" alt="Profile Picture">
                        ${fullName}
                    </td>
                    <td class="px-4 py-2">${encoder.encoder_role || 'No Roles'}</td>
                    <td class="px-4 py-2">${formattedDate}</td>
                    <td class="px-3 py-2 flex justify-center items-center">
                        <a href="/admin/view-encoder-profile/${encoder.id}" class="bg-blue-500 animate-pop hover:bg-blue-600 rounded-md p-2 cursor-pointer">
                            <img src="../images/view-senior.png" alt="View Senior" class="w-4 h-4">
                        </a>
                        <a href="/admin/edit-encoder-profile/${encoder.id}" class="bg-orange-500 ml-1 animate-pop hover:bg-orange-600 rounded-md p-2 cursor-pointer">
                            <img src="../images/pencil.png" alt="View Senior" class="w-4 h-4">
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


</body>
</html>

