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
function handleDrop(event, ui) {
    if (ui.draggable.prop("class").match("2")) {
        if (ui.draggable.attr("rel") == "0") // horizontal
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            var row = parseInt(rowcol.split("")[0]);
            var col = parseInt(rowcol.split("")[1]);
            alert("row: " + row);
            alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            var row = parseInt(rowcol.split("")[0]);
            var col = parseInt(rowcol.split("")[1]);
            alert("row: " + row);
            alert("col: " + col);
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
            var row = parseInt(rowcol.split("")[0]);
            var col = parseInt(rowcol.split("")[1])-1;
            alert("row: " + row);
            alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top-40',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            var row = parseInt(rowcol.split("")[0])-1;
            var col = parseInt(rowcol.split("")[1]);
            alert("row: " + row);
            alert("col: " + col);
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
            var row = parseInt(rowcol.split("")[0]);
            var col = parseInt(rowcol.split("")[1])-1;
            alert("row: " + row);
            alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top-40',
                at: 'left top'
            });
            rowcol = $(this).prop("id");
            var row = parseInt(rowcol.split("")[0])-1;
            var col = parseInt(rowcol.split("")[1]);
            alert("row: " + row);
            alert("col: " + col);
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
            var row = parseInt(rowcol.split("")[0]);
            var col = parseInt(rowcol.split("")[1])-2;
            alert("row: " + row);
            alert("col: " + col);
        }
        else                                // vertical
        {
            ui.draggable.position({
                of: $(this),
                my: 'left top',
                at: 'left top-80'
            });
            rowcol = $(this).prop("id");
            var row = parseInt(rowcol.split("")[0])-2;
            var col = parseInt(rowcol.split("")[1]);
            alert("row: " + row);
            alert("col: " + col);
        }

    }
    shipName = ui.draggable.prop("id");
    ui.draggable.draggable('option', 'revert', false);
}

// Get location in battle
$('.battle-location').click(function(){
    var rel = $(this).attr('rel');
    alert(rel);
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
