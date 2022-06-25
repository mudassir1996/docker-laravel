FormValidation.formValidation(
 document.getElementById('add_company_form'),
 {
  fields: {
   company_title: {
    validators: {
     notEmpty: {
      message: 'Title is required'
     }
    }
   },
   company_email: {
    validators: {
     emailAddress: {
      message: 'Please enter a valid email address'
     }
    }
   },

   company_phone: {
    validators: {
     digits: {
      message: 'Please enter a valid phone number'
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