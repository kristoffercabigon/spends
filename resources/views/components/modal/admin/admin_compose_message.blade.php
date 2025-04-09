@if (session('clearAdminComposeMessageModal'))
<script>
    localStorage.removeItem('showAdminComposeMessageModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
     x-show="showAdminComposeMessageModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showAdminComposeMessageModal = false; localStorage.setItem('showAdminComposeMessageModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 relative mx-4 rounded-lg">
            <button @click="showAdminComposeMessageModal = false; localStorage.setItem('showAdminComposeMessageModal', 'false')" 
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:w-full lg:w-[50vw] xl:w-[40vw] xl:p-0">
                <div class="p-6 space-y-4 md:space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold mt-[15px] leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Compose Message
                    </h1>

                    <form x-data="{ isAdminLoadingComposeMessage: false }"
                        @submit.prevent="
                            isAdminLoadingComposeMessage = true;
                            $nextTick(() => $el.submit());
                        "
                        class="space-y-4 md:space-y-4" method="POST" action="{{ route('admin-submit-compose-message') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-900 mb-2">Message Type</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="message_type" value="email" class="text-blue-600 focus:ring-blue-600" checked>
                                    <span class="ml-2 text-gray-900">Email</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="message_type" value="sms" class="text-blue-600 focus:ring-blue-600">
                                    <span class="ml-2 text-gray-900">SMS</span>
                                </label>
                            </div>
                            @error('message_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 relative sm:w-full">
                            <label class="inline-flex items-center cursor-pointer">
                            <span class="text-sm font-medium text-gray-900">Bulk Message</span>
                            <input type="checkbox" id="bulk_message" name="bulk_message" value="1" class="sr-only peer">
                            <div class="relative ml-2 w-11 h-6 bg-gray-400 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#1AA514]"></div>
                            </label>
                        </div>

                        <div style="max-height: 300px; overflow-y: auto; padding: 10px;">
                            <div id="bulk-message-fields" class="hidden">
                                <div>
                                    <label for="barangay_id" class="block mb-2 text-sm font-medium text-gray-900">Barangay</label>
                                    <select name="barangay_id" id="barangay_id"
                                        class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                        <option value="none" {{ old('barangay_id') == 'none' ? 'selected' : '' }}>None</option>
                                        @foreach ($barangayList as $barangay)
                                            <option value="{{ $barangay->id }}"
                                                {{ old('barangay_id') == $barangay->id ? 'selected' : '' }}>
                                                {{ $barangay->barangay_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barangay_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="application_status_id" class="block mb-2 text-sm font-medium text-gray-900">Application Status</label>
                                    <select name="application_status_id" id="application_status_id"
                                        class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                        <option value="none" {{ old('application_status_id') == 'none' ? 'selected' : '' }}>None</option>
                                        @foreach ($applicationStatusList as $status)
                                            <option value="{{ $status->id }}"
                                                {{ old('application_status_id') == $status->id ? 'selected' : '' }}>
                                                {{ $status->senior_application_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('application_status_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div id="account-status-container">
                                    <label for="account_status_id" class="block mb-2 text-sm font-medium text-gray-900">Account Status</label>
                                    <select name="account_status_id" id="account_status_id"
                                        class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                        <option value="none">None</option>
                                        @foreach ($accountStatusList as $status)
                                            <option value="{{ $status->id }}">
                                                {{ $status->senior_account_status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('account_status_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div id="email-fields">
                                <div id="send_email">
                                    <label for="email_to" class="block mb-2 text-sm font-medium text-gray-900">Send to (Email)</label>
                                    <div id="email-container" class="flex flex-wrap bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                        <input type="text" id="email_input" placeholder="Enter email" class="flex-grow bg-transparent border-none focus:outline-none">
                                    </div>
                                    <input type="hidden" name="email_to" id="email_to">
                                    @error('email_to')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email_subject" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Subject</label>
                                    <input type="text" name="email_subject" id="email_subject" placeholder="Enter subject"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    @error('email_subject')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div id="sms-fields" class="hidden">
                                <div id="send_sms">
                                    <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Send to (Phone Number)</label>
                                    <div id="sms-container" class="flex flex-wrap bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                        <input type="text" id="sms_input" placeholder="Enter number" class="flex-grow bg-transparent border-none focus:outline-none">
                                    </div>
                                    <input type="hidden" name="number" id="number">
                                    @error('number')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="message_template" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Message Template</label>
                                <select id="message_template" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                    <option value="" data-subject="" data-message="">Select a template</option>
                                    @foreach ($messageTemplate as $template)
                                        <option value="{{ $template->id }}" data-subject="{{ $template->subject_templates }}" data-message="{{ $template->message_templates }}">{{ $template->subject_templates }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Message</label>
                                <textarea name="message" id="message" rows="4" placeholder="Enter message"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"></textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="attachment" class="block mb-2 mt-2 text-sm font-medium text-gray-900">Attachment</label>
                                <input type="file" name="attachment" id="attachment" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                @error('attachment')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="hover:scale-105 transition duration-150 ease-in-out relative w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <span x-show="!isAdminLoadingComposeMessage">Submit</span>
                            <span x-show="isAdminLoadingComposeMessage" style="display: none;" class="flex items-center justify-center">
                                <svg aria-hidden="true" class="inline w-4 h-4 mr-2 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                </svg>
                                Submitting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    document.getElementById('message_template').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('email_subject').value = selectedOption.getAttribute('data-subject');
        document.getElementById('message').value = selectedOption.getAttribute('data-message');
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bulkMessageCheckbox = document.getElementById("bulk_message");
    const bulkMessageFields = document.getElementById("bulk-message-fields");
    const emailFields = document.getElementById("email-fields");
    const applicationStatus = document.getElementById("application_status_id");
    const accountStatus = document.getElementById("account_status_id");
    const smsFields = document.getElementById("sms-fields");
    const attachmentField = document.getElementById("attachment");
    const messageTypeRadios = document.querySelectorAll('input[name="message_type"]');

    function toggleFields() {
        const selectedType = document.querySelector('input[name="message_type"]:checked')?.value;

        if (bulkMessageCheckbox.checked) {
            bulkMessageFields.classList.remove("hidden");
            document.getElementById("send_email").classList.add("hidden");
            document.getElementById("send_sms").classList.add("hidden");  
        } else {
            bulkMessageFields.classList.add("hidden");
            document.getElementById("send_email").classList.remove("hidden");
            document.getElementById("send_sms").classList.remove("hidden");
        }

        if (selectedType === "email") {
            emailFields.classList.remove("hidden");
            smsFields.classList.add("hidden");
            attachmentField.parentElement.classList.remove("hidden");
        } else {
            emailFields.classList.add("hidden");
            smsFields.classList.remove("hidden");
            attachmentField.parentElement.classList.add("hidden");
        }
    }

    bulkMessageCheckbox.addEventListener("change", toggleFields);
    messageTypeRadios.forEach(radio => radio.addEventListener("change", toggleFields));
    toggleFields();

    const emailContainer = document.getElementById('email-container');
    const emailInput = document.getElementById('email_input');
    const emailHiddenInput = document.getElementById('email_to');
    const validDomains = ["gmail.com", "yahoo.com", "outlook.com", "hotmail.com", "edu", "org", "net"];

    function addEmail(email) {
        email = email.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|org|net|edu)$/;

        if (emailPattern.test(email)) {
            const emailTag = document.createElement('div');
            emailTag.className = 'flex items-center bg-gray-200 text-gray-900 px-2 py-1 rounded-lg m-1';
            emailTag.innerHTML = `${email} <button type="button" class="ml-2 text-red-600 focus:outline-none">❌</button>`;

            emailTag.querySelector("button").addEventListener("click", function () {
                emailTag.remove();
                updateEmailHiddenInput();
            });

            emailContainer.insertBefore(emailTag, emailInput);
            updateEmailHiddenInput();
            emailInput.value = "";
        }
    }

    function updateEmailHiddenInput() {
        const emails = Array.from(emailContainer.children)
            .filter(child => child.tagName === "DIV")
            .map(child => child.textContent.replace("❌", "").trim());
        emailHiddenInput.value = emails.join(",");
    }

    emailInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === "," || e.key === " ") {
            e.preventDefault();
            addEmail(emailInput.value);
        }
    });

    emailInput.addEventListener("input", function () {
        const inputValue = emailInput.value;
        if (inputValue.includes("@") && !inputValue.includes(" ")) {
            const parts = inputValue.split("@");
            if (parts.length === 2) {
                const domainPart = parts[1].toLowerCase();
                for (const domain of validDomains) {
                    if (domain.startsWith(domainPart)) {
                        emailInput.value = parts[0] + "@" + domain;
                        break;
                    }
                }
            }
        }
    });

    emailInput.addEventListener("blur", function () {
        if (emailInput.value.trim() !== "") {
            addEmail(emailInput.value);
        }
    });

    const smsContainer = document.getElementById('sms-container');
    const smsInput = document.getElementById('sms_input');
    const smsHiddenInput = document.getElementById('number');
    
    function formatPhoneNumber(number) {
        number = number.trim().replace(/\D/g, "");
        
        if (number.startsWith("639")) {
            return "0" + number.substring(2);
        } else if (number.startsWith("9") && number.length === 10) {
            return "0" + number;
        } else if (number.startsWith("+639")) {
            return "0" + number.substring(3);
        }
        return number;
    }
    
    function addPhoneNumber(number) {
        number = formatPhoneNumber(number);
        const phonePattern = /^09\d{9}$/;
        
        if (phonePattern.test(number)) {
            const phoneTag = document.createElement('div');
            phoneTag.className = 'flex items-center bg-gray-200 text-gray-900 px-2 py-1 rounded-lg m-1';
            phoneTag.innerHTML = `${number} <button type="button" class="ml-2 text-red-600 focus:outline-none">❌</button>`;
            
            phoneTag.querySelector("button").addEventListener("click", function () {
                phoneTag.remove();
                updateSmsHiddenInput();
            });
            
            smsContainer.insertBefore(phoneTag, smsInput);
            updateSmsHiddenInput();
            smsInput.value = "";
        }
    }
    
    function updateSmsHiddenInput() {
        const numbers = Array.from(smsContainer.children)
            .filter(child => child.tagName === "DIV")
            .map(child => child.textContent.replace("❌", "").trim());
        smsHiddenInput.value = numbers.join(",");
    }
    
    smsInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === "," || e.key === " ") {
            e.preventDefault();
            addPhoneNumber(smsInput.value);
        }
    });
    
    smsInput.addEventListener("blur", function () {
        if (smsInput.value.trim() !== "") {
            addPhoneNumber(smsInput.value);
        }
    });

    function toggleAccountStatus() {
        for (let i = 0; i < accountStatus.options.length; i++) {
            if (applicationStatus.value == "3") {
                accountStatus.options[i].hidden = false;
            } else {
                accountStatus.value = "none";
                accountStatus.options[i].hidden = accountStatus.options[i].value !== "none";
            }
        }
    }
    
    applicationStatus.addEventListener("change", toggleAccountStatus);
    toggleAccountStatus();
});
</script>

