$(function () {
    $.get('../product/allProductList', function (o) {
        for (var i = 0; i < o.length; i++) {
            $('#listProduct').append('<tr><td>' + o[i].name +
                '</td><td>' + o[i].category +
                '</td><td>' + o[i].price +
                '</td><td>' + o[i].location +
                '</td><td>' + formatDate(new Date(o[i].expired_time)).toString() +
                '</td><td>' + o[i].discount +
                '</td><td>' +
                '<a href="' + window.location.href + '/edit/' +o[i].id + '">Edit</a>'+
                '<span> - </span>' +
                '<a class="del" rel="' + o[i].id + '"href="#">Delete</a>'+
                '</td>');
            $('#listProduct').append('</tr>');
        }
        $('body').on('click','.del',function() {
            var checkstr =  confirm('Are you sure you want to delete this?');
            if(checkstr == true){
                delItem = $(this);
                var id = $(this).attr('rel');
                $.post('../product/productDelete',{'id':id},function(o){
                    delItem.parent().parent().remove();
                },'json');
                return false;
            }else{
                return false;
            }
        });
    }, 'json');
});


function formatDate(date) {
    function d2(n) {
        if(n<9) return "0"+n;
        return n;
    }
    var currentdate = new Date();
    if (currentdate < date) {
        date = date.getFullYear() + "/" + d2(parseInt(date.getMonth() + 1)) + "/" + d2(date.getDate());
        return date;
    } else {
        return "end-expired";
    }
}