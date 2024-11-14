@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<section class="min-h-screen font-poppins">
    <div class="text-4xl font-bold mb-6 mt-6 justify-center flex leading-tight tracking-tight text-gray-900 md:text-4xl">
        <p class="mx-[48px] text-left">
            Announcement
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start" style="background-color: #fff ;">
        <div class="flex justify-center items-center h-full relative">

            <div class="absolute inset-0 bg-[#fff] animate-slide-out-right duration-[2000ms] delay-[1000ms]"></div>

            <img src="{{ asset('images/announcement_header.jpg') }}" alt="Announcement Image" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#fff]/100"></div>
        </div>


        <div class="z-[1] animate-fade-in-up duration-[2000ms] delay-[1000ms] flex flex-col justify-center items-end text-right pr-4 pl-4 h-full">
            <span class="text-4xl mt-4 font-bold lg:text-6xl" style="color: #FF4802 ;">Stay Informed: OSCA Pension Announcements & Events.</span>
            <p class="text-black text-lg mt-8 pb-8 leading-relaxed">
                This is where you'll find the latest updates and essential information on OSCA Social Pension distribution, including schedules, eligibility, and more. Our Events section also keeps you informed about activities and gatherings in your community. Check back regularly to stay up-to-date!
            </p>
        </div>
    </div>
    <div class="mx-4 lg:mx-[48px]">
        <div class="w-full max-w-7xl mx-auto flex-fol items-center justify-center font-[poppins]">
    
            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                                <p class="text-left">
                                    Pension Distribution
                                </p>
            </div>

            <table class="min-w-full table-auto drop-shadow-lg relative bg-[#FF4802] pl-3 items-center rounded-t-md space-x-2 leading-8">
                <thead>
                    <tr class="bg-[#FF4802] text-white">
                        <th class="px-4 py-2 font-semibold rounded-t-md text-left">#</th>
                        <th class="px-4 py-2 font-semibold text-left">Barangay No.</th>
                        <th class="px-4 py-2 font-semibold text-left">Locality</th>
                        <th class="px-4 py-2 font-semibold text-left">Venue</th>
                        <th class="px-4 py-2 font-semibold text-left">Date of Distribution</th>
                        <th class="px-4 py-2 font-semibold rounded-t-md text-left">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Barangay 175</td>
                        <td class="px-4 py-2">Camarin</td>
                        <td class="px-4 py-2">Community Center</td>
                        <td class="px-4 py-2">November 17, 2024</td>
                        <td class="px-4 py-2">9:00 AM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Barangay 176</td>
                        <td class="px-4 py-2">Bagong Silang</td>
                        <td class="px-4 py-2">Barangay Hall</td>
                        <td class="px-4 py-2">November 18, 2024</td>
                        <td class="px-4 py-2">10:00 AM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">3</td>
                        <td class="px-4 py-2">Barangay 173</td>
                        <td class="px-4 py-2">Congress</td>
                        <td class="px-4 py-2">Covered Court</td>
                        <td class="px-4 py-2">November 19, 2024</td>
                        <td class="px-4 py-2">8:00 AM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">4</td>
                        <td class="px-4 py-2">Barangay 168</td>
                        <td class="px-4 py-2">Deparo</td>
                        <td class="px-4 py-2">Multipurpose Hall</td>
                        <td class="px-4 py-2">November 20, 2024</td>
                        <td class="px-4 py-2">9:30 AM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">5</td>
                        <td class="px-4 py-2">Barangay 169</td>
                        <td class="px-4 py-2">BF Homes</td>
                        <td class="px-4 py-2">Barangay Hall</td>
                        <td class="px-4 py-2">November 21, 2024</td>
                        <td class="px-4 py-2">11:00 AM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">6</td>
                        <td class="px-4 py-2">Barangay 170</td>
                        <td class="px-4 py-2">Deparo</td>
                        <td class="px-4 py-2">Covered Court</td>
                        <td class="px-4 py-2">November 22, 2024</td>
                        <td class="px-4 py-2">12:00 PM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">7</td>
                        <td class="px-4 py-2">Barangay 171</td>
                        <td class="px-4 py-2">Bagumbong</td>
                        <td class="px-4 py-2">Community Center</td>
                        <td class="px-4 py-2">November 23, 2024</td>
                        <td class="px-4 py-2">1:00 PM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">8</td>
                        <td class="px-4 py-2">Barangay 172</td>
                        <td class="px-4 py-2">Urduja</td>
                        <td class="px-4 py-2">Barangay Hall</td>
                        <td class="px-4 py-2">November 24, 2024</td>
                        <td class="px-4 py-2">2:00 PM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">9</td>
                        <td class="px-4 py-2">Barangay 173</td>
                        <td class="px-4 py-2">Congress</td>
                        <td class="px-4 py-2">Multipurpose Hall</td>
                        <td class="px-4 py-2">November 25, 2024</td>
                        <td class="px-4 py-2">3:00 PM</td>
                    </tr>
                    <tr class="bg-[#ffece5] hover:bg-[#ffc8b3] hover:bg-[#ffc8b3] hover:scale-105 transition duration-150 ease-in-out">
                        <td class="px-4 py-2">10</td>
                        <td class="px-4 py-2">Barangay 174</td>
                        <td class="px-4 py-2">Kiko</td>
                        <td class="px-4 py-2">Health Center</td>
                        <td class="px-4 py-2">November 26, 2024</td>
                        <td class="px-4 py-2">4:00 PM</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left">
                    Events
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 shadow-lg gap-4 items-start mb-16">

                <div class="relative group lg:col-span-1">
                    <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 1" class="w-full h-full object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-center p-4">
                        <p class="text-xl font-bold">Event 1</p>
                    </div>
                </div>

                <div class="lg:col-span-4 grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="relative group">
                        <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 2" class="w-full h-full object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-center p-4">
                            <p class="text-xl font-bold">Event 2</p>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 3" class="w-full h-full object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-center p-4">
                            <p class="text-xl font-bold">Event 3</p>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 4" class="w-full h-full object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-center p-4">
                            <p class="text-xl font-bold">Event 4</p>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="{{ asset('images/announcement_header.jpg') }}" alt="Event 5" class="w-full h-full object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-center p-4">
                            <p class="text-xl font-bold">Event 5</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('partials.senior_citizen.footer')
