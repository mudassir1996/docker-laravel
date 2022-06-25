FormValidation.formValidation(
 document.getElementById('add_product_stock'),
 {
  fields: {
   product_id: {
    validators: {
     notEmpty: {
      message: 'Please select a product.'
     }
    }
   },

   supplier_id: {
    validators: {
     notEmpty: {
      message: 'Please select a supplier.'
     }
    }
   },

   po_purchased_date: {
    validators: {
     notEmpty: {
      message: 'Please select a date.'
     }
    }
   },

   units_in_stock: {
    validators: {
        notEmpty: {
        message: 'Please enter units'
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

   cost_price: {
    validators: {
        notEmpty: {
        message: 'Cost Price is required'
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

   retail_price: {
    validators: {
      notEmpty: {
        message: 'Retail Price is required'
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
   bootstrap: new FormValidation.plugins.Bootstrap(),
   // Validate fields when clicking the Submit button
   submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
   defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
  }
 }
);
var avatar2 = new KTImageInput('kt_image_2');