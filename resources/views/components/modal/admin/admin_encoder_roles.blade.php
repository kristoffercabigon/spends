@if (session('clearAdminEncoderRolesModal'))
<script>
    localStorage.removeItem('showEncoderRolesModal');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showEncoderRolesModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showEncoderRolesModal = false; localStorage.setItem('showEncoderRolesModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showEncoderRolesModal = false; localStorage.setItem('showEncoderRolesModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Encoder Roles
                    </h1>
                    <p class="text-sm text-gray-500">
                        Select the roles for encoder <span class="font-semibold">{{ $encoder->encoder_first_name }} {{ $encoder->encoder_last_name}}</span>
                    </p>
                    <form x-data="encoderRolesData" method="POST" action="{{ route('admin-update-encoder-role', $encoder->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="max-h-96 overflow-y-auto">
                            @foreach ($encoderRolesList as $category => $rolesGroup)
                                <div class="mb-4">
                                    <h3 class="font-semibold text-lg">{{ ucfirst($category) }}</h3>
                                    <div class="space-y-2">
                                        @foreach ($rolesGroup as $role)
                                            <label class="flex items-center">
                                                <input type="checkbox" 
                                                    name="roles[{{ $category }}][]"
                                                    value="{{ $role->encoder_role }}"
                                                    @if(in_array($role->encoder_role, $encoderRoles)) checked @endif
                                                    class="mr-2">
                                                {{ $role->encoder_role }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5">
                            Save Roles
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
