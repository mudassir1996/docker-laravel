var getCategories = (business_type_id, categories) => {
    // $(".no-categories").attr("style", "display: none !important");
    if (business_type_id == "") {
        //show all elements if searchbar is empty
        categories.attr("style", "display: none !important");
        $(".no-categories").attr("style", "display: flex !important");
    } else {
        if (business_type_id == $(".business-type-id").val()) {
            $(".no-categories").attr("style", "display: none !important");
            categories.attr("style", "display: flex !important");
        } else {
            $(".no-categories").attr("style", "display: flex !important");
            categories.attr("style", "display: none !important");
        }
        //else loop through categories and check if the keyword is in the title div
        categories.each(function (element) {
            let business_id = $(this).find(".business-type-id").val();
            if (business_id == business_type_id) {
                $(this).attr("style", "display: flex !important");
            } else {
                $(this).attr("style", "display: none !important");
            }
        });
    }
};
var getProducts = (business_type_id, products) => {
    // $(".no-categories").attr("style", "display: none !important");
    if (business_type_id == "") {
        //show all elements if searchbar is empty
        products.attr("style", "display: none !important");
        $(".no-products").attr("style", "display: flex !important");
    } else {
        if (business_type_id == $(".business-type-id").val()) {
            $(".no-products").attr("style", "display: none !important");
            products.attr("style", "display: flex !important");
        } else {
            $(".no-products").attr("style", "display: flex !important");
            products.attr("style", "display: none !important");
        }
        //else loop through categories and check if the keyword is in the title div
        products.each(function (element) {
            let business_id = $(this).find(".business-type-id").val();
            if (business_id == business_type_id) {
                $(this).attr("style", "display: flex !important");
            } else {
                $(this).attr("style", "display: none !important");
            }
        });
    }
};

var getCompanies = (country_id, companies) => {
    // $(".no-categories").attr("style", "display: none !important");
    if (country_id == "") {
        //show all elements if searchbar is empty
        companies.attr("style", "display: none !important");
        $(".no-companies").attr("style", "display: flex !important");
    } else {
        if (country_id == $(".country-id").val()) {
            $(".no-companies").attr("style", "display: none !important");
            companies.attr("style", "display: flex !important");
        } else {
            $(".no-companies").attr("style", "display: flex !important");
            companies.attr("style", "display: none !important");
        }
        //else loop through categories and check if the keyword is in the title div
        companies.each(function (element) {
            let company_country = $(this).find(".country-id").val();
            if (company_country == country_id) {
                $(this).attr("style", "display: flex !important");
            } else {
                $(this).attr("style", "display: none !important");
            }
        });
    }
};

var getExpenses = (business_type_id, expense_categories) => {
    // $(".no-categories").attr("style", "display: none !important");
    if (business_type_id == "") {
        //show all elements if searchbar is empty
        expense_categories.attr("style", "display: none !important");
        $(".no-expense-categories").attr("style", "display: flex !important");
    } else {
        if (business_type_id == $(".business-type-id").val()) {
            $(".no-expense-categories").attr(
                "style",
                "display: none !important"
            );
            expense_categories.attr("style", "display: flex !important");
        } else {
            $(".no-expense-categories").attr(
                "style",
                "display: flex !important"
            );
            expense_categories.attr("style", "display: none !important");
        }
        //else loop through categories and check if the keyword is in the title div
        expense_categories.each(function (element) {
            let business_id = $(this).find(".business-type-id").val();
            if (business_id == business_type_id) {
                $(this).attr("style", "display: flex !important");
            } else {
                $(this).attr("style", "display: none !important");
            }
        });
    }
};
$("#searchbar").keyup(function () {
    let business_type_id = $('select[name="business_type_id"]').val();
    let categories = $(".categories"); //get all elements with class="categories"
    let keyword = $(this).val().toLowerCase(); //get the content of the searchbar

    categories.each(function (element) {
        let business_id = $(this).find(".business-type-id").val();
        let title = $(this).find(".category-title").text().toLowerCase();
        title = title.trim();
        if (business_id == business_type_id) {
            if (keyword == "") {
                $(this).attr("style", "display: flex !important");
            } else {
                if (title.indexOf(keyword) >= 0) {
                    $(this).attr("style", "display: flex !important");
                } else {
                    $(this).attr("style", "display: none !important");
                }
            }
        }
    });
});
$("#products-searchbar").keyup(function () {
    let business_type_id = $('select[name="business_type_id"]').val();
    let products = $(".products"); //get all elements with class="categories"
    let keyword = $(this).val().toLowerCase(); //get the content of the searchbar

    products.each(function (element) {
        let business_id = $(this).find(".business-type-id").val();
        let title = $(this).find(".product-title").text().toLowerCase();
        title = title.trim();
        if (business_id == business_type_id) {
            if (keyword == "") {
                $(this).attr("style", "display: flex !important");
            } else {
                if (title.indexOf(keyword) >= 0) {
                    $(this).attr("style", "display: flex !important");
                } else {
                    $(this).attr("style", "display: none !important");
                }
            }
        }
    });
});
$("#companies-searchbar").keyup(function () {
    let country_id = $('select[name="outlet_country"]').val();
    let companies = $(".companies"); //get all elements with class="categories"
    let keyword = $(this).val().toLowerCase(); //get the content of the searchbar

    companies.each(function (element) {
        let company_country = $(this).find(".country_id").val();
        let title = $(this).find(".company-title").text().toLowerCase();
        title = title.trim();
        if (company_country == country_id) {
            if (keyword == "") {
                $(this).attr("style", "display: flex !important");
            } else {
                if (title.indexOf(keyword) >= 0) {
                    $(this).attr("style", "display: flex !important");
                } else {
                    $(this).attr("style", "display: none !important");
                }
            }
        }
    });
});
$("#expense-searchbar").keyup(function () {
    let business_type_id = $('select[name="business_type_id"]').val();
    let expense_categories = $(".expense_categories"); //get all elements with class="categories"
    let keyword = $(this).val().toLowerCase(); //get the content of the searchbar

    expense_categories.each(function (element) {
        let business_id = $(this).find(".business-type-id").val();
        let title = $(this)
            .find(".expense-category-title")
            .text()
            .toLowerCase();
        title = title.trim();
        if (business_id == business_type_id) {
            if (keyword == "") {
                $(this).attr("style", "display: flex !important");
            } else {
                if (title.indexOf(keyword) >= 0) {
                    $(this).attr("style", "display: flex !important");
                } else {
                    $(this).attr("style", "display: none !important");
                }
            }
        }
    });
});

$('select[name="business_type_id"]').change(function () {
    let categories = $(".categories"); //get all elements with class="categories"
    let products = $(".products"); //get all elements with class="products"
    let expense_categories = $(".expense_categories"); //get all elements with class="expense_categories"
    let business_type_id = $(this).val();
    getCategories(business_type_id, categories);
    getProducts(business_type_id, products);
    getExpenses(business_type_id, expense_categories);
});
$('select[name="outlet_country"]').change(function () {
    let companies = $(".companies"); //get all elements with class="companies"
    let country_id = $(this).val();
    // console.log(country_id);
    getCompanies(country_id, companies);
});

$(document).ready(function () {
    let business_type_id = $('select[name="business_type_id"]').val();
    let country_id = $('select[name="outlet_country"]').val();
    let categories = $(".categories");
    let products = $(".products"); //get all elements with class="products"
    let companies = $(".companies"); //get all elements with class="companies"
    let expense_categories = $(".expense_categories"); //get all elements with class="expense_categories"
    getCategories(business_type_id, categories);
    getProducts(business_type_id, products);
    getCompanies(country_id, companies);
    getExpenses(business_type_id, expense_categories);
});
