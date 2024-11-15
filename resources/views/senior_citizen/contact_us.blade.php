@include('partials.senior_citizen.header')
@php $array = array('title' => 'SPENDS') @endphp
<x-senior_nav :data="$array"/>

<style>
#InputForm.focused,
    #InputForm:hover {
        border: 2px solid 
#ff9167;
        box-shadow: 0px 10px 15px rgba(255, 72, 2, 0.4);
    }
</style>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <div class="min-h-screen flex items-center justify-center font-poppins">
        <div class="w-full max-w-7xl mx-auto font-[poppins]">
            <div class="bg-white mt-4 ml-4 mr-4 mb-16 shadow-lg rounded-md">              
                <div class="mt-5 p-5 px-6 py-10 lg:px-12">
                    <div class="text-2xl font-bold mb-6 leading-tight tracking-tight text-gray-900 md:text-2xl">
                        <p class="mx-4 text-center">
                            Contact Us
                        </p>
                    </div>

                    <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 32px; margin-bottom: 32px;">

                    <div class="mt-6 max-w-6xl max-lg:max-w-3xl mx-auto bg-white rounded-lg">
                        <div class="gap-6 md:gap-14 grid lg:grid-cols-2 items-center">
                            <div>
                                <h1 class="text-4xl font-bold" style="color: #FF4802;">Need assistance?</h1>
                                <p class="text-sm text-gray-600 mt-4 leading-relaxed">Do you need support or more information? We’re here to help. Reach out to us, and we’ll be glad to assist with your inquiries.</p>

                                 <div class="grid grid-cols-2 gap-4 block lg:left-16 max-lg: mt-6">
                                    <div class="flex flex-col shadow-md items-center justify-center rounded-lg w-full h-44 p-4 text-center bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-200 focus:outline-none focus:ring-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-blue-600" viewBox="0 0 512 512">
                                        <path d="M341.476 338.285c54.483-85.493 47.634-74.827 49.204-77.056C410.516 233.251 421 200.322 421 166 421 74.98 347.139 0 256 0 165.158 0 91 74.832 91 166c0 34.3 10.704 68.091 31.19 96.446l48.332 75.84C118.847 346.227 31 369.892 31 422c0 18.995 12.398 46.065 71.462 67.159C143.704 503.888 198.231 512 256 512c108.025 0 225-30.472 225-90 0-52.117-87.744-75.757-139.524-83.715zm-194.227-92.34a15.57 15.57 0 0 0-.517-.758C129.685 221.735 121 193.941 121 166c0-75.018 60.406-136 135-136 74.439 0 135 61.009 135 136 0 27.986-8.521 54.837-24.646 77.671-1.445 1.906 6.094-9.806-110.354 172.918L147.249 245.945zM256 482c-117.994 0-195-34.683-195-60 0-17.016 39.568-44.995 127.248-55.901l55.102 86.463a14.998 14.998 0 0 0 25.298 0l55.101-86.463C411.431 377.005 451 404.984 451 422c0 25.102-76.313 60-195 60z" data-original="#000000"></path>
                                        <path d="M256 91c-41.355 0-75 33.645-75 75s33.645 75 75 75 75-33.645 75-75-33.645-75-75-75zm0 120c-24.813 0-45-20.187-45-45s20.187-45 45-45 45 20.187 45 45-20.187 45-45 45z" data-original="#000000"></path>
                                        </svg>
                                        <h4 class="text-gray-800 text-base font-bold mt-4">Location</h4>
                                        <p class="text-sm text-gray-600 mt-2"> 887-1519 Zapote Rd, Caloocan, 1400 Metro Manila</p>
                                    </div>
                                    <div class="flex flex-col shadow-md items-center justify-center rounded-lg w-full h-44 p-4 text-center bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-200 focus:outline-none focus:ring-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-blue-600" viewBox="0 0 32 32">
                                        <path d="M8 30a1.001 1.001 0 0 1-1-1v-5H4c-1.654 0-3-1.346-3-3V5c0-1.654 1.346-3 3-3h24c1.654 0 3 1.346 3 3v16c0 1.654-1.346 3-3 3H15.851l-7.226 5.781A.998.998 0 0 1 8 30zM4 4c-.552 0-1 .449-1 1v16c0 .551.448 1 1 1h4a1 1 0 0 1 1 1v3.92l5.875-4.701A1 1 0 0 1 15.5 22H28c.552 0 1-.449 1-1V5c0-.551-.448-1-1-1z" data-original="#000000"></path>
                                        <path d="M24 12H8a1 1 0 1 1 0-2h16a1 1 0 1 1 0 2zm-8 4H8a1 1 0 1 1 0-2h8a1 1 0 1 1 0 2z" data-original="#000000"></path>
                                        </svg>
                                        <h4 class="text-gray-800 text-base font-bold mt-4">Email</h4>
                                        <p class="text-sm text-gray-600 mt-2">info@example.com</p>
                                    </div>
                                    <div class="flex flex-col shadow-md items-center justify-center rounded-lg w-full h-44 p-4 text-center bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-200 focus:outline-none focus:ring-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-blue-600" viewBox="0 0 473.806 473.806">
                                        <path d="M374.456 293.506c-9.7-10.1-21.4-15.5-33.8-15.5-12.3 0-24.1 5.3-34.2 15.4l-31.6 31.5c-2.6-1.4-5.2-2.7-7.7-4-3.6-1.8-7-3.5-9.9-5.3-29.6-18.8-56.5-43.3-82.3-75-12.5-15.8-20.9-29.1-27-42.6 8.2-7.5 15.8-15.3 23.2-22.8 2.8-2.8 5.6-5.7 8.4-8.5 21-21 21-48.2 0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5-6-6.2-12.3-12.6-18.8-18.6-9.7-9.6-21.3-14.7-33.5-14.7s-24 5.1-34 14.7l-.2.2-34 34.3c-12.8 12.8-20.1 28.4-21.7 46.5-2.4 29.2 6.2 56.4 12.8 74.2 16.2 43.7 40.4 84.2 76.5 127.6 43.8 52.3 96.5 93.6 156.7 122.7 23 10.9 53.7 23.8 88 26 2.1.1 4.3.2 6.3.2 23.1 0 42.5-8.3 57.7-24.8.1-.2.3-.3.4-.5 5.2-6.3 11.2-12 17.5-18.1 4.3-4.1 8.7-8.4 13-12.9 9.9-10.3 15.1-22.3 15.1-34.6 0-12.4-5.3-24.3-15.4-34.3l-54.9-55.1zm35.8 105.3c-.1 0-.1.1 0 0-3.9 4.2-7.9 8-12.2 12.2-6.5 6.2-13.1 12.7-19.3 20-10.1 10.8-22 15.9-37.6 15.9-1.5 0-3.1 0-4.6-.1-29.7-1.9-57.3-13.5-78-23.4-56.6-27.4-106.3-66.3-147.6-115.6-34.1-41.1-56.9-79.1-72-119.9-9.3-24.9-12.7-44.3-11.2-62.6 1-11.7 5.5-21.4 13.8-29.7l34.1-34.1c4.9-4.6 10.1-7.1 15.2-7.1 6.3 0 11.4 3.8 14.6 7l.3.3c6.1 5.7 11.9 11.6 18 17.9 3.1 3.2 6.3 6.4 9.5 9.7l27.3 27.3c10.6 10.6 10.6 20.4 0 31-2.9 2.9-5.7 5.8-8.6 8.6-8.4 8.6-16.4 16.6-25.1 24.4-.2.2-.4.3-.5.5-8.6 8.6-7 17-5.2 22.7l.3.9c7.1 17.2 17.1 33.4 32.3 52.7l.1.1c27.6 34 56.7 60.5 88.8 80.8 4.1 2.6 8.3 4.7 12.3 6.7 3.6 1.8 7 3.5 9.9 5.3.4.2.8.5 1.2.7 3.4 1.7 6.6 2.5 9.9 2.5 8.3 0 13.5-5.2 15.2-6.9l34.2-34.2c3.4-3.4 8.8-7.5 15.1-7.5 6.2 0 11.3 3.9 14.4 7.3l.2.2 55.1 55.1c10.3 10.2 10.3 20.7.1 31.3zm-154.2-286.1c26.2 4.4 50 16.8 69 35.8s31.3 42.8 35.8 69c1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.4-1.2 12.3-8.2 11.1-15.6-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3 3.7-15.6 11s3.5 14.4 10.9 15.6zm217.2 96.3c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2 3.7-15.5 11-1.2 7.4 3.7 14.3 11.1 15.6 46.6 7.9 89.1 30 122.9 63.7 33.8 33.8 55.8 76.3 63.7 122.9 1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.3-1.1 12.3-8.1 11-15.4z" data-original="#000000"></path>
                                        </svg>
                                        <h4 class="text-gray-800 text-base font-bold mt-4">Mobile</h4>
                                        <p class="text-sm text-gray-600 mt-2">+158 996 888</p>
                                    </div>
                                    
                                    <div class="flex flex-col shadow-md items-center justify-center rounded-lg w-full h-44 p-4 text-center bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-200 focus:outline-none focus:ring-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 fill-blue-600" viewBox="0 0 473.806 473.806">
                                        <path d="M374.456 293.506c-9.7-10.1-21.4-15.5-33.8-15.5-12.3 0-24.1 5.3-34.2 15.4l-31.6 31.5c-2.6-1.4-5.2-2.7-7.7-4-3.6-1.8-7-3.5-9.9-5.3-29.6-18.8-56.5-43.3-82.3-75-12.5-15.8-20.9-29.1-27-42.6 8.2-7.5 15.8-15.3 23.2-22.8 2.8-2.8 5.6-5.7 8.4-8.5 21-21 21-48.2 0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5-6-6.2-12.3-12.6-18.8-18.6-9.7-9.6-21.3-14.7-33.5-14.7s-24 5.1-34 14.7l-.2.2-34 34.3c-12.8 12.8-20.1 28.4-21.7 46.5-2.4 29.2 6.2 56.4 12.8 74.2 16.2 43.7 40.4 84.2 76.5 127.6 43.8 52.3 96.5 93.6 156.7 122.7 23 10.9 53.7 23.8 88 26 2.1.1 4.3.2 6.3.2 23.1 0 42.5-8.3 57.7-24.8.1-.2.3-.3.4-.5 5.2-6.3 11.2-12 17.5-18.1 4.3-4.1 8.7-8.4 13-12.9 9.9-10.3 15.1-22.3 15.1-34.6 0-12.4-5.3-24.3-15.4-34.3l-54.9-55.1zm35.8 105.3c-.1 0-.1.1 0 0-3.9 4.2-7.9 8-12.2 12.2-6.5 6.2-13.1 12.7-19.3 20-10.1 10.8-22 15.9-37.6 15.9-1.5 0-3.1 0-4.6-.1-29.7-1.9-57.3-13.5-78-23.4-56.6-27.4-106.3-66.3-147.6-115.6-34.1-41.1-56.9-79.1-72-119.9-9.3-24.9-12.7-44.3-11.2-62.6 1-11.7 5.5-21.4 13.8-29.7l34.1-34.1c4.9-4.6 10.1-7.1 15.2-7.1 6.3 0 11.4 3.8 14.6 7l.3.3c6.1 5.7 11.9 11.6 18 17.9 3.1 3.2 6.3 6.4 9.5 9.7l27.3 27.3c10.6 10.6 10.6 20.4 0 31-2.9 2.9-5.7 5.8-8.6 8.6-8.4 8.6-16.4 16.6-25.1 24.4-.2.2-.4.3-.5.5-8.6 8.6-7 17-5.2 22.7l.3.9c7.1 17.2 17.1 33.4 32.3 52.7l.1.1c27.6 34 56.7 60.5 88.8 80.8 4.1 2.6 8.3 4.7 12.3 6.7 3.6 1.8 7 3.5 9.9 5.3.4.2.8.5 1.2.7 3.4 1.7 6.6 2.5 9.9 2.5 8.3 0 13.5-5.2 15.2-6.9l34.2-34.2c3.4-3.4 8.8-7.5 15.1-7.5 6.2 0 11.3 3.9 14.4 7.3l.2.2 55.1 55.1c10.3 10.2 10.3 20.7.1 31.3zm-154.2-286.1c26.2 4.4 50 16.8 69 35.8s31.3 42.8 35.8 69c1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.4-1.2 12.3-8.2 11.1-15.6-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3 3.7-15.6 11s3.5 14.4 10.9 15.6zm217.2 96.3c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2 3.7-15.5 11-1.2 7.4 3.7 14.3 11.1 15.6 46.6 7.9 89.1 30 122.9 63.7 33.8 33.8 55.8 76.3 63.7 122.9 1.1 6.6 6.8 11.2 13.3 11.2.8 0 1.5-.1 2.3-.2 7.3-1.1 12.3-8.1 11-15.4z" data-original="#000000"></path>
                                        </svg>
                                        <h4 class="text-gray-800 text-base font-bold mt-4">Telephone</h4>
                                        <p class="text-sm text-gray-600 mt-2">+1-548-2588</p>
                                    </div>
                                </div>

                                <div class="flex mt-4 space-x-4">
                                    <div class="mb-2 flex justify-center space-x-2">
                                        <a
                                            href="#!"
                                            type="button"
                                            class="rounded-full bg-transparent hover:animate-scale p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-400 focus:outline-none focus:ring-0"
                                            data-twe-ripple-init>
                                            <span class="[&>svg]:h-5 [&>svg]:w-5">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="#1F2937"
                                                viewBox="0 0 320 512">
                                                <path
                                                d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                                            </svg>
                                            </span>
                                        </a>

                                        <a
                                            href="#!"
                                            type="button"
                                            class="rounded-full bg-transparent hover:animate-scale p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-400 focus:outline-none focus:ring-0"
                                            data-twe-ripple-init>
                                            <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="#1F2937"
                                                viewBox="0 0 512 512">
                                                <path
                                                d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                            </svg>
                                            </span>
                                        </a>

                                        <a
                                            href="#!"
                                            type="button"
                                            class="rounded-full bg-transparent hover:animate-scale p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-orange-400 focus:outline-none focus:ring-0"
                                            data-twe-ripple-init>
                                            <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="#1F2937"
                                                viewBox="0 0 448 512">
                                                <path
                                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                            </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="InputForm" class="bg-[#fff] p-6 rounded-lg hover:ring-1 hover:ring-[#FF4802] hover:shadow-xs hover:shadow-[#FF4802] transition-all">
                                <form class="mt-8 space-y-4" method="POST" action="/contact-us">
                                    @csrf

                                    <input type="text" name="name" placeholder="Name" id="Name"
                                        class="w-full rounded-lg py-3 px-4 text-gray-800 text-sm outline-[#a91079]" 
                                        value="{{ old('name') }}" />
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                    @enderror

                                    <input type="email" name="email" placeholder="Email"
                                        class="w-full rounded-lg py-3 px-4 text-gray-800 text-sm outline-[#a91079]" 
                                        value="{{ old('email') }}" />
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                    @enderror

                                    <input type="text" name="subject" placeholder="Subject"
                                        class="w-full rounded-lg py-3 px-4 text-gray-800 text-sm outline-[#a91079]" 
                                        value="{{ old('subject') }}" />
                                    @error('subject')
                                        <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                    @enderror

                                    <textarea name="message" placeholder="Message" rows="6"
                                        class="w-full rounded-lg px-4 text-gray-800 text-sm pt-3 outline-[#a91079]">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                    @enderror

                                    <button type="submit"
                                        class="text-white bg-[#1AA514] hover:bg-[#148410] hover:scale-105 transition duration-150 ease-in-out tracking-wide rounded-lg text-sm px-4 py-3 flex items-center justify-center w-full !mt-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="#fff" class="mr-2"
                                            viewBox="0 0 548.244 548.244">
                                            <path fill-rule="evenodd"
                                                d="M392.19 156.054 211.268 281.667 22.032 218.58C8.823 214.168-.076 201.775 0 187.852c.077-13.923 9.078-26.24 22.338-30.498L506.15 1.549c11.5-3.697 24.123-.663 32.666 7.88 8.542 8.543 11.577 21.165 7.879 32.666L390.89 525.906c-4.258 13.26-16.575 22.261-30.498 22.338-13.923.076-26.316-8.823-30.728-22.032l-63.393-190.153z"
                                                clip-rule="evenodd" data-original="#000000" />
                                        </svg>
                                        Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const inputForm = document.getElementById("InputForm");
    const inputs = inputForm.querySelectorAll("input, textarea");

    inputs.forEach(input => {
        input.addEventListener("focus", () => {
            inputForm.classList.add("focused");
        });

        input.addEventListener("blur", () => {
            if (![...inputs].some(i => i === document.activeElement)) {
                inputForm.classList.remove("focused");
            }
        });
    });
});

</script>

@include('partials.senior_citizen.footer')

