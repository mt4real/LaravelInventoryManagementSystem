/*  Start of the add user using Ajax  */

const PRODUCT_URL="";
const SUPPLIED_PRODUCT_URL="";
const USER_URL="";
const CATEGORY_URL="";

$('#adminUserRegForm').on('submit', function(event){

    event.preventDefault();
    var regForm= $(this);
    var form = new FormData(regForm[0]);

    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
    });
    $.ajax({
        url:"/backend/add-user",
        type:'POST',
        cache : false,
        processData: false,
        contentType: false,
        data:form,

    })
    .done(function(response) {
            //display message for your form submission

            if (response.reply==="Saved") {

                regForm.trigger('reset');
                $('[data-ajax-input]').removeClass('is-invalid');
                $('[data-ajax-feedback]').html('').removeClass('d-block');
                var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                    keyboard: true,
                    backdrop:'static',
                    });
                    var modalTitle=document.querySelector('.modal-title');
                    var modalBody=document.querySelector('.modal-body');
                    modalTitle.textContent="Add User";
                    modalBody.textContent="User Successfully added,he/she needs to check his/her email for verification";
                    myModal.show();
                console.log(response);
            }
            })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });
        }

    })
    .always(function(response) {

    });



});

/*  ending of the add user using Ajax  */


/*  Start of the add category using Ajax  */

$('#adminAddCategory').on('submit', function(event){

    event.preventDefault();
    var categoryForm= $(this);

    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
    });
    $.ajax({
        url:"/backend/add-category",
        method:'POST',
        data:categoryForm.serialize()

    })
    .done(function(response) {
            //display message for your form submission

            if (response.reply==="categoryDataSaved") {

                categoryForm.trigger('reset');
                $('[data-ajax-input]').removeClass('is-invalid');
                $('[data-ajax-feedback]').html('').removeClass('d-block');
                var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                    keyboard: true,
                    backdrop:'static',
                    });
                    var modalTitle=document.querySelector('.modal-title');
                    var modalBody=document.querySelector('.modal-body');
                    modalTitle.textContent="Add Category";
                    modalBody.textContent="Category successfully added";
                    myModal.show();
                console.log(response);
            }
            })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });
        }

    })
    .always(function(response) {

    });



});

/*  ending of the add user using Ajax  */


/*  Start of the add supplied product using Ajax  */

$('#adminProductSupplied').on('submit', function(event){

    event.preventDefault();
    var addSuppliedProductForm= $(this);

    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
    });
    $.ajax({
        url:"/backend/add-supplied-product",
        method:'POST',
        data:addSuppliedProductForm.serialize()

    })
    .done(function(response) {
            //display message for your form submission

             if (response.reply==="productSuppliedSaved") {
               addSuppliedProductForm.trigger('reset');
                var hideSuppliedAlert=document.querySelector('#hideAlert');
                hideSuppliedAlert.style.display="block";
                hideSuppliedAlert.textContent=`You successfully add the product supplied, and the total amount of the product supplied is ${response.totalProductSupplied}`;
            }
            })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });
        }

    })
    .always(function(response) {

    });
});

/*  ending of the add supplied product using Ajax  */


/*  Start of the add product using Ajax  */

$('#adminAddProduct').on('submit', function(event){

    event.preventDefault();
    var addSuppliedProductForm= $(this);

    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
    });
    $.ajax({
        url:"/backend/add-product",
        method:'POST',
        data:addSuppliedProductForm.serialize()

    })
    .done(function(response) {
            //display message for your form submission

             if (response.reply==="productSaved") {
               addSuppliedProductForm.trigger('reset');
                var hideProductAlert=document.querySelector('#hideAlert');
                hideProductAlert.style.display="block";
                hideProductAlert.textContent=`Product successfully added, and the total amount of the product added to the stock is ${response.totalProductAmount}`;
            }
            })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });
        }

    })
    .always(function(response) {

    });
});



/*  ending of the add product using Ajax  */



$('#adminUserProfileForm').on('submit', function(event){

    event.preventDefault();

    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
    });
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false

    })
    .done(function(response) {
            //display message for your form submission

            if (response.reply==="Saved") {
                $('.profile_name').each(function(){
                    $(this).html($('#adminUserProfileForm').find($('input[name="name"]')).val());
                });
                $('[data-ajax-input]').removeClass('is-invalid');
                $('[data-ajax-feedback]').html('').removeClass('d-block');
                var myModal = new bootstrap.Modal(document.getElementById('userProfileMsgModal'), {
                    keyboard: true,
                    backdrop:'static',
                    });
                   myModal.show();
            }
            })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });

        }

    })
    .always(function(response) {

    });



});

/*  ending of the update user profile using Ajax  */



$(document).ready(function(){

    $.get("/backend/user-image", function(response){

       if(response.userImg){
        $('#userImage').html(`<img  class="img-fluid rounded w-100 profile_img" alt="Profile image" src="${response.userImg}"/>`);
       }
       else if(response.userAvatar){

        $('#userAvatar').html(`<img  class="img-fluid rounded w-100 profile_img" alt="Profile avatar" src="${response.userAvatar}"/>`);
       }

    });


        $('#updateUserAvatar').on('submit', function(){
            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            });
            $.post('/backend/user-avatar', function(response){

            //$("#profileAvatar").on("click", function () {
                $('#userAvatar').html(`<img  class="img-fluid rounded w-100 profile_img" alt="Profile avatar" src="${response.userProfileAvatar}"/>`);
              //});
           })
    });
    $('#updateUserProfileImage').on('submit', function(event){

        event.preventDefault();
        var img=$(this).find('img').attr('src');
        $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
        });
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false

        })
        .done(function(response,textStatus,jqXHR) {
                //display message for your form submission

                $('#updateUserProfileImage')[0].reset();

                if (response.reply) {
                    $('#userImage').html(`<img  class="img-fluid rounded w-100 profile_img" alt="Profile image" src="${response.updatedImg}"/>`);

                    $('[data-ajax-input]').removeClass('is-invalid');
                    $('[data-ajax-feedback]').html('').removeClass('d-block');
                    $("#hideAlert").show();
                    $("#hideAlert").text(
                        "Profile image updated successfully"
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


                })
        .fail(function(response) {
            $('[data-ajax-input]').removeClass('is-invalid');
            $('[data-ajax-feedback]').html('').removeClass('d-block');
            if (response.responseJSON.hasOwnProperty("errors")) {

                $.each(response.responseJSON.errors, function(index, val) {
                    /* iterate through array or object */
                    $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                    $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

                    console.log(response.responseText)
                });

            }

        })
        .always(function(response) {

        });



    });

})
/*  ending of the update user profile using Ajax  */





$(document).ready(function() {
    /*  start of checking of admin Password */

// Check Current User Password
$("#current_password").keyup(function(){
  var current_password= $(this).val();
  $('#current_password').mouseleave(function (){

    document.getElementById("current_password").style.border="";
    document.getElementById("current_password").style.boxShadow = "";

  });
  $.ajax({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   type:'post',
   url:'/backend/check-user-pwd',
   data:{current_password:current_password},
   success:function(resp){
     /*alert(resp);*/
     if(resp.noReply=="Failure"){

      document.getElementById("current_password").style.border="2px solid #F93154";
      document.getElementById("current_password").style.boxShadow = "0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255, 100, 255, 0.5)";


    }else if(resp.reply=="Success"){

    document.getElementById("current_password").style.border="2px solid #00B74A";
    document.getElementById("current_password").style.boxShadow = "0px 1px 1px rgb(144,238,144) inset, 0px 0px 8px rgb(144,238,144)";

    }
  },error:function(){
   alert("Error");
 }
});
});
})



$(document).ready(function(){


    $('#userChangePasswordForm').on('submit', function(event){

    event.preventDefault();

    var changePasswordForm= $(this).closest('form');

    $.ajax({
        url:"/backend/backend-change-password",
        method:'POST',
        data:changePasswordForm.serialize(),

    })
    .done(function(response) {
            //display message for your form submission

            if (response.reply=="Saved") {

                changePasswordForm.trigger('reset');
                $('[data-ajax-input]').removeClass('is-invalid');
                $('[data-ajax-feedback]').html('').removeClass('d-block');

                  var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                keyboard: true,
                backdrop:'static',
                });
                var modalTitle=document.querySelector('.modal-title');
                var modalBody=document.querySelector('.modal-body');
                modalTitle.textContent="User Change Password";
                modalBody.textContent="You Successfully Changed Your Password";
                myModal.show();
            }
            if(resp.noReply=="notSaved"){
            var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                keyboard: true,
                backdrop:'static',
                });
                var modalTitle=document.querySelector('.modal-title');
                var modalBody=document.querySelector('.modal-body');
                modalTitle.textContent="User Change Password";
                modalBody.textContent="Password changing failed";
                myModal.show();

        }

          })
    .fail(function(response) {
        $('[data-ajax-input]').removeClass('is-invalid');
        $('[data-ajax-feedback]').html('').removeClass('d-block');
        if (response.responseJSON.hasOwnProperty("errors")) {

            $.each(response.responseJSON.errors, function(index, val) {
                /* iterate through array or object */
                $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

            });
        }
    })
    .always(function(response) {
        console.log("complete");
    });



});
})
/*  ending of the Profile change password using Ajax  */


  //get get product price dropdown

  $(document).ready(function(){
    $('#product_id').change(function(){

        var product_id=$(this).val();

       $.ajax({

         type:'get',
         url:'/backend/get-product-price'+'/'+product_id,
         data:{'id':product_id},
         success:function(data,textStatus,jqXHR){
            $('#sale_price').val(data.sales.sale_price);
             },
             error:function(response){

               if(response){

                var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                    keyboard: true,
                    backdrop:'static',
                    });
                    var modalTitle=document.querySelector('.modal-title');
                    var modalBody=document.querySelector('.modal-body');
                    modalTitle.textContent="Error message";
                    modalBody.textContent="Hoops!!! Something went wrong";
                    myModal.show();

               }
            }


          });

    })
  })

 /*end of the get product price*/


 /* manage sales*/

$(document).ready(function(){
    var i=1;
       $.get("/backend/get-sales-data",function(response)
    {
        var html="";
        var salesDataBody=$('#salesPOSDataBody').html("");

        $.each(response.salesData,function(index,val)
        {
            html = '<tr>';
            html += '<td>'+`${index+1}`+'</td>';
            html += '<td>'+val.add_product.product_name+'</td>';
            html += '<td>'+val.price+'</td>';
            html += '<td>'+val.quantity+'</td>';
            html += '<td>'+val.total+'</td>';
            html += '<td>'+"<button type='button' class='btn btn-danger btn-lg'>Remove</button>"+'</td>';
            html += '</tr>';


            salesDataBody.append(html);
            $('#total_sales').text(response.grandTotal);
            $('#payment_total').text(response.grandTotal);

            //print receipt data
            $("#prd_name").text(`${val.add_product.product_name}`);
            $("#qty").text(`${val.quantity}`);
            $("#pr").text(`${val.price}`);
            $("#sub_total").text(`${val.total}`);
            $("#overAll_total").text(`${response.grandTotal}`);
            $(".company_name").text(`${response.companyBio}`);





        });
    });



   $('#salesPOS').on('submit', function(event){
     event.preventDefault();
     var POSForm= $(this).closest('form');
     $.ajax({
      url:"/backend/sales-pos",
      method:"POST",
      data:POSForm.serialize(),
      success:function(response){

        var html="";
        var salesDataBody=$('#salesPOSDataBody').html("");


        $.each(response.salesData, function(index,val){


            html =$('<tr><td>'
            +`${index+1}`+"</td><td>"
            +val.add_product.product_name+"</td><td>"
            +val.quantity+"</td><td>"
            +val.price+"</td><td>"
            +val.total+"</td><td>"
            +"<button type='button' class='btn btn-danger btn-lg'>Remove</button>"+"</td></tr>"
            );

            salesDataBody.append(html);
            $('#total_sales').text(response.grandTotal);
            $('#payment_total').text(response.grandTotal);
            $('#salesPOS')[0].reset();

        });


        if(response.lowQuantity){

            var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                keyboard: true,
                backdrop:'static',
                });
                var modalTitle=document.querySelector('.modal-title');
                var modalBody=document.querySelector('.modal-body');
                modalTitle.textContent="Low Product Quantity";
                modalBody.textContent=`${response.lowQuantity}`;
                myModal.show();

           }

           if(response.productInactive){

            var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                keyboard: true,
                backdrop:'static',
                });
                var modalTitle=document.querySelector('.modal-title');
                var modalBody=document.querySelector('.modal-body');
                modalTitle.textContent="Product Inactive";
                modalBody.textContent=`${response.productInactive}`;
                myModal.show();

           }


           if(response.duplicateProduct){

            var myModal = new bootstrap.Modal(document.getElementById('easySolutionModal'), {
                keyboard: true,
                backdrop:'static',
                });
                var modalTitle=document.querySelector('.modal-title');
                var modalBody=document.querySelector('.modal-body');
                modalTitle.textContent="Duplicate Product";
                modalBody.textContent=`${response.duplicateProduct}`;
                myModal.show();

           }


      },
      error:function(response){

           $('[data-ajax-input]').removeClass('is-invalid');
           $('[data-ajax-feedback]').html('').removeClass('d-block');
           if (response.responseJSON.hasOwnProperty("errors")) {

               $.each(response.responseJSON.errors, function(index, val) {
                   /* iterate through array or object */
                   $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                   $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

               });
            }
      }
     })
    });


   });



   //payment begins here

   $(document).ready(function(){
        $('#salesPayment').on('submit', function(event){
            event.preventDefault();
            var paymentForm= $(this).closest('form');
            $.ajax({
                url:"/backend/sales-payment",
                method:"POST",
                data:paymentForm.serialize(),
                success:function(response){
                    if(response.invalidAmount){
                        $('#invalid_amount').text(`${response.invalidAmount}`);
                        $('#paid_amount').css('border-color',"#DC4C64");
                    }
                    $("#paid_amount").on('focus', function(){

                        $('#invalid_amount').text("");
                        $('#paid_amount').css('border-color',"");
                        $('#paid_amount').html("");
                    })

                    //store data in local storage
                    window.localStorage.setItem('PAID_AMOUNT',`${response.paymentData.paid_amount}`);
                    window.localStorage.setItem('CUSTOMER_CHANGE',`${response.paymentData.change_amount}`);
                    window.localStorage.setItem('BALANCE_COLLECT', `${response.paymentData.change_amount}`);
                    window.localStorage.setItem('CUSTOMER_NAME',`${response.paymentData.customer_name}`);


                    //show money received from customer
                    $("#paid_amount").val(window.localStorage.getItem('PAID_AMOUNT'));
                    //display customer change if the right amount is entered
                    $("#customer_change").text('CUSTOMER_CHANGE');
                    console.log(response.paymentData);
                    //display customer change if the right amount is entered
                    $("#balance_collect").text('BALANCE_COLLECT');
                    //display customer name
                    $('#customerName').text('CUSTOMER_NAME');

                },
                error:function(response){

                    $('[data-ajax-input]').removeClass('is-invalid');
                    $('[data-ajax-feedback]').html('').removeClass('d-block');
                    if (response.responseJSON.hasOwnProperty("errors")) {

                        $.each(response.responseJSON.errors, function(index, val) {
                            /* iterate through array or object */
                            $('[data-ajax-input="'+index+'"]').addClass('is-invalid');
                            $('[data-ajax-feedback="'+index+'"]').html(val[0]).addClass('d-block');

                        });
                     }
               }
        });
   });
});


const $btnPrint = document.querySelector("#printReceipt");
$btnPrint.addEventListener("click", () => {
    window.print();
});






