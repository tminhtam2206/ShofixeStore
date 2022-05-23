jQuery(document).ready(function() {
    $("time.timeago").timeago();
});

// start price
$("input[data-type='currency']").on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() {
        formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
// end price

//START FUNCTION ADD/EDIT PRODUCT
//preview images
var check_add_product__image = false;
var check_add_product__code = false;
var check_add_product__edit_image = true;
var check_add_product__edit_code = true;

function myfun() {
    var filesAmount = document.getElementById("myinput").files.length;

    if (filesAmount >= 4) {
        $("#showImg").html('');
        for (var i = 0; i < filesAmount; i++) {
            if (i < 4) {
                reader = new FileReader();
                reader.onload = function() {
                    if (reader.readyState = "complete") {
                        placeToInsertImagePreview = document.getElementById('showImg')
                        CreateIMGANDapendedImg = $($.parseHTML('<img style="width:100%;height:245px;border:1px solid #dccccc;">')).attr('src', event.target.result)
                        IMGsurroundedByDiv = $($.parseHTML('<div class="col-md-3">')).html(CreateIMGANDapendedImg)

                        $("#showImg").append(IMGsurroundedByDiv);
                    }
                }

                reader.readAsDataURL(document.getElementById("myinput").files[i]);
            }
        }

        check_add_product__image = true;
    }
    else{
        check_add_product__image = false;
    }
}

$(document).ready(function() {
    $('#name').keyup(function() {
        let max = 58;
        let curr = max - $(this).val().length;
        let key = $(this).val();

        if ($(this).val() != '') {
            $('#max-length-ten-san-pham').text('[Còn lại: ' + curr + ' ký tự]');
        } else {
            $('#max-length-ten-san-pham').text('');
        }
    });
    
    $('#code').keyup(function() {
        let max = 150;
        let curr = max - $(this).val().length;
        let key = $(this).val();
        let token = $('#token').val();

        if ($(this).val() != '') {
            $.ajax({
                url: "http://localhost/ShofixeStore/admin/product/check-code",
                type: 'post',
                data: {code:key, _token:token},
                success:function(data_return){
                    if(data_return == 0){
                        $('#code').removeClass('is-invalid');
                        $('#code').addClass('is-valid');
                        check_add_product__code = true;
                    }
                    else{
                        $('#code').removeClass('is-valid');
                        $('#code').addClass('is-invalid');
                        check_add_product__code = false;
                    }
                }
            });

            $('#max-length-code').text('[Còn lại: ' + curr + ' ký tự]');
        } else {
            $('#max-length-code').text('');
        }
    });

    $('#edit-code').keyup(function() {
        let max = 150;
        let curr = max - $(this).val().length;
        let key = $(this).val();
        let token = $('#token').val();

        if ($(this).val() != '') {
            $.ajax({
                url: "http://localhost/ShofixeStore/admin/product/check-code",
                type: 'post',
                data: {code:key, _token:token},
                success:function(data_return){
                    if(data_return == 0){
                        $('#code').removeClass('is-invalid');
                        $('#code').addClass('is-valid');
                        check_add_product__edit_code = true;
                    }
                    else{
                        $('#code').removeClass('is-valid');
                        $('#code').addClass('is-invalid');
                        check_add_product__edit_code = false;
                    }
                }
            });

            $('#max-length-code').text('[Còn lại: ' + curr + ' ký tự]');
        } else {
            $('#max-length-code').text('');
        }
    });

    $('#type_product').change(function() {
        var type_product_id = $(this).val();
        var token = $('#token').val();

        if (type_product_id != '') {
            $.ajax({
                url: "http://localhost/ShofixeStore/admin/product/get-category",
                type: 'post',
                data: {
                    id: type_product_id,
                    _token: token
                },
                success: function(data_return) {
                    $('#category_id').html(data_return);
                }
            });
        } else {
            $('#category_id').html('<option value="">-- Chọn --</option>');
        }
    });

    $('#summary').keyup(function() {
        var max = 255;
        var curr = max - $(this).val().length;
        var key = $(this).val();

        if ($(this).val() != '') {
            $('#max-length-summary').text('[Còn lại: ' + curr + ' ký tự]');
        } else {
            $('#max-length-summary').text('');
        }
    });

    $("#mul-select-color").select2({
        placeholder: "Chọn màu",
        tags: true,
        tokenSeparators: ['/', ',', ';', " "]
    });

    $("#mul-select-size").select2({
        placeholder: "Chọn kích thước",
        tags: true,
        tokenSeparators: ['/', ',', ';', " "]
    });

    $( "#form_add_product" ).submit(function(event){
        if(!check_add_product__image){
            $.confirm({
                title: '<i class="fas fa-bell"></i> Thông Báo',
                content: 'Bạn phải chọn đủ [4 ảnh] về sản phẩm này!',
                type: 'purple',
                buttons:{
                    cancelAction:{
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
            event.preventDefault();
        }

        if(!check_add_product__code){
            $.confirm({
                title: '<i class="fas fa-bell"></i> Thông Báo',
                content: '[CODE] sản phẩm bị trùng!',
                type: 'purple',
                buttons:{
                    cancelAction:{
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
            event.preventDefault();
        }

        return true;
    });

    $( "#form_edit_product" ).submit(function(event){
        if(!check_add_product__edit_image){
            $.confirm({
                title: '<i class="fas fa-bell"></i> Thông Báo',
                content: 'Bạn phải chọn đủ [4 ảnh] về sản phẩm này!',
                type: 'purple',
                buttons:{
                    cancelAction:{
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
            event.preventDefault();
        }

        if(!check_add_product__edit_code){
            $.confirm({
                title: '<i class="fas fa-bell"></i> Thông Báo',
                content: '[CODE] sản phẩm bị trùng!',
                type: 'purple',
                buttons:{
                    cancelAction:{
                        text: 'Đóng',
                        btnClass: 'btn-blue'
                    }
                }
            });
            event.preventDefault();
        }

        return true;
    });
});

//END FUNCTION ADD/EDIT PRODUCT
//add to cart

var my_token = $('#my_token').val();

function add_to_cart(product_id){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/add-home",
        data: {id:product_id},
        type: 'get',
        success:function(data_return){
            if(data_return != ''){
                my_custom_alert(data_return);
            }
            else{
                getCount();
                getContentCart();
                getSubTotal();
                my_custom_alert('Đã thêm vào giỏ hàng!');
            }
        }
    });
}

function cart_up(row){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/up",
        data: {rowId:row},
        type: 'get',
        success:function(data_return){
            $('#qty-'+row).val(data_return);
            getSubPrice(row);
            getSubTotal(row);
            getTotal(row);
            getCount();
            getContentCart();
        }
    });
}

function cart_down(row){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/down",
        data: {rowId:row},
        type: 'get',
        success:function(data_return){
            $('#qty-'+row).val(data_return);
            getSubPrice(row);
            getSubTotal();
            getTotal();
            getCount();
            getContentCart();
        }
    });
}

function getSubPrice(row){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/getPrice",
        data: {rowId:row},
        type: 'get',
        success:function(data_return){
            $('#price-'+row).html(data_return);
        }
    });
}

function getSubTotal(){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/getSubTotal",
        data: {},
        type: 'get',
        success:function(data_return){
            $('#tongtien-chua-tru-thue').html(data_return);
            $('#my-sub-total').html(data_return);
        }
    });
}

function getTotal(){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/getTotal",
        data: {},
        type: 'get',
        success:function(data_return){
            $('#tong-thanh-toan').html(data_return);
        }
    });
}

function getCount(){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/getCount",
        data: {},
        type: 'get',
        success:function(data_return){
            $('#num_cart').text(data_return);
        }
    });
}

function delete_cart(row){
    if(confirm('Bạn có muốn xóa')){
        $.ajax({
            url: "http://localhost/ShofixeStore/gio-hang/delete",
            data: {rowId:row},
            type: 'get',
            success:function(){
                $('#tr-'+row).remove();
                getSubTotal();
                getTotal();
                getCount();
                getContentCart();
            }
        });
    }
}

function my_custom_alert(message){
    $('#my-message').text(message);
    $('#my-alert').addClass('show');
    $('#my-alert').removeClass('hide');

    setTimeout(function(){
      $('#my-alert').removeClass("show");
      $('#my-alert').addClass("hide");
    },3000);
}

function getContentCart(){
    $.ajax({
        url: "http://localhost/ShofixeStore/gio-hang/getContentCart",
        data: {},
        type: 'get',
        success:function(data_return){
            $('#frame-cart').html(data_return);
        }
    });
}

function change_color(row){
    let set_color = $('#color-'+row).val();

    if(set_color != ''){
        $.ajax({
            url: "http://localhost/ShofixeStore/gio-hang/changeColor",
            data: {rowId:row, color:set_color},
            type: 'get',
            success:function(data_return){
                $('#pick-color-'+row).text(data_return);
            }
        });
    }
}

function change_size(row){
    let set_size = $('#size-'+row).val();

    if(set_size != ''){
        $.ajax({
            url: "http://localhost/ShofixeStore/gio-hang/changeSize",
            data: {rowId:row, size:set_size},
            type: 'get',
            success:function(data_return){
                $('#pick-size-'+row).text(data_return);
            }
        });
    }
}

$('.btn-add-favourite').click(function(){
    let product_id_tmp = $(this).attr("data-product-id");
    let user_id_tmp = $(this).attr("data-user-id");
    let className = $(this).attr('class');

    //đã có trong danh mục yêu thích
    if(className == 'btn-add-favourite  fa  fa-heart' || className == 'btn-add-favourite fa fa-heart'){
        if(user_id_tmp != ''){
            $.ajax({
                url: "http://localhost/ShofixeStore/yeu-thich/xoa",
                data: {id:product_id_tmp},
                type: 'get',
                success:function(){
                    $('#favourite-').removeClass('fa');
                    $('#favourite-'+product_id_tmp).addClass('far');
                    my_custom_alert('Đã xóa sản phẩm khỏi mục yêu thích!');
                }
            });
        }
        else{
            my_custom_alert('Vui lòng đăng nhập!');
        }
    }
    else{
        if(user_id_tmp != ''){
            $.ajax({
                url: "http://localhost/ShofixeStore/yeu-thich/them",
                data: {id:product_id_tmp},
                type: 'get',
                success:function(){
                    $('#favourite-').removeClass('far');
                    $('#favourite-'+product_id_tmp).addClass('fa');
                    my_custom_alert('Đã thêm sản phẩm vào mục yêu thích!');
                }
            });
        }
        else{
            my_custom_alert('Vui lòng đăng nhập!');
        }
    }
});

$('#form-search-ajax').keyup(function(){
    let key_val = $(this).val();

    if(key_val != ''){
        $.ajax({
            url: "http://localhost/ShofixeStore/tim-kiem/ajax",
            data: {key:key_val, _token: my_token},
            type: 'post',
            success:function(data_return){
                $('#my-data-search-ajax').fadeIn('show');
                $('#my-data-search-ajax').html(data_return);
            }
        });
    }
    else{
        $('#my-data-search-ajax').fadeOut('slow');
    }
});

$('#my-data-search-ajax').fadeOut('slow');

$('.modal-view').click(function(){
    let product_id = $(this).attr("data-view-id");
    
    $.ajax({
        url: 'http://localhost/ShofixeStore/ajax-get-product/'+product_id,
        data: {id:product_id},
        type: 'get',
        success:function(data_return){
            $('#data-product-return').html(data_return);
            $('#background-modal').addClass('modal-backdrop face in');
            $('#MyProductModal').addClass('in');
            $('#MyProductModal').css('display', 'block');
        }
    });
});

$('#my-btn-close').click(function(){
    $('#background-modal').removeClass('modal-backdrop face in');
    $('#MyProductModal').removeClass('in');
    $('#MyProductModal').css('display', 'none');
});