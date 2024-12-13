<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title !== "" ? $title : 'SPENDS System'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {!!htmlScriptTagJsApi()!!}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
</head>
<body class="bg-white font-poppins min-h-screen pt-[80px]">
    <x-messages.encoder.messages />
    <x-messages.encoder.error_messages />

@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_nav :data="$array"/>

<section class="min-h-screen font-poppins">
    <div class="text-4xl font-bold mb-6 mt-6 justify-center flex leading-tight tracking-tight text-gray-900 md:text-4xl">
        <p class="mx-[48px] text-left">
            About Us
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start" style="background-color: #FFFFFF ;">
        <div class="overflow-hidden lg:flex justify-center items-center h-full relative">

            <div class="absolute inset-0 bg-[#FFFFFF] animate-slide-out-right duration-[2000ms] delay-[1000ms]"></div>

            <img src="{{ asset('images/about_us_top.jpg') }}" alt="About Us Image" class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#FFFFFF]/100"></div>
        </div>


        <div class="z-[1] animate-fade-in-up duration-[2000ms] delay-[1000ms] flex flex-col justify-center items-end text-right pr-4 pl-4 h-full">
            <span class="text-8xl mt-4 font-bold" style="color: #FF4802;">Office of the Senior Citizen Affairs Staff</span>
            <p class="text-lg mt-8 pb-8 leading-relaxed text-black">
                The Office of the Senior Citizen Affairs (OSCA) is a government body established to cater to the needs of senior citizens in the community. It was created in line with the government’s efforts to ensure the welfare, health, and social security of elderly citizens.
            </p>
        </div>
    </div>
    <div class="mx-4 overflow-hidden lg:mx-[48px]">
        <div class="w-full max-w-7xl mx-auto flex-fol items-center justify-center font-[poppins]">
    
            <div class="text-2xl font-bold mb-6 mt-12 leading-tight tracking-tight text-gray-900 md:text-2xl">
                <p class="text-left" style="color: #1AA514;">
                    Our Story
                </p>
            </div>

            <div class="mb-16">
                <p class="text-gray-700 text-xl leading-relaxed mb-4" data-aos="fade-right"
                    data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    The Office for Senior Citizens Affairs (OSCA) in Caloocan City plays a crucial role in supporting the welfare of elderly residents. One of its key initiatives is ensuring that senior citizens are accurately registered for social services. Under the leadership of Mayor Along Malapitan, OSCA launched a house-to-house registration drive aimed at bedridden seniors or those unable to register online.
                </p>
                <p class="text-gray-700 text-xl leading-relaxed mb-4" data-aos="fade-left"
                    data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    This initiative includes door-to-door visits by city employees across all barangays on weekends. Furthermore, they have set up rectification services for cases of duplicate or disapproved registrations. This ensures that all eligible senior citizens are accounted for and can access services without issues.
                </p>
                <p class="text-gray-700 text-xl leading-relaxed" data-aos="fade-right"
                    data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    Programs like birthday cash gifts, free wheelchairs, and medicine booklets, along with pension benefits, showcase OSCA’s commitment to improving the lives of seniors in Caloocan City. The office also educates citizens about new pension laws like House Bill 10423, which proposes additional monthly stipends for non-indigent seniors.
                </p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 items-start" style="background-color: #FFFFFF;">
        <div class="flex justify-center items-center h-full relative">

            <img src="{{ asset('images/about_us_bottom.jpg') }}" alt="About Us Image" class="w-full h-full object-cover" data-aos="zoom-in">

            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#FFFFFF]/60"></div>
        </div>
    </div>
</section>

@include('partials.encoder.encoder_footer')
