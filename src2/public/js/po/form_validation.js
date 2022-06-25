FormValidation.formValidation(
 document.getElementById('po_form'),
 {
  fields: {
   supplier_id: {
    validators: {
     notEmpty: {
      message: 'Select Supplier'
     }
    }
   },
   po_number: {
    validators: {
     notEmpty: {
      message: 'Enter purchase order number'
     }
    }
   },


   po_request_date: {
    validators: {
     notEmpty: {
      message: 'Select purchase request date'
     }
    }
   },

   po_expected_date: {
    validators: {
     notEmpty: {
      message: 'Select purchase expected date'
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