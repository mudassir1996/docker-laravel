const notEmptyValidator = {
    validators: {
        notEmpty: {
            message: "required",
        },
    },
};
var fv = FormValidation.formValidation(
    document.getElementById("add_outlet_form"),
    {
        fields: {
            outlet_title: {
                validators: {
                    notEmpty: {
                        message: "Outlet title is required",
                    },
                },
            },

            outlet_phone: {
                validators: {
                    notEmpty: {
                        message: "Phone number is required",
                    },
                },
            },

            outlet_country: {
                validators: {
                    notEmpty: {
                        message: "Please select a country",
                    },
                },
            },
            outlet_state: {
                validators: {
                    notEmpty: {
                        message: "Please select a state",
                    },
                },
            },
            outlet_city: {
                validators: {
                    notEmpty: {
                        message: "Please select a city",
                    },
                },
            },
            business_type_id: {
                validators: {
                    notEmpty: {
                        message: "Please select a business type",
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
