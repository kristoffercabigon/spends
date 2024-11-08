@include('partials.admin.admin_header')
@php $array = array('title' => 'SPENDS') @endphp
<x-admin_nav :data="$array"/>

<section class="bg-cover w-full bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background_seniors.jfif') }}'); background-attachment: fixed;">
    <div class="bg-white bg-opacity-50 min-h-screen flex items-center justify-center">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 font-poppins">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl text-[120px] font-extrabold tracking-tight leading-none text-customOrange">SPENDS</h1>
                <p class="max-w-2xl font-semibold text-black text-[50px]">Social Pension Network of DSWD for Senior Citizens</p>
                <p class="max-w-2xl mb-6 font-semibold text-[30px] text-black">North Caloocan City</p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('images/osca_image.jfif') }}" class="ml-[87px] h-[448px] w-[448px] rounded-full " alt="mockup">
            </div>            
        </div>
    </div>
</section>

@include('partials.admin.admin_footer')

<div x-data="{ showAdminPasswordResetModal: {{ json_encode(session('showAdminPasswordResetModal', false)) }} || localStorage.getItem('showAdminPasswordResetModal') === 'true' }"
     x-init="showAdminPasswordResetModal = showAdminPasswordResetModal || localStorage.getItem('showAdminPasswordResetModal') === 'true'">
    @include('components.modal.admin.admin_password_reset')
</div>

<x-modal 

