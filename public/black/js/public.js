$(document).ready(function () {
    // Initialize form multiple selects
    $('.js-example-basic-multiple').select2();

    // format form date pickers
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        firstDay: 1
    });

    // function when task pagination clicked
    $(document).on('click', '.note-pagination .pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        var table = 'note';
        fetch_data(page, table);
    });

    // function when order pagination clicked
    $(document).on('click', '.orders-pagination .pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        var table = 'order';
        fetch_data(page, table);
    });

    // ajax function
    function fetch_data(page, table) {
        if (table == 'note') {
            // ajax for tasks/notes table pagination
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
            // ajax for orders table pagination
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
