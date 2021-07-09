$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.switchResultsTabs', function (e) {
        e.preventDefault();

        var target = $(this).attr("href");
        // alert(target);
        $('.results_tab').fadeOut(350).delay(200).removeClass('active');
        $(document).find(target).fadeIn(350).delay(200).addClass('active');
        $('.switchResultsTabs').removeClass('active');
        $(this).addClass('active');
    });

});