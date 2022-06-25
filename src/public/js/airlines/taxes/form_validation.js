FormValidation.formValidation(
 document.getElementById('add_tax_form'),
 {
  fields: {
   tax_title: {
    validators: { 
     notEmpty: {
      message: 'Title is required.'
     }
    }
   },
   tax_value: {
    validators: { 
     notEmpty: {
      message: 'Value is required.'
     },
     numeric: {
        message: 'The value is not a number',
        decimalSeparator: '.'
    },
    greaterThan: {
            message: 'The value must be greater than or equal to 0',
            min: 1,
        }
    }
   },
   tax_type: {
    validators: { 
     notEmpty: {
      message: 'Type is required.'
     }
    }
   },
   tax_status: {
    validators: { 
     notEmpty: {
      message: 'Status is required.'
     }
    }
   },

   
   
//    customer_cnic: {
//     validators: {
//      digits: {
//       message: 'Please enter valid cnic number'
//      }
//     }
//    },
   
   party_phone: {
    validators: {
    regexp: {
        regexp: /^(\0|92|0)[0-9]{10}$/i,
        message: 'Please enter valid phone number.',
    },
    }
   },
   party_email: {
    validators: {
     emailAddress: {
      message: 'Please enter valid email.'
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