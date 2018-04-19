$(function () {
    console.log(image);
    var url = window.location.href.split("/");
    var idproduct = url[6];
    $('body').on('click', '.del', function () {
        var checkstr = confirm('Are you sure you want to delete this?');
        if (checkstr == true) {
            delItem = $(this);
            var id = $(this).attr('rel');
            image.splice(id, 1);
            console.log(image);
            $.post('../deleteImage', {'idproduct': idproduct, 'image': image}, function (o) {
                delItem.parent().remove();
            }, 'json');
            return false;
        } else {
            return false;
        }
    });

    $('body').on('click', '.changeAva', function () {
        var checkstr = confirm('Are you sure you want to change this?');
        if (checkstr == true) {
            changeItem = $(this);
            var id = $(this).attr('rel');
            var temp = image[id];
            image[id] = image[0];
            image[0] = temp;
            $.post('../changeAva', {'idproduct': idproduct, 'image': image}, function (o) {
                location.reload();
            }, 'json');
            return false;
        } else {
            return false;
        }
    });

    $('body').on('click', '.uploadmore', function () {
        changeItem = $(this);
        var id = $(this).attr('rel');
        var f = document.getElementById('imageToUpload');
        var fileName = f.datafile.value;
        $.post('../uploadFileEdit', {'idproduct': idproduct, 'image': image, 'filename': fileName}, function (o) {
            //location.reload();
        }, 'json');
        return false;
    });


});