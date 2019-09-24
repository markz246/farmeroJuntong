$(document).ready(function () {

    ////// Check Category name if exist or not
    $("#catname").keyup(function () {

        var category_name = $("#catname").val();
        $.ajax({
            type: 'get',
            url: '/admin/check_category_name',
            data: {name: category_name},
            success: function (resp) {
                if (resp == "false") {
                    $("#chCategory_name").html("<span style='color: green;'><i class='fas fa-check'></i>This Name is OK!</span>");
                } else if (resp == "true") {
                    $("#chCategory_name").html("<span style='color: red;'><i class='fas fa-times'></i>The name has already been taken.</span>");
                }
            }, error: function () {
                alert("Error Ajax");
            }
        });

    });

    //File input product
    $('#inputfileProd').on('change',function(){
        var path = $(this).val();
        var fileName = path.replace(/C:\\fakepath\\/, '');
        $(this).next('.custom-file-label').html(fileName);
    });


    // Form Validation
    /*$("#basic_validate").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            date: {
                required: true,
                date: true
            },
            url: {
                required: true,
                url: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });*/

});

jQuery(document).ready(function($) {

    "use strict";

    var sitePlusMinus = function () {
        $('.js-btn-minus').on('click', function (e) {
            e.preventDefault();
            if ($(this).closest('.input-group').find('.form-control').val() != 1) {
                $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
            } else {
                $(this).closest('.input-group').find('.form-control').val(parseInt(1));
            }
        });
        $('.js-btn-plus').on('click', function (e) {
            e.preventDefault();
            if ($(this).closest('.input-group').find('.form-control').val() < 10) {
                $(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
            }
        });
    };
    sitePlusMinus();
});





function confirmDeleteCat() {
    return (confirm('Are you sure you want to delete this Category?'))
}

function confirmDeleteProdImg() {
    return (confirm('Are you sure you want to delete this image?'))
}

function confirmDeleteProduct() {
    return (confirm('Are you sure you want to delete this Product?'))
}

function confirmDeleteCoupon() {
    return (confirm('Are you sure you want to delete this Coupon?'))
}