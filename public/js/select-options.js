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

// Selections:
const typeSelect = document.getElementById('type');
const makeSelect = document.getElementById('make');
const modelSelect = document.getElementById('model');
const colorSelect = document.getElementById('color');

// Event listeners for type, make, and model changes
typeSelect.addEventListener('change', updateMakeOptions);
makeSelect.addEventListener('change', updateModelOptions);
modelSelect.addEventListener('change', updateColorOptions);

function updateMakeOptions() {
    const selectedType = typeSelect.value;

    // Filter makes based on the selected type
    for (let i = 0; i < makeSelect.options.length; i++) {
        const option = makeSelect.options[i];
        const optionType = option.getAttribute('data-type');

        if (optionType === selectedType || selectedType === '') {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }

    // Reset the make and model selections
    makeSelect.selectedIndex = 0;
    updateModelOptions();
}

function updateModelOptions() {
    const selectedType = typeSelect.value;
    const selectedMake = makeSelect.value;

    // Filter models based on the selected type and make
    for (let i = 0; i < modelSelect.options.length; i++) {
        const option = modelSelect.options[i];
        const optionMake = option.getAttribute('data-make');
        const optionType = option.getAttribute('data-type');

        if ((optionMake === selectedMake || selectedMake === '') &&
            (optionType === selectedType || selectedType === '')) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }

    // Reset the model and color selections
    modelSelect.selectedIndex = 0;
    updateColorOptions();
}

function updateColorOptions() {
    const selectedType = typeSelect.value;
    const selectedMake = makeSelect.value;
    const selectedModel = modelSelect.value;

    // Filter colors based on the selected type, make, and model
    for (let i = 0; i < colorSelect.options.length; i++) {
        const option = colorSelect.options[i];
        const optionMake = option.getAttribute('data-make');
        const optionType = option.getAttribute('data-type');
        const optionModel = option.getAttribute('data-model');

        if ((optionMake === selectedMake || selectedMake === '') &&
            (optionType === selectedType || selectedType === '') &&
            (optionModel === selectedModel || selectedModel === '')) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }

    // Reset the color selection
    colorSelect.selectedIndex = 0;
}




