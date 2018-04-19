$(function () {
    $(document).on('click', '.addCart', function () {
        var id = $(this).attr('rel');
        var quantity = (window.location.href.split("/")[4] === "detail") ? $('#quantity').val() : 1;
        var data = {'id': id, 'quantity': quantity};
        var url = window.location.href.split("/")[2] + "/";
        $.post('../../cart/addToCart', data, function (o) {
            // If the product is already in cart, change the value
            if ($('p#' + o.id + ".cart-info-price").length) {
                $('p#' + o.id + ".cart-info-price").html("$" + (!(expiredDeal(o.expired_time)) ? (o.price * o.quantity * (100 - o.discount) / 100) : o.price));
            }
            else {
                $('#myCartDiv').append(
                    '<a href="/product/detail/' + o.id + '">' +
                    '   <li>' +
                    '       <div class="cart-item">' +
                    '           <img src="' + o.image + '" height="70" width="70"/>' +
                    '           <div class="cart-info">' +
                    '               <p class="cart-info-name">' + o.name + '</p>' +
                    '               <p class="cart-info-price" id="' + o.id + '">' + "$" + (!(expiredDeal(o.expired_time)) ? (o.price * o.quantity * (100 - o.discount) / 100) : o.price) + '</p>' +
                    '           </div>' +
                    '       </div>' +
                    '   </li>' +
                    '</a>'
                );
            }

        }, 'json');
        return false;
    });

    $('.btn-number').click(function (e) {
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        input.data('oldValue', currentVal); // save previous value;
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
            }
            else if (type == 'plus') {
                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }
            }


        } else {
            input.val(0);
        }

    });

    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        var id = $(this).attr('rel');
        var quantity = (parseInt(valueCurrent) - parseInt($(this).data('oldValue')));
        var data = {'id': id, 'quantity': quantity};
        name = $(this).attr('name');
        if (minValue <= valueCurrent && valueCurrent <= maxValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled');
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled');
            $.post('../../cart/addToCart', data, function (o) {
                $('p#' + o.id + ".cart-info-price").html("$" + (!(expiredDeal(o.expired_time)) ? (o.price * o.quantity * (100 - o.discount) / 100) : o.price));
                $('td#' + o.id + ".cart-info-price").html("$" + (!(expiredDeal(o.expired_time)) ? (o.price * o.quantity * (100 - o.discount) / 100) : o.price));
                var sum = 0;
                $('td.cart-info-price').each(function () {
                    sum += parseFloat($(this).html().split("$")[1]);
                });
                $('span.cart-total-price').html("$" + sum);
            }, 'json');
        }
        else {
            $(this).val($(this).data('oldValue'));
        }

    });
    //Reject user to input something unnecessary
    $(".input-number").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
// Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.removeFromCart').click(function () {
        var id = $(this).attr('rel');
        var delItem = $(this);
        $.post('../../cart/removeFromCart',{'id' : id} ,function (o) {
            delItem.parent().parent().remove();
            var sum = 0;
            $('td.cart-info-price').each(function () {
                sum += parseFloat($(this).html().split("$")[1]);
            });
            $('span.cart-total-price').html("$" + sum);
        });
        return false;
    });

    // if (window.location.pathname === "/cart") {
    //     $.post('/cartList', function (o) {
    //         alert("ABC");
    //         // $('.table cart-table tbody').append(
    //         //     '<tr>\n' +
    //         //     '   <td class="cart-item-image">\n' +
    //         //     '       <a href="#">\n' +
    //         //     '           <img src="img/amaze_70x70.jpg" alt="Image Alternative text" title="AMaze">\n' +
    //         //     '       </a>\n' +
    //         //     '   </td>\n' +
    //         //     '   <td><a href="#">New Glass Collection</a>\n' +
    //         //     '   </td>\n' +
    //         //     '   <td class="cart-item-quantity">\n' +
    //         //     '       <i class="fa fa-minus cart-item-minus btn-number" data-type="minus" data-field="quant[1]"></i>\n' +
    //         //     '       <input type="text" name="quant[1]" class="cart-quantity input-number" value="1" min="1" max="100"/>\n' +
    //         //     '       <i class="fa fa-plus cart-item-plus btn-number" data-type="plus" data-field="quant[1]"></i>\n' +
    //         //     '   </td>\n' +
    //         //     '   <td>$150</td>\n' +
    //         //     '   <td class="cart-item-remove">\n' +
    //         //     '       <a class="fa fa-times" href="#"></a>\n' +
    //         //     '   </td>\n' +
    //         //     '</tr>'
    //         // );
    //         alert(o[0]);
    //     }, 'json');
    // }
});

