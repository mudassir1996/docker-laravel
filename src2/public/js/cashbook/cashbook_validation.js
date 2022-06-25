FormValidation.formValidation(document.getElementById("cashbookForm"), {
    fields: {
        amount: {
            validators: {
                notEmpty: {
                    message: "Amount is required",
                },
            },
        },
        payment_method_id: {
            validators: {
                notEmpty: {
                    message: "Select payment method",
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
