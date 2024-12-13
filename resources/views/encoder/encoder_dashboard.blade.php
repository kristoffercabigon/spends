@include('partials.encoder.encoder_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_dashboard_nav :data="$array"/>

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
            <div class="bg-white mt-4 mb-4 ml-4 mr-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="text-center">
                            Dashboard
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 xl:grid-cols-2">
                        <div class="flex items-center shadow-md p-4 bg-[#F7F9FB] rounded-md">
                            <div class="mr-4">
                                <span>
                                    <img 
                                        src="{{ asset('images/list.png') }}" 
                                        alt="Pages Icon" 
                                        class="w-10 h-10 mx-auto"
                                    />
                                </span>
                            </div>

                            <div>
                                <h6
                                    class="text-md font-semibold mb-2 leading-none tracking-wider text-gray-700 uppercase"
                                >
                                    Total Application Requests
                                </h6>
                                <span class="text-4xl text-[#ff4802] font-bold">{{ number_format($totalApplicationRequests) }}</span>
                            </div>
                        </div>

                        <div class="flex items-center shadow-md p-4 bg-[#F7F9FB] rounded-md">
                            <div class="mr-4">
                                <span>
                                    <img 
                                        src="{{ asset('images/approved.png') }}" 
                                        alt="Approved Icon" 
                                        class="w-10 h-10 mx-auto"
                                    />
                                </span>
                            </div>
                            <div>
                                <h6
                                    class="text-md font-semibold mb-2 leading-none tracking-wider text-gray-700 uppercase"
                                >
                                    Total Application Requests Approved
                                </h6>
                                <span class="text-4xl text-[#ff4802] font-bold">{{ number_format($totalApplicationsApproved) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-8 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                        <div class="col-span-2 bg-[#F7F9FB] shadow-lg rounded-md" style="overflow-x: auto; width: 100%;" x-data="{ isOn: false }">
                            <div class="flex items-center justify-between p-4 border-b" style="min-width: 1500px;">
                                <h4 class="text-md font-semibold leading-none tracking-wider text-gray-700 uppercase">Beneficiaries per Barangay</h4>
                            </div>
                            <div class="relative p-4 h-72" style="min-width: 1500px;">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>

                        <div class="bg-[#F7F9FB] shadow-lg rounded-md" x-data="{ isOn: false }">
                            <div class="flex items-center justify-between p-4 border-b">
                                <h4 class="text-md font-semibold leading-none tracking-wider text-gray-700 uppercase">Application Status</h4>
                            </div>
                            <div class="relative p-4 h-72">
                                <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
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
                    </div>

                    <div class="overflow-x-auto drop-shadow-lg">
                        <table class="min-w-full table-auto relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8">
                            <thead>
                                <tr class="bg-[#FF4802] text-white">
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                                    <th class="px-4 py-2 font-semibold text-left">OSCA ID</th>
                                    <th class="px-4 py-2 font-semibold text-left">Recent Beneficiaries</th>
                                    <th class="px-4 py-2 font-semibold text-left">Age</th>
                                    <th class="px-4 py-2 font-semibold text-left">Sex</th>
                                    <th class="px-4 py-2 font-semibold text-left">Account Status</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Barangay</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Date Applied</th>
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
                                    <td class="px-4 py-2">{{ $senior->senior_account_status ?? 'Not yet approved.' }}</td>
                                    <td class="px-4 py-2">{{ $senior->barangay_no }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($senior->date_applied)->format('F j, Y') }}</td>
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
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
<script>
      document.addEventListener('DOMContentLoaded', () => {
        const getColor = () => {
            if (window.localStorage.getItem('color')) {
            return window.localStorage.getItem('color')
            }
            return 'green'
        }

        const setColors = (color) => {
            const root = document.documentElement
            root.style.setProperty('--color-primary', `var(--color-${color})`)
            root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
            root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
            root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
            root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
            root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
            root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
            this.selectedColor = color
            window.localStorage.setItem('color', color)
        }

        const updateBarChart = (on) => {
            const data = {
            data: randomData(),
            backgroundColor: 'rgb(207, 250, 254)',
            }
            if (on) {
            barChart.data.datasets.push(data)
            barChart.update()
            } else {
            barChart.data.datasets.splice(1)
            barChart.update()
            }
        }

        const updateDoughnutChart = (on) => {
            const data = random()
            const color = 'rgb(207, 250, 254)'
            if (on) {
            doughnutChart.data.labels.unshift('Seb')
            doughnutChart.data.datasets[0].data.unshift(data)
            doughnutChart.data.datasets[0].backgroundColor.unshift(color)
            doughnutChart.update()
            } else {
            doughnutChart.data.labels.splice(0, 1)
            doughnutChart.data.datasets[0].data.splice(0, 1)
            doughnutChart.data.datasets[0].backgroundColor.splice(0, 1)
            doughnutChart.update()
            }
        }

        const loading = true
        const color = getColor()
        const selectedColor = 'green'

        Alpine.data('dashboard', () => ({
            loading,
            color,
            selectedColor,
            setColors,
            updateBarChart,
            updateDoughnutChart,
        }))
    })
    </script>

    <script>
    const cssColors = (color) => {
        return getComputedStyle(document.documentElement).getPropertyValue(color);
    };

    const getColor = () => {
        return window.localStorage.getItem("color") ?? "green";
    };

    const colors = {
        primary: cssColors(`--color-${getColor()}`),
        primaryLight: cssColors(`--color-${getColor()}-light`),
        primaryLighter: cssColors(`--color-${getColor()}-lighter`),
        primaryDark: cssColors(`--color-${getColor()}-dark`),
        primaryDarker: cssColors(`--color-${getColor()}-darker`),
    };

    const barangays = @json(array_column($barangay_list, 'name')).map(name => name.replace(/^Barangay\s+/i, ""));
    const barangayCounts = @json(array_column($barangay_list, 'total'));

    const barChart = new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: barangays,
            datasets: [
                {
                    data: barangayCounts,
                    backgroundColor: colors.primary,
                    hoverBackgroundColor: colors.primaryDark,
                    borderRadius: 20, 
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        gridLines: false,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 50,
                            fontSize: 12,
                            fontColor: "#4B5563", 
                            fontFamily: "Open Sans, sans-serif",
                            padding: 10,
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: false,
                        ticks: {
                            fontSize: 12,
                            fontColor: "#4B5563", 
                            fontFamily: "Open Sans, sans-serif",
                            padding: 5,
                        },
                        categoryPercentage: 0.5,
                        maxBarThickness: 25,
                    },
                ],
            },
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
        },
    });

    const applicationStatusData = @json($applicationStatusData);

    const labels = applicationStatusData.map(item => item.status); 
    const data = applicationStatusData.map(item => item.total); 

    const doughnutChart = new Chart(document.getElementById("doughnutChart"), {
        type: "doughnut",
        data: {
            labels: labels,
            datasets: [
                {
                    data: data,  
                    backgroundColor: [
                        'rgb(107, 114, 128)', 
                        'rgb(255, 159, 28)',  
                        'rgb(34, 197, 94)',   
                        'rgb(239, 68, 68)'    
                    ],
                    hoverBackgroundColor: [
                        'rgb(75, 85, 99)',    
                        'rgb(255, 132, 32)',  
                        'rgb(22, 163, 74)',   
                        'rgb(220, 38, 38)'    
                    ],
                    borderWidth: 0,
                    weight: 0.5,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: "bottom",
                labels: {
                    fontColor: "#4B5563", 
                },
            },
            title: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true,
            },
        },
    });

    </script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = {{ $seniors->currentPage() }};
        const searchDropdown = document.getElementById("search-dropdown");
        const paginationContainer = document.querySelector("nav[aria-label='Page navigation example'] ul");

        const savedSearchQuery = localStorage.getItem('beneficiarySearchQuery') || '';

        searchDropdown.value = savedSearchQuery;

        searchDropdown.addEventListener("keyup", function () {
            const beneficiarySearchQuery = searchDropdown.value.toLowerCase();
            localStorage.setItem('beneficiarySearchQuery', beneficiarySearchQuery);
            updateTable(1);
        });

        function updateTable(page) {
            const beneficiarySearchQuery = searchDropdown.value.toLowerCase();

            fetch('/encoder/dashboard/filter-dashboard-beneficiaries?page=' + page, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    search_query: beneficiarySearchQuery,
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
                        <td class="px-4 py-2">${senior.senior_account_status || 'Not yet approved.'}</td>
                        <td class="px-4 py-2">${senior.barangay_no}</td>
                        <td class="px-4 py-2">${formattedDate}</td>
                        
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

