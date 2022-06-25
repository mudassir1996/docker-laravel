const dataTable = () => {
    var table = $("#kt_datatable_payment_category").DataTable({
        responsive: true,
        pagingType: "full_numbers",
        dom: "tipr",
        aaSorting: [],

        columnDefs: [{ responsivePriority: 1, targets: 0 }],
    });
    return table;
};

// var KTDatatablesBasicPaginations = (function () {
//     var initTable1 = function initTable1(orderId) {
//         var table = $("#kt_datatable_airline_orders"); // begin first table
//     };

//     // function buttonsTrigger() {
//     //     $(".dt-buttons").hide();
//     //     $("#export_print").on("click", function (e) {
//     //         $(".buttons-print").click();
//     //     });

//     //     $("#export_copy").on("click", function (e) {
//     //         $(".buttons-copy").click();
//     //     });

//     //     $("#export_excel").on("click", function (e) {
//     //         $(".buttons-excel").click();
//     //     });

//     //     $("#export_csv").on("click", function (e) {
//     //         $(".buttons-csv").click();
//     //     });

//     //     $("#export_pdf").on("click", function (e) {
//     //         $(".buttons-pdf").click();
//     //     });
//     // }

//     return {
//         //main function to initiate the module
//         init: function init(orderId) {
//             initTable1(orderId);
//             // buttonsTrigger();
//         },
//     };
// })();

jQuery(document).ready(function () {
    dataTable();
});
