/*  Start of the add user using Ajax  */

const PRODUCT_URL = "";
const SUPPLIED_PRODUCT_URL = "";
const USER_URL = "";
const CATEGORY_URL = "";

$("#adminUserRegForm").on("submit", function (event) {
    event.preventDefault();
    var regForm = $(this);
    var form = new FormData(regForm[0]);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/backend/add-user",
        type: "POST",
        cache: false,
        processData: false,
        contentType: false,
        data: form,
    })
        .done(function (response) {
            //display message for your form submission

            if (response.reply === "Saved") {
                regForm.trigger("reset");
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                var myModal = new bootstrap.Modal(
                    document.getElementById("easySolutionModal"),
                    {
                        keyboard: true,
                        backdrop: "static",
                    }
                );
                var modalTitle = document.querySelector(".modal-title");
                var modalBody = document.querySelector(".modal-body");
                modalTitle.textContent = "Add User";
                modalBody.textContent =
                    "User Successfully added,he/she needs to check his/her email for verification";
                myModal.show();
                console.log(response);
            }
        })
        .fail(function (response) {
            $("[data-ajax-input]").removeClass("is-invalid");
            $("[data-ajax-feedback]").html("").removeClass("d-block");
            if (response.responseJSON.hasOwnProperty("errors")) {
                $.each(response.responseJSON.errors, function (index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="' + index + '"]').addClass(
                        "is-invalid"
                    );
                    $('[data-ajax-feedback="' + index + '"]')
                        .html(val[0])
                        .addClass("d-block");
                });
            }
        })
        .always(function (response) {});
});

/*  ending of the add user using Ajax  */

/*  Start of the add category using Ajax  */

$("#adminAddCategory").on("submit", function (event) {
    event.preventDefault();
    var categoryForm = $(this);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/backend/add-category",
        method: "POST",
        data: categoryForm.serialize(),
    })
        .done(function (response) {
            //display message for your form submission

            if (response.reply === "categoryDataSaved") {
                categoryForm.trigger("reset");
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                var myModal = new bootstrap.Modal(
                    document.getElementById("easySolutionModal"),
                    {
                        keyboard: true,
                        backdrop: "static",
                    }
                );
                var modalTitle = document.querySelector(".modal-title");
                var modalBody = document.querySelector(".modal-body");
                modalTitle.textContent = "Add Category";
                modalBody.textContent = "Category successfully added";
                myModal.show();
                console.log(response);
            }
        })
        .fail(function (response) {
            $("[data-ajax-input]").removeClass("is-invalid");
            $("[data-ajax-feedback]").html("").removeClass("d-block");
            if (response.responseJSON.hasOwnProperty("errors")) {
                $.each(response.responseJSON.errors, function (index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="' + index + '"]').addClass(
                        "is-invalid"
                    );
                    $('[data-ajax-feedback="' + index + '"]')
                        .html(val[0])
                        .addClass("d-block");
                });
            }
        })
        .always(function (response) {});
});

/*  ending of the add user using Ajax  */

/*  Start of the add supplied product using Ajax  */

$("#adminProductSupplied").on("submit", function (event) {
    event.preventDefault();
    var addSuppliedProductForm = $(this);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/backend/add-supplied-product",
        method: "POST",
        data: addSuppliedProductForm.serialize(),
    })
        .done(function (response) {
            //display message for your form submission

            if (response.reply === "productSuppliedSaved") {
                addSuppliedProductForm.trigger("reset");
                var hideSuppliedAlert = document.querySelector("#hideAlert");
                hideSuppliedAlert.style.display = "block";
                hideSuppliedAlert.textContent = `You successfully add the product supplied, and the total amount of the product supplied is ${response.totalProductSupplied}`;
            }
        })
        .fail(function (response) {
            $("[data-ajax-input]").removeClass("is-invalid");
            $("[data-ajax-feedback]").html("").removeClass("d-block");
            if (response.responseJSON.hasOwnProperty("errors")) {
                $.each(response.responseJSON.errors, function (index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="' + index + '"]').addClass(
                        "is-invalid"
                    );
                    $('[data-ajax-feedback="' + index + '"]')
                        .html(val[0])
                        .addClass("d-block");
                });
            }
        })
        .always(function (response) {});
});

/*  ending of the add supplied product using Ajax  */

/*  Start of the add product using Ajax  */

$("#adminAddProduct").on("submit", function (event) {
    event.preventDefault();
    var addSuppliedProductForm = $(this);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/backend/add-product",
        method: "POST",
        data: addSuppliedProductForm.serialize(),
    })
        .done(function (response) {
            //display message for your form submission

            if (response.reply === "productSaved") {
                addSuppliedProductForm.trigger("reset");
                var hideProductAlert = document.querySelector("#hideAlert");
                hideProductAlert.style.display = "block";
                hideProductAlert.textContent = `Product successfully added, and the total amount of the product added to the stock is ${response.totalProductAmount}`;
            }
        })
        .fail(function (response) {
            $("[data-ajax-input]").removeClass("is-invalid");
            $("[data-ajax-feedback]").html("").removeClass("d-block");
            if (response.responseJSON.hasOwnProperty("errors")) {
                $.each(response.responseJSON.errors, function (index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="' + index + '"]').addClass(
                        "is-invalid"
                    );
                    $('[data-ajax-feedback="' + index + '"]')
                        .html(val[0])
                        .addClass("d-block");
                });
            }
        })
        .always(function (response) {});
});

/*  ending of the add product using Ajax  */

$("#adminUserProfileForm").on("submit", function (event) {
    event.preventDefault();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: new FormData(this),
        processData: false,
        dataType: "json",
        contentType: false,
    })
        .done(function (response) {
            //display message for your form submission

            if (response.reply === "Saved") {
                $(".profile_name").each(function () {
                    $(this).html(
                        $("#adminUserProfileForm")
                            .find($('input[name="name"]'))
                            .val()
                    );
                });
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                var myModal = new bootstrap.Modal(
                    document.getElementById("userProfileMsgModal"),
                    {
                        keyboard: true,
                        backdrop: "static",
                    }
                );
                myModal.show();
            }
        })
        .fail(function (response) {
            $("[data-ajax-input]").removeClass("is-invalid");
            $("[data-ajax-feedback]").html("").removeClass("d-block");
            if (response.responseJSON.hasOwnProperty("errors")) {
                $.each(response.responseJSON.errors, function (index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="' + index + '"]').addClass(
                        "is-invalid"
                    );
                    $('[data-ajax-feedback="' + index + '"]')
                        .html(val[0])
                        .addClass("d-block");
                });
            }
        })
        .always(function (response) {});
});

/*  ending of the update user profile using Ajax  */

$(document).ready(function () {
    $.get("/backend/user-image", function (response) {
        if (response.userImg) {
            $("#userImage").html(
                `<img  class="img-fluid rounded w-100 profile_img" alt="Profile image" src="${response.userImg}"/>`
            );
        } else if (response.userAvatar) {
            $("#userAvatar").html(
                `<img  class="img-fluid rounded w-100 profile_img" alt="Profile avatar" src="${response.userAvatar}"/>`
            );
        }
    });

    //     $('#updateUserAvatar').on('submit', function(){
    //         $.ajaxSetup({
    //             headers: {
    //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //            },
    //         });
    //         $.post('/backend/user-avatar', function(response){

    //         //$("#profileAvatar").on("click", function () {
    //             $('#userAvatar').html(`<img  class="img-fluid rounded w-100 profile_img" alt="Profile avatar" src="${response.userProfileAvatar}"/>`);
    //           //});
    //        })
    // });

    $("#updateUserAvatar").on("submit", function (event) {
        event.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
        })
            .done(function (response) {
                //display message for your form submission

                if (response.userProfileAvatar) {
                    $("#hideAlert").show();
                    $("#hideAlert").text("Profile image updated successfully");
                    setTimeout(() => {
                        $("#hideAlert").hide();
                    }, 3000);
                } else {
                    $("#hideAlert").show();
                    $("#hideAlert").text("Something went wrong");
                    $("#hideALert").css("background", "red");
                    setTimeout(() => {
                        $("#hideAlert").hide();
                    }, 3000);
                }
            })
            .fail(function (response) {
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                if (response.responseJSON.hasOwnProperty("errors")) {
                    $.each(response.responseJSON.errors, function (index, val) {
                        /* iterate through array or object */
                        $('[data-ajax-input="' + index + '"]').addClass(
                            "is-invalid"
                        );
                        $('[data-ajax-feedback="' + index + '"]')
                            .html(val[0])
                            .addClass("d-block");
                    });
                }
            })
            .always(function (response) {});
    });

    /*  ending of the update user profile avatar using Ajax  */

    $("#updateUserProfileImage").on("submit", function (event) {
        event.preventDefault();
        var img = $(this).find("img").attr("src");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
        })
            .done(function (response, textStatus, jqXHR) {
                //display message for your form submission

                $("#updateUserProfileImage")[0].reset();

                if (response.reply) {
                    $("#userImage").html(
                        `<img  class="img-fluid rounded w-100 profile_img" alt="Profile image" src="${response.updatedImg}"/>`
                    );

                    $("[data-ajax-input]").removeClass("is-invalid");
                    $("[data-ajax-feedback]").html("").removeClass("d-block");
                    $("#hideAlert").show();
                    $("#hideAlert").text("Profile image updated successfully");
                    setTimeout(() => {
                        $("#hideAlert").hide();
                    }, 3000);
                } else {
                    $("#hideAlert").show();
                    $("#hideAlert").text("Something went wrong");
                    $("#hideALert").css("background", "red");
                    setTimeout(() => {
                        $("#hideAlert").hide();
                    }, 3000);
                }
            })
            .fail(function (response) {
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                if (response.responseJSON.hasOwnProperty("errors")) {
                    $.each(response.responseJSON.errors, function (index, val) {
                        /* iterate through array or object */
                        $('[data-ajax-input="' + index + '"]').addClass(
                            "is-invalid"
                        );
                        $('[data-ajax-feedback="' + index + '"]')
                            .html(val[0])
                            .addClass("d-block");

                        console.log(response.responseText);
                    });
                }
            })
            .always(function (response) {});
    });
});
/*  ending of the update user profile using Ajax  */

$(document).ready(function () {
    /*  start of checking of admin Password */

    // Check Current User Password
    $("#current_password").keyup(function () {
        var current_password = $(this).val();
        $("#current_password").mouseleave(function () {
            document.getElementById("current_password").style.border = "";
            document.getElementById("current_password").style.boxShadow = "";
        });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/backend/check-user-pwd",
            data: { current_password: current_password },
            success: function (resp) {
                /*alert(resp);*/
                if (resp.noReply == "Failure") {
                    document.getElementById("current_password").style.border =
                        "2px solid #F93154";
                    document.getElementById(
                        "current_password"
                    ).style.boxShadow =
                        "0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255, 100, 255, 0.5)";
                } else if (resp.reply == "Success") {
                    document.getElementById("current_password").style.border =
                        "2px solid #00B74A";
                    document.getElementById(
                        "current_password"
                    ).style.boxShadow =
                        "0px 1px 1px rgb(144,238,144) inset, 0px 0px 8px rgb(144,238,144)";
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
});

$(document).ready(function () {
    $("#userChangePasswordForm").on("submit", function (event) {
        event.preventDefault();

        var changePasswordForm = $(this).closest("form");

        $.ajax({
            url: "/backend/backend-change-password",
            method: "POST",
            data: changePasswordForm.serialize(),
        })
            .done(function (response) {
                //display message for your form submission

                if (response.reply == "Saved") {
                    changePasswordForm.trigger("reset");
                    $("[data-ajax-input]").removeClass("is-invalid");
                    $("[data-ajax-feedback]").html("").removeClass("d-block");

                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "User Change Password";
                    modalBody.textContent =
                        "You Successfully Changed Your Password";
                    myModal.show();
                }
                if (resp.noReply == "notSaved") {
                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "User Change Password";
                    modalBody.textContent = "Password changing failed";
                    myModal.show();
                }
            })
            .fail(function (response) {
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                if (response.responseJSON.hasOwnProperty("errors")) {
                    $.each(response.responseJSON.errors, function (index, val) {
                        /* iterate through array or object */
                        $('[data-ajax-input="' + index + '"]').addClass(
                            "is-invalid"
                        );
                        $('[data-ajax-feedback="' + index + '"]')
                            .html(val[0])
                            .addClass("d-block");
                    });
                }
            })
            .always(function (response) {
                console.log("complete");
            });
    });
});
/*  ending of the Profile change password using Ajax  */

//get get product price dropdown

$(document).ready(function () {
    $("#product_id").change(function () {
        var product_id = $(this).val();

        $.ajax({
            type: "get",
            url: "/backend/get-product-price" + "/" + product_id,
            data: { id: product_id },
            success: function (data, textStatus, jqXHR) {
                $("#sale_price").val(data.sales.sale_price);
            },
            error: function (response) {
                if (response) {
                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "Error message";
                    modalBody.textContent = "Hoops!!! Something went wrong";
                    myModal.show();
                }
            },
        });
    });
});

/*end of the get product price*/

/* manage sales*/

$(document).ready(function () {
    const SALES_TABLE_BODY_DATA = $("#salesPOSDataBody");

    // hide and show make sales payment button
    var makesSalesPaymentButtonModal =
        document.getElementById("make_sales_btn");

    var i = 1;
    $.get("/backend/get-sales-data", function (response) {
        var html = "";
        var salesDataBody = SALES_TABLE_BODY_DATA.html("");

        $.each(response.salesData, function (index, val) {
            if (document.querySelectorAll("#view_sales tbody").length === 0) {
                makesSalesPaymentButtonModal.style.display = "none";
            } else if (
                document.querySelectorAll("#view_sales tbody").length !== 0
            ) {
                makesSalesPaymentButtonModal.style.display = "block";
            }
            html = "<tr>";
            html += "<td>" + `${index + 1}` + "</td>";
            html += "<td>" + val.add_product.product_name + "</td>";
            html += "<td>" + val.price + "</td>";
            html += "<td>" + val.quantity + "</td>";
            html += "<td>" + val.total + "</td>";
            html +=
                +"<button type='submit' id='btn_salesDelete' data-id='" +
                `${val.id}` +
                "'  class='btn btn-danger btn-lg'>Remove</button>" +
                "</td>";
            html += "</tr>";

            salesDataBody.append(html);
            $("#total_sales").text(response.grandTotal);
            $("#payment_total").text(response.grandTotal);
        });
    });

    $("#salesPOS").on("submit", function () {
        var POSForm = $(this).closest("form");
        $.ajax({
            url: "/backend/sales-pos",
            method: "POST",
            data: POSForm.serialize(),
            success: function (response) {
                $.each(response.salesData, function (index, val) {
                    if (
                        document.querySelectorAll("#view_sales tbody")
                            .length === 0
                    ) {
                        makesSalesPaymentButtonModal.style.display = "none";
                    } else if (
                        document.querySelectorAll("#view_sales tbody")
                            .length !== 0
                    ) {
                        makesSalesPaymentButtonModal.style.display = "block";
                    }

                    var html = "";
                    var salesDataBody = $("#salesPOSDataBody").html("");

                    html = $(
                        "<tr><td>" +
                            `${index + 1}` +
                            "</td><td>" +
                            val.add_product.product_name +
                            "</td><td>" +
                            val.quantity +
                            "</td><td>" +
                            val.price +
                            "</td><td>" +
                            val.total +
                            "</td><td>" +
                            "<button type='submit' id='btn_salesDelete' data-id='" +
                            `${val.id}` +
                            "'  class='btn btn-danger btn-lg'>Remove</button>" +
                            "</td></tr>"
                    );

                    salesDataBody.append(html);
                    $("#total_sales").text(response.grandTotal);
                    $("#payment_total").text(response.grandTotal);
                    $("#salesPOS")[0].reset();
                });

                if (response.lowQuantity) {
                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "Low Product Quantity";
                    modalBody.textContent = `${response.lowQuantity}`;
                    myModal.show();
                }

                if (response.productInactive) {
                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "Product Inactive";
                    modalBody.textContent = `${response.productInactive}`;
                    myModal.show();
                }

                if (response.duplicateProduct) {
                    var myModal = new bootstrap.Modal(
                        document.getElementById("easySolutionModal"),
                        {
                            keyboard: true,
                            backdrop: "static",
                        }
                    );
                    var modalTitle = document.querySelector(".modal-title");
                    var modalBody = document.querySelector(".modal-body");
                    modalTitle.textContent = "Duplicate Product";
                    modalBody.textContent = `${response.duplicateProduct}`;
                    myModal.show();
                }
            },
            error: function (response) {
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                if (response.responseJSON.hasOwnProperty("errors")) {
                    $.each(response.responseJSON.errors, function (index, val) {
                        /* iterate through array or object */
                        $('[data-ajax-input="' + index + '"]').addClass(
                            "is-invalid"
                        );
                        $('[data-ajax-feedback="' + index + '"]')
                            .html(val[0])
                            .addClass("d-block");
                    });
                }
            },
        });
    });

    //delete sales record

    $("#btn_salesDelete").on("click", function () {
        var idsArr = [];
        var strIds = idsArr.join();
        $.ajax({
            type: "DELETE",
            url: "/backend/delete-sales-single-data",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: "id=" + strIds,
            success: function (data) {
                console.log(data.deleted);
                if (data.status === true) {
                    $(this).parents("tr").remove();
                }
            },
            error: function (data) {
                alert(data.responseText);
            },
        });
    });

});

//payment begins here

$(document).ready(function () {
    const PAYMENT_TYPE = {
        cash: "Cash",
        transfer: "Transfer",
        POS: "POS",
    };

    const PAID_AMOUNT = $("#paid_amount");
    const INVALID_AMOUNT = $("#invalid_amount");
    const CUSTOMER_CHANGE = $("#customer_change");
    const CUSTOMER_NAME_PAYMENT = $("#customer_name");
    const CUSTOMER_NAME_RECEIPT = $("#customerName");
    const BALANCE_COLLECT = $("#balance_collect");
    const BTN_NEXT = $("#btn_next");
    const DOUBLE_PAYMENT = $("#double_payment");
    var cashPayment = $("#cash");
    var transferPayment = $("#transfer");
    var POSPayment = $("#POS");

    //check customer name, payment type and amount paid

    $.get(
        "/backend/get-sales-payment-data",
        function (response, textStatus, jqXHR) {
            console.log(response.getPaymentData);

            //perform all these when a page is loaded
            if (response.getPaymentData) {
                //show money received from customer
                PAID_AMOUNT.val(`${response.getPaymentData.paid_amount}`);

                //display customer change if the right amount is entered
                CUSTOMER_CHANGE.text(
                    `${response.getPaymentData.change_amount}`
                );

                //display payment type

                if (
                    response.getPaymentData.payment_type === PAYMENT_TYPE.cash
                ) {
                    cashPayment
                        .val(`${response.getPaymentData.payment_type}`)
                        .prop("checked", true);
                } else if (
                    response.getPaymentData.payment_type ===
                    PAYMENT_TYPE.transfer
                ) {
                    transferPayment
                        .val(`${response.getPaymentData.payment_type}`)
                        .prop("checked", true);
                } else if (
                    response.getPaymentData.payment_type === PAYMENT_TYPE.POS
                ) {
                    POSPayment.val(
                        `${response.getPaymentData.payment_type}`
                    ).prop("checked", true);
                }
                //display customer name on payment modal
                window.localStorage.setItem(
                    "CUSTOMER_NAME",
                    `${response.getPaymentData.customer_name}`
                );
                CUSTOMER_NAME_PAYMENT.val(
                    window.localStorage.getItem("CUSTOMER_NAME")
                );

                //receipt balance collect
                window.localStorage.setItem(
                    "BALANCE_COLLECT",
                    `${response.getPaymentData.change_amount}`
                );
            }
        }
    );
    $("#salesPayment").on("submit", function (event) {
        event.preventDefault();
        //display receipt data when payment is submitted
        receiptData();
        var paymentForm = $(this).closest("form");
        $.ajax({
            url: "/backend/sales-payment",
            method: "POST",
            data: paymentForm.serialize(),
            success: function (response) {
                if (response.invalidAmount) {
                    INVALID_AMOUNT.text(`${response.invalidAmount}`);
                    PAID_AMOUNT.css("borderColor", "#DC4C64");

                    PAID_AMOUNT.on("focus", function () {
                        INVALID_AMOUNT.text("");
                        PAID_AMOUNT.css("borderColor", "");
                    });
                }
                if (response.doublePayment) {
                    DOUBLE_PAYMENT.text(`${response.doublePayment}`);

                    DOUBLE_PAYMENT.css("color", "#DC4C64");
                }
                setTimeout(() => {
                    DOUBLE_PAYMENT.text(`${response.doublePayment}`).hide();
                }, 3000);

                if (response.paymentData) {
                    //show money received from customer
                    PAID_AMOUNT.val(`${response.paymentData.paid_amount}`);

                    //display customer change if the right amount is entered
                    CUSTOMER_CHANGE.text(
                        `${response.paymentData.change_amount}`
                    );

                    console.log(response.paymentData);

                    //display customer name on the payment and receipt modal when submit payment modal
                    CUSTOMER_NAME_PAYMENT.val(
                        window.localStorage.getItem("CUSTOMER_NAME")
                    );
                }
            },
            error: function (response) {
                $("[data-ajax-input]").removeClass("is-invalid");
                $("[data-ajax-feedback]").html("").removeClass("d-block");
                if (response.responseJSON.hasOwnProperty("errors")) {
                    $.each(response.responseJSON.errors, function (index, val) {
                        /* iterate through array or object */
                        $('[data-ajax-input="' + index + '"]').addClass(
                            "is-invalid"
                        );
                        $('[data-ajax-feedback="' + index + '"]')
                            .html(val[0])
                            .addClass("d-block");
                    });
                }
            },
        });
    });
});


    function receiptData() {
        var salesReceiptBody = $("#salesReceiptBody");
        $.get("/backend/get-sales-data", function (response) {
            $.each(response.salesData, function (index, val) {
                html = "<tr>";
                html += "<td>" + `${index + 1}` + "</td>";
                html += "<td>" + val.add_product.product_name + "</td>";
                html += "<td>" + val.quantity + "</td>";
                html += "<td>" + val.price + "</td>";
                html += "<td>" + val.total + "</td>";
                html += "</tr>";

                salesReceiptBody.append(html);
            });

            //grand total on receipt
            $("#overAll_total").text(`${response.grandTotal}`);

            //display company name on receipt
            $(".company_name").text(`${response.companyBio}`);

            CUSTOMER_NAME_RECEIPT.text(
                window.localStorage.getItem("CUSTOMER_NAME")
            );
            BALANCE_COLLECT.text(
                window.localStorage.getItem("BALANCE_COLLECT")
            );
        });
    }

    //display data on receipt when window is ready
    $(document).ready(function () {
        receiptData();
    });

    //print receipt and clear all all forms tables

    const PRINT_RECEIPT = document.getElementById("printReceipt");
    $(document).ready(function () {
        PRINT_RECEIPT.addEventListener("click", function () {
            var idsArr = [];
            var strIds = idsArr.join();
            $.ajax({
                type: "DELETE",
                url: "/backend/delete-sales-data",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: "ids=" + strIds,
                success: function (data) {
                    console.log(data.deleted);
                    if (data.status === true) {
                        //print the receipt
                        window.print();

                        $(this).parents("tr").remove();
                        $("#receipt_modalBodyData").html("");
                        var myReceiptModal = new bootstrap.Modal(
                            document.getElementById("printReceiptModal"),
                            {
                                keyboard: false,
                                backdrop: "",
                            }
                        );
                        myReceiptModal.hide();
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                },
            });
        });
    });

