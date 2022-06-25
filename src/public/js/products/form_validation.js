FormValidation.formValidation(
 document.getElementById('add_product_form'),
 {
  fields: {
   product_title: {
    validators: {
     notEmpty: {
      message: 'Title is required'
     }
    }
   },

   product_barcode: {
    validators: {
     notEmpty: {
      message: 'Product barcode is required'
     }
    }
   },

   
  minimum_threshold: {
    validators: {
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

   company_id: {
    validators: {
     notEmpty: {
      message: 'Please select a company'
     }
    }
   },
   category_id: {
    validators: {
     notEmpty: {
      message: 'Please select a category'
     }
    }
   },
   cost_price: {
    validators: {
      callback: {
          message: 'Please select cost price.',
          callback: function(value, validator, $field) {
              if(!document.getElementById('keep_stock').checked && value.value==''){
              //  KTUtil.scrollTop();
                return false;
              }
              return true;
          }
      },
    }
  },
   retail_price: {
    validators: {
      callback: {
          message: 'Please select retail price.',
          callback: function(value, validator, $field) {
              if(!document.getElementById('keep_stock').checked && value.value==''){
              //  KTUtil.scrollTop();
                return false;
              }
              return true;
          }
      },
    }
  },


   phone: {
    validators: {
     notEmpty: {
      message: 'US phone number is required'
     },
     phone: {
      country: 'US',
      message: 'The value is not a valid US phone number'
     }
    }
   },

   option: {
    validators: {
     notEmpty: {
      message: 'Please select an option'
     }
    }
   },

   options: {
    validators: {
     choice: {
      min:2,
      max:5,
      message: 'Please select at least 2 and maximum 5 options'
     }
    }
   },

   memo: {
    validators: {
     notEmpty: {
      message: 'Please enter memo text'
     },
     stringLength: {
      min:50,
      max:100,
      message: 'Please enter a menu within text length range 50 and 100'
     }
    }
   },

   checkbox: {
    validators: {
     choice: {
      min:1,
      message: 'Please kindly check this'
     }
    }
   },

   checkboxes: {
    validators: {
     choice: {
      min:2,
      max:5,
      message: 'Please check at least 1 and maximum 2 options'
     }
    }
   },

   radios: {
    validators: {
     choice: {
      min:1,
      message: 'Please kindly check this'
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