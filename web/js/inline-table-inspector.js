$(function () {

    $('a.table-inspect-trigger').click(function () {
        $('.inspect-active').removeClass('inspect-active');
        var container = $(this).siblings('.table-container');
        var table = container.children('table');
        container.addClass('inspect-active');
    });

    $('.table-inspect-exit').click(function () {
        $(this).closest('.table-container').removeClass('inspect-active');
    });
});
