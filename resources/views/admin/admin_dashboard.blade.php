@include('partials.admin.admin_header')

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

