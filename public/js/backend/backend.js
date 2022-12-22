



//view table products
$(document).ready(function () {
    $("#product_check_all").on("click", function () {
        if ($(this).is(":checked", true)) {
            $(".product_checkbox").prop("checked", true);
        } else {
            $(".product_checkbox").prop("checked", false);
        }
    });
    $(".product_checkbox").on("click", function () {
        if (
            $(".product_checkbox:checked").length ===
            $(".product_checkbox").length
        ) {
            $("#product_check_all").prop("checked", true);
        } else {
            $("#product_check_all").prop("checked", false);
        }
    });
    $(".product_delete_all").on("click", function () {
        var idsArrProduct = [];
        $(".product_checkbox:checked").each(function () {
            idsArrProduct.push($(this).attr("data-id"));
        });

        if (idsArrProduct.length <= 0) {
            alert("Select at least one record to delete");
        } else {
            var myModal = new bootstrap.Modal(
                document.getElementById("adminArchiveMultipleProductModal"),
                {
                    keyboard: true,
                    backdrop: "static",
                }
            );
            myModal.show();
        }
    });
});


//view archive  products

//multiple delete archive products
$(document).ready(function () {
    $("#archiveProduct_checkAll").on("click", function () {
        if ($(this).is(":checked", true)) {
            $(".archiveProduct_checkbox").prop("checked", true);
        } else {
            $(".archiveProduct_checkbox").prop("checked", false);
        }
    });
    $(".archiveProduct_checkbox").on("click", function () {
        if (
            $(".archiveProduct_checkbox:checked").length ===
            $(".archiveProduct_checkbox").length
        ) {
            $("#archiveProduct_checkAll").prop("checked", true);
        } else {
            $("#archiveProduct_checkAll").prop("checked", false);
        }
    });

    $(".archiveProduct_deleteAll").on("click", function () {
        var idsArr = [];
        $(".archiveProduct_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one product to delete");
        } else {
            if (
                confirm(
                    "Are you sure, you want to delete the selected  product(s)"
                )
            ) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "DELETE",
                    url: "/backend/delete-prd",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".archiveProduct_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected  Product(s) Successfully Deleted"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });


});



//multiple restore archive products
$(document).ready(function () {

    $(".archiveProduct_restoreAll").on("click", function () {
        var idsArr = [];
        $(".archiveProduct_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one product to restore");
        } else {
            if (
                confirm(
                    "Restore the selected  product(s)"
                )
            ) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "PATCH",
                    url: "/backend/restore-prd",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".archiveProduct_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected  Product(s) Successfully Restored"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });

    //view archived supplied restore product

    $(".paymentsArchive_restoreAll").on("click", function () {
        var idsArr = [];
        $(".suppliedArchiveProductCheck_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one supplied product to restore");
        } else {
            if (confirm("Restore the selected supplied product(s)")) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "PATCH",
                    url: "/backend/restore-supplied-prd",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".suppliedArchiveProductCheck_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected Supplied Product(s) Successfully Restored"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });
});





//view archive supplied products

//multiple delete archive supplied products
$(document).ready(function () {
    $("#suppliedArchiveProductCheck_all").on("click", function () {
        if ($(this).is(":checked", true)) {
            $(".suppliedArchiveProductCheck_checkbox").prop("checked", true);
        } else {
            $(".suppliedArchiveProductCheck_checkbox").prop("checked", false);
        }
    });
    $(".suppliedArchiveProductCheck_checkbox").on("click", function () {
        if (
            $(".suppliedArchiveProductCheck_checkbox:checked").length ===
            $(".suppliedArchiveProductCheck_checkbox").length
        ) {
            $("#suppliedArchiveProductCheck_all").prop("checked", true);
        } else {
            $("#suppliedArchiveProductCheck_all").prop("checked", false);
        }
    });

    $(".suppliedArchiveProduct_deleteAll").on("click", function () {
        var idsArr = [];
        $(".suppliedArchiveProductCheck_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one record to delete");
        } else {
            if (
                confirm(
                    "Are you sure, you want to delete the selected supplied product(s)"
                )
            ) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "DELETE",
                    url: "/backend/delete-supplied-prd",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".suppliedArchiveProductCheck_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected Supplied Product(s) Successfully Deleted"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });

});




//view products
// $(document).ready(function () {
//     $("#archiveProduct_checkAll").on("click", function () {
//         if ($(this).is(":checked", true)) {
//             $(".archiveProduct_checkbox").prop("checked", true);
//         } else {
//             $(".archiveProduct_checkbox").prop("checked", false);
//         }
//     });
//     $(".archiveProduct_checkbox").on("click", function () {
//         if (
//             $(".archiveProduct_checkbox:checked").length ===
//             $(".archiveProduct_checkbox").length
//         ) {
//             $("#archiveProduct_checkAll").prop("checked", true);
//         } else {
//             $("#archiveProduct_checkAll").prop("checked", false);
//         }
//     });
//     $(".archiveProduct_deleteAll").on("click", function () {
//         var idsArrProduct = [];
//         $(".archiveProduct_checkbox:checked").each(function () {
//             idsArrProduct.push($(this).attr("data-id"));
//         });

//         if (idsArrProduct.length <= 0) {
//             alert("Select at least one record to delete");
//         } else {
//             var myModal = new bootstrap.Modal(
//                 document.getElementById("adminArchivedMultipleProductModal"),
//                 {
//                     keyboard: true,
//                     backdrop: "static",
//                 }
//             );
//             myModal.show();
//         }
//     });


//     $(".archiveProduct_restoreAll").on("click", function () {
//         var idsArrProduct = [];
//         $(".archiveProduct_checkbox:checked").each(function () {
//             idsArrProduct.push($(this).attr("data-id"));
//         });

//         if (idsArrProduct.length <= 0) {
//             alert("Select at least one record to delete");
//         } else {
//             var myModal = new bootstrap.Modal(
//                 document.getElementById("adminArchivedMultipleProductModal"),
//                 {
//                     keyboard: true,
//                     backdrop: "static",
//                 }
//             );
//             myModal.show();
//         }
//     });
// });



//view supplied products
$(document).ready(function () {
    $("#suppliedProductCheck_all").on("click", function () {
        if ($(this).is(":checked", true)) {
            $(".suppliedProductCheck_checkbox").prop("checked", true);
        } else {
            $(".suppliedProductCheck_checkbox").prop("checked", false);
        }
    });
    $(".suppliedProductCheck_checkbox").on("click", function () {
        if (
            $(".suppliedProductCheck_checkbox:checked").length ===
            $(".suppliedProductCheck_checkbox").length
        ) {
            $("#suppliedProductCheck_all").prop("checked", true);
        } else {
            $("#suppliedProductCheck_all").prop("checked", false);
        }
    });
    $(".suppliedProduct_deleteAll").on("click", function () {
        var idsArrProduct = [];
        $(".suppliedProductCheck_checkbox:checked").each(function () {
            idsArrProduct.push($(this).attr("data-id"));
        });

        if (idsArrProduct.length <= 0) {
            alert("Select at least one supplied product to archive");
        } else {
            var myModal = new bootstrap.Modal(
                document.getElementById(
                    "adminArchivedMultipleSuppliedProductModal"
                ),
                {
                    keyboard: true,
                    backdrop: "static",
                }
            );
            myModal.show();
        }
    });
});





//view archived payments restored

$(document).ready(function(){
    $(".paymentsArchive_restoreAll").on("click", function () {
        var idsArr = [];
        $(".paymentsArchivedCheck_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one payment record(s) to restore");
        } else {
            if (confirm("Restore the selected payment record(s)")) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "PATCH",
                    url: "/backend/archive-payment-all",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".suppliedArchiveProductCheck_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected Supplied Product(s) Successfully Restored"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });
    });



    //view archived payments
$(document).ready(function () {
    $("#Payments_all").on("click", function () {
        if ($(this).is(":checked", true)) {
            $("paymentsCheck_checkbox").prop("checked", true);
        } else {
            $("paymentsCheck_checkbox").prop("checked", false);
        }
    });
    $("paymentsCheck_checkbox").on("click", function () {
        if (
            $("paymentsCheck_checkbox:checked").length ===
            $("paymentsCheck_checkbox").length
        ) {
            $("#paymentsCheck_all").prop("checked", true);
        } else {
            $("#paymentsCheck_all").prop("checked", false);
        }
    });
    $(".payments_archiveAll").on("click", function () {
        var idsArrProduct = [];
        $("paymentsCheck_checkbox:checked").each(function () {
            idsArrProduct.push($(this).attr("data-id"));
        });

        if (idsArrProduct.length <= 0) {
            alert("Select at least one payment record to archive");
        } else {
            var myModal = new bootstrap.Modal(
                document.getElementById(
                    "adminArchivedMultiplePaymentsModal"
                ),
                {
                    keyboard: true,
                    backdrop: "static",
                }
            );
            myModal.show();
        }
    });
});



//multiple delete payment record
$(document).ready(function () {
    $("#payment_checkAll").on("click", function () {
        if ($(this).is(":checked", true)) {
            $(".paymentsArchivedCheck_checkbox").prop("checked", true);
        } else {
            $(".paymentsArchivedCheck_checkbox").prop("checked", false);
        }
    });
    $(".paymentsArchivedCheck_checkbox").on("click", function () {
        if (
            $(".paymentsArchivedCheck_checkbox:checked").length ===
            $(".paymentsArchivedCheck_checkbox").length
        ) {
            $("#payment_checkAll").prop("checked", true);
        } else {
            $("#payment_checkAll").prop("checked", false);
        }
    });

    $(".paymentArchive_deleteAll").on("click", function () {
        var idsArr = [];
        $(".paymentsArchivedCheck_checkbox:checked").each(function () {
            idsArr.push($(this).attr("data-id"));
        });

        if (idsArr.length <= 0) {
            alert("Select at least one payment record(s) to delete");
        } else {
            if (
                confirm(
                    "Are you sure, you want to delete the selected  payment record(s)"
                )
            ) {
                var strIds = idsArr.join();
                $.ajax({
                    type: "DELETE",
                    url: "/backend/delete-payment",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    data: "ids=" + strIds,
                    success: function (data) {
                        if (data.status === true) {
                            $(
                                ".paymentsArchivedCheck_checkbox:checked"
                            ).each(function () {
                                $(this).parents("tr").remove();
                            });
                            $("#hideAlert").show();
                            $("#hideAlert").text(
                                "The Selected  Payment record(s) Successfully Deleted"
                            );
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
                    },
                    error: function (data) {
                        alert(data.responseText);
                    },
                });
            }
        }
    });


});



//view archived sales history
$(document).ready(function () {
    $("#salesHistoryCheck_all").on("click", function () {
        if ($(this).is(":checked", true)) {
            $("salesHistoryCheck_checkbox").prop("checked", true);
        } else {
            $("salesHistoryCheck_checkbox").prop("checked", false);
        }
    });
    $("salesHistoryCheck_checkbox").on("click", function () {
        if (
            $("salesHistoryCheck_checkbox:checked").length ===
            $("salesHistoryCheck_checkbox").length
        ) {
            $("#salesHistoryCheck_all").prop("checked", true);
        } else {
            $("#salesHistoryCheck_all").prop("checked", false);
        }
    });
    $(".salesHistory_archiveAll").on("click", function () {
        var idsArrSalesHistory= [];
        $("salesHistoryCheck_checkbox:checked").each(function () {
            idsArrSalesHistory.push($(this).attr("data-id"));
        });

        if (idsArrSalesHistory.length <= 0) {
            alert("Select at least one sales history record to archive");
        } else {
            var myModal = new bootstrap.Modal(
                document.getElementById(
                    "adminArchivedMultipleSalesHistoryModal"
                ),
                {
                    keyboard: true,
                    backdrop: "static",
                }
            );
            myModal.show();
        }
    });
});

