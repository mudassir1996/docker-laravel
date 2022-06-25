FormValidation.formValidation(
 document.getElementById('customer_transaction_form'),
 {
  fields: {
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
            min: 1,
        }
    }
   },
   payment_status: {
    validators: {
     notEmpty: {
      message: 'Please select payment status'
     }
    }
   },
   customer_id: {
    validators: {
     notEmpty: {
      message: 'Please select customer'
     }
    }
   },
   order_id: {
    validators: {
     digits: {
      message: 'Please enter number only'
     }
    }
   },
   payment_date: {
    validators: {
     notEmpty: {
      message: 'Please select payment date'
     }
    }
   },
   payment_type: {
    validators: {
     notEmpty: {
      message: 'Please select payment type'
     }
    }
   },  
     
   payment_method_id: {
    validators: {
     notEmpty: {
      message: 'Please select payment method'
     }
    }
   },  
   'recipients[]': {
    validators: {
     notEmpty: {
      message: 'Please select payment method'
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
  },
}
);
