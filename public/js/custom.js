document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datepicker", {
        dateFormat: "d-m-y",
        maxDate: new Date(),
    });
});