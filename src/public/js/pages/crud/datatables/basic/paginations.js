/******/
(function (modules) {
    // webpackBootstrap
    /******/ // The module cache
    /******/
    var installedModules = {};
    /******/
    /******/ // The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/
        /******/ // Check if module is in cache
        /******/
        if (installedModules[moduleId]) {
            /******/
            return installedModules[moduleId].exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/
        var module = (installedModules[moduleId] = {
            /******/
            i: moduleId,
            /******/
            l: false,
            /******/
            exports: {},
            /******/
        });
        /******/
        /******/ // Execute the module function
        /******/
        modules[moduleId].call(
            module.exports,
            module,
            module.exports,
            __webpack_require__
        );
        /******/
        /******/ // Flag the module as loaded
        /******/
        module.l = true;
        /******/
        /******/ // Return the exports of the module
        /******/
        return module.exports;
        /******/
    }
    /******/
    /******/
    /******/ // expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/ // expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/ // define getter function for harmony exports
    /******/
    __webpack_require__.d = function (exports, name, getter) {
        /******/
        if (!__webpack_require__.o(exports, name)) {
            /******/
            Object.defineProperty(exports, name, {
                enumerable: true,
                get: getter,
            });
            /******/
        }
        /******/
    };
    /******/
    /******/ // define __esModule on exports
    /******/
    __webpack_require__.r = function (exports) {
        /******/
        if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
            /******/
            Object.defineProperty(exports, Symbol.toStringTag, {
                value: "Module",
            });
            /******/
        }
        /******/
        Object.defineProperty(exports, "__esModule", { value: true });
        /******/
    };
    /******/
    /******/ // create a fake namespace object
    /******/ // mode & 1: value is a module id, require it
    /******/ // mode & 2: merge all properties of value into the ns
    /******/ // mode & 4: return value when already ns object
    /******/ // mode & 8|1: behave like require
    /******/
    __webpack_require__.t = function (value, mode) {
        /******/
        if (mode & 1) value = __webpack_require__(value);
        /******/
        if (mode & 8) return value;
        /******/
        if (mode & 4 && typeof value === "object" && value && value.__esModule)
            return value;
        /******/
        var ns = Object.create(null);
        /******/
        __webpack_require__.r(ns);
        /******/
        Object.defineProperty(ns, "default", {
            enumerable: true,
            value: value,
        });
        /******/
        if (mode & 2 && typeof value != "string")
            for (var key in value)
                __webpack_require__.d(
                    ns,
                    key,
                    function (key) {
                        return value[key];
                    }.bind(null, key)
                );
        /******/
        return ns;
        /******/
    };
    /******/
    /******/ // getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function (module) {
        /******/
        var getter =
            module && module.__esModule
                ? /******/
                  function getDefault() {
                      return module["default"];
                  }
                : /******/
                  function getModuleExports() {
                      return module;
                  };
        /******/
        __webpack_require__.d(getter, "a", getter);
        /******/
        return getter;
        /******/
    };
    /******/
    /******/ // Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ // __webpack_public_path__
    /******/
    __webpack_require__.p = "/";
    /******/
    /******/
    /******/ // Load entry module and return exports
    /******/
    return __webpack_require__((__webpack_require__.s = 29));
    /******/
})(
    /************************************************************************/
    /******/
    {
        /***/
        "./resources/metronic/js/pages/crud/datatables/basic/paginations.js":
            /*!**************************************************************************!*\
      !*** ./resources/metronic/js/pages/crud/datatables/basic/paginations.js ***!
      \**************************************************************************/
            /*! no static exports found */
            /***/
            function (module, exports, __webpack_require__) {
                "use strict";
                var KTDatatablesBasicPaginations = (function () {
                    var initTable1 = function initTable1() {
                        var table = $("#kt_sales_table"); // begin first table

                        table.DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api()
                                    .columns(0)
                                    .every(function () {
                                        var that = this;
                                        $("#orderIdSearch").on(
                                            "keyup change clear",
                                            function () {
                                                console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(1)
                                    .every(function () {
                                        var that = this;
                                        $("#customerNameSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });

                                this.api()
                                    .columns(15)
                                    .every(function () {
                                        var that = this;
                                        $("#remarksSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                            },

                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Brtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                        title: "Sales Orders",
                                    },
                                    { extend: "copyHtml5" },
                                    { extend: "excelHtml5" },
                                    { extend: "csvHtml5" },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Sales Orders",
                                        footer: true,
                                        orientation: "landscape",
                                        pageSize: "LEGAL",
                                    },
                                ],
                            },

                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                {
                                    targets: 7,
                                    width: "75px",
                                    render: function render(
                                        data,
                                        type,
                                        full,
                                        meta
                                    ) {
                                        var status = {
                                            Active: {
                                                title: "Active",
                                                class: " label-light-success",
                                            },
                                            Inactive: {
                                                title: "Inactive",
                                                class: " label-light-danger",
                                            },
                                        };

                                        if (
                                            typeof status[data] === "undefined"
                                        ) {
                                            return data;
                                        }

                                        return (
                                            '<span class="label label-lg font-weight-bold' +
                                            status[data]["class"] +
                                            ' label-inline">' +
                                            status[data].title +
                                            "</span>"
                                        );
                                    },
                                },
                            ],
                        });
                    };
                    var initTable2 = function initTable2() {
                        var table = $("#kt_product_table"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                    },
                                    {
                                        extend: "copyHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "excelHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "csvHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "pdfHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                ],
                            },
                        });
                    };
                    var table = $("#kt_manage_products"); // begin first table
                    var initTable3 = function initTable3() {
                        table.DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api()
                                    .columns(1)
                                    .every(function () {
                                        var that = this;
                                        $("#productSearch").on(
                                            "keyup change clear",
                                            function () {
                                                console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(3)
                                    .every(function () {
                                        var that = this;
                                        $("#barcodeSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });

                                this.api()
                                    .columns(5)
                                    .every(function () {
                                        var that = this;
                                        // that.data().unique().sort().each(function(d, j) {
                                        //     $('#statusSearch').append('<option value="' + d + '">' + d + '</option>')
                                        // });

                                        $("#statusSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    if (this.value != "") {
                                                        that.search(
                                                            "^" +
                                                                this.value +
                                                                "$",
                                                            true,
                                                            false
                                                        ).draw();
                                                    } else {
                                                        that.search("").draw();
                                                    }
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(6)
                                    .every(function () {
                                        var that = this;
                                        that.data()
                                            .unique()
                                            .sort()
                                            .each(function (d, j) {
                                                $("#categorySearch").append(
                                                    '<option value="' +
                                                        d +
                                                        '">' +
                                                        d +
                                                        "</option>"
                                                );
                                            });
                                        $("#categorySearch").on(
                                            "keyup change clear",
                                            function () {
                                                // console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });

                                this.api()
                                    .columns(7)
                                    .every(function () {
                                        var that = this;
                                        that.data()
                                            .unique()
                                            .sort()
                                            .each(function (d, j) {
                                                $("#companySearch").append(
                                                    '<option value="' +
                                                        d +
                                                        '">' +
                                                        d +
                                                        "</option>"
                                                );
                                            });
                                        $("#companySearch").on(
                                            "keyup change clear",
                                            function () {
                                                // console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                            },
                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            processing: true,
                            dom: "Brtip",
                            buttons: [
                                {
                                    extend: "copyHtml5",
                                    title: "Products",
                                    exportOptions: {
                                        columns: [1, 3, 4, 5, 6, 7, 8],
                                    },
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Products",
                                    header: true,
                                    exportOptions: {
                                        columns: [1, 3, 4, 5, 6, 7, 8],
                                        margin: [0, 0, 0, 12],
                                    },
                                },
                            ],

                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: -1 },
                                {
                                    targets: 5,
                                    width: "75px",
                                    render: function render(
                                        data,
                                        type,
                                        full,
                                        meta
                                    ) {
                                        var status = {
                                            active: {
                                                title: "Active",
                                                class: " label-light-success",
                                            },
                                            inactive: {
                                                title: "Inactive",
                                                class: " label-light-danger",
                                            },
                                        };

                                        if (
                                            typeof status[data] === "undefined"
                                        ) {
                                            return data;
                                        }

                                        return (
                                            '<span class="label label-lg font-weight-bold' +
                                            status[data]["class"] +
                                            ' label-inline">' +
                                            status[data].title +
                                            "</span>"
                                        );
                                    },
                                },
                            ],
                        });
                    };

                    var initTable4 = function initTable4() {
                        var table = $("#kt_datatable_category"); // begin first table

                        table.DataTable({
                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                    // exportOptions: {
                                    //     columns: [1, 3, 4, 5, 6, 7 ]
                                    // }
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                            columnDefs: [
                                { orderable: false, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: -1 },
                            ],
                        });
                    };
                    var initTable5 = function initTable5() {
                        var table = $("#kt_datatable_company"); // begin first table

                        table.DataTable({
                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Companies",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Companies",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Companies",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Companies",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                            columnDefs: [
                                { orderable: false, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: 8 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                        });
                    };
                    var initTable6 = function initTable6() {
                        var table = $("#supplier_table"); // begin first table

                        table.DataTable({
                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                        title: "Sales Orders",
                                    },
                                    { extend: "copyHtml5" },
                                    { extend: "excelHtml5" },
                                    { extend: "csvHtml5" },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Sales Orders",
                                        footer: true,
                                        orientation: "landscape",
                                        pageSize: "LEGAL",
                                    },
                                ],
                            },
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                        });
                    };

                    var initTable7 = function initTable7() {
                        // var po_purchased = $('#kt_datatable'); // begin first table

                        var po_purchased = $("#kt_datatable").DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api()
                                    .columns(5)
                                    .every(function () {
                                        var that = this;
                                        // that.data().unique().sort().each(function(d, j) {
                                        //     $('#statusSearch').append('<option value="' + d + '">' + d + '</option>')
                                        // });

                                        $("#statusSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    if (this.value != "") {
                                                        that.search(
                                                            "^" +
                                                                this.value +
                                                                "$",
                                                            true,
                                                            false
                                                        ).draw();
                                                    } else {
                                                        that.search("").draw();
                                                    }
                                                }
                                            }
                                        );
                                    });

                                // this.api().columns(5).every(function() {
                                //     var that = this;
                                //     $('#purchaseDateSearch').on('keyup change clear', function() {

                                //         if (that.search() !== this.value) {
                                //             that
                                //                 .search(this.value)
                                //                 .draw();
                                //         }
                                //     });
                                // });
                            },
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Brtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                    },
                                    { extend: "copyHtml5" },
                                    { extend: "excelHtml5" },
                                    { extend: "csvHtml5" },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                ],
                            },
                        });

                        $("#datepicker_from").change(function () {
                            // Date range filter
                            var minDateFilter = "";
                            var maxDateFilter = "";
                            minDateFilter = $("#datepicker_from").val();
                            maxDateFilter = $("#datepicker_to").val();
                            $.fn.dataTableExt.afnFiltering.push(function (
                                oSettings,
                                data,
                                iDataIndex
                            ) {
                                var startDate = data[4];
                                console.log(maxDateFilter);

                                if (
                                    minDateFilter == "" &&
                                    maxDateFilter == ""
                                ) {
                                    return true;
                                }
                                if (
                                    minDateFilter == "" &&
                                    startDate <= maxDateFilter
                                ) {
                                    return true;
                                }
                                if (
                                    maxDateFilter == "" &&
                                    startDate >= minDateFilter
                                ) {
                                    return true;
                                }
                                if (
                                    startDate <= maxDateFilter &&
                                    startDate >= minDateFilter
                                ) {
                                    return true;
                                }
                                return false;
                            });
                            po_purchased.draw();
                            $.fn.dataTable.ext.search.pop();
                        });

                        $("#datepicker_to").change(function () {
                            var minDateFilter = "";
                            var maxDateFilter = "";
                            minDateFilter = $("#datepicker_from").val();
                            maxDateFilter = $("#datepicker_to").val();

                            $.fn.dataTableExt.afnFiltering.push(function (
                                oSettings,
                                data,
                                iDataIndex
                            ) {
                                var startDate = data[4];
                                console.log(startDate);

                                if (
                                    minDateFilter == null &&
                                    maxDateFilter == null
                                ) {
                                    return true;
                                }
                                if (
                                    minDateFilter == null &&
                                    startDate <= maxDateFilter
                                ) {
                                    return true;
                                }
                                if (
                                    maxDateFilter == null &&
                                    startDate >= minDateFilter
                                ) {
                                    return true;
                                }
                                if (
                                    startDate <= maxDateFilter &&
                                    startDate >= minDateFilter
                                ) {
                                    return true;
                                }
                                return false;
                            });
                            po_purchased.draw();
                            $.fn.dataTable.ext.search.pop();
                        });
                    };

                    var initTable8 = function initTable8() {
                        var table = $("#transaction_table"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Bfrtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                    { extend: "copyHtml5" },
                                    {
                                        extend: "excelHtml5",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "csvHtml5",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                ],
                            },
                        });
                    };
                    var initTable9 = function initTable9() {
                        var table = $("#kt_datatable_expense_category"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: 0 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Expense Categories",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Expense Categories",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Expense Categories",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Expense Categories",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                        });
                    };

                    var initTable10 = function initTable10() {
                        var table = $("#kt_datatable_expense_transaction"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: 0 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Expense Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Expense Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Expense Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Expense Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                        });
                    };
                    var initTable11 = function initTable11() {
                        var table = $("#kt_datatable_employees"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: 0 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Employees",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Employees",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Employees",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Employees",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                        });
                    };
                    var initTable12 = function initTable12() {
                        var table = $("#kt_datatable_account_transactions"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { orderable: false, targets: 0 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "All Accounts Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "All Accounts Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "All Accounts Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "All Accounts Transactions",
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                        });
                    };
                    var initTable13 = function initTable13() {
                        var table = $("#kt_low_stock_table"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Brtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4],
                                        },
                                    },
                                    { extend: "copyHtml5" },
                                    { extend: "excelHtml5" },
                                    { extend: "csvHtml5" },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Low Stock",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                        exportOptions: {
                                            columns: [0, 1, 2, 3, 4],
                                        },
                                    },
                                ],
                            },
                        });
                    };
                    var initTable14 = function initTable14() {
                        var table = $("#kt_product_stock_table");
                        // begin first table

                        table.DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api()
                                    .columns(0)
                                    .every(function () {
                                        var that = this;
                                        $("#productSearch").on(
                                            "keyup change clear",
                                            function () {
                                                // console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                            },
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Brtip",
                            buttons: [
                                {
                                    extend: "copyHtml5",
                                    title: "Products Stock",
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6],
                                    },
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Products Stock",
                                    header: true,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6],
                                        margin: [0, 0, 0, 12],
                                    },
                                },
                            ],
                        });
                    };

                    var initTable15 = function initTable15() {
                        var table = $("#kt_datatable_category_report"); // begin first table

                        table.DataTable({
                            responsive: true,
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "print",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                    // exportOptions: {
                                    //     columns: [1, 3, 4, 5, 6, 7 ]
                                    // }
                                },
                                { extend: "copyHtml5" },
                                {
                                    extend: "excelHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "csvHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                                {
                                    extend: "pdfHtml5",
                                    title: "Categories",
                                    footer: true,
                                    orientation: "portrait",
                                    pageSize: "A4",
                                },
                            ],
                            columnDefs: [
                                { orderable: false, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, targets: -1 },
                            ],
                        });
                    };

                    var initTable16 = function initTable16() {
                        var table = $("#kt_purchase_orders"); // begin first table

                        table.DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api()
                                    .columns(0)
                                    .every(function () {
                                        var that = this;
                                        $("#supplierSearch").on(
                                            "keyup change clear",
                                            function () {
                                                console.log(this);
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(1)
                                    .every(function () {
                                        var that = this;
                                        $("#poNumberSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });

                                this.api()
                                    .columns(3)
                                    .every(function () {
                                        var that = this;
                                        $("#requestDateSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(4)
                                    .every(function () {
                                        var that = this;
                                        $("#expectedDateSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                                this.api()
                                    .columns(5)
                                    .every(function () {
                                        var that = this;
                                        $("#purchaseDateSearch").on(
                                            "keyup change clear",
                                            function () {
                                                if (
                                                    that.search() !== this.value
                                                ) {
                                                    that.search(
                                                        this.value
                                                    ).draw();
                                                }
                                            }
                                        );
                                    });
                            },
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                                { orderable: false, width: 50, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [],
                            dom: "Brtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                    },
                                    { extend: "copyHtml5" },
                                    { extend: "excelHtml5" },
                                    { extend: "csvHtml5" },
                                    {
                                        extend: "pdfHtml5",
                                        title: "Transactions",
                                        footer: true,
                                        orientation: "portrait",
                                        pageSize: "A4",
                                    },
                                ],
                            },
                        });
                    };

                    var initTable17 = function initTable17() {
                        var table = $("#kt_print_barcode"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            order: [0, "desc"],
                            dom: "Bfrtip",
                            buttons: {
                                buttons: [
                                    {
                                        extend: "print",
                                    },
                                    {
                                        extend: "copyHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "excelHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "csvHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                    {
                                        extend: "pdfHtml5",
                                        footer: true,
                                        pageSize: "A4",
                                    },
                                ],
                            },
                        });
                    };
                    var initTable18 = function initTable18() {
                        var table = $("#kt_employee_attendance"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            // order: [0, 'desc'],
                            dom: "Bfrtip",
                            // buttons: {
                            //     buttons: [{
                            //             extend: 'print',
                            //         },
                            //         { extend: 'copyHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'excelHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'csvHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'pdfHtml5', footer: true, pageSize: 'A4' },
                            //     ],
                            // },
                        });
                    };
                    var initTable19 = function initTable19() {
                        var table = $("#import-companies"); // begin first table

                        table.DataTable({
                            responsive: true,
                            columnDefs: [
                                {
                                    responsivePriority: 1,
                                    targets: 0,
                                    orderable: false,
                                },
                                { responsivePriority: 2, targets: -1 },
                            ],
                            pagingType: "full_numbers",
                            // order: [0, 'desc'],
                            dom: "Bfrtip",
                            // buttons: {
                            //     buttons: [{
                            //             extend: 'print',
                            //         },
                            //         { extend: 'copyHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'excelHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'csvHtml5', footer: true, pageSize: 'A4' },
                            //         { extend: 'pdfHtml5', footer: true, pageSize: 'A4' },
                            //     ],
                            // },
                        });
                    };

                    function buttonsTrigger() {
                        $(".dt-buttons").hide();
                        $("#export_print").on("click", function (e) {
                            $(".buttons-print").click();
                        });

                        $("#export_copy").on("click", function (e) {
                            $(".buttons-copy").click();
                        });

                        $("#export_excel").on("click", function (e) {
                            $(".buttons-excel").click();
                        });

                        $("#export_csv").on("click", function (e) {
                            $(".buttons-csv").click();
                        });

                        $("#export_pdf").on("click", function (e) {
                            $(".buttons-pdf").click();
                        });
                    }

                    return {
                        //main function to initiate the module
                        init: function init() {
                            initTable1();
                            initTable2();
                            initTable3();
                            initTable4();
                            initTable5();
                            initTable6();
                            initTable7();
                            initTable8();
                            initTable9();
                            initTable10();
                            initTable11();
                            initTable12();
                            initTable13();
                            initTable14();
                            initTable15();
                            initTable16();
                            initTable17();
                            initTable18();
                            initTable19();
                            buttonsTrigger();
                        },
                    };
                })();

                jQuery(document).ready(function () {
                    KTDatatablesBasicPaginations.init();
                });

                /***/
            },

        /***/
        29:
            /*!********************************************************************************!*\
      !*** multi ./resources/metronic/js/pages/crud/datatables/basic/paginations.js ***!
      \********************************************************************************/
            /*! no static exports found */
            /***/
            function (module, exports, __webpack_require__) {
                module.exports = __webpack_require__(
                    /*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\datatables\basic\paginations.js */ "./resources/metronic/js/pages/crud/datatables/basic/paginations.js"
                );

                /***/
            },

        /******/
    }
);
