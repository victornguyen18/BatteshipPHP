$(function () {
    $('.draggable').dblclick(function () {
        // alert($(this).attr("rel"));
        if ($(this).attr("rel") == 0) {
            $(this).css("transform", " rotate(90deg)");
            $(this).css("-webkit-transform", " rotate(90deg)");
            $(this).css("-ms-transform", " rotate(90deg)");

            $(this).attr("rel", "1");
        }
        else {
            $(this).css("transform", " rotate(0deg)");
            $(this).css("-webkit-transform", " rotate(0deg)");
            $(this).css("-ms-transform", " rotate(0deg)");
            $(this).attr("rel", "0");
        }
    });
});

$(function () {
    $('.draggable').draggable({
        cursor: 'move',
        snap: true,
        helper: 'clone',
        start: function (event, ui) {
            $(this).draggable("option", "cursorAt", {
                left: Math.floor(ui.helper.width() / 2),
                top: Math.floor(ui.helper.height() / 2)
            });
        }
    });
});

$(function () {
    $('.location').droppable({
        accept: ".draggable",
        drop: handleDrop
    });
});
var shipName;
var rowcol;
var data = {};

function handleDrop(event, ui) {
    var row = 0;
    var col = 0;
    if (ui.draggable.prop("class").match("2")) {
        if (ui.draggable.attr("rel") == "0") // horizontal
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]);
            col = parseInt(rowcol.split("")[1]);
            // alert("row: " + row);
            // alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]);
            col = parseInt(rowcol.split("")[1]);
            // alert("row: " + row);
            // alert("col: " + col);
        }

    }
    else if (ui.draggable.prop("class").match("3")) {
        if (ui.draggable.attr("rel") == "0") // horizontal
        {
            ui.draggable.position({
                of: $(this),
                my: 'left-40 top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]);
            col = parseInt(rowcol.split("")[1]) - 1;
            // alert("row: " + row);
            // alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top-40',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]) - 1;
            col = parseInt(rowcol.split("")[1]);
            // alert("row: " + row);
            // alert("col: " + col);
        }
    }
    else if (ui.draggable.prop("class").match("4")) {
        if (ui.draggable.attr("rel") == "0") // horizontal
        {
            ui.draggable.position({
                of: $(this),
                my: 'left-40 top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]);
            col = parseInt(rowcol.split("")[1]) - 1;
            // alert("row: " + row);
            // alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top-40',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]) - 1;
            col = parseInt(rowcol.split("")[1]);
            // alert("row: " + row);
            // alert("col: " + col);
        }
    }
    else if (ui.draggable.prop("class").match("5")) {
        if (ui.draggable.attr("rel") == "0") // horizontal
        {
            ui.draggable.position({
                of: $(this),
                my: 'left-80 top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]);
            col = parseInt(rowcol.split("")[1]) - 2;
            // alert("row: " + row);
            // alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top-80'
            });
            rowcol = $(this).prop("id");
            row = parseInt(rowcol.split("")[0]) - 2;
            col = parseInt(rowcol.split("")[1]);
            // alert("row: " + row);
            // alert("col: " + col);
        }
    }
    shipName = ui.draggable.prop("id");
    shipDirection = ui.draggable.attr("rel");
    ui.draggable.draggable('option', 'revert', false);
    data[shipName] = {
        "shipName": shipName,
        "row": row,
        "col": col,
        "direction": shipDirection
    };
};
$(function () {
    $('.draggableWeapon').draggable({
        cursor: 'move',
        snap: true,
        helper: 'clone',
        start: function (event, ui) {
            $(this).draggable("option", "cursorAt", {
                left: Math.floor(ui.helper.width() / 2),
                top: Math.floor(ui.helper.height() / 2)
            });
        }
    });
});
$(function () {
    $('.battle-location').droppable({
        accept: ".draggableWeapon",
        drop: handleDropWeapon
    });
});
var rowcolWeapon;
function handleDropWeapon(event, ui) {
    ui.draggable.position({
        of: $(this),
        my: 'left top',
        at: 'left top'
    });
    ui.draggable.draggable('option', 'revert', false);
    rowcolWeapon = $(this).attr('rel');
    var rowW = parseInt(rowcolWeapon.split("")[1]);
    var colW = parseInt(rowcolWeapon.split("")[2]);
    alert("rowW: " + rowW);
    alert("colW: " + colW);
}

$('.radar').mousedown(function(){
    $(this).css({
        'background-color' : 'rgba(255,255,255,0.5)',
        'width' : '119px',
        'height' : '119px'
    });
});

$('.bomb').mousedown(function(){
    $(this).children('img').css({
        'width' : '79px',
        'height' : '79px'
    });
    $(this).css({
        'background-color' : 'rgba(0,0,0,0.5)',
        'width' : '159px',
        'height' : '79px'
    });
});

$(function () {
    $(".continue-btn").click(function () {
        if(Object.keys(data).length == 10){
            for (var value in data){
                console.log(data[value]);
                // $.get("../play/shipSetting", data[value], function (o) {
                // }, 'json');
                $.ajax({
                    url: "../play/shipSetting",
                    type: "GET",
                    data: data[value],
                    dataType: "json",
                    async : false,
                    success : function (result) {
                    }
                });
            }
        }
        else{
            alert("not so fast");
            return false;
        }
    });
});

// Next button click event
$('.next').click(function () {
    var nextId = $(this).parents('.tab-pane').next().attr('id');
    alert($(this).parents('.tab-pane').next().attr('id'));
    $('a[href=#' + nextId + ']').click();
});

// Previous button click event
$('.prev').click(function () {
    var prevId = $(this).parents('.tab-pane').prev().attr('id');
    $('a[href=#' + prevId + ']').click();
});

$('.startOver').click(function () {
    // var startOverId = $(this).parents('.tab-pane').prev().attr('id');
    $('a[href=#step1]').click();
});

// Event to run on 'tab-shown'
$('a[data-toggle="tab"]').on('shown.bs.tab', function (event) {
    // Calculate progressbar percent
    var step = $(event.target).data('step');
    var percent = (parseInt(step) / 5) * 100;

});

//CLick on div
