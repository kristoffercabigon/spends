<div x-show="showCameraModal" style="display: none" class="fixed inset-0 bg-black bg-opacity-50 z-30 flex items-center justify-center font-poppins"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showCameraModal = false"
    @open-camera-modal.window="initWebcam()">
    <div @click.stop class="bg-white mx-4 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-[715px] w-full">
        <section class="bg-gray-50 relative">
            <button type="button" @click="showCameraModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8" style="max-height: 90vh; overflow-y: auto;">
                <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Capture a Photo
                </h1>
                <div class="col">
                    <div class="relative w-full h-auto">
                        <div id="my_camera" class="w-full h-auto" style="max-width: 100%; max-height: 100%;"></div>
                        <img src="images/silhoutte.png" alt="Person Silhouette" class="absolute inset-0 w-full h-full opacity-60 pointer-events-none z-10 silhouette-image">
                    </div>
                    <br/>
                    <div class="flex justify-center">
                        <button type="button" class="flex items-center justify-center mb-6 w-16 h-16 bg-gray-500 rounded-full hover:bg-gray-300 transition" onClick="take_snapshot()">
                            <img src="../images/camera.png" alt="Take Snapshot" class="w-8 h-8" />
                        </button>

                        <button type="button" class="flex items-center justify-center mb-6 ml-4 w-16 h-16 bg-gray-500 rounded-full hover:bg-gray-300 transition" @click="switchCamera()">
                            <img src="../images/switch-camera.png" alt="Turn Camera" class="w-8 h-8" />
                        </button>
                    </div>
                    <input type="hidden" name="image" class="image-tag">
                </div>
                <div id="results" class="col-md-6 text-center text-gray-900">(Your captured image will appear here)</div>
                <div class="col-md-12 text-center">
                    <div class="mt-4">
                        <span id="error-message" class="text-red-500 hidden">Take a picture first</span>
                        <div>
                            <div class="flex items-center">
                                <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-4"> 
                                <p class="mt-2 text-left text-gray-900">
                                    Note: Make sure the face is in silhouette and the personal photo is taken on a clean PLAIN WHITE BACKGOUND. Wear proper clothes (Polo shirt, T-shirt, Blouse).
                                </p>
                            </div>
                            <div class="flex items-center">
                                <img src="images/warning.png" alt="Warning Icon" class="w-4 h-4 mr-4"> 
                                <p class="mt-2 text-left italic text-gray-900">
                                    Paalala: Siguraduhing pasok ang mukha sa silhouette at nasa malinis na PLAIN WHITE BACKGOUND ang pagkakuha ng personal na litrato. Magsuot ng maayos na damit (Polo shirt, T-shirt, Blouse).
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 items-center justify-center">
                        <button class="hover:scale-105 transition duration-150 ease-in-out py-3 px-6 w-full md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none" type="button" onclick="useCapturedPhoto()">Use this photo</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    .silhouette-image {
        object-fit: contain;
        width: 100%;
        height: 100%;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
    let currentCamera = 'user'; 

    function initWebcam() {
        Webcam.set({
            width: 640, 
            height: 480,
            image_format: 'jpeg',
            jpeg_quality: 95,
            constraints: {
                facingMode: currentCamera 
            }
        });

        const cameraElement = document.getElementById('my_camera');
        Webcam.attach(cameraElement);
    }

    function switchCamera() {
        currentCamera = currentCamera === 'user' ? 'environment' : 'user';
        initWebcam(); 
    }

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            document.querySelector(".image-tag").value = data_uri;
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="animate-zoom-in"/>';
            document.getElementById('error-message').classList.add('hidden');
        });
    }

    function useCapturedPhoto() {
        const imageData = document.querySelector(".image-tag").value;
        const errorMessage = document.getElementById('error-message');

        if (!imageData) {
            errorMessage.classList.remove('hidden'); 
            return;
        }

        const profilePictureField = document.getElementById('profilePictureField');
        
        fetch(imageData)
            .then(res => res.blob())
            .then(blob => {
                const file = new File([blob], 'captured-photo.jpeg', { type: 'image/jpeg' });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                
                profilePictureField.files = dataTransfer.files;

                profilePictureField.dispatchEvent(new Event('change'));

                document.dispatchEvent(new CustomEvent('close-camera-modal', { bubbles: true }));
            });
    }

    document.addEventListener('close-camera-modal', function() {
        Alpine.store('showCameraModal', false); 
    });
</script>
