document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        maxDate: new Date(),
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

        window.addEventListener('resize', resizeCanvas);
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
            var sigText = document.getElementById("sig-dataUrl");
            var sigImage = document.getElementById("sig-image");
            sigText.value = dataUrl;
            sigImage.setAttribute("src", dataUrl);
            localStorage.setItem("signature", dataUrl);

            var submitBtn = document.getElementById("submit");
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
                "signaturevalidation"
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
                submitBtn.disabled = false;
            },
            false
        );

        form.addEventListener("submit", function (e) {
            saveSignature();
            if (!validateSignature()) {
                e.preventDefault();
            }
        });

        loadSignature();
    })();

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

    document.addEventListener("DOMContentLoaded", updateFullName);

});
