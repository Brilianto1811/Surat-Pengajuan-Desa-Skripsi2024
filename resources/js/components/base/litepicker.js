(function () {
    "use strict";

    // Function to calculate age from date of birth
    function calculateAge(dob) {
        const birthDate = dayjs(dob);
        const today = dayjs();
        let age = today.year() - birthDate.year();
        const monthDiff = today.month() - birthDate.month();
        if (monthDiff < 0 || (monthDiff === 0 && today.date() < birthDate.date())) {
            age--;
        }
        return age;
    }

    // Litepicker
    $(".datepicker").each(function () {
        let options = {
            autoApply: false,
            singleMode: false,
            numberOfColumns: 2,
            numberOfMonths: 2,
            showWeekNumbers: true,
            format: "D MMM, YYYY",
            dropdowns: {
                minYear: 1990,
                maxYear: null,
                months: true,
                years: true,
            },
        };

        if ($(this).data("single-mode")) {
            options.singleMode = true;
            options.numberOfColumns = 1;
            options.numberOfMonths = 1;
        }

        if ($(this).data("format")) {
            options.format = $(this).data("format");
        }

        if (!$(this).val()) {
            let date = dayjs().format(options.format);
            date += !options.singleMode
                ? " - " + dayjs().add(1, "month").format(options.format)
                : "";
            $(this).val(date);
        }

        const picker = new Litepicker({
            element: this,
            ...options,
            setup: (picker) => {
                picker.on('selected', (date1) => {
                    const formattedDate = date1.format(options.format);
                    $(this).val(formattedDate);

                    // Calculate age if the element has data attribute 'data-calculate-age'
                    if ($(this).data("calculate-age")) {
                        const age = calculateAge(formattedDate);
                        $('#umur').val(age);
                    }
                });
            }
        });
    });
})();
