function calculateTicketPrice() {
    let ticket_price = $(".basic-price")
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

    let total_ticket_price = 0;
    for (let index = 0; index < ticket_price.length; index++) {
        total_ticket_price = total_ticket_price + ticket_price[index];
    }
    let total_service_charges = 0;
    for (let index = 0; index < service_charges.length; index++) {
        if (service_charges_type[index] === "%") {
            if (service_charges[index] >= 100) {
                $(".service-charges").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_service_charges +=
                    (ticket_price[index] * service_charges[index]) / 100;
            }
        } else {
            total_service_charges =
                total_service_charges + service_charges[index];
        }
    }

    $(".total-income").val(total_service_charges.toFixed(2));

    return total_ticket_price + total_service_charges;
}

function totalTaxes() {
    let tax_value = $(".tax-value")
        .map((_, el) => {
            if (el.value === "") return parseFloat(0);

            return parseFloat(el.value);
        })
        .get();
    let tax_type = $(".tax-type")
        .map((_, el) => {
            return el.value;
        })
        .get();

    let ticket_price = calculateTicketPrice();
    let total_tax = 0;
    for (let index = 0; index < tax_value.length; index++) {
        if (tax_type[index] === "%") {
            if (tax_value[index] >= 100) {
                $(".tax-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_tax += (tax_value[index] * ticket_price) / 100;
            }
        } else {
            total_tax += tax_value[index];
        }
    }

    return total_tax;
}

function applyTaxes() {
    let ticket_price = calculateTicketPrice();
    let total_taxes = totalTaxes();
    let total_price_with_tax = ticket_price + total_taxes;
    return total_price_with_tax;
}

function showTaxes() {
    let total_tax = totalTaxes();
    $("#total-tax-value").val(total_tax.toFixed(2));
    $("#total-tax-label").text(total_tax.toFixed(2));
}

function totalDiscount() {
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

    let ticket_price = applyTaxes();
    let total_discount = 0;
    for (let index = 0; index < discount_value.length; index++) {
        if (discount_type[index] === "%") {
            if (discount_value[index] >= 100) {
                $(".discount-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_discount += (discount_value[index] * ticket_price) / 100;
            }
        } else {
            total_discount += discount_value[index];
        }
    }
    return total_discount;
}

function applyDiscount() {
    let total_price_with_tax = applyTaxes();
    let total_discount = totalDiscount();
    let total_price_with_tax_discount = total_price_with_tax - total_discount;
    return total_price_with_tax_discount;
}

function showDiscount() {
    let total_discount = totalDiscount();
    $("#total-discount-value").val(total_discount.toFixed(2));
    $("#total-discount-label").text(total_discount.toFixed(2));
}

function totalCommission() {
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

    let ticket_price = applyDiscount();
    let total_commission = 0;
    for (let index = 0; index < commission_value.length; index++) {
        if (commission_type[index] === "%") {
            if (commission_value[index] >= 100) {
                $(".commission-value").eq(index).val(0);
                toastr.error("Percentage value should be less than 100");
            } else {
                total_commission +=
                    (commission_value[index] * ticket_price) / 100;
            }
        } else {
            total_commission += commission_value[index];
        }
    }
    return total_commission;
}

function applyCommission() {
    let total_commission = totalCommission();
    let total_amount = applyDiscount();
    let total_price_with_tax_discount_commission =
        total_amount + total_commission;
    return total_price_with_tax_discount_commission;
}

function showCommission() {
    let total_commission = totalCommission();
    $("#total-commission-value").val(total_commission.toFixed(2));
    $("#total-commission-label").text(total_commission.toFixed(2));
}

$(document).on("keyup", ".tax-value", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("change", ".tax-type", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("keyup", ".discount-value", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("change", ".discount-type", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("keyup", ".commission-value", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("change", ".commission-type", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("keyup", ".basic-price", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("keyup", ".service-charges", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("change", ".service-charges-type", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});

$(document).on("click", "#add-ticket", function () {
    showTaxes();
    showDiscount();
    showCommission();
    $(".recievable").val(applyCommission().toFixed(2));
});
