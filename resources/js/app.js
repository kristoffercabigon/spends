import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Swiper from "swiper";
import "swiper/swiper-bundle.css";


document.addEventListener("DOMContentLoaded", function () {

    flatpickr("#datepicker1", {
        dateFormat: "Y-m-d",
        maxDate: new Date(
            new Date().setFullYear(new Date().getFullYear() - 60)
        ),
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                const birthdate = selectedDates[0];
                const today = new Date();
                let age = today.getFullYear() - birthdate.getFullYear();
                const m = today.getMonth() - birthdate.getMonth();
                if (
                    m < 0 ||
                    (m === 0 && today.getDate() < birthdate.getDate())
                ) {
                    age--;
                }
                document.getElementById("age").value = age;
            }
        },
    });


    AOS.init();

    window.addEventListener("resize", function () {
        AOS.refresh();
    });

    // (function () {
    //     window.requestAnimFrame = (function (callback) {
    //         return (
    //             window.requestAnimationFrame ||
    //             window.webkitRequestAnimationFrame ||
    //             window.mozRequestAnimationFrame ||
    //             window.oRequestAnimationFrame ||
    //             window.msRequestAnimationFrame ||
    //             function (callback) {
    //                 window.setTimeout(callback, 1000 / 60);
    //             }
    //         );
    //     })();

    //     var canvas = document.getElementById("sig-canvas");

    //     if (!canvas) {
    //         console.warn("Canvas element not found. Exiting script.");
    //         return;
    //     }

    //     var ctx = canvas.getContext("2d");
    //     ctx.strokeStyle = "#222222";
    //     ctx.lineWidth = 4;

    //     var drawing = false;
    //     var mousePos = { x: 0, y: 0 };
    //     var lastPos = { x: 0, y: 0 };

    //     function resizeCanvas() {
    //         canvas.width = canvas.offsetWidth;
    //         canvas.height = canvas.offsetHeight;
    //         ctx.strokeStyle = "#222222";
    //         ctx.lineWidth = 4;
    //     }

    //     window.addEventListener("resize", resizeCanvas);
    //     resizeCanvas();

    //     function checkContentVisibility() {
    //         const content5 = document.getElementById("content5");
    //         const observer = new MutationObserver((mutations) => {
    //             mutations.forEach((mutation) => {
    //                 if (mutation.target.style.display === "block") {
    //                     resizeCanvas();
    //                     loadSignature();
    //                 }
    //             });
    //         });
    //         observer.observe(content5, {
    //             attributes: true,
    //             attributeFilter: ["style"],
    //         });
    //     }

    //     checkContentVisibility();

    //     function updateSignatureUI() {
    //         var savedSignature = localStorage.getItem("signature");
    //         var signatureAsterisk =
    //             document.getElementById("signature_asterisk");

    //         if (signatureAsterisk) {
    //             if (savedSignature) {
    //                 signatureAsterisk.style.display = "none";
    //                 canvas.classList.remove("border-gray-500");
    //                 canvas.classList.add("border-green-500");
    //             } else {
    //                 signatureAsterisk.style.display = "block";
    //                 canvas.classList.remove("border-green-500");
    //                 canvas.classList.add("border-gray-500");
    //             }
    //         }
    //     }

    //     function loadSignature() {
    //         var savedSignature = localStorage.getItem("signature");
    //         if (savedSignature) {
    //             var img = new Image();
    //             img.src = savedSignature;
    //             img.onload = function () {
    //                 ctx.drawImage(img, 0, 0);
    //             };
    //         }
    //         updateSignatureUI();
    //     }

    //     function saveSignature() {
    //         var dataUrl = canvas.toDataURL();
    //         var sigText = document.getElementById("sig-dataUrl");
    //         var sigImage = document.getElementById("sig-image");
    //         sigText.value = dataUrl;
    //         sigImage.setAttribute("src", dataUrl);
    //         localStorage.setItem("signature", dataUrl);

    //         var submitBtn = document.getElementById("submit");
    //         if (sigText.value) {
    //             submitBtn.disabled = false;
    //         }
    //         updateSignatureUI();
    //     }

    //     function getMousePos(canvasDom, mouseEvent) {
    //         var rect = canvasDom.getBoundingClientRect();
    //         var scaleX = canvasDom.width / rect.width;
    //         var scaleY = canvasDom.height / rect.height;

    //         var x = (mouseEvent.clientX - rect.left) * scaleX;
    //         var y = (mouseEvent.clientY - rect.top) * scaleY;

    //         return { x: x, y: y };
    //     }

    //     function getTouchPos(canvasDom, touchEvent) {
    //         var rect = canvasDom.getBoundingClientRect();
    //         var scaleX = canvasDom.width / rect.width;
    //         var scaleY = canvasDom.height / rect.height;

    //         var x = (touchEvent.touches[0].clientX - rect.left) * scaleX;
    //         var y = (touchEvent.touches[0].clientY - rect.top) * scaleY;

    //         return { x: x, y: y };
    //     }

    //     function renderCanvas() {
    //         if (drawing) {
    //             ctx.beginPath();
    //             ctx.moveTo(lastPos.x, lastPos.y);
    //             ctx.lineTo(mousePos.x, mousePos.y);
    //             ctx.stroke();
    //         }
    //     }

    //     function isCanvasBlank(canvas) {
    //         const blank = document.createElement("canvas");
    //         blank.width = canvas.width;
    //         blank.height = canvas.height;
    //         return canvas.toDataURL() === blank.toDataURL();
    //     }

    //     function validateSignature() {
    //         var validationMessage = document.getElementById(
    //             "signaturevalidation"
    //         );
    //         if (isCanvasBlank(canvas)) {
    //             validationMessage.style.display = "block";
    //             canvas.style.borderColor = "red";
    //             return false;
    //         } else {
    //             validationMessage.style.display = "none";
    //             canvas.style.borderColor = "green";
    //             return true;
    //         }
    //     }

    //     canvas.addEventListener(
    //         "mousedown",
    //         function (e) {
    //             drawing = true;
    //             lastPos = getMousePos(canvas, e);
    //         },
    //         false
    //     );

    //     canvas.addEventListener(
    //         "mouseup",
    //         function (e) {
    //             drawing = false;
    //             saveSignature();
    //             validateSignature();
    //         },
    //         false
    //     );

    //     canvas.addEventListener(
    //         "mousemove",
    //         function (e) {
    //             if (drawing) {
    //                 mousePos = getMousePos(canvas, e);
    //                 renderCanvas();
    //                 lastPos = mousePos;
    //             }
    //         },
    //         false
    //     );

    //     canvas.addEventListener(
    //         "touchstart",
    //         function (e) {
    //             e.preventDefault();
    //             drawing = true;
    //             lastPos = getTouchPos(canvas, e);
    //         },
    //         false
    //     );

    //     canvas.addEventListener(
    //         "touchmove",
    //         function (e) {
    //             e.preventDefault();
    //             if (drawing) {
    //                 mousePos = getTouchPos(canvas, e);
    //                 renderCanvas();
    //                 lastPos = mousePos;
    //             }
    //         },
    //         false
    //     );

    //     canvas.addEventListener(
    //         "touchend",
    //         function (e) {
    //             e.preventDefault();
    //             drawing = false;
    //             saveSignature();
    //             validateSignature();
    //         },
    //         false
    //     );

    //     document.body.addEventListener(
    //         "touchstart",
    //         function (e) {
    //             if (e.target == canvas) {
    //                 e.preventDefault();
    //             }
    //         },
    //         false
    //     );

    //     document.body.addEventListener(
    //         "touchend",
    //         function (e) {
    //             if (e.target == canvas) {
    //                 e.preventDefault();
    //             }
    //         },
    //         false
    //     );

    //     document.body.addEventListener(
    //         "touchmove",
    //         function (e) {
    //             if (e.target == canvas) {
    //                 e.preventDefault();
    //             }
    //         },
    //         false
    //     );

    //     function clearCanvas() {
    //         ctx.clearRect(0, 0, canvas.width, canvas.height);
    //         validateSignature();
    //         localStorage.removeItem("signature");
    //         updateSignatureUI();
    //     }

    //     var clearBtn = document.getElementById("sig-clearBtn");
    //     var submitBtn = document.getElementById("submit");
    //     var form = document.getElementById("form");

    //     clearBtn.addEventListener(
    //         "click",
    //         function (e) {
    //             e.preventDefault();
    //             clearCanvas();
    //             var sigText = document.getElementById("sig-dataUrl");
    //             var sigImage = document.getElementById("sig-image");
    //             sigText.value = "";
    //             sigImage.setAttribute("src", "");
    //             submitBtn.disabled = false;
    //         },
    //         false
    //     );

    //     form.addEventListener("submit", function (e) {
    //         saveSignature();
    //         if (!validateSignature()) {
    //             e.preventDefault();
    //         }
    //     });

    //     loadSignature();
    // })();
    
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

        var canvas = document.getElementById("sig-canvas");

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

        function checkContentVisibility() {
            const content5 = document.getElementById("content5");
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.target.style.display === "block") {
                        resizeCanvas();
                        loadSignature();
                    }
                });
            });
            observer.observe(content5, {
                attributes: true,
                attributeFilter: ["style"],
            });
        }

        checkContentVisibility();

        function updateSignatureUI() {
            var savedSignature = localStorage.getItem("signature");
            var signatureAsterisk =
                document.getElementById("signature_asterisk");

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
            var sigText = document.getElementById("sig-dataUrl");
            var sigImage = document.getElementById("sig-image");
            sigText.value = dataUrl;
            sigImage.setAttribute("src", dataUrl);
            localStorage.setItem("signature", dataUrl);
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
            localStorage.removeItem("signature");
            updateSignatureUI();
        }

        var clearBtn = document.getElementById("sig-clearBtn");
        var submitBtn = document.getElementById("submit");
        var form = document.getElementById("form");

        clearBtn.addEventListener(
            "click",
            function (e) {
                e.preventDefault();
                clearCanvas();
                var sigText = document.getElementById("sig-dataUrl");
                var sigImage = document.getElementById("sig-image");
                sigText.value = "";
                sigImage.setAttribute("src", "");
            },
            false
        );

        loadSignature();
    })();

});

document.addEventListener("DOMContentLoaded", function () {
    if (window.location.pathname === "/register") {
        const firstNameInput = document.getElementById("first_name");
        const middleNameInput = document.getElementById("middle_name");
        const lastNameInput = document.getElementById("last_name");
        const suffixInput = document.getElementById("suffix");
        const fullNamePlaceholder = document.getElementById(
            "full-name-placeholder"
        );
        const fullNamePlaceholder2 = document.getElementById(
            "full-name-placeholder-2"
        );

        function updateFullName() {
            const firstName = firstNameInput.value.trim() || "";
            const middleName = middleNameInput.value.trim() || "";
            const lastName = lastNameInput.value.trim() || "";
            const suffix = suffixInput.value.trim() || "";
            const nameParts = [];

            if (firstName) nameParts.push(firstName);
            if (middleName) nameParts.push(middleName);
            if (lastName) nameParts.push(lastName);
            if (suffix) nameParts.push(suffix);

            const fullName = nameParts.join(" ");
            fullNamePlaceholder.textContent = fullName;
            fullNamePlaceholder2.textContent = fullName;
        }

        firstNameInput.addEventListener("input", updateFullName);
        middleNameInput.addEventListener("input", updateFullName);
        lastNameInput.addEventListener("input", updateFullName);
        suffixInput.addEventListener("input", updateFullName);

        updateFullName();
    }

    const oscaInput = document.getElementById("osca_id");
    const oscaLabel = document.getElementById("oscaMemberLabel");
    const oscaIcon = document.getElementById("oscaMemberIcon");
    const validIconOsca = document.getElementById("validIconOscaMember");
    const invalidIconOsca = document.getElementById("invalidIconOscaMember");
    const oscaMessage = document.getElementById("oscaMemberMessage");

    function validateOscaID() {
        const value = oscaInput.value.trim();
        oscaIcon.classList.remove("hidden");

        if (!/^\d{0,6}$/.test(value)) {
            oscaInput.value = value.replace(/\D/g, "").substring(0, 6);
        }

        const cleanedValue = oscaInput.value.trim();

        if (cleanedValue === "") {
            oscaLabel.classList.remove("text-green-700", "text-red-700");
            oscaLabel.classList.add("text-gray-800");
            oscaInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            oscaInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            oscaMessage.classList.add("hidden");
            oscaIcon.classList.add("hidden");
            return;
        }

        fetch(`/validate-osca-id?osca_id=${cleanedValue}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.exists) {
                    oscaLabel.classList.add("text-red-700");
                    oscaLabel.classList.remove(
                        "text-green-700",
                        "text-gray-800"
                    );
                    oscaInput.classList.add(
                        "bg-red-50",
                        "border-red-500",
                        "text-red-900",
                        "placeholder-red-700",
                        "focus:ring-red-500",
                        "focus:border-red-500"
                    );
                    oscaInput.classList.remove(
                        "bg-green-50",
                        "border-green-500",
                        "text-green-900",
                        "placeholder-green-700",
                        "focus:ring-green-500",
                        "focus:border-green-500"
                    );
                    oscaMessage.textContent =
                        "This OSCA ID is already registered.";
                    oscaMessage.classList.remove("text-green-500", "hidden");
                    oscaMessage.classList.add("text-red-500");
                    validIconOsca.classList.add("hidden");
                    invalidIconOsca.classList.remove("hidden");
                } else {
                    oscaLabel.classList.add("text-green-700");
                    oscaLabel.classList.remove("text-red-700", "text-gray-800");
                    oscaInput.classList.add(
                        "bg-green-50",
                        "border-green-500",
                        "text-green-900",
                        "placeholder-green-700",
                        "focus:ring-green-500",
                        "focus:border-green-500"
                    );
                    oscaInput.classList.remove(
                        "bg-red-50",
                        "border-red-500",
                        "text-red-900",
                        "placeholder-red-700",
                        "focus:ring-red-500",
                        "focus:border-red-500"
                    );
                    oscaMessage.textContent = "Looks good!";
                    oscaMessage.classList.remove("text-red-500", "hidden");
                    oscaMessage.classList.add("text-green-500");
                    validIconOsca.classList.remove("hidden");
                    invalidIconOsca.classList.add("hidden");
                }
            })
            .catch((error) => {
                console.error("Error validating OSCA ID:", error);
            });
    }

    oscaInput.addEventListener("input", validateOscaID);
    validateOscaID();

    const firstNameInput = document.getElementById("first_name");
    const firstNameLabel = document.getElementById("firstNameLabel");
    const firstNameAsterisk = document.getElementById("first_name_asterisk");
    const firstNameIcon = document.getElementById("firstNameIcon");
    const validIconFirstName = document.getElementById("validIconFirstName");
    const invalidIconFirstName = document.getElementById(
        "invalidIconFirstName"
    );
    const firstNameMessage = document.getElementById("firstNameMessage");

    function validateFirstName() {
        const value = firstNameInput.value.trim();
        firstNameIcon.classList.remove("hidden");

        if (value.length > 64) {
            firstNameAsterisk.style.display = "block";
            firstNameLabel.classList.remove("text-green-700", "text-gray-800");
            firstNameLabel.classList.add("text-red-700");
            firstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            firstNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            firstNameMessage.textContent = "Maximum of 64 characters only.";
            firstNameMessage.classList.remove("text-green-500", "hidden");
            firstNameMessage.classList.add("text-red-500");
            validIconFirstName.classList.add("hidden");
            invalidIconFirstName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            firstNameAsterisk.style.display = "none";
            firstNameLabel.classList.remove("text-red-700", "text-gray-800");
            firstNameLabel.classList.add("text-green-700");
            firstNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            firstNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            firstNameMessage.textContent = "Looks good!";
            firstNameMessage.classList.remove("text-red-500", "hidden");
            firstNameMessage.classList.add("text-green-500");
            validIconFirstName.classList.remove("hidden");
            invalidIconFirstName.classList.add("hidden");
        } else {
            firstNameAsterisk.style.display = "block";
            firstNameLabel.classList.remove("text-green-700", "text-gray-800");
            firstNameLabel.classList.add("text-red-700");
            firstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            firstNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            firstNameMessage.textContent = "Please enter a valid name.";
            firstNameMessage.classList.remove("text-green-500", "hidden");
            firstNameMessage.classList.add("text-red-500");
            validIconFirstName.classList.add("hidden");
            invalidIconFirstName.classList.remove("hidden");
        }

        if (value === "") {
            firstNameAsterisk.style.display = "block";
            firstNameLabel.classList.remove("text-green-700", "text-red-700");
            firstNameLabel.classList.add("text-gray-800");
            firstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            firstNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            firstNameMessage.classList.add("hidden");
            firstNameIcon.classList.add("hidden");
        }
    }

    firstNameInput.addEventListener("input", validateFirstName);

    validateFirstName();

    const middleNameInput = document.getElementById("middle_name");
    const middleNameLabel = document.getElementById("middleNameLabel");
    const middleNameIcon = document.getElementById("middleNameIcon");
    const validIconMiddleName = document.getElementById("validIconMiddleName");
    const invalidIconMiddleName = document.getElementById(
        "invalidIconMiddleName"
    );
    const middleNameMessage = document.getElementById("middleNameMessage");

    function validateMiddleName() {
        const value = middleNameInput.value.trim();
        middleNameIcon.classList.remove("hidden");

        if (value.length > 32) {
            middleNameLabel.classList.remove("text-green-700", "text-gray-800");
            middleNameLabel.classList.add("text-red-700");
            middleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            middleNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            middleNameMessage.textContent = "Maximum of 32 characters only.";
            middleNameMessage.classList.remove("text-green-500", "hidden");
            middleNameMessage.classList.add("text-red-500");
            validIconMiddleName.classList.add("hidden");
            invalidIconMiddleName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            middleNameLabel.classList.remove("text-red-700", "text-gray-800");
            middleNameLabel.classList.add("text-green-700");
            middleNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            middleNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            middleNameMessage.textContent = "Looks good!";
            middleNameMessage.classList.remove("text-red-500", "hidden");
            middleNameMessage.classList.add("text-green-500");
            validIconMiddleName.classList.remove("hidden");
            invalidIconMiddleName.classList.add("hidden");
        } else {
            middleNameLabel.classList.remove("text-green-700", "text-gray-800");
            middleNameLabel.classList.add("text-red-700");
            middleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            middleNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            middleNameMessage.textContent = "Please enter a valid name.";
            middleNameMessage.classList.remove("text-green-500", "hidden");
            middleNameMessage.classList.add("text-red-500");
            validIconMiddleName.classList.add("hidden");
            invalidIconMiddleName.classList.remove("hidden");
        }

        if (value === "") {
            middleNameLabel.classList.remove("text-green-700", "text-red-700");
            middleNameLabel.classList.add("text-gray-800");
            middleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            middleNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            middleNameMessage.classList.add("hidden");
            middleNameIcon.classList.add("hidden");
        }
    }

    middleNameInput.addEventListener("input", validateMiddleName);

    validateMiddleName();

    const lastNameInput = document.getElementById("last_name");
    const lastNameLabel = document.getElementById("lastNameLabel");
    const lastNameAsterisk = document.getElementById("last_name_asterisk");
    const lastNameIcon = document.getElementById("lastNameIcon");
    const validIconLastName = document.getElementById("validIconLastName");
    const invalidIconLastName = document.getElementById("invalidIconLastName");
    const lastNameMessage = document.getElementById("lastNameMessage");

    function validateLastName() {
        const value = lastNameInput.value.trim();
        lastNameIcon.classList.remove("hidden");

        if (value.length > 32) {
            lastNameAsterisk.style.display = "block";
            lastNameLabel.classList.remove("text-green-700", "text-gray-800");
            lastNameLabel.classList.add("text-red-700");
            lastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            lastNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            lastNameMessage.textContent = "Maximum of 32 characters only.";
            lastNameMessage.classList.remove("text-green-500", "hidden");
            lastNameMessage.classList.add("text-red-500");
            validIconLastName.classList.add("hidden");
            invalidIconLastName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            lastNameAsterisk.style.display = "none";
            lastNameLabel.classList.remove("text-red-700", "text-gray-800");
            lastNameLabel.classList.add("text-green-700");
            lastNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            lastNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            lastNameMessage.textContent = "Looks good!";
            lastNameMessage.classList.remove("text-red-500", "hidden");
            lastNameMessage.classList.add("text-green-500");
            validIconLastName.classList.remove("hidden");
            invalidIconLastName.classList.add("hidden");
        } else {
            lastNameAsterisk.style.display = "block";
            lastNameLabel.classList.remove("text-green-700", "text-gray-800");
            lastNameLabel.classList.add("text-red-700");
            lastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            lastNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            lastNameMessage.textContent = "Please enter a valid name.";
            lastNameMessage.classList.remove("text-green-500", "hidden");
            lastNameMessage.classList.add("text-red-500");
            validIconLastName.classList.add("hidden");
            invalidIconLastName.classList.remove("hidden");
        }

        if (value === "") {
            lastNameAsterisk.style.display = "block";
            lastNameLabel.classList.remove("text-green-700", "text-red-700");
            lastNameLabel.classList.add("text-gray-800");
            lastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            lastNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            lastNameMessage.classList.add("hidden");
            lastNameIcon.classList.add("hidden");
        }
    }

    lastNameInput.addEventListener("input", validateLastName);

    validateLastName();

    const suffixInput = document.getElementById("suffix");
    const suffixLabel = document.getElementById("suffixLabel");
    const suffixIcon = document.getElementById("suffixIcon");
    const validIconSuffix = document.getElementById("validIconSuffix");
    const invalidIconSuffix = document.getElementById("invalidIconSuffix");
    const suffixMessage = document.getElementById("suffixMessage");

    function validateSuffix() {
        const value = suffixInput.value.trim();
        suffixIcon.classList.remove("hidden");

        if (value.length > 10) {
            suffixLabel.classList.remove("text-green-700", "text-gray-800");
            suffixLabel.classList.add("text-red-700");
            suffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            suffixInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            suffixMessage.textContent = "Maximum of 10 characters only.";
            suffixMessage.classList.remove("text-green-500", "hidden");
            suffixMessage.classList.add("text-red-500");
            validIconSuffix.classList.add("hidden");
            invalidIconSuffix.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            suffixLabel.classList.remove("text-red-700", "text-gray-800");
            suffixLabel.classList.add("text-green-700");
            suffixInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            suffixInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            suffixMessage.textContent = "Looks good!";
            suffixMessage.classList.remove("text-red-500", "hidden");
            suffixMessage.classList.add("text-green-500");
            validIconSuffix.classList.remove("hidden");
            invalidIconSuffix.classList.add("hidden");
        } else {
            suffixLabel.classList.remove("text-green-700", "text-gray-800");
            suffixLabel.classList.add("text-red-700");
            suffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            suffixInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            suffixMessage.textContent = "Please enter a valid suffix.";
            suffixMessage.classList.remove("text-green-500", "hidden");
            suffixMessage.classList.add("text-red-500");
            validIconSuffix.classList.add("hidden");
            invalidIconSuffix.classList.remove("hidden");
        }

        if (value === "") {
            suffixLabel.classList.remove("text-green-700", "text-red-700");
            suffixLabel.classList.add("text-gray-800");
            suffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            suffixInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            suffixMessage.classList.add("hidden");
            suffixIcon.classList.add("hidden");
        }
    }

    suffixInput.addEventListener("input", validateSuffix);

    validateSuffix();

    const birthplaceInput = document.getElementById("birthplace");
    const birthplaceLabel = document.getElementById("birthplaceLabel");
    const birthplaceAsterisk = document.getElementById("birthplace_asterisk");
    const birthplaceIcon = document.getElementById("birthplaceIcon");
    const validIconBirthplace = document.getElementById("validIconBirthplace");
    const invalidIconBirthplace = document.getElementById(
        "invalidIconBirthplace"
    );
    const birthplaceMessage = document.getElementById("birthplaceMessage");

    function validateBirthplace() {
        const value = birthplaceInput.value.trim();
        birthplaceIcon.classList.remove("hidden");

        if (value.length > 32) {
            birthplaceAsterisk.style.display = "block";
            birthplaceLabel.classList.remove("text-green-700", "text-gray-800");
            birthplaceLabel.classList.add("text-red-700");
            birthplaceInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            birthplaceInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            birthplaceMessage.textContent =
                "Birthplace cannot exceed 32 characters.";
            birthplaceMessage.classList.remove("text-green-500", "hidden");
            birthplaceMessage.classList.add("text-red-500");
            validIconBirthplace.classList.add("hidden");
            invalidIconBirthplace.classList.remove("hidden");
        } else if (value.length > 0 && /^[a-zA-Z\s\-.']+$/.test(value)) {
            birthplaceAsterisk.style.display = "none";
            birthplaceLabel.classList.remove("text-red-700", "text-gray-800");
            birthplaceLabel.classList.add("text-green-700");
            birthplaceInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            birthplaceInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            birthplaceMessage.textContent = "Looks good!";
            birthplaceMessage.classList.remove("text-red-500", "hidden");
            birthplaceMessage.classList.add("text-green-500");
            validIconBirthplace.classList.remove("hidden");
            invalidIconBirthplace.classList.add("hidden");
        } else {
            birthplaceAsterisk.style.display = "block";
            birthplaceLabel.classList.remove("text-green-700", "text-gray-800");
            birthplaceLabel.classList.add("text-red-700");
            birthplaceInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            birthplaceInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            birthplaceMessage.textContent = "Please enter a valid birthplace.";
            birthplaceMessage.classList.remove("text-green-500", "hidden");
            birthplaceMessage.classList.add("text-red-500");
            validIconBirthplace.classList.add("hidden");
            invalidIconBirthplace.classList.remove("hidden");
        }

        if (value === "") {
            birthplaceAsterisk.style.display = "block";
            birthplaceLabel.classList.remove("text-green-700", "text-red-700");
            birthplaceLabel.classList.add("text-gray-800");
            birthplaceInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            birthplaceInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            birthplaceMessage.classList.add("hidden");
            birthplaceIcon.classList.add("hidden");
        }
    }

    birthplaceInput.addEventListener("input", validateBirthplace);

    validateBirthplace();

    const sexInput = document.getElementById("sex_id");
    const sexLabel = document.getElementById("sexLabel");
    const sexAsterisk = document.getElementById("sex_asterisk");
    const sexIcon = document.getElementById("sexIcon");
    const validIconSex = document.getElementById("validIconSex");
    const invalidIconSex = document.getElementById("invalidIconSex");
    const sexMessage = document.getElementById("sexMessage");

    function validateSex() {
        const value = sexInput.value;
        sexIcon.classList.remove("hidden");

        if (!value) {
            sexAsterisk.style.display = "block";
            sexLabel.classList.remove("text-green-700", "text-gray-800");
            sexLabel.classList.add("text-red-700");
            sexInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            sexInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            sexMessage.textContent = "Please select a valid option.";
            sexMessage.classList.remove("text-green-500", "hidden");
            sexMessage.classList.add("text-red-500");
            validIconSex.classList.add("hidden");
            invalidIconSex.classList.remove("hidden");
        } else {
            sexAsterisk.style.display = "none";
            sexLabel.classList.remove("text-red-700", "text-gray-800");
            sexLabel.classList.add("text-green-700");
            sexInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            sexInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            sexMessage.textContent = "Looks good!";
            sexMessage.classList.remove("text-red-500", "hidden");
            sexMessage.classList.add("text-green-500");
            validIconSex.classList.remove("hidden");
            invalidIconSex.classList.add("hidden");
        }

        if (value === "") {
            sexAsterisk.style.display = "block";
            sexLabel.classList.remove("text-green-700", "text-red-700");
            sexLabel.classList.add("text-gray-800");
            sexInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            sexInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            sexMessage.classList.add("hidden");
            sexIcon.classList.add("hidden");
        }
    }

    sexInput.addEventListener("change", validateSex);

    window.addEventListener("DOMContentLoaded", validateSex);

    const civilStatusInput = document.getElementById("civil_status_id");
    const civilStatusLabel = document.getElementById("civilStatusLabel");
    const civilStatusAsterisk = document.getElementById(
        "civil_status_asterisk"
    );
    const civilStatusIcon = document.getElementById("civilStatusIcon");
    const validIconCivilStatus = document.getElementById(
        "validIconCivilStatus"
    );
    const invalidIconCivilStatus = document.getElementById(
        "invalidIconCivilStatus"
    );
    const civilStatusMessage = document.getElementById("civilStatusMessage");

    function validateCivilStatus() {
        const value = civilStatusInput.value;
        civilStatusIcon.classList.remove("hidden");

        if (!value) {
            civilStatusAsterisk.style.display = "block";
            civilStatusLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            civilStatusLabel.classList.add("text-red-700");
            civilStatusInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            civilStatusInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            civilStatusMessage.textContent = "Please select a valid option.";
            civilStatusMessage.classList.remove("text-green-500", "hidden");
            civilStatusMessage.classList.add("text-red-500");
            validIconCivilStatus.classList.add("hidden");
            invalidIconCivilStatus.classList.remove("hidden");
        } else {
            civilStatusAsterisk.style.display = "none";
            civilStatusLabel.classList.remove("text-red-700", "text-gray-800");
            civilStatusLabel.classList.add("text-green-700");
            civilStatusInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            civilStatusInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            civilStatusMessage.textContent = "Looks good!";
            civilStatusMessage.classList.remove("text-red-500", "hidden");
            civilStatusMessage.classList.add("text-green-500");
            validIconCivilStatus.classList.remove("hidden");
            invalidIconCivilStatus.classList.add("hidden");
        }

        if (value === "") {
            civilStatusAsterisk.style.display = "block";
            civilStatusLabel.classList.remove("text-green-700", "text-red-700");
            civilStatusLabel.classList.add("text-gray-800");
            civilStatusInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            civilStatusInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            civilStatusMessage.classList.add("hidden");
            civilStatusIcon.classList.add("hidden");
        }
    }

    civilStatusInput.addEventListener("change", validateCivilStatus);

    window.addEventListener("DOMContentLoaded", validateCivilStatus);

    const contactNoInput = document.getElementById("contact_no");
    const contactNoLabel = document.getElementById("contactNoLabel");
    const contactNoAsterisk = document.getElementById("contact_no_asterisk");
    const contactNoIcon = document.getElementById("contactNoIcon");
    const validIconContactNo = document.getElementById("validIconContactNo");
    const invalidIconContactNo = document.getElementById(
        "invalidIconContactNo"
    );
    const contactNoMessage = document.getElementById("contactNoMessage");

    function validateContactNo() {
        const value = contactNoInput.value.trim();
        contactNoIcon.classList.remove("hidden");

        if (value === "") {
            contactNoAsterisk.style.display = "block";
            contactNoLabel.classList.remove("text-green-700", "text-red-700");
            contactNoLabel.classList.add("text-gray-800");
            contactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            contactNoInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            contactNoMessage.classList.add("hidden");
            contactNoIcon.classList.add("hidden");
            return;
        }

        if (value.length !== 10) {
            contactNoAsterisk.style.display = "block";
            contactNoLabel.classList.remove("text-green-700", "text-gray-800");
            contactNoLabel.classList.add("text-red-700");
            contactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            contactNoInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            contactNoMessage.textContent =
                "Contact number must be exactly 10 digits.";
            contactNoMessage.classList.remove("text-green-500", "hidden");
            contactNoMessage.classList.add("text-red-500");
            validIconContactNo.classList.add("hidden");
            invalidIconContactNo.classList.remove("hidden");
            return;
        }

        if (!value.startsWith("9")) {
            contactNoAsterisk.style.display = "block";
            contactNoLabel.classList.remove("text-green-700", "text-gray-800");
            contactNoLabel.classList.add("text-red-700");
            contactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            contactNoInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            contactNoMessage.textContent =
                "Contact number must start with 9 after +63.";
            contactNoMessage.classList.remove("text-green-500", "hidden");
            contactNoMessage.classList.add("text-red-500");
            validIconContactNo.classList.add("hidden");
            invalidIconContactNo.classList.remove("hidden");
            return;
        }

        contactNoLabel.classList.remove("text-red-700", "text-gray-800");
        contactNoAsterisk.style.display = "none";
        contactNoLabel.classList.add("text-green-700");
        contactNoInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900",
            "placeholder-red-700",
            "focus:ring-red-500",
            "focus:border-red-500"
        );
        contactNoInput.classList.add(
            "bg-green-50",
            "border-green-500",
            "text-green-900",
            "placeholder-green-700",
            "focus:ring-green-500",
            "focus:border-green-500"
        );
        contactNoMessage.textContent = "Looks good!";
        contactNoMessage.classList.remove("text-red-500", "hidden");
        contactNoMessage.classList.add("text-green-500");
        validIconContactNo.classList.remove("hidden");
        invalidIconContactNo.classList.add("hidden");
    }

    contactNoInput.addEventListener("input", validateContactNo);

    validateContactNo();

    const addressInput = document.getElementById("address");
    const addressLabel = document.getElementById("addressLabel");
    const addressAsterisk = document.getElementById("address_asterisk");
    const addressMessage = document.getElementById("addressMessage");
    const addressIcon = document.getElementById("addressIcon");
    const validIconAddress = document.getElementById("validIconAddress");
    const invalidIconAddress = document.getElementById("invalidIconAddress");

    function validateAddress() {
        const value = addressInput.value.trim();
        const caloocanRegex = /\bCaloocan\b/i;

        addressAsterisk.style.display = "block";
        addressLabel.classList.remove(
            "text-green-700",
            "text-red-700",
            "text-gray-800"
        );
        addressInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900",
            "placeholder-green-700",
            "focus:ring-green-500",
            "focus:border-green-500",
            "bg-red-50",
            "border-red-500",
            "text-red-900",
            "placeholder-red-700",
            "focus:ring-red-500",
            "focus:border-red-500"
        );
        addressMessage.classList.add("hidden");
        addressIcon.classList.remove("hidden");

        if (value === "") {
            addressAsterisk.style.display = "block";
            addressLabel.classList.add("text-gray-800");
            addressInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            addressMessage.classList.add("hidden");
            validIconAddress.classList.add("hidden");
            invalidIconAddress.classList.add("hidden");
        } else if (value.length < 10) {
            addressAsterisk.style.display = "block";
            addressLabel.classList.add("text-red-700");
            addressInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            addressMessage.textContent = "Minimum of 10 characters.";
            addressMessage.classList.remove("hidden", "text-green-500");
            addressMessage.classList.add("text-red-500");
            validIconAddress.classList.add("hidden");
            invalidIconAddress.classList.remove("hidden");
        } else if (value.length > 100) {
            addressAsterisk.style.display = "block";
            addressLabel.classList.add("text-red-700");
            addressInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            addressMessage.textContent = "Maximum of 100 characters only.";
            addressMessage.classList.remove("hidden", "text-green-500");
            addressMessage.classList.add("text-red-500");
            validIconAddress.classList.add("hidden");
            invalidIconAddress.classList.remove("hidden");
        } else if (!caloocanRegex.test(value)) {
            addressAsterisk.style.display = "block";
            addressLabel.classList.add("text-red-700");
            addressInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            addressMessage.textContent = "Address must include 'Caloocan'.";
            addressMessage.classList.remove("hidden", "text-green-500");
            addressMessage.classList.add("text-red-500");
            validIconAddress.classList.add("hidden");
            invalidIconAddress.classList.remove("hidden");
        } else {
            addressAsterisk.style.display = "none";
            addressLabel.classList.add("text-green-700");
            addressInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            addressMessage.textContent = "Looks good!";
            addressMessage.classList.remove("hidden", "text-red-500");
            addressMessage.classList.add("text-green-500");
            validIconAddress.classList.remove("hidden");
            invalidIconAddress.classList.add("hidden");
        }
    }

    addressInput.addEventListener("input", validateAddress);

    validateAddress();

    const barangaySelect = document.getElementById("barangay_id");
    const barangayLabel = document.getElementById("barangayLabel");
    const barangayAsterisk = document.getElementById("barangay_asterisk");
    const barangayIcon = document.getElementById("barangayIcon");
    const validIconBarangay = document.getElementById("validIconBarangay");
    const invalidIconBarangay = document.getElementById("invalidIconBarangay");
    const barangayMessage = document.getElementById("barangayMessage");

    function validateBarangay() {
        const value = barangaySelect.value;
        barangayIcon.classList.remove("hidden");

        if (value === "") {
            barangayAsterisk.style.display = "block";
            barangayLabel.classList.remove("text-green-700", "text-red-700");
            barangayLabel.classList.add("text-gray-800");
            barangaySelect.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            barangaySelect.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            barangayMessage.classList.add("hidden");
            barangayIcon.classList.add("hidden");
            return;
        }

        if (!value) {
            barangayAsterisk.style.display = "block";
            barangayLabel.classList.remove("text-green-700", "text-gray-800");
            barangayLabel.classList.add("text-red-700");
            barangaySelect.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            barangaySelect.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            barangayMessage.textContent = "Please select a valid barangay.";
            barangayMessage.classList.remove("text-green-500", "hidden");
            barangayMessage.classList.add("text-red-500");
            validIconBarangay.classList.add("hidden");
            invalidIconBarangay.classList.remove("hidden");
            return;
        }

        barangayAsterisk.style.display = "none";
        barangayLabel.classList.remove("text-red-700", "text-gray-800");
        barangayLabel.classList.add("text-green-700");
        barangaySelect.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900",
            "focus:ring-red-500",
            "focus:border-red-500"
        );
        barangaySelect.classList.add(
            "bg-green-50",
            "border-green-500",
            "text-green-900",
            "focus:ring-green-500",
            "focus:border-green-500"
        );
        barangayMessage.textContent = "Looks good!";
        barangayMessage.classList.remove("text-red-500", "hidden");
        barangayMessage.classList.add("text-green-500");
        validIconBarangay.classList.remove("hidden");
        invalidIconBarangay.classList.add("hidden");
    }

    barangaySelect.addEventListener("change", validateBarangay);

    validateBarangay();

    const livingArrangementOptions = document.getElementsByName(
        "type_of_living_arrangement"
    );
    const otherArrangementRemark = document.getElementById(
        "otherArrangementRemark"
    );
    const otherArrangementRemarkAsterisk = document.getElementById(
        "other_arrangement_remark_asterisk"
    );
    const otherArrangementRemarkLabel = document.getElementById(
        "other_arrangement_remark_label"
    ); 
    const livingArrangementAsterisk = document.getElementById(
        "living_arrangement_asterisk"
    );
    const livingArrangementLabel = document.getElementById(
        "livingArrangementLabel"
    );
    const livingArrangementMessage = document.getElementById(
        "livingArrangementMessage"
    );

    function validateLivingArrangement() {
        let selectedOption = null;

        livingArrangementOptions.forEach((option) => {
            const optionLabel = document.querySelector(
                `label[for="${option.id}"]`
            );

            if (option.checked) {
                selectedOption = option.value;
                livingArrangementAsterisk.style.display = "none";
                optionLabel.classList.add("text-green-700");
                optionLabel.classList.remove("text-gray-800");
            } else {
                livingArrangementAsterisk.style.display = "block";
                optionLabel.classList.remove("text-green-700");
                optionLabel.classList.add("text-gray-800");
            }
        });

        if (!selectedOption) {
            livingArrangementAsterisk.style.display = "block";
            livingArrangementLabel.classList.remove(
                "text-red-700",
                "text-green-700"
            );
            livingArrangementLabel.classList.add("text-gray-800");
            livingArrangementMessage.textContent = "";
            livingArrangementMessage.classList.add("hidden");
            otherArrangementRemark.classList.add("hidden");
            otherArrangementRemarkLabel.classList.add("hidden");
            return;
        }

        if (selectedOption === "5") {
            livingArrangementAsterisk.style.display = "none";
            livingArrangementLabel.classList.remove("text-red-700");
            livingArrangementLabel.classList.add("text-green-700");
            livingArrangementMessage.textContent = "";
            livingArrangementMessage.classList.add("hidden");
            otherArrangementRemark.classList.remove("hidden");
            otherArrangementRemarkLabel.classList.remove("hidden");
        } else {
            livingArrangementAsterisk.style.display = "none";
            livingArrangementLabel.classList.remove("text-red-700");
            livingArrangementLabel.classList.add("text-green-700");
            livingArrangementMessage.textContent = "Looks good!";
            livingArrangementMessage.classList.remove("hidden", "text-red-500");
            livingArrangementMessage.classList.add("text-green-500");
            otherArrangementRemark.classList.add("hidden");
            otherArrangementRemarkLabel.classList.add("hidden");
        }
    }

    function validateOtherArrangementRemark() {
        const remarkValue = otherArrangementRemark.value.trim();

        if (remarkValue.length > 32) {
            otherArrangementRemarkAsterisk.style.display = "block";
            otherArrangementRemark.value = remarkValue.substring(0, 32);
            livingArrangementMessage.textContent =
                "Maximum 32 characters only.";
            livingArrangementMessage.classList.remove(
                "hidden",
                "text-green-500"
            );
            livingArrangementMessage.classList.add("text-red-500");
            otherArrangementRemark.classList.add("border-red-500", "bg-red-50");
            otherArrangementRemark.classList.remove(
                "border-green-500",
                "bg-green-50"
            );
            otherArrangementRemarkLabel.classList.add("text-red-500");
            otherArrangementRemarkLabel.classList.remove("text-green-500");
        } else if (remarkValue) {
            otherArrangementRemarkAsterisk.style.display = "none";
            livingArrangementMessage.textContent = "Looks good!";
            livingArrangementMessage.classList.remove("hidden", "text-red-500");
            livingArrangementMessage.classList.add("text-green-500");
            otherArrangementRemark.classList.add(
                "border-green-500",
                "bg-green-50"
            );
            otherArrangementRemark.classList.remove(
                "border-gray-300",
                "bg-gray-100"
            );
            otherArrangementRemarkLabel.classList.add("text-green-500");
            otherArrangementRemarkLabel.classList.remove("text-red-500");
        } else {
            otherArrangementRemarkAsterisk.style.display = "block";
            livingArrangementMessage.textContent = "";
            livingArrangementMessage.classList.add("hidden");
            otherArrangementRemark.classList.remove(
                "border-green-500",
                "bg-green-50"
            );
            otherArrangementRemark.classList.add(
                "border-gray-300",
                "bg-gray-100"
            );
            otherArrangementRemarkLabel.classList.remove("text-green-500");
            otherArrangementRemarkLabel.classList.add("text-gray-500");
        }
    }

    livingArrangementOptions.forEach((option) => {
        option.addEventListener("change", validateLivingArrangement);
    });

    otherArrangementRemark.addEventListener(
        "input",
        validateOtherArrangementRemark
    );

    validateLivingArrangement();
    validateOtherArrangementRemark();


    const guardianFirstNameInput = document.getElementById(
        "guardian_first_name"
    );
    const guardianFirstNameLabel = document.getElementById(
        "guardianFirstNameLabel"
    );
    const guardianFirstNameIcon = document.getElementById(
        "guardianFirstNameIcon"
    );
    const validIconGuardianFirstName = document.getElementById(
        "validIconGuardianFirstName"
    );
    const invalidIconGuardianFirstName = document.getElementById(
        "invalidIconGuardianFirstName"
    );
    const guardianFirstNameMessage = document.getElementById(
        "guardianFirstNameMessage"
    );

    function validateGuardianFirstName() {
        const value = guardianFirstNameInput.value.trim();
        guardianFirstNameIcon.classList.remove("hidden");

        if (value.length > 64) {
            guardianFirstNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianFirstNameLabel.classList.add("text-red-700");
            guardianFirstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianFirstNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianFirstNameMessage.textContent =
                "Maximum of 64 characters only.";
            guardianFirstNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianFirstNameMessage.classList.add("text-red-500");
            validIconGuardianFirstName.classList.add("hidden");
            invalidIconGuardianFirstName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            guardianFirstNameLabel.classList.remove(
                "text-red-700",
                "text-gray-800"
            );
            guardianFirstNameLabel.classList.add("text-green-700");
            guardianFirstNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianFirstNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianFirstNameMessage.textContent = "Looks good!";
            guardianFirstNameMessage.classList.remove("text-red-500", "hidden");
            guardianFirstNameMessage.classList.add("text-green-500");
            validIconGuardianFirstName.classList.remove("hidden");
            invalidIconGuardianFirstName.classList.add("hidden");
        } else {
            guardianFirstNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianFirstNameLabel.classList.add("text-red-700");
            guardianFirstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianFirstNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianFirstNameMessage.textContent = "Please enter a valid name.";
            guardianFirstNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianFirstNameMessage.classList.add("text-red-500");
            validIconGuardianFirstName.classList.add("hidden");
            invalidIconGuardianFirstName.classList.remove("hidden");
        }

        if (value === "") {
            guardianFirstNameLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianFirstNameLabel.classList.add("text-gray-800");
            guardianFirstNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianFirstNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianFirstNameMessage.classList.add("hidden");
            guardianFirstNameIcon.classList.add("hidden");
        }
    }

    guardianFirstNameInput.addEventListener("input", validateGuardianFirstName);

    validateGuardianFirstName();

    const guardianMiddleNameInput = document.getElementById(
        "guardian_middle_name"
    );
    const guardianMiddleNameLabel = document.getElementById(
        "guardianMiddleNameLabel"
    );
    const guardianMiddleNameIcon = document.getElementById(
        "guardianMiddleNameIcon"
    );
    const validIconGuardianMiddleName = document.getElementById(
        "validIconGuardianMiddleName"
    );
    const invalidIconGuardianMiddleName = document.getElementById(
        "invalidIconGuardianMiddleName"
    );
    const guardianMiddleNameMessage = document.getElementById(
        "guardianMiddleNameMessage"
    );

    function validateGuardianMiddleName() {
        const value = guardianMiddleNameInput.value.trim();
        guardianMiddleNameIcon.classList.remove("hidden");

        if (value.length > 32) {
            guardianMiddleNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianMiddleNameLabel.classList.add("text-red-700");
            guardianMiddleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianMiddleNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianMiddleNameMessage.textContent =
                "Maximum of 32 characters only.";
            guardianMiddleNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianMiddleNameMessage.classList.add("text-red-500");
            validIconGuardianMiddleName.classList.add("hidden");
            invalidIconGuardianMiddleName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            guardianMiddleNameLabel.classList.remove(
                "text-red-700",
                "text-gray-800"
            );
            guardianMiddleNameLabel.classList.add("text-green-700");
            guardianMiddleNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianMiddleNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianMiddleNameMessage.textContent = "Looks good!";
            guardianMiddleNameMessage.classList.remove(
                "text-red-500",
                "hidden"
            );
            guardianMiddleNameMessage.classList.add("text-green-500");
            validIconGuardianMiddleName.classList.remove("hidden");
            invalidIconGuardianMiddleName.classList.add("hidden");
        } else {
            guardianMiddleNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianMiddleNameLabel.classList.add("text-red-700");
            guardianMiddleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianMiddleNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianMiddleNameMessage.textContent =
                "Please enter a valid name.";
            guardianMiddleNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianMiddleNameMessage.classList.add("text-red-500");
            validIconGuardianMiddleName.classList.add("hidden");
            invalidIconGuardianMiddleName.classList.remove("hidden");
        }

        if (value === "") {
            guardianMiddleNameLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianMiddleNameLabel.classList.add("text-gray-800");
            guardianMiddleNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianMiddleNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianMiddleNameMessage.classList.add("hidden");
            guardianMiddleNameIcon.classList.add("hidden");
        }
    }

    guardianMiddleNameInput.addEventListener(
        "input",
        validateGuardianMiddleName
    );

    validateGuardianMiddleName();

    const guardianLastNameInput = document.getElementById("guardian_last_name");
    const guardianLastNameLabel = document.getElementById(
        "guardianLastNameLabel"
    );
    const guardianLastNameIcon = document.getElementById(
        "guardianLastNameIcon"
    );
    const validIconGuardianLastName = document.getElementById(
        "validIconGuardianLastName"
    );
    const invalidIconGuardianLastName = document.getElementById(
        "invalidIconGuardianLastName"
    );
    const guardianLastNameMessage = document.getElementById(
        "guardianLastNameMessage"
    );

    function validateGuardianLastName() {
        const value = guardianLastNameInput.value.trim();
        guardianLastNameIcon.classList.remove("hidden");

        if (value.length > 32) {
            guardianLastNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianLastNameLabel.classList.add("text-red-700");
            guardianLastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianLastNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianLastNameMessage.textContent =
                "Maximum of 32 characters only.";
            guardianLastNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianLastNameMessage.classList.add("text-red-500");
            validIconGuardianLastName.classList.add("hidden");
            invalidIconGuardianLastName.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            guardianLastNameLabel.classList.remove(
                "text-red-700",
                "text-gray-800"
            );
            guardianLastNameLabel.classList.add("text-green-700");
            guardianLastNameInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianLastNameInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianLastNameMessage.textContent = "Looks good!";
            guardianLastNameMessage.classList.remove("text-red-500", "hidden");
            guardianLastNameMessage.classList.add("text-green-500");
            validIconGuardianLastName.classList.remove("hidden");
            invalidIconGuardianLastName.classList.add("hidden");
        } else {
            guardianLastNameLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianLastNameLabel.classList.add("text-red-700");
            guardianLastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianLastNameInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianLastNameMessage.textContent = "Please enter a valid name.";
            guardianLastNameMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianLastNameMessage.classList.add("text-red-500");
            validIconGuardianLastName.classList.add("hidden");
            invalidIconGuardianLastName.classList.remove("hidden");
        }

        if (value === "") {
            guardianLastNameLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianLastNameLabel.classList.add("text-gray-800");
            guardianLastNameInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianLastNameInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianLastNameMessage.classList.add("hidden");
            guardianLastNameIcon.classList.add("hidden");
        }
    }

    guardianLastNameInput.addEventListener("input", validateGuardianLastName);

    validateGuardianLastName();

    const guardianSuffixInput = document.getElementById("guardian_suffix");
    const guardianSuffixLabel = document.getElementById("guardianSuffixLabel");
    const guardianSuffixIcon = document.getElementById("guardianSuffixIcon");
    const validIconGuardianSuffix = document.getElementById(
        "validIconGuardianSuffix"
    );
    const invalidIconGuardianSuffix = document.getElementById(
        "invalidIconGuardianSuffix"
    );
    const guardianSuffixMessage = document.getElementById(
        "guardianSuffixMessage"
    );

    function validateGuardianSuffix() {
        const value = guardianSuffixInput.value.trim();
        guardianSuffixIcon.classList.remove("hidden");

        if (value.length > 10) {
            guardianSuffixLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianSuffixLabel.classList.add("text-red-700");
            guardianSuffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianSuffixInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianSuffixMessage.textContent =
                "Maximum of 10 characters only.";
            guardianSuffixMessage.classList.remove("text-green-500", "hidden");
            guardianSuffixMessage.classList.add("text-red-500");
            validIconGuardianSuffix.classList.add("hidden");
            invalidIconGuardianSuffix.classList.remove("hidden");
        } else if (
            value.length > 0 &&
            /^[a-zA-Z\s\-.'áéíóúàèùãõç]+$/.test(value)
        ) {
            guardianSuffixLabel.classList.remove(
                "text-red-700",
                "text-gray-800"
            );
            guardianSuffixLabel.classList.add("text-green-700");
            guardianSuffixInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianSuffixInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianSuffixMessage.textContent = "Looks good!";
            guardianSuffixMessage.classList.remove("text-red-500", "hidden");
            guardianSuffixMessage.classList.add("text-green-500");
            validIconGuardianSuffix.classList.remove("hidden");
            invalidIconGuardianSuffix.classList.add("hidden");
        } else {
            guardianSuffixLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianSuffixLabel.classList.add("text-red-700");
            guardianSuffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianSuffixInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianSuffixMessage.textContent = "Please enter a valid suffix.";
            guardianSuffixMessage.classList.remove("text-green-500", "hidden");
            guardianSuffixMessage.classList.add("text-red-500");
            validIconGuardianSuffix.classList.add("hidden");
            invalidIconGuardianSuffix.classList.remove("hidden");
        }

        if (value === "") {
            guardianSuffixLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianSuffixLabel.classList.add("text-gray-800");
            guardianSuffixInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianSuffixInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianSuffixMessage.classList.add("hidden");
            guardianSuffixIcon.classList.add("hidden");
        }
    }

    guardianSuffixInput.addEventListener("input", validateGuardianSuffix);

    validateGuardianSuffix();

    const guardianRelationshipInput = document.getElementById(
        "guardian_relationship_id"
    );
    const guardianRelationshipLabel = document.getElementById(
        "guardianRelationshipLabel"
    );
    const guardianRelationshipIcon = document.getElementById(
        "guardianRelationshipIcon"
    );
    const validIconGuardianRelationship = document.getElementById(
        "validIconGuardianRelationship"
    );
    const invalidIconGuardianRelationship = document.getElementById(
        "invalidIconGuardianRelationship"
    );
    const guardianRelationshipMessage = document.getElementById(
        "guardianRelationshipMessage"
    );

    function validateGuardianRelationship() {
        const value = guardianRelationshipInput.value;
        guardianRelationshipIcon.classList.remove("hidden");

        if (!value) {
            guardianRelationshipLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianRelationshipLabel.classList.add("text-red-700");
            guardianRelationshipInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianRelationshipInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianRelationshipMessage.textContent =
                "Please select a valid option.";
            guardianRelationshipMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianRelationshipMessage.classList.add("text-red-500");
            validIconGuardianRelationship.classList.add("hidden");
            invalidIconGuardianRelationship.classList.remove("hidden");
        } else {
            guardianRelationshipLabel.classList.remove(
                "text-red-700",
                "text-gray-800"
            );
            guardianRelationshipLabel.classList.add("text-green-700");
            guardianRelationshipInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianRelationshipInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianRelationshipMessage.textContent = "Looks good!";
            guardianRelationshipMessage.classList.remove(
                "text-red-500",
                "hidden"
            );
            guardianRelationshipMessage.classList.add("text-green-500");
            validIconGuardianRelationship.classList.remove("hidden");
            invalidIconGuardianRelationship.classList.add("hidden");
        }

        if (value === "") {
            guardianRelationshipLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianRelationshipLabel.classList.add("text-gray-800");
            guardianRelationshipInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianRelationshipInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianRelationshipMessage.classList.add("hidden");
            guardianRelationshipIcon.classList.add("hidden");
        }
    }

    guardianRelationshipInput.addEventListener(
        "change",
        validateGuardianRelationship
    );

    window.addEventListener("DOMContentLoaded", validateGuardianRelationship);

    const guardianContactNoInput = document.getElementById(
        "guardian_contact_no"
    );
    const guardianContactNoLabel = document.getElementById(
        "guardianContactNoLabel"
    );
    const guardianContactNoIcon = document.getElementById(
        "guardianContactNoIcon"
    );
    const validIconGuardianContactNo = document.getElementById(
        "validIconGuardianContactNo"
    );
    const invalidIconGuardianContactNo = document.getElementById(
        "invalidIconGuardianContactNo"
    );
    const guardianContactNoMessage = document.getElementById(
        "guardianContactNoMessage"
    );

    function validateGuardianContactNo() {
        const value = guardianContactNoInput.value.trim();
        guardianContactNoIcon.classList.remove("hidden");

        if (value === "") {
            guardianContactNoLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            guardianContactNoLabel.classList.add("text-gray-800");
            guardianContactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianContactNoInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            guardianContactNoMessage.classList.add("hidden");
            guardianContactNoIcon.classList.add("hidden");
            return;
        }

        if (value.length !== 10) {
            guardianContactNoLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianContactNoLabel.classList.add("text-red-700");
            guardianContactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianContactNoInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianContactNoMessage.textContent =
                "Contact number must be exactly 10 digits.";
            guardianContactNoMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianContactNoMessage.classList.add("text-red-500");
            validIconGuardianContactNo.classList.add("hidden");
            invalidIconGuardianContactNo.classList.remove("hidden");
            return;
        }

        if (!value.startsWith("9")) {
            guardianContactNoLabel.classList.remove(
                "text-green-700",
                "text-gray-800"
            );
            guardianContactNoLabel.classList.add("text-red-700");
            guardianContactNoInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            guardianContactNoInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            guardianContactNoMessage.textContent =
                "Contact number must start with 9 after +63.";
            guardianContactNoMessage.classList.remove(
                "text-green-500",
                "hidden"
            );
            guardianContactNoMessage.classList.add("text-red-500");
            validIconGuardianContactNo.classList.add("hidden");
            invalidIconGuardianContactNo.classList.remove("hidden");
            return;
        }

        guardianContactNoLabel.classList.remove(
            "text-red-700",
            "text-gray-800"
        );
        guardianContactNoLabel.classList.add("text-green-700");
        guardianContactNoInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900",
            "placeholder-red-700",
            "focus:ring-red-500",
            "focus:border-red-500"
        );
        guardianContactNoInput.classList.add(
            "bg-green-50",
            "border-green-500",
            "text-green-900",
            "placeholder-green-700",
            "focus:ring-green-500",
            "focus:border-green-500"
        );
        guardianContactNoMessage.textContent = "Looks good!";
        guardianContactNoMessage.classList.remove("text-red-500", "hidden");
        guardianContactNoMessage.classList.add("text-green-500");
        validIconGuardianContactNo.classList.remove("hidden");
        invalidIconGuardianContactNo.classList.add("hidden");
    }

    guardianContactNoInput.addEventListener("input", validateGuardianContactNo);

    window.addEventListener("DOMContentLoaded", validateGuardianContactNo);

    const pensionerOptions = document.getElementsByName("pensioner");
    const pensionerLabel = document.getElementById("pensionerLabel");
    const pensionerAsterisk = document.getElementById("pensioner_asterisk");
    const pensionerYesAsterisk = document.getElementById("if_pensioner_yes_asterisk");
    const sourceAsterisk = document.getElementById("source_asterisk");
    const pensionerMessage = document.getElementById("pensionerMessage");
    const ifPensionerLabel = document.getElementById("pensioner_label");
    const ifPensionerDropdown = document.getElementById("if_pensioner_yes");
    const sourceLabel = document.getElementById("source_label");
    const sourceList = document.getElementById("source_list");
    const sourceCheckboxes = document.querySelectorAll(".source-checkbox");
    const otherSourceLabel = document.getElementById("other_source_label");
    const otherSourceRemark = document.getElementById("other_source_remark");

    // function resetStyles() {
    //     otherSourceLabel.classList.remove("text-green-700", "text-red-700");
    //     otherSourceLabel.classList.add("text-gray-800");
    //     otherSourceRemark.classList.remove(
    //         "border-green-500",
    //         "bg-green-50",
    //         "border-red-500",
    //         "bg-red-50"
    //     );
    //     otherSourceRemark.classList.add("border-gray-300", "bg-gray-100");
    //     otherSourceRemark.value = ""; 
    //     pensionerMessage.textContent = "";
    //     pensionerMessage.classList.add("hidden");

    //     ifPensionerLabel.classList.remove("text-green-700", "text-red-700");
    //     ifPensionerLabel.classList.add("text-gray-800");
    //     ifPensionerDropdown.classList.remove(
    //         "bg-green-50",
    //         "border-green-500",
    //         "text-green-900",
    //         "focus:ring-green-500",
    //         "focus:border-green-500"
    //     );
    //     ifPensionerDropdown.classList.add(
    //         "bg-gray-100",
    //         "border-gray-500",
    //         "focus:ring-blue-500",
    //         "focus:border-blue-500"
    //     );

    //     sourceLabel.classList.remove("text-green-700", "text-red-700");
    //     sourceLabel.classList.add("text-gray-800");
    //     sourceCheckboxes.forEach((checkbox) => {
    //         checkbox.classList.remove(
    //             "bg-green-50",
    //             "border-green-500",
    //             "text-green-900",
    //             "focus:ring-green-500",
    //             "focus:border-green-500"
    //         );
    //         checkbox.classList.add(
    //             "bg-gray-100",
    //             "border-gray-500",
    //             "focus:ring-blue-500",
    //             "focus:border-blue-500"
    //         );
    //         checkbox.checked = false; 
    //     });

    //     sourceList.parentElement.classList.add("hidden");
    //     otherSourceRemark.parentElement.classList.add("hidden");
    // }

    function validatePensioner() {
        // resetStyles(); 

        let selectedOption = null;
        pensionerOptions.forEach((option) => {
            const optionLabel = document.querySelector(
                `label[for="${option.id}"]`
            );

            if (option.checked) {
                selectedOption = option.value;
                pensionerAsterisk.style.display = "none";
                optionLabel.classList.add("text-green-700");
                optionLabel.classList.remove("text-gray-800", "text-red-700");
            } else {
                pensionerAsterisk.style.display = "block";
                optionLabel.classList.remove("text-green-700", "text-red-700");
                optionLabel.classList.add("text-gray-800");
            }
        });

        if (!selectedOption) {
            pensionerAsterisk.style.display = "block";
            pensionerLabel.classList.remove("text-green-700", "text-red-700");
            pensionerLabel.classList.add("text-gray-800");
            pensionerMessage.textContent = "";
            pensionerMessage.classList.add("hidden");
            return false;
        }

        if (selectedOption === "1") {
            pensionerAsterisk.style.display = "none";
            pensionerLabel.classList.remove("text-red-700");
            pensionerLabel.classList.add("text-green-700");
            pensionerMessage.textContent = "Looks good!";
            pensionerMessage.classList.remove("hidden", "text-red-500");
            pensionerMessage.classList.add("text-green-500");
            ifPensionerDropdown.parentElement.classList.remove("hidden");
            sourceList.parentElement.classList.remove("hidden");
            otherSourceRemark.parentElement.classList.remove("hidden");
        } else {
            pensionerAsterisk.style.display = "none";
            pensionerLabel.classList.remove("text-red-700");
            pensionerLabel.classList.add("text-green-700");
            pensionerMessage.textContent = "Looks good!";
            pensionerMessage.classList.remove("hidden", "text-red-500");
            pensionerMessage.classList.add("text-green-500");
            ifPensionerDropdown.parentElement.classList.add("hidden");
            sourceList.parentElement.classList.add("hidden");
            otherSourceRemark.parentElement.classList.add("hidden");
        }
    }

    function validateIfPensioner() {
        const value = ifPensionerDropdown.value;

        if (value) {
            pensionerYesAsterisk.style.display = "none";
            ifPensionerLabel.classList.remove("text-gray-800", "text-red-700");
            ifPensionerLabel.classList.add("text-green-700");
            ifPensionerDropdown.classList.remove(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            ifPensionerDropdown.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
        } else {
            pensionerYesAsterisk.style.display = "block";
            ifPensionerLabel.classList.remove("text-green-700", "text-red-700");
            ifPensionerLabel.classList.add("text-gray-800");
            ifPensionerDropdown.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            ifPensionerDropdown.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
        }
    }

    function validateSource() {
        let isChecked = false;

        sourceCheckboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (isChecked) {
            sourceLabel.classList.remove("text-gray-800", "text-red-700");
            sourceLabel.classList.add("text-green-700");

            sourceAsterisk.style.display = "none";

            sourceCheckboxes.forEach((checkbox) => {
                checkbox.classList.remove(
                    "bg-gray-100",
                    "border-gray-500",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
                checkbox.classList.add(
                    "bg-gray-50",
                    "border-blue-500",
                    "text-blue-900",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
            });
        } else {
            sourceLabel.classList.remove("text-green-700", "text-red-700");
            sourceLabel.classList.add("text-gray-800");

            sourceAsterisk.style.display = "block";

            sourceCheckboxes.forEach((checkbox) => {
                checkbox.classList.remove(
                    "bg-green-50",
                    "border-green-500",
                    "text-green-900",
                    "focus:ring-green-500",
                    "focus:border-green-500"
                );
                checkbox.classList.add(
                    "bg-gray-100",
                    "border-gray-500",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
            });
        }
    }

    function validateOtherSourceRemark() {
        const remarkValue = otherSourceRemark.value.trim();

        if (remarkValue) {
            sourceAsterisk.style.display = "none";
            otherSourceLabel.classList.remove("text-gray-800", "text-red-700");
            otherSourceLabel.classList.add("text-green-700");
            otherSourceRemark.classList.add("border-green-500", "bg-green-50");
            otherSourceRemark.classList.remove("border-red-500", "bg-red-50");
        } else {
            sourceAsterisk.style.display = "block";
            otherSourceLabel.classList.remove("text-green-700", "text-red-700");
            otherSourceLabel.classList.add("text-gray-800");
            otherSourceRemark.classList.remove(
                "border-red-500",
                "bg-red-50",
                "border-green-500",
                "bg-green-50"
            );
            otherSourceRemark.classList.add("border-gray-500", "bg-gray-100");
        }
    }

    pensionerOptions.forEach((option) => {
        option.addEventListener("change", validatePensioner);
    });
    ifPensionerDropdown.addEventListener("change", validateIfPensioner);
    sourceCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", validateSource);
    });
    otherSourceRemark.addEventListener("input", validateOtherSourceRemark);

    validatePensioner();
    validateIfPensioner();
    validateSource();
    validateOtherSourceRemark();

    const permanentSourceOptions =
        document.getElementsByName("permanent_source");
    const permanentSourceLabel = document.getElementById(
        "permanent_source_label"
    );
    const permanentSourceMessage = document.getElementById(
        "permanent_source_message"
    );

    const permanentSourceAsterisk = document.getElementById("permanent_source_asterisk");
    const permanentYesAsterisk = document.getElementById(
            "if_permanent_yes_asterisk"
        );
    const incomeSourceAsterisk = document.getElementById("income_source_asterisk");

    const ifPermanentIncomeCheckbox = document.getElementById(
        "if_permanent_yes_income"
    );
    const ifPermanentIncomeLabel = document.getElementById(
        "permanent_income_label"
    );

    const incomeSourceList = document.getElementById("income_source_list");


    const incomeSourceCheckbox = document.querySelectorAll(
        ".income-source-checkbox"
    );

    const incomeSourceLabel = document.getElementById("income_source_label");

    const otherIncomeSourceLabel = document.getElementById(
        "other_income_source_label"
    );
    const otherIncomeSourceRemark = document.getElementById(
        "other_income_source_remark"
    );

    // function resetPermanentSourceStyles() {
    //     otherIncomeSourceLabel.classList.remove(
    //         "text-green-700",
    //         "text-red-700"
    //     );
    //     otherIncomeSourceLabel.classList.add("text-gray-800");
    //     otherIncomeSourceRemark.classList.remove(
    //         "border-green-500",
    //         "bg-green-50",
    //         "border-red-500",
    //         "bg-red-50"
    //     );
    //     otherIncomeSourceRemark.classList.add("border-gray-300", "bg-gray-100");
    //     otherIncomeSourceRemark.value = "";
    //     permanentSourceMessage.textContent = "";
    //     permanentSourceMessage.classList.add("hidden");

    //     ifPermanentIncomeLabel.classList.remove(
    //         "text-green-700",
    //         "text-red-700"
    //     );
    //     ifPermanentIncomeLabel.classList.add("text-gray-800");
    //     ifPermanentIncomeCheckbox.classList.remove(
    //         "bg-green-50",
    //         "border-green-500",
    //         "text-green-900",
    //         "focus:ring-green-500",
    //         "focus:border-green-500"
    //     );
    //     ifPermanentIncomeCheckbox.classList.add(
    //         "bg-gray-100",
    //         "border-gray-500",
    //         "focus:ring-blue-500",
    //         "focus:border-blue-500"
    //     );

    //     incomeSourceLabel.classList.remove("text-green-700", "text-red-700");
    //     incomeSourceLabel.classList.add("text-gray-800");
    //     incomeSourceCheckbox.forEach((checkbox) => {
    //         checkbox.classList.remove(
    //             "bg-green-50",
    //             "border-green-500",
    //             "text-green-900",
    //             "focus:ring-green-500",
    //             "focus:border-green-500"
    //         );
    //         checkbox.classList.add(
    //             "bg-gray-100",
    //             "border-gray-500",
    //             "focus:ring-blue-500",
    //             "focus:border-blue-500"
    //         );
    //         checkbox.checked = false;
    //     });

    //     incomeSourceList.parentElement.classList.add("hidden");
    //     otherIncomeSourceRemark.parentElement.classList.add("hidden");
    // }

    function validatePermanentSource() {
        // resetPermanentSourceStyles(); 

        let selectedOption = null;
        permanentSourceOptions.forEach((option) => {
            const optionLabel = document.querySelector(
                `label[for="${option.id}"]`
            );

            if (option.checked) {
                permanentSourceAsterisk.style.display = "none";
                selectedOption = option.value;
                optionLabel.classList.add("text-green-700");
                optionLabel.classList.remove("text-gray-800", "text-red-700");
            } else {
                permanentSourceAsterisk.style.display = "block";
                optionLabel.classList.remove("text-green-700", "text-red-700");
                optionLabel.classList.add("text-gray-800");
            }
        });

        if (!selectedOption) {
            permanentSourceAsterisk.style.display = "block";
            permanentSourceLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            permanentSourceLabel.classList.add("text-gray-800");
            permanentSourceMessage.textContent = "";
            permanentSourceMessage.classList.add("hidden");
            return false;
        }

        if (selectedOption === "1") {
            permanentSourceAsterisk.style.display = "none";
            permanentSourceLabel.classList.remove("text-red-700");
            permanentSourceLabel.classList.add("text-green-700");
            permanentSourceMessage.textContent = "Looks good!";
            permanentSourceMessage.classList.remove("hidden", "text-red-500");
            permanentSourceMessage.classList.add("text-green-500");
            ifPermanentIncomeCheckbox.parentElement.classList.remove("hidden");
            incomeSourceList.parentElement.classList.remove("hidden");
            otherIncomeSourceRemark.parentElement.classList.remove("hidden");
        } else {
            permanentSourceAsterisk.style.display = "none";
            permanentSourceLabel.classList.remove("text-red-700");
            permanentSourceLabel.classList.add("text-green-700");
            permanentSourceMessage.textContent = "Looks good!";
            permanentSourceMessage.classList.remove("hidden", "text-red-500");
            permanentSourceMessage.classList.add("text-green-500");
            ifPermanentIncomeCheckbox.parentElement.classList.add("hidden");
            incomeSourceList.parentElement.classList.add("hidden");
            otherIncomeSourceRemark.parentElement.classList.add("hidden");
        }
    }

    function validateIfPermanentIncome() {
        const value = ifPermanentIncomeCheckbox.value;

        if (value) {
            permanentYesAsterisk.style.display = "none";
            ifPermanentIncomeLabel.classList.remove(
                "text-gray-800",
                "text-red-700"
            );
            ifPermanentIncomeLabel.classList.add("text-green-700");
            ifPermanentIncomeCheckbox.classList.remove(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
            ifPermanentIncomeCheckbox.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
        } else {
            permanentYesAsterisk.style.display = "block";
            ifPermanentIncomeLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            ifPermanentIncomeLabel.classList.add("text-gray-800");
            ifPermanentIncomeCheckbox.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            ifPermanentIncomeCheckbox.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );
        }
    }

    function validateIncomeSource() {
        let isChecked = false;

        incomeSourceCheckbox.forEach((checkbox) => {
            if (checkbox.checked) {
                isChecked = true;
            }
        });

        if (isChecked) {
            incomeSourceLabel.classList.remove("text-gray-800", "text-red-700");
            incomeSourceLabel.classList.add("text-green-700");

            incomeSourceAsterisk.style.display = "none";

            incomeSourceCheckbox.forEach((checkbox) => {
                checkbox.classList.remove(
                    "bg-gray-100",
                    "border-gray-500",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
                checkbox.classList.add(
                    "bg-gray-50",
                    "border-blue-500",
                    "text-blue-900",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
            });
        } else {
            incomeSourceLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            incomeSourceLabel.classList.add("text-gray-800");

            incomeSourceAsterisk.style.display = "block";

            incomeSourceCheckbox.forEach((checkbox) => {
                checkbox.classList.remove(
                    "bg-green-50",
                    "border-green-500",
                    "text-green-900",
                    "focus:ring-green-500",
                    "focus:border-green-500"
                );
                checkbox.classList.add(
                    "bg-gray-100",
                    "border-gray-500",
                    "focus:ring-blue-500",
                    "focus:border-blue-500"
                );
            });
        }
    }

    function validateOtherIncomeSourceRemark() {
        const remarkValue = otherIncomeSourceRemark.value.trim();

        if (remarkValue) {
            incomeSourceAsterisk.style.display = "none";
            otherIncomeSourceLabel.classList.remove(
                "text-gray-800",
                "text-red-700"
            );
            otherIncomeSourceLabel.classList.add("text-green-700");
            otherIncomeSourceRemark.classList.add(
                "border-green-500",
                "bg-green-50"
            );
            otherIncomeSourceRemark.classList.remove(
                "border-red-500",
                "bg-red-50"
            );
        } else {
            incomeSourceAsterisk.style.display = "block";
            otherIncomeSourceLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            otherIncomeSourceLabel.classList.add("text-gray-800");
            otherIncomeSourceRemark.classList.remove(
                "border-red-500",
                "bg-red-50",
                "border-green-500",
                "bg-green-50"
            );
            otherIncomeSourceRemark.classList.add(
                "border-gray-500",
                "bg-gray-100"
            );
        }
    }

    permanentSourceOptions.forEach((option) => {
        option.addEventListener("change", validatePermanentSource);
    });
    ifPermanentIncomeCheckbox.addEventListener(
        "change",
        validateIfPermanentIncome
    );
    incomeSourceCheckbox.forEach((checkbox) => {
        checkbox.addEventListener("change", validateIncomeSource);
    });
    otherIncomeSourceRemark.addEventListener(
        "input",
        validateOtherIncomeSourceRemark
    );

    validatePermanentSource();
    validateIfPermanentIncome();
    validateIncomeSource();
    validateOtherIncomeSourceRemark();

    const illnessLabel = document.getElementById("IllnessLabel");
    const illnessOptions = document.getElementsByName("has_illness");
    const illnessAsterisk = document.getElementById("illness_asterisk");
    const hasIllnessAsterisk = document.getElementById("has_illness_asterisk");
    const hasIllnessLabel = document.getElementById("illness_label");
    const ifIllnessYes = document.getElementById("if_illness_yes");
    const illnessMessage = document.getElementById("illnessMessage");

    function validateIllness() {
        let selectedOption = null;

        illnessOptions.forEach((option) => {
            const optionLabel = document.querySelector(
                `label[for="${option.id}"]`
            );

            if (option.checked) {
                illnessAsterisk.style.display = "none";
                selectedOption = option.value;
                optionLabel.classList.add("text-green-700");
                optionLabel.classList.remove("text-gray-800");
            } else {
                illnessAsterisk.style.display = "block";
                optionLabel.classList.remove("text-green-700");
                optionLabel.classList.add("text-gray-800");
            }
        });

        if (!selectedOption) {
            illnessAsterisk.style.display = "block";
            illnessLabel.classList.remove("text-green-700", "text-red-700");
            illnessLabel.classList.add("text-gray-800");
            illnessMessage.textContent = "";
            illnessMessage.classList.add("hidden");
            ifIllnessYes.classList.add("hidden");
            hasIllnessLabel.classList.add("hidden");
            return;
        }

        illnessLabel.classList.remove("text-gray-800", "text-red-700");
        illnessLabel.classList.add("text-green-700");
        illnessAsterisk.style.display = "none";

        if (selectedOption === "1") {
            illnessAsterisk.style.display = "none";
            hasIllnessLabel.classList.remove("hidden");
            ifIllnessYes.classList.remove("hidden");
            illnessMessage.textContent = "";
            illnessMessage.classList.add("hidden");
        } else {
            illnessAsterisk.style.display = "none";
            hasIllnessLabel.classList.add("hidden");
            ifIllnessYes.classList.add("hidden");
            illnessMessage.textContent = "Looks good!";
            illnessMessage.classList.remove("hidden", "text-red-500");
            illnessMessage.classList.add("text-green-500");
        }
    }

    function validateIllnessDetails() {
        const illnessDetails = ifIllnessYes.value.trim();

        if (illnessDetails) {
            hasIllnessAsterisk.style.display = "none";
            illnessMessage.textContent = "Looks good!";
            illnessMessage.classList.remove("hidden", "text-red-500");
            illnessMessage.classList.add("text-green-500");
            ifIllnessYes.classList.add("border-green-500", "bg-green-50");
            ifIllnessYes.classList.remove("border-gray-800", "bg-gray-100");
            hasIllnessLabel.classList.add("text-green-700");
            hasIllnessLabel.classList.remove("text-gray-800", "text-red-700");
        } else {
            hasIllnessAsterisk.style.display = "block";
            illnessMessage.textContent = "";
            illnessMessage.classList.add("hidden");
            ifIllnessYes.classList.remove("border-green-500", "bg-green-50");
            ifIllnessYes.classList.add("border-gray-800", "bg-gray-100");
            hasIllnessLabel.classList.remove("text-green-700");
            hasIllnessLabel.classList.add("text-gray-800");
        }
    }

    illnessOptions.forEach((option) => {
        option.addEventListener("change", validateIllness);
    });

    ifIllnessYes.addEventListener("input", validateIllnessDetails);

    validateIllness();
    validateIllnessDetails();

    const disabilityLabel = document.getElementById("DisabilityLabel");
    const disabilityOptions = document.getElementsByName("has_disability");
    const disabilityAsterisk = document.getElementById("disability_asterisk");
    const hasDisabilityAsterisk = document.getElementById("has_disability_asterisk");
    const hasDisabilityLabel = document.getElementById("disability_label");
    const ifDisabilityYes = document.getElementById("if_disability_yes");
    const disabilityMessage = document.getElementById("disabilityMessage");

    function validateDisability() {
        let selectedOption = null;

        disabilityOptions.forEach((option) => {
            const optionLabel = document.querySelector(
                `label[for="${option.id}"]`
            );

            if (option.checked) {
                disabilityAsterisk.style.display = "none";
                selectedOption = option.value;
                optionLabel.classList.add("text-green-700");
                optionLabel.classList.remove("text-gray-800");
            } else {
                disabilityAsterisk.style.display = "block";
                optionLabel.classList.remove("text-green-700");
                optionLabel.classList.add("text-gray-800");
            }
        });

        if (!selectedOption) {
            disabilityAsterisk.style.display = "block";
            disabilityLabel.classList.remove("text-green-700", "text-red-700");
            disabilityLabel.classList.add("text-gray-800");
            disabilityMessage.textContent = "";
            disabilityMessage.classList.add("hidden");
            ifDisabilityYes.classList.add("hidden");
            hasDisabilityLabel.classList.add("hidden");
            return;
        }

        disabilityLabel.classList.remove("text-gray-800", "text-red-700");
        disabilityLabel.classList.add("text-green-700");
        disabilityAsterisk.style.display = "none";

        if (selectedOption === "1") {
            disabilityAsterisk.style.display = "none";
            hasDisabilityLabel.classList.remove("hidden");
            ifDisabilityYes.classList.remove("hidden");
            disabilityMessage.textContent = "";
            disabilityMessage.classList.add("hidden");
        } else {
            disabilityAsterisk.style.display = "none";
            hasDisabilityLabel.classList.add("hidden");
            ifDisabilityYes.classList.add("hidden");
            disabilityMessage.textContent = "Looks good!";
            disabilityMessage.classList.remove("hidden", "text-red-500");
            disabilityMessage.classList.add("text-green-500");
        }
    }

    function validateDisabilityDetails() {
        const disabilityDetails = ifDisabilityYes.value.trim();

        if (disabilityDetails) {
            hasDisabilityAsterisk.style.display = "none";
            disabilityMessage.textContent = "Looks good!";
            disabilityMessage.classList.remove("hidden", "text-red-500");
            disabilityMessage.classList.add("text-green-500");
            ifDisabilityYes.classList.add("border-green-500", "bg-green-50");
            ifDisabilityYes.classList.remove("border-gray-800", "bg-gray-100");
            hasDisabilityLabel.classList.add("text-green-700");
            hasDisabilityLabel.classList.remove(
                "text-gray-800",
                "text-red-700"
            );
        } else {
            hasDisabilityAsterisk.style.display = "block";
            disabilityMessage.textContent = "";
            disabilityMessage.classList.add("hidden");
            ifDisabilityYes.classList.remove("border-green-500", "bg-green-50");
            ifDisabilityYes.classList.add("border-gray-800", "bg-gray-100");
            hasDisabilityLabel.classList.remove("text-green-700");
            hasDisabilityLabel.classList.add("text-gray-800");
        }
    }

    disabilityOptions.forEach((option) => {
        option.addEventListener("change", validateDisability);
    });

    ifDisabilityYes.addEventListener("input", validateDisabilityDetails);

    validateDisability();
    validateDisabilityDetails();

    const validIdLabel = document.getElementById("validIdLabel");
    const validIdInput = document.getElementById("valid_id_input");
    const validIdAsterisk = document.getElementById("valid_id_asterisk");
    const validIdPreview = document.getElementById("valid_id_preview");
    const validIdFilename = document.getElementById("valid_id_filename");
    const validIdMessage = document.getElementById("validIdMessage");

    validIdInput.addEventListener("change", function () {
        const file = this.files[0];
        const allowedTypes = ["image/jpeg", "image/png", "image/bmp", "image/tiff"];
        const maxSize = 4 * 1024 * 1024; 

        validIdPreview.style.display = "none";
        validIdFilename.textContent = "";
        validIdMessage.textContent = "";
        validIdMessage.classList.add("hidden");
        validIdLabel.classList.remove("text-red-700", "text-green-700");
        validIdLabel.classList.add("text-gray-800");
        validIdAsterisk.style.display = "block";
        validIdInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900"
        );
        validIdInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900"
        );

        if (file) {
            validIdFilename.textContent = `Selected File: ${file.name}`;

            if (!allowedTypes.includes(file.type)) {
                validIdAsterisk.style.display = "block";
                validIdMessage.textContent =
                    "Invalid file type. Accepted formats: JPEG, PNG, BMP, TIFF.";
                validIdMessage.classList.remove("hidden", "text-green-500");
                validIdMessage.classList.add("text-red-500");
                validIdLabel.classList.add("text-red-700");
                validIdInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            if (file.size > maxSize) {
                validIdAsterisk.style.display = "block";
                validIdMessage.textContent = "File size exceeds the 4MB limit.";
                validIdMessage.classList.remove("hidden", "text-green-500");
                validIdMessage.classList.add("text-red-500");
                validIdLabel.classList.add("text-red-700");
                validIdInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                validIdPreview.src = e.target.result;
                validIdPreview.style.display = "block";
            };
            reader.readAsDataURL(file);

            validIdAsterisk.style.display = "none";
            validIdMessage.textContent = "Looks good!";
            validIdMessage.classList.remove("hidden", "text-red-500");
            validIdMessage.classList.add("text-green-500");
            validIdLabel.classList.add("text-green-700");
            validIdInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900"
            );
        }
    });

    const profilePictureLabel = document.getElementById("profilePictureLabel");
    const profilePictureInput = document.getElementById("profilePictureField");
    const profilePicturePreview = document.getElementById(
        "profile_picture_preview"
    );
    const profilePictureFilename = document.getElementById(
        "profile_picture_filename"
    );
    const profilePictureMessage = document.getElementById(
        "profilePictureMessage"
    );

    profilePictureInput.addEventListener("change", function () {
        const file = this.files[0];
        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/bmp",
            "image/tiff",
        ];
        const maxSize = 4 * 1024 * 1024;

        profilePicturePreview.style.display = "none";
        profilePictureFilename.textContent = "";
        profilePictureMessage.textContent = "";
        profilePictureMessage.classList.add("hidden");
        profilePictureLabel.classList.remove("text-red-700", "text-green-700");
        profilePictureLabel.classList.add("text-gray-800");
        profilePictureInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900"
        );
        profilePictureInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900"
        );

        if (file) {
            profilePictureFilename.textContent = `Selected File: ${file.name}`;

            if (!allowedTypes.includes(file.type)) {
                profilePictureMessage.textContent =
                    "Invalid file type. Accepted formats: JPEG, PNG, BMP, TIFF.";
                profilePictureMessage.classList.remove(
                    "hidden",
                    "text-green-500"
                );
                profilePictureMessage.classList.add("text-red-500");
                profilePictureLabel.classList.add("text-red-700");
                profilePictureInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            if (file.size > maxSize) {
                profilePictureMessage.textContent =
                    "File size exceeds the 4MB limit.";
                profilePictureMessage.classList.remove(
                    "hidden",
                    "text-green-500"
                );
                profilePictureMessage.classList.add("text-red-500");
                profilePictureLabel.classList.add("text-red-700");
                profilePictureInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                profilePicturePreview.src = e.target.result;
                profilePicturePreview.style.display = "block";
            };
            reader.readAsDataURL(file);

            profilePictureMessage.textContent = "Looks good!";
            profilePictureMessage.classList.remove("hidden", "text-red-500");
            profilePictureMessage.classList.add("text-green-500");
            profilePictureLabel.classList.add("text-green-700");
            profilePictureInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900"
            );
        }
    });

    const indigencyLabel = document.getElementById("indigencyLabel");
    const indigencyInput = document.getElementById("indigency_input");
    const indigencyAsterisk = document.getElementById("indigency_asterisk");
    const indigencyPreview = document.getElementById("indigency_preview");
    const indigencyFilename = document.getElementById("indigency_filename");
    const indigencyMessage = document.getElementById("indigencyMessage");

    indigencyInput.addEventListener("change", function () {
        const file = this.files[0];
        const allowedTypes = ["image/jpeg", "image/png", "image/bmp", "image/tiff"];
        const maxSize = 4 * 1024 * 1024;

        indigencyPreview.style.display = "none";
        indigencyFilename.textContent = "";
        indigencyMessage.textContent = "";
        indigencyAsterisk.style.display = "block";
        indigencyMessage.classList.add("hidden");
        indigencyLabel.classList.remove("text-red-700", "text-green-700");
        indigencyLabel.classList.add("text-gray-800");
        indigencyInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900"
        );
        indigencyInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900"
        );

        if (file) {
            indigencyFilename.textContent = `Selected File: ${file.name}`;

            if (!allowedTypes.includes(file.type)) {
                indigencyAsterisk.style.display = "block";
                indigencyMessage.textContent =
                    "Invalid file type. Accepted formats: JPEG, PNG, BMP, TIFF.";
                indigencyMessage.classList.remove("hidden", "text-green-500");
                indigencyMessage.classList.add("text-red-500");
                indigencyLabel.classList.add("text-red-700");
                indigencyInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            if (file.size > maxSize) {
                indigencyAsterisk.style.display = "block";
                indigencyMessage.textContent = "File size exceeds the 4MB limit.";
                indigencyMessage.classList.remove("hidden", "text-green-500");
                indigencyMessage.classList.add("text-red-500");
                indigencyLabel.classList.add("text-red-700");
                indigencyInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                indigencyPreview.src = e.target.result;
                indigencyPreview.style.display = "block";
            };
            reader.readAsDataURL(file);

            indigencyAsterisk.style.display = "none";
            indigencyMessage.textContent = "Looks good!";
            indigencyMessage.classList.remove("hidden", "text-red-500");
            indigencyMessage.classList.add("text-green-500");
            indigencyLabel.classList.add("text-green-700");
            indigencyInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900"
            );
        }
    });

    const birthCertificateLabel = document.getElementById(
        "birthCertificateLabel"
    );
    const birthCertificateInput = document.getElementById(
        "birth_certificate_input"
    );
    const birthCertificateAsterisk = document.getElementById(
        "birth_certificate_asterisk"
    );
    const birthCertificatePreview = document.getElementById(
        "birth_certificate_preview"
    );
    const birthCertificateFilename = document.getElementById(
        "birth_certificate_filename"
    );
    const birthCertificateMessage = document.getElementById(
        "birthCertificateMessage"
    );

    birthCertificateInput.addEventListener("change", function () {
        const file = this.files[0];
        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/bmp",
            "image/tiff",
        ];
        const maxSize = 4 * 1024 * 1024;

        birthCertificatePreview.style.display = "none";
        birthCertificateFilename.textContent = "";
        birthCertificateMessage.textContent = "";
        birthCertificateMessage.classList.add("hidden");
        birthCertificateAsterisk.style.display = "block";
        birthCertificateLabel.classList.remove(
            "text-red-700",
            "text-green-700"
        );
        birthCertificateLabel.classList.add("text-gray-800");
        birthCertificateInput.classList.remove(
            "bg-red-50",
            "border-red-500",
            "text-red-900"
        );
        birthCertificateInput.classList.remove(
            "bg-green-50",
            "border-green-500",
            "text-green-900"
        );

        if (file) {
            birthCertificateFilename.textContent = `Selected File: ${file.name}`;

            if (!allowedTypes.includes(file.type)) {
                birthCertificateAsterisk.style.display = "block";
                birthCertificateMessage.textContent =
                    "Invalid file type. Accepted formats: JPEG, PNG, BMP, TIFF.";
                birthCertificateMessage.classList.remove(
                    "hidden",
                    "text-green-500"
                );
                birthCertificateMessage.classList.add("text-red-500");
                birthCertificateLabel.classList.add("text-red-700");
                birthCertificateInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            if (file.size > maxSize) {
                birthCertificateAsterisk.style.display = "block";
                birthCertificateMessage.textContent =
                    "File size exceeds the 4MB limit.";
                birthCertificateMessage.classList.remove(
                    "hidden",
                    "text-green-500"
                );
                birthCertificateMessage.classList.add("text-red-500");
                birthCertificateLabel.classList.add("text-red-700");
                birthCertificateInput.classList.add(
                    "bg-red-50",
                    "border-red-500",
                    "text-red-900"
                );
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                birthCertificatePreview.src = e.target.result;
                birthCertificatePreview.style.display = "block";
            };
            reader.readAsDataURL(file);

            birthCertificateAsterisk.style.display = "none";
            birthCertificateMessage.textContent = "Looks good!";
            birthCertificateMessage.classList.remove("hidden", "text-red-500");
            birthCertificateMessage.classList.add("text-green-500");
            birthCertificateLabel.classList.add("text-green-700");
            birthCertificateInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900"
            );
        }
    });

    const signatureLabel = document.getElementById("signatureLabel");
    const signatureInput = document.getElementById("signatureField");
    const signatureAsterisk = document.getElementById("signature_asterisk");
    const signaturePreview = document.getElementById("signature_preview");
    const signatureFilename = document.getElementById("signature_filename");
    const signatureMessage = document.getElementById("signatureMessage");

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


    const emailInput = document.getElementById("email_register");
    const emailLabel = document.getElementById("emailLabel");
    const emailAsterisk = document.getElementById("email_asterisk");
    const emailMessage = document.getElementById("emailMessage");

    function validateEmail() {
        const value = emailInput.value.trim();

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (value.length > 0 && emailPattern.test(value)) {
            emailLabel.classList.remove("text-red-700", "text-gray-800");
            emailLabel.classList.add("text-green-700");

            emailAsterisk.style.display = "none";

            emailInput.classList.remove(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            emailInput.classList.add(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );

            emailMessage.textContent = "Looks good!";
            emailMessage.classList.remove("text-red-500", "hidden");
            emailMessage.classList.add("text-green-500");

            fetch(`/validate-email?email=${value}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.exists) {
                        emailAsterisk.style.display = "block";
                        emailLabel.classList.add("text-red-700");
                        emailLabel.classList.remove(
                            "text-green-700",
                            "text-gray-800"
                        );
                        emailInput.classList.add(
                            "bg-red-50",
                            "border-red-500",
                            "text-red-900",
                            "placeholder-red-700",
                            "focus:ring-red-500",
                            "focus:border-red-500"
                        );
                        emailMessage.textContent =
                            "This email is already registered.";
                        emailMessage.classList.remove(
                            "text-green-500",
                            "hidden"
                        );
                        emailMessage.classList.add("text-red-500");
                    }
                })
                .catch((error) => {
                    console.error("Error validating email:", error);
                });
        } else if (value.length > 0) {
            emailAsterisk.style.display = "block";
            emailLabel.classList.remove("text-green-700", "text-gray-800");
            emailLabel.classList.add("text-red-700");

            emailInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500"
            );
            emailInput.classList.add(
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );

            emailMessage.textContent = "Please enter a valid email address.";
            emailMessage.classList.remove("text-green-500", "hidden");
            emailMessage.classList.add("text-red-500");
        }

        if (value === "") {
            emailAsterisk.style.display = "block";
            emailLabel.classList.remove("text-green-700", "text-red-700");
            emailLabel.classList.add("text-gray-800");

            emailInput.classList.remove(
                "bg-green-50",
                "border-green-500",
                "text-green-900",
                "placeholder-green-700",
                "focus:ring-green-500",
                "focus:border-green-500",
                "bg-red-50",
                "border-red-500",
                "text-red-900",
                "placeholder-red-700",
                "focus:ring-red-500",
                "focus:border-red-500"
            );
            emailInput.classList.add(
                "bg-gray-100",
                "border-gray-500",
                "focus:ring-blue-500",
                "focus:border-blue-500"
            );

            emailMessage.classList.add("hidden");
        }
    }

    emailInput.addEventListener("input", validateEmail);
    validateEmail();

    const passwordInput = document.getElementById("passwordField");
    const passwordLabel = document.getElementById("passwordLabel");
    const passwordAsterisk = document.getElementById("password_asterisk");
    const confirmPasswordAsterisk = document.getElementById("confirm_password_asterisk");

    const passwordConfirmationField = document.getElementById(
        "passwordConfirmationField"
    );
    const confirmPasswordLabel = document.getElementById(
        "confirmPasswordLabel"
    );
    const confirmPasswordMessage = document.getElementById(
        "confirmPasswordMessage"
    );

    function validatePassword() {
        const password = passwordInput.value.trim();
        const minLength = password.length >= 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasSymbol = /[@$!%*?&]/.test(password);

        if (password.length > 0) {
            passwordInput.classList.remove(
                "border-green-500",
                "border-red-500",
                "bg-green-50",
                "bg-red-50"
            );

            passwordAsterisk.style.display = "block";

            if (minLength && hasUpperCase && hasLowerCase && hasSymbol) {
                passwordAsterisk.style.display = "none";
                passwordInput.classList.add("border-green-500");
                passwordInput.classList.add("bg-green-50");
            } else {
                passwordAsterisk.style.display = "block";
                passwordInput.classList.add("border-red-500");
                passwordInput.classList.add("bg-red-50");
            }

            passwordLabel.classList.remove(
                "text-gray-800",
                "text-green-700",
                "text-red-700"
            );

            passwordLabel.classList.add(
                minLength && hasUpperCase && hasLowerCase && hasSymbol
                    ? "text-green-700"
                    : "text-red-700"
            );
        } else {
            passwordAsterisk.style.display = "block";
            passwordLabel.classList.remove("text-green-700", "text-red-700");
            passwordLabel.classList.add("text-gray-800");

            passwordInput.classList.remove(
                "border-green-500",
                "border-red-500",
                "bg-green-50",
                "bg-red-50"
            );
        }
    }

    passwordInput.addEventListener("input", validatePassword);

    validatePassword();

    function validateConfirmPassword() {
        const password = passwordInput.value.trim();
        const confirmPassword = passwordConfirmationField.value.trim();

        if (confirmPassword === password && confirmPassword.length > 0) {
            confirmPasswordAsterisk.style.display = "none";
            passwordConfirmationField.classList.remove(
                "border-red-500",
                "bg-red-50",
                "text-red-700"
            );
            passwordConfirmationField.classList.add(
                "border-green-500",
                "bg-green-50"
            );
            confirmPasswordLabel.classList.remove("text-red-700");
            confirmPasswordLabel.classList.add("text-green-700");
            confirmPasswordMessage.textContent = "Password matched.";
            confirmPasswordMessage.classList.remove("hidden");
            confirmPasswordMessage.classList.add("text-green-500");
            confirmPasswordMessage.classList.remove("text-red-500");
        } else if (confirmPassword.length > 0) {
            confirmPasswordAsterisk.style.display = "block";
            passwordConfirmationField.classList.remove(
                "border-green-500",
                "bg-green-50",
                "text-green-700"
            );
            passwordConfirmationField.classList.add(
                "border-red-500",
                "bg-red-50"
            );
            confirmPasswordLabel.classList.remove("text-green-700");
            confirmPasswordLabel.classList.add("text-red-700");
            confirmPasswordMessage.textContent = "Password doesn't match.";
            confirmPasswordMessage.classList.remove("hidden");
            confirmPasswordMessage.classList.add("text-red-500");
            confirmPasswordMessage.classList.remove("text-green-500");
        } else {
            confirmPasswordAsterisk.style.display = "block";
            passwordConfirmationField.classList.remove(
                "border-green-500",
                "border-red-500",
                "bg-green-50",
                "bg-red-50"
            );
            confirmPasswordLabel.classList.remove(
                "text-green-700",
                "text-red-700"
            );
            confirmPasswordMessage.classList.add("hidden");
        }
    }

    passwordConfirmationField.addEventListener(
        "input",
        validateConfirmPassword
    );

    validateConfirmPassword();

    const checkbox = document.getElementById("confirm-checkbox");
    const asterisk = document.getElementById("checkbox_asterisk");

    if (!checkbox || !asterisk) {
        console.warn("Checkbox or asterisk element not found.");
        return;
    }

    function updateAsteriskDisplay() {
        if (checkbox.checked) {
            asterisk.style.display = "none";
        } else {
            asterisk.style.display = "block";
        }
    }

    updateAsteriskDisplay();

    checkbox.addEventListener("change", updateAsteriskDisplay);
    
});

