FormValidation.formValidation(
 document.getElementById('add_purchase_form'),
 {
  fields: {
   product_id: {
    validators: {
     notEmpty: {
      message: 'Please select a product'
     }
    }
   },

   quantity: {
    validators: {
     notEmpty: {
      message: 'Quantity is required'
     },
     numeric:{
         decimalSeparator:'.',
         message:'Enter valid quantity'
     }
    }
   },
   cost_price: {
    validators: {
     notEmpty: {
      message: 'Cost Price is required'
     },
     numeric:{
         decimalSeparator:'.',
         message:'Enter valid cost price'
     }
    }
   },
   retail_price: {
    validators: {
     notEmpty: {
      message: 'Retail Price is required'
     },
     numeric:{
         decimalSeparator:'.',
         message:'Enter valid retial price'
     }
    }
   },
 
   purchase_status: {
    validators: {
     notEmpty: {
      message: 'Please select a purchase status'
     }
    }
   },
   
   payment_type: {
    validators: {
     notEmpty: {
      message: 'Please select a payment type'
     }
    }
   },

   payment_method_id: {
    validators: {
     notEmpty: {
      message: 'Please select a payment method'
     }
    }
   },

   supplier_id: {
    validators: {
     notEmpty: {
      message: 'Please select a supplier'
     }
    }
   },
   
   purchase_date: {
    validators: {
     notEmpty: {
      message: 'Please select purchase date'
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