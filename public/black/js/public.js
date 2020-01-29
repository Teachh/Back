$(document).ready(function () {
    $('.js-example-basic-multiple').select2();
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd',
        firstDay: 1
    });

    $(document).on('click', '.note-pagination .pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "home?notes=" + page,
            success: function (data) {
                console.log(data);
                $('#tasks-table').html(data);
            }
        });
    }
});
