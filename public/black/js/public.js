$(document).ready(function () {
    $('.js-example-basic-multiple').select2();
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        firstDay: 1
    });

    $(document).on('click', '.note-pagination .pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        var table = 'note';
        fetch_data(page, table);
    });

    $(document).on('click', '.orders-pagination .pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        var table = 'order';
        fetch_data(page, table);
    });

    function fetch_data(page, table) {
        if (table == 'note') {
            $.ajax({
                url: "home?notes=" + page,
                data: {
                    table: 'notes'
                },
                success: function (data) {
                    $('#tasks-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "home?orders=" + page,
                success: function (data) {
                    console.log(data);
                    $('#orders-table').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    }
});
