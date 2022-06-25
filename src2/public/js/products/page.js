$(document).ready(function(){
    //shows order discount option
        $("#edit_discount").click(function(){
            $("#dis_fields").slideToggle(function(){
                if($("#edit_discount").text()=='Edit'){
                    $("#edit_discount").text('Close');
                    $("#tax_fields").slideUp();
                    $("#edit_tax").text('Edit');
                    $("#pay_fields").slideUp();
                     $("#pay").text('Payment Type');
                }
                else{
                    $("#edit_discount").text('Edit');
                }
            });
        });
        $("#edit_tax").click(function(){
            $("#tax_fields").slideToggle(function(){
                if($("#edit_tax").text()=='Edit'){
                    $("#edit_tax").text('Close');
                    $("#dis_fields").slideUp();
                    $("#edit_discount").text('Edit');
                    $("#pay_fields").slideUp();
                     $("#pay").text('Payment Type');
                }
                else{
                    $("#edit_tax").text('Edit');
                }
            });
        });
        $("#pay").click(function(){
            $("#pay_fields").slideToggle(function(){
                if($("#pay").text()=='Payment Type'){
                    $("#pay").text('Close');
                    $("#dis_fields").slideUp();
                    $("#edit_discount").text('Edit');
                    $("#tax_fields").slideUp();
                    $("#edit_tax").text('Edit');
                }
                else{
                    $("#pay").text('Payment Type');
                }
            });
        });
    
        if($('#payment_type_dropdown').find(':selected').attr('data-value')=='1'){
            $('#paid_field').addClass('d-none');
            $('#amount_paid').val(0);
            $('#change_field').addClass('d-none');
            $('#change_back').val(0);
        }
        else{
            $('#paid_field').removeClass('d-none');
            $('#amount_paid').val('');
            $('#change_field').removeClass('d-none');
            $('#change_back').val('');
        }

        $('#payment_type_dropdown').on('change', function(){
            // console.log($('#payment_type_dropdown').find(':selected').attr('data-value'));
            if($('#payment_type_dropdown').find(':selected').attr('data-value')=='1'){
                $('#paid_field').addClass('d-none');
                $('#amount_paid').val(0);
                $('#change_field').addClass('d-none');
                $('#change_back').val(0);
                $('#change_checkbox').hide();
            }
            else if($('#payment_type_dropdown').find(':selected').attr('data-value')=='2'){
                $('#paid_field').removeClass('d-none');
                $('#change_field').removeClass('d-none');
                $('#change_checkbox').show();
            }
            else{
                $('#paid_field').removeClass('d-none');
                // $('#amount_paid').val('');
                $('#change_field').removeClass('d-none');
                $('#change_checkbox').hide();
                // $('#change_back').val('');
            }
        });
});
