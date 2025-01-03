@include('partials.encoder.encoder_header')

@php $array = array('title' => 'SPENDS') @endphp
<x-encoder_dashboard_nav :data="$array"/>

<style>
.hasImage:hover section {
  background-color: rgba(5, 5, 5, 0.4);
}
.hasImage:hover button:hover {
  background: rgba(5, 5, 5, 0.45);
}

#overlay.draggedover {
  background-color: rgba(255, 255, 255, 0.7);
}
#overlay.draggedover p,
#overlay.draggedover i {
  opacity: 1;
}

.group:hover .group-hover\:text-blue-800 {
  color: #2b6cb0;
}

#is_highlighted {
    width: 50%; 
    white-space: nowrap; 
    overflow: hidden; 
    text-overflow: ellipsis; 
}
</style>

<section class="bg-cover bg-center bg-no-repeat min-h-screen" style="background-image: url('{{ asset('images/background2.png') }}'); background-attachment: fixed;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    
    <div class="relative flex items-center justify-center font-poppins lg:mt-[80px] lg:pl-[255px]">
        <div class="w-full mx-auto font-[poppins]">
            <div class="bg-white mb-4 mt-4 ml-4 mr-4 rounded-md">              
                <div class="px-6 py-4 lg:px-12">
                    <form id="form" action="{{route('encoder-submit-add-event')}}" enctype="multipart/form-data" method="POST" class="w-full bg-white rounded-md">
                    @csrf

                        <div class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            <p class="text-center">
                                Add Event
                            </p>
                        </div>

                        <hr style="height: 2.5px; background: linear-gradient(to right, transparent, #1AA514, transparent); margin-top: 16px; margin-bottom: 32px;">

                        <div class="text-xl font-bold mt-8 mb-6 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Event Information
                            </p>
                        </div>

                        <div class="relative mb-4">
                            <label class="text-sm mb-2 block 
                                @error('title') text-red-700 
                                @elseif(old('title')) text-green-700 
                                @else text-gray-800 @enderror">
                                Title
                            </label>
                            <input name="title" id="title" type="text" 
                                value="{{ old('title', $event->title) }}"
                                class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                @error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                @elseif(old('title')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror"
                                placeholder="Enter Title" />
                            @if(old('title'))
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                            @endif
                            @error('title')
                                <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                            @elseif(old('title'))
                                <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label for="description" class="text-sm mb-2 block 
                                @error('description') text-red-700 
                                @elseif(old('description')) text-green-700 
                                @else text-gray-800 @enderror">
                                Description
                            </label>
                            <textarea name="description" id="descriptionField" class="w-full rounded-xl border border-gray-500 bg-white p-4 text-black
                                @error('description') bg-red-50 border border-red-500 text-red-900
                                @elseif(old('description')) bg-green-50 border border-green-500 text-green-900
                                @else bg-gray-100 border-gray-500 @enderror" rows="5">{{ old('description', $event->description) }}</textarea>

                            @if(old('description'))
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>
                            @endif

                            @error('description')
                                <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                            @elseif(old('description'))
                                <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('barangay_id') text-red-700 
                                    @elseif(old('barangay_id')) text-green-700 
                                    @else text-gray-800 @enderror">
                                    Barangay
                                </label>
                                <select name="barangay_id" 
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm px-4 py-3 rounded-md transition-all 
                                    @error('barangay_id') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500
                                    @elseif(old('barangay_id')) bg-green-50 border border-green-500 text-green-900 focus:ring-green-500 focus:border-green-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled selected>Select barangay</option>
                                    @foreach($barangayList as $barangay1)
                                        <option value="{{ $barangay1->id }}" 
                                            {{ old('barangay_id', $event->barangay_id) == $barangay1->id ? 'selected' : '' }}>
                                            {{ $barangay1->barangay_no }}
                                        </option>
                                    @endforeach
                                </select>

                                @if(old('barangay_id'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @endif

                                @error('barangay_id')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-sm mb-2 block 
                                    @error('is_featured') text-red-700 
                                    @elseif(old('is_featured') || isset($validatedData['is_featured'])) text-green-700 
                                    @else text-gray-800 @enderror">
                                    Is Featured?
                                </label>

                                <select name="is_featured" id="is_featured"
                                    class="w-full text-sm px-4 py-3 rounded-md transition-all pr-10
                                    @error('is_featured') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                    @elseif(old('is_featured') || isset($validatedData['is_featured'])) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                    @else bg-gray-100 border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror">
                                    <option value="" disabled {{ old('is_featured') === null && $event->is_featured === null ? 'selected' : '' }}>Select an option</option>
                                    <option value="1" {{ old('is_featured', $event->is_featured) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('is_featured', $event->is_featured) == '0' ? 'selected' : '' }}>No</option>
                                </select>

                                @if(old('is_featured') || isset($validatedData['is_featured']))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif

                                @error('is_featured')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('is_featured') || isset($validatedData['is_featured']))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>

                        </div>

                        <div class="text-xl font-bold mt-8 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Video
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                            <div>
                                <label class="text-sm mb-2 block 
                                    @error('video') text-red-700 
                                    @elseif(old('video')) text-green-700
                                    @else text-gray-800 @enderror">
                                    Video
                                </label>
                                <input id="video" name="video" type="file" accept="video/*"
                                    class="bg-gray-100 focus:bg-transparent w-full text-sm text-gray-800 px-4 py-3 rounded-md transition-all 
                                    @error('video') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  
                                    @elseif(old('video')) bg-green-50 border border-green-500 text-green-900 placeholder-green-700 focus:ring-green-500 focus:border-green-500
                                    @else bg-gray-100 border border-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror" 
                                    placeholder="Upload Video">

                                @if(old('video'))
                                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </span>
                                @endif

                                @error('video')
                                    <p class="text-red-500 text-xs mt-2 p-1">{{ $message }}</p>
                                @elseif(old('video'))
                                    <p class="text-green-500 text-xs mt-2 p-1">Looks good!</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-center w-full items-center mt-4">
                            @if($event->video)
                                <video id="video_preview" class="animate-blurred-fade-in max-h-96 rounded-md shadow-lg" controls>
                                    <source id="video_source" src="{{ asset('storage/videos/events/'.$event->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <video id="video_preview" class="animate-blurred-fade-in max-h-96 rounded-md shadow-lg" 
                                    style="display: none;" controls>
                                    <source id="video_source" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>

                        <div class="flex justify-center w-full items-center">
                            <p id="video_error" class="text-red-700 mt-4" style="display: none"></p>
                            <div id="video_info" style="display: none;" class="mt-4">
                                <p id="video_name" class="text-gray-700" ></p>
                                <p id="video_size" class="text-gray-700" ></p>
                            </div>
                        </div>                   

                        <div class="text-xl font-bold mt-4 leading-tight tracking-tight text-gray-900 md:text-xl">
                            <p class="text-left">
                                Images
                            </p>
                        </div>

                        <main class="container mx-auto w-full border border-gray-500 rounded-lg mt-8 h-full">
                            <article
                                aria-label="File Upload Modal"
                                class="relative h-full flex flex-col bg-white rounded-md"
                                ondrop="dropHandler(event);"
                                ondragover="dragOverHandler(event);"
                                ondragleave="dragLeaveHandler(event);"
                                ondragenter="dragEnterHandler(event);"
                            >
                                <div
                                    id="overlay"
                                    class="w-full h-full absolute top-0 left-0 pointer-events-none z-10 flex flex-col items-center justify-center rounded-md"
                                ></div>

                                <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                                    <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                                        <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                            <span>Drag and drop your</span>&nbsp;<span>image files anywhere or</span>
                                        </p>
                                        <input id="hidden-input" name="images[]" type="file" multiple class="hidden" accept="image/*" />
                                        <button
                                            id="button"
                                            type="button"
                                            class="hover:scale-105 transition duration-150 ease-in-out py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-[#1AA514] hover:bg-[#148410] focus:outline-none"
                                        >
                                            <span class="text-green-500">
                                                <img src="../../../images/upload.png" alt="Key Icon" class="h-5 inline mr-1">
                                            </span>Upload an image
                                        </button>
                                    </header>

                                    <input type="hidden" id="highlighted_image" name="highlighted_image" />

                                    <div class="flex items-center justify-center">
                                        <p id="error-message" class="text-red-500 mt-2 hidden">File type not supported</p>
                                        <p id="error-message1" class="text-red-500 mt-2 hidden">Unsupported file type detected to the files.</p>
                                        <p id="error-message2" class="text-red-500 mt-2 hidden">Select highligh image first.</p>
                                    </div>

                                    <div id="highlight" class="flex justify-center w-full items-center mt-4 hidden">
                                        <label for="is_highlighted" class="text-gray-700">Highlight Image:</label>
                                        <select id="is_highlighted" class="border border-gray-300 rounded-md p-2 mt-2">
                                            <option value="" selected disabled>Select an image</option>
                                        </select>
                                    </div>

                                    <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">To Upload</h1>

                                    <ul id="gallery" class="flex flex-1 flex-wrap -m-1 overflow-y-auto" style="max-height: 300px;">
                                        <li
                                            id="empty"
                                            class="h-full w-full text-center flex flex-col items-center justify-center items-center"
                                        >
                                            <img
                                                class="mx-auto w-32"
                                                src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                                alt="no data"
                                            />
                                            <span class="text-small text-gray-500">No files selected</span>
                                        </li>
                                    </ul>
                                </section>
                            </article>
                        </main>

                        <template id="image-template">
                            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                                <article
                                    tabindex="0"
                                    class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm"
                                >
                                    <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                                    <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-5 absolute top-0 py-2 px-3">
                                        <h1 class="flex-1"></h1>
                                        <div class="flex">
                                            <span class="p-1">
                                                <i>
                                                    <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                                    </svg>
                                                </i>
                                            </span>

                                            <p class="p-1 size text-xs"></p>
                                            <button
                                                class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md"
                                            >
                                                <svg
                                                    class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        class="pointer-events-none"
                                                        d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </section>
                                </article>
                            </li>
                        </template>

                        <div class="mt-8 flex justify-center">
                            <button type="submit" id="submit" name="submit" class="hover:scale-105 transition duration-150 ease-in-out py-3 px-6 md:w-auto text-sm tracking-wider font-light rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                                Add Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src= "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script>
document.getElementById('video').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var videoPreview = document.getElementById('video_preview');
    var videoSource = document.getElementById('video_source');
    var videoInfo = document.getElementById('video_info');
    var videoName = document.getElementById('video_name');
    var videoSize = document.getElementById('video_size');
    var videoError = document.getElementById('video_error');

    videoError.style.display = 'none';
    videoPreview.style.display = 'none';
    videoInfo.style.display = 'none';

    if (file) {
        if (file.type.startsWith('video/')) {
            if (file.size > 100 * 1024 * 1024) {
                videoError.style.display = 'block';
                videoError.textContent = 'Error: The video file size must not exceed 100 MB.';
                return;
            }

            var fileURL = URL.createObjectURL(file);
            videoSource.src = fileURL;
            videoPreview.style.display = 'block';
            videoPreview.load();
            videoPreview.play();

            videoInfo.style.display = 'block';
            videoName.innerHTML = '<strong>Video name:</strong> ' + file.name;
            videoSize.innerHTML = '<strong>Video size:</strong> ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';
        } else {
            videoError.style.display = 'block';
            videoError.textContent = 'Error: Please select a valid video file.';
        }
    }
});
</script>

<script>
    const imageTempl = document.getElementById("image-template"),
    empty = document.getElementById("empty"),
    errorMessage = document.getElementById("error-message"),
    errorMessage1 = document.getElementById("error-message1"),
    errorMessage2 = document.getElementById("error-message2"), 
    form = document.getElementById("form");

    let FILES = {};

    function addFiles(target, files) {
        const allImages = Array.from(files).every((file) => file.type.match("image.*"));

        if (!allImages) {
            errorMessage1.classList.remove("hidden");
            errorMessage.classList.add("hidden");    
            return;
        }

        errorMessage.classList.add("hidden");
        errorMessage1.classList.add("hidden");

        Array.from(files).forEach((file) => {
            const objectURL = URL.createObjectURL(file);
            const clone = imageTempl.content.cloneNode(true);

            clone.querySelector("h1").textContent = file.name;
            clone.querySelector(".size").textContent = `${(file.size / (1024 * 1024)).toFixed(2)} MB`; 
            clone.querySelector("li").id = objectURL;
            clone.querySelector(".delete").dataset.target = objectURL;

            Object.assign(clone.querySelector("img"), {
                src: objectURL,
                alt: file.name,
            });

            empty.classList.add("hidden");
            target.prepend(clone);

            FILES[objectURL] = file;

            const option = document.createElement("option");
            option.value = file.name;
            option.textContent = file.name; 
            document.getElementById("is_highlighted").appendChild(option);
        });

        document.getElementById("highlight").classList.remove("hidden");
    }

    document.getElementById('is_highlighted').addEventListener('change', function(event) {
        const selectedImageName = event.target.value;
        document.getElementById('highlighted_image').value = selectedImageName;

        errorMessage2.classList.add("hidden");
    });

    const gallery = document.getElementById("gallery");
    const hidden = document.getElementById("hidden-input");

    document.getElementById("button").onclick = () => hidden.click();

    hidden.onchange = (e) => {
        addFiles(gallery, e.target.files);
    };

    function dropHandler(ev) {
        ev.preventDefault();
        addFiles(gallery, ev.dataTransfer.files);
    }

    function dragOverHandler(e) {
        e.preventDefault();
    }

    gallery.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
            const ou = target.dataset.target;
            document.getElementById(ou).remove();
            if (gallery.children.length === 1) empty.classList.remove("hidden");
            delete FILES[ou];

            const options = document.getElementById("is_highlighted").querySelectorAll("option");
            options.forEach(option => {
                if (option.value === ou) {
                    option.remove();
                }
            });
        }
    };

    form.onsubmit = (e) => {
        const highlightedImage = document.getElementById('highlighted_image').value;
        if (Object.keys(FILES).length === 0) {
            e.preventDefault();
            errorMessage.classList.remove("hidden");
            errorMessage.textContent = "Upload image first";
        } else if (!highlightedImage) {
            e.preventDefault();
            errorMessage2.classList.remove("hidden");
            errorMessage2.textContent = "Select highlight image first";
        }
    };
</script>

</body>
</html>

