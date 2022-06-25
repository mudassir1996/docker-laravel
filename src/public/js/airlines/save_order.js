"use strict";

$("#save-order").click(function (e) {
    e.preventDefault();

    var _token = $('meta[name="csrf-token"]').attr("content");
    var orderData = {
        total_recievable: function () {
            return calculateRecievable().toFixed(2);
        },
        total_income: function () {
            return calculateTotalIncome().toFixed(2);
        },
        airline_payable: function () {
            return calculatePayable().toFixed(2);
        },
        comission_value: function () {
            return calculateCommission().toFixed(2);
        },
        total_payable: function () {
            let airlinePayable = calculatePayable().toFixed(2);
            let otherPayable = calculateCommission().toFixed(2);
            return parseFloat(airlinePayable) + parseFloat(otherPayable);
        },
        discount_value: function () {
            return calculateDiscount().toFixed(2);
        },
        other_payable: function () {
            return calculateCommission().toFixed(2);
        },
        amount_payable: function () {
            return calculateRecievable().toFixed(2);
        },
        customer_party_id: function () {
            return $("#client").val();
        },
        supplier_party_id: function () {
            return $("#agent").val();
        },
        category_id: function () {
            return $("#category_id").val();
        },
        status: function () {
            return $("#status").val();
        },
        payment_type: function () {
            return $("#payment_type").val();
        },
        payment_method_id: function () {
            var value = $("#payment_type").find(":selected").data("value");
            if (value == 1) {
                return "";
            } else {
                return $("#payment_method").val();
            }
        },
        tax_value: function () {
            return calculateTotalTaxValue().toFixed(2);
        },
        order_completion_date: function () {
            return $("#invoice_date").val();
        },
        amount_paid: function () {
            return $(".amount-paid").val();
        },
        change_back: function () {
            return $(".change-back").val();
        },
    };

    var discount_value_arr = [$(".discount-value").length - 1];
    var discount_percentage_arr = [$(".discount-value").length - 1];

    $(".discount-value").each(function (i) {
        let discount_value = $(".discount-value")
            .map((_, el) => {
                if (el.value === "") return parseFloat(0);
                return parseFloat(el.value);
            })
            .get();
        let discount_type = $(".discount-type")
            .map((_, el) => {
                return el.value;
            })
            .get();

        let total_income = serviceCharges_airlineDiscount();
        for (var index = 0; index < discount_value.length; index++) {
            if (discount_type[index] === "%") {
                discount_value_arr[index] = parseFloat(
                    (discount_value[index] * total_income) / 100
                ).toFixed(2);
                discount_percentage_arr[index] =
                    total_income > 0
                        ? parseFloat(discount_value[index]).toFixed(2)
                        : 0;
            } else {
                discount_value_arr[index] = parseFloat(
                    discount_value[index]
                ).toFixed(2);
                discount_percentage_arr[index] =
                    total_income > 0
                        ? parseFloat(
                              (discount_value[index] / total_income) * 100
                          ).toFixed(2)
                        : 0;
            }
        }
    });

    var discountDetails = {
        title: $(".discount-title")
            .map((_, el) => {
                let discount_title = $(el).find(":selected").text();
                return discount_title.trim();
            })
            .get(),
        description: $(".discount-description")
            .map((_, el) => {
                let discount_description = $(el).val();
                return discount_description.trim();
            })
            .get(),
        value: discount_value_arr,
        percentage: discount_percentage_arr,
        type: $(".discount-type")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
    };
    var commissionDetails = {
        title: $(".commission-title")
            .map((_, el) => {
                return $(el).find(":selected").text();
            })
            .get(),
        description: $(".commission-description")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        value: function () {
            let commission_value = $(".commission-value")
                .map((_, el) => {
                    if (el.value === "") return parseFloat(0);

                    return parseFloat(el.value);
                })
                .get();
            let commission_type = $(".commission-type")
                .map((_, el) => {
                    return el.value;
                })
                .get();

            let total_income = serviceCharges_airlineDiscount();
            let value = 0;

            return $(".commission-value")
                .map((_, el) => {
                    if (commission_type[_] === "%") {
                        parseFloat(
                            (value = (commission_value[_] * total_income) / 100)
                        ).toFixed(2);
                    } else {
                        value = parseFloat(commission_value[_]).toFixed(2);
                    }
                    return value;
                })
                .get();
        },
        percentage: function () {
            let commission_value = $(".commission-value")
                .map((_, el) => {
                    if (el.value === "") return parseFloat(0);

                    return parseFloat(el.value);
                })
                .get();
            let commission_type = $(".commission-type")
                .map((_, el) => {
                    return el.value;
                })
                .get();

            let total_income = serviceCharges_airlineDiscount();
            let percentage = 0;
            if (total_income > 0) {
                return $(".commission-value")
                    .map((_, el) => {
                        if (commission_type[_] === "%") {
                            percentage = parseFloat(
                                commission_value[_]
                            ).toFixed(2);
                        } else {
                            percentage = parseFloat(
                                (commission_value[_] / total_income) * 100
                            ).toFixed(2);
                        }
                        return percentage;
                    })
                    .get();
            }
            return 0;
        },
        type: $(".commission-type")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
    };
    //Get all ticket tax details
    var tax_title = [$(".ticket-repeater-item").length - 1];
    var tax_type = [$(".ticket-repeater-item").length - 1];
    var tax_value = [$(".ticket-repeater-item").length - 1];
    var tax_percentage = [$(".ticket-repeater-item").length - 1];
    var final_tax_value = [$(".ticket-repeater-item").length - 1];
    var tax_description = [$(".ticket-repeater-item").length - 1];
    $(".ticket-repeater-item").each(function (i) {
        //calling calculation functions again(extra)
        showTicketPrice($(this));
        mainTicketCalculations();
        tax_title[i] = $(this)
            .find(".tax-title")
            .filter(function (key, element) {
                return $(element).find(":selected").val() == "" ? false : true;
            })
            .map(function (_, el) {
                return $.trim($(el).find(":selected").text());
            })
            .get();
        tax_type[i] = $(this)
            .find(".tax-type")
            .map(function (_, el) {
                return $.trim($(el).find(":selected").val());
            })
            .get();
        tax_value[i] = $(this)
            .find(".tax-value")
            .filter(function (key, element) {
                return $(element).val() == "" ? false : true;
            })
            .map(function (_, el) {
                return $(el).val() != "" ? $(el).val() : 0;
            })
            .get();

        let basePriceValue = parseFloat(
            $(this).find(".base-price").val() == ""
                ? 0
                : $(this).find(".base-price").val()
        );

        let total = basePriceValue;
        let value = [];
        let percentage = [];
        for (let index = 0; index < tax_value[i].length; index++) {
            if (tax_type[i][index] === "%") {
                if (tax_value[i][index] >= 100) {
                    ticket.find(".tax-value").eq(index).val(0);
                    toastr.error("Percentage value should be less than 100");
                } else {
                    percentage[index] = parseFloat(tax_value[i][index]).toFixed(
                        2
                    );
                    value[index] = (
                        (tax_value[i][index] * total) /
                        100
                    ).toFixed(2);
                }
            } else {
                percentage[index] = (
                    (tax_value[i][index] / total) *
                    100
                ).toFixed(2);
                value[index] = parseFloat(tax_value[i][index]).toFixed(2);
            }
        }

        final_tax_value[i] = value;
        tax_percentage[i] = percentage;
        tax_description[i] = $(this)
            .find(".tax-description")
            .map(function (_, el) {
                return $(el).val();
            })
            .get();
    });

    //pass tax details to object
    var ticketTaxDetails = {
        tax_title: tax_title,
        tax_description: tax_description,
        tax_value: final_tax_value,
        tax_percentage: tax_percentage,
        tax_type: tax_type,
    };

    var airlineTicket = {
        pax_title: $(".pax-title")
            .map((_, el) => {
                return $(el).find(":selected").val();
            })
            .get(),
        pax_name: $(".pax-name")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        ticket_class: $(".class")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        flight_type: $(".flight")
            .map((_, el) => {
                return $(el).find(":selected").val();
            })
            .get(),
        ticket_number: $(".ticket-number")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        flight_number: $(".flight-number")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        departure_date: $(".departure-date")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        sector: $(".sector")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        route: $(".route")
            .map((_, el) => {
                return $(el).find(":selected").val();
            })
            .get(),
        pnr: $(".pnr")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        gds_pnr: $(".gds-pnr")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        remarks: $(".remarks")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        base_price: $(".base-price")
            .map((_, el) => {
                return $(el).val();
            })
            .get(),
        airline_discount_value: $(".ticket-repeater-item")
            .map(function (_, el) {
                return calculateAirlineDiscount($(el));
            })
            .get(),
        total_ticket_value: $(".ticket-repeater-item")
            .map(function (_, el) {
                return calculateTicketValue($(el));
            })
            .get(),
        total_tax_value: $(".ticket-repeater-item")
            .map(function (_, el) {
                return calculateTicketPrice($(el)).total_tax;
            })
            .get(),
        service_charges_value: $(".ticket-repeater-item")
            .map(function (_, el) {
                return serviceCharges();
            })
            .get(),
        total_amount: $(".total-ticket-value")
            .map((_, el) => {
                if (el.value === "") return parseFloat(0);
                return parseFloat(el.value);
            })
            .get(),
    };

    fv.validate().then(function (status) {
        if (status == "Valid") {
            if (
                $(".amount-paid").val() < calculateRecievable() &&
                $(".payment-type").find(":selected").val() == 0
            ) {
                Swal.fire({
                    text:
                        "Your paid amount is less than total recievable, remaining balance (" +
                        Math.abs(orderData.change_back()) +
                        ") will be debited to your account",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                }).then(function (result) {
                    if (result.isConfirmed) {
                        sendForm();
                    }
                });
            } else {
                console.log(JSON.stringify(commissionDetails));
                sendForm();
            }
        } else {
            Swal.fire({
                text: "Sorry, looks like there are some fields are missing, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light",
                },
            });
        }
    });

    function sendForm() {
        $("#orderForm").addClass("overlay overlay-block");
        $(".overlay-layer").css("display", "flex");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": _token,
            },
        });
        $.ajax({
            url: "/outlets/airline-orders",
            type: "POST",
            data: {
                orderData,
                airlineTicket,
                discountDetails,
                commissionDetails,
                ticketTaxDetails,
            },
            complete: function () {
                $("#orderForm").removeClass("overlay overlay-block");
                $(".overlay-layer").css("display", "none");
            },
            success: function (response) {
                console.log(response);
                // $("#invoiceModal").modal("toggle");
                toastr.success("Order added successfully!");
                location.reload();
            },
        });
    }
});
