function calculateTicketPrice(ticket) {
    var basePrice = ticket.find(".base-price");
    var serviceCharges = ticket.find(".service-charges");

    var serviceChargesType = ticket.find(".service-charges-type").val();
    ticket.find(".difference").text("");
    ticket.find(".ticket-value-difference").text("");
    let total_tax = 0;
    let basePriceValue = parseFloat(basePrice.val()) || 0;
    let total = basePriceValue;
    let serviceChargesValue = parseFloat(serviceCharges.val()) || 0;

    // console.log(serviceChargesValue);
    let tax_value = ticket
        .find(".tax-value")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();

    let tax_type = ticket
        .find(".tax-type")
        .map((_, el) => {
            return el.value;
        })
        .get();

    for (let index = 0; index < tax_value.length; index++) {
        if (tax_type[index] === "%") {
            if (tax_value[index] >= 100) {
                ticket.find(".tax-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_tax += (tax_value[index] * total) / 100;
            }
        } else {
            total_tax += tax_value[index];
        }
    }
    total = total + total_tax;
    if (serviceChargesType == "%") {
        if (serviceChargesValue >= 100) {
            serviceCharges.val(0);
            toastr.error("Percentage value should be less than 100");
            total = basePriceValue;
        } else {
            totalServiceCharges = (basePriceValue * serviceChargesValue) / 100;
            total = total + totalServiceCharges;
        }
    } else {
        total = total + serviceChargesValue;
    }

    return {
        total: total,
        total_tax: total_tax,
    };
}

function calculateTicketValue(ticket) {
    var basePrice = ticket.find(".base-price");

    let ticket_value = 0;
    let total_tax = 0;
    let basePriceValue = parseFloat(basePrice.val()) || 0;

    // console.log(serviceChargesValue);
    let tax_value = ticket
        .find(".tax-value")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();

    let tax_type = ticket
        .find(".tax-type")
        .map((_, el) => {
            return el.value;
        })
        .get();

    for (let index = 0; index < tax_value.length; index++) {
        if (tax_type[index] === "%") {
            if (tax_value[index] >= 100) {
                ticket.find(".tax-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_tax += (tax_value[index] * basePriceValue) / 100;
            }
        } else {
            total_tax += tax_value[index];
        }
    }

    let airlineDiscount = calculateAirlineDiscount(ticket);

    // airlineDiscount;
    ticket_value = basePriceValue + total_tax - airlineDiscount;

    return ticket_value;
}

function serviceCharges() {
    let ticket_price = $(".base-price")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();
    let service_charges = $(".service-charges")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();

    let service_charges_type = $(".service-charges-type")
        .map((_, el) => {
            return el.value;
        })
        .get();

    let total_service_charges = 0;
    let ticket_service_charges = 0;
    for (let index = 0; index < service_charges.length; index++) {
        if (service_charges_type[index] === "%") {
            if (service_charges[index] >= 100) {
                $(".service-charges").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
                $(".service-charges-value").eq(index).text(0);
            } else {
                total_service_charges +=
                    (ticket_price[index] * service_charges[index]) / 100;

                ticket_service_charges =
                    (ticket_price[index] * service_charges[index]) / 100;
                $(".service-charges-value")
                    .eq(index)
                    .text(ticket_service_charges.toFixed(2));
            }
        } else {
            total_service_charges =
                total_service_charges + service_charges[index];

            ticket_service_charges = service_charges[index];
            $(".service-charges-value")
                .eq(index)
                .text(ticket_service_charges.toFixed(2));
        }
    }
    return total_service_charges;
}

function serviceCharges_airlineDiscount() {
    let airline_discount = $(".airline-discount-value")
        .map((_, el) => {
            if (el.innerText === "") return parseFloat(0);

            return parseFloat(el.innerText);
        })
        .get();
    airline_discount = airline_discount.reduce((a, b) => a + b);

    return serviceCharges() + airline_discount;
}

function calculateAirlineDiscount(ticket) {
    var basePrice = ticket.find(".base-price");
    let basePriceValue = parseFloat(basePrice.val()) || 0;
    let total;
    if (ticket.find(".airline-discount-field").is(":visible")) {
        var airlineDiscount = ticket.find(".airline-discount");
        var airlineDiscountType = ticket.find(".airline-discount-type").val();
        let airlineDiscountValue = parseFloat(airlineDiscount.val()) || 0;
        if (airlineDiscountType == "%") {
            if (airlineDiscountValue >= 100) {
                airlineDiscount.val(0);
                toastr.error("Percentage value should be less than 100");
                total = 0;
            } else {
                total = (basePriceValue * airlineDiscountValue) / 100;
            }
        } else {
            total = airlineDiscountValue;
        }
    } else {
        total = 0;
    }
    ticket.find(".airline-discount-value").text(total.toFixed(2));
    return total;
}

function calculateTotalTicketPrice() {
    let total = $(".total-ticket-value")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();

    let totalTicketPrice = total.reduce((a, b) => a + b);
    return {
        totalTicketPrice: totalTicketPrice,
    };
}

function calculateDiscount() {
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
    let total_discount = 0;
    for (let index = 0; index < discount_value.length; index++) {
        if (discount_type[index] === "%") {
            if (discount_value[index] >= 100) {
                $(".discount-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_discount += (discount_value[index] * total_income) / 100;
            }
        } else {
            total_discount += discount_value[index];
        }
    }
    return total_discount;
}
function calculateCommission() {
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

    let total_income = serviceCharges_airlineDiscount() - calculateDiscount();
    let total_commission = 0;
    for (let index = 0; index < commission_value.length; index++) {
        if (commission_type[index] === "%") {
            if (commission_value[index] >= 100) {
                $(".discount-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_commission +=
                    (commission_value[index] * total_income) / 100;
            }
        } else {
            total_commission += commission_value[index];
        }
    }

    return total_commission;
}

function calculateTotalIncome() {
    let totalIncome = serviceCharges_airlineDiscount();
    let total_discount = calculateDiscount();
    let total_commission = calculateCommission();
    let income = totalIncome - total_discount;
    income = income - total_commission;
    return income;
}

function showTicketPrice(ticket) {
    // console.log(calculateTicketPrice(ticket));
    let total = calculateTicketPrice(ticket).total;
    ticket.find(".total-ticket-value").val(total.toFixed(2));
    ticket.find(".total-ticket-label").text(total.toFixed(2));
    calculateAirlineDiscount(ticket);
    let ticket_value = calculateTicketValue(ticket);
    ticket.find(".ticket-value").val(ticket_value.toFixed(2));
}

function calculateRecievable() {
    let total_discount = calculateDiscount();
    let recievable = calculateTotalTicketPrice().totalTicketPrice;
    return recievable - total_discount;
}
function calculatePayable() {
    let ticketCharges = calculateTotalTicketPrice().totalTicketPrice;
    let income = serviceCharges_airlineDiscount();
    return ticketCharges - income;
}

function mainTicketCalculations() {
    let totalIncome = calculateTotalIncome();
    $(".total-income").val(totalIncome.toFixed(2));

    let totalDiscount = calculateDiscount();
    $("#total-discount-value").val(totalDiscount.toFixed(2));
    $("#total-discount-label").text(totalDiscount.toFixed(2));

    let totalCommission = calculateCommission();
    $("#total-commission-value").val(totalCommission.toFixed(2));
    $("#total-commission-label").text(totalCommission.toFixed(2));

    $(".ticket-income").text(serviceCharges_airlineDiscount());

    let totalRecievable = calculateRecievable();
    $(".recievable").val(totalRecievable.toFixed(2));
    $(".grand-total").val(totalRecievable.toFixed(2));

    let payableToAirline = calculatePayable();
    let totalPayable = payableToAirline + totalCommission;
    $(".payable-to-airline").val(payableToAirline.toFixed(2));
    $(".other-payable").val(totalCommission.toFixed(2));
    $(".total-payable").val(totalPayable.toFixed(2));

    let change_back = parseFloat($(".amount-paid").val()) - totalRecievable;
    $(".change-back").val(change_back.toFixed(2));
}

function calculateTotalTaxValue() {
    let total_tax = 0;
    $(".ticket-repeater-item").each(function (ticket) {
        let basePrice = $(this).find(".base-price").val();
        let ticket_tax = 0;
        let tax_value = $(this)
            .find(".tax-value")
            .map((_, el) => {
                if (el.value === "") return parseFloat(0);
                return parseFloat(el.value);
            })
            .get();
        let tax_type = $(this)
            .find(".tax-type")
            .map((_, el) => {
                return el.value;
            })
            .get();
        for (let index = 0; index < tax_value.length; index++) {
            if (tax_type[index] === "%") {
                if (tax_value[index] >= 100) {
                    $(this).find(".tax-value").eq(index).val(0);
                    toastr.error("Percentage value should be less than 100");
                } else {
                    ticket_tax += (tax_value[index] * basePrice) / 100;
                }
            } else {
                ticket_tax += tax_value[index];
            }
        }
        total_tax += ticket_tax;
    });
    return total_tax;
}

$(document).on("keyup", ".base-price", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$(document).on("keyup", ".service-charges", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$(document).on("change", ".service-charges-type", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});
$(document).on("keyup", ".airline-discount", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$(document).on("change", ".airline-discount-type", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$(document).on("change", ".tax-type", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});

$(document).on("keyup", ".tax-value", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});
$(document).on("keyup", ".discount-value", function () {
    mainTicketCalculations();
});
$(document).on("change", ".discount-type", function () {
    mainTicketCalculations();
});
$(document).on("keyup", ".commission-value", function () {
    mainTicketCalculations();
});
$(document).on("change", ".commission-type", function () {
    mainTicketCalculations();
});
$(document).on("keyup", ".total-ticket-value", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    total = calculateTicketPrice(ticket).total;
    ticket
        .find(".difference")
        .text("Difference: " + (total - $(this).val()).toFixed(2));
});
$(document).on("keyup", ".ticket-value", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    total = calculateTicketValue(ticket);
    ticket
        .find(".ticket-value-difference")
        .text("Difference: " + (total - $(this).val()).toFixed(2));
});
$(document).on("focusout", ".total-ticket-value", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});
$(document).on("focusout", ".ticket-value", function () {
    ticket = $(this).closest(".ticket-repeater-item");
    showTicketPrice(ticket);
    mainTicketCalculations();
});
$(document).on("keyup", ".amount-paid", function () {
    let recievable = calculateRecievable();
    let change_back = parseFloat($(this).val()) - recievable;
    $(".change-back").val(change_back.toFixed(2));
});
