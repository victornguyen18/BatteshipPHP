$(function () {
    $('#limit').on('change', function(){
        localStorage.setItem($(this).attr("rel"), $(this).val());
    });
});

function pagination(page, limit, source){
    $.get(source, function (i) {
        var total_page = i.length/limit;
        page = parseInt(page);
        if (page >= 2) {
            $('#pagination').append("<li><a href='?page=1'> ❮❮ </a></li>");
        }
        if (page > 1) {
            $('#pagination').append("<li><a href='?page=" + (page - 1) + "'> ❮ </a></li>");
            $('#pagination').append("<li><a href='?page=" + (page - 1) + "'>" + (page - 1) + "</a></li>");
        }
        $('#pagination').append("<li class='active'><a href='?page=" + page + "'>" + page + "</a></li>");
        if (page < total_page) {
            $('#pagination').append("<li><a href='?page=" + (page + 1) + "'>" + (page + 1) + "</a></li>");
            $('#pagination').append("<li><a href='?page=" + (page + 1) + "'> ❯ </a></li>");
        }
        if (page <= total_page - 1) {
            $('#pagination').append("<li><a href='?page=" + total_page + "'> ❯❯ </a></li>");
        }
    }, 'json');
}