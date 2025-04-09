<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title !== "" ? $title : 'SPENDS System'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    {!!htmlScriptTagJsApi()!!}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body class="bg-white font-poppins min-h-screen pt-[80px]">

    <x-messages.senior_citizen.messages />
    <x-messages.senior_citizen.error_messages />

    <div id="accessibility-toolbar" class="animate-drop-in transition-opacity" style="position: fixed; top: 220px; bottom: 330px; right: 10px; z-index: 9999; background: #fff; padding-top: 10px; padding-left: 2px; padding-right: 2px; padding-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; display: none; flex-direction: column;">
        <button id="increase-font" class="flex items-center justify-center"><img id="increase-font" src="../images/add.png" class="w-4 h-4" alt="Increase Font" style="cursor: pointer;" /></button>
        <button id="decrease-font" class="flex items-center justify-center"><img id="decrease-font" src="../images/minus.png" class="w-4 h-4" alt="Decrease Font" style="cursor: pointer;" /></button>
        <button id="grayscale-toggle" class="flex items-center justify-center"><img id="grayscale-toggle" src="../images/droplet.png" class="w-4 h-4" alt="Grayscale" style="cursor: pointer;" /></button>
        <button id="reset-settings" class="flex items-center justify-center"><img id="reset-settings" src="../images/undo.png" class="w-4 h-4" alt="Reset Settings" style="cursor: pointer;" /></button>
    </div>

    <div id="floating-button" style="position: fixed; top: 170px; right: 10px; z-index: 9999; background-color: #2196F3; width: 50px; height: 50px; color: #fff; border-radius: 5px; display: flex; justify-content: center; align-items: center; cursor: pointer; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s;">
        <img src="images/accessibility.png" alt="Accessibility" class="h-10 w-10">
    </div>

    <style>
        body.grayscale {
            filter: grayscale(100%);
        }

        #accessibility-toolbar {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background: #fff;
            width: 50px; 
            height: 160px; 
            padding: 5px 2px; 
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }

        #floating-button {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background-color: #2196F3;
            width: 50px;
            height: 50px;
            color: #fff;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        #accessibility-toolbar button {
            margin: 5px;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            background-color: #2196F3;
            color: #fff;
            border: none;
            border-radius: 3px;
        }

        #accessibility-toolbar button:hover {
            background-color: #1E88E5;
        }

        #floating-button:hover {
            background-color: #1E88E5;
        }

        #accessibility-toolbar img, 
        #floating-button img {
            width: 16px !important;  
            height: 16px !important; 
        }

        #floating-button img {
            width: 40px !important;
            height: 40px !important;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            const accessibilityToolbar = document.getElementById("accessibility-toolbar");
            const floatingButton = document.getElementById("floating-button");
            const circles = document.getElementById("circles");
            let fontSize = localStorage.getItem("fontSize") ? parseInt(localStorage.getItem("fontSize")) : 16;
            let isGrayscale = localStorage.getItem("grayscale") === "true";

            function applyFontSize() {
                document.documentElement.style.fontSize = fontSize + "px";
            }

            function applyGrayscale() {
                const screenWidth = window.innerWidth;

                if (isGrayscale) {
                    body.classList.add("grayscale");

                    if (screenWidth <= 1024) {
                        accessibilityToolbar.style.bottom = "830px";
                    } else {
                        accessibilityToolbar.style.bottom = "720px";
                    }

                    if (circles) {
                        circles.style.display = "none";
                    }
                } else {
                    body.classList.remove("grayscale");

                    if (screenWidth <= 1024) { 
                        accessibilityToolbar.style.bottom = "280px";
                    } else {
                        accessibilityToolbar.style.bottom = "330px";
                    }

                    if (circles) {
                        circles.style.display = "block";
                    }
                }
            }

            window.addEventListener("resize", applyGrayscale);

            applyFontSize();
            applyGrayscale();

            floatingButton.addEventListener("click", function () {
                accessibilityToolbar.style.display = accessibilityToolbar.style.display === "none" ? "flex" : "none";
            });

            document.getElementById("increase-font").addEventListener("click", function () {
                fontSize += 2;
                localStorage.setItem("fontSize", fontSize);
                applyFontSize();
            });

            document.getElementById("decrease-font").addEventListener("click", function () {
                if (fontSize > 10) {
                    fontSize -= 2;
                    localStorage.setItem("fontSize", fontSize);
                    applyFontSize();
                }
            });

            document.getElementById("grayscale-toggle").addEventListener("click", function () {
                isGrayscale = !isGrayscale;
                localStorage.setItem("grayscale", isGrayscale);
                applyGrayscale();
            });

            document.getElementById("reset-settings").addEventListener("click", function () {
                localStorage.removeItem("fontSize");
                localStorage.removeItem("grayscale");
                location.reload();
            });
        });
    </script>
</body>
</html>