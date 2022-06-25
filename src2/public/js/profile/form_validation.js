FormValidation.formValidation(
 document.getElementById('edit_profile_form'),
 {
  fields: {
   outlet_title: {
    validators: {
     notEmpty: {
      message: 'Title is required'
     }
    }
   },

   phone: {
    validators: {
     digits: {
      message: 'Please enter valid phone number'
     }
    }
   },

   cnic: {
    validators: {
     digits: {
      message: 'Please enter valid cnic number'
     }
    }
   },

   outlet_email: {
    validators: {
     notEmpty: {
      message: 'Please enter email'
     },
     emailAddress:{
         message: 'Please enter valid email address'
     }
    }
   },

   outlet_city: {
    validators: {
     notEmpty: {
      message: 'Please select a city'
     }
    }
   },
   outlet_country: {
    validators: {
     notEmpty: {
      message: 'Please select a country'
     }
    }
   },
    business_type_id: {
    validators: {
     notEmpty: {
      message: 'Please select a business type'
     }
    }
   },

//    phone: {
//     validators: {
//      notEmpty: {
//       message: 'PK phone number is required'
//      },
//      phone: {
//       country: 'PK',
//       message: 'The value is not a valid PK phone number'
//      }
//     }
//    },

   outlet_opening_date: {
    validators: {
     notEmpty: {
      message: 'Please select date'
     }
    }
   },

   options: {
    validators: {
     choice: {
      min:2,
      max:5,
      message: 'Please select at least 2 and maximum 5 options'
     }
    }
   },

   memo: {
    validators: {
     notEmpty: {
      message: 'Please enter memo text'
     },
     stringLength: {
      min:50,
      max:100,
      message: 'Please enter a menu within text length range 50 and 100'
     }
    }
   },

   checkbox: {
    validators: {
     choice: {
      min:1,
      message: 'Please kindly check this'
     }
    }
   },

   checkboxes: {
    validators: {
     choice: {
      min:2,
      max:5,
      message: 'Please check at least 1 and maximum 2 options'
     }
    }
   },

   radios: {
    validators: {
     choice: {
      min:1,
      message: 'Please kindly check this'
     }
    }
   },
  },

  plugins: {
   trigger: new FormValidation.plugins.Trigger(),
   // Bootstrap Framework Integration
   bootstrap: new FormValidation.plugins.Bootstrap({
    eleInvalidClass: '',
    eleValidClass: '',
   }),
   // Validate fields when clicking the Submit button
   submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
  }
 }
);
var avatar2 = new KTImageInput('kt_image_2');