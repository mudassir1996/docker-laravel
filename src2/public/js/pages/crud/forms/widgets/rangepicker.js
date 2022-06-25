// predefined ranges
var start = moment().subtract(29, "days");
var end = moment();

$("#daterangepicker").daterangepicker({
    buttonClasses: " btn",
    applyClass: "btn-primary",
    cancelClass: "btn-secondary",
    drops: "auto",
    showDropdowns: true,
    locale: {
        format: "YYYY/MM/DD",
    },
    ranges: {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
        "Last 7 Days": [moment().subtract(6, "days"), moment()],
        "Last 30 Days": [moment().subtract(29, "days"), moment()],
        "This Month": [moment().startOf("month"), moment().endOf("month")],
        "Last Month": [
            moment().subtract(1, "month").startOf("month"),
            moment().subtract(1, "month").endOf("month"),
        ],
    },
});

// $("#daterangepicker").on("apply.daterangepicker", function () {
//     $(this).val();
//     window.location.href =
//         "<?php route('cashbook.index', ['date_range'=>" +
//         $(this).val() +
//         "])?>";
//     // $("#date_range").val(start.format($("#buttonRangepicker span").text()));
//     // $("#filterForm").submit();
// });
