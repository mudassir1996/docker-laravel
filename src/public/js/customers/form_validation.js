FormValidation.formValidation(
 document.getElementById('add_customer_form'),
 {
  fields: {
   customer_name: {
    validators: { 
     notEmpty: {
      message: 'Name is required'
     }
    }
   },

   
   
   customer_cnic: {
    validators: {
     digits: {
      message: 'Please enter valid cnic number'
     }
    }
   },
   
   customer_email: {
    validators: {
     emailAddress: {
      message: 'Please enter valid email'
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