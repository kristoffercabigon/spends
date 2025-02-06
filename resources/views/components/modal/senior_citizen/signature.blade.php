@if (session('clearSignatureModal'))
<script>
    localStorage.removeItem('savedEmail');
    localStorage.removeItem('showSignatureModal');

    const url = new URL(window.location);
    url.searchParams.delete('email'); 
    window.history.replaceState({}, '', url);

    const showLoginModal = @json(session('showLoginModal') === true);
    localStorage.setItem('showLoginModal', showLoginModal);
</script>
@endif

@if (session('showSignatureModal'))
<script>
    localStorage.setItem('savedEmail', localStorage.getItem('savedEmail') || '{{ session('email') }}');
    localStorage.setItem('showSignatureModal', 'true');
</script>
@endif

<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins"
    x-data="{
         email: localStorage.getItem('savedEmail'), 
         init() {
             if (this.email) {
                 localStorage.setItem('savedEmail', this.email);
                 document.getElementById('savedEmail').value = this.email;
             }
         }
     }"
     x-show="showSignatureModal"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     style="display: none"
     @click.away="showSignatureModal = false; localStorage.setItem('showSignatureModal', 'false')">
    <div @click.stop>
        <section class="bg-gray-50 mx-4 relative rounded-lg max-w-4xl w-full">
            <button @click="
                showSignatureModal = false; 
                localStorage.setItem('showSignatureModal', 'false');
                const url = new URL(window.location);
                url.searchParams.delete('email'); 
                window.history.replaceState({}, '', url); 
            " 
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
                <div class="w-full h-[80vh] overflow-y-scroll bg-white rounded-lg shadow md:mt-0 xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">E-Signature</p>
                        </div>

                        <div class="text-sm mt-8 text-gray-800 font-semibold">
                            <div class="flex items-center">
                                <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                <p class="text-left">
                                    Note: You can choose whether to upload a photo of your signature or write your signature on the canvas below. 
                                    A signature is required, so you must complete one option.
                                </p>
                            </div>
                            
                            <div class="flex items-center">
                                <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-1"> 
                                <p class="mt-2 text-left italic">
                                    Paalala: Maaari kang pumili kung mag-a-upload ng larawan ng iyong pirma o isusulat ang iyong pirma sa canvas sa ibaba. 
                                    Kinakailangan ang pirma, kaya dapat kumpletuhin ang isa sa mga options na nasa ibaba.
                                </p>
                            </div>
                        </div>

                        <form id="signature-form" method="POST" action="{{ route('submit-signature') }}">
                        @csrf
                        @method('PUT')

                        <p class="text-sm text-gray-500">
                            Please provide your signature for your account 
                            <strong id="email-display">{{ session('email') ?? '' }}</strong> to proceed logging in.
                        </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                <div x-data="{
                                    showSignatureCameraModal1: false,
                                    showSignatureModal1: false,
                                    previewSignatureUrl1: '',
                                    previewSignatureImage1(event) {
                                        const input = event.target;
                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                this.previewSignatureUrl1 = e.target.result;
                                                document.getElementById('signature_preview1').style.display = 'block';
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                }" 
                                @open-signature-camera-modal1.window="showSignatureCameraModal1 = true; localStorage.setItem('showSignatureCameraModal1', 'true')" 
                                @close-signature-camera-modal1.window="showSignatureCameraModal1 = false; localStorage.setItem('showSignatureCameraModal1', 'false')">

                                    <div class="flex items-center mb-2">
                                        <img id="signature_asterisk1" src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 mr-2" style="display: block">
                                        <label id="signatureLabel1" class="text-sm text-gray-800">
                                            Signature
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <input name="signature1" type="file" 
                                            class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-l-md rounded-r-md transition-all bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500" 
                                            placeholder="Upload photo of Signature" id="signatureField1" 
                                            @change="previewSignatureImage1">

                                        <button @click="$dispatch('open-signature-camera-modal1')" 
                                                class="absolute inset-y-0 right-0 flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-gray-700 border border-gray-300 rounded-r-md w-12" 
                                                type="button">
                                            <img src="../images/camera.png" alt="Toggle Signature" class="hover:animate-jiggle camera-icon w-7 h-7" id="toggleSignatureCameraIcon1">
                                        </button>
                                    </div>

                                    <p id="signature_filename1" class="text-gray-700 text-xs mt-2"></p>

                                    <div class="flex justify-center items-center mt-4">
                                        <img :src="previewSignatureUrl1" id="signature_preview1" class="animate-blurred-fade-in max-h-48 rounded-md shadow-lg cursor-pointer" style="display: none;" alt="Signature Preview"
                                            @click="showSignatureModal1 = true">
                                    </div>

                                    <p id="signatureMessage1" class="text-xs mt-2 p-1 hidden"></p>

                                    @include('components.modal.senior_citizen.signature_camera1')
                                    @include('components.modal.senior_citizen.signature_zoom1')
                                </div>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <canvas id="sig-canvas1" class="border border-gray-500 shadow-md rounded-md w-full h-32 sm:h-40 md:h-48 lg:h-56"></canvas>
                                <input type="hidden" id="sig-dataUrl1" name="signature_data1">
                                <img id="sig-image1" style="display:none;">
                                <p id="signaturevalidation1" class="text-sm mt-2 text-red-500" style="display:none;">Please provide your signature.</p>
                                <div class="flex justify-center items-center mt-4">
                                    <button type="button" id="sig-clearBtn1" class="py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none">Clear Signature</button>
                                </div>
                            </div>

                            <div class="mt-2 flex flex-col items-center justify-center">
                                <div id="submit-error" class="text-red-500 text-sm mt-2" style="{{ $errors->any() ? 'display: block;' : 'display: none;' }}">
                                    @if($errors->any())
                                        <div class="flex items-center text-red-500">
                                            <p class="flex items-center">
                                                Please fill out the required fields with
                                                <img src="images/asterisk.png" alt="Asterisk" class="w-3 h-3 ml-2">
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex justify-center items-center mt-4">
                                <button type="submit" name="submit1" id="submit1" class="py-3 px-6 w-full md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none disabled:opacity-50">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const emailFromURL = urlParams.get('email');

    let savedEmail = localStorage.getItem('savedEmail');

    if (emailFromURL) {
        localStorage.setItem('savedEmail', emailFromURL);
        savedEmail = emailFromURL;
    }

    if (savedEmail) {
        document.getElementById('savedEmail').value = savedEmail; 
        document.getElementById('email-display').textContent = savedEmail; 
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    (function () {
        window.requestAnimFrame = (function (callback) {
            return (
                window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60);
                }
            );
        })();

        var canvas = document.getElementById("sig-canvas1");

        if (!canvas) {
            console.warn("Canvas element not found. Exiting script.");
            return;
        }

        var ctx = canvas.getContext("2d");
        ctx.strokeStyle = "#222222";
        ctx.lineWidth = 4;

        var drawing = false;
        var mousePos = { x: 0, y: 0 };
        var lastPos = { x: 0, y: 0 };

        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 4;
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        function updateSignatureUI() {
            var savedSignature = localStorage.getItem("signature1");
            var signatureAsterisk =
                document.getElementById("signature_asterisk1");

            if (signatureAsterisk) {
                if (savedSignature) {
                    signatureAsterisk.style.display = "none";
                    canvas.classList.remove("border-gray-500");
                    canvas.classList.add("border-green-500");
                } else {
                    signatureAsterisk.style.display = "block";
                    canvas.classList.remove("border-green-500");
                    canvas.classList.add("border-gray-500");
                }
            }
        }

        function loadSignature() {
            var savedSignature = localStorage.getItem("signature");
            if (savedSignature) {
                var img = new Image();
                img.src = savedSignature;
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                };
            }
            updateSignatureUI();
        }

        function saveSignature() {
            var dataUrl = canvas.toDataURL();
            var sigText = document.getElementById("sig-dataUrl1");
            var sigImage = document.getElementById("sig-image1");
            sigText.value = dataUrl;
            sigImage.setAttribute("src", dataUrl);
            localStorage.setItem("signature1", dataUrl);
            updateSignatureUI();
        }

        function getMousePos(canvasDom, mouseEvent) {
            var rect = canvasDom.getBoundingClientRect();
            var scaleX = canvasDom.width / rect.width;
            var scaleY = canvasDom.height / rect.height;

            var x = (mouseEvent.clientX - rect.left) * scaleX;
            var y = (mouseEvent.clientY - rect.top) * scaleY;

            return { x: x, y: y };
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            var scaleX = canvasDom.width / rect.width;
            var scaleY = canvasDom.height / rect.height;

            var x = (touchEvent.touches[0].clientX - rect.left) * scaleX;
            var y = (touchEvent.touches[0].clientY - rect.top) * scaleY;

            return { x: x, y: y };
        }

        function renderCanvas() {
            if (drawing) {
                ctx.beginPath();
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.stroke();
            }
        }

        canvas.addEventListener(
            "mousedown",
            function (e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            },
            false
        );

        canvas.addEventListener(
            "mouseup",
            function (e) {
                drawing = false;
                saveSignature();
            },
            false
        );

        canvas.addEventListener(
            "mousemove",
            function (e) {
                if (drawing) {
                    mousePos = getMousePos(canvas, e);
                    renderCanvas();
                    lastPos = mousePos;
                }
            },
            false
        );

        canvas.addEventListener(
            "touchstart",
            function (e) {
                e.preventDefault();
                drawing = true;
                lastPos = getTouchPos(canvas, e);
            },
            { passive: false }
        );

        canvas.addEventListener(
            "touchmove",
            function (e) {
                e.preventDefault();
                if (drawing) {
                    mousePos = getTouchPos(canvas, e);
                    renderCanvas();
                    lastPos = mousePos;
                }
            },
            { passive: false } 
        );

        canvas.addEventListener(
            "touchend",
            function (e) {
                e.preventDefault();
                drawing = false;
                saveSignature();
            },
            { passive: false } 
        );

        document.body.addEventListener(
            "touchstart",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            { passive: false } 
        );

        document.body.addEventListener(
            "touchend",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            { passive: false } 
        );

        document.body.addEventListener(
            "touchmove",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            { passive: false } 
        );

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            localStorage.removeItem("signature1");
            updateSignatureUI();
        }

        var clearBtn = document.getElementById("sig-clearBtn1");
        var submitBtn = document.getElementById("submit1");
        var form = document.getElementById("form");

        clearBtn.addEventListener(
            "click",
            function (e) {
                e.preventDefault();
                clearCanvas();
                var sigText = document.getElementById("sig-dataUrl1");
                var sigImage = document.getElementById("sig-image1");
                sigText.value = "";
                sigImage.setAttribute("src", "");
            },
            false
        );

        loadSignature();
    })();

    const signatureLabel = document.getElementById("signatureLabel1");
    const signatureInput = document.getElementById("signatureField1");
    const signatureAsterisk = document.getElementById("signature_asterisk1");
    const signaturePreview = document.getElementById("signature_preview1");
    const signatureFilename = document.getElementById("signature_filename1");
    const signatureMessage = document.getElementById("signatureMessage1");

    signatureInput.addEventListener("change", function () {
        const file = this.files[0];
        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/bmp",
            "image/tiff",
        ];
        const maxSize = 4 * 1024 * 1024;

        signaturePreview.style.display = "none";
        signatureFilename.textContent = "";
        signatureMessage.textContent = "";
        signatureMessage.classList.add("hidden");
        signatureAsterisk.style.display = "block";
        signatureLabel.classList.remove("text-red-700", "text-green-700");
        signatureLabel.classList.add("text-gray-800");
        signatureInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900"
        );
        signatureInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900"
        );

        if (file) {
            signatureFilename.textContent = `Selected File: ${file.name}`;

            if (!allowedTypes.includes(file.type)) {
                signatureAsterisk.style.display = "block";
                signatureMessage.textContent =
                    "Invalid file type. Accepted formats: JPEG, PNG, BMP, TIFF.";
                signatureMessage.classList.remove("hidden", "text-green-500");
                signatureMessage.classList.add("text-red-500");
                signatureLabel.classList.add("text-red-700");
                signatureInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            if (file.size > maxSize) {
                signatureAsterisk.style.display = "block";
                signatureMessage.textContent =
                    "File size exceeds the 4MB limit.";
                signatureMessage.classList.remove("hidden", "text-green-500");
                signatureMessage.classList.add("text-red-500");
                signatureLabel.classList.add("text-red-700");
                signatureInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                signaturePreview.src = e.target.result;
                signaturePreview.style.display = "block";
            };
            reader.readAsDataURL(file);

            signatureAsterisk.style.display = "none";
            signatureMessage.textContent = "Looks good!";
            signatureMessage.classList.remove("hidden", "text-red-500");
            signatureMessage.classList.add("text-green-500");
            signatureLabel.classList.add("text-green-700");
            signatureInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900"
            );
        }
    });
});
</script>
