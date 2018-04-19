$(function () {
    $.get('../product/productList', function (o) {
        for (var i = 0; i < o.length; i++) {
            $('#listProduct').append('<tr><td>' + o[i].name +
                '</td><td>' + o[i].category +
                '</td><td>' + o[i].price +
                '</td><td>' + o[i].location +
                '</td><td>' + o[i].expried_time +
                '</td><td>' + o[i].discount +
                '</td><td><a class="del" rel="' + o[i].idproducts + '"href="#">Delete</a></td>' +
                '</td><td><a class="edit" rel="' + o[i].idproducts + '"href="#">Edit</a></td>');
            $('#listProduct').append('</tr>');
        }
        $('body').on('click','.del',function() {
            delItem = $(this);
            var id = $(this).attr('rel');
            $.post('../product/productDelete',{'id':id},function(o){
                delItem.parent().parent().remove();
            },'json');
            return false;
        });
    }, 'json');
});