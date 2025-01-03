
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
            
                <div class="w-full bg-white rounded-lg shadow md:mt-0 xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">E-Signature</p>
                        </div>
                        <p class="text-sm text-gray-500">
                            Please provide your signature for your account 
                            <strong id="email-display">{{ session('email') ?? '' }}</strong> to proceed logging in.
                        </p>
                        <form id="signature-form" method="POST" action="{{ route('submit-signature') }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-4 text-center">
                            <input type="hidden" name="email" id="savedEmail" value="{{ session('email') ?? '' }}">
                            <canvas id="sig-canvas1" class="border border-gray-500 shadow-md rounded-md w-full h-32 sm:h-40 md:h-48 lg:h-56"></canvas>
                            <input type="hidden" id="sig-dataUrl1" name="signature_data1">
                            <img id="sig-image1" style="display:none;">
                            <p id="signaturevalidation1" class="text-sm mt-2 text-red-500" style="display:none;">
                                Please provide your signature.
                            </p>
                            <div class="flex justify-center items-center mt-4">
                                <button type="button" id="sig-clearBtn1" class="py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none">
                                    Clear Signature
                                </button>
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

        function loadSignature() {
            var savedSignature = localStorage.getItem("signature");
            if (savedSignature) {
                var img = new Image();
                img.src = savedSignature;
                img.onload = function () {
                    ctx.drawImage(img, 0, 0);
                };
            }
        }

        function saveSignature() {
            var dataUrl = canvas.toDataURL();
            var sigText = document.getElementById("sig-dataUrl1");
            var sigImage = document.getElementById("sig-image1");
            sigText.value = dataUrl;
            sigImage.setAttribute("src", dataUrl);
            localStorage.setItem("signature", dataUrl);

            var submitBtn = document.getElementById("submit1");
            if (sigText.value) {
                submitBtn.disabled = false;
            }
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

        function isCanvasBlank(canvas) {
            const blank = document.createElement("canvas");
            blank.width = canvas.width;
            blank.height = canvas.height;
            return canvas.toDataURL() === blank.toDataURL();
        }

        function validateSignature() {
            var validationMessage = document.getElementById(
                "signaturevalidation1"
            );
            if (isCanvasBlank(canvas)) {
                validationMessage.style.display = "block";
                canvas.style.borderColor = "red";
                return false;
            } else {
                validationMessage.style.display = "none";
                canvas.style.borderColor = "green";
                return true;
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
                validateSignature();
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
            false
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
            false
        );

        canvas.addEventListener(
            "touchend",
            function (e) {
                e.preventDefault();
                drawing = false;
                saveSignature();
                validateSignature();
            },
            false
        );

        document.body.addEventListener(
            "touchstart",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            false
        );

        document.body.addEventListener(
            "touchend",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            false
        );

        document.body.addEventListener(
            "touchmove",
            function (e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            },
            false
        );

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            validateSignature();
            localStorage.removeItem("signature");
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
                submitBtn.disabled = false;
            },
            false
        );

        form.addEventListener("submit1", function (e) {
            saveSignature();
            if (!validateSignature()) {
                e.preventDefault();
            }
        });

        loadSignature();
    })();
});
</script>
