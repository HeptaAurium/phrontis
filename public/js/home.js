$(document).ready(function () {
    $('button.btn-maximize-sidenav').click(function (e) {
        e.preventDefault();

        $('.sidebar').toggleClass('mini');
        $('#app').toggleClass('mini');
        $('.side-text').toggleClass('d-none');
        // $('.side-mini-text').toggleClass('d-none');
        $(this).toggleClass('flip');
    });

    $('button.btn-toggle-sidenav').click(function (e) {
        e.preventDefault();
        $('.sidebar').toggleClass('show');
        $('.side-text').toggleClass('d-none');
    });


    $('.accordion-heading').on('click', function(){
       
        $('.accordion-heading').not(this).each(function () {
            var target = $(this).data('target');
            $(target).removeClass("show");
        });
    });
});
