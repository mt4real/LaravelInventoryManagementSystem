var currentTab = 0; // Current tab is set to be the first tab (0)
var prevBtn = document.getElementById("prevBtn");
var nextBtn = document.getElementById("nextBtn");
//var finishBtn = document.getElementById("finishBtn");
var submitBtn=document.getElementById('submitBtn');
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        prevBtn.style.display = "none";
    } else {
        prevBtn.style.display = "inline";
    }
    if (n == x.length - 1) {
        nextBtn.style.display = "none";
        submitBtn.style.display = "inline";
    } else {
        nextBtn.innerHTML = "Next";
    }
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;

    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        // document.getElementById("companyForm").submit();

        removeEventListener("beforeunload", beforeUnloadListener, {
            capture: true,
        });
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

$(submitBtn).click(function(){

    removeEventListener("beforeunload", beforeUnloadListener, {
        capture: true,
    });
})

function validateForm() {
    // This function deals with validation of the form fields
    var x,
        y,
        i,
        valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += "error";
            // and set the current valid status to false:
            valid = false;
        }
    }

    return valid; // return the valid status
}

const isRequiredInput = (input) => (input.value === "" ? false : true);

const isRequiredSelect = (input) => (input.value === "0" ? false : true);

const showErrorMessage = (input, errMsg) => {
    const field = input.parentNode;
    const errorMsgField = field.querySelector("[data-error]");

    if (input) {
        input.classList.add("error");
        errorMsgField.textContent = errMsg;
    }
};

const removeErrorMessage = (input) => {
    const field = input.parentNode;
    const errorMsgField = field.querySelector("[data-error]");

    if (input) {
        input.classList.remove("deep_error");
        errorMsgField.textContent = "";
    }
};

const beforeUnloadListener = (event) => {
    event.preventDefault();
    return (event.returnValue = "Are you sure you want to exit?");
};

var nameInput = document.getElementsByTagName("input");
for (var i = 0; i <nameInput.length; i++) {
    nameInput[i].addEventListener("input", (event) => {
        if (event.target.value !== "") {
            addEventListener("beforeunload", beforeUnloadListener, {
                capture: true,
            });
        } else {
            removeEventListener("beforeunload", beforeUnloadListener, {
                capture: true,
            });
        }
    });
}

//ajax to submit form
$(document).ready(function(){

    $("#companyForm").on("submit", function (event) {
        var companyForm = $(this);

        var form = new FormData(companyForm[0]);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/",
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            data: form,
        })
            .done(function (response) {
                //display message for your form submission

                if (response.reply== "companyDataSaved") {
                    companyForm.trigger("reset");
                    $("[data-ajax-input]").removeClass("is-invalid");
                    $("[data-ajax-feedback]").html("").removeClass("d-block");
                        location.href="/company-welcome";
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
            });
    });

});



