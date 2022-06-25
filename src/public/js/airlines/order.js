$().ready(() => {
    $(".ticket-number").inputmask("mask", {
        mask: "999-*{1,}",
        definitions: {
            "*": {
                validator: "[0-9A-Za-z-]",
            },
        },
    });
    $(".currency").inputmask("decimal", {
        rightAlignNumerics: false,
    });

    $(".kt_datepicker_3")
        .datepicker({
            todayBtn: "linked",
            format: "dd-mm-yyyy",
            autoclose: true,
            forceParse: false,
            orientation: "bottom left",
            todayHighlight: true,
        })
        .inputmask("datetime", {
            inputFormat: "dd-mm-yyyy",
            showMaskOnHover: true,
            showMaskOnFocus: true,
        });

    $(".invoice_date_picker")
        .datepicker({
            todayBtn: "linked",
            format: "dd-mm-yyyy",
            autoclose: true,
            orientation: "bottom left",
            todayHighlight: true,
        })
        .on("changeDate", (e) => {
            $(".invoice_date_picker_date").text(e.format());
            $("input[name='invoice_date']").val(e.format());
        });

    $(".select2").select2({
        placeholder: "Select",
        tags: true,
        width: "100%",
    });
});

$("#ticket_repeater").repeater({
    isFirstItemUndeletable: true,
    initEmpty: false,

    show: function show() {
        $(this).find(".pax-title").val($(".pax-title").first().val());
        $(this).find(".class").val($(".class").first().val());
        $(this).find(".flight").val($(".flight").first().val());
        $(this).find(".flight-number").val($(".flight-number").first().val());
        $(this).find(".departure-date").val($(".departure-date").first().val());
        $(this).find(".sector").val($(".sector").first().val());
        $(this).find(".route").val($(".route").first().val());
        $(this).find(".pnr").val($(".pnr").first().val());
        $(this).find(".gds-pnr").val($(".gds-pnr").first().val());
        $(this).find(".remarks").val($(".remarks").first().val());
        $(".kt_datepicker_3")
            .datepicker({
                todayBtn: "linked",
                format: "dd-mm-yyyy",
                autoclose: true,
                forceParse: false,
                orientation: "bottom left",
                todayHighlight: true,
            })
            .inputmask("datetime", {
                inputFormat: "dd-mm-yyyy",
                showMaskOnHover: true,
                showMaskOnFocus: true,
            });
        $(".ticket-number").inputmask("mask", {
            mask: "999-*{1,}",
            definitions: {
                "*": {
                    validator: "[0-9A-Za-z-]",
                },
            },
        });
        $(".currency").inputmask("decimal", {
            rightAlignNumerics: false,
        });
        fv.addField("[" + $(this).index() + "][pax_name]", notEmptyValidator);
        fv.addField(
            "[" + $(this).index() + "][departure_date]",
            dateTimeValidator
        );
        fv.addField("[" + $(this).index() + "][class]", notEmptyValidator);
        fv.addField(
            "[" + $(this).index() + "][ticket_number]",
            notEmptyValidator
        );
        fv.addField(
            "[" + $(this).index() + "][flight_number]",
            notEmptyValidator
        );
        fv.addField("[" + $(this).index() + "][sector]", notEmptyValidator);
        fv.addField("[" + $(this).index() + "][pnr]", notEmptyValidator);
        fv.addField("[" + $(this).index() + "][gds_pnr]", notEmptyValidator);
        $(this).show();
    },
    hide: function hide(deleteElement) {
        var repeater = $(this).siblings(".main-ticket-item");
        var ticket_detail = $("#ticket-details").children().eq($(this).index());
        ticket_detail.find(".remove-tax-detail").trigger("click");

        let mainTicketLabel = repeater.find(".main-ticket-title");
        mainTicketLabel.each(function (i) {
            $(this).text("Ticket " + (i + 1));
        });

        // fv.removeField(
        //     "[" + $(this).index() + "][pax_name]",
        //     notEmptyValidator
        // );
        // fv.removeField("[" + $(this).index() + "][class]", notEmptyValidator);
        // fv.removeField(
        //     "[" + $(this).index() + "][ticket_number]",
        //     notEmptyValidator
        // );
        // fv.removeField(
        //     "[" + $(this).index() + "][flight_number]",
        //     notEmptyValidator
        // );
        // fv.removeField("[" + $(this).index() + "][sector]", notEmptyValidator);
        // fv.removeField("[" + $(this).index() + "][pnr]", notEmptyValidator);
        // fv.removeField("[" + $(this).index() + "][gds_pnr]", notEmptyValidator);
        $(this).hide(deleteElement);
    },
});

$("#discount_repeater").repeater({
    show: function show() {
        $(".select2").select2({
            tags: true,
            width: "100%",
            placeholder: "Select",
        });
        $(".currency").inputmask("decimal", {
            rightAlignNumerics: false,
        });
        var collapseBtn = $(this).find(".discount-collapse-btn");
        var collapseDiv = $(this).find(".discount-collapse");
        collapseBtn.attr("data-target", "#discount_" + Date.now());
        collapseDiv.attr("id", "discount_" + Date.now());
        $(this)
            .find(".discount-label")
            .text("Discount " + ($(this).index() + 1));

        $(this).fadeIn();
    },
    hide: function hide(deleteElement) {
        var repeater = $(this).siblings(".discount-repeater-item");
        let taxLabel = repeater.find(".discount-label");
        taxLabel.each(function (i) {
            $(this).text("Discount " + (i + 1));
        });
        $(this).fadeOut(deleteElement);
    },
});

$("#commission_repeater").repeater({
    show: function show() {
        $(".select2").select2({
            tags: true,
            width: "100%",
            placeholder: "Select",
        });
        $(".currency").inputmask("decimal", {
            rightAlignNumerics: false,
        });
        var collapseBtn = $(this).find(".commission-collapse-btn");
        var collapseDiv = $(this).find(".commission-collapse");
        collapseBtn.attr("data-target", "#commission" + Date.now());
        collapseDiv.attr("id", "commission" + Date.now());
        $(this)
            .find(".commission-label")
            .text("Commission " + ($(this).index() + 1));

        $(this).fadeIn();
    },
    hide: function hide(deleteElement) {
        var repeater = $(this).siblings(".commission-repeater-item");
        let taxLabel = repeater.find(".commission-label");
        taxLabel.each(function (i) {
            $(this).text("Commission " + (i + 1));
        });
        $(this).fadeOut(deleteElement);
    },
});

$("#ticket-add").click(() => {
    $(".add-tax-detail").trigger("click");
});

function addClient() {
    let _token = $('meta[name="csrf-token"]').attr("content");
    let client_title = $("input[name=client_title]").val();
    let client_phone = $("input[name=client_phone]").val();
    $("#save-client").attr("disabled", true);
    $.ajax({
        url: ADD_PARTY_URL,
        type: "POST",
        data: {
            party_title: client_title,
            party_phone: client_phone,
            _token: _token,
        },
        success: function (response) {
            $("#add-client").modal("toggle");

            toastr.success("Client Added");
            $("[name='client_title']").val("");
            $("[name='client_phone']").val("");

            $.ajax({
                url: GET_PARTY_URL + "?id=" + response,
                type: "Get",
                success: function (res) {
                    $("#save-client").attr("disabled", false);
                    $("#client").empty();
                    $.each(res, function (key, value) {
                        $("#client").append(
                            "<option value='" + key + "'>" + value + "</option>"
                        );
                    });
                    $("#client").selectpicker("refresh");
                    var newVal = $("#client option:last").val();
                    $("#client").selectpicker("val", [newVal]);
                },
            });
        },
        error: function (response) {
            var error_text = response.responseJSON.message;
            $("#save-client").attr("disabled", false);
            toastr.error(error_text);
        },
    });
}
function addAgent() {
    let _token = $('meta[name="csrf-token"]').attr("content");
    let agent_title = $("input[name=agent_title]").val();
    let agent_phone = $("input[name=agent_phone]").val();
    $("#save-agent").attr("disabled", true);
    $.ajax({
        url: ADD_PARTY_URL,
        type: "POST",
        data: {
            party_title: agent_title,
            party_phone: agent_phone,
            _token: _token,
        },
        success: function (response) {
            $("#add-agent").modal("toggle");

            toastr.success("Agent Added");
            $("[name='agent_title']").val("");
            $("[name='agent_phone']").val("");

            $.ajax({
                url: GET_PARTY_URL + "?id=" + response,
                type: "Get",
                success: function (res) {
                    $("#save-agent").attr("disabled", false);
                    $("#agent").empty();
                    $.each(res, function (key, value) {
                        $("#agent").append(
                            "<option value='" + key + "'>" + value + "</option>"
                        );
                    });
                    $("#agent").selectpicker("refresh");
                    var newVal = $("#agent option:last").val();
                    $("#agent").selectpicker("val", [newVal]);
                    $("#agent").trigger("change");
                },
            });
        },
        error: function (response) {
            var error_text = response.responseJSON.message;
            $("#save-agent").attr("disabled", false);
            toastr.error(error_text);
        },
    });
}

function getTaxData(field) {
    $.ajax({
        url: GET_TAX_URL + "?id=" + field.val(),
        type: "Get",
        success: function (res) {
            var tax_type = res.tax_type;
            var tax_value = res.tax_value;
            field
                .parent()
                .siblings()
                .eq(0)
                .children()
                .children(".tax-value")
                .val(tax_value);
            if (tax_type == "value") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".tax-type")
                    .val("PKR");
            } else if (tax_type == "percentage") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".tax-type")
                    .val("%");
            } else {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".tax-type")
                    .val("PKR");
            }
            ticket = $(field).closest(".ticket-repeater-item");
            showTicketPrice(ticket);
            mainTicketCalculations();
        },
    });
}

function getDiscountData(field) {
    $.ajax({
        url: GET_DISCOUNT_URL + "?id=" + field.val(),
        type: "Get",
        success: function (res) {
            var discount_type = res.discount_type;
            var discount_value = res.discount_value;
            field
                .parent()
                .siblings()
                .eq(0)
                .children()
                .children(".discount-value")
                .val(discount_value);
            if (discount_type == "value") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".discount-type")
                    .val("PKR");
            } else if (discount_type == "percentage") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".discount-type")
                    .val("%");
            } else {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".discount-type")
                    .val("PKR");
            }
            mainTicketCalculations();
        },
    });
}

function getCommissionData(field) {
    $.ajax({
        url: GET_COMMISSION_URL + "?id=" + field.val(),
        type: "Get",
        success: function (res) {
            var commission_type = res.commission_type;
            var commission_value = res.commission_value;
            field
                .parent()
                .siblings()
                .eq(0)
                .children()
                .children(".commission-value")
                .val(commission_value);
            if (commission_type == "value") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".commission-type")
                    .val("PKR");
            } else if (commission_type == "percentage") {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".commission-type")
                    .val("%");
            } else {
                field
                    .parent()
                    .siblings()
                    .eq(0)
                    .children()
                    .children(".commission-type")
                    .val("PKR");
            }
            mainTicketCalculations();
        },
    });
}

$("#save-client").on("click", function (event) {
    addClient();
});
$("#save-agent").on("click", function (event) {
    addAgent();
});

$(document).on("change", ".tax-title", function () {
    getTaxData($(this));
});

$(document).on("change", ".discount-title", function () {
    getDiscountData($(this));
});

$(document).on("change", ".commission-title", function () {
    getCommissionData($(this));
});

var $repeater = $("#kt_docs_repeater_nested").repeater({
    repeaters: [
        {
            selector: ".inner-repeater",
            show: function () {
                $(".select2").select2({
                    tags: true,
                    width: "100%",
                    placeholder: "Select",
                });

                $(".currency").inputmask("decimal", {
                    rightAlignNumerics: false,
                });
                $(this).find(".tax-type").val("PKR");
                var collapseBtn = $(this).find(".tax-collapse-btn");
                var collapseDiv = $(this).find(".tax-collapse");
                collapseBtn.attr("data-target", "#tax_" + Date.now());
                collapseDiv.attr("id", "tax_" + Date.now());
                $(this)
                    .find(".tax-label")
                    .text("Tax " + ($(this).index() + 1));
                $(this).fadeIn();
                // ticket_details[0][ticket_taxes][0][tax_value];
            },

            hide: function (deleteElement) {
                var repeater = $(this).siblings(".tax-repeater-item");
                let taxLabel = repeater.find(".tax-label");
                taxLabel.each(function (i) {
                    $(this).text("Tax " + (i + 1));
                });
                ticket = $(this).closest(".ticket-repeater-item");
                setTimeout(
                    function () {
                        showTicketPrice(ticket);
                        mainTicketCalculations();
                    },
                    500,
                    ticket
                );
                $(this).fadeOut(deleteElement);
            },
        },
    ],

    show: function () {
        if ($(".airline-discount-field").is(":visible")) {
            $(this).find(".airline-discount-field").css("display", "flex");
            $(this)
                .find(".airline-discount")
                .val($(".airline-discount").first().val());
            $(this)
                .find(".airline-discount-type")
                .val($(".airline-discount-type").first().val());
        }
        $(".select2").select2({
            tags: true,
            width: "100%",
            placeholder: "Select",
        });

        var tax_title = $(this).find(".tax-title");
        $(".ticket-repeater-item")
            .eq(0)
            .find(".tax-title")
            .each(function (i) {
                tax_title.eq(i).val($(this).val()).trigger("change");
            });

        var tax_val = $(this).find(".tax-value");
        $(".ticket-repeater-item")
            .eq(0)
            .find(".tax-value")
            .each(function (i) {
                tax_val.eq(i).val($(this).val());
            });

        $(".currency").inputmask("decimal", {
            rightAlignNumerics: false,
        });
        let total_tickets = $("#ticket-details").children("div").length;
        $(".remove-tax-detail")
            .eq(total_tickets - 1)
            .attr("data-ticket-id", total_tickets);

        $(".ticket-title").each(function (i) {
            $(this).text("Ticket " + (i + 1));
        });
        $(".main-ticket-title").each(function (i) {
            $(this).text("Ticket " + (i + 1));
        });

        $(this).find(".base-price").val($(".base-price").first().val());
        $(this)
            .find(".service-charges")
            .val($(".service-charges").first().val());
        $(this)
            .find(".service-charges-type")
            .val($(".service-charges-type").first().val());
        ticket = $(this).closest(".ticket-repeater-item");
        setTimeout(
            function () {
                showTicketPrice(ticket);
                mainTicketCalculations();
            },
            300,
            ticket
        );
        fv.addField(
            "ticket_details[" + $(this).index() + "][base_price]",
            notEmptyValidator
        );
        $(this).fadeIn();
    },

    hide: function (deleteElement) {
        var repeater = $(this).siblings(".ticket-repeater-item");
        let ticketLabel = repeater.find(".ticket-title");
        ticketLabel.each(function (i) {
            $(this).text("Ticket " + (i + 1));
        });

        ticket = $(this).closest(".ticket-repeater-item");
        setTimeout(
            function () {
                showTicketPrice(ticket);
                mainTicketCalculations();
            },
            500,
            ticket
        );
        // console.log($(this).index());
        // fv.removeField(
        //     "ticket_details[" + $(this).index() + "][base_price]",
        //     notEmptyValidator
        // );
        $(this).fadeOut(deleteElement);
    },
});

$(".tax-collapse-btn").on("click", function () {
    $(this).find("i").toggleClass("fa-rotate-180");
});

$("#add-discount").click(function () {
    $("#discount").toggle();
    $("#add-discount").toggle();
    $("#remove-discount").toggle();
    $(".discount-title").val("").trigger("change");
    mainTicketCalculations();
});
$("#remove-discount").click(function () {
    $("#discount").toggle();
    $("#add-discount").toggle();
    $("#remove-discount").toggle();
    $(".discount-title").val("").trigger("change");
    $(".discount-desciption").val("");
    mainTicketCalculations();
});

$("#add-commission").click(function () {
    $("#commission").toggle();
    $("#add-commission").toggle();
    $("#remove-commission").toggle();
    mainTicketCalculations();
});
$("#remove-commission").click(function () {
    $("#commission").toggle();
    $("#add-commission").toggle();
    $("#remove-commission").toggle();
    $(".commission-value").val("");
    mainTicketCalculations();
});
$(".payment-type").change(function () {
    let payment_value = $(this).find(":selected").val();
    if (payment_value == 1) {
        $("#payment_method").selectpicker("refresh");
        $(".payment-method-div").hide();
        $(".amount-paid").val("");
        $(".change-back").val("");
        fv.removeField("amount_paid");
    } else {
        fv.addField("amount_paid", notEmptyValidator);
        $(".change-back").val("");
        $(".payment-method-div").show();
        $("#payment_method").selectpicker("refresh");
    }
});

$(document).on("click", ".airline-discount-btn", function () {
    $(this).parents(".row").eq(0).find(".airline-discount-field").toggle();
    $(this).parents(".row").eq(0).find(".airline-discount").val(0);
    $(this).parents(".row").eq(0).find(".airline-discount-value").val(0);

    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$("#btn-submit").click((e) => {
    fv2.validate().then(function (status) {
        if (status == "Valid") {
            let commission_title = $("#commission_title").val();
            let commission_value = $("#commission_value").val();
            let commission_type = $("#commission_type").val();
            let party_id = $("#party_id").val();
            let commission_status = $("#commission_status").val();
            let commission_description = $("#commission_description").val();

            let _token = $('meta[name="csrf-token"]').attr("content");
            var data = {
                _token,
                commission_title,
                commission_value,
                commission_type,
                party_id,
                commission_status,
                commission_description,
            };

            $("#btn-submit").attr("disabled", true);
            $.ajax({
                url: ADD_COMMISSION_URL,
                type: "POST",
                data: {
                    _token,
                    commission_title,
                    commission_value,
                    commission_type,
                    party_id,
                    commission_status,
                    commission_description,
                },
                success: function (response) {
                    $("#commissionModal").modal("toggle");

                    toastr.success("Commission Added");
                    $("#commission_title").val("");
                    $("#commission_value").val("");
                    $("#commission_description").val("");

                    $.ajax({
                        url: GET_COMMISSION_URL + "?id=" + response,
                        type: "Get",
                        success: function (res) {
                            $("#btn-submit").attr("disabled", false);
                            $(".commission-title").each(function () {
                                $(this).append(
                                    "<option value='" +
                                        res.id +
                                        "'>" +
                                        res.commission_title +
                                        "</option>"
                                );
                            });
                        },
                    });
                },
                error: function (response) {
                    $("#btn-submit").attr("disabled", false);
                    toastr.error("Something went wrong!");
                },
            });
        }
    });
});

$("#commissionModalClose").click(function () {
    $("#commissionModal").modal("hide");
});
