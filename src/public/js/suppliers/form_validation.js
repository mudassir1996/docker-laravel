FormValidation.formValidation(document.getElementById("add_supplier_form"), {
    fields: {
        supplier_title: {
            validators: {
                notEmpty: {
                    message: "Title is required",
                },
            },
        },

        supplier_email: {
            validators: {
                emailAddress: {
                    message: "Please enter valid email",
                },
            },
        },

        supplier_cnic: {
            validators: {
                digits: {
                    message: "Only numbers are allowed",
                },
            },
        },

        supplier_phone: {
            validators: {
                digits: {
                    message: "Please enter valid phone number",
                },
            },
        },
        // "company_id[]": {
        //     validators: {
        //         notEmpty: {
        //             message: "Please select company",
        //         },
        //     },
        // },
        // company_id: {
        //     validators: {
        //         notEmpty: {
        //             message: "Please select company",
        //         },
        //     },
        // },
        supplier_id: {
            validators: {
                notEmpty: {
                    message: "Please select supplier",
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
var mgtosSupplierFv = FormValidation.formValidation(
    document.getElementById("add_mgtos_supplier_form"),
    {
        fields: {
            supplier_phone: {
                validators: {
                    notEmpty: {
                        message: "Enter supplier phone number",
                    },
                },
            },
            supplier_public_key: {
                validators: {
                    notEmpty: {
                        message: "Enter supplier public key",
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
        },
    }
);
var avatar1 = new KTImageInput("kt_image_1");
