FormValidation.formValidation(
 document.getElementById('add_expense_transaction_form'),
 {
  fields: {
   title: {
    validators: {
     notEmpty: {
      message: 'Title is required.'
     }
    }
   },
   amount: {
    validators: {
     notEmpty: {
      message: 'Amount is required.'
     },
     numeric: {
        message: 'The value is not a number',
        decimalSeparator: '.'
    },
    greaterThan: {
            message: 'The value must be greater than or equal to 0',
            min: 0,
        }
    }
   },
   expense_category_id: {
    validators: {
     notEmpty: {
      message: 'Please select expense category.'
     }
    }
   },
   referred_user_id: {
    validators: {
     notEmpty: {
      message: 'Please select referred user.'
     }
    }
   },
   payment_type: {
    validators: {
     notEmpty: {
      message: 'Please select payment type.'
     }
    }
   },
   payment_method_id: {
    validators: {
     notEmpty: {
      message: 'Please select payment method.'
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