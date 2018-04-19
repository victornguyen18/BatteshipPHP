// $(function () {
//     $.get('../cart/billList', function (o) {
//         for (var i = 0; i < o.length; i++) {
//             $('#listBill').append('<tr><td>' + o[i].id +
//                 '</td><td>' + formatDate(new Date(o[i].datebill)).toString() +
//                 '</td><td>' + o[i].username +
//                 '</td><td>' + o[i].totalprice +
//                 '</td><td>' + o[i].status +
//                 '</td><td>' +
//                 '<a href="' + window.location.href + '/view/' + o[i].id + '">View</a>' +
//                 '<span> - </span>' +
//                 '<a class="del" rel="' + o[i].id + '"href="#">Delete</a>' +
//                 '</td>');
//             $('#listProduct').append('</tr>');
//         }
//     }, 'json');
// });
//
//
// function formatDate(date) {
//     function d2(n) {
//         if (n < 9) return "0" + n;
//         return n;
//     }
//     date = d2(date.getDate()) + "-" + d2(parseInt(date.getMonth() + 1)) + "-" + date.getFullYear();
//     return date;
// }