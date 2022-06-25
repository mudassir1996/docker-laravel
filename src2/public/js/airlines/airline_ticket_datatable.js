const filterData = {
    orderId: "",
    ticketNumber: "",
    paxName: "",
    flightNumber: "",
    depDate: "",
    // payment_type_id: "",
};
const dataTable = () => {
    var table = $("#kt_datatable_airline_tickets").DataTable({
        serverSide: true,
        processing: true,
        language: {
            processing: "Loading",
            zeroRecords: "No matching records found",
        },
        ajax: {
            url: "/api/airline-tickets/json",
            dataSrc: "data",
            data: {
                orderId: filterData.orderId,
                ticketNumber: filterData.ticketNumber,
                paxName: filterData.paxName,
                flightNumber: filterData.flightNumber,
                depDate: filterData.depDate,
                // payment_type_id: filterData.payment_type_id,
            },
        },
        columns: [
            {
                data: "airline_order_id",
            },
            {
                data: "pax_title",
            },
            {
                data: "pax_name",
            },
            {
                data: "ticket_class",
            },
            {
                data: "ticket_number",
            },
            {
                data: "flight_type",
            },
            {
                data: "flight_number",
            },
            {
                data: "departure_date",
            },
            {
                data: "sector",
            },
            {
                data: "route",
            },
            {
                data: "pnr",
            },
            {
                data: "gds_pnr",
            },
            {
                data: "remarks",
            },
            {
                data: "base_price",
            },
            {
                data: "airline_discount_value",
            },
            {
                data: "total_ticket_value",
            },
            {
                data: "service_charges_value",
            },
            {
                data: "total_tax_value",
            },
            {
                data: "total_amount",
            },
            {
                data: "created_at",
            },
            {
                data: "updated_at",
            },
        ],
        responsive: true,
        pagingType: "full_numbers",
        dom: "ltipr",
        order: [0, "desc"],

        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            {
                targets: [1, 2, 5, 9, 12],
                render: function (data) {
                    return data !== null
                        ? data.charAt(0).toUpperCase() + data.slice(1)
                        : data;
                },
            },
            {
                targets: 8,
                render: function (data) {
                    return data.toUpperCase();
                },
            },
        ],
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
    // KTDatatablesBasicPaginations.init((orderId = ""));
});
$("#filter").click(function () {
    filterData.orderId = $("#orderId").val();
    filterData.ticketNumber = $("#ticketNumber").val();
    filterData.paxName = $("#paxName").val();
    filterData.flightNumber = $("#flightNumber").val();
    filterData.depDate = $(".depDate").val();
    // filterData.payment_type_id = $("#payment_type_id").val();
    let filterApplied = Object.keys(filterData).filter((key) => {
        return filterData[key] != "";
    }).length;

    if (filterApplied > 0) {
        $("#kt_datatable_airline_tickets").DataTable().destroy();
        $("#kt_datatable_airline_tickets").hide();
        dataTable();
        $("#kt_datatable_airline_tickets").show();
    }
});
$("#clearFilter").click(function () {
    $("#kt_datatable_airline_tickets").DataTable().destroy();
    $("#kt_datatable_airline_tickets").hide();
    filterData.orderId = "";
    filterData.ticketNumber = "";
    filterData.paxName = "";
    filterData.flightNumber = "";
    filterData.depDate = "";
    dataTable();
    $("#kt_datatable_airline_tickets").show();
});
