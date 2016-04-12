$(function () {

    var open = [];
    $('a.table-inspect-trigger').click(function () {
        $('.inspect-active').removeClass('inspect-active');
        var table = $(this).siblings('table');
        table.addClass('inspect-active');
        open.push(table);
    });


});