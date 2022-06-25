const notEmptyValidator = {
    validators: {
        notEmpty: {
            message: "required",
        },
    },
};
const dateTimeValidator = {
    validators: {
        notEmpty: {
            message: "required",
        },
        date: {
            format: "DD-MM-YYYY",
            message: "Invalid date",
        },
    },
};

var fv = FormValidation.formValidation(document.getElementById("orderForm"), {
    fields: {
        category_id: {
            validators: {
                notEmpty: {
                    message: "Category is required",
                },
            },
        },
        status: {
            validators: {
                notEmpty: {
                    message: "Status is required",
                },
            },
        },
        customer_party_id: {
            validators: {
                notEmpty: {
                    message: "Client is required",
                },
            },
        },
        supplier_party_id: {
            validators: {
                notEmpty: {
                    message: "Agent is required",
                },
            },
        },
        pax_name: notEmptyValidator,
        departure_date: dateTimeValidator,
        class: notEmptyValidator,
        ticket_number: notEmptyValidator,
        flight_number: notEmptyValidator,
        sector: notEmptyValidator,
        pnr: notEmptyValidator,
        gds_pnr: notEmptyValidator,
        base_price: notEmptyValidator,
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
    },
});

// fv.addField("[0][pax_name]", paxNameValidator);
