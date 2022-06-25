function getPlanData(plan) {
    if (plan.val() == "" || $("#promo_key").val() == "") {
        $("#apply_promo").attr("disabled", true);
    } else {
        $("#apply_promo").attr("disabled", false);
    }

    if (plan.val() == "") {
        $("#total-bill").val(0);
        $("#paid-bill").val(0);
    } else {
        var id = plan.val();

        $.ajax({
            type: "GET",
            url: "/subscription-plan/" + id,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $("#total-bill").val(response.plan_amount);
                $("#paid-bill").val(response.plan_amount);
                $("#discount-amount").val(0);
            },
        });
    }
}
function selectPlan(id) {
    $(".plans").removeClass("border border-primary shadow shadow-sm");
    $("#plan" + id).addClass("border border-primary shadow shadow-sm");
    $("#subscription-plan").selectpicker();
    $("#subscription-plan").selectpicker("val", [id]);
    getPlanData($("#subscription-plan"));
}

function addLoader() {
    $("#subscription_modal > .modal-dialog > .modal-content").addClass(
        "overlay overlay-block"
    );
    $(
        "#subscription_modal > .modal-dialog > .modal-content > .overlay-layer"
    ).html('<div class="spinner spinner-primary"></div>');
}

function removeLoader() {
    $("#subscription_modal > .modal-dialog > .modal-content").removeClass(
        "overlay overlay-block"
    );
    $(
        "#subscription_modal > .modal-dialog > .modal-content > .overlay-layer"
    ).html("");
}

$("#subscription-plan").change(function () {
    let plan_id = $(this).val();
    $(".plans").removeClass("border border-primary shadow shadow-sm");
    $("#plan" + plan_id).addClass("border border-primary shadow shadow-sm");
    getPlanData($("#subscription-plan"));
});
$(function () {
    removeLoader();
    $("#sub-msg").fadeIn();
    $("#sub-msg").css("display", "flex");
});

$("#btn-subscribe").on("click", () => {
    addLoader();
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr("content");
    let payment_method = $("select[name=payment_method]").val();
    let plan_id = $("select[name=plan_id]").val();
    let total_bill = $("#total-bill").val();
    let promo_code = $("input[name=promo_key]").val();
    let paid_bill = $("input[name=paid_bill]").val();
    let discount_amount = $("input[name=discount_amount]").val();
    // console.log(payment_method_id);
    // if (payment_method_id == null) {
    //     toastr.error("Please select payment method");
    //     return false;
    // }
    $.ajax({
        url: "/subscription/create",
        type: "POST",
        data: {
            _token: _token,
            payment_method: payment_method,
            plan_id: plan_id,
            total_bill: total_bill,
            promo_code: promo_code,
            paid_bill: paid_bill,
            discount_amount: discount_amount,
        },
        complete: function () {
            removeLoader();
        },
        success: function (response) {
            $("#plan_form").removeClass("d-block");
            $("#plan_form").addClass("d-none");
            $("#success_msg").removeClass("d-none");
            $("#success_msg").addClass("d-block");
        },
        error: function (response) {
            if (response.responseJSON.errors.hasOwnProperty("plan_id")) {
                toastr.error(response.responseJSON.errors.plan_id[0]);
                return false;
            }
            if (response.responseJSON.errors.hasOwnProperty("payment_method")) {
                toastr.error(response.responseJSON.errors.payment_method[0]);
                return false;
            }

            // if (response.status == 422) {
            //     toastr.error(response.responseJSON.errors?.plan_id[0]);
            //     toastr.error(
            //         response.responseJSON.errors.payment_method_id[0]
            //     );
            //     return false;
            // }
            // console.log(response.status);
            // console.log(response.responseJSON.errors.plan_id[0]);
            $("#company_model").modal("toggle");
            $("#save-company").attr("disabled", false);
            toastr.error("Error! Please try again");
            $("[name='company_title']").val("");
            $("#supplier").selectpicker("refresh");
            $("#supplier").selectpicker("val", "");
        },
    });
});

$("#subscription_modal").on("hidden.bs.modal", function () {
    removeLoader();
    $("#subscription-plan").selectpicker();
    $("#subscription-plan").selectpicker("val", [""]);
    $("input[name=total_bill]").val("");
    $("input[name=promo_key]").val("");
    $("input[name=paid_bill]").val("");
    $("input[name=discount_amount]").val("");
    $(".plans").removeClass("border border-primary shadow shadow-sm");
});

$("#promo_key").on("keyup", () => {
    if ($("#promo_key").val() == "") {
        $("#apply_promo").attr("disabled", true);
    } else {
        $("#apply_promo").attr("disabled", false);
    }
});
$("#apply_promo").on("click", () => {
    var id = $("#subscription-plan").val();
    var promo_key = $("#promo_key").val();
    $.ajax({
        type: "GET",
        url: "/get-promo/" + id + "/" + promo_key,
        dataType: "json",
        success: function (response) {
            promo_type = response.promo_type;
            promo_value = response.promo_value;
            let total_bill = $("#total-bill");
            let paid_bill = $("#paid-bill");
            let discount_amount = 0;

            if (promo_type == "percentage") {
                discount_amount = (promo_value * total_bill.val()) / 100;
            } else if (promo_type == "fixed-value") {
                discount_amount = promo_value;
            }

            // if(discount_amount > total_bill.val()){
            //     toastr.error('Promo code is invalid.');
            //     return false;
            // }

            paid_bill.val(total_bill.val() - discount_amount);
            $("#discount_amount").val(discount_amount);
            toastr.success("Promo code applied successfully.");
        },
        error: function (response) {
            toastr.error("Promo code is invalid.");
            return false;
        },
    });
});
