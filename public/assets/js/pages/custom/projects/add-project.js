"use strict";

// Class definition for project addition wizard
var KTProjectsAdd = function () {
    // Base elements
    var _wizardEl; // Wizard container element
    var _formEl; // Form element
    var _wizardObj; // KTWizard instance
    var _validations = []; // Array of FormValidation instances for each step

    // Private functions
    /**
     * Initialize the wizard for step-by-step form navigation
     */
    var _initWizard = function () {
        // Initialize form wizard
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1, // Initial active step number
            clickableSteps: false // Prevent clicking on steps to navigate
        });

        // Handle validation before moving to the next step
        _wizardObj.on('change', function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip validation if stepping back
            }

            // Validate the current step's form fields
            var validator = _validations[wizard.getStep() - 1];
            if (validator) {
                validator.validate().then(function (status) {
                    if (status === 'Valid') {
                        wizard.goTo(wizard.getNewStep());
                        KTUtil.scrollTop();
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error", // Updated from 'type' to 'icon'
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light"
                            }
                        }).then(function () {
                            KTUtil.scrollTop();
                        });
                    }
                });
            }

            return false; // Prevent default step change, handled by validator
        });

        // Handle step change event
        _wizardObj.on('changed', function (wizard) {
            KTUtil.scrollTop();
        });

        // Handle form submission
        _wizardObj.on('submit', function (wizard) {
            Swal.fire({
                text: "All is good! Please confirm the form submission.",
                icon: "success", // Updated from 'type' to 'icon'
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, submit!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-default"
                }
            }).then(function (result) {
                if (result.isConfirmed) { // Updated to use 'isConfirmed' for clarity
                    _formEl.submit(); // Submit the form
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been submitted!",
                        icon: "error", // Updated from 'type' to 'icon'
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-primary"
                        }
                    });
                }
            });
        });
    };

    /**
     * Initialize form validation for each wizard step
     */
    var _initValidation = function () {
        // Step 1: Validate project details
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    projectname: {
                        validators: {
                            notEmpty: {
                                message: 'Project name is required'
                            }
                        }
                    },
                    projectowner: {
                        validators: {
                            notEmpty: {
                                message: 'Project owner is required'
                            }
                        }
                    },
                    customername: {
                        validators: {
                            notEmpty: {
                                message: 'Customer name is required'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'Phone is required'
                            },
                            phone: {
                                country: 'US',
                                message: 'The value is not a valid US phone number. (e.g 5554443333)'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    companywebsite: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        eleValidClass: ''
                    })
                }
            }
        ));

        // Step 2: Validate communication preferences
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    communication: {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Please select at least 1 option'
                            }
                        }
                    },
                    language: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a language'
                            }
                        }
                    },
                    timezone: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a timezone'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        eleValidClass: ''
                    })
                }
            }
        ));

        // Step 3: Validate address details
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    address1: {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            }
                        }
                    },
                    postcode: {
                        validators: {
                            notEmpty: {
                                message: 'Postcode is required'
                            }
                        }
                    },
                    city: {
                        validators: {
                            notEmpty: {
                                message: 'City is required'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'State is required'
                            }
                        }
                    },
                    country: {
                        validators: {
                            notEmpty: {
                                message: 'Country is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        eleValidClass: ''
                    })
                }
            }
        ));
    };

    return {
        /**
         * Public method to initialize the wizard and validation
         */
        init: function () {
            _wizardEl = KTUtil.getById('kt_projects_add');
            _formEl = KTUtil.getById('kt_projects_add_form');

            _initWizard();
            _initValidation();
        }
    };
}();

// Initialize the wizard when the document is ready
jQuery(document).ready(function () {
    KTProjectsAdd.init();
});