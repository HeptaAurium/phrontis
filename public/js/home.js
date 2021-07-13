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


    $('.accordion-heading').on('click', function () {

        $('.accordion-heading').not(this).each(function () {
            var target = $(this).data('target');
            $(target).removeClass("show");
        });
    });
    var ctx = document.getElementById('myChart').getContext('2d');
    // const labels = Utils.months({ count: 7 });
    const data = {
        // labels: labels,
        datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };
    var myChart = new Chart(ctx, {
        type: 'Line',
        data: data,
    });
});
