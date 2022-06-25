FormValidation.formValidation(document.getElementById("add_employee_form"), {
    fields: {
        employee_name: {
            validators: {
                notEmpty: {
                    message: "Name is required",
                },
            },
        },

        employee_phone: {
            validators: {
                notEmpty: {
                    message: "Phone number is required",
                },
            },
        },

        employee_cnic: {
            validators: {
                digits: {
                    message: "Please enter valid cnic number",
                },
            },
        },

        employee_email: {
            validators: {
                emailAddress: {
                    message: "Please enter valid email",
                },
            },
        },
        email: {
            validators: {
                notEmpty: {
                    message: "Email is required",
                },
                emailAddress: {
                    message: "Please enter valid email",
                },
            },
        },
        phone: {
            validators: {
                notEmpty: {
                    message: "Phone number is required",
                },
                regexp: {
                    regexp: /^(\0|92)[0-9]{10}$/i,
                    message: "Please enter valid phone number.",
                },
            },
        },
        password: {
            validators: {
                notEmpty: {
                    message: "Password is required",
                },
            },
        },

        employee_id: {
            validators: {
                notEmpty: {
                    message: "Please select Employee",
                },
            },
        },
        "role_id[]": {
            validators: {
                notEmpty: {
                    message: "Please select a Role",
                },
            },
        },
        employee_gender: {
            validators: {
                notEmpty: {
                    message: "Please select gender",
                },
            },
        },
        salary_type_id: {
            validators: {
                callback: {
                    message: "Please select salary type.",
                    callback: function (value, validator, $field) {
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            value.value == ""
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return false;
                        }
                        return true;
                    },
                },
            },
        },
        salary_amount: {
            validators: {
                callback: {
                    callback: function (value, validator, $field) {
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            value.value == ""
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return {
                                valid: false,
                                message: "Please enter salary amount.",
                            };
                        }
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            isNaN(value.value)
                        ) {
                            return {
                                valid: false,
                                message: "Please enter a number",
                            };
                        }
                        return true;
                    },
                },
            },
        },
        working_hours_per_day: {
            validators: {
                callback: {
                    callback: function (value, validator, $field) {
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            value.value == ""
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return {
                                valid: false,
                                message: "Please enter working hours.",
                            };
                        }
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            isNaN(value.value)
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return {
                                valid: false,
                                message: "Please enter a number",
                            };
                        }
                        return true;
                    },
                },
            },
        },
        joining_date: {
            validators: {
                callback: {
                    callback: function (value, validator, $field) {
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            value.value == ""
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return {
                                valid: false,
                                message: "Please select joining date.",
                            };
                        }
                        return true;
                    },
                },
            },
        },
        starting_date: {
            validators: {
                callback: {
                    callback: function (value, validator, $field) {
                        if (
                            document.getElementById("have_salary").value == 1 &&
                            value.value == ""
                        ) {
                            $("input[name=" + value.field + "]").focus();
                            return {
                                valid: false,
                                message: "Please select starting date.",
                            };
                        }
                        return true;
                    },
                },
            },
        },
        employee_username: {
            validators: {
                notEmpty: {
                    message: "This field is required",
                },
            },
        },

        // salary_amount: {
        //   validators: {
        //     callback: {
        //         message: 'Please enter a number.',
        //         callback: function(value, validator, $field) {
        //             if(document.getElementById('have_salary').value==1 && isNaN(value.value)){
        //               return false;
        //             }
        //             return true;
        //         }
        //     },
        //   }
        // },
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
var avatar2 = new KTImageInput("kt_image_2");
