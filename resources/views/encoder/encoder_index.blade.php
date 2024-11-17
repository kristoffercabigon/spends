@include('partials.encoder.encoder_header')
@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_nav :data="$array"/>

<section class="bg-cover w-full bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background_seniors.jfif') }}'); background-attachment: fixed;">
    <div class="bg-white bg-opacity-50 min-h-screen flex items-center justify-center">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 font-poppins">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl animate-fade-in-bounce-right text-[120px] font-extrabold tracking-tight leading-none text-customOrange">SPENDS</h1>
                <p class="max-w-2xl font-semibold text-black text-[50px]">Social Pension Network of DSWD for Senior Citizens</p>
                <p class="max-w-2xl mb-6 font-semibold text-[30px] text-black">North Caloocan City</p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('images/osca_image.jfif') }}" class="ml-[87px] h-[448px] w-[448px] rounded-full " alt="mockup">
            </div>            
        </div>
    </div>
</section>

@include('partials.encoder.encoder_footer')

<div x-data="{ showEncoderPasswordResetModal: {{ json_encode(session('showEncoderPasswordResetModal', false)) }} || localStorage.getItem('showEncoderPasswordResetModal') === 'true' }"
     x-init="showEncoderPasswordResetModal = showEncoderPasswordResetModal || localStorage.getItem('showEncoderPasswordResetModal') === 'true'">
    @include('components.modal.encoder.encoder_password_reset')
</div>

<x-modal 

