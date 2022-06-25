document.addEventListener("DOMContentLoaded", function (e) {
    const fv = FormValidation.formValidation(
        document.getElementById("add_campaign_form"),
        {
            fields: {
                campaign_title: {
                    validators: {
                        notEmpty: {
                            message: "Please enter campaign title",
                        },
                    },
                },
                status: {
                    validators: {
                        notEmpty: {
                            message: "Please select status",
                        },
                    },
                },
                sms_text: {
                    validators: {
                        notEmpty: {
                            message: "Please enter sms text",
                        },
                    },
                },
                schedule: {
                    validators: {
                        notEmpty: {
                            message: "Please set a schedule",
                        },
                    },
                },
                "recepients[]": {
                    validators: {
                        callback: {
                            message: "Enter atleast one recepient",
                            callback: function (input) {
                                dropDownValue = fv.getElements("recepients[]");
                                if (
                                    dropDownValue[0].value === "" &&
                                    document.getElementById("kt_tagify_1")
                                        .value === ""
                                ) {
                                    return false;
                                }
                                return true;
                            },
                        },
                    },
                },
                other_recepients: {
                    validators: {
                        regexp: {
                            regexp: /92\d{10}$/,
                            message: "Please enter correct phone number",
                        },
                    },
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                submitButton: new FormValidation.plugins.SubmitButton(),
                bootstrap: new FormValidation.plugins.Bootstrap({
                    eleInvalidClass: "",
                    eleValidClass: "",
                }),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            },
        }
    );
});
