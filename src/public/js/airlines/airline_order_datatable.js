// /******/
// (function (modules) {
//     // webpackBootstrap
//     /******/ // The module cache
//     /******/
//     var installedModules = {};
//     /******/
//     /******/ // The require function
//     /******/
//     function __webpack_require__(moduleId) {
//         /******/
//         /******/ // Check if module is in cache
//         /******/
//         if (installedModules[moduleId]) {
//             /******/
//             return installedModules[moduleId].exports;
//             /******/
//         }
//         /******/ // Create a new module (and put it into the cache)
//         /******/
//         var module = (installedModules[moduleId] = {
//             /******/
//             i: moduleId,
//             /******/
//             l: false,
//             /******/
//             exports: {},
//             /******/
//         });
//         /******/
//         /******/ // Execute the module function
//         /******/
//         modules[moduleId].call(
//             module.exports,
//             module,
//             module.exports,
//             __webpack_require__
//         );
//         /******/
//         /******/ // Flag the module as loaded
//         /******/
//         module.l = true;
//         /******/
//         /******/ // Return the exports of the module
//         /******/
//         return module.exports;
//         /******/
//     }
//     /******/
//     /******/
//     /******/ // expose the modules object (__webpack_modules__)
//     /******/
//     __webpack_require__.m = modules;
//     /******/
//     /******/ // expose the module cache
//     /******/
//     __webpack_require__.c = installedModules;
//     /******/
//     /******/ // define getter function for harmony exports
//     /******/
//     __webpack_require__.d = function (exports, name, getter) {
//         /******/
//         if (!__webpack_require__.o(exports, name)) {
//             /******/
//             Object.defineProperty(exports, name, {
//                 enumerable: true,
//                 get: getter,
//             });
//             /******/
//         }
//         /******/
//     };
//     /******/
//     /******/ // define __esModule on exports
//     /******/
//     __webpack_require__.r = function (exports) {
//         /******/
//         if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
//             /******/
//             Object.defineProperty(exports, Symbol.toStringTag, {
//                 value: "Module",
//             });
//             /******/
//         }
//         /******/
//         Object.defineProperty(exports, "__esModule", { value: true });
//         /******/
//     };
//     /******/
//     /******/ // create a fake namespace object
//     /******/ // mode & 1: value is a module id, require it
//     /******/ // mode & 2: merge all properties of value into the ns
//     /******/ // mode & 4: return value when already ns object
//     /******/ // mode & 8|1: behave like require
//     /******/
//     __webpack_require__.t = function (value, mode) {
//         /******/
//         if (mode & 1) value = __webpack_require__(value);
//         /******/
//         if (mode & 8) return value;
//         /******/
//         if (mode & 4 && typeof value === "object" && value && value.__esModule)
//             return value;
//         /******/
//         var ns = Object.create(null);
//         /******/
//         __webpack_require__.r(ns);
//         /******/
//         Object.defineProperty(ns, "default", {
//             enumerable: true,
//             value: value,
//         });
//         /******/
//         if (mode & 2 && typeof value != "string")
//             for (var key in value)
//                 __webpack_require__.d(
//                     ns,
//                     key,
//                     function (key) {
//                         return value[key];
//                     }.bind(null, key)
//                 );
//         /******/
//         return ns;
//         /******/
//     };
//     /******/
//     /******/ // getDefaultExport function for compatibility with non-harmony modules
//     /******/
//     __webpack_require__.n = function (module) {
//         /******/
//         var getter =
//             module && module.__esModule
//                 ? /******/
//                   function getDefault() {
//                       return module["default"];
//                   }
//                 : /******/
//                   function getModuleExports() {
//                       return module;
//                   };
//         /******/
//         __webpack_require__.d(getter, "a", getter);
//         /******/
//         return getter;
//         /******/
//     };
//     /******/
//     /******/ // Object.prototype.hasOwnProperty.call
//     /******/
//     __webpack_require__.o = function (object, property) {
//         return Object.prototype.hasOwnProperty.call(object, property);
//     };
//     /******/
//     /******/ // __webpack_public_path__
//     /******/
//     __webpack_require__.p = "/";
//     /******/
//     /******/
//     /******/ // Load entry module and return exports
//     /******/
//     return __webpack_require__((__webpack_require__.s = 29));
//     /******/
// })(
//     /************************************************************************/
//     /******/
//     {
//         /***/
//         "./resources/metronic/js/pages/crud/datatables/basic/paginations.js":
//             /*!**************************************************************************!*\
//       !*** ./resources/metronic/js/pages/crud/datatables/basic/paginations.js ***!
//       \**************************************************************************/
//             /*! no static exports found */
//             /***/
//             function (module, exports, __webpack_require__) {
//                 "use strict";

//                 /***/
//             },

//         /***/
//         29:
//             /*!********************************************************************************!*\
//       !*** multi ./resources/metronic/js/pages/crud/datatables/basic/paginations.js ***!
//       \********************************************************************************/
//             /*! no static exports found */
//             /***/
//             function (module, exports, __webpack_require__) {
//                 module.exports = __webpack_require__(
//                     /*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\datatables\basic\paginations.js */ "./resources/metronic/js/pages/crud/datatables/basic/paginations.js"
//                 );

//                 /***/
//             },

//         /******/
//     }
// );
const filterData = {
    orderId: "",
    ticketNumber: "",
    customerId: "",
    supplierId: "",
    payment_type_id: "",
    category_id: "",
};
const dataTable = () => {
    var table = $("#kt_datatable_airline_orders").DataTable({
        serverSide: true,
        processing: true,
        language: {
            processing: "Loading",
            zeroRecords: "No matching records found",
        },
        ajax: {
            url: "/api/airline-orders/json",
            dataSrc: "data",
            data: {
                orderId: filterData.orderId,
                ticketNumber: filterData.ticketNumber,
                customerId: filterData.customerId,
                supplierId: filterData.supplierId,
                payment_type_id: filterData.payment_type_id,
                category_id: filterData.category_id,
            },
        },
        columns: [
            {
                data: "customer_party",
            },
            {
                data: "supplier_party",
            },
            {
                data: "category_title",
            },
            {
                data: "total_recievable",
            },
            {
                data: "total_income",
            },
            {
                data: "status",
            },
            {
                data: "airline_payable",
            },
            {
                data: "other_payable",
            },
            {
                data: "total_payable",
            },
            {
                data: "tax_value",
            },
            {
                data: "discount_value",
            },
            {
                data: "comission_value",
            },
            {
                data: "amount_payable",
            },
            {
                data: "amount_paid",
            },
            {
                data: "change_back",
            },
            {
                data: "payment_type_title",
            },
            {
                data: "payment_method_title",
            },
            {
                data: "remarks",
            },
            {
                data: "order_completion_date",
            },
            {
                data: "processing_employee_name",
            },
            {
                data: "creater_employee_name",
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
        aaSorting: [],
        // order: [0, "desc"],

        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            {
                targets: -1,
                responsivePriority: 2,
                title: "Actions",
                orderable: false,
                width: "125px",
                render: function (data, type, full, meta) {
                    console.log(full);

                    return (
                        '<a href="airline-orders/' +
                        full.id +
                        '/edit" class="btn btn-icon btn-light btn-hover-secondary btn-sm mx-3" title="Refund order" data-toggle="tooltip">\
                                <span class="svg-icon svg-icon-md">\
                                    <?xml version="1.0" encoding="utf-8"?>\
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\
                                        viewBox="0 0 24 24"  width="24" height="24" style="enable-background:new 0 0 24 24;" xml:space="preserve">\
                                    <style type="text/css">\
                                        .st0{fill:none;}\
                                        .st1{opacity:0.3;fill-rule:evenodd;clip-rule:evenodd;enable-background:new    ;}\
                                        .st2{fill-rule:evenodd;clip-rule:evenodd;}\
                                    </style>\
                                    <g>\
                                        <rect class="st0" width="24" height="24"/>\
                                        <path class="st1" d="M12.3,5.9L12.3,5.9c0.4,0,0.7,0.3,0.7,0.7V8c0,0.4-0.3,0.7-0.7,0.7l0,0c-0.4,0-0.7-0.3-0.7-0.7V6.6\
                                            C11.7,6.2,12,5.9,12.3,5.9z"/>\
                                        <path class="st1" d="M12.3,15.4L12.3,15.4c0.4,0,0.7,0.3,0.7,0.7v2c0,0.4-0.3,0.7-0.7,0.7l0,0c-0.4,0-0.7-0.3-0.7-0.7v-2\
                                            C11.7,15.7,12,15.4,12.3,15.4z"/>\
                                        <path class="st2" d="M14.4,10c-0.2-0.2-0.4-0.4-0.7-0.6c-0.3-0.1-0.6-0.2-0.9-0.2c-0.1,0-0.3,0-0.4,0c-0.1,0-0.3,0.1-0.4,0.1\
                                            c-0.1,0.1-0.2,0.2-0.3,0.3s-0.1,0.3-0.1,0.4c0,0.2,0,0.3,0.1,0.4c0.1,0.1,0.2,0.2,0.3,0.3c0.1,0.1,0.3,0.1,0.4,0.2s0.4,0.1,0.6,0.2\
                                            c0.3,0.1,0.6,0.2,1,0.3c0.3,0.1,0.6,0.3,0.9,0.5s0.5,0.5,0.7,0.8c0.2,0.3,0.3,0.7,0.3,1.1c0,0.5-0.1,1-0.3,1.3S15,16,14.7,16.2\
                                            c-0.3,0.2-0.7,0.4-1.1,0.6c-0.4,0.1-0.8,0.2-1.3,0.2c-0.6,0-1.3-0.1-1.9-0.3c-0.6-0.2-1.1-0.5-1.5-1l1.4-1.5\
                                            c0.2,0.3,0.5,0.5,0.9,0.7c0.4,0.2,0.7,0.3,1.1,0.3c0.2,0,0.3,0,0.5-0.1c0.2,0,0.3-0.1,0.4-0.2c0.1-0.1,0.2-0.2,0.3-0.3\
                                            c0.1-0.1,0.1-0.3,0.1-0.5c0-0.2,0-0.3-0.1-0.4c-0.1-0.1-0.2-0.2-0.4-0.3c-0.2-0.1-0.4-0.2-0.6-0.3c-0.2-0.1-0.5-0.2-0.8-0.3\
                                            c-0.3-0.1-0.6-0.2-0.9-0.3c-0.3-0.1-0.5-0.3-0.7-0.5c-0.2-0.2-0.4-0.4-0.5-0.7s-0.2-0.6-0.2-1c0-0.5,0.1-0.9,0.3-1.3\
                                            s0.5-0.7,0.8-0.9c0.3-0.2,0.7-0.4,1.1-0.5s0.8-0.2,1.3-0.2c0.5,0,1,0.1,1.6,0.3c0.5,0.2,1,0.5,1.4,0.8L14.4,10z"/>\
                                        <path d="M7.9,6.2L9.1,7c0.1,0.1,0.2,0.2,0.2,0.3C9.4,7.6,9.3,8,8.9,8.1L4.7,9.5c-0.1,0-0.1,0-0.2,0c-0.3,0-0.6-0.3-0.6-0.6L3.8,4.5\
                                            c0-0.1,0-0.3,0.1-0.4C4.1,3.8,4.5,3.8,4.7,4l1,0.7c1.8-1.6,4.1-2.5,6.6-2.5c5.5,0,10,4.5,10,10s-4.5,10-10,10s-10-4.5-10-10h2.5\
                                            c0,4.1,3.4,7.5,7.5,7.5s7.5-3.4,7.5-7.5s-3.4-7.5-7.5-7.5C10.7,4.7,9.2,5.2,7.9,6.2z"/>\
                                    </g>\
                                    </svg>\
                                </span>\
                            </a>'
                    );
                    // <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                    //     <span class="svg-icon svg-icon-md">\
                    //         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                    //             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                    //                 <rect x="0" y="0" width="24" height="24"/>\
                    //                 <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                    //                 <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                    //             </g>\
                    //         </svg>\
                    //     </span>\
                    // </a>';
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
    filterData.customerId = $("#customerId").val();
    filterData.supplierId = $("#supplierId").val();
    filterData.payment_type_id = $("#payment_type_id").val();
    filterData.category_id = $("#category_id").val();
    let filterApplied = Object.keys(filterData).filter((key) => {
        return filterData[key] != "";
    }).length;

    if (filterApplied > 0) {
        $("#kt_datatable_airline_orders").DataTable().destroy();
        $("#kt_datatable_airline_orders").hide();
        dataTable();
        $("#kt_datatable_airline_orders").show();
        $(this)
            .parents(".dropdown")
            .find("button.dropdown-toggle")
            .dropdown("toggle");
        $(".filter-counter").text(filterApplied);
        $(".filter-counter").show();
    }
});
$("#clearFilter").click(function () {
    console.log($(".selectpicker").selectpicker("val", ""));
    $("#kt_datatable_airline_orders").DataTable().destroy();
    $("#kt_datatable_airline_orders").hide();
    filterData.orderId = "";
    filterData.ticketNumber = "";
    filterData.customerId = "";
    filterData.supplierId = "";
    filterData.payment_type_id = "";
    filterData.category_id = "";
    let filterApplied = Object.keys(filterData).filter((key) => {
        return filterData[key] != "";
    }).length;
    $(".filter-counter").text(filterApplied);
    $(".filter-counter").hide();
    dataTable();
    $("#kt_datatable_airline_orders").show();
    $(this)
        .parents(".dropdown")
        .find("button.dropdown-toggle")
        .dropdown("toggle");
});
