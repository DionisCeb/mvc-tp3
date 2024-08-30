function disablePastDates() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('check-in-date').setAttribute('min', today);
}

function updateCheckOutMinDate() {
    const checkInDateValue = document.getElementById('check-in-date').value;
    const checkOutDateInput = document.getElementById('check-out-date');

    if (checkInDateValue) {
        checkOutDateInput.setAttribute('min', checkInDateValue);
    } else {
        checkOutDateInput.removeAttribute('min');
    }
}

function initializeDatePickers() {
    const checkInDateValue = document.getElementById('check-in-date').value;
    if (checkInDateValue) {
        document.getElementById('check-out-date').setAttribute('min', checkInDateValue);
    }
}

document.getElementById('check-in-date').addEventListener('focus', disablePastDates);
document.getElementById('check-in-date').addEventListener('change', updateCheckOutMinDate);
document.addEventListener('DOMContentLoaded', initializeDatePickers);

document.addEventListener('DOMContentLoaded', function () {

    


    // Function to get unique options from a select element
    function getUniqueOptions(selectElement) {
        const options = selectElement.options;
        const uniqueOptions = [];

        // Loop through options and store unique values
        for (let i = 1; i < options.length; i++) { // Skip the default option at index 0
            const value = options[i].value;
            const text = options[i].text;

            // Check if the value is already in the uniqueOptions array
            let isUnique = true;
            uniqueOptions.forEach(option => {
                if (option.value === value) {
                    isUnique = false;
                }
            });

            // Add new unique option
            if (isUnique) {
                uniqueOptions.push({ value: value, text: text });
            }
        }

        return uniqueOptions;
    }

    // Function to update a select element with unique options
    function updateSelectOptions(selectElement, uniqueOptions) {
        // Clear existing options except for the default option
        while (selectElement.options.length > 1) {
            selectElement.remove(1);
        }

        // Add unique options
        uniqueOptions.forEach(option => {
            const newOption = new Option(option.text, option.value);
            selectElement.add(newOption);
        });
    }

    // Get the select elements
    const typeSelect = document.getElementById('type');
    const makeSelect = document.getElementById('make');
    const modelSelect = document.getElementById('model');
    const colorSelect = document.getElementById('color');

    // Get unique options for each select element
    const uniqueTypeOptions = getUniqueOptions(typeSelect);
    const uniqueMakeOptions = getUniqueOptions(makeSelect);
    const uniqueModelOptions = getUniqueOptions(modelSelect);
    const uniqueColorOptions = getUniqueOptions(colorSelect);

    // Update select elements with unique options
    updateSelectOptions(typeSelect, uniqueTypeOptions);
    updateSelectOptions(makeSelect, uniqueMakeOptions);
    updateSelectOptions(modelSelect, uniqueModelOptions);
    updateSelectOptions(colorSelect, uniqueColorOptions);
});



document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.form-reservation');
    const submitButton = document.querySelector('input[type="submit"]');

    // Define the fields to be validated
    const fields = [
        document.getElementById('check-in-date'),
        document.getElementById('check-in-time'),
        document.getElementById('check-out-date'),
        document.getElementById('check-out-time'),
        document.getElementById('type'),
        document.getElementById('make'),
        document.getElementById('model'),
        document.getElementById('color'),
    ];
    

    

    function validateForm() {
        let previousFieldHasValue = true;
        

        // Iterate through fields and enable/disable based on previous field's value
        fields.forEach((field, index) => {
            if (index === 0) {
                // Always enable the first field
                field.disabled = false;
            } else {
                // Disable the current field if the previous field is empty
                field.disabled = !previousFieldHasValue;
            }

            // Update the status of the previous field
            previousFieldHasValue = field.value.trim() !== '';
        });

        // Enable or disable submit button based on form validity
        const allFieldsFilled = fields.every(field => field.value.trim() !== '');
        if (allFieldsFilled) {
            submitButton.disabled = false;
            submitButton.classList.remove('disabled-btn');
        } else {
            submitButton.disabled = true;
            submitButton.classList.add('disabled-btn');
        }
    }

    // Attach event listeners to all fields
    fields.forEach(field => {
        field.addEventListener('input', validateForm);
    });

    // Initial validation on page load
    validateForm();
});
