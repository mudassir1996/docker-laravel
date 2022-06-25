<script>
    var data = '';
    var count = 0;
    var total = 0;
    var grand_total = 0;
    var allow_credit = 0;

    

    function quantity_calculation(row_num) {
        quantity = parseFloat($('#quantity_' + row_num).val());
        retail_price = parseFloat($('#price_' + row_num).text());
        cost_price = parseFloat($('#cost_price_' + row_num).val());
        total_cost = cost_price * quantity;
        total_retail = retail_price * quantity;

        $('#total_cost_' + row_num).val(total_cost);
        $('#total_retail_' + row_num).val(total_retail);

        discount_val = $('#discount_val_' + row_num).val();
        total = total_retail - discount_val;
        $('#total_' + row_num).text(total.toFixed(2));
        $('#amount_payable_' + row_num).val(total.toFixed(2));
        grand_total = calculateRows(count, '');
    }

    function calculateRows(num_of_rows, field) {
        let sub_total = 0;
        let total_items = 0;
        let total_quantities = 0;
        let main_discount = 0;
        let grand_total = 0;
        let tax_value = 0;
        let tax_per = 0;

        for (i = 1; i <= num_of_rows; i++) {
            if ($('#quantity_' + i + '').val() == undefined) {
                continue;
            }
            total_items = Number($('#quantity_' + i).val()) + total_items;
            sub_total = Number($('#total_' + i).text()) + sub_total;
            total_quantities++;
            total_cost = $("#total_cost_" + i).val();
            total_retail = $("#total_retail_" + i).val();

            profit_value = total_retail - total_cost;
            if (total_cost == 0) {
                profit_percentage = profit_value;
            } else {
                profit_percentage = (profit_value / total_cost) * 100;
            }

            $("[name='profit_value']").val(profit_value);
            $("[name='profit_percentage']").val(profit_percentage.toFixed(2));


        }
        $('#total-items').text(total_items);
        $('#total-quantities').text(total_quantities.toFixed(2));
        $('#sub-total').text(sub_total.toFixed(2));
        $('#total_bill').val(sub_total.toFixed(2));


        if (field == 'main_discount') {
            main_discount = $('#main_discount').val();
            console.log(sub_total);
            
            if(main_discount == ''){
                main_discount = 0;
            }
            
            if (sub_total == 0) {
                toastr.error("Cant add discount");
                $('#main_discount').val(0);
                $('#main_discount_per').val(0);
            } else {
                main_discount_per = (main_discount / sub_total) * 100;
            }

            if(main_discount < 0){
                toastr.error("Percentage Should be greater than 0");
                main_discount = 0;
                main_discount_per = 0;
                $('#main_discount').val(0);
                $('#main_discount_per').val(0);
            }

            if (main_discount_per > 100) {
                toastr.error("Percentage Should be under 100");
                main_discount = 0;
                main_discount_per = 0;
                $('#main_discount_per').val(0);
                $('#main_discount').val(0);
                $('#main_discount_label').text(0);
            }
            $('#main_discount_per').val(main_discount_per.toFixed(2));
            $('#main_discount_label').text(main_discount_per.toFixed(2));
        } 
        else if (field == 'main_discount_per') {
            main_discount_per = $('#main_discount_per').val();

            
            if(main_discount_per < 0){
                toastr.error("Discount Should be greater than 0");
                main_discount = 0;
                main_discount_per = 0;
                $('#main_discount').val(0);
                $('#main_discount_per').val(0)
            }
            if ($('#main_discount_per').val() == '') {
                $('#main_discount_label').text(0);
                // main_discount_per = $('#main_discount_per').val();
                main_discount = (main_discount_per * sub_total) / 100;
                $('#main_discount').val(main_discount);
            }
            else{
                if (sub_total == 0) {
                    $('#main_discount_label').text(0);
                    main_discount_per=0;
                    toastr.error("Cant add discount");
                    $('#main_discount').val(0);
                    $('#main_discount_per').val(0);
                } else {
                    main_discount = (main_discount_per * sub_total) / 100;
                    $('#main_discount').val(main_discount);
                }
            }
            if (main_discount_per > 100) {
                toastr.error("Percentage Should be under 100");
                main_discount = 0;
                main_discount_per = 0;
                $('#main_discount_per').val(0);
                $('#main_discount').val(0);
                $('#main_discount_label').text(0);
            } else {
                $('#main_discount_label').text(main_discount_per);
                $('#main_discount').val((main_discount_per * sub_total) / 100);
            }
        }

        main_discount = $('#main_discount').val();

        grand_total = sub_total - main_discount;

        if (field == 'tax_value') {
            tax_value = $('#tax_value').val();
            tax_per = $('#tax_per').val();
            if(tax_value < 0 || tax_value == ''){
                tax_value=0;
                $('#tax_value').val(tax_value.toFixed(2));
                tax_per = 0;
            }else{
                if (sub_total == 0) {
                    tax_per = tax_value;
                } else {
                    tax_per = (tax_value / sub_total) * 100;
                }
            }

            $('#tax_per').val(tax_per.toFixed(2));
            $('#tax').text(tax_per.toFixed(2));
            //tax_per = (tax_value / grand_total) * 100;
            

        } else if (field == 'tax_per') {

            if ($('#tax_per').val() == '' || $('#tax_per').val() < 0) {
                tax_value=0;
                tax_per=0;
                $('#tax').text(tax_per.toFixed(2));
                $('#tax_per').val(tax_per.toFixed(2));
                $('#tax_value').val(tax_value.toFixed(2));
            } else {
                $('#tax').text($('#tax_per').val());
                $('#tax_value').val(($('#tax_per').val() * grand_total) / 100);
            }

        }
        tax_value = $('#tax_value').val();
        grand_total = parseFloat(grand_total) + parseFloat(tax_value);

        $('#grand-total').text(grand_total.toFixed(2));
        $('#amount_payable').val(grand_total.toFixed(2));

        return grand_total;

    }

    function paidAmountCalculation(){
        amount_paid = $("#amount_paid").val();
        amount_payable = $("#amount_payable").val();

        if(Number.isNaN(amount_paid)){
            amount_paid=0;
           $("#amount_paid").val(amount_paid);
        }
         $("#change_back").val(amount_paid - amount_payable);
    }

    $('#search').on('keyup',function(e) {
        if (e.keyCode == 13) {
            var search = $(this).val();
            search=search.toString();
            if (search != '') {
                $.ajax({
                    url: "/live-search?query=" + search,
                    type: "Get",
                    success: function(res) {
                        data = res['search_result'];
                        $('#product_search_table > tbody').html(res['output']);
                    }
                });
            } else {
                $('#product_search_table > tbody').html('');
            }
        }
      
    });

    
    function select_product(key) {


        product = data[key];
        id_number = product.product_id;
        //quantity_num = key + 1;
        quantity = $('#row_' + id_number + ' .quantity').val();

        if ($('#hidden_row_id_' + id_number).val() != undefined) {
            quantity = $('#row_' + id_number + ' .quantity').val();
            let old_quantity = 0;
            old_quantity = Number(quantity) + 1;
            // console.log(old_quantity);
            if (old_quantity < product.units_in_stock || product.stock_keeping == 0) {
                $('#row_' + id_number + ' .quantity').val(old_quantity);
                total = $('#row_' + id_number + ' .price').text() * quantity;
                discount_val = $('#row_' + id_number + ' .discount_val').val();
                total = total - discount_val;
                
            } else {
                toastr.error("There are only " + product.units_in_stock + " products in stock");
            }

        } else if (product.units_in_stock == 0 && product.stock_keeping) {
            toastr.error("There are only " + product.units_in_stock + " products in stock");
        } else {
            count = count + 1;

            if (product.product_feature_img == 'placeholder.jpg') {
                imagefolder = "{{asset('storage/')}}";
            } else {
                imagefolder = "{{asset('storage/products/')}}";
            }
            output = '<tr id="row_' + id_number + '">';
            output += '<input type="hidden" id="hidden_row_id_' + id_number + '" value="' + id_number + '">'
            output += '<td class="d-flex align-items-center  font-weight-bolder">';
            output += '<div class="symbol symbol-50 flex-shrink-0 mr-4 bg-light">';
            output += '<div class="symbol-label" style="background-image: url(' + "'" + imagefolder + '/' + product.product_feature_img + "'" + ')"></div>';
            output += '</div>';
            output += '<a href="#" class="text-dark text-hover-primary">' + product.product_title + '</a>';
            output += '<input type="hidden" name="order_id">';
            output += '<input type="hidden" name="product_id[]" value="' + product.product_id + '">';
            output += '<input type="hidden" id="units_' + count + '" value="' + product.units_in_stock + '">';
            output += '<input type="hidden" id="stock_keeping_' + count + '" value="' + product.stock_keeping + '">';
            output += '<input type="hidden" id="allow_half_' + count + '" value="' + product.product_allow_half + '">';
            output += '</td>';
            output += '<td class="text-right align-middle font-weight-bolder font-size-h5 price" id="price_' + count + '">' + product.retail_price + '</td>';
            output += '<input type="hidden" name="cost_price[]" id="cost_price_' + count + '" value="' + product.cost_price + '">';
            output += '<input type="hidden" name="retail_price[]" id="retail_price_' + count + '" value="' + product.retail_price + '">';
            output += '<input type="hidden" name="total_cost[]" class="total_cost" id="total_cost_' + count + '">';
            output += '<input type="hidden" name="total_retail[]" class="total_retail" id="total_retail_' + count + '">';
            output += '<td class="text-center align-middle">';
            output += '<input type="number" name="quantity[]" id="quantity_' + count + '" value="1" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 quantity">';
            output += '</td>';
            output += '<td class="text-center align-middle">';
            output += '<input type="number" id="discount_val_' + count + '" name="discount_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7  discount_val">';
            output += '</td>';
            output += '<td class="text-center align-middle">';
            output += '<input type="number" id="discount_per_' + count + '" name="discount_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 discount_per">';
            output += '</td>';
            output += '<td class="text-right align-middle font-weight-bolder font-size-h5 total" id="total_' + count + '"></td>';
            output += '<input type="hidden"  name="tax_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
            output += '<input type="hidden" name="tax_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
            output += '<input type="hidden" name="amount_payable[]" value="0" class="amount_payable" id="amount_payable_' + count + '">';
            output += '<td class="text-left align-middle">';
            output += '<a href="#" class="remove " id="' + id_number + '" title="Remove">';
            output += '<i class="fas fa-window-close text-danger text-focus-primary"></i>';
            output += '</a>';
            output += '</td>';
            output += '</tr>';

            $('#product_table').append(output);
           
        }

        quantity = $('#row_' + id_number + ' .quantity').val();

        total_cost = product.cost_price * quantity;
        total_retail = product.retail_price * quantity;

        $('#row_' + id_number + ' .total_cost').val(total_cost);
        $('#row_' + id_number + ' .total_retail').val(total_retail);

        discount_val = $('#row_' + id_number + ' .discount_val').val();
        total = total_retail - discount_val;
        $('#row_' + id_number + ' .total').text(total.toFixed(2));
        $('#row_' + id_number + ' .amount_payable').val(total.toFixed(2));
        $('#tax_value').val(0.00);
        $('#tax_per').val(0.00);
        $('#tax').text(0);
        grand_total = calculateRows(count, '');
        paidAmountCalculation();

    }


    $(document).on('keyup', '.quantity', function() {
        var id = $(this).attr("id");
        var row_num = id.split("_").pop();
        $('#discount_val_' + row_num).val(0);
        $('#discount_per_' + row_num).val(0);
        quantity = parseFloat($('#quantity_' + row_num).val());
        
        units = parseFloat($('#units_' + row_num).val());
        stock_keeping = parseFloat($('#stock_keeping_' + row_num).val());
        allow_half = parseInt($('#allow_half_' + row_num).val());

        if (Number.isNaN(quantity) || quantity == 0) {
            toastr.error("Quantity should not be less than zero");
            $('#quantity_' + row_num).val(1);
            quantity = $('#quantity_' + row_num).val();
            quantity_calculation(row_num);
            paidAmountCalculation();
        }
        else if (quantity > units && stock_keeping == 1) {
            toastr.error("There are " + units + " products in stock");
            $('#quantity_' + row_num).val(1);
            quantity_calculation(row_num);
            paidAmountCalculation();

        }  else if (allow_half == 0 && quantity % 1 != 0) {
            toastr.error("The product is not allowed half");
            $('#quantity_' + row_num).val(1);
            quantity_calculation(row_num);
            paidAmountCalculation();
        } else {
            //quantity = $('#quantity_' + row_num).val();
            // console.log(row_num);
            quantity_calculation(row_num);
            paidAmountCalculation();
        }

    });


    $(document).on('keyup', '.discount_val', function() {
        var id = $(this).attr("id");
        var row_num = id.split("_").pop();
        quantity = $('#quantity_' + row_num).val();
        retail_price = $('#price_' + row_num).text();
        total_retail = retail_price * quantity;
        discount_val = $('#discount_val_' + row_num).val();
        discount_per = (discount_val / total_retail) * 100;
        if(discount_val < 0){
            toastr.error("Discount Should be greater than 0");
            discount_val = 0;
            discount_per = 0;
            $('#discount_per_' + row_num).val(0);
            $('#discount_val_' + row_num).val(0)
        }

        if (discount_per > 100) {
            toastr.error("Percentage Should be under 100");
            discount_val = 0;
            discount_per = 0;
            $('#discount_per_' + row_num).val(0);
            $('#discount_val_' + row_num).val(0)
        } 
        else {
            $('#discount_per_' + row_num).val(discount_per.toFixed(2));
        }


        total = total_retail - discount_val;
        $('#total_' + row_num).text(total.toFixed(2));
        $('#amount_payable_' + row_num).val(total.toFixed(2));
        grand_total = calculateRows(count, '');
        paidAmountCalculation();
        $('#main_discount').val(0.00);
        $('#main_discount_per').val(0.00);
        $('#main_discount_label').text(0);
        $('#tax_value').val(0.00);
        $('#tax_per').val(0.00);
        $('#tax').text(0);
    });

    $(document).on('keyup', '.discount_per', function() {
        var id = $(this).attr("id");
        var row_num = id.split("_").pop();
        quantity = $('#quantity_' + row_num).val();
        retail_price = $('#price_' + row_num).text();
        total_retail = retail_price * quantity;
        discount_per = $('#discount_per_' + row_num).val();
        discount_val = (discount_per * total_retail) / 100;
        if(discount_per < 0){
            toastr.error("Percentage Should be greater than 0");
            discount_val = 0;
            discount_per = 0;
            $('#discount_per_' + row_num).val(0);
            $('#discount_val_' + row_num).val(0)
        }

        if (discount_per > 100) {
            toastr.error("Percentage Should be under 100");
            discount_val = 0;
            discount_per = 0;
            $('#discount_per_' + row_num).val(0);
            $('#discount_val_' + row_num).val(0)
        } else {
            $('#discount_val_' + row_num).val(discount_val);
        }
        total = total_retail - discount_val;
        $('#total_' + row_num).text(total.toFixed(2));
        $('#amount_payable_' + row_num).val(total.toFixed(2));
        grand_total = calculateRows(count, '');
        paidAmountCalculation();
        $('#main_discount').val(0.00);
        $('#main_discount_per').val(0.00);
        $('#main_discount_label').text(0);
        $('#tax_value').val(0.00);
        $('#tax_per').val(0.00);
        $('#tax').text(0);
    });


    $(document).on('keyup', '#main_discount', function() {
        grand_total = calculateRows(count, 'main_discount');
        paidAmountCalculation();

    });

    $(document).on('keyup', '#main_discount_per', function() {
        grand_total = calculateRows(count, 'main_discount_per');
        paidAmountCalculation();

    });
    $(document).on('keyup', '#tax_value', function() {
        grand_total = calculateRows(count, 'tax_value');
        paidAmountCalculation();

    });

    $(document).on('keyup', '#tax_per', function() {
        grand_total = calculateRows(count, 'tax_per');
        paidAmountCalculation();

    });
    $(document).on('keyup', '#amount_paid', function() {
        paidAmountCalculation();
    });



    //triggers when click on remove button
    $(document).on('click', '.remove', function() {
        var row_id = $(this).attr("id");
        $('#row_' + row_id + '').remove();
        $('#main_discount').val(0.00);
        $('#main_discount_per').val(0.00);
        $('#main_discount_label').text(0);
        $('#tax_value').val(0.00);
        $('#tax_per').val(0.00);
        $('#tax').text(0);
        grand_total = calculateRows(count, '');
        paidAmountCalculation();

    });
    //////////////////////submit form//////////////////
    $('#cancel').on("click", function() {
        window.location = "{{route('sales.index')}}";
    });
    $('#hold').on("click", function() {
        if ($("#product_table > tbody > tr").html() == undefined) {
            toastr.error("Cannot submit empty form");
        } else {
            $("[name='so_status']").val('on-hold');
            $('#sales_order_form').submit();
        }
    });
    $('#payment').on("click", function() {
        if ($("#product_table > tbody > tr").html() == undefined) {
            toastr.error("Cannot submit empty form");
        } 
        else if($('#customer').val()==''){
            toastr.error("Please select customer");
        }
        else if ($('#customer option:selected').attr('data-customer') == 0 && ($('#payment_type_dropdown').val() == 'credit' || $('#payment_type_dropdown').val() == 'split_bill')) {
            toastr.error("This user is not allowed credit purchases");
        }
        else if ($("#amount_paid").val() == "") {
            toastr.error("Please enter paid amount");
        } 
        else if($('#payment_type_dropdown').val() == 'split_bill' && $('#amount_paid').val() <= 0){
            toastr.error("You must enter amount greater than 0");
        }
        else if($('#payment_type_dropdown').val() == 'split_bill' && $('#amount_paid').val() == amount_payable){

            Swal.fire({
                title: "Change payment type.",
                text: "You have entered complete amount in split bill. Please change payment type.",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Change Now"
            }).then(function(result) {
                if (result.value) {
                $('#payment_type_dropdown').val("cash");
                }
                
            });
            
        }
         else if ($('#payment_type_dropdown').val() == 'cash' && $('#amount_paid').val() < amount_payable) {
             console.log($('#amount_paid').val()+ '=='+ amount_payable);
            toastr.error("Please enter complete amount");
        } 
        else {
            $("[name='so_status']").val('completed');
            $('#sales_order_form').submit();
        }

    });
</script>

<!-- Add customer -->
<script type="text/javascript">
    $('#btn').on('click', function(event) {
        event.preventDefault();
        form = new FormData(document.getElementById("add_customer_form"));
        // data = document.getElementById("add_customer_form"),
        $.ajax({
            url: "/add-customer",
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form,
            success: function(response) {

                $('#customer_model').modal('toggle');
                toastr.success("Customer Added");
                $("[name='customer_name']").val("");
                $("[name='outlet_id']").val("");
                $("[name='created_by']").val("");

                $.ajax({
                    url: "/get-customer?id=" + response,
                    type: "Get",
                    success: function(res) {
                        $("#customer").append("<option data-customer=" + res.allow_credit + " value='" + res.id + "'>" + res.customer_name + "</option>");
                        $("#customer").selectpicker("refresh");
                        var newVal = $("#customer option:last").val();
                        $("#customer").selectpicker("val", [newVal]);

                    }

                });
            },
            error: function(response) {
                $('#customer_model').modal('toggle');
                toastr.error("Error! Please try again");
                $("[name='customer_name']").val("");
                $("[name='outlet_id']").val("");
                $("[name='created_by']").val("");

            }

        });
    });
</script>
<!-- Hold Orders JS -->
<script type="text/javascript">
    $('#view-hold-order').on('click', function(event) {
        $('.hold-orders-table > tbody').empty();
        let customer_id = $('#customer').val();
        $.ajax({
            url: "/get-hold-orders?customer_id=" + customer_id,
            type: "Get",
            success: function(res) {
                console.log(res);
                // hold_orders = res['hold_orders'];
                // $('.hold-orders-table > tbody').append(res['output']);
                
                data = res['hold_orders'];
                if (data.length > 0) {
                    $('#hold_order_model').modal('toggle');
                    $('.hold-orders-table > tbody').html(res['output']);
                } else {
                    toastr.options = {
                        "closeButton": true,
                    };
                    toastr.info("Customer donot have orders on hold.");
                }

            }

        });
    });

    function select_hold_order(key) {

        $('#hold_order_model').modal('toggle');
        hold_order = data[key];
        $('#product_table > tbody').empty();
        $.each(hold_order.sales_order_detail,
            function(key, hold_order_detail) {
                id_number = hold_order_detail.product_id;
                $.ajax({
                    url: "/get-product-data?product_id=" + id_number,
                    type: "Get",
                    success: function(result) {
                        product_data = result;
                        // console.log(id_number);
                        if (product_data.product_feature_img == 'placeholder.jpg') {
                            imagefolder = "{{asset('storage/')}}";
                        } else {
                            imagefolder = "{{asset('storage/products/')}}";
                        }
                        count = count + 1;

                        output = '<tr id="row_' + id_number + '">';
                        output += '<input type="hidden" id="hidden_row_id_' + id_number + '" value="' + id_number + '">'
                        output += '<td class="d-flex align-items-center  font-weight-bolder">';
                        output += '<div class="symbol symbol-50 flex-shrink-0 mr-4 bg-light">';
                        output += '<div class="symbol-label" style="background-image: url(' + "'" + imagefolder + '/' + product_data.product_feature_img + "'" + ')"></div>';
                        output += '</div>';
                        output += '<a href="#" class="text-dark text-hover-primary">' + product_data.product_title + '</a>';

                        output += '<input type="hidden" name="product_id[]" value="' + hold_order_detail.product_id + '">';
                        output += '<input type="hidden" id="units_' + count + '" value="' + product_data.units_in_stock + '">';
                        output += '<input type="hidden" id="stock_keeping_' + count + '" value="' + product_data.stock_keeping + '">';
                        output += '<input type="hidden" id="allow_half_' + count + '" value="' + product_data.product_allow_half + '">';
                        output += '</td>';
                        output += '<td class="text-right align-middle font-weight-bolder font-size-h5 price" id="price_' + count + '">' + hold_order_detail.retail_price + '</td>';
                        output += '<input type="hidden" name="cost_price[]" id="cost_price_' + count + '" value="' + product_data.cost_price + '">';
                        output += '<input type="hidden" name="retail_price[]" id="retail_price_' + count + '" value="' + product_data.retail_price + '">';
                        output += '<input type="hidden" name="total_cost[]" class="total_cost" id="total_cost_' + count + '">';
                        output += '<input type="hidden" name="total_retail[]" class="total_retail" id="total_retail_' + count + '">';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" name="quantity[]" id="quantity_' + count + '" value="' + hold_order_detail.quantity + '" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 quantity">';
                        output += '</td>';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" id="discount_val_' + count + '" name="discount_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7  discount_val">';
                        output += '</td>';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" id="discount_per_' + count + '" name="discount_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 discount_per">';
                        output += '</td>';
                        output += '<td class="text-right align-middle font-weight-bolder font-size-h5 total" id="total_' + count + '">' + hold_order_detail.amount_payable + '</td>';
                        output += '<input type="hidden"  name="tax_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
                        output += '<input type="hidden" name="tax_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
                        output += '<input type="hidden" name="amount_payable[]" value="0" class="amount_payable" id="amount_payable_' + count + '">';
                        output += '<td class="text-left align-middle">';
                        output += '<a href="#" class="remove " id="' + id_number + '" title="Remove">';
                        output += '<i class="fas fa-window-close text-danger text-focus-primary"></i>';
                        output += '</a>';
                        output += '</td>';
                        output += '</tr>';
                        // console.log(output);
                        
                        $('#product_table > tbody').append(output);
                        $('#order_id').val(hold_order.id);

                        quantity_calculation(count);
                        $('#return_order_msg').addClass('d-none');
                        $('#hold_order_msg').removeClass('d-none');
                        

                    }
                });
                


            });
        // count++;
        //         if(count >= Object.keys(hold_order.sales_order_detail)){
        //            KTApp.unblock('.kt_blockui_content'); 
        //         }
        

    }
</script>

<!-- Return Orders JS -->
<script type="text/javascript">
    $('#return-search').on('keyup', function(e) {
        if (e.keyCode == 13) {
        $('#return_orders_table > tbody').empty();
        let orderID = $('#return-search').val();
        // console.log(orderID);
        $.ajax({
            url: "/get-orders?order_id=" + orderID,
            type: "Get",
            success: function(res) {
                // console.log(res);
                // hold_orders = res['hold_orders'];
                // $('.hold-orders-table > tbody').append(res['output']);
                
                data = res['orders'];
                if (data.length > 0) {
                    //$('#hold_order_model').modal('toggle');
                    $('#return_orders_table > tbody').html(res['output']);
                }
                // } else {
                //     toastr.options = {
                //         "closeButton": true,
                //     };
                //     toastr.info("Customer donot have orders on hold.");
                // }

            }

        });
        }
    });

    function select_return_order(key) {
        return_order = data[key];
        $('#product_table > tbody').empty();
        $("#customer").selectpicker("refresh");
        $("#customer").selectpicker("val", [return_order.customer_id]);
        $("#remarks").val(return_order.remarks);

        $("#main_discount_label").text(return_order.so_discount_percentage);
        $("#main_discount").val(return_order.so_discount_value);
        $("#main_discount_per").val(return_order.so_discount_percentage);
        $('#tax').text(return_order.so_tax_percentage);
        $('#tax_per').val(return_order.so_tax_percentage);
        $('#tax_value').val(return_order.so_tax_value);
        $('#payment_type_dropdown').val(return_order.payment_type);
        $('#payment_method_dropdown').val(return_order.payment_method_id);
        
        
        // console.log(return_order);

        $.each(return_order.sales_order_detail,
            function(key, return_order_detail) {
                id_number = return_order_detail.product_id;
                
                $.ajax({
                    url: "/get-product-data?product_id=" + id_number,
                    type: "Get",
                    success: function(result) {
                        product_data = result;
                        if (product_data.product_feature_img == 'placeholder.jpg') {
                            imagefolder = "{{asset('storage/')}}";
                        } else {
                            imagefolder = "{{asset('storage/products/')}}";
                        }
                        count = count + 1;

                        output = '<tr id="row_' + id_number + '">';
                        output += '<input type="hidden" id="hidden_row_id_' + id_number + '" value="' + id_number + '">'
                        output += '<td class="d-flex align-items-center  font-weight-bolder">';
                        output += '<div class="symbol symbol-50 flex-shrink-0 mr-4 bg-light">';
                        output += '<div class="symbol-label" style="background-image: url(' + "'" + imagefolder + '/' + product_data.product_feature_img + "'" + ')"></div>';
                        output += '</div>';
                        output += '<a href="#" class="text-dark text-hover-primary">' + product_data.product_title + '</a>';

                        output += '<input type="hidden" name="product_id[]" value="' + return_order_detail.product_id + '">';
                        output += '<input type="hidden" id="units_' + count + '" value="' + product_data.units_in_stock + '">';
                        output += '<input type="hidden" id="stock_keeping_' + count + '" value="' + product_data.stock_keeping + '">';
                        output += '<input type="hidden" id="allow_half_' + count + '" value="' + product_data.product_allow_half + '">';
                        output += '</td>';
                        output += '<td class="text-right align-middle font-weight-bolder font-size-h5 price" id="price_' + count + '">' + return_order_detail.retail_price + '</td>';
                        output += '<input type="hidden" name="cost_price[]" id="cost_price_' + count + '" value="' + product_data.cost_price + '">';
                        output += '<input type="hidden" name="retail_price[]" id="retail_price_' + count + '" value="' + product_data.retail_price + '">';
                        output += '<input type="hidden" name="total_cost[]" class="total_cost" id="total_cost_' + count + '">';
                        output += '<input type="hidden" name="total_retail[]" class="total_retail" id="total_retail_' + count + '">';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" name="quantity[]" id="quantity_' + count + '" value="' + return_order_detail.quantity + '" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 quantity">';
                        output += '</td>';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" id="discount_val_' + count + '" name="discount_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7  discount_val">';
                        output += '</td>';
                        output += '<td class="text-center align-middle">';
                        output += '<input type="number" id="discount_per_' + count + '" name="discount_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-7 discount_per">';
                        output += '</td>';
                        output += '<td class="text-right align-middle font-weight-bolder font-size-h5 total" id="total_' + count + '">' + return_order_detail.amount_payable + '</td>';
                        output += '<input type="hidden"  name="tax_value[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
                        output += '<input type="hidden" name="tax_percentage[]" value="0" class="border border-success rounded bg-gray-100 px-1 py-1 col-xl-6 discount_per">';
                        output += '<input type="hidden" name="amount_payable[]" value="0" class="amount_payable" id="amount_payable_' + count + '">';
                        output += '<td class="text-left align-middle">';
                        output += '<a href="#" class="remove " id="' + id_number + '" title="Remove">';
                        output += '<i class="fas fa-window-close text-danger text-focus-primary"></i>';
                        output += '</a>';
                        output += '</td>';
                        output += '</tr>';
                        
                        $('#product_table > tbody').append(output);
                        $('#order_id').val(return_order.id);

                        quantity_calculation(count);
                        

                    $('#return_order_msg').removeClass('d-none');
                    $('#hold_order_msg').addClass('d-none');
                    }
                });
                


            });
    }
</script>