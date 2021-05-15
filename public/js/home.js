$(document).ready(function () {
    $('button.btn-expand-side').click(function (e) {
        e.preventDefault();
        
        $('.sidebar').toggleClass('mini');
        $('#app').toggleClass('max');
        $('.side-text').toggleClass('d-none');
        $('.side-mini-text').toggleClass('d-none');
        $(this).toggleClass('flip');
    });

    $('button.btn-toggle-sidenav').click(function (e) {
        e.preventDefault();
        $('.sidebar').toggleClass('mini');
    });
});