FormValidation.formValidation(
 document.getElementById('add_category_form'),
 {
  fields: {
   category_title: {
    validators: {
     notEmpty: {
      message: 'Title is required'
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