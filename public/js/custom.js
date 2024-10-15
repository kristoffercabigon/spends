document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datepicker", {
        dateFormat: "d-m-Y", // Date format
        maxDate: new Date(), // Restrict future dates
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
                // Set the calculated age in the age input field
                document.getElementById("age").value = age;
            }
        },
    });
});
