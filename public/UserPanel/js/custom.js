var buttonPress = 0;
function doubleClick(){
    alert('処理中です');
}
function filterProductList(thisAttr, category = null, brand = null, gender = null, price = null, offer = null, sub_category = null) {
    //if (category != null) {
    //    var id = thisAttr.attr('for');
    //    if ($('#' + id).is(':checked')) {
    //        $("#product_cat").val("");
    //    } else {
    //        $("#product_cat").val(category);
    //        $("#product_sub_cat").val("");
    //    }
    //}
     
    //if (sub_category != null) {
    //    var temp_sub_category = sub_category.split('-')[0];
    //    var temp_category = sub_category.split('-')[1];
    //    var id = thisAttr.attr('for');
    //    if ($('#' + id).is(':checked')) {
    //        $("#product_sub_cat").val("");
    //        $("#product_cat").val("");
    //    } else {
    //        $("#product_sub_cat").val(temp_sub_category);
    //        $("#product_cat").val(temp_category);
    //    }
    //}
    
    //if (brand != null) {
    //    var brandId = thisAttr.attr('for');
    //    if ($('#' + brandId).is(':checked')) {
    //        //$("#product_brand").val("");
    //    } else {
    //        //$("#product_brand").val(brand);
    //    }
    //}
    
    //if (gender != null) {
    //    var genderId = thisAttr.attr('for');
    //    if ($('#' + genderId).is(':checked')) {
    //        //$("#product_type").val("");
    //    } else {
    //        //$("#product_type").val(gender);
    //    }
    //}
    
    //if (price != null) {
    //    var priceRange = thisAttr.attr('for');
    //    if ($('#' + priceRange).is(':checked')) {
    //        //$("#product_price").val("");
    //    } else {
    //        //$("#product_price").val(price);
    //    }
    //}
    
    //if (offer != null) {
    //    var off = thisAttr.attr('for');
    //    if ($('#' + off).is(':checked')) {
    //        //$("#product_off").val("");
    //    } else {
    //        //$("#product_off").val(offer);
    //    }
    //}
    setTimeout(function(){ 
        document.getElementById('productListForm').submit();
    }, 300);
}

function filterProductListForMobile(thisAttr, category = null, brand = null, gender = null, price = null, offer = null, sub_category = null) {
    //if (category != null) {
    //    var id = thisAttr.attr('for');
    //    if ($('#' + id).is(':checked')) {
    //        $("#product_cat").val("");
    //    } else {
    //        $("#product_cat").val(category);
    //        $("#product_sub_cat").val("");
    //    }
    //}
    
    //if (sub_category != null) {
    //    var temp_sub_category = sub_category.split('-')[0];
    //    var temp_category = sub_category.split('-')[1];
    //    var id = thisAttr.attr('for');
    //    if ($('#' + id).is(':checked')) {
    //        $("#product_sub_cat").val("");
    //        $("#product_cat").val("");
    //    } else {
    //        $("#product_sub_cat").val(temp_sub_category);
    //        $("#product_cat").val(temp_category);
    //    }
    //}
    
    //if (brand != null) {
    //    var brandId = thisAttr.attr('for');
    //    if ($('#' + brandId).is(':checked')) {
    //        //$("#product_brand").val("");
    //    } else {
    //        //$("#product_brand").val(brand);
    //    }
    //}
    
    //if (gender != null) {
    //    var genderId = thisAttr.attr('for');
    //    if ($('#' + genderId).is(':checked')) {
    //        //$("#product_type").val("");
    //    } else {
    //        //$("#product_type").val(gender);
    //    }
    //}
    
    //if (price != null) {
    //    var priceRange = thisAttr.attr('for');
    //    if ($('#' + priceRange).is(':checked')) {
    //        //$("#product_price").val("");
    //    } else {
    //        //$("#product_price").val(price);
    //    }
    //}
    
    //if (offer != null) {
    //    var off = thisAttr.attr('for');
    //    if ($('#' + off).is(':checked')) {
    //        //$("#product_off").val("");
    //    } else {
    //        //$("#product_off").val(offer);
    //    }
    //}
    setTimeout(function(){ 
        document.getElementById('productListMobileMenuForm').submit();
    }, 200);
}

function categoryWiseProductFilter(thisAttr, category = null,sub_category = null) {
    if (category != null) {
        $("#c_product_cat").val(category);
        $("#c_product_sub_cat").val("");
    }
    if (sub_category != null) {
        var temp_sub_category = sub_category.split('-')[0];
        var temp_category = sub_category.split('-')[1];
        $("#c_product_sub_cat").val(temp_sub_category);
        $("#c_product_cat").val(temp_category);
    }
    
    
    document.getElementById('commonProductListForm').submit();
}

function filterBrandProduct(brand = null) {
    if (brand != null) {
        $("#menu_product_brand").val(brand);
    }
    document.getElementById('brandProductFilter').submit();
}

function updateTotalCal(thisItem, rowId) {
    var qty = thisItem.find('.qty-val').html();
    var url = "updateQty";
    var data = "rowId=" + rowId;
    $.ajax({
        type: "GET",
        url: url,
        async: false,
        data: data,
        success: function(result) {

        }
    });
}


function userRegister() {
    
    var data = $('#userRegister').serialize();
    var url = "registerUser";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                if (window.location.href.includes("loadAuthenticationPage")) {
                    window.location.href = '/completedAuthen'
                }else{
                    location.reload();
                }
                
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                //if (result.err_msg) {
                //    html = '<div>';
                //    for (var count = 0; count < result.err_msg.length; count++) {
                //        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                //    }
                //    html += '</div>';
                //    $('#error_data').html(html);
                //    if (true) {}
                //    $("#error_data").show();
                //}

                if (inputError.username) {
                    $('#reg_username').addClass("error");
                    $('#err_username').html(inputError.username[0]);
                } else {
                    $('#reg_username').removeClass("error");
                    $('#err_username').html("");
                }

                if (inputError.email) {
                    $('#reg_email').addClass("error");
                    $('#err_email').html(inputError.email[0]);
                } else {
                    $('#reg_email').removeClass("error");
                    $('#err_email').html("");
                }

                if (inputError.password) {
                    $('#reg_password').addClass("error");
                    $('#err_password').html(inputError.password[0]);
                } else {
                    $('#reg_password').removeClass("error");
                    $('#err_password').html("");
                }
                if (inputError.confirm_password) {
                    $('#reg_con_password').addClass("error");
                    $('#err_con_password').html(inputError.confirm_password[0]);
                } else {
                    $('#reg_con_password').removeClass("error");
                    $('#err_con_password').html("");
                }

            }
        }
    });
}


function updateUser() {

    var data = $('#updateUser').serialize();
    var url = "updateUser";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                //location.reload();
                $("#infoEditModal").modal('hide');
                $('#user_info').removeClass('d-none') 
            }else if ($.trim(result) == 'login_page') {
                window.location.href = "loadAuthenticationPage";
            }else if ($.trim(result) == 'ng') {
                location.reload();
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 15px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_update_user').html(html);

                    if (true) {}
                    $("#error_update_user").show();
                }

                if (inputError.name) {
                    $('#edit_name').addClass("error");
                } else {
                    $('#edit_name').removeClass("error");
                }

                if (inputError.furigana) {
                    $('#edit_furigana').addClass("error");
                } else {
                    $('#edit_furigana').removeClass("error");
                }

                if (inputError.email) {
                    $('#edit_email').addClass("error");
                } else {
                    $('#edit_email').removeClass("error");
                }
                
                if (inputError.new_password) {
                    $('#new_password').addClass("error");
                } else {
                    $('#new_password').removeClass("error");
                }
                
                if (inputError.confirm_password) {
                    $('#confirm_password').addClass("error");
                } else {
                    $('#confirm_password').removeClass("error");
                }

                if (inputError.zipcode1) {
                    $('#edit_zipcode1').addClass("error");
                } else {
                    $('#edit_zipcode1').removeClass("error");
                }

                if (inputError.zipcode2) {
                    $('#edit_zipcode2').addClass("error");
                } else {
                    $('#edit_zipcode2').removeClass("error");
                }
                
                if (inputError.prefecture) {
                    $('#edit_prefecture').addClass("error");
                } else {
                    $('#edit_prefecture').removeClass("error");
                }
                
                if (inputError.ciadd) {
                    $('#edit_ciadd').addClass("error");
                } else {
                    $('#edit_ciadd').removeClass("error");
                }
                
                if (inputError.address1) {
                    $('#edit_address1').addClass("error");
                } else {
                    $('#edit_address1').removeClass("error");
                }
                
                if (inputError.address2) {
                    $('#edit_address2').addClass("error");
                } else {
                    $('#edit_address2').removeClass("error");
                }
                
                if (inputError.phone) {
                    $('#edit_phone').addClass("error");
                } else {
                    $('#edit_phone').removeClass("error");
                }

                if (inputError.year) {
                    $('#edit_year').addClass("error");
                } else {
                    $('#edit_year').removeClass("error");
                }
                if (inputError.month) {
                    $('#edit_month').addClass("error");
                } else {
                    $('#edit_month').removeClass("error");
                }
                if (inputError.day) {
                    $('#edit_day').addClass("error");
                } else {
                    $('#edit_day').removeClass("error");
                }

            }
        }
    });
}

function updateHaisouData() {
    var data = $('#updateHaisouData').serialize();
    var url = "updateHaisouData";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                //location.reload();
                $("#deliveryEditModal").modal('hide');
                $('#delivery_add').removeClass('d-none') 
            }else if ($.trim(result) == 'ng') {
                //location.reload();
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 15px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_update_haisou').html(html);

                    if (true) {}
                    $("#error_update_haisou").show();
                }

                if (inputError.name) {
                    $('#haisou_name').addClass("error");
                } else {
                    $('#haisou_name').removeClass("error");
                }

                if (inputError.furigana) {
                    $('#haisou_furigana').addClass("error");
                } else {
                    $('#haisou_furigana').removeClass("error");
                }

                if (inputError.zipcode1) {
                    $('#haisou_zipcode_1').addClass("error");
                } else {
                    $('#haisou_zipcode_2').removeClass("error");
                }

                if (inputError.zipcode2) {
                    $('#edit_zipcode2').addClass("error");
                } else {
                    $('#edit_zipcode2').removeClass("error");
                }
                
                if (inputError.prefecture) {
                    $('#haisou_prefecture_grp').addClass("error");
                } else {
                    $('#haisou_prefecture_grp').removeClass("error");
                }

                if (inputError.address) {
                    $('#haisou_address').addClass("error");
                } else {
                    $('#haisou_address').removeClass("error");
                }
                
                if (inputError.phone) {
                    $('#haisou_phone').addClass("error");
                } else {
                    $('#haisou_phone').removeClass("error");
                }

            }
        }
    });
}

$("#deliveryAddressOpen").click(function(){
    var haisou_name = $("#hidden_haisou_name").val();
    var haisou_furigana = $("#hidden_haisou_furigana").val();
    var haisou_zipcode_1 = $("#hidden_haisou_zipcode_1").val();
    var haisou_zipcode_2 = $("#hidden_haisou_zipcode_2").val();
    var haisou_prefecture = $("#hidden_haisou_prefecture").val();
    var haisou_address = $("#hidden_haisou_address").val();
    var haisou_phone = $("#hidden_haisou_phone").val();
    
    $("#haisou_name").val(haisou_name);
    $("#haisou_furigana").val(haisou_furigana);
    $("#haisou_zipcode_1").val(haisou_zipcode_1);
    $("#haisou_zipcode_2").val(haisou_zipcode_2);
    $('#haisou_prefecture').select2().val(haisou_prefecture);
    $('#haisou_prefecture').select2().trigger('change');
    $("#haisou_address").val(haisou_address);
    $("#haisou_phone").val(haisou_phone);
});

function updateUserPassword() {
    var data = $('#updatePassword').serialize();
    var url = "updateUserPassword";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                window.location.href = "loadAuthenticationPage";
            } else if ($.trim(result) == 'ng') {
                location.reload();
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 15px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_update_password').html(html);

                    if (true) {}
                    $("#error_update_password").show();
                }

                if (inputError.password) {
                    $('#password').addClass("error");
                } else {
                    $('#password').removeClass("error");
                }

                if (inputError.npassword) {
                    $('#npassword').addClass("error");
                } else {
                    $('#npassword').removeClass("error");
                }

                if (inputError.cpassword) {
                    $('#cpassword').addClass("error");
                } else {
                    $('#cpassword').removeClass("error");
                }

            }
        }
    });
}

function userLogin(route = null) {
    //if (route != null) {
    //    var redirect = route;
    //} else {
    //    var redirect = 'cartItemList';
    //}
    var data = $('#userLogin').serialize();
    var url = "loginUser";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result.status) == 'ok') {
                var redirect = result.redirect;
                if(redirect == 'homepage'){
                    document.getElementById('home').click();
                }else if(redirect == ''){
                    //location.reload();
                }else{
                  window.location.href = redirect;  
                }
            } else if ($.trim(result.status) == 'ng') {
                html = '<p style="color:red;font-size: 13px;">入力された項目に誤りがあります。<br>ご確認のうえ、再度ご入力をお願いいたします。</p>';
                $('#login_email').removeClass("error");
                $('#login_password').removeClass("error");
                $('#err_login_email').html("");
                $('#err_login_password').html("");
                $('#login_error_data').html(html);
            } else {
                $('#login_error_data').html("");
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                //if (result.err_msg) {
                //    html = '<div>';
                //    for (var count = 0; count < result.err_msg.length; count++) {
                //        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                //    }
                //    html += '</div>';
                //    $('#login_error_data').html(html);
                //    if (true) {}
                //    $("#login_error_data").show();
                //}

                if (inputError.email) {
                    $('#login_email').addClass("error");
                    $('#err_login_email').html(inputError.email[0]);
                } else {
                    $('#login_email').removeClass("error");
                    $('#err_login_email').html("");
                }

                if (inputError.password) {
                    $('#login_password').addClass("error");
                    $('#err_login_password').html(inputError.password[0]);
                } else {
                    $('#login_password').removeClass("error");
                    $('#err_login_password').html("");
                }

            }
        }
    });
}

//==============  productDetails page js starts here =============//
function sizeSelection(own, size, product_id) {
    $(".pt_size").css("background", "#fff");
    $(own).css("background", "#f3f5f5");
    $("#req_size").val(size);
}

function colorSelection(own, color, product_id) {
    $(".pt_color").css("background", "#fff");
    $(own).css("background", "#f3f5f5");
    $("#req_color").val(color);
}

function addToCart(url) {
    //var color = $(".color-filter  li.active  a").data('color');
    //var size = $(".size-filter  li.active  a").html();
    var qty = $(".qty-val").val();
    //$("#req_color").val(color);
    //$("#req_size").val(size);
    $("#req_qty").val(qty);
    var data = $('#addToCart').serialize();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                window.location.href = base_url + "/cartItemList";
            }
            else if($.trim(result) == 'out_of_stock'){
                var html = "<span style='color:red;'>在庫がありません。</span>";
                $("#add-to-cart-status-modal-content").html(html);
                $("#add-to-cart-status-modal").modal('show');
            }
            else {
                location.reload();
            }
        }
    });
}

function quickAddToCart(url) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function(result) {
           
            if ($.trim(result.status) == 'ok') {
                $("#add-to-cart-status-modal-content").html('カートに追加しました。');
                $("#add-to-cart-status-modal").modal('show');
                
                document.getElementById("mini_cartlist").scrollIntoView({ behavior: "smooth" });
                
                $("#mini_cartlist").html($.trim(result.mini_cartlist_html));
            }
            else if($.trim(result.status) == 'out_of_stock'){
                var html = "<span style='color:red;'>在庫がありません。</span>";
                $("#add-to-cart-status-modal-content").html(html);
                $("#add-to-cart-status-modal").modal('show');
            }

            /*else {
                location.reload();
            }*/
        }
    });
}
//==============  productDetails page js ends here =============//

function placeOrder(url) {
    var data = $('#placeOrder').serialize();
    var dataArr = $('#placeOrder').serializeArray();
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result.status) == 'ok') {
                $("#userId").val(result.user_id);
                //$("#haisouBango").val(result.haisou_bango);
                //append form data
                for (let i = 0; i < dataArr.length; i++) {
                    if(dataArr[i].name != "_token"){
                        var input = '<input type="hidden" name="'+dataArr[i].name+'" value="'+dataArr[i].value+'"/>';
                    }
                    $("#goToPayment").append(input);
                }
                $("#goToPayment").submit();
            } else if ($.trim(result.status) == 'ng') {
                location.reload();
            }else if ($.trim(result.status) == 'stock_out') {
                window.location.href='cartItemList';
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                if (inputError.name) {
                    $('#name').addClass("error");
                    $('#err_name').html(inputError.name[0]);
                } else {
                    $('#name').removeClass("error");
                    $('#err_name').html("");
                }

                if (inputError.furigana) {
                    $('#furigana').addClass("error");
                    $('#err_furigana').html(inputError.furigana[0]);
                } else {
                    $('#furigana').removeClass("error");
                    $('#err_furigana').html("");
                }
                
                if (inputError.email) {
                    $('#email').addClass("error");
                    $('#err_email').html(inputError.email[0]);
                } else {
                    $('#email').removeClass("error");
                    $('#err_email').html("");
                }

                if (inputError.zipcode1) {
                    $('#zipcode_first_part').addClass("error");
                    $('#err_zipcode1').html(inputError.zipcode1[0]);
                } else {
                    $('#zipcode_first_part').removeClass("error");
                    $('#err_zipcode1').html("");
                }

                if (inputError.zipcode2) {
                    $('#zipcode_second_part').addClass("error");
                    $('#err_zipcode2').html(inputError.zipcode2[0]);
                } else {
                    $('#zipcode_second_part').removeClass("error");
                    $('#err_zipcode2').html("");
                }

                if (inputError.prefecture) {
                    $('#prefecture_grp').addClass("error");
                    $('#err_prefecture').html(inputError.prefecture[0]);
                } else {
                    $('#prefecture_grp').removeClass("error");
                    $('#err_prefecture').html("");
                }

                if (inputError.address1) {
                    $('#address1').addClass("error");
                    $('#err_address1').html(inputError.address1[0]);
                } else {
                    $('#address1').removeClass("error");
                    $('#err_address1').html("");
                }

                if (inputError.address2) {
                    $('#address2').addClass("error");
                    $('#err_address2').html(inputError.address2[0]);
                } else {
                    $('#address2').removeClass("error");
                    $('#err_address2').html("");
                }
                
                if (inputError.biladd) {
                    $('#biladd').addClass("error");
                    $('#err_biladd').html(inputError.biladd[0]);
                } else {
                    $('#biladd').removeClass("error");
                    $('#err_biladd').html("");
                }

                if (inputError.phone) {
                    $('#phone').addClass("error");
                    $('#err_phone').html(inputError.phone[0]);
                } else {
                    $('#phone').removeClass("error");
                    $('#err_phone').html("");
                }

                ///
                if (inputError.diff2_name) {
                    $('#diff2_name').addClass("error");
                    $('#err_diff2_name').html(inputError.diff2_name[0]);
                } else {
                    $('#diff2_name').removeClass("error");
                    $('#err_diff2_name').html("");
                }

                if (inputError.diff2_furigana) {
                    $('#diff2_furigana').addClass("error");
                    $('#err_diff2_furigana').html(inputError.diff2_furigana[0]);
                } else {
                    $('#diff2_furigana').removeClass("error");
                    $('#err_diff2_furigana').html("");
                }
                
                if (inputError.diff2_email) {
                    $('#diff2_email').addClass("error");
                    $('#err_diff2_email').html(inputError.diff2_email[0]);
                } else {
                    $('#diff2_email').removeClass("error");
                    $('#err_diff2_email').html("");
                }

                if (inputError.diff2_zipcode1) {
                    $('#diff2_zipcode_first_part').addClass("error");
                    $('#err_diff2_zipcode1').html(inputError.diff2_zipcode1[0]);
                } else {
                    $('#diff2_zipcode_first_part').removeClass("error");
                    $('#err_diff2_zipcode1').html("");
                }

                if (inputError.diff2_zipcode2) {
                    $('#diff2_zipcode_second_part').addClass("error");
                    $('#err_diff2_zipcode2').html(inputError.diff2_zipcode2[0]);
                } else {
                    $('#diff2_zipcode_second_part').removeClass("error");
                    $('#err_diff2_zipcode2').html("");
                }

                if (inputError.diff2_prefecture) {
                    $('#diff2_prefecture_grp').addClass("error");
                    $('#err_diff2_prefecture').html(inputError.diff2_prefecture[0]);
                } else {
                    $('#diff2_prefecture_grp').removeClass("error");
                    $('#err_diff2_prefecture').html("");
                }

                if (inputError.diff2_address1) {
                    $('#diff2_address1').addClass("error");
                    $('#err_diff2_address1').html(inputError.diff2_address1[0]);
                } else {
                    $('#diff2_address1').removeClass("error");
                    $('#err_diff2_address1').html("");
                }

                if (inputError.diff2_address2) {
                    $('#diff2_address2').addClass("error");
                    $('#err_diff2_address2').html(inputError.diff2_address2[0]);
                } else {
                    $('#diff2_address2').removeClass("error");
                    $('#err_diff2_address2').html("");
                }
                
                if (inputError.diff2_biladd) {
                    $('#diff2_biladd').addClass("error");
                    $('#err_diff2_biladd').html(inputError.diff2_biladd[0]);
                } else {
                    $('#diff2_biladd').removeClass("error");
                    $('#err_diff2_biladd').html("");
                }

                if (inputError.diff2_phone) {
                    $('#diff2_phone').addClass("error");
                    $('#err_diff2_phone').html(inputError.diff2_phone[0]);
                } else {
                    $('#diff2_phone').removeClass("error");
                    $('#err_diff2_phone').html("");
                }
                $(".error:first").focus();
            }
        }
    });
}
function back_payment(){
    $('#goToPaymentMethod').submit()
}

function createOrder(url) {
    buttonPress++;
    if (buttonPress == 1) {
        var data = $('#createOrder').serialize();
        var dataArr = $('#createOrder').serializeArray();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(result) {
                if ($.trim(result.status) == 'ok') {
                    for (let i = 0; i < dataArr.length; i++) {
                        if(dataArr[i].name != "_token"){
                            var input = '<input type="hidden" name="'+dataArr[i].name+'" value="'+dataArr[i].value+'"/>';
                        }
                        $("#goToPaymentMethod").append(input);
                    }
                    

                    $("#goToPaymentMethod").submit();
                } else if ($.trim(result.status) == 'ng') {
                    location.reload();
                }else if ($.trim(result.status) == 'stock_out') {
                    //window.location.href='cartItemList';
                    $("#goToPaymentMethod").submit();
                } else {
                    var inputError = result.err_field;
                    console.log(inputError);
                    buttonPress = 0;
                    
                    var html = '';
                    if (result.err_msg) {
                        html = '<div>';
                        for (var count = 0; count < result.err_msg.length; count++) {
                            html += '<p style="color:red;font-size: 15px;">' + result.err_msg[count] + '</p>';
                        }
                        html += '</div>';
                        $('#payment_err_data').html(html);
                        $("#payment_err_data").show();
                    }

                    if (inputError.delivery_date) {
                        $('#delivery_date').addClass("error");
                    } else {
                        $('#delivery_date').removeClass("error");
                    }

                    if (inputError.delivery_time) {
                        $('#delivery_time').addClass("error");
                    } else {
                        $('#delivery_time').removeClass("error");
                    }

                }
            }
        });
    }else{
        doubleClick();
    }
}

function checkTransaction() {
    buttonPress++;
    if (buttonPress == 1) {
        event.preventDefault();
        var data = $('#paymentHistory').serialize();
        var url = "paymentHistory";
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(result) {
             
                if (typeof(result) == 'object') {
                  $("#webcollectToken").val(result.webcollectToken)
                  $("#settlement_charge").val(result.settlement_charge)
                  $("#delivery_charge").val(result.delivery_charge)
                  $("#payment_method").val(result.payment_method)
                  $("#price_display").val(result.price_display)
                  $("#inquiry").val(result.inquiry)
                  $("#total_amount").val(result.total_amount)
                 
                  $("#goToOrderKakunin").submit();
                } else if ($.trim(result) == 'ng') {
                    location.reload();
                    //$("#goToPaymentMethod").submit();
                }else if ($.trim(result) == 'stock_out') {
                    $("#goToPaymentMethod").submit();
                } 
            }

        });
    }else{
        doubleClick();
    }
    
} 
function submit_order()
{
    buttonPress++;
    if (buttonPress == 1) {
        event.preventDefault();
        var data = $('#orderComplete').serialize();
        var url = "orderComplete";
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(result) {
             console.log(result)
                if (typeof(result) == 'object') {
                  $("#order_id").val(result.order_no)
                  $("#submit_order").prop('disabled', true)
                    
                  $("#checkout_final_page").submit();
                } else if ($.trim(result) == 'ng') {
                    $("#goToPaymentMethod").submit();
                }else if ($.trim(result) == 'stock_out') {
                    $("#goToPaymentMethod").submit();
                }
            },
            error: function(){
                $("#goToPaymentMethod").submit();
            }

        });
    }else{
        doubleClick();
    }
}
function orderConfirmation() {
    buttonPress++;
    if (buttonPress == 1) {
        var data = $('#orderConfirmationForm').serialize();
        var url = "orderConfirmation";
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(result) {
                console.log(result);
                if ($.trim(result) == 'ok') {
                    window.location.href = base_url + "/productList";
                } else if ($.trim(result) == 'ng') {
                    location.reload();
                }else if ($.trim(result) == 'stock_out') {
                    window.location.href = base_url + "/cartItemList";
                } else {

                }
            }
        });
    }else{
        doubleClick();
    }
    
}

function gotoPaymentPage(){
    $("#goToPayment").submit();
}

function gotoPaymentMethod(){
    $("#goToPaymentMethod").submit();
}

$("#addNewAddress").click(function() {
    $("#email_grp").css("display", "initial");
    $("#name").val("");
    $("#furigana").val("");
    $("#zipcode_first_part").val("");
    $("#zipcode_second_part").val("");
    $("#prefecture").val("").trigger('change');
    $("#address1").val("");
    $("#address2").val("");
    $("#company_name").val("");
    $("#phone").val("");
});

/*$("#shipToCurrentAddress").click(function() {
    $("#email_grp").css("display", "none");
    var name = $("#temp_name").val();
    $("#name").val(name);
    var furigana = $("#temp_furigana").val();
    $("#furigana").val(furigana);
    var zipcode1 = $("#temp_zipcode1").val();
    $("#zipcode_first_part").val(zipcode1);
    var zipcode2 = $("#temp_zipcode2").val();
    $("#zipcode_second_part").val(zipcode2);
    var prefecture = $("#temp_prefecture").val();
    $("#prefecture").val(prefecture).trigger('change');
    var address1 = $("#temp_address1").val();
    $("#address1").val(address1);
    var address2 = $("#temp_address2").val();
    $("#address2").val(address2);
    var company_name = $("#temp_company_name").val();
    $("#company_name").val(company_name);
    var phone = $("#temp_phone").val();
    $("#phone").val(phone);
});*/

function calCartResult(own) {
    var product_id = own.parents('tr').find('.product_id').val();
    var temp_qty = own.val();
    var url = base_url+"/checkStock/"+temp_qty+"/"+product_id;
    $.ajax({
        type:"GET",
        async:false,
        url:url,
        success:function(result){
            console.log(result);
            if ($.trim(result.status) == 'ok') {
                own.val(result.qty)
            }
        }
    });
    
    
    var price = own.parents('tr').find('.item_price').val();
    var qty = own.val();
    var subtotal = numberFormat(price * qty);
    var grand_subtotal = 0;
    own.parents('tr').find('.item_subtotal').html(subtotal)
    $(".item_subtotal").each(function() {
        grand_subtotal = grand_subtotal + parseInt($(this).html().replace(',', ''));
    });
    $("#grand_subtotal").html(numberFormat(grand_subtotal));
}

//==============  contact page js starts here =============//
function contactMail(url, pageName = null) {
    if (pageName == "productDetails") {
        var data = $('#addToCart').serialize();
    } else {
        var data = $('#contactMail').serialize();
    }
    //var url = "contactMail";
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                if (pageName == "productDetails") {
                    $(".collapsibles-body").slideToggle("slow");
                    $(".angel-icon i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
                    var html = "<p style='color: #56ad6a;background-color: #ecfef0;border: 1px solid #56ad6a;'>お問い合わせいただき、ありがとうございます。内容を確認後、早急にご返信させて頂きます。</p>";
                    $("#contact_name").val("");
                    $("#contact_email").val("");
                    $("#contact_message").val("");
                    $("#contact_name").removeClass('error');
                    $("#contact_email").removeClass('error');
                    $("#contact_message").removeClass('error');
                    $('#mail_msg').html(html);
                } else {
                    location.reload();
                }
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                //if (result.err_msg) {
                //    html = '<div>';
                //    for (var count = 0; count < result.err_msg.length; count++) {
                //        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                //    }
                //    html += '</div>';
                //    $('#contact_error_data').html(html);
                //    $("#contact_error_data").show();
                //}

                if (inputError.name) {
                    $('#contact_name').addClass("error");
                    $('#err_name').html(inputError.name[0]);
                } else {
                    $('#contact_name').removeClass("error");
                    $('#err_name').html("");
                }

                if (inputError.email) {
                    $('#contact_email').addClass("error");
                    $('#err_email').html(inputError.email[0]);
                } else {
                    $('#contact_email').removeClass("error");
                    $('#err_email').html("");
                }

                if (inputError.subject) {
                    $('#contact_subject').addClass("error");
                    $('#err_subject').html(inputError.subject[0]);
                } else {
                    $('#contact_subject').removeClass("error");
                    $('#err_subject').html("");
                }
                if (inputError.message) {
                    $('#contact_message').addClass("error");
                    $('#err_message').html(inputError.message[0]);
                } else {
                    $('#err_message').html("");
                    $('#contact_message').removeClass("error");
                }

            }
        }
    });
}
//==============  contact page js ends here =============//

function openProductDetails(product_id,url) {
    $.ajax({
        type:"GET",
        url:url,
        data:"product_id="+product_id,
        success:function(result){
            console.log(result.view);
            $("#productDetailsModal").html(result.view);
            $(".viewCartModal").addClass("show");
        }
    }); 
}

//stock qty check starts here
$(".qty-up").click(function(event){
    event.preventDefault();
    var product_id = $("#product_id").val();
    var qty = parseInt($(".qty-val").val())+1;
    var url = base_url+"/checkStock/"+qty+"/"+product_id;
    $.ajax({
        type:"GET",
        async:false,
        url:url,
        success:function(result){
            console.log(result);
            if ($.trim(result.status) == 'ok') {
                $(".qty-val").val(result.qty);
            }
        }
    });
});

$(".qty-down").click(function(event){
    event.preventDefault();
    var stock_status = $("#stock_status").val();
    if(stock_status == 'stock_out'){
        return false;
    }
    var product_id = $("#product_id").val();
    var prev_qty = $(".qty-val").val();
    var qty = prev_qty - 1;
    if(qty < 1){
       qty = 1; 
    }
    //$(".qty-val").val(qty)
    
    var url = base_url+"/checkStock/"+qty+"/"+product_id;
    $.ajax({
        type:"GET",
        async:false,
        url:url,
        success:function(result){
            console.log(result);
            if ($.trim(result.status) == 'ok') {
                $(".qty-val").val(result.qty);
            }
        }
    });
    
});

$(".qty-val").keyup(function(event){
    event.preventDefault();
    var product_id = $("#product_id").val();
    var temp_qty = $(".qty-val").val();
    if(temp_qty != ""){
        var qty = parseInt(temp_qty);
        var url = base_url+"/checkStock/"+qty+"/"+product_id;
        $.ajax({
            type:"GET",
            async:false,
            url:url,
            success:function(result){
                console.log(result);
                if ($.trim(result.status) == 'ok') {
                    $(".qty-val").val(result.qty);
                }
            }
        });
    }
});
//stock qty check ends here

function orderDetails(order_no){
    $.ajax({
        type:"GET",
        url:"orderDetails/"+order_no,
        success:function(result){
            console.log(result);
            $("#orderDetailsModal").html(result.view);
            $("#orderDetails").modal('show');
        }
    });
}

function hideOrderDetailsModal(){
    $("#orderDetails").modal('hide');
}

function resetPassword(){
    var data = $('#resetPass').serialize();
    $.ajax({
        type: 'POST',
        url: 'resetPassword',
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                $('#email').val("");
                $('#email').removeClass("error");
                var html = '<p style="font-size: 12px;font-weight: bold;color:green;">送信完了しました。</p>';
                html += '<p style="font-size: 12px;font-weight: bold;color:green;">ただいま、再設定用のURLをご登録メールアドレス宛てにお送りいたしました。</p>';
                html += '<p style="font-size: 12px;font-weight: bold;color:green;">ご確認をお願いいたします。</p>';
                $('#resetpass_error_data').html(html);
                $("#resetpass_error_data").show();
            } else {
                var inputError = result.err_field;

                var html = '';
                if (result.err_msg) {
                    html = '<div>';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';
                    $('#resetpass_error_data').html(html);
                    $("#resetpass_error_data").show();
                }

                if (inputError.email) {
                    $('#email').addClass("error");
                } else {
                    $('#email').removeClass("error");
                }
            }
        }
    });
}

function resetPass(){
    var data = $('#reset').serialize();
    $.ajax({
        type: 'POST',
        url: 'reset',
        data: data,
        success: function(result) {
            if ($.trim(result) == 'ok') {
                window.location.href = base_url+"/loadAuthenticationPage";
            } else {
                var inputError = result.err_field;

                var html = '';
                if (result.err_msg) {
                    html = '<div>';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';
                    $('#reset_error_data').html(html);
                    $("#reset_error_data").show();
                }

                if (inputError.password) {
                    $('#password').addClass("error");
                } else {
                    $('#password').removeClass("error");
                }
                if (inputError.con_password) {
                    $('#con_password').addClass("error");
                } else {
                    $('#con_password').removeClass("error");
                }
            }
        }
    });
}

function zipcodeSearch(field_id_1, field_id_2, prefecture, address1, address2,extra_check = null) {
    var regex = /^([0-9])+$/g;
    var part1 = $("#" + field_id_1).val();
    var part2 = $("#" + field_id_2).val();
    var test1 = regex.test(part1);
    var zipcode = part1 + part2;

    var html = "<span id=" + field_id_1 + "_err_msg" + " class='message' style='color:red;display:block;position:relative;>";
    html += "郵便番号形式が間違ってます。"; //Invalid Zip-code
    html += "</span>";
    var url = 'https://ita01.colgis.com/cgi-bin/http_yubin_get.cgi?PASSWORD=colgis.co.jp&YUBINBANGO=';
    if (zipcode.length == 7) {
        $.ajax({
            type: "GET",
            url: url + zipcode,
            dataType: "text",
            success: function(response) {
                ward = response.split(" ");
                province = ward[0].split("==")
                    // console.log(ward[1]); // server response
                if (ward[1] !== undefined) {
                    //$('#'+fillable_id).val(province[1]+ward[1]+ward[2]);
                    $('#' + prefecture).select2().val(province[1]);
                    $('#' + prefecture).select2().trigger('change');
                    if(extra_check == 'delivery_address'){
                        $('#' + address1).val(ward[1]+' '+ward[2]);
                    }else{
                       $('#' + address1).val(ward[1]);
                        $('#' + address2).val(ward[2]); 
                    }

                } else {
                    // $('#'+prefecture).val("choice").trigger("change");
                    $("#" + address1).val("");
                    $("#" + address2).val("");
                }
            },
        });
    } else {
        $('#' + prefecture).select2().val("");
        $('#' + prefecture).select2().trigger('change');
        $("#" + address1).val("");
        $("#" + address2).val("");
    }
}

$("input[name='payment_method']").click(function(){
   $('#order_con_btn').attr('disabled' , true);
   var payment_method = $(this).val();
   var shipping_method = $("#shippingMethod").val();
   var prefecture = $("#diff2_prefecture").val();
   var product_total = $("#product_total").val();
   var tax = $("#tax").val();
   
   //disable,enable 表示しない
   if(payment_method == '代金引換'){
       $("#exampleRadios3").click();
       $("#do_not_show").css('pointer-events','none');
   }else{
     $("#do_not_show").css('pointer-events','initial');  
   }
   console.log(prefecture)
    $.ajax({
        type: 'GET',
        url: 'calculateCharge',
        data: 'payment_method='+payment_method+'&shipping_method='+shipping_method+'&prefecture='+prefecture+'&product_total='+product_total,
        success: function(result) {
            console.log(result);
            if(result.delivery_charge == null){
               var delivery_charge = 0; 
            }else{
                var delivery_charge = result.delivery_charge; 
            }
            $("#delivery-charge").val(delivery_charge);
            $(".delivery-charge").html('￥ '+numberFormat(delivery_charge));
            $("#settlement-charge").val(result.settlement_charge);
            $("#settlement-charge2").val(result.settlement_charge);
            $(".settlement-charge").html('￥ '+numberFormat(result.settlement_charge));
            $("#total-amount span").html('￥ '+result.total_amount);
            $("#temp-total-amount").val(result.total_amount);
            $("#total_amount").val(result.total_amount);
            $("#total_amount1").val(result.total_amount);
            //exceed err msg
            if(result.cash_on_delivery_status == 'exceed'){
                var html = ' ご利用限度額を超えています。他の決済方法をご利用ください。';
                $("#exceed_err_msg").html(html);
                $("#order_con_btn").css('pointer-events','none');
            }else if(result.kuroneko_status == 'exceed'){
                var html = ' ご利用限度額を超えています。他の決済方法をご利用ください。';
                $("#exceed_err_msg").html(html);
                $("#order_con_btn").css('pointer-events','none');
            }else{
                $("#exceed_err_msg").html("");
                $("#order_con_btn").css('pointer-events','initial'); 
            }
            $('#order_con_btn').attr('disabled' , false);
        }
    });
});

//validation check
$("#order_con_btn").click(function(){
    if (!$("input[name='payment_method']").is(':checked')) {
        var html = '【支払方法】必須項目に入力がありません。';
        // $("#payment-method-tbody").css('border','1px solid red');
        $("#payment-method-tbody").addClass('errorBorder');
        $("#validation_err").html(html);
        return false;
    }else{
        $("#payment-method-tbody").css('border','1px solid #e2e9e1');
        $("#validation_err").html("");
        
        //check transaction status
        checkTransaction();
    }
});

//member cancellation validation check
function validateMemberCancellation(){
    var data = $("#memberCancellation").serialize();
    $.ajax({
        type:'POST',
        url:'validateMemberCancellation',
        data:data,
        success:function(result){
            if(result == 'ok'){
                $('#error_data').html("");
                $('#email').removeClass("error");
                $('#password').removeClass("error");
                $("#membershipModal").modal('show');
            }else{
                var inputError = result.err_field;

                var html = '';
                if (result.err_msg) {
                    html = '<div>';
                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 13px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';
                    $('#error_data').html(html);
                    $("#error_data").show();
                }

                if (inputError.email) {
                    $('#email').addClass("error");
                } else {
                    $('#email').removeClass("error");
                }
                if (inputError.password) {
                    $('#password').addClass("error");
                } else {
                    $('#password').removeClass("error");
                }
            }
        }
        
    });
}

//member cancellation 
function memberCancellation(){
    var data = $("#memberCancellation").serialize();
    $.ajax({
        type:'POST',
        url:'memberCancellation',
        data:data,
        success:function(result){
            if(result == 'ok'){
               window.location.href = base_url+"/loadAuthenticationPage";
            }else if(result == 'ng'){
                var html = '<span style="color:red;">「現在継続中のお取引があるため、削除できません。」</span>';
                $('#error_data').html(html);
                $("#error_data").show();
                $("#membershipModal").modal('hide');
            }else if(result == 'no_user'){
                var html = '<span style="color:red;">入力内容が誤っています。</span>';
                $('#error_data').html(html);
                $("#error_data").show();
                $('#email').addClass("error");
                $('#password').addClass("error");
                $("#membershipModal").modal('hide');
            }
        }
        
    });
}

//hide member cancellation modal
function hideMemberCancellation(){
    $("#membershipModal").modal('hide');
}

//number format
function numberFormat(num) {
    if (num != "") {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    } else {
        return num;
    }
}