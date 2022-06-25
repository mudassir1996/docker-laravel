FormValidation.formValidation(
 document.getElementById('add_outlet_registration'),
 {
  fields: {
   registered_name: {
    validators: {
     notEmpty: {
      message: 'Registered name is required'
     }
    }
   },

   registered_address: {
    validators: {
     notEmpty: {
      message: 'Registered address name is required'
     },
    }
   },

   registration_date: {
    validators: {
     notEmpty: {
      message: 'Registration date is required'
     }
    }
   },
  },

  plugins: {
   trigger: new FormValidation.plugins.Trigger(),
   // Bootstrap Framework Integration
   bootstrap: new FormValidation.plugins.Bootstrap(),
   // Validate fields when clicking the Submit button
   submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
  }
 }
);
var avatar2 = new KTImageInput('kt_image_2');