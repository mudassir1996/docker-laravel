function importCategory() {
    _element = KTUtil.getById("kt_offcanvas");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_close",
        toggleBy: "kt_offcanvas_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: true,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });

    return _offcanvasObject;
}
function importProduct() {
    _element = KTUtil.getById("kt_offcanvas_products");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_products_close",
        toggleBy: "kt_offcanvas_products_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: false,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });
    return _offcanvasObject;
}
function importCompany() {
    _element = KTUtil.getById("kt_offcanvas_companies");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_companies_close",
        toggleBy: "kt_offcanvas_companies_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: false,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });
    return _offcanvasObject;
}
function importExpense() {
    _element = KTUtil.getById("kt_offcanvas_expenses");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_expenses_close",
        toggleBy: "kt_offcanvas_expenses_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: false,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });
    return _offcanvasObject;
}
function importPaymentMethods() {
    _element = KTUtil.getById("kt_offcanvas_payment_method");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_payment_method_close",
        toggleBy: "kt_offcanvas_payment_method_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: false,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });
    return _offcanvasObject;
}
function importPaymentTypes() {
    _element = KTUtil.getById("kt_offcanvas_payment_type");
    var header = KTUtil.find(_element, ".offcanvas-header");
    var content = KTUtil.find(_element, ".offcanvas-content");

    _offcanvasObject = new KTOffcanvas(_element, {
        overlay: true,
        baseClass: "offcanvas",
        placement: "right",
        closeBy: "kt_offcanvas_payment_type_close",
        toggleBy: "kt_offcanvas_payment_type_toggle",
    });

    KTUtil.scrollInit(content, {
        disableForMobile: false,
        resetHeightOnDestroy: true,
        handleWindowResize: true,
        height: function () {
            var height = parseInt(KTUtil.getViewPort().height);

            if (header) {
                height = height - parseInt(KTUtil.actualHeight(header));
                height = height - parseInt(KTUtil.css(header, "marginTop"));
                height = height - parseInt(KTUtil.css(header, "marginBottom"));
            }

            if (content) {
                height = height - parseInt(KTUtil.css(content, "marginTop"));
                height = height - parseInt(KTUtil.css(content, "marginBottom"));
            }

            height = height - parseInt(KTUtil.css(_element, "paddingTop"));
            height = height - parseInt(KTUtil.css(_element, "paddingBottom"));

            height = height - 2;

            return height;
        },
    });
    return _offcanvasObject;
}

var categoryCanvas = importCategory();
var productCanvas = importProduct();
var companyCanvas = importCompany();
var expenseCanvas = importExpense();
var paymentTypes = importPaymentTypes();
var paymentTypes = importPaymentMethods();
