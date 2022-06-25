/******/ (function (modules) {
    // webpackBootstrap
    /******/ // The module cache
    /******/ var installedModules = {};
    /******/
    /******/ // The require function
    /******/ function __webpack_require__(moduleId) {
        /******/
        /******/ // Check if module is in cache
        /******/ if (installedModules[moduleId]) {
            /******/ return installedModules[moduleId].exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/ var module = (installedModules[moduleId] = {
            /******/ i: moduleId,
            /******/ l: false,
            /******/ exports: {},
            /******/
        });
        /******/
        /******/ // Execute the module function
        /******/ modules[moduleId].call(
            module.exports,
            module,
            module.exports,
            __webpack_require__
        );
        /******/
        /******/ // Flag the module as loaded
        /******/ module.l = true;
        /******/
        /******/ // Return the exports of the module
        /******/ return module.exports;
        /******/
    }
    /******/
    /******/
    /******/ // expose the modules object (__webpack_modules__)
    /******/ __webpack_require__.m = modules;
    /******/
    /******/ // expose the module cache
    /******/ __webpack_require__.c = installedModules;
    /******/
    /******/ // define getter function for harmony exports
    /******/ __webpack_require__.d = function (exports, name, getter) {
        /******/ if (!__webpack_require__.o(exports, name)) {
            /******/ Object.defineProperty(exports, name, {
                enumerable: true,
                get: getter,
            });
            /******/
        }
        /******/
    };
    /******/
    /******/ // define __esModule on exports
    /******/ __webpack_require__.r = function (exports) {
        /******/ if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
            /******/ Object.defineProperty(exports, Symbol.toStringTag, {
                value: "Module",
            });
            /******/
        }
        /******/ Object.defineProperty(exports, "__esModule", { value: true });
        /******/
    };
    /******/
    /******/ // create a fake namespace object
    /******/ // mode & 1: value is a module id, require it
    /******/ // mode & 2: merge all properties of value into the ns
    /******/ // mode & 4: return value when already ns object
    /******/ // mode & 8|1: behave like require
    /******/ __webpack_require__.t = function (value, mode) {
        /******/ if (mode & 1) value = __webpack_require__(value);
        /******/ if (mode & 8) return value;
        /******/ if (
            mode & 4 &&
            typeof value === "object" &&
            value &&
            value.__esModule
        )
            return value;
        /******/ var ns = Object.create(null);
        /******/ __webpack_require__.r(ns);
        /******/ Object.defineProperty(ns, "default", {
            enumerable: true,
            value: value,
        });
        /******/ if (mode & 2 && typeof value != "string")
            for (var key in value)
                __webpack_require__.d(
                    ns,
                    key,
                    function (key) {
                        return value[key];
                    }.bind(null, key)
                );
        /******/ return ns;
        /******/
    };
    /******/
    /******/ // getDefaultExport function for compatibility with non-harmony modules
    /******/ __webpack_require__.n = function (module) {
        /******/ var getter =
            module && module.__esModule
                ? /******/ function getDefault() {
                      return module["default"];
                  }
                : /******/ function getModuleExports() {
                      return module;
                  };
        /******/ __webpack_require__.d(getter, "a", getter);
        /******/ return getter;
        /******/
    };
    /******/
    /******/ // Object.prototype.hasOwnProperty.call
    /******/ __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ // __webpack_public_path__
    /******/ __webpack_require__.p = "/";
    /******/
    /******/
    /******/ // Load entry module and return exports
    /******/ return __webpack_require__((__webpack_require__.s = 114));
    /******/
})(
    /************************************************************************/
    /******/ {
        /***/ "./resources/metronic/js/pages/custom/wizard/wizard-2.js":
            /*!***************************************************************!*\
  !*** ./resources/metronic/js/pages/custom/wizard/wizard-2.js ***!
  \***************************************************************/
            /*! no static exports found */
            /***/ function (module, exports, __webpack_require__) {
                "use strict";
                // Class definition

                var KTWizard2 = (function () {
                    // Base elements
                    var _wizardEl;
                    // var element = KTUtil.getById("kt_wizard_v2");
                    var _formEl;

                    var _wizard;

                    var _validations = []; // Private functions

                    var initWizard = function initWizard() {
                        // Initialize form wizard
                        _wizard = new KTWizard(_wizardEl, {
                            startStep: 1,
                            // initial active step number
                            clickableSteps: true, // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
                        }); // Validation before going to next page
                        // _wizard.btnSkip = KTUtil.find(
                        //     element,
                        //     '[data-wizard-type="action-skip"]'
                        // );
                        // if (_wizard.isFirstStep()) {
                        //     $(_wizard.btnSkip).hide();
                        // }

                        // KTUtil.addEvent(_wizard.btnSkip, "click", function (e) {
                        //     e.preventDefault();
                        //     _wizard.goNext();
                        //     if (_wizard.isLastStep() || _wizard.isFirstStep()) {
                        //         $(_wizard.btnSkip).hide();
                        //     } else {
                        //         $(_wizard.btnSkip).show();
                        //     }
                        // });
                        // KTUtil.addEvent(_wizard.btnPrev, "click", function (e) {
                        //     e.preventDefault();

                        //     if (_wizard.isLastStep() || _wizard.isFirstStep()) {
                        //         $(_wizard.btnSkip).hide();
                        //     } else {
                        //         $(_wizard.btnSkip).show();
                        //     }
                        // });
                        KTUtil.addEvent(
                            _wizard.btnSubmit,
                            "click",
                            function (e) {
                                e.preventDefault();
                                if (
                                    $("#subscription_payment_method").val() ==
                                        "" &&
                                    $(
                                        "input[name='subscription_plan']:checked"
                                    ).val() != "free"
                                ) {
                                    Swal.fire({
                                        text: "Please select a payment method.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton:
                                                "btn font-weight-bold btn-light",
                                        },
                                    }).then(function () {
                                        $("#subscription-modal").modal("show");
                                    });
                                } else {
                                    _formEl.submit();
                                }
                            }
                        );
                        _wizard.on("beforeNext", function (wizard) {
                            if (_wizard.getStep() == 0) {
                                $(_wizard.btnSkip).hide();
                            } else {
                                $(_wizard.btnSkip).show();
                            }
                            var outlet_title = $("#outlet_title").val();
                            var outlet_phone = $("#outlet_phone").val();

                            $("#outlet_title").val(outlet_title.trim());
                            $("#outlet_phone").val(outlet_phone.trim());
                            // Don't go to the next step yet
                            _wizard.stop(); // Validate form

                            var validator = _validations[0]; // get validator for currnt step
                            const notEmptyValidator = {
                                validators: {
                                    notEmpty: {
                                        message: "required",
                                    },
                                },
                            };
                            if ($("#is_supplier").prop("checked")) {
                                validator.enableValidator("public_key");
                            } else {
                                validator.disableValidator("public_key");
                            }
                            validator.validate().then(function (status) {
                                if (status == "Valid") {
                                    _wizard.goNext();
                                    KTUtil.scrollTop();
                                } else {
                                    $(".outlet-form").scrollTop(0);
                                    // _wizard.goNext();
                                }
                            });
                        }); // Change event

                        _wizard.on("change", function (wizard) {
                            // console.log("test last: " + _wizard.isLastStep());
                            // if (_wizard.isLastStep() || _wizard.isFirstStep()) {
                            //     $(_wizard.btnSkip).hide();
                            // } else {
                            //     $(_wizard.btnSkip).show();
                            // }
                            KTUtil.scrollTop();
                        });
                    };

                    // KTUtil.addEvent(initWizard._wizard, "click", function (e) {
                    //     e.preventDefault();
                    //     console.log($(this));
                    // });
                    var initValidation = function initValidation() {
                        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                        // Step 1
                        _validations.push(
                            FormValidation.formValidation(_formEl, {
                                fields: {
                                    outlet_title: {
                                        validators: {
                                            notEmpty: {
                                                message: "Title is required",
                                            },
                                        },
                                    },
                                    outlet_phone: {
                                        validators: {
                                            notEmpty: {
                                                message: "Phone is required",
                                            },
                                        },
                                    },
                                    outlet_country: {
                                        validators: {
                                            notEmpty: {
                                                message:
                                                    "Please select a country",
                                            },
                                        },
                                    },
                                    outlet_state: {
                                        validators: {
                                            notEmpty: {
                                                message:
                                                    "Please select a state",
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
                                                message:
                                                    "Please select a business type",
                                            },
                                        },
                                    },
                                    public_key: {
                                        validators: {
                                            notEmpty: {
                                                enabled: false,
                                                message: "required",
                                            },
                                        },
                                    },
                                },
                                plugins: {
                                    trigger:
                                        new FormValidation.plugins.Trigger(),
                                    bootstrap:
                                        new FormValidation.plugins.Bootstrap({
                                            eleInvalidClass: "",
                                            eleValidClass: "",
                                        }),
                                },
                            })
                        ); // Step 2

                        // _validations.push(
                        //     FormValidation.formValidation(_formEl, {
                        //         fields: {},
                        //         plugins: {
                        //             trigger:
                        //                 new FormValidation.plugins.Trigger(),
                        //             bootstrap:
                        //                 new FormValidation.plugins.Bootstrap(),
                        //         },
                        //     })
                        // ); // Step 3

                        // _validations.push(
                        //     FormValidation.formValidation(_formEl, {
                        //         fields: {},
                        //         plugins: {
                        //             trigger:
                        //                 new FormValidation.plugins.Trigger(),
                        //             bootstrap:
                        //                 new FormValidation.plugins.Bootstrap(),
                        //         },
                        //     })
                        // ); // Step 4

                        // _validations.push(
                        //     FormValidation.formValidation(_formEl, {
                        //         fields: {
                        //             subscription_plan: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card name is required",
                        //                     },
                        //                 },
                        //             },
                        //         },
                        //         plugins: {
                        //             trigger:
                        //                 new FormValidation.plugins.Trigger(),
                        //             bootstrap:
                        //                 new FormValidation.plugins.Bootstrap(),
                        //         },
                        //     })
                        // ); // Step 5

                        // _validations.push(
                        //     FormValidation.formValidation(_formEl, {
                        //         fields: {
                        //             ccname: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card name is required",
                        //                     },
                        //                 },
                        //             },
                        //             ccnumber: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card number is required",
                        //                     },
                        //                     creditCard: {
                        //                         message:
                        //                             "The credit card number is not valid",
                        //                     },
                        //                 },
                        //             },
                        //             ccmonth: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card month is required",
                        //                     },
                        //                 },
                        //             },
                        //             ccyear: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card year is required",
                        //                     },
                        //                 },
                        //             },
                        //             cccvv: {
                        //                 validators: {
                        //                     notEmpty: {
                        //                         message:
                        //                             "Credit card CVV is required",
                        //                     },
                        //                     digits: {
                        //                         message:
                        //                             "The CVV value is not valid. Only numbers is allowed",
                        //                     },
                        //                 },
                        //             },
                        //         },
                        //         plugins: {
                        //             trigger:
                        //                 new FormValidation.plugins.Trigger(),
                        //             bootstrap:
                        //                 new FormValidation.plugins.Bootstrap(),
                        //         },
                        //     })
                        // );
                    };

                    return {
                        // public functions

                        init: function init() {
                            _wizardEl = KTUtil.getById("kt_wizard_v2");
                            _formEl = KTUtil.getById("kt_form");
                            initWizard();
                            initValidation();
                        },
                    };
                })();

                jQuery(document).ready(function () {
                    KTWizard2.init();
                    // $(".skip").click(function () {
                    //     KTWizard2.skipStep();
                    // });
                });

                /***/
            },

        /***/ 114:
            /*!*********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/wizard/wizard-2.js ***!
  \*********************************************************************/
            /*! no static exports found */
            /***/ function (module, exports, __webpack_require__) {
                module.exports = __webpack_require__(
                    /*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\custom\wizard\wizard-2.js */ "./resources/metronic/js/pages/custom/wizard/wizard-2.js"
                );

                /***/
            },

        /******/
    }
);
