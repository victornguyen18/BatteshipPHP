//Weekly featured items
$(function () {
    if (window.location.pathname === "/") {
        var callFunc = "product/dealList";
        var callMasonry = "";
        var page = 1;
        var limit = 4;
    } else {
        var url = window.location.href.split("?");
        var page = 1;
        var callMasonry = "col-masonry";
        if (url[1] != null) page = url[1].split("=")[1];
        var callFunc = 'dealList';
        var limit = (localStorage.getItem($('#limit').attr("rel")) === null) ? 1 : localStorage.getItem($('#limit').attr("rel"));
        $('#limit').val(limit);
    }

    $.get(callFunc, {'page': page, 'limit': limit}, function (o) {
        if(o.length < 1) window.location.href = "deal";
        for (var i = 0; i < o.length; i++) {
            $('#dealList').append(
                '            <div class="col-lg-3 col-sm-6 col-xs-12 ' + callMasonry + '">\n' +
                '                <div class="featured-item">\n' +
                '                    <a href="/product/detail/' + o[i].id + '">\n' +
                '                        <img src="' + (JSON.parse(o[i].image))[0] + '" alt=""/>\n' +
                '                        <div class="item-info">\n' +
                '                            <h4 class="item-info-title">' + o[i].name + '</h4>\n' +
                '                            <p class="item-info-description">' + o[i].category + '</p>\n' +
                '                            <label>\n' +
                '                                <i class="glyphicon glyphicon-time"></i>\n' +
                '                                <label class="countdownItem"><div data-countdown="' + formatDate(new Date(o[i].expired_time)).toString() + '"></div></label>\n' +
                '                            </label>\n' +
                '                            <ul class="item-price-list">\n' +
                '                                <li class="item-price">$' + (o[i].price - o[i].price * o[i].discount / 100) + '</li>\n' +
                '                                <li class="item-old-price"><del>$' + o[i].price + '</del></li>\n' +
                '                                <li class="item-saving">- ' + o[i].discount + '%</li>\n' +
                '                                <a class="addCart" href="#" rel="' + o[i].id + '"><li class="item-price shoppingcart" style="display: block!important; margin-top: 10px;"><i class="fa fa-shopping-cart" data-toggle="tooltip" title="Add to cart"></i></li></a>'+
                '                            </ul>\n' +
                '                            <hr class="hr-featured-item">\n' +
                '                            <span class="item-location">\n' +
                '                                                <i class="glyphicon glyphicon-map-marker"></i>\n' +
                '                                                <label>' + o[i].location + '</label>\n' +
                '                                            </span>\n' +
                '                        </div>\n' +
                '                    </a>\n' +
                '                </div>\n' +
                '            </div>');

            $('[data-countdown]').each(function () {
                var $this = $(this), finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    $this.html(event.strftime('%DD %H:%M:%S') + " Remaining");
                });
            });
        } // For loop
        //Pagination
        pagination(page, limit, "allDealList");
    }, 'json');

});

function formatDate(date) {
    function d2(n) {
        if (n < 9) return "0" + n;
        return n;
    }

    date = date.getFullYear() + "/" + d2(parseInt(date.getMonth() + 1)) + "/" + d2(date.getDate()) + " " + d2(date.getHours()) + ":" + d2(date.getMinutes()) + ":" + d2(date.getSeconds());
    return date;
}

