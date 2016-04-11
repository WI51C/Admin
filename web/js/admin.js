$(document).ready(function () {
    $('td:has(table)').each(function (index, element) {
        $(element).css('padding', '0');
        if ($(element).find('tbody').length === 0) {
            $(element).find('thead').css('height', '100%');
        }
    });
});
