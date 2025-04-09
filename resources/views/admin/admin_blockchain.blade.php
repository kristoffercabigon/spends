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
                                Stored
                            </p>
                        </div>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                    <div class="flex relative justify-start md:justify-end mt-6">
                        <button id="store-pension" 
                            class="bg-green-600 hover:bg-green-700 text-white font-light py-2 px-4 rounded">
                            Update Total Beneficiaries
                        </button>
                    </div>

                    <div class="mt-4" id="pension-data">
                        <div class="mb-4">
                            <strong>Total Beneficiaries:</strong> <span id="total-beneficiaries">0</span>
                        </div>
                        <div class="mb-4">
                            <strong>Total Pension Amount:</strong> <span id="total-pension-amount">₱0</span>
                        </div>
                        <div class="mb-4">
                            <strong>Stored Date:</strong> <span id="timestamp">Loading...</span>
                        </div>
                        <div class="mb-4">
                            <strong>Current Block Hash:</strong> 
                            <span id="current-block-hash">Loading...</span>
                        </div>
                        <div class="mb-4">
                            <strong>Previous Block Hash:</strong> 
                            <span id="previous-block-hash">Loading...</span>
                        </div>
                    </div>

                    <div class="flex relative justify-start md:justify-end">
                        <div class="relative w-[25%]">
                            <select id="year-dropdown" class="bg-gray-50 border border-[#1AA514] text-gray-900 text-sm rounded-lg focus:ring-[#1AA514] focus:border-[#1AA514] block w-full p-2.5">
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 mb-8 bg-[#F7F9FB] shadow-lg rounded-md overflow-x-auto" style="width: 100%; max-width: 100%; height: auto;">
                        <div class="flex items-center justify-between p-4 border-b">
                            <h4 class="text-md font-semibold leading-none tracking-wider text-gray-700 uppercase">Beneficiaries over the years</h4>
                        </div>
                        <div class="relative p-4" style="width: 100%; height: 500px;">
                            <canvas id="lineRegression" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <div class="bg-[#F7F9FB] shadow-lg rounded-md" style="overflow-x: auto; width: 100%;" x-data="{ isOn: false }">
                        <div class="flex items-center justify-between p-4 border-b" style="min-width: 1500px;">
                            <h4 class="text-md font-semibold leading-none tracking-wider text-gray-700 uppercase">Beneficiaries per Barangay</h4>
                        </div>
                        <div class="relative p-4 h-72" style="min-width: 1500px;">
                            <canvas id="barChart"></canvas>
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

                    <div class=" mb-8 overflow-x-auto drop-shadow-lg">
                        <table class="min-w-full table-auto relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8">
                            <thead>
                                <tr class="bg-[#FF4802] text-white">
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                                    <th class="px-4 py-2 font-semibold text-left">OSCA ID</th>
                                    <th class="px-4 py-2 font-semibold text-left">Recent Beneficiaries</th>
                                    <th class="px-4 py-2 font-semibold text-left">Age</th>
                                    <th class="px-4 py-2 font-semibold text-left">Sex</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Barangay</th>
                                    <th class="px-4 py-2 font-semibold rounded-t-md text-left">Date Approved</th>
                                </tr>
                            </thead>
                            <tbody id="seniors-table-body">
                                <!-- Data will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentYear = new Date().getFullYear();
        const yearDropdown = document.getElementById('year-dropdown');
        const ctx = document.getElementById('lineRegression').getContext('2d');
        const barChartCtx = document.getElementById('barChart').getContext('2d');
        const tableBody = document.getElementById("seniors-table-body");
        const searchInput = document.getElementById("search-dropdown");
        let lineRegression;
        let barChart;
        let originalSeniors = []; 

        // Function to fetch computed CSS colors
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

        function fetchData(year, setYears = false) {
            fetch(`/admin/blockchain/pension-data?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('total-beneficiaries').innerText = data.total_beneficiaries.toString();
                        document.getElementById('total-pension-amount').innerText = `₱${data.total_pension_amount.toLocaleString()}`;

                        const date = new Date(data.timestamp);
                        const formattedDateTime = date.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });

                        document.getElementById('timestamp').innerText = formattedDateTime;
                        document.getElementById('current-block-hash').innerText = data.current_block_hash;
                        document.getElementById('previous-block-hash').innerText = data.previous_block_hash;

                        originalSeniors = data.seniors.data;
                        renderTable(originalSeniors);

                        const chartData = data.chart_data;
                        const months = chartData.map(item => {
                            const [year, month] = item.month.split('-');
                            return new Date(year, month - 1).toLocaleString('en-US', { month: 'long' });
                        });
                        const beneficiaries = chartData.map(item => item.total_beneficiaries);

                        if (lineRegression) {
                            lineRegression.destroy();
                        }

                        lineRegression = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: `Total Beneficiaries - ${year}`,
                                    data: beneficiaries,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: '#1aa514',
                                    borderWidth: 2,
                                    pointRadius: 6,
                                    pointBackgroundColor: '#1aa514',
                                    fill: false
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            title: function (tooltipItem) {
                                                return `Month: ${tooltipItem[0].label}`;
                                            },
                                            label: function (tooltipItem) {
                                                return `Beneficiaries: ${tooltipItem.raw}`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Month',
                                            font: {
                                                size: 14
                                            }
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Beneficiaries',
                                            font: {
                                                size: 14
                                            }
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        const barangays = data.beneficiaries_per_barangay.map(item => item.barangay_name.replace(/^Barangay\s+/i, ""));
                        const barangayCounts = data.beneficiaries_per_barangay.map(item => item.total_beneficiaries);

                        if (barChart) {
                            barChart.destroy();
                        }

                        barChart = new Chart(barChartCtx, {
                            type: "bar",
                            data: {
                                labels: barangays,
                                datasets: [
                                    {
                                        label: 'Beneficiaries',
                                        data: barangayCounts,
                                        backgroundColor: colors.primary,
                                        hoverBackgroundColor: colors.primaryDark,
                                        borderRadius: 5, 
                                    },
                                ],
                            },
                            options: {
                                scales: {
                                    y: {
                                        grid: {
                                            display: false,
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                            stepSize: 50,
                                            fontSize: 12,
                                            fontColor: "#4B5563", 
                                            fontFamily: "Open Sans, sans-serif",
                                            padding: 10,
                                        },
                                        title: {
                                            display: true,
                                            text: 'Beneficiaries',
                                            font: {
                                                size: 14,
                                            },
                                        },
                                    },
                                    x: {
                                        grid: {
                                            display: false,
                                        },
                                        ticks: {
                                            fontSize: 12,
                                            fontColor: "#4B5563", 
                                            fontFamily: "Open Sans, sans-serif",
                                            padding: 5,
                                        },
                                        categoryPercentage: 0.5,
                                        barPercentage: 0.8, 
                                        maxBarThickness: 15, 
                                        title: {
                                            display: true,
                                            text: 'Barangay',
                                            font: {
                                                size: 14,
                                            },
                                        },
                                    },
                                },
                                maintainAspectRatio: false,
                                legend: {
                                    display: false,
                                },
                            },
                        });

                        if (setYears) {
                            populateYearDropdown(data.oldest_year);
                        }
                    } else {
                        console.log('Error fetching pension data');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function populateYearDropdown(oldestYear) {
            yearDropdown.innerHTML = "";

            for (let year = currentYear; year >= oldestYear; year--) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearDropdown.appendChild(option);
            }
        }

        function renderTable(seniors) {
            tableBody.innerHTML = "";
            seniors.forEach((senior, key) => {
                const defaultProfile = `https://api.dicebear.com/9.x/initials/svg?seed=${senior.first_name}-${senior.last_name}`;
                const profilePicture = senior.profile_picture
                    ? `/storage/images/senior_citizen/thumbnail_profile/${senior.profile_picture}`
                    : defaultProfile;

                const row = `
                    <tr class="${key % 2 === 0 ? 'bg-[#ffece5]' : 'bg-[#ffc8b3]'}">
                        <td class="px-4 py-2">${senior.id}</td>
                        <td class="px-4 py-2">${senior.osca_id}</td>
                        <td class="px-4 py-2 flex items-center">
                            <img class="w-10 h-10 rounded-full ring-2 ring-white mr-2" src="${profilePicture}" alt="Profile Picture">
                            <span>${senior.first_name} ${senior.middle_name ?? ''} ${senior.last_name} ${senior.suffix ? ', ' + senior.suffix : ''}</span>
                        </td>
                        <td class="px-4 py-2">${senior.age}</td>
                        <td class="px-4 py-2">${senior.sex_name ?? 'Unknown'}</td>
                        <td class="px-4 py-2">${senior.barangay_no}</td>
                        <td class="px-4 py-2">${new Date(senior.date_approved).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        fetchData(currentYear, true);
        yearDropdown.addEventListener("change", function () {
            fetchData(this.value);
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("store-pension").addEventListener("click", function () {
            let button = this;
            button.disabled = true;
            button.textContent = "Updating...";

            fetch("/admin/blockchain/store-pension-data", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Total Beneficiaries has been updated successfully.",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: data.message,
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Try Again"
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Unexpected Error",
                    text: "Something went wrong. Please try again later.",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Close"
                });
            })
            .finally(() => {
                button.disabled = false;
                button.textContent = "Update Total Beneficiaries";
            });
        });
    });
</script>

