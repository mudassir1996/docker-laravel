$(document).ready(function() {
       // hide/show fields on changing status
        $('#cost').toggle();
        $('#quantity').toggle();
        
        $('.status').change(function() {
        if ($('.status').val() == 'delivered') {
            $('.purchased_date').prop("disabled", false);
            $('#cost').toggle();
            $('#quantity').toggle();
            if($('.purchased_date').val()===''){
                $('#error_pur_date').text('Select purchased date');
                $('.purchased_date').addClass('is-invalid');
                return false;
            }
            else{
                $('#error_pur_date').text('');
                $('.purchased_date').removeClass('is-invalid');
            }

        } else {
            $('#cost').toggle();
            $('#quantity').toggle();
            $('.purchased_date').val('');
            $('#error_pur_date').text('');
            $('.purchased_date').removeClass('is-invalid');
            $('.purchased_date').prop("disabled", true);
        }
        });


        
        //
        let count = 0;
        let single_item_total = 0;
        let final_single_item_total = 0;
        let items_total = 0;
        //Triggers when click on add button
        $('#add').click(function(){
            //reseting all fields in popup
            $('#save_item').text('Save Item');
            $('.modal-title').text('Add Item');
            $('#product').val('default');
            $('#product').selectpicker('refresh');
            $('#old_cost').val('');
            $('#new_cost').val('');
            $('#req_quantity').val(0);
            $('#pur_quantity').val(0);
            $('#new_cost').val('');
            $('#discount_value').val('');
            $('#discount_percentage').val('');
            $('#p_remarks').val('');

            $('#req_quantity').keyup(function(){
                if($('.status').val()!='delivered'){
                old_cost=$('#old_cost').val();
                
                requested_quantity=$('#req_quantity').val();
                final_single_item_total=old_cost*requested_quantity;
                
                
                $('#discount_value').val(0);
                $('#discount_percentage').val(0);
                $('#main_discount_value').val(0);
                $('#main_discount_percentage').val(0);
                $('#main_percent_label').text(0);
                $('#main_discount_label').text(0);
                }
                else if($('.status').val()=='delivered'){
                    new_cost=$('#new_cost').val();
                
                    purchase_quantity=$('#pur_quantity').val();
                    final_single_item_total=new_cost*purchase_quantity;
                
                
                    $('#discount_value').val(0);
                    $('#discount_percentage').val(0);
                    $('#main_discount_value').val(0);
                    $('#main_discount_percentage').val(0);
                    $('#main_percent_label').text(0);
                    $('#main_discount_label').text(0);
                }
            });
            
            //reseting values when add/change new cost price in popup
            $('#new_cost').keyup(function(){
                new_cost=$('#new_cost').val();
                purchase_quantity=$('#pur_quantity').val();
                final_single_item_total=new_cost*purchase_quantity;
                $('#discount_value').val(0);
                $('#discount_percentage').val(0);
                $('#main_discount_value').val(0);
                $('#main_discount_percentage').val(0);
                $('#main_percent_label').text(0);
                $('#main_discount_label').text(0);
            });

            //reseting values when add/change purchased quantity in popup
            $('#pur_quantity').keyup(function(){
                new_cost=$('#new_cost').val();
                purchase_quantity=$('#pur_quantity').val();
                final_single_item_total=new_cost*purchase_quantity;
                $('#discount_value').val(0);
                $('#discount_percentage').val(0);
                $('#main_discount_value').val(0);
                $('#main_discount_percentage').val(0);
                $('#main_percent_label').text(0);
                $('#main_discount_label').text(0);
            });

            //adding discount value in popup
            $('#discount_value').keyup(function(){
                if($('.status').val()!='delivered'){
                    old_cost=$('#old_cost').val();
                
                    requested_quantity=$('#req_quantity').val();
                
                    single_item_total=old_cost*requested_quantity;
                }
                else if($('.status').val()=='delivered'){
                    new_cost=$('#new_cost').val();
                
                    purchase_quantity=$('#pur_quantity').val();
                
                    single_item_total=new_cost*purchase_quantity;
                
                }
                discount_value=$('#discount_value').val();
                
                discount_percentage=(discount_value/single_item_total)*100;
                
                final_single_item_total=Math.round(single_item_total-discount_value);
                
                $('#discount_percentage').val(discount_percentage.toFixed(2));
                
                $('#main_discount_value').val('');
                
                $('#main_discount_percentage').val('');
                
                $('#main_percent_label').text(0);
                
                $('#main_discount_label').text(0);
            });

            //adding discount value in popup
            $('#discount_percentage').keyup(function(){
                
                if($('.status').val()!='delivered'){
                    console.log('not delivered');
                    old_cost=$('#old_cost').val();
                
                    requested_quantity=$('#req_quantity').val();
                
                    single_item_total=old_cost*requested_quantity;
                }
                else if($('.status').val()=='delivered'){
                    new_cost=$('#new_cost').val();
                    console.log('delivered');
                    purchase_quantity=$('#pur_quantity').val();
                
                    single_item_total=new_cost*purchase_quantity;
                
                }
                
                discount_percentage=$('#discount_percentage').val();
                
                discount_value=(discount_percentage*single_item_total)/100;
                
                final_single_item_total=Math.round(single_item_total-discount_value);
                
                $('#discount_value').val(Math.floor(discount_value));
                
                $('#main_discount_value').val('');
                
                $('#main_discount_percentage').val('');
                
                $('#main_percent_label').text(0);
                
                $('#main_discount_label').text(0);
            });
            
            
            
            // //reseting values when add/change new cost price in popup
            // $('#req_quantity').keyup(function(){
            //     $('#discount_value').val('');
            //     $('#discount_percentage').val('');
            //     $('#main_discount_value').val('');
            //     $('#main_discount_percentage').val('');
            //     $('#main_percent_label').text(0);
            //     $('#main_discount_label').text(0);
            // });
            
            
        });

        //Triggers when click on save
        $('#save_item').click(function() {
            var error_product = '';
            var error_req_quantity = '';
            var product = '';
            var old_cost = $('#old_cost').val();
            var new_cost = '';
            var req_quantity = '';
            var pur_quantity = '';
            var discount_value = '';
            var discount_percentage = '';
            var p_remarks = '';
            
            //Checking if product is selected 
            if ($('#product').val() == null) {
                //showing error
                error_product = 'Please select a product';
                $('#error_product').text(error_product);
                $('#product').addClass('is-invalid');
                product = '';
            } else {
                //removing error
                error_product = '';
                $('#error_product').text(error_product);
                $('#product').removeClass('is-invalid');

                //asigning values to variables
                productLabel = $('#product option:selected').text();
                product = $('#product').val();
                old_cost = $('#old_cost').val();
                new_cost = $('#new_cost').val();
                pur_quantity = $('#pur_quantity').val();
                discount_value = $('#discount_value').val();
                discount_percentage = $('#discount_percentage').val();
                p_remarks = $('#p_remarks').val();

            }

            //checking if requested quantity is empty
            if ($('#req_quantity').val() == '') {
                //showing error
                error_req_quantity = 'Please enter requested quantity';
                $('#error_req_quantity').text(error_req_quantity);
                $('#req_quantity').addClass('is-invalid');
                req_quantity = '';
            } else {
                //removing error and getting value
                error_req_quantity = '';
                $('#error_req_quantity').text(error_req_quantity);
                $('#req_quantity').removeClass('is-invalid');
                req_quantity = $('#req_quantity').val();
            }

            //checking if there is no empty field
            if (error_product != '' || error_req_quantity != '') {
                return false;
            } else {
                
                //triggers when the button text is save item i.e. you adding an item
                if ($('#save_item').text() == 'Save Item') {
                    count = count + 1;
                    //adding popup data to the table
                    output = '<tr id="row_' + count + '">';
                    output += '<td>' + productLabel + ' <input type="hidden" name="hidden_product_id[]" id="product' + count + '" class="first_name" value="' + product + '" /></td>';
                    output += '<td>' + old_cost + ' <input type="hidden" name="hidden_old_cost_price[]" id="old_cost' + count + '" value="' + old_cost + '" /></td>';
                    output += '<input type="hidden" name="hidden_new_cost[]" id="new_cost' + count + '" value="' + new_cost + '" />';
                    output += '<td>' + req_quantity + ' <input type="hidden" name="hidden_requested_quantity[]" id="req_quantity' + count + '" value="' + req_quantity + '" /></td>';
                    output += '<td>' + final_single_item_total + ' <input type="hidden" name="hidden_final_single_item_total[]" id="final_single_item_total' + count + '" value="' + final_single_item_total + '" /></td>';
                    output += '<input type="hidden" name="hidden_pur_quantity[]" id="pur_quantity' + count + '" value="' + pur_quantity + '" />';
                    output += '<input type="hidden" name="hidden_discount_value[]" id="discount_value' + count + '" value="' + discount_value + '" />';
                    output += '<input type="hidden" name="hidden_discount_percentage[]" id="discount_percentage' + count + '" value="' + discount_percentage + '" />';
                    output += '<input type="hidden" name="hidden_p_remarks[]" id="p_remarks' + count + '" value="' + p_remarks + '" />';
                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-sm view_details" id="' + count + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-sm remove_details" id="' + count + '">Remove</button></td>';
                    output += '</tr>';
                    $('#item_table').append(output);
                    
                    items_total=0;
                    
                    for(let i=1; i<=count; i++){
                        if($('#final_single_item_total'+i+'').val()==undefined){
                            continue;
                        }
                        items_total=items_total+Number($('#final_single_item_total'+i+'').val());
                    }
                    
                    $('#items_total').text(items_total);
                    $('#total_bill').val(items_total);
                    $('#payable_amount').text(Math.round(items_total-$('#main_discount_value').val()));
                    $('#amount_payable').val(Math.round(items_total-$('#main_discount_value').val()));
                    
                }
                else if($('#save_item').text()=='Update Item'){
                    //triggers when the button text is not save item i.e. you editing an item
                    var row_id = $('#hidden_row_id').val();
                    output = '<td>' + productLabel + ' <input type="hidden" name="hidden_product_id[]" id="product' + row_id + '" class="first_name" value="' + product + '" /></td>';
                    output += '<td>' + old_cost + ' <input type="hidden" name="hidden_old_cost_price[]" id="old_cost' + row_id + '" value="' + old_cost + '" /></td>';
                    output += '<input type="hidden" name="hidden_new_cost[]" id="new_cost' + row_id + '" value="' + new_cost + '" />';
                    output += '<td>' + req_quantity + ' <input type="hidden" name="hidden_requested_quantity[]" id="req_quantity' + row_id + '" value="' + req_quantity + '" /></td>';
                    output += '<td>' + final_single_item_total + ' <input type="hidden" name="final_single_item_total[]" id="final_single_item_total' + row_id + '" value="' + final_single_item_total + '" /></td>';
                    output += '<input type="hidden" name="hidden_pur_quantity[]" id="pur_quantity' + row_id + '" value="' + pur_quantity + '" />';
                    output += '<input type="hidden" name="hidden_discount_value[]" id="discount_value' + row_id + '" value="' + discount_value + '" />';
                    output += '<input type="hidden" name="hidden_discount_percentage[]" id="discount_percentage' + row_id + '" value="' + discount_percentage + '" />';
                    output += '<input type="hidden" name="hidden_p_remarks[]" id="p_remarks' + row_id + '" value="' + p_remarks + '" />';
                    output += '<td><button type="button" name="view_details" class="btn btn-warning btn-sm view_details" id="' + row_id + '">View</button></td>';
                    output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-sm remove_details" id="' + row_id + '">Remove</button></td>';
                    $('#row_' + row_id + '').html(output);

                    items_total=0;
                    for(let i=1; i<=count; i++){
                        if($('#final_single_item_total'+i+'').val()==undefined){
                            continue;
                        }
                        items_total=items_total+Number($('#final_single_item_total'+i+'').val());
                    }
                    
                    $('#items_total').text(items_total);
                    $('#total_bill').val(items_total);
                    $('#payable_amount').text(Math.round(items_total-$('#main_discount_value').val()));
                    $('#amount_payable').val(Math.round(items_total-$('#main_discount_value').val()));
                }

                $('#itemsModel').modal('toggle');

                    
                
            }
                
                //triggers when add order discount values
                $('#main_discount_value').keyup(function(){
                    po_discount_percentage=($('#main_discount_value').val()/items_total)*100;
                    $('#main_discount_percentage').val(Math.round(po_discount_percentage));
                    
                    $('#main_percent_label').text($('#main_discount_percentage').val());
                    
                    po_discount_value=$('#main_discount_value').val();
                    $('#main_discount_label').text(po_discount_value);
                    
                    payable_amount=items_total-po_discount_value;
                    $('#payable_amount').text(Math.round(payable_amount));
                    $('#amount_payable').val(Math.round(payable_amount));
                });

                //triggers when add order discount percentage
                $('#main_discount_percentage').keyup(function(){
                    po_discount_value=($('#main_discount_percentage').val()*items_total)/100;
                    $('#main_discount_value').val(Math.round(po_discount_value));
                    
                    $('#main_percent_label').text($('#main_discount_percentage').val());
                    $('#main_discount_label').text(po_discount_value);
                    
                    payable_amount=items_total-po_discount_value;
                    $('#payable_amount').text(Math.round(payable_amount));
                    $('#amount_payable').val(Math.round(payable_amount));
                });
        });
        //triggers when click on view button
        $(document).on('click', '.view_details', function() {
            var row_id = $(this).attr("id");
            var product = $('#product' + row_id + '').val();
            var old_cost = $('#old_cost' + row_id + '').val();
            var new_cost = $('#new_cost' + row_id + '').val();
            var req_quantity = $('#req_quantity' + row_id + '').val();
            var pur_quantity = $('#pur_quantity' + row_id + '').val();
            var discount_value = $('#discount_value' + row_id + '').val();
            var discount_percentage = $('#discount_percentage' + row_id + '').val();
            var p_remarks = $('#p_remarks' + row_id + '').val();
            $('#product').val(product);
            $('#old_cost').val(old_cost);
            $('#new_cost').val(new_cost);
            $('#req_quantity').val(req_quantity);
            $('#pur_quantity').val(pur_quantity);
            $('#discount_value').val(discount_value);
            $('#discount_percentage').val(discount_percentage);
            $('#p_remarks').val(p_remarks);
            $('#save_item').text('Update Item');
            $('#hidden_row_id').val(row_id);
            $('.modal-title').text('Edit Item');
            $('#itemsModel').modal('show');
        });

        //triggers when click on remove button
        $(document).on('click', '.remove_details', function() {
            var row_id = $(this).attr("id");
            items_total=items_total-Number($('#final_single_item_total'+row_id+'').val());
                $('#items_total').text(items_total);
                $('#total_bill').val(items_total);
                $('#payable_amount').text(Math.round(items_total-$('#main_discount_value').val()));
                $('#amount_payable').val(Math.round(items_total-$('#main_discount_value').val()));
                $('#row_' + row_id + '').remove();
            // if (confirm("Are you sure you want to remove this row data?")) {
                
            // } else {
            //     return false;
            // }
        });


        //shows order discount option
        $("#edit_discount").click(function(){
            $("#dis_fields").slideToggle(function(){
                if($("#edit_discount").text()=='Edit'){
                    $("#edit_discount").text('Close');
                }
                else{
                    $("#edit_discount").text('Edit');
                }
            });
        });

        $('input').on("wheel", function (e) { 
            $(this).blur(); 
        });
            
    });