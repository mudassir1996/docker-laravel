$("#select-all-products").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".products-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".products-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#products_selected").text($(".products").find(":checked").length);
});
$("#select-all-categories").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".categories-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".categories-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#categories_selected").text($(".categories").find(":checked").length);
});
$("#select-all-companies").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".companies-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".companies-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#companies_selected").text($(".companies").find(":checked").length);
});
$("#select-all-expense-categories").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".expense-categories-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".expense-categories-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#expense_categories_selected").text(
        $(".expense_categories").find(":checked").length
    );
});
$("#select-all-payment-methods").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".payment-method-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".payment-method-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#payment_methods_selected").text(
        $(".payment_methods").find(":checked").length
    );
});
$("#select-all-payment-types").click(function () {
    if ($(this).attr("data-checked") == 0) {
        $(".payment-type-check").prop("checked", true);
        $(this).attr("data-checked", 1);
        $(this).text("Deselect All");
    } else {
        $(".payment-type-check").prop("checked", false);
        $(this).attr("data-checked", 0);
        $(this).text("Select All");
    }
    $("#payment_types_selected").text(
        $(".payment_types").find(":checked").length
    );
});

$(document).on("click", function () {
    $("#categories_selected").text($(".categories").find(":checked").length);
    $("#companies_selected").text($(".companies").find(":checked").length);
    $("#products_selected").text($(".products").find(":checked").length);
    $("#expense_selected").text(
        $(".expense_categories").find(":checked").length
    );
    $("#payment_types_selected").text(
        $(".payment_types").find(":checked").length
    );
    // $("#payment_methods_selected").text(
    //     $(".payment_methods").find(":checked").length
    // );
});

$(".payment-method-check").change(function () {
    $("#payment_methods_selected").text(
        $(".payment_methods").find(":checked").length
    );
});
