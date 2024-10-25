<div x-show="showCameraModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 font-poppins" 
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    @click.away="showCameraModal = false"
    @open-camera-modal.window="initWebcam()">
    <div @click.stop class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <section class="bg-gray-50 dark:bg-gray-900 relative">
            <button type="button" @click="showCameraModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8" style="max-height: 75vh; overflow-y: auto;">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Capture a Photo
                </h1>
                <div class="col">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
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
                    <div class="col-md-6 text-center">
                        <div id="results">(Your captured image will appear here)</div>
                    </div>
                    <div class="col-md-12 text-center">
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        <br/>
                        <button class="py-3 px-6 w-full md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none" type="button" onclick="useCapturedPhoto()">Use this photo</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
    let currentCamera = 'user'; 

    function initWebcam() {
        Webcam.set({
            width: 430,
            height: 320,
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
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        });
    }

    function useCapturedPhoto() {
        const imageData = document.querySelector(".image-tag").value;
        const profilePictureField = document.getElementById('profilePictureField');
        
        fetch(imageData)
            .then(res => res.blob())
            .then(blob => {
                const file = new File([blob], 'captured-photo.jpeg', { type: 'image/jpeg' });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                
                profilePictureField.files = dataTransfer.files;

                document.dispatchEvent(new CustomEvent('close-camera-modal', { bubbles: true }));
            });
    }

    document.addEventListener('close-camera-modal', function() {
        Alpine.store('showCameraModal', false); 
    });
</script>