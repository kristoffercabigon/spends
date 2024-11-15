<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title !== "" ? $title : 'SPENDS System'}}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {!!htmlScriptTagJsApi()!!}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
</head>
<body class="bg-white font-poppins min-h-screen">
    <x-messages.admin.messages />
    <x-messages.admin.error_messages />

@php $array = array('title' => 'SPENDS') @endphp
<x-admin_dashboard_nav :data="$array"/>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <div class="flex items-center justify-center font-poppins lg:pl-[80px]">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="text-center md:text-left">
                            Dashboard
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                </div>
            </div>
        </div>
    </div>
</div>
</section>

</body>
</html>

