$("#save-company").on("click", function (event) {
    event.preventDefault();
    $('#save-company').attr('disabled', 'true');
    let _token = $('meta[name="csrf-token"]').attr("content");
    let company_title = $("input[name=company_title]").val();
    let created_by = $("input[name=created_by]").val();
    let outlet_id = $("input[name=outlet_id]").val();
    // data = document.getElementById("add_customer_form"),
    $.ajax({
        url: "{{route('companies.add-company')}}",
        type: "POST",
        data: {
            company_title: company_title,
            created_by: created_by,
            outlet_id: outlet_id,
            _token: _token,
        },
        success: function (response) {
            // console.log(response);
            $("#company_model").modal("toggle");
            toastr.success("Company Added");
            $("[name='company_title']").val("");

            $.ajax({
                url: "{{url('get-company')}}?id=" + response,
                type: "Get",
                success: function (res) {
                    $.each(res, function (key, value) {
                        $("#company").append(
                            "<option value='" + key + "'>" + value + "</option>"
                        );
                    });
                    $("#company").selectpicker("refresh");
                    var newVal = $("#company option:last").val();
                    $("#company").selectpicker("val", [newVal]);
                    $('#save-company').attr('disabled', 'false');
                },
            });
        },
        error: function (response) {
            $("#company_model").modal("toggle");
            toastr.error("Error! Please try again");
            $("[name='company_title']").val("");
            $('#save-company').attr('disabled', 'false');
        },
    });
});
// $("#save-supplier").on("click", function (event) {
//     event.preventDefault();
//     let _token = $('meta[name="csrf-token"]').attr("content");
//     let supplier_title = $("input[name=supplier_title]").val();
//     let company_id = $("#company").val();
//     let created_by = $("input[name=created_by]").val();
//     let outlet_id = $("input[name=outlet_id]").val();
//     $.ajax({
//         url: "{{route('suppliers.add-supplier')}}",
//         type: "POST",
//         data: {
//             supplier_title: supplier_title,
//             company_id:company_id,
//             created_by: created_by,
//             outlet_id: outlet_id,
//             _token: _token,
//         },
//         success: function (response) {
//             // console.log(response);
//             $("#supplier_model").modal("toggle");
//             toastr.success("Supplier Added");
//             $("[name='supplier_title']").val("");
//             $("#company").selectpicker('refresh');
//             // $("#company").selectpicker('val','');

//             $.ajax({
//                 url: "{{url('get-supplier')}}?id=" + response,
//                 type: "Get",
//                 success: function (res) {
//                     $.each(res, function (key, value) {
//                         $("#supplier").append(
//                             "<option value='" + key + "'>" + value + "</option>"
//                         );
//                     });
//                     $("#supplier").selectpicker("refresh");
//                     var newVal = $("#supplier option:last").val();
//                     $("#supplier").selectpicker("val", [newVal]);
//                 },
//             });
//         },
//         error: function (response) {
//             $("#supplier_model").modal("toggle");
//             toastr.error("Error! Please try again");
//             $("[name='supplier_title']").val("");
//         },
//     });
// });

$("#save-category").on("click", function (event) {
    event.preventDefault();
    $('#save-category').attr('disabled', 'true');
    let _token = $('meta[name="csrf-token"]').attr("content");
    let category_title = $("input[name=category_title]").val();
    let created_by = $("input[name=created_by]").val();
    let outlet_id = $("input[name=outlet_id]").val();
    // data = document.getElementById("add_customer_form"),
    $.ajax({
        url: "{{route('categories.add-category')}}",
        type: "POST",
        data: {
            category_title: category_title,
            created_by: created_by,
            outlet_id: outlet_id,
            _token: _token,
        },
        success: function (response) {
            // console.log(response);
            $("#category_model").modal("toggle");
            toastr.success("Category Added");
            $("[name='category_title']").val("");

            $.ajax({
                url: "{{url('get-category')}}?id=" + response,
                type: "Get",
                success: function (res) {
                    $.each(res, function (key, value) {
                        $("#category").append(
                            "<option value='" + key + "'>" + value + "</option>"
                        );
                    });
                    $("#category").selectpicker("refresh");
                    var newVal = $("#category option:last").val();
                    $("#category").selectpicker("val", [newVal]);
                    $('#save-category').attr('disabled', 'false');
                },
            });
        },
        error: function (response) {
            $("#category_model").modal("toggle");
            toastr.error("Error! Please try again");
            $("[name='category_title']").val("");
            $('#save-category').attr('disabled', 'false');
        },
    });
});
