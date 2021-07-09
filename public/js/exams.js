$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button#recordExams').click(function (e) {
        e.preventDefault();
        var checkedTypes = $('.check-type:checked'),
            examClass = $('#exam_class').val(),
            subject = $('#exam_subject').val(),
            branch = $('#exam_branch').val(),
            greenLight = true;

        if (checkedTypes.length == 0) {
            toastr.error('Select at least one exam type from the provided options');
            return;
            greenLight = false;
        }

        if (examClass == "all") {
            toastr.error('Select a class from the provided options');
            return;
            greenLight = false;
        }

        if (subject == "all") {
            toastr.error('Select a subject from the provided options');
            return;
            greenLight = false;
        }

        if (branch == "all") {
            toastr.error('Select a branch from the provided options');
            return;
            greenLight = false;
        }

        var exam_types = [];
        for (let index = 0; index < checkedTypes.length; index++) {
            const element = checkedTypes[index];
            exam_types.push($(element).val());
        }

        if (greenLight) {
            $.ajax({
                type: "post",
                url: "/exams/get-exam-list",
                data: {
                    clss: examClass,
                    subject: subject,
                    exam_types: JSON.stringify(exam_types),
                    branch: branch
                },

                success: function (response) {
                    $('#examListPanel').fadeOut(200).empty();
                    $('#filledListPanel').fadeOut(200).empty();
                    $('#examListPanel').append(response).fadeIn(350);
                }
            });
        }
    });

    $(document).on('click', '#reloadPage', function (e) {
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '#postResults', function (e) {
        e.preventDefault();
        var inputs = $(document).find('.results');

        for (var i = 0; i < inputs.length; i++) {
            var elem = inputs[i];
            var exam_type = $(elem).data('exam_type');
            var student = $(elem).data('student');
            var clss = $(elem).data('class');
            var marks = $(elem).val();


            var inp = $('<input>').attr({
                type: 'hidden',
                name: "results[]",
                value: JSON.stringify({
                    student: student,
                    exam_type: exam_type,
                    marks: marks,
                    class: clss,
                }),
                multiple: "multiple",
            });

            $(document).find('form#marksForm').append(inp);
            $(document).find('form#marksForm').submit();

        }
    });

    $(document).on('focus', '.edit', function (e) {
        $(this).removeClass('edit');
        $(this).val('');
    });

    $(document).on('change', '.results', function (e) {
        var val = $(this).val();
        var exam_type = $(this).data('exam_type');
        var target = $(document).find('input#type' + exam_type).val();

        if (val > target) {
            toastr.error("Input exceeded the expected range");
            $(this).val(0);
        }

        // if (!isFloat(val)) {
        //     toastr.error("Invalid inputs corrected");
        //     $(this).val(0);

        // }
    });

    function isFloat(n) {
        return Number(n) === n && n % 1 != 0;
    }

    // 

    $('select#exam_branch').on('change', function (e) {
        e.preventDefault();

        var val = $(this).val();
        if (val != "all") {
            var target = "#exam_tab" + val;
            var tab = "#switch_exam_tab" + val;
            // alert(target);
            $('.exam-tabs').fadeOut(350).delay(200).removeClass('active');
            $(document).find(target).fadeIn(350).delay(200).addClass('active');
            $('.switchExamTabs').removeClass('active');
            $(document).find(tab).addClass('active');
        }
    });

    $(document).on('click', '.switchExamTabs', function (e) {
        e.preventDefault();

        var target = $(this).attr("href");
        // alert(target);
        $('.exam-tabs').fadeOut(350).delay(200).removeClass('active');
        $(document).find(target).fadeIn(350).delay(200).addClass('active');
        $('.switchExamTabs').removeClass('active');
        $(this).addClass('active');
    });
});
