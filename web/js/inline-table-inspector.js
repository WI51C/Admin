(function () {

    $('table table').each(function(index, element){
        $(element).parent('td').append('<a class="inspect-table"></a>');
    });
});