FormValidation.formValidation(
    document.getElementById("outlet_transaction_form"),
    {
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
            payment_status: {
                validators: {
                    notEmpty: {
                        message: "Please select payment status",
                    },
                },
            },
            order_id: {
                validators: {
                    digits: {
                        message: "Please enter number only",
                    },
                },
            },
            payment_date: {
                validators: {
                    notEmpty: {
                        message: "Please select payment date",
                    },
                },
            },
            transaction_type: {
                validators: {
                    notEmpty: {
                        message: "Please select payment type",
                    },
                },
            },

            payment_method_id: {
                validators: {
                    notEmpty: {
                        message: "Please select payment method",
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
    }
);
