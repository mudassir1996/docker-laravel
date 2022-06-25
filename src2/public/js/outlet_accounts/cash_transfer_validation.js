FormValidation.formValidation(document.getElementById("transferForm"), {
    fields: {
        amount: {
            validators: {
                notEmpty: {
                    message: "Amount is required.",
                },
                numeric: {
                    message: "The value is not a number",
                    decimalSeparator: ".",
                },
                greaterThan: {
                    message: "The value must be greater than or equal to 0",
                    min: 1,
                },
            },
        },
        account_from: {
            validators: {
                notEmpty: {
                    message: "Please select an account",
                },
            },
        },
        account_to: {
            validators: {
                notEmpty: {
                    message: "Please select an account",
                },
            },
        },
    },

    plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        // Bootstrap Framework Integration
        bootstrap: new FormValidation.plugins.Bootstrap({
            eleInvalidClass: "",
            eleValidClass: "",
        }),
        // Validate fields when clicking the Submit button
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
    },
});
