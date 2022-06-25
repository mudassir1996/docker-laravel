var fv = FormValidation.formValidation(
    document.getElementById("add_commission_form"),
    {
        fields: {
            commission_title: {
                validators: {
                    notEmpty: {
                        message: "Title is required.",
                    },
                },
            },
            commission_value: {
                validators: {
                    notEmpty: {
                        message: "Value is required.",
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
            commission_type: {
                validators: {
                    notEmpty: {
                        message: "Type is required.",
                    },
                },
            },
            party_id: {
                validators: {
                    notEmpty: {
                        message: "Please select a party.",
                    },
                },
            },
            commission_status: {
                validators: {
                    notEmpty: {
                        message: "Status is required.",
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
var avatar2 = new KTImageInput("kt_image_2");
